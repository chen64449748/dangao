<?php 

/**
* 
*/
class Shop extends Eloquent
{
	protected $table = 'shop';

	static function get()
	{
		$shop = Shop::first();
		if (!$shop) {
			$shop = new StdClass();
			$shop->shop_name = '';
			$shop->shop_phone = '';
		}

		return $shop;
	}
}