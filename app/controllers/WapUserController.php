<?php 

class WapUserController extends WapController
{
	function index()
	{
        $user_id = Session::get('user_id');
        $order_count = Orders::select(DB::raw('count(id) as count, status'))->where('user_id', $user_id)->groupBy('status')->get();

        $count_arr = array();
        foreach ($order_count as $key => $value) {
            $count_arr[$value->status] = $value->count;
        }
        $count_arr[0] = isset($count_arr[0]) ? $count_arr[0] : 0;
        $count_arr[1] = isset($count_arr[1]) ? $count_arr[1] : 0;
        $count_arr[2] = isset($count_arr[2]) ? $count_arr[2] : 0;
        $count_arr[3] = isset($count_arr[3]) ? $count_arr[3] : 0;
        $count_arr[4] = isset($count_arr[4]) ? $count_arr[4] : 0;

        $waiting_count = $count_arr[0] + $count_arr[1];
        $payed_count = $count_arr[2];
        $close_count = $count_arr[3];
        $ok_count = $count_arr[4];

        $shop = Shop::get();

		$view_data = array(
			'active' => 'user',
            'waiting_count' => $waiting_count,
            'payed_count' => $payed_count,
            'close_count' => $close_count,
            'ok_count' => $ok_count,
		    'shop'     => $shop,
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
       
        $appid = 'wx30270429e437180c';
        // $appid = Session::get('appid');
        return Redirect::to('https://open.weixin.qq.com/connect/oauth2/authorize?appid='.$appid.'&redirect_uri='.urlencode('http://www.terentia.cn/user/dologin/').'&response_type=code&scope=snsapi_userinfo&state=#wechat_redirect');
    }

    function dologin(){
        if(!isset($_GET['code'])||empty($_GET['code'])){
            die('必须授权才能继续！');
        }
        var_dump($_GET['code']);exit();
        $wxservice = new Wxservice;
        $token=$wxservice->getaccesst($_GET['code']);
        $uinfo=$wxservice->getUserInfo($token);
        if(user::login($uinfo)){
            return Redirect::to('/');
        }
    }

    // 用户订单
    function orders() {

    	$user_id = Session::get('user_id');
    	$status = Input::get('status');

    	$order_m = new Orders();
    	$order_detail_m = new OrderDetails();

    	$status_arr = array(
    		'waiting' => array(0, 1),
    		'paying' => array(1),
    		'payed' => array(2),
    		'close' => array(3),
            'ok' => array(4),
    	);
    	$type = array();
    	$order = array('created_at', 'desc');

    	if (!isset($status_arr[$status])) {
    		$status = '';
    	}

    	$type['user_id'] = $user_id;
    	$status && $type['status'] = $status_arr[$status];

    	$order_arr = $order_m->getList($type, $order, array(), 0, 20);

    	$order_ids = array();
    	$orders = array();
    	foreach ($order_arr as $key => $value) {
    		$order_ids[] = $value->id;
    		$value->detail = array();
            $value->goods_count = 0;
    		$orders[$value->id] = $value;
    	}

        if ($order_ids) {
            $order_detail = $order_detail_m->getList(array('ids'=> $order_ids));
        } else {
            $order_detail = array();
        }
    	

    	$details = array();

    	foreach ($order_detail as $detail) {
    		$detail->goods_title = $detail->goods->goods_title;
    		$detail->goods_img = $detail->goods->goods_img;
    		$detail->sku_text = '';

    		foreach ($detail->p->skuPrices as $sku_price) {
    			$detail->sku_text .= $sku_price->skuValue->value.' ';
    		}
    		$details[$detail->order_id][] = $detail;
            $orders[$detail->order_id]->goods_count += 1;
    		// $orders[$detail->order_id]->detail = $detail;
    	}

    	foreach ($orders as $ok => $ov) {
    		$orders[$ok]->detail = $details[$ov->id];
    	}

        $query = 'status='.$status;

    	$view_data = array(
    		'status' => $status,
    		'orders' => $orders,
            'query' => $query,
    	);

    	return View::make('wap.user.orders', $view_data);

    }
    // 下拉加载订单
    function orderLoading()
    {
        $user_id = Session::get('user_id');
        $status = Input::get('status');
        $page = Input::get('page', 2);
        $offset = ($page - 1) * 20;

        $order_m = new Orders();
        $order_detail_m = new OrderDetails();

        $status_arr = array(
            'waiting' => array(0, 1),
            'paying' => array(1),
            'payed' => array(2),
            'close' => array(3),
            'ok' => array(4),
        );
        $type = array();
        $order = array('created_at', 'desc');

        $order_arr = $order_m->getList($type, $order, array(), $offset, 20);

        $order_ids = array();
        $orders = array();
        foreach ($order_arr as $key => $value) {
            $order_ids[] = $value->id;
            $value->detail = array();
            $value->goods_count = 0;
            $orders[$value->id] = $value;
        }

        if ($order_ids) {
            $order_detail = $order_detail_m->getList(array('ids'=> $order_ids));
        } else {
            $order_detail = array();
        }
        

        $details = array();

        foreach ($order_detail as $detail) {
            $detail->goods_title = $detail->goods->goods_title;
            $detail->goods_img = $detail->goods->goods_img;
            $detail->sku_text = '';

            foreach ($detail->p->skuPrices as $sku_price) {
                $detail->sku_text .= $sku_price->skuValue->value.' ';
            }
            $details[$detail->order_id][] = $detail;
            $orders[$detail->order_id]->goods_count += 1;
            // $orders[$detail->order_id]->detail = $detail;
        }

        foreach ($orders as $ok => $ov) {
            $orders[$ok]->detail = $details[$ov->id];
        }
        if ($order_ids) {
            return Response::json(array('status'=> 1, 'data'=> $orders));
        } else {
            return Response::json(array('status'=> 400, 'data'=> $orders));
        }
    }
    
     
    // 用户地址列表
    function addressList()
    {
    	$user_id = Session::get('user_id');
    	$addresses = DB::table('user_address')->where('user_id', $user_id)->get();
    	
    	$view_data = array(
    		'addresses' => $addresses,
    	);
    	return View::make('wap.user.address', $view_data);
    }

    // 地址详情
    function addressDetail()
    {
    	$user_id = Session::get('user_id');
    	$type = Input::get('type', 'add');
    	$address_id = Input::get('address_id');

    	if ($type == 'add') {
    		$address = new StdClass();
    		$address->name = '';
    		$address->phone = '';
    		$address->address = '';
    		$address->is_default = 0;
    	} elseif ($type == 'update') {
    		$address = DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->first();
    		if (!$address) {
	    		return Redirect::to('/user/address');
	    	}	
    	}
    	
    	$view_data = array(
    		'type' => $type,
    		'address' => $address,
    	);

    	return View::make('wap.user.addressdetail', $view_data);
    	
    }
    // 添加或者修改地址
    function addressSave() {
    	$user_id = Session::get('user_id');
    	$type = Input::get('type', 'add');
    	$address_id = Input::get('address_id');
    	$name = Input::get('name');
    	$phone = Input::get('phone');
    	$address = Input::get('address');
    	$is_default = Input::get('is_default');

    	$data = array(
    		'name' => $name,
    		'phone' => $phone,
    		'address' => $address,
    		'is_default' => $is_default,
    	);
    	try {
    		foreach ($data as $key => $value) {
    			if ($value == '') {
    				throw new Exception("地址信息所有项必填");
    			}
    		}
    		if ($is_default == 1) {
    			DB::table('user_address')->where('user_id', $user_id)->update(array('is_default'=> 0));
    		}
    		if ($type == 'update') {
    			$addr = DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->first();
    			if (!$addr) {
    				throw new Exception("没有找到地址详情，请重试");
    			}
    			DB::table('user_address')->where('id', $addr->id)->update($data);
	    	} elseif ($type == 'add') {
	    		$data['user_id'] = $user_id;
	    		DB::table('user_address')->insert($data);
	    	}

	    	DB::commit();
    		return Response::json(array('status'=> 1, 'message'=> '保存成功'));
    	} catch (Exception $e) {
    		DB::rollback();
    		return Response::json(array('status'=> 0, 'message'=> '保存失败'));
    	}
    	

    }

    // 修改默认
    function updateDefault()
    {
    	$user_id = Session::get('user_id');
    	$address_id = Input::get('address_id');

    	DB::beginTransaction();
    	try {
    		DB::table('user_address')->where('user_id', $user_id)->update(array('is_default'=> 0));
    		DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->update(array('is_default'=> 1));
    		DB::commit();
    		return Response::json(array('status'=> 1, 'message'=> '修改成功'));
    	} catch (Exception $e) {
    		DB::rollback();
    		return Response::json(array('status'=> 0, 'message'=> '修改失败'));
    	}
    }

    // 删除地址
    function addressDelete()
    {
        $address_id = Input::get('address_id');
        $user_id = Session::get('user_id');
        
        $is_default = 0;
        DB::beginTransaction();

        try {
            $address = DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->first();

            if (!$address) {
                throw new Exception("没有找到地址详情，请重试");
            }

            $res = DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->delete();
            
            if ($address->is_default) {
                $is_default = 1;
                DB::table('user_address')->where('user_id', $user_id)->take(1)->update(array('is_default'=> 1));
            }

            DB::commit();
            return Response::json(array('status'=> 1, 'message'=> '删除成功', 'is_default'=> $is_default));
        } catch (Exception $e) {
            DB::rollback();
            return Response::json(array('status'=> 0, 'message'=> '删除失败'));
        }

    }

    function test(){
        // $data = array('nickname' =>'用户一',
        //              'headimgurl' => 'http://abc/a.img',
        //              'sex' => 1,
        //              'province' => '江苏',
        //              'unionid' => '111',
        //              'city' =>'南通',
        //              'openid'=>'asdafkasdj1231',
        //          );
        // user::login($data);
        Session::forget('user');
        dd(Session::get('user'));
    }
}