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

	function addAddress()
	{
		DB::beginTransaction();
		try {
			$user_id = Session::get('user_id');
			$address = Input::get('address');
			$name = Input::get('name');
			$phone = Input::get('phone');
			$order_id = Input::get('order_id');
			if (!$address || !$name || !$phone) {
				throw new Exception("收获信息所有必填");
			}

			$is_default = 0;

			$c = DB::table('user_address')->where('user_id', $user_id)->count();			

			if (!$c) {
				$is_default = 1;
			}

			$d_id = DB::table('user_address')->insertGetId(array(
				'user_id' => $user_id,
				'address' => $address,
				'name'    => $name,
				'phone'   => $phone,
				'created_at' => date('Y-m-d H:i:s'),
				'is_default' => $is_default,
			));

			if ($order_id) {
				$res = Orders::where('id', $order_id)->where('user_id', $user_id)->update(array(
					'name' => $name,
					'mobile' => $phone,
					'address' => $address,
				));
				
				if (!$res) {
					throw new Exception("修改订单失败,请重试");
				}
			}

			DB::commit();
			return Response::json(array('status'=> 1, 'message'=> '添加成功', 'address_id'=> $d_id));
		} catch (Exception $e) {
			DB::rollback();
			return Response::json(array('status'=> 0, 'message'=> '添加失败，请重试'));
		}
	}
    function login()
    {
        return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$this->AppId.'&redirect_uri='.urlencode('http://www.terentia.cn/user/dologin/').'&response_type=code&scope=snsapi_userinfo&state=#wechat_redirect');
    }

    function dologin(){
        if(!isset($_GET['code'])||empty($_GET['code'])){
            die('必须授权才能继续！');
        }
        $wxservice = new Wxservice;
        $token=$wxservice->getaccesst($_GET['code']);
        $uinfo=$wxservice->getUserInfo($token);
        if(user::login($uinfo)){
            return Redirect::to('/');
        }
    }

     
}