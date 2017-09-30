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
		$price_m = new Price();
		$price = $price_m->getPrice($goods_id, $sku_value_ids);

		// 添加购物车
		$cart_insert = array(
			'user_id' => $user_id,
			'goods_id' => $goods_id,
			'count' => $count,
			'created_at' => date('Y-m-d H:i:s'),
			'price_id' => $price->id,
		);


		$cart = $this->where('user_id', $user_id)->where('price_id', $price->id)->where('goods_id', $goods_id)->first();
		
		if ($cart) {
			$this->where('id', $cart->id)->increment('count', $count);
		} else {
			$cart_id = Cart::insertGetId($cart_insert);	
		}
	}
}