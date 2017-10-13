<?php 

/**
* 
*/
class ActiveController extends BaseController
{

	function activeList()
	{
		$active_m = new Active();
		$active_title = Input::get('active_title');
		$begin_time = Input::get('begin_time');
		$end_time = Input::get('end_time');
		$a_type = Input::get('type');

		$type = array();

		$active_title && $type['active_title'] = $active_title;
		$begin_time && $type['begin_time'] = $begin_time;
		$end_time && $type['end_time'] = $end_time;
		$a_type && $type['type'] = $a_type;

		$actives = $active_m->getListPage($type);

		$append = array(
			'active_title' => $active_title,
			'begin_time' => $begin_time,
			'end_time' => $end_time,
			'type' => $a_type,
		);

		$actives->appends($append);

		$view_data = array(
			'actives' => $actives,
			'active_title' => $active_title,
			'begin_time' => $begin_time,
			'end_time' => $end_time,
			'type' => $a_type,
		);
		return View::make('admin.active.list', $view_data);
	}


	function detail()
	{
		$act = Input::get('act', 'add');
		$active_id = Input::get('active_id');
		$active_m = new Active();

		if ($act == 'add') {
			$active = new StdClass();
			$active->id = '';
			$active->active_title = '';
			$active->active_img = '/wap/wu.jpg';
			$active->is_fine = 0;
			$active->discount = '';
			$active->type = 0;
			$active->money = '';
			$active->begin_time = '';
			$active->end_time = '';
		} else {
			$active = $active_m->find((int)$active_id);
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
				$data['created_at'] = date('Y-m-d H:i:s');
				$active_m->insert($data);
			}
			return Response::json(array('status'=> 1, 'message'=> '保存成功'));
		} catch (Exception $e) {
			return Response::json(array('status'=> 0, 'message'=> '失败，请重试'.$e->getMessage()));
		}
		
	}

	function updateFine()
	{
		$active_id = Input::get('active_id');
		
		try {
			$active = Active::find($active_id);
			if (!$active) {
				throw new Exception("没有找到修改的活动");
			}

			$update_arr = array();
			if ($active->is_fine == 1) {
				$update_arr['is_fine'] = 0;
			} else {
				$update_arr['is_fine'] = 1;
			}
			Active::where('id', $active->id)->update($update_arr);

			return Response::json(array('status'=> 1, 'message'=> '修改成功'));
		} catch (Exception $e) {
			return Response::json(array('status' => 0, 'message'=> '修改失败：'.$e->getMessage()));
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