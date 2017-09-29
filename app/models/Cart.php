<?php 

/**
* 
*/
class Cart extends Eloquent
{
	protected $table = 'cart';

	// 添加购物车
	function  addCart($user_id, $goods_id, $sku_value_ids, $count)
	{
		$goods = Goods::find($goods_id);

		if (!$goods) {
			throw new Exception("没有找到商品");
		}
		// 检测是否有这个组合 sku
		Price::getPrice($goods_id, $sku_value_ids);

		// 添加购物车
		$cart_insert = array(
			'user_id' => $user_id,
			'goods_id' => $goods_id,
			'count' => $count,
			'created_at' => date('Y-m-d H:i:s'),
		);

		$cart_id = Cart::insertGetId($cart_insert);

		$cart_sku_insert = array();

		foreach ($sku_value_ids as $key => $value) {
			$cart_sku_insert[$key]['goods_id'] = $goods_id;
			$cart_sku_insert[$key]['sku_value_id'] = $goods_id;
			$cart_sku_insert[$key]['created_at'] = date('Y-m-d H:i:s');
		}

		CaetSku::insert($cart_sku_insert);


	}
}