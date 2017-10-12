<?php 


class WapIndexController extends WapController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	
	function index()
	{
		$goods_m = new Goods();
		$active_m = new Active();
		// 获取推荐
		$hot = $goods_m->getHot();

		// 获取活动
		$fines = $active_m->getFine();

		$view_data = array(
			'active' => 'index',
			'hot' => $hot,
			'fines' => $fines,
		);
		return View::make('wap.index', $view_data);
	}

}