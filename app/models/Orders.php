<?php 

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Orders extends Eloquent
{
    protected $table = 'orders';

    public function order_detail()
  {
    return $this->hasOne('orders_detail','oid', 'id');
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
        $order['wx_pay_order'] = MD5(date('YmdHis').uniqid($user_id));

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
                // dd($value);
                    $select->whereIn('orders.status', $value);
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

    //统一订单
     public static function create_wxpay($id) {
        $oinfo =  $this->where('id', $id)->first();
        if (empty($oinfo)) {
            return array('status'=>flase,'msg'=>'没有订单信息');
        }
        $cinfo = DB::getRow('select weixin_openid from customer where id=' . intval($oinfo['cid']));
        if (empty($cinfo) || empty($cinfo['weixin_openid'])) {
            return array('status'=>flase,'msg'=>'没有用户信息');
        }

        $data = array(
            'oid' => $oinfo['id'],
            'out_trade_no' => $oinfo['out_id'],
            'transaction_id' => '',
            'openid' => $cinfo['weixin_openid'],
            'body' => $oinfo['title'],
            'total_fee' => $oinfo['payment'] * 100,
            'create_time' => date('Y-m-d H:i:s'),
        );
        $jsApiParameters = wxpay::getjsApiParameters($data['out_trade_no'], $data['body'], $data['total_fee'], $data['openid']);
        //Logs::write($jsApiParameters);
        if (empty($jsApiParameters)) {
            return M(false, '无法联络到微信支付网关，请稍候再试！1');
        }
        $jsObj = json_decode($jsApiParameters, true);
        if (empty($jsObj) || strlen($jsObj['package']) < 20) {
            return M(false, '无法联络到微信支付网关，请稍候再试！2');
        }
        return M(true, $jsApiParameters);
    }
}
