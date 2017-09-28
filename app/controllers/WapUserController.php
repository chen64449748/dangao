<?php 

class WapUserController extends WapController
{
	function index()
	{
		$view_data = array(
			'active' => 'user',
		);

		return View::make('wap.user.index', $view_data);
	}
}