<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', array('as'=> '/', 'uses'=> 'WapIndexController@index'));
Route::get('goods', array('as'=> 'goods', 'uses'=> 'WapGoodsController@goods'));
Route::get('cart', array('as'=> 'cart', 'uses'=> 'WapGoodsController@cart'));

// Route::group(array('before'=> 'login'), function() {
	

	// 货品
	Route::get('goods/list', array('as'=> 'goods.list', 'uses'=> 'GoodsController@goodsList'));
	Route::post('goods/get', array('as'=> 'goods.list', 'uses'=> 'GoodsController@goodsGet'));
	Route::get('goods/add', array('as'=> 'goods.add', 'uses'=> 'GoodsController@goodsAdd'));
	Route::post('goods/add/data', array('as'=> 'goods.add.data', 'uses'=> 'GoodsController@goodsAddData'));
	Route::post('goods/add/order', array('as'=> 'goods.add.order', 'uses'=> 'GoodsController@goodsAddOrder'));
	Route::get('goods/detail', array('as'=> 'goods.detail', 'uses'=> 'GoodsController@goodsDetail'));
	Route::post('goods/detail/update', array('as'=> 'goods.detail.update', 'uses'=> 'GoodsController@goodsDetailUpdate'));
	Route::post('goods/sku/get', array('as'=> 'goods.sku.get', 'uses'=> 'GoodsController@goodsSkuGet'));
	Route::any('sku/price/get', array('as'=> 'sku.price.get', 'uses'=> 'GoodsController@skuPriceGet'));
	Route::post('get/order/sku', array('as'=> 'get/order/sku', 'uses'=> 'GoodsController@getOrderSku'));// 获取没有关联的SKU
	// 属性
	Route::get('config/list', array('as'=> 'config.list', 'uses'=> 'ConfigController@configList'));
	Route::post('config/sku/value/add', array('as'=> 'config.sku.value.add', 'uses'=> 'ConfigController@skuValueAdd'));
	Route::post('config/sku/add', array('as'=> 'config.sku.add', 'uses'=> 'ConfigController@skuAdd'));


	// 库存
	Route::get('stock/order/list', array('as'=> 'stock.order.list', 'uses'=> 'StockController@stockOrderList'));
	Route::get('stock/add', array('as'=> 'stock.order', 'uses'=> 'StockController@stockAdd'));
	Route::post('stock/order/data', array('as'=> 'stock.order.data', 'uses'=> 'StockController@stockOrderData'));
	Route::post('stock/order/get', array('as'=> 'stock.order', 'uses'=> 'StockController@stockOrderGet'));
	Route::get('stock/order/detail', array('as'=> 'stock.order.detail', 'uses'=> 'StockController@stockOrderDetail'));
	Route::post('stock/order/detail/data', array('as'=> 'stock.order.detail.data', 'uses'=> 'StockController@stockOrderDetailData'));
	Route::post('stock/finance/add', array('as'=> 'stock.finance.add', 'uses'=> 'StockController@addFinance'));
	Route::post('stock/finance/add/day', array('as'=> 'stock.finance.add.day', 'uses'=> 'StockController@addFinanceDay'));

// });