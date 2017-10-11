<?php 

/**
* 
*/
class WapOrderController extends WapController
{
	function buy($order_id)
	{

		$user_id = Session::get('user_id');
		$address_id = Input::get('address_id', '');

		// 如果有id 修改
		if ($address_id) {
			try {
				$address = DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->first();
				$address && Orders::where('user_id', $user_id)->where('id', $order_id)->update(array(
					'name'=> $address->name,
					'mobile' => $address->phone,
					'address' => $address->address,
				));
			} catch (Exception $e) {
				
			}
		}

		$order_m = new Orders();
		$order_detail_m = new OrderDetails();

		$type = array('id'=> $order_id);
		$d_type = array('order_id'=> $order_id);

		$order = $order_m->getList($type);

		if (!isset($order[0])) {
			return Redirect::route('/');
		}

		$order_detail = $order_detail_m->getList($d_type);

		$total_price = 0;

		foreach ($order_detail as $value) {
			$total_price += $value->price * $value->buy_count;
		}

		$view_data = array(
			'order' => $order[0],
			'order_detail' => $order_detail,
			'total_price' => $total_price,
		);

		return View::make('wap.order.buy', $view_data);
	}

	function addressSelect($order_id)
	{
		$user_id = Session::get('user_id');

		$order_m = new Orders();

		$type = array('id'=> $order_id);
		$order = $order_m->getList($type);

		if (!isset($order[0])) {
			return Redirect::route('/');
		}

		$addresses = DB::table('user_address')->where('user_id', $user_id)->get();

		$view_data = array(
			'order_id' => $order_id,
			'addresses' => $addresses,
		);

		return View::make('wap.order.address', $view_data);

	}
}