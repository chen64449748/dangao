<?php 

/**
* 
*/
class ActiveController extends BaseController
{

	function detail()
	{
		$act = Input::get('act', 'add');
		$active_id = Input::get('active_id');
		$active_m = new Active();

		if ($act = 'add') {
			$active = new StdClass();
			$active->active_title = '';
			$active->active_img = '/wap/wu.jpg';
			$active->is_fine = 0;
			$active->discount = '';
			$active->type = 0;
			$active->money = '';
			$active->begin_time = '';
			$active->end_time = '';
		} else {
			$active = $active->find($active_id);
		}


		$view_data = array(
			'act' => $act,
			'active' => $active,
		);

		return View::make('admin.active.detail', $view_data);
	}

	function save()
	{
		$act = Input::get('act', 'add');
		$active_id = Input::get('active_id');
		$active_m = new Active();

		$active_title = Input::get('active_title');
		$active_img = Input::get('active_img');
		$is_fine = Input::get('is_fine');
		$data = array(
			'active_title' => Input::get('active_title'),
			'active_img' => Input::get('active_img'),
			'is_fine' => Input::get('is_fine'),
			'discount' => Input::get('discount'),
			'type' => Input::get('type'),
			'money' => Input::get('money'),
			'begin_time' => Input::get('begin_time'),
			'end_time' => Input::get('end_time'),
		);

		try {

			foreach ($data as $key => $value) {
				if ($value == '') {
					throw new Exception("活动信息每项都不能为空");
				}
			}

			if ($act == 'update') {
				$active = $active_m->find($active_id);
				if (!$active) {
					throw new Exception("没有找到修改的活动");
				}
				$active_m->where('id', $active->id)->update($data);
			} else if ($act == 'add') {
				$active_m->insert($data);
			}
			return Response::json(array('status'=> 1, 'message'=> '保存成功'));
		} catch (Exception $e) {
			return Response::json(array('status'=> 0, 'message'=> '失败，请重试'));
		}
		
	}


	function goodsLoading()
	{
		$page = Input::get('page', 2);

		$offset = ($page - 1) * 20;

		$goods_m = new Goods();

		$goods = $goods_m->getGoods(array(), array('created_at'=> 'desc'), $offset, 20);

		if (count($goods)) {
			return Response::json(array('status'=> 1, 'goods'=> $goods));
		} else {
			return Response::json(array('status'=> 400, 'goods'=> $goods));
		}

	}
}