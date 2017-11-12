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
Route::group(array('before'=> 'userlogin'), function() {
	Route::get('/', array('as'=> '/', 'uses'=> 'WapIndexController@index'));
	Route::get('goods', array('as'=> 'goods', 'uses'=> 'WapGoodsController@goods'));
	Route::get('goods/loading', array('as'=> 'goods.loading', 'uses'=> 'WapGoodsController@goodsLoading'));
	Route::get('detail/{goods_id}', array('as'=> 'detail', 'uses'=> 'WapGoodsController@detail'));
	Route::post('goods/buy', array('as'=> 'goods.buy', 'uses'=> 'WapGoodsController@goodsBuy'));


	Route::get('cart', array('as'=> 'cart', 'uses'=> 'WapCartController@cart'));
	Route::get('cart/getSkuSelect', array('as'=> 'cart.getSkuSelect', 'uses'=> 'WapCartController@getSkuSelect'));
	Route::post('cart/cartCount', array('as'=> 'cart.cartCount', 'uses'=> 'WapCartController@cartCount'));
	Route::post('cart/cartDelete', array('as'=> 'cart.cartDelete', 'uses'=> 'WapCartController@cartDelete'));
	Route::post('cart/cartBuy', array('as'=> 'cart.cartBuy' , 'uses' => 'WapCartController@cartBuy'));
	Route::post('cart/add', array('as'=> 'cart.add', 'uses'=> 'WapCartController@goodsAddCart'));
	Route::get('active', array('as'=> 'active', 'uses'=> 'WapActiveController@index'));
	Route::get('active/detail/{active_id}', array('as'=> 'active.detail', 'uses'=> 'WapActiveController@detail'));

	Route::get('user', array('as'=> 'user', 'uses'=> 'WapUserController@index'));
	Route::get('user/address', array('as'=> 'user.address', 'uses'=> 'WapUserController@addressList'));
	Route::get('user/address/detail', array('as'=> 'user.address.detail', 'uses'=> 'WapUserController@addressDetail'));
	Route::post('user/address/save', array('as'=> 'user.address.save', 'uses'=> 'WapUserController@addressSave'));
	Route::post('user/addAddress', array('as'=> 'user.addAddress', 'uses'=> 'WapUserController@addAddress'));
	Route::post('user/address/default', array('as'=> 'user.address.default', 'uses'=> 'WapUserController@updateDefault'));
	Route::post('user/address/delete', array('as'=> 'user.address.delete', 'uses'=> 'WapUserController@addressDelete'));
	Route::get('user/orders', array('as'=> 'user.orders', 'uses'=> 'WapUserController@orders'));
	Route::get('user/order/loading', array('as'=> 'user.orders.loading', 'uses'=> 'WapUserController@orderLoading'));



	Route::get('buy/{order_id}', array('as'=> 'buy', 'uses'=> 'WapOrderController@buy'));
	Route::get('order/addressSelect/{order_id}', array('as'=> 'order.addressSelect', 'uses'=> 'WapOrderController@addressSelect'));
	Route::post('user/order/status/update', array('as'=> 'user.order.status.update', 'uses'=> 'WapOrderController@orderStatusUpdate'));
	Route::post('/order/wxpay', array('as'=> 'order.wxpay', 'uses'=> 'WapOrderController@wxpay'));
});
//登陆
Route::get('admin/login', array('as'=> 'admin.login', 'uses'=> 'LoginController@login'));
Route::post('admin/doLogin', array('as'=> 'admin.doLogin', 'uses'=> 'LoginController@doLogin'));
Route::get('/logout', array('as'=> 'admin.logout', 'uses'=> 'LoginController@logout'));
Route::group(array('before'=> 'login'), function() {
	//管理员
	Route::get('/admin', array('as'=> 'admin', 'uses'=> 'AdminController@adminList'));
	Route::get('/admin/add', array('as'=> 'admin.add', 'uses'=> 'AdminController@addadmin'));
	Route::post('/admin/add/data', array('as'=> 'admin.add', 'uses'=> 'AdminController@AddData'));
	Route::get('/admin/del', array('as'=> 'admin.add', 'uses'=> 'AdminController@del'));
	Route::get('/admin/change', array('as'=> 'admin.add', 'uses'=> 'AdminController@AddData'));

	//订单
	//管理员
	Route::get('/admin/orders', array('as'=> 'admin.orders', 'uses'=> 'OrderController@orders'));
	Route::get('/admin/order_detail', array('as'=> 'admin.order_detail', 'uses'=>'OrderController@order_detail'));
	Route::any('orders/change', array('as'=> 'orders.change', 'uses'=> 'OrderController@change'));
	// 货品
	Route::get('goods/list', array('as'=> 'goods.list', 'uses'=> 'GoodsController@goodsList'));
	Route::post('goods/get', array('as'=> 'goods.list', 'uses'=> 'GoodsController@goodsGet'));
	Route::get('goods/add', array('as'=> 'goods.add', 'uses'=> 'GoodsController@goodsAdd'));
	Route::post('goods/imageUpload', array('goods.imageUpload', 'uses'=> 'GoodsController@imageUpload'));
	Route::post('goods/goodsAttr', array('goods.goodsAttr', 'uses'=> 'GoodsController@goodsAttr'));
	Route::post('goods/add/data', array('as'=> 'goods.add.data', 'uses'=> 'GoodsController@goodsAddData'));
	Route::post('goods/add/order', array('as'=> 'goods.add.order', 'uses'=> 'GoodsController@goodsAddOrder'));
	Route::get('goods/detail', array('as'=> 'goods.detail', 'uses'=> 'GoodsController@goodsDetail'));
	Route::post('goods/detail/update', array('as'=> 'goods.detail.update', 'uses'=> 'GoodsController@goodsDetailUpdate'));
	Route::post('goods/sku/get', array('as'=> 'goods.sku.get', 'uses'=> 'GoodsController@goodsSkuGet'));
	Route::any('sku/price/get', array('as'=> 'sku.price.get', 'uses'=> 'GoodsController@skuPriceGet'));
	Route::post('get/order/sku', array('as'=> 'get.order.sku', 'uses'=> 'GoodsController@getOrderSku'));// 获取没有关联的SKU

	// 活动
	Route::get('active/list', array('as'=> 'active.list', 'uses'=> 'ActiveController@activeList'));
	Route::get('active/admin/detail', array('as'=> 'active.admin.detail', 'uses'=> 'ActiveController@detail'));
	Route::get('active/goods/loading', array('as' => 'active.goods.loading', 'uses'=> 'ActiveController@goodsLoading'));
	Route::post('active/admin/save', array('as'=> 'active.admin.save', 'uses'=> 'ActiveController@save'));
	Route::post('active/admin/updateFine', array('as'=> 'active.admin.updateFine', 'uses'=> 'ActiveController@updateFine'));
	// 属性
	Route::get('config/list', array('as'=> 'config.list', 'uses'=> 'ConfigController@configList'));
	Route::post('config/sku/value/add', array('as'=> 'config.sku.value.add', 'uses'=> 'ConfigController@skuValueAdd'));
	Route::post('config/sku/add', array('as'=> 'config.sku.add', 'uses'=> 'ConfigController@skuAdd'));

	// 分类
	Route::get('category/list', array('as'=> 'category.list', 'uses'=> 'CategoryController@categoryList'));
	Route::post('category/save', array('as'=> 'category.save', 'uses'=> 'CategoryController@categorySave'));

	// 页面设施
	Route::get('admin/banner', array('as'=> 'admin.banner', 'uses'=> 'ConfigController@adminBanner'));
	Route::post('admin/banner/save', array('as'=> 'admin.banner.save', 'uses'=> 'ConfigController@adminBannerSave'));
	Route::get('admin/shop', array('as'=> 'admin.shop', 'uses'=> 'ConfigController@adminShop'));
	Route::post('admin/shop/save', array('as'=> 'admin.shop.save', 'uses'=> 'ConfigController@adminShopSave'));
	// 库存
	Route::get('stock/order/list', array('as'=> 'stock.order.list', 'uses'=> 'StockController@stockOrderList'));
	Route::get('stock/add', array('as'=> 'stock.order', 'uses'=> 'StockController@stockAdd'));
	Route::post('stock/order/data', array('as'=> 'stock.order.data', 'uses'=> 'StockController@stockOrderData'));
	Route::post('stock/order/get', array('as'=> 'stock.order', 'uses'=> 'StockController@stockOrderGet'));
	Route::get('stock/order/detail', array('as'=> 'stock.order.detail', 'uses'=> 'StockController@stockOrderDetail'));
	Route::post('stock/order/detail/data', array('as'=> 'stock.order.detail.data', 'uses'=> 'StockController@stockOrderDetailData'));
	Route::post('stock/finance/add', array('as'=> 'stock.finance.add', 'uses'=> 'StockController@addFinance'));
	Route::post('stock/finance/add/day', array('as'=> 'stock.finance.add.day', 'uses'=> 'StockController@addFinanceDay'));

});

//yh
Route::get('/user/login', array('as'=> 'user.login', 'uses'=> 'WapUserController@login'));
Route::get('/user/dologin', array('as'=> 'user.dologin', 'uses'=> 'WapUserController@dologin'));
Route::group(array('before'=> 'userlogin'), function() {
	Route::post('', array('as'=> 'stock.finance.add.day', 'uses'=> 'StockController@addFinanceDay'));
});

Route::get('/user/test', array('as'=> 'user.test', 'uses'=> 'WapUserController@test'));

//wx
 Route::any('/wx/index',['as'=>'wx.index','uses'=>'WxController@index']);
