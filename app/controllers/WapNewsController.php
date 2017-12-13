<?php 

/**
* 
*/
class WapNewsController extends WapController
{
	function news()
	{
		$id = Input::get('id');
		$news = DB::table('news')->find($id);
		if (!$news) {
			// exit();
		}
		$view_data = array(
			'news' => $news,
		);
		return View::make('wap.news.news', $view_data);

	}
	

}