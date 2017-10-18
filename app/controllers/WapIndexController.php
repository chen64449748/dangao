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
		// 发送消息给后台
		try {
			Websocket::adminOrderSend(1);
		} catch (Exception $e) {
			
		}
        
		// banner
		$banners = Banner::get();

		$view_data = array(
			'active' => 'index',
			'hot' => $hot,
			'fines' => $fines,
			'banners' => $banners, 
		);
		return View::make('wap.index', $view_data);
	}

}