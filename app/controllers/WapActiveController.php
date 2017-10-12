<?php 


class WapActiveController extends WapController
{
	function index()
	{
		$active_m = new Active();
		$order = array('created_at', 'desc');
		$actives = $active_m->getList(array('now'=> 1), $order);

		$view_data = array(
			'active' => 'active',
			'actives'=> $actives,
		);

		return View::make('wap.active.index', $view_data);
	}

	function detail()
	{

		$view_data = array(

		);

		return View::make('wap.active.detail', $view_data);
	}
}