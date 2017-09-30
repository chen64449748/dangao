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
		$price_ids = $this->where('goods_id', $goods_id)->where('is_show', 1)->lists('id');
		
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
		
		return $price;

	}

	// 选择sku方法
	public function getPriceSkuList($goods_id)
	{
		$return_arr = array();
		$price_list = $this->where('goods_id', $goods_id)->where('is_show', 1)->get();
		
		$price_ids = array();

		foreach ($price_list as $p_v) {
			$price_ids[] = $p_v->id;
		}

		if (!$price_ids) {
			throw new Exception("商家未设置规格");
		}


		// 组织可选择项
		// 组合价格 变量
		$return_arr['price_list'] = array();
		$return_arr['can_select'] = array();
		foreach ($price_list as $ddd=> &$value) {
			$sku_value_ids = array();
			$combine_key = '';
			foreach ($value->skuPrices as $k => $v) {
				$sku_value_ids[] = $v->sku_value_id;
				$return_arr['sku'][$v->skuValue->sku_id][$v->sku_value_id]['sku_value'] = $v->skuValue;
				$return_arr['sku'][$v->skuValue->sku_id][$v->sku_value_id]['sku'] = $v->skuValue->sku;
				
				//组合变量 sku_id_value_id_sku_id_value 组合key
				$combine_key .= '_'.$v->skuValue->sku_id.'_'.$v->sku_value_id;
			
				// 归纳可选组合
				$return_arr['can_select'][$value->id][$v->sku_value_id] = array();
			}



			// 每个valueid 组合其他sku的valueid
		
			foreach ($return_arr['can_select'][$value->id] as $t_sku_value_id => $x_v) {
				
				// 循环 现有sku_value_id
				foreach ($value->skuPrices as $k => $v) {
					if ($t_sku_value_id == $v->sku_value_id) {
						// 每个valueid 组合其他sku的valueid
						continue;
					}
					$return_arr['can_select'][$value->id][$t_sku_value_id][] = $v->sku_value_id; 			
				}


			}

			// 做成 每个sku_value_id 可选数组
			$return_arr['select_config'] = array();
			foreach ($return_arr['can_select'] as $csk_price_id => $csv) {
				
				foreach ($csv as $ck_sku_value_id => $cv) {
					if (isset($return_arr['select_config'][$ck_sku_value_id])) {
						$return_arr['select_config'][$ck_sku_value_id] = array_merge($return_arr['select_config'][$ck_sku_value_id], $cv);
					} else {
						$return_arr['select_config'][$ck_sku_value_id] = $cv;
					}
				}
				
			}

			$combine_key = substr($combine_key, 1);
			$return_arr['price_list'][$combine_key] = $value->price;

			$value->sku_value_ids = $sku_value_ids;
		}

		return $return_arr;

	}
}