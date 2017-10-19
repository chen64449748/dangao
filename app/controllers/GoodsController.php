<?php 

class GoodsController extends BaseController
{

	public function goodsList()
	{
		$goods_m = new Goods();
		$type = array();

		$id = Input::get('id', '');

		$goods_id = Input::get('goods_id', '');
		$goods_title = Input::get('goods_title', '');
		$category_id = Input::get('category_id');
		$is_active = Input::get('is_active', '');
		$is_onsale = Input::get('is_onsale', '');
		$is_hot = Input::get('is_onsale', '');

		$id && $type['id'] = $id;
		$goods_id && $type['id'] = $goods_id;
		$goods_title && $type['goods_title'] = $goods_title;
		$category_id && $type['category_id'] = $category_id;

		if ($is_active !== '') {
			$type['is_active'] = $is_active;
		}

		if ($is_onsale !== '') {
			$type['is_onsale'] = $is_onsale;
		}

		if ($is_hot !== '') {
			$type['is_hot'] = $is_hot;
		}

		$goods = $goods_m->getListPage($type);

		$categorys = Category::get();

		$view_data = array(
			'goods' => $goods,
			'categorys' => $categorys,
			'goods_id' => $goods_id,
			'goods_title' => $goods_title,
			'category_id' => $category_id,
			'is_hot' => $is_hot,
			'is_onsale' => $is_onsale,
			'is_active' => $is_active,
		);

		$append = array(
			'goods_id' => $goods_id,
			'goods_title' => $goods_title,
			'category_id' => $category_id,
			'is_hot' => $is_hot,
			'is_onsale' => $is_onsale,
			'is_active' => $is_active,
		);

		$goods->appends($append);

		return View::make('admin.goods.list', $view_data);
	}

	function goodsAdd()
	{
		$skus = Sku::get();

		$view_data = array(
			'skus'=> $skus,
		);

		return View::make('admin.goods.add', $view_data);
	}

	// 获取发货单
	function goodsAddOrder()
	{
		$skus = Sku::get();
		$categorys = Category::where('pid', 0)->get();

		$view_data = array(
			'skus' => $skus,
			'categorys' => $categorys,
		);

		return View::make('admin.goods.order', $view_data);
	}
	// 修改推荐 
	function goodsAttr()
	{
		$goods_id = Input::get('goods_id');
		$act = Input::get('act', '');
		$goods = Goods::find($goods_id);
		
		switch ($act) {
			case 'hot':
				if ($goods->is_hot) {
					Goods::where('id', $goods_id)->update(array('is_hot'=> 0));
				} else {
					Goods::where('id', $goods_id)->update(array('is_hot'=> 1));
				}

				break;
			case 'onsale':
				if ($goods->is_onsale) {
					Goods::where('id', $goods_id)->update(array('is_onsale'=> 0));
				} else {
					Goods::where('id', $goods_id)->update(array('is_onsale'=> 1));
				}
				break;
			case 'active':
				if ($goods->is_active) {
					Goods::where('id', $goods_id)->update(array('is_active'=> 0));
				} else {
					Goods::where('id', $goods_id)->update(array('is_active'=> 1));
				}
				break;
			default:
				return Response::json(array('status'=> 0, 'message'=> '参数错误'));
				break;
		}
		
		return Response::json(array('status'=> 1, 'message'=> '修改成功'));
	}

	// 获取关联sku价格库存
	function goodsSkuGet()
	{
		$sku_value_ids = Input::get('sku_value_ids', ''); // array
		$goods_id = Input::get('goods_id', '');

		$values = SkuValue::select('sku_value.*')->whereIn('sku_value.id', $sku_value_ids)->join('sku', 'sku.id', '=', 'sku_value.sku_id')->orderBy('sku.id', 'asc')->where('value', '<>', '无')->get();// 为了让第一个属性排前面

		if (!$values->toArray()) {
			return 1;
		}

		$sku_name = array(); // 表头用
		$combine_values = array(); // 排列组合用
		$sku_values = array(); // 对照id取值用

		foreach ($values as $key => $value) {
			$sku_name[$value->sku->sku_name] = $value->sku->sku_name; // 用来当表头读取
			$combine_values[$value->sku_id][] = $value->id; // 排列组合用 数组
			$sku_values[$value->id] = $value; // 为了把id替换成对象
		}

		$combine_values = array_values($combine_values);

		// 排列组合
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
		
		// 如果有goods
		$goods_price_arr = array();
		if ($goods_id) {

			$prices = Price::where('goods_id', $goods_id)->get();

			$price_ids = array();	
			foreach ($prices as $p_k => $p_v) {
				$price_ids[] = $p_v->id; 
			}

			if ($price_ids) {
				$goods_prices = SkuPrice::whereIn('price_id', $price_ids)->get(); // 里面关联了库存

				foreach ($goods_prices as $gpk => $gpv) {
					$goods_price_arr[$gpv->price_id][] = $gpv;
				}
			}
		}

		// [
		// 		ak1 => {price, stock}
		// ]

		// 把每种结果的 id值变成对象 方便前台访问
		foreach ($all_arr as $ak => $av) {
			$all_arr[$ak] = array();
			foreach ($av as $ik => $iv) {
				$all_arr[$ak]['value'][$ik] = $sku_values[$iv];
			}
		}

		// 给表格配值 如果有值
		if ($goods_price_arr) {
			foreach ($goods_price_arr as $gp_k => $gp_v) {
				$pz_price = array();
				foreach ($gp_v as $g_p_k => $g_p_v) {
					$pz_price[] = $g_p_v->sku_value_id;
				}

				// 读取每种配置 如果是再里面的赋值 break
				foreach ($all_arr as $ak => &$av) {
					// av 为每行
					$is_in = false;
					foreach ($av['value'] as $ik => $iv) {
						if (in_array($iv->id, $pz_price)) {
							$is_in = true;
						} else {
							$is_in = false;
							break;
						}
					}

					//如果在里面
					if ($is_in) {
						if ($gp_v[0]->price->is_show) {
							$av['sku_price']['price'] = $gp_v[0]->price->price; // 由于用于读取 price 和 stock  两个值读取都一样既取第一个
						}
						
						if ($gp_v[0]->price->stock->is_show) {
							$av['sku_price']['stock'] = $gp_v[0]->price->stock->stock; // 由于用于读取 price 和 stock  两个值读取都一样既取第一个
						}

						$av['sku_price']['price_id'] = $gp_v[0]->price->id; // 填写id在页面 修改时判断是否有这个价格 有就修改 没有添加
						break;
					}

				}

			}
		}
		

		// 测试读取第一行
		// print_r($all_arr[0]['sku_price']);exit;


		// $all_arr 为最终组合结果
		$combine_values = $all_arr;

		$view_data = array(
			'sku_name' => $sku_name,
			'combine_values' => $combine_values,
		);
		return View::make('admin.goods.goodsSku', $view_data);
	}

	

	function goodsAddData()
	{

		$data = Input::get('data');
		$goods_m = new Goods();
		$goods_data = $data['goods'];

		DB::beginTransaction();
		try {
			
			$result = $goods_m->add($goods_data);

			DB::commit();
			return Response::json(array('status'=> 1, 'message'=> '添加成功', 'result'=> $result));

		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> $e->getMessage()));
		}


	}

	function goodsDetail()
	{
		$id = Input::get('id', '');

		$goods_m = new Goods();
		$goods = $goods_m->fetch(array('id'=> $id));

		$goods_content = GoodsContent::where('goods_id', $goods->id)->first();

		if (!$goods) {
			return Redirect::to('goods/list');
		}

		$skus = Sku::get();
		$sku_value_ids = GoodsSku::getGoodsSkuIds($goods->id);

		$categorys = Category::where('pid', 0)->get();
		$view_data = array(
			'goods' => $goods,
			'skus' => $skus,
			'sku_value_ids' => $sku_value_ids,
			'categorys' => $categorys,
			'goods_content' => $goods_content,
		);

		return View::make('admin.goods.detail', $view_data);
	}

	function goodsDetailUpdate()
	{
		$goods_id = Input::get('goods_id', '');
		$goods_data = Input::get('goods', '');

		$goods_m = new Goods();
		DB::beginTransaction();
		try {
			$goods_m->goodsUpdate($goods_data, $goods_id);
			
			DB::commit();
			return Response::json(array('status'=> 1, 'message'=> '修改成功'));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> '修改失败：'.$e->getMessage()));
		}
		

	}

	function goodsGet()
	{
		$company_sign_id = Input::get('company_sign_id', '');
		$company_id = Input::get('company_id', '');

		$goods_m = new Goods();
		$type = array();

		$company_sign_id && $type['company_sign_id'] = $company_sign_id;
		$company_id && $type['company_id'] = $company_id;

		$goods = $goods_m->getList($type);
		return Response::json($goods);

	}

	function skuPriceGet()
	{
		$goods_id = Input::get('goods_id', '');

		$prices = Price::where('goods_id', $goods_id)->where('is_show', 1)->get();

		$return = array();

		foreach ($prices as $price) {
			
			$add_arr = array();
			$add_arr['price_id'] = $price->id;
			$add_arr['stock'] = $price->stock->stock;
			$add_arr['text'] = '价格:'.$price->price.'元|库存:'.$price->stock->stock.'|';

			foreach ($price->skuPrices as $sku_price) {
				$add_arr['text'] .= ' '.$sku_price->skuValue->value;
			}

			array_push($return, $add_arr);
		}

		return Response::json($return);
	}

	// 读取没有关联的SKU
	function getOrderSku()
	{
		$goods_id = Input::get('goods_id', '');

		$skus = Sku::get();
		$goods_skus = GoodsSku::getGoodsSkus($goods_id);
		foreach ($goods_skus as $key => $value) {
			foreach ($skus as $k => $v) {
				if ($value->skuValue->sku_id == $v->id) {
					unset($skus[$k]);
				}
			}
		}

		foreach ($skus as $ky => $val) {
			$skus[$ky]->skuValues = $val->skuValues;
		}

		return Response::json($skus);
	}


	// 产品图片上传
	function  imageUpload()
	{
		$file = Input::file('img');
		$dir = Input::get('dir', '');
		$upload_dir = './upload';

		try {

			if (!Input::hasFile('img')) {
				throw new Exception("没有上传文件");
			}

			if ($dir) {
				$upload_dir .= '/'.trim($dir, '/');
			}
			$ext = $file->getClientOriginalExtension();

			$file_name = date('YmdHis').uniqid().'.'.trim($ext);

			$file->move($upload_dir, $file_name);

			$web_dir = ltrim($upload_dir, '.');

			$image = new Imagick();
			$image->setImageCompressionQuality(70);

			return Response::json(array('status'=> 1, 'url'=> $web_dir.'/'.$file_name));
		} catch (Exception $e) {
			return Response::json(array('status'=> 0, 'message'=> '上传失败:'.$e->getMessage()));
		}
		

		

	}
}