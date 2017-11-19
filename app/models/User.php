<?php
class User extends Eloquent{
    protected $table = 'user';
    protected $guarded = array('id');
    public function buylogs(){
        return $this->hasMany('Buylog');
    }

    public function userbanks(){
        return $this->hasMany('Userbank');
    }

    public function opens(){
        return $this->hasMany('Open');
    }

    public function tradelogs(){
        return $this->hasMany('Tradelog');
    }

    public function prizelogs(){
        return $this->hasMany('Prizelog');
    }

    public function test(){
        return $this->hasOne('Testcp');
    }
    
    // //获取可用银行列表
    // public static function getUseBankListByUserId($user_id){
    //  $userbanks = Userbank::where('user_id',$user_id)->where('status',1)->get();
    //  return $userbanks;
    // }
    // //获取可用银行列表第一个
    // public static function getUseBankFirstByUserId($user_id){
    //  $userbank = Userbank::where('user_id',$user_id)->where('status',1)->first();
    //  return $userbank;
    // }

    //判断用户是否登陆
    public static function isLogin(){
        $user = Session::get('user');
        if($user){
            return true;
        }else{
            self::dologin();
        }
        
    }

    //登陆。没登录就登录。没注册就注册并登录
    public static function dologin(){
        return Redirect::to('user/login');
    }

     //登陆。没登录就登录。没注册就注册并登录
    public static function login($data){
        $openid = $data['openid'];
        if (empty($openid)) {
            die('lose openid');
        }
        $user = User::where('weixin_openid',$openid)->first();
        $time = date('Y-m-d H:i:s');
        if($user){
            
        }else{
            DB::table('user')->insert(
                array('nick' => $data['nickname'],
                     'avatar' => $data['headimgurl'],
                     'sex' => $data['sex'] == '1' ? 'm' : ($data['sex'] == '2' ? 'f' : ''),
                     'province' => $data['province'],
                     'city' => $data['city'],
                     'weixin_openid' => $openid,
                     'create_time' => $time,
            ));

        }
        $uinfo = User::where('weixin_openid',$openid)->first();
        Session::set('user',$uinfo);
        return $uinfo; 
    }
}