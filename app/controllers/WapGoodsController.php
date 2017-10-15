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
		$k = Input::get('k', '');

		$type = array();
		$order = array();

		$type['is_onsale'] = 1;
		$show_price_order && $order['show_price'] = $show_price_order;
		$sale_num_order && $order['sale_num'] = $sale_num_order;
		$k && $type['k'] = $k;
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

			'k' => $k,
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

		$type['is_onsale'] = 1;
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
		$user_id = Session::get('user_id');

		$goods_m = new Goods(); 
		$active_m = new Active();
		$goods = $goods_m->fetch(array('id'=> $goods_id));
		$hot = $goods_m->getHot();


		$actives = $active_m->getList(array('now'=> date('Y-m-d H:i:s')), array('created_at', 'desc'));
		$cart_count = Cart::where('user_id', $user_id)->count();
		$view_data = array(
			'goods' => $goods,
			'actives' => $actives,
			'hot' => $hot,
			'cart_count' => $cart_count
		);

		return View::make('wap.goods.detail', $view_data);
	}

	// 立即购买

	function goodsBuy()
	{
		$sku_value_ids = Input::get('sku_value_ids');
		$goods_id = Input::get('goods_id');
		$user_id = Session::get('user_id');
		$count = Input::get('count');

		DB::beginTransaction();
		try {
			$order_m = new Orders();
			$price_m = new Price();

			$goods = Goods::find($goods_id);
	
			if (!$goods) {
				throw new Exception("没有找到商品");
			}

			if (!$goods->is_onsale) {
				throw new Exception("商品已下架");
			}

			$order = array();
			$order_detail = array();

			$order['user_id'] = $user_id;
			$order['status'] = 0;
			$order['send_status'] = 0;
			$order['created_at'] = date('Y-m-d H:i:s');
			$order['pay'] = 0;

			$price = $price_m->getPrice($goods_id, $sku_value_ids);

			$order_detail[0]['goods_id'] = $goods_id;
			$order_detail[0]['price_id'] = $price->id;
			$order_detail[0]['price'] = $price->getRealPrice();
			$order_detail[0]['old_price'] = $price->price;
			$order_detail[0]['created_at'] = date('Y-m-d H:i:s');
			$order_detail[0]['buy_count'] = $count;

			$order_id = $order_m->add($user_id, $order, $order_detail);
			DB::commit();
			return Response::json(array('status'=> 1, 'message'=> '下单成功', 'order_id'=> $order_id));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> '下单失败'.$e->getMessage()));
		}
		
	}

}