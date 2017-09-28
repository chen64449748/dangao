<?php 


class Price extends Eloquent
{
	protected $table = 'price';

	public function skuPrices()
	{
		return $this->hasMany('SkuPrice', 'price_id', 'id');
	}

	public function stock()
	{
		return $this->hasOne('Stock', 'price_id', 'id');
	}

	public function goods()
	{
		return $this->belongsTo('Goods', 'goods_id', 'id');
	}

	public function getPrice($goods_id, $sku_value_ids)
	{
		$price_ids = $this->where('goods_id', $goods_id)->lists('id');
		
		if (!$price_ids) {
			throw new Exception("没有找到该组合，请重试");
		}

		$sku_prices = SkuPrice::whereIn('sku_value_id', $sku_value_ids)->whereIn('price_id', $price_ids)->get();
		
		$price_arr = array();
		foreach ($sku_prices as $value) {
			$price_arr[$value['price_id']][] = $value['sku_value_id'];
		}
		
		$price_id = '';

		foreach ($price_arr as $key => $val) {
			if (count($sku_value_ids) == count($val)) {
				$price_id = $key;
			}
		}

		if ($price_id == '') {
			throw new Exception("没有找到该组合，请重试");
		}

		$price = $this->find($price_id);

		// 检测活动
		
		return $price->price;

	}
}