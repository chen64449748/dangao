<?php 


class WapGoodsController extends WapController
{
	// 所有商品
	function goods()
	{
		return View::make('wap.goods.goods');
	}

	// 购物车
	function cart()
	{
		return View::make('wap.goods.cart');
	}
}