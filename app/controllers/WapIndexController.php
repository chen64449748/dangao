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
		// 获取推荐
		$hot = $goods_m->getHot();

		$view_data = array(
			'active' => 'index',
			'hot' => $hot,
		);
		return View::make('wap.index', $view_data);
	}

}