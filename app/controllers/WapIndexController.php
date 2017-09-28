<?php 


class WapIndexController extends WapController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	
	function index()
	{
		$view_data = array(
			'active' => 'index',
		);
		return View::make('wap.index', $view_data);
	}

}