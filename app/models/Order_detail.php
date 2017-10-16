<?php 

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Order_detail extends Eloquent
{
    protected $table = 'orders_detail';

    function getList($oid)
    {
        $select = $this->select($fetch ? $fetch : array('admin.*'));

        $select->where('oid', $oid);


        return $select;

    }
    function getListPage($type = array(), $size = 15, $fetch = array())
    {
      $select = $this->select($fetch ? $fetch : array('orders.*'));

      // $select->leftJoin('company_sign', 'company_sign.id', '=', 'goods.company_sign_id');
      // $select->leftJoin('company', 'company.id', '=', 'goods.company_id');

      // $this->_where($select, $type);

      return $select->paginate($size);
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
