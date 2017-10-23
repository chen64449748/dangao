<?php

class WapController extends BaseController
{
	protected $shop;

	function __construct()
	{
		Session::put('user_id', 1);
		$shop = Shop::get();
		if (!$shop) {
			$shop = new StdClass();
			$shop->shop_name = '';
			$shop->shop_phone = '';
			$shop->shop_discrib='';
			$shop->shop_work = '';
			$shop->send_address = '';
			$shop->img_quality = 50;
			$shop->appid = '';
			$shop->token = '';
			$shop->appsecret = '';
		}
		Session::put('appid',$shop->appid);
		Session::put('token',$shop->token);
		Session::put('appsecret',$shop->appsecret);
		$this->shop = $shop;
		View::share('shop', $shop);
	}
}