<?php 

/**
* 
*/
class CategoryController extends BaseController
{
	function categoryList()
	{
		$categorys = Category::get();

		$view_data = array(
			'categorys' => $categorys,
		);

		return View::make('admin.category.list', $view_data);
	}

	function categorySave()
	{
		$category_id = Input::get('category_id');
		$category = Input::get('category');
		$act = Input::get('act');

		try {
			switch ($act) {
				case 'add':
					
					if (!$category) {
						throw new Exception("分类必填");
					}

					Category::insert(array('category'=> $category, 'pid'=> 0, 'created_at'=> date('Y-m-d H:i:s'), 'is_parent'=> 1));
					break;
				case 'update':
					
					Category::where('id', $category_id)->update(array('category'=> $category));

					break;
				case 'delete':
					Category::where('id', $category_id)->delete();
					break;
				default:
					throw new Exception("参数错误");
					break;
			}
			return Response::json(array('status'=> 1, 'message'=> '保存成功'));
		} catch (Exception $e) {
			return Response::json(array('status'=> 0, 'message'=> '失败：'.$e->getMessage()));
		}
		
	}
}