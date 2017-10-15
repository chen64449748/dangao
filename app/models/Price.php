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

	public function getRealPrice()
	{
		if ($this->goods->is_active == 1) {
			return Active::getPrice($this->price);
		} else {
			return $this->price;
		}
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

		$all_sku_value_ids = array();
		foreach ($price_list as $ddd=> &$value) {
			$sku_value_ids = array();
			$combine_key = '';
			foreach ($value->skuPrices as $k => $v) {
				$sku_value_ids[] = $v->sku_value_id;
				$all_sku_value_ids[] = $v->sku_value_id;
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

			$combine_key = substr($combine_key, 1);
			// 读取是否有活动{}

			$return_arr['price_list'][$combine_key] = $value->goods->is_active == 1 ? $value->getRealPrice($value->price) : $value->price;

			$value->sku_value_ids = $sku_value_ids;
		}


		// 读取所有组合
		$values = SkuValue::select('sku_value.*')->whereIn('sku_value.id', $all_sku_value_ids)->join('sku', 'sku.id', '=', 'sku_value.sku_id')->orderBy('sku.id', 'asc')->where('value', '<>', '无')->get();
		$combine_values = array();

		foreach ($values as $key => $value) {
			$combine_values[$value->sku_id][] = $value->id; // 排列组合用 数组
		}
		$combine_values = array_values($combine_values);

		function combine_sku($arr, $index, $max_index, $tmp_arr, &$t_arr)
		{
			foreach ($arr[$index] as $v) {
				if ($index < $max_index - 1) {
					$tmp_arr[$index] = $v;
					combine_sku($arr, $index + 1, $max_index, $tmp_arr, $t_arr);
				} else {
					$tmp_arr[$index] = $v;
					array_push($t_arr, $tmp_arr);
				}
			}
		}

		$all_arr = array();
		$tmp_arr = array();
		combine_sku($combine_values, 0, count($combine_values), $tmp_arr, $all_arr);

		$cont_select = array();
		
		foreach ($all_arr as $ak => $av) {
			$flag = 0; // 是否存在

			foreach ($return_arr['can_select'] as $ck => $cv) {

				foreach ($cv as $sku_k => $sku_v) {
					array_push($sku_v, $sku_k);
					$diff = array_diff($av, $sku_v);
					if (!$diff) {
						$flag = 1;
					}
				}
			}

			if ($flag == 0) {
				// 不存在
				$cont_select[] = $av;
			}
		}

		$return_arr['cont_select'] = $cont_select;

		return $return_arr;

	}
}