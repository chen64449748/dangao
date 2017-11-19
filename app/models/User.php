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
            // Match Emoticons
            $regexEmoticons = '/[\x{1F600}-\x{1F64F}]/u';
            $nick = preg_replace($regexEmoticons, '', $data['nickname']);
             // Match Miscellaneous Symbols and Pictographs
            $regexSymbols = '/[\x{1F300}-\x{1F5FF}]/u';
            $nick = preg_replace($regexSymbols, '', $nick);

            // Match Transport And Map Symbols
            $regexTransport = '/[\x{1F680}-\x{1F6FF}]/u';
            $nick = preg_replace($regexTransport, '', $nick);

            // Match Miscellaneous Symbols
            $regexMisc = '/[\x{2600}-\x{26FF}]/u';
            $nick = preg_replace($regexMisc, '', $nick);

            // Match Dingbats
            $regexDingbats = '/[\x{2700}-\x{27BF}]/u';
            $nick = preg_replace($regexDingbats, '', $nick);
            // $nick= mb_convert_encoding($data['nickname'], 'UTF-8');
            // $nick = preg_replace('/\xEE[\x80-\xBF][\x80-\xBF]|\xEF[\x81-\x83][\x80-\xBF]/', '', $data['nickname']);
            // $nick = preg_replace('/xE0[x80-x9F][x80-xBF]'.'|xED[xA0-xBF][x80-xBF]/S','?', $data['nickname'] );
            DB::table('user')->insert(
                array('nick' => $nick,
                     'avatar' => $data['headimgurl'],
                     'sex' => $data['sex'],
                     'province' => $data['province'],
                     'city' => $data['city'],
                     'weixin_openid' => $openid,
                     'create_time' => $time,
            ));

        }
        $uinfo = User::where('weixin_openid',$openid)->first();
        Session::set('user',$uinfo);
        Session::set('user_id',$uinfo->id);
        return $uinfo; 
    }
}