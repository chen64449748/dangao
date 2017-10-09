<?php 


class WapGoodsController extends WapController
{
	// 所有商品
	function goods()
	{

		$goods_m = new Goods();

		$show_price_order = Input::get('show_price_order', '');
		$sale_num_order = Input::get('sale_num_order', '');
		$category_id = Input::get('category_id', '');

		$type = array();
		$order = array();

		$show_price_order && $order['show_price'] = $show_price_order;
		$sale_num_order && $order['sale_num'] = $sale_num_order;

		$category_id && $type['category_id'] = $category_id;

		$is_default = 1;
		if ($show_price_order || $sale_num_order) {
			$is_default = 0;	
		} else {
			$order['created_at'] = 'desc';
		}

		$sale_num_order_t = '';
		$show_price_order_t = '';

		if ($sale_num_order == 'desc') {
			$sale_num_order_t = 'asc';
		} elseif ($sale_num_order == 'asc') {
			$sale_num_order_t = 'desc';
		}

		if ($show_price_order == 'desc') {
			$show_price_order_t ='asc';
		} elseif ($show_price_order == 'asc') {
			$show_price_order_t = 'desc';
		}

		$goods = $goods_m->getGoods($type, $order);
		$categorys = Category::where('pid', 0)->get();

		$view_data = array(
			'active' => 'goods',
			'goods' => $goods,
			'categorys' => $categorys,
			'sale_num_order' => $sale_num_order,
			'sale_num_order_t' => $sale_num_order_t,

			'show_price_order' => $show_price_order,
			'show_price_order_t' => $show_price_order_t,
			'is_default' => $is_default,
			'category_id' => $category_id,
			'query' => http_build_query(Input::get()),
		);

		return View::make('wap.goods.goods', $view_data);
	}

	function goodsLoading()
	{
		$page = Input::get('page', '2');

		$show_price_order = Input::get('show_price_order', '');
		$sale_num_order = Input::get('sale_num_order', '');
		$category_id = Input::get('category_id', '');

		$type = array();
		$order = array();

		$show_price_order && $order['show_price'] = $show_price_order;
		$sale_num_order && $order['sale_num'] = $sale_num_order;

		$category_id && $type['category_id'] = $category_id;

		$is_default = 1;
		if ($show_price_order || $sale_num_order) {
			$is_default = 0;	
		} else {
			$order['created_at'] = 'desc';
		}

		$goods_m = new Goods();

		$offset = ($page - 1) * 20;

		$goods = $goods_m->getGoods($type, $order, $offset, 20);
		if (isset($goods[0])) {
			return Response::json(array('status'=> 1, 'data'=> $goods));
		} else {
			return Response::json(array('status'=> 400, 'data'=> $goods));
		}
	}

	
	// 商品详情
	function detail($goods_id)
	{
		$goods_m = new Goods(); 

		$goods = $goods_m->fetch(array('id'=> $goods_id));
		$hot = $goods_m->getHot();
		$view_data = array(
			'goods' => $goods,
			'hot' => $hot,
		);

		return View::make('wap.goods.detail', $view_data);
	}

}