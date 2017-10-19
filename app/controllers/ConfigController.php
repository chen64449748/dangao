<?php 

class ConfigController extends BaseController
{

	public function configList()
	{
		$skus = Sku::get();
		
		$view_data = array(
			'skus' => $skus,
		);

		return View::make('admin.config.config', $view_data);
	}


	public function skuValueAdd()
	{
		$sku_id = Input::get('sku_id', '');
		$sku_value = Input::get('sku_value', '');

		if (!Sku::find($sku_id)) {
			return Response::json(array('status'=> 0, 'message'=> '没有找到SKU'));
		}

		if (SkuValue::where('value', $sku_value)->first()) {
			return Response::json(array('status'=> 0, 'message'=> '已经存在'.$sku_value));
		}

		$none_value = SkuValue::where('sku_id', $sku_id)->where('value', '无')->first();

		if (!$none_value) {
			SkuValue::insert(array(
				'sku_id' => $sku_id,
				'value' => '无',
			));
		}

		$res = SkuValue::insert(array(
			'sku_id' => $sku_id,
			'value' => $sku_value,
		));

		if ($res) {
			return Response::json(array('status'=> 1, 'message'=> '添加成功', 'sku_value'=> $sku_value));
		} else {
			return Response::json(array('status'=> 0, 'message'=> '添加失败'));
		}


	}

	function skuAdd()
	{
		$sku_name = Input::get('sku_name', '');

		if (!$sku_name) {
			return Response::json(array('status'=> 0, 'message'=> '请填写属性名'));
		}

		if (Sku::where('sku_name', $sku_name)->first()) {
			return Response::json(array('status'=> 0, 'message'=> '已经存在'.$sku_name));
		}

		$res = Sku::insert(array(
			'sku_name' => $sku_name
		));

		if ($res) {
			return Response::json(array('status'=> 1, 'message'=> '添加成功'));
		} else {
			return Response::json(array('status'=> 0, 'message'=> '添加失败'));
		}

	}

	// 店铺设置

	// banner设置
	function adminBanner()
	{
		$banners = Banner::get();

		$view_data = array(
			'banners' => $banners
		);
		return View::make('admin.config.banner', $view_data);
	}


	function adminBannerSave()
	{
		$act = Input::get('act', '');
		$banner_img = Input::get('banner_img');
		$banner_url = Input::get('banner_url');

		if ($banner_url == '') {
			$banner_url = 'javascript:;';
		}

		try {
			switch ($act) {
				case 'add':
					
					Banner::insert(array(
						'banner_img'=> $banner_img,
						'banner_url'=> $banner_url,
						'created_at'=> date('Y-m-d H:i:s'),
					));
					break;
				case 'update':
					
					$data = Input::get('data');

					foreach ($data as $key => $value) {
						if ($value['banner_url'] == '') {
							$value['banner_url'] = 'javascript:;';
						}

						Banner::where('id', $value['banner_id'])->update(array(
							'banner_url'=> $value['banner_url'],
							'banner_img'=> $value['banner_img'],
						));
					}

					break;
				default:
					throw new Exception("参数错误");
					break;
			}
			return Response::json(array('status'=> 1, 'message'=> '修改成功'));
		} catch (Exception $e) {
			return Response::json(array('status'=> 0, 'message'=> '修改失败:'. $e->getMessage()));
		}
	}

	function adminShop()
	{
		$shop = Shop::first();

		if (!$shop) {
			$shop = new StdClass();
			$shop->shop_name = '';
			$shop->shop_phone = '';
			$shop->shop_discrib='';
			$shop->shop_work = '';
			$shop->send_address = '';
			$shop->img_quality = 50;
		}


		$view_data = array(
			'shop' => $shop
		);
		return View::make('admin.config.shop', $view_data);
	}

	function adminShopSave()
	{
		$shop = Shop::first();

		$shop_phone = Input::get('shop_phone');
		$shop_name = Input::get('shop_name');
		$shop_discrib = Input::get('shop_discrib');
		$shop_work = Input::get('shop_work');
		$send_address = Input::get('send_address');
		$img_quality = Input::get('img_quality');

		$shop_discrib = trim($shop_discrib);
		
		if (!$shop_phone || !$shop_name) {
			return Response::json(array('status'=> 0, 'message'=> '店铺名和手机号必填'));
		}

		if (!$img_quality) {
			$img_quality = 50;
		}

		if (!$shop) {

			Shop::insert(array(
				'shop_phone'=> $shop_phone,
				'shop_name' => $shop_name,
				'shop_discrib'=>$shop_discrib,
				'shop_work' => $shop_work,
				'send_address' => $send_address,
				'created_at' => date('Y-m-d H:i:s'),
				'img_quality' => $img_quality,
			));

		} else {
			Shop::where('id', $shop->id)->update(array(
				'shop_name' => $shop_name,
				'shop_phone' => $shop_phone,
				'shop_discrib'=>$shop_discrib,
				'shop_work' => $shop_work,
				'send_address' => $send_address,
				'img_quality' => $img_quality,
			));
		}

		return Response::json(array('status'=> 1, 'message'=> '保存成功'));
	}

}