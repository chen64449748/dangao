<?php 


class WapIndexController extends WapController {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	
	function index()
	{
		return View::make('wap.index');
	}

}