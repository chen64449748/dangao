<?php
class AdminController extends BaseController
{
    public function adminList() {
        $Admin = new Admin(); 
        $adminList = $Admin->getList();
        $view_data = array(
            'admin' => $adminList,
        );
        return View::make('admin.admin.list', $view_data);
    }

    public function updateuserpwd()
    {

        $admin_id = trim(Input::get('admin_id'));
        $newpwd = trim(Input::get('new'));
        $oldpwd = trim(Input::get('old'));


        $admin = new Admin();
        $company = $admin->checkadmin($admin_id,$oldpwd);

        if (!$company) {
            return Response::json(array('status'=> 0, 'message'=> '原密码错误'));
        }
        $res = $admin->updateadmin($admin_id,$newpwd);
        if ($res) {
            return Response::json(array('status'=> 1, 'message'=> '修改成功'));
        } else {
            return Response::json(array('status'=> 0, 'message'=> '修改失败'));
        }

    }

    public function del(){
        $id = Input::get('id');
        $admin = new Admin();
        $res = $admin->deladmin($id);
         if ($res) {
            return Response::json(array('status'=> 1, 'message'=> '删除成功'));
        } else {
            return Response::json(array('status'=> 0, 'message'=> '删除失败'));
        }

    }

     public function addadmin(){
        return View::make('admin.admin.add');
     }

     public function AddData(){
        $admin = new Admin();

        $data = Input::get('data');
        
        $admin_data = $data['admin'];
        $r = $admin->check($admin_data['mobile']);
        if ($r) {
            return Response::json(array('status'=> 0, 'message'=> '该用户已注册'));
        }
        $res = $admin->add($admin_data);
        if($res){
            return Response::json(array('status'=> 1, 'message'=> '添加成功'));
        }else{
            return Response::json(array('status'=> 0, 'message'=> '添加失败'));
        }
     }
}