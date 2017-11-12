<?php 

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Orders extends Eloquent
{
    protected $table = 'orders';

    public function orderDetails()
    {
        return $this->hasMany('OrderDetails', 'order_id', 'id');
    }

    function getList($type = array(), $order = array(), $fetch = array(), $offset = 0, $limit = 0)
    {
        $select = $this->select($fetch ? $fetch : array('orders.*'));

        $this->_where($select, $type);
        $this->_order($select, $order);

        if ($limit > 0) {
            $select->skip($offset)->take($limit);
        }

        return $select->get();

    }
    function getListPage($type = array(), $size = 15, $order = array(), $fetch = array())
    {
        $select = $this->select($fetch ? $fetch : array('orders.*'));

        $this->_where($select, $type);
        $this->_order($select, $order);

        return $select->paginate($size);
    }


    function add($user_id, $order, $detail, $address_id = null)
    {
        $order['wx_pay_order'] = date('YmdHis').mt_rand(1000, 9999);

        $order_id = $this->insertGetId($order);

        $update_order = array();
        $total_price = 0;

        foreach ($detail as $key => $value) {
            $detail[$key]['order_id'] = $order_id;
            $total_price += $value['price'] * $value['buy_count'];
          
            // 检测活动 修改活动价
        }

        $update_order['price'] = $total_price;

        if ($address_id) {
            $address = DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->first();
        } else {
            $address = DB::table('user_address')->where('user_id', $user_id)->where('is_default', 1)->first();
        }

        if ($address) {
            $update_order['mobile'] = $address->phone;
            $update_order['name'] = $address->name;
            $update_order['address'] = $address->address;
        }

        $this->where('id', $order_id)->update($update_order);

        OrderDetails::insert($detail);

        return $order_id;


    }

    private function _where(&$select, $type) {
        foreach ($type as $key => $value) {
            switch ($key) {
                case 'id':
                    $select->where('orders.id', (int)$value);
                    break;
                case 'user_id':
                    $select->where('orders.user_id', (int)$value);
                    break;
                case 'status':
                    $select->whereIn('orders.status', $value);
                    break;
                case 'mobile':
                    $select->where('orders.mobile', $value);
                    break;
                case 'wx_pay_order':
                    $select->where('orders.wx_pay_order',$value);
                    break;
                case 'name':
                    $select->where('orders.name','like', '%'.$value.'%');
                    break;
            }
        }

    }

    private function _order(&$select, $order) {

        foreach ($order as $key => $value) {
            switch ($key) {
                case 'created_at':
                    $select->orderBy('orders.created_at', $value);
                    break;
            }
        }

    }
   
    //修改状态
    public static  function changestatus($oid,$status){
       $res = DB::update("update orders set status = '".$status."'  where id = ".$oid);
       return $res;
    }
    //统一订单
     public static function create_wxpay($id) {
        $oinfo = DB::table('orders')->where('id',$id)->first();
        if (empty($oinfo)) {
            return array('status'=>false,'msg'=>'没有订单信息');
        }
        $cinfo = DB::table('user')->where('id',$oinfo->user_id)->first();
        if (empty($cinfo) || empty($cinfo->weixin_openid)) {
            return array('status'=>false,'msg'=>'没有用户信息');
        }

        $data = array(
            'oid' => $oinfo->id,
            'out_trade_no' => $oinfo->wx_pay_order,
            'transaction_id' => '',
            'openid' => $cinfo->weixin_openid,
            'body' => $oinfo->title,
            'total_fee' => $oinfo->price * 100,
            'create_time' => date('Y-m-d H:i:s'),
        );
        $jsApiParameters = wxpay::getjsApiParameters($data['out_trade_no'], $data['body'], $data['total_fee'], $data['openid']);
        if (empty($jsApiParameters)) {
            return array('status'=>false,'msg'=>'无法联络到微信支付网关，请稍候再试！');
        }
        $jsObj = json_decode($jsApiParameters, true);
        if (empty($jsObj) || strlen($jsObj['package']) < 20) {
            return array('status'=>false,'msg'=>'无法联络到微信支付网关，请稍候再试！');
        }
        $update_order['status'] = 1;
        $this->where('id', $id)->update($update_order);
        return array('status'=>true,'msg'=>$jsApiParameters);
    }

     public static function checkwxpay($id) {
        $oinfo = $this->where('id',$id)->first();
        //更新状态
        return wxpay::sysorderpaystatus($oinfo->order_id);
    }

    //支付成功修改状态
    public static  function payok($order_id){
        $update_order['status'] = 2;
        $this->where('id', $order_id)->update($update_order);

        try {
            // 发送消息给后台
            Websocket::adminOrderSend($order_id);
        } catch (Exception $e) {
            
        }
        
        //销量添加
        $order = $this->where('id',$order_id)->first();
        $order_detail = DB::table('orders_detail')->where('oid',$order['id'])->get();
        foreach ($order_detail as $key => $value) {
            DB::update("update goods set sale_num = sale_num + ".$value['num']." where id = ".$value['pid']);
        }

    }


}
