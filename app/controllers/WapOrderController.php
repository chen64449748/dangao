<?php 

/**
* 
*/
class WapOrderController extends WapController
{
	function buy()
	{

		$order_id = Input::get('order_id');

		$view_data = array();

		return View::make('wap.order.buy', $view_data);
	}
}