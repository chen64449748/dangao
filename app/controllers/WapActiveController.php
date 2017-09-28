<?php 


class WapActiveController extends WapController
{
	function index()
	{

		$view_data = array(
			'active' => 'active',	
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