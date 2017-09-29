<?php 


/**
* 
*/
class WapCartController extends WapController
{

	// 购物车
	function cart()
	{	
		$view_data = array(
			'active' => 'cart',
		);
		return View::make('wap.goods.cart', $view_data);
	}

	function goodsAddCart()
	{
		// user_id session

		$user_id = Session::get('user_id');

		$goods_id = Input::get('goods_id', '');
		$sku_value_ids = Input::get('sku_value_ids', '');
		$count = Input::get('count', '');
		// [
		// 	goods_id : [skuid]
		// ]
		DB::beginTransaction();
		try {

			if (!is_numeric($count)) {
				throw new Exception("数量必须为数字");
			}

			if ($count < 1) {
				throw new Exception("至少买一个");
			}

			$cart_m = new Cart();
			$cart_m->addCart($user_id, $goods_id, $sku_value_ids, $count);

			DB::commit();
			return Response::json(array('status'=> 1, 'message'=> '添加成功'));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> '添加失败'. $e->getMessage()));
		}

	}
}