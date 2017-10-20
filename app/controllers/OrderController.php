<?php
class OrderController extends BaseController
{
    public function orders() {
        $mobile = Input::get('mobile', '');
        $wx_pay_order = Input::get('wx_pay_order', '');
        $name = Input::get('name', '');
        $status = Input::get('status', '');

        $status_arr = array(
            'waiting' => array(0, 1),
            'paying' => array(1),
            'payed' => array(2),
            'close' => array(3),
            'ok' => array(4),
        );

        $type = array();
        $name && $type['name'] = $name;
        $mobile && $type['mobile'] = $mobile;
        $wx_pay_order && $type['wx_pay_order'] = $wx_pay_order;
        isset($status_arr[$status]) && $type['status'] = $status_arr[$status];


        $order_m = new Orders(); 
        $orders = $order_m->getListPage($type,15);

        $append = array(
            'mobile'=>$mobile,
            'wx_pay_order'=>$wx_pay_order,
            'name'=>$name,
            'status' => $status,
        );
        $orders->appends($append);
        $view_data = array(
            'orders' => $orders,
            'mobile'=>$mobile,
            'wx_pay_order'=>$wx_pay_order,
            'name'=>$name,
            'status' => $status,
        );

        

        
        return View::make('admin.order.list', $view_data);
    }

    public function order_detail() {
        $oid = Input::get('oid');
        $orderslist = DB::table('orders_detail')->join('goods',function($join){
            $join->on('orders_detail.goods_id', '=', 'goods.id');  
        })->select('orders_detail.*','goods.goods_img','goods.goods_title')->where('orders_detail.order_id',$oid)->get();
        // dd($orderslist);
        $view_data = array(
            'order_detail' => $orderslist,
        );
        return View::make('admin.order.detail', $view_data);
    }

}