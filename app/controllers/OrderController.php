<?php
class OrderController extends BaseController
{
    public function orders() {
        $mobile = Input::get('mobile', '');
        $wx_pay_order = Input::get('wx_pay_order', '');
        $name = Input::get('name', '');
        $type = array();
        $name && $type['name'] = $name;
        $mobile && $type['mobile'] = $mobile;
        $wx_pay_order && $type['wx_pay_order'] = $wx_pay_order;
        $orders = new Orders(); 
        $orderslist = $orders->getListPage($type);
        $view_data = array(
            'orders' => $orderslist,
            'mobile'=>$mobile,
            'wx_pay_order'=>$wx_pay_order,
            'name'=>$name
        );

        $append = array(
            'mobile'=>$mobile,
            'wx_pay_order'=>$wx_pay_order,
            'name'=>$name
        );

        // $orders->appends($append);
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