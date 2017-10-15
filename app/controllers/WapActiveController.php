<?php 


class WapActiveController extends WapController
{
	function index()
	{
		$active_m = new Active();
		$order = array('created_at', 'desc');
		$actives = $active_m->getList(array('now'=> date('Y-m-d H:i:s')), $order);

		$view_data = array(
			'active' => 'active',
			'actives'=> $actives,
		);

		return View::make('wap.active.index', $view_data);
	}

	function detail($active_id)
	{
		$active = Active::find($active_id);

		if (!$active) {
			return Redirect::to('/active');
		}

		$view_data = array(
			'active'=> $active,
		);

		return View::make('wap.active.detail', $view_data);
	}
}