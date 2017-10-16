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
		

		if ($order[0]->status !== 0 && $order[0]->status != 1) {
			return Redirect::route('user.orders');
		}

		$order_detail = $order_detail_m->getList($d_type);

		$total_price = 0;
		$old_total_price = 0;
		foreach ($order_detail as $value) {
			$total_price += $value->price * $value->buy_count;
			$old_total_price += $value->old_price * $value->buy_count; 
		}

		$view_data = array(
			'order' => $order[0],
			'order_detail' => $order_detail,
			'total_price' => $total_price,
			'old_total_price' => $old_total_price,
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

	public function wxpay(){
        $id=isset($_POST['id'])?intval($_POST['id']):0;
        $re=Orders::create_wxpay($id);
        dd($re);
        return Response::json($re);
        // echo json_encode($re);
    }
	function orderStatusUpdate()
	{
		$user_id = Session::get('user_id');
		$order_m = new Orders();

		$status = Input::get('status');
		$order_id = Input::get('order_id');

		DB::beginTransaction();
		try {
			switch ($status) {
				case 'cancel':
					$order = $order_m->find($order_id);
					
					if (!$order) {
						throw new Exception("没有找到订单");
					}

					if ($order->status != 0 && $order->status != 1) {
						throw new Exception("订单不可修改，请联系商家取消");
					}

					if ($order->pay == 1) {
						throw new Exception("订单已支付，请联系商家取消");
					}

					$order_m->where('id', $order->id)->update(array(
						'status' => 3,
					));

					break;
				
				default:
					throw new Exception("参数错误");
					break;
			}

			DB::commit();
			return Response::json(array('status'=> 1, 'message'=> '修改成功'));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> $e->getMessage()));
		}
		
	}
}