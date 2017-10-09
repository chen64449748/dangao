<?php 

/**
* 
*/
class Cart extends Eloquent
{
	protected $table = 'cart';

	public function goods()
	{
		return $this->belongsTo('Goods', 'goods_id', 'id');
	}

	public function price()
	{
		return $this->belongsTo('Price', 'price_id', 'id');
	}

	function gets($type = array(), $order = array(), $offset = 0, $limit = 20)
	{
		$select = $this->select(array('cart.*'));

		$this->_where($select, $type);

		$this->_order($select, $order);
	
		if ($limit > 0) {
			$select->skip($offset)->take($limit);
		}
		
		return $select->get();
	}

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
			return 'update';
		} else {
			$cart_id = Cart::insertGetId($cart_insert);	
			return 'add';
		}
	}

	private function _order(&$select, $order) {

		foreach ($order as $key => $value) {
			switch ($key) {
				case 'created_at':
					$select->orderBy('cart.created_at', $value);
					break;
			}
		}

	}

	private function _where(&$select, $type) {

		foreach ($type as $key => $value) {
			switch ($key) {
				case 'id':
					$select->where('cart.id', (int)$value);
					break;
				case 'goods_id':
					$select->where('cart.goods_id', (int)$value);
					break;
				case 'user_id':
					$select->where('cart.user_id', (int)$value);
					break;
			}
		}

	}
}