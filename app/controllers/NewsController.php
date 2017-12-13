<?php

class NewsController extends BaseController
{
	public function newsList()
	{
		$newses = DB::table('news')->paginate(15);

		$view_data = array(
			'newses' => $newses,
		);

		return View::make('admin.news.news', $view_data);
	}

	function detail()
	{
		$act = Input::get('act', 'add');
		$id = Input::get('id');

		if ($act == 'add') {
			$news = new stdClass();
			$news->id = '';
			$news->content = '';
			$news->bg_mic = '';
			$news->url = '';
		} else {
			$news = DB::table('news')->find($id);
		}

		$view_data = array(
			'act' => $act,
			'news' => $news,
		);

		return View::make('admin.news.detail', $view_data);
	}

	function save()
	{
		$act = Input::get('act', 'add');
		$id = Input::get('id');


		$content = Input::get('content');
		$mic_url = Input::get('mic_url');

		$data = array(
			'content' => $content,
			'bg_mic' => $mic_url,
		);

		try {

			if ($act == 'update') {
				$news = DB::table('news')->find($id);
				if (!$news) {
					throw new Exception("没有找到修改的活动");
				}
				DB::table('news')->where('id', $news->id)->update($data);
			} else if ($act == 'add') {
				$data['created_at'] = date('Y-m-d H:i:s');
				$news_id = DB::table('news')->insertGetId($data);
				DB::table('news')->where('id', $news_id)->update(array('url'=> $_SERVER['SERVER_NAME'].'/news?id='.$news_id));
			}
			return Response::json(array('status'=> 1, 'message'=> '保存成功'));
		} catch (Exception $e) {
			return Response::json(array('status'=> 0, 'message'=> '失败，请重试'.$e->getMessage()));
		}
	}

	function micUpload()
	{
		$file = Input::file('mic');
		$dir = Input::get('dir', '');

		$shop = Shop::first();

		if (!$shop) {
			$pz = 50;
		} else {
			$pz = (int)$shop->img_quality;
		}

		$upload_dir = './upload';

		try {

			if (!Input::hasFile('mic')) {
				throw new Exception("没有上传文件");
			}

			if ($dir) {
				$upload_dir .= '/'.trim($dir, '/');
			}
			$ext = $file->getClientOriginalExtension();
			$web_dir = ltrim($upload_dir, '.');

			$file_name = date('YmdHis').uniqid().'.'.trim($ext);
			$file->move($upload_dir, $file_name);

			return Response::json(array('status'=> 1, 'url'=> $web_dir.'/'.$file_name));
		} catch (Exception $e) {
			return Response::json(array('status'=> 0, 'message'=> '上传失败:'.$e->getMessage()));
		}
	}

}