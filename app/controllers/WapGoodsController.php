<?php 


class WapGoodsController extends WapController
{
	// 所有商品
	function goods()
	{
		$view_data = array(
			'active' => 'goods',
		);
		return View::make('wap.goods.goods', $view_data);
	}

	// 商品详情
	function detail()
	{

		return View::make('wap.goods.detail');
	}

	// 购物车
	function cart()
	{	
		$view_data = array(
			'active' => 'cart',
		);
		return View::make('wap.goods.cart', $view_data);
	}
}