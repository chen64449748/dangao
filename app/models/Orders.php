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
        $cinfo = DB::table('user')->where('id',$oinfo['uid'])->first();
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
        if (empty($jsApiParameters)) {
            return array('status'=>flase,'msg'=>'无法联络到微信支付网关，请稍候再试！');
        }
        $jsObj = json_decode($jsApiParameters, true);
        if (empty($jsObj) || strlen($jsObj['package']) < 20) {
            return array('status'=>flase,'msg'=>'无法联络到微信支付网关，请稍候再试！');
        }
        $update_order['status'] = 1;
        $this->where('id', $id)->update($update_order);
        return array('status'=>true,'msg'=>$jsApiParameters);
    }

     public static function checkwxpay($id) {
        $oinfo = $this->where('id',$id)->first();
        //更新状态
        return wxpay::sysorderpaystatus($oinfo['order_id']);
    }

    //支付成功修改状态
    public static  function payok($order_id){
        $update_order['status'] = 2;
        $this->where('order_id', $order_id)->update($update_order);
        //销量添加
        $order = $this->where('order_id',$order_id)->first();
        $order_detail = DB::table('orders_detail')->where('oid',$order['id'])->get();
        foreach ($order_detail as $key => $value) {
            DB::update("update goods set sale_num = sale_num + ".$value['num']." where id = ".$value['pid']);
        }

    }


    /*
    <script type="text/javascript">
    var jsApiParameters='';
    $('#submit_order').click(function(){
        $.post('/order/wxpay', {id:id}, function (data) {
            if (data.status) {
                jsApiParameters=v.data;
                wxpay();
            }else{
                alert(data.msg);return;
            }
        });
    });
    function wxpay(){
        if(typeof WeixinJSBridge != "undefined"){
            wxpayConditionComplete();
        }else{
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', wxpayConditionComplete, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', wxpayConditionComplete);
                document.attachEvent('onWeixinJSBridgeReady', wxpayConditionComplete);
            }
        }
    }   
    //防止页面没有加载完成启动微信支付
    function wxpayConditionComplete(){
        if(typeof window._WXPAY_COUNTER == 'undefined'){
            window._WXPAY_COUNTER = 2;
        }
        window._WXPAY_COUNTER = window._WXPAY_COUNTER - 1;
        if(window._WXPAY_COUNTER <= 0 && jsApiParameters != ''){
            window.setTimeout(jsApiCall,0);
        }
    }
    function jsApiCall()
    {
        $("#submit_order").html("支付中");
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            eval("("+jsApiParameters+")"),
            function(res){
                jsApiParameters="";

                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    var whenpayok=function(){
                       $('.shares').show();
                                    // window.location.href="/activity_group/detail?oid="+group_oid;
                    };
                    isruning=true;
                    $("#submit_order").html("确认中").addClass("buttondisabled");
                    $.post('/order/wxpay', {id:id}, function (data) {
                            whenpayok();
                    });

                }else{
                    isruning=false;
                    $("#submit_order").html("支付").removeClass("buttondisabled");
                }
            }
        );
    }
</script>
    */
}
