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

}