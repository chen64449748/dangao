<?php 

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Admin extends Eloquent
{
    protected $table = 'admin';

    function getList($type = array(), $fetch = array())
    {
        $select = $this->select($fetch ? $fetch : array('admin.*'));

        // $this->_where($select, $type);

        return $select->get();

    }

    function checkadmin($id,$pwd){
       $res =  DB::table('admin')->where('id', $id)->where('pwd', $pwd)->first();
       return $res;
       // if($res){
       //     return ture;
       // }else{
       //     return false;
       // }
    }
    function updateadmin($id,$pwd){
        $res = DB::update("update admin set pwd = ".$pwd."  where id = ".$id);
        return $res;
       // $res = DB::table('admin')->where('id',$id)->update(array('pwd'=> $pwd));
       // if($res){
       //     return ture;
       // }else{
       //     return false;
       // }

    }

    function deladmin($id){
        $res = DB::table('admin')->where('id',$id)->delete();
        return $res;
    }

    function check($mobile){
        $res =  DB::table('admin')->where('mobile', $mobile)->first();
       return $res;
    }
    function add($admin_data)
    {
        if (!$admin_data) {
            return array('status'=>0,'msg'=> '无数据');
        }

        $admin = DB::insert("insert into admin (mobile,pwd) values(".$admin_data['mobile'].",".$admin_data['password'].")");

        return $admin;

    }

}
