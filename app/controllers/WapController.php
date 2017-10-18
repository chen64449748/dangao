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
		}

		$this->shop = $shop;
		View::share('shop', $shop);
	}
}