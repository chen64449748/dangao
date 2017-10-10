<?php 

class LoginController extends BaseController
{
	public function login()
	{
		return View::make('admin.login.login');
	}

	public function doLogin()
	{

		$mobile = Input::get('mobile');
		$password = Input::get('pwd');
		// var_dump($mobile);exit();
		// $password = $password;

		if ($manage = DB::table('admin')->where('mobile', $mobile)->where('pwd', $password)->first()) {
			Session::set('admin', $manage);
			return Redirect::to('/admin');
		}

		return Redirect::to('admin/login');

	}

	public function logout()
	{
		Session::forget('admin');
		return Redirect::to('admin/login');
	}
}