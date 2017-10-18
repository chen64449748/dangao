<?php

class BaseController extends Controller {

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	
	public function __construct()
	{

		$action = Request::path();
		$shop = Shop::get();
		$manage = Session::get('admin');

		View::share('action', $action);		
		View::share('shop', $shop);
		View::share('manage', $manage);
	}
	protected function setupLayout()
	{
		if ( ! is_null($this->layout))
		{
			$this->layout = View::make($this->layout);
		}
	}

}
