<?php
class OrderController extends BaseController
{
    public function orders() {
        $orders = new Orders(); 
        $orderslist = $orders->getListPage();
        $view_data = array(
            'orders' => $orderslist,
        );
        return View::make('admin.order.list', $view_data);
    }

    public function order_detail() {
        $oid = Input::get('oid');
        // $order = new Order(); 
        // $orderslist = $order->getList($oid);
       $orderslist =  DB::table('orders_detail')->where('oid',$oid)->get();
        $view_data = array(
            'order_detail' => $orderslist,
        );
        return View::make('admin.order.detail', $view_data);
    }

}