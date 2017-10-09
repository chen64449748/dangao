<?php 


/**
* 
*/
class WapCartController extends WapController
{

	// 购物车
	function cart()
	{	
		$user_id = Session::get('user_id');
		$cart_m = new Cart();
		$type = array('user_id'=> $user_id);

		$carts = $cart_m->gets($type, array(), 0, 0);

		$view_data = array(
			'active' => 'cart',
			'carts' => $carts,
		);
		return View::make('wap.goods.cart', $view_data);
	}

	// 获取sku选择属性

	function getSkuSelect()
	{
		$goods_id = Input::get('goods_id', '');

		$goods = Goods::find($goods_id);
		try {
			
			if (!$goods) {
				throw new Exception("没有找到该商品");
			}

			$price_m = new Price();

			$return = array(
				'goods'=> $goods,
			);

			$sku_prices = $price_m->getPriceSkuList($goods_id);
			$return['sku_prices'] = $sku_prices;

			return Response::json(array('status'=> 1, 'data'=> $return));

		} catch (Exception $e) {
			echo $e->getMessage();
		}
		
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
			$act = $cart_m->addCart($user_id, $goods_id, $sku_value_ids, $count);

			DB::commit();
			return Response::json(array('status'=> 1, 'message'=> '添加成功', 'act'=> $act));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> '添加失败'));
		}

	}

	function cartCount()
	{
		$count = Input::get('count', '');
		$cart_id = Input::get('cart_id', '');
		$user_id = Session::get('user_id');

		DB::beginTransaction();
		try {
			
			if (!is_numeric($count)) {
				throw new Exception("数量必须为数字");
			}
			Cart::where('id', $cart_id)->where('user_id', $user_id)->update(array('count'=> $count));

			DB::commit();
			return Response::json(array('status'=> 1));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> '修改失败,请重试'.$e->getMessage()));
		}
		


	}

	function cartDelete()
	{
		$user_id = Session::get('user_id');
		$cart_id = Input::get('cart_id', '');

		if (!is_array($cart_id)) {
			$cart_id = array($cart_id);
		}

		DB::beginTransaction();
		try {
			
			if (!$cart_id) {
				throw new Exception("购物车ID缺失，请重试");
			}

			Cart::whereIn('id', $cart_id)->where('user_id', $user_id)->delete();

			DB::commit();
			return Response::json(array('status'=> 1));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> '删除失败,请重试'));
		}
	}
}