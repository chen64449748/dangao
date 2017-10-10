<?php 

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class Orders extends Eloquent
{
    protected $table = 'orders';

    public function order_detail()
  {
    return $this->hasOne('orders_detail','oid', 'id');
  }
    function getList($type = array(), $fetch = array())
    {
        $select = $this->select($fetch ? $fetch : array('orders.*'));

        $this->_where($select, $type);

        return $select->get();

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
    // function add($admin_data)
    // {
    //     if (!$admin_data) {
    //         return array('status'=>0,'msg'=> '无数据');
    //     }

    //     $admin = DB::insert("insert into admin (mobile,pwd) values(".$admin_data['mobile'].",".$admin_data['password'].")");

    //     return $admin;

    // }

    function add($user_id, $order, $detail, $address_id = null)
    {

        $order_id = $this->insertGetId($order);

        $update_order = array();
        $total_price = 0;

        foreach ($detail as $key => $value) {
            $detail[$key]['order_id'] = $order_id;
            $total_price += $value['price'];
          
            // 检测活动 修改活动价
        }

        $update_order['price'] = $total_price;

        if ($address_id) {
            $address = DB::table('user_address')->where('user_id', $user_id)->where('id', $address_id)->first();
        } else {
            $address = DB::table('user_address')->where('user_id', $user_id)->where('is_default', 1)->first();
        }

        if ($address) {
            $update_order['mobile'] = $address->phone;
            $update_order['name'] = $address->name;
            $update_order['address'] = $address->address;
        }

        $this->where('id', $order_id)->update($update_order);

        OrderDetails::insert($detail);

        return $order_id;


    }

    private function _where(&$select, $type) {
        foreach ($type as $key => $value) {
            switch ($key) {
                case 'id':
                    $select->where('orders.id', (int)$value);
                    break;
                case 'user_id':
                    $select->where('orders.user_id', (int)$value);
                    break;
              
            }
        }

    }
}
