<?php

class WxController extends \BaseController {

    private function new_wxservice(){
        $wxservice = new Wxservice;
        return $wxservice;
    }

    //配置接口
    public function index(){
        if (!isset($_GET['echostr'])) {
            $this->responseMsg();
        }else{
            $this->valid();
        }
    }
    
    //验证消息
    public function valid(){
        $echoStr = $_GET["echostr"];
        if($this->checkSignature()){
            echo $echoStr;
            exit;
        }
    }
    //检查签名
    private function checkSignature(){

        $signature = $_GET["signature"];
        $timestamp = $_GET["timestamp"];
        $nonce = $_GET["nonce"];
        $wxservice = $this->new_wxservice();
        $token = $wxservice->_token;
        $tmpArr = array($token, $timestamp, $nonce);
        sort($tmpArr, SORT_STRING);
        $tmpStr = implode($tmpArr);
        $tmpStr = sha1($tmpStr);
        if($tmpStr == $signature){
            return true;
        }else{
            return false;
        }
    }

    //响应消息
    public function responseMsg(){
        $postStr = isset($GLOBALS["HTTP_RAW_POST_DATA"])?$GLOBALS["HTTP_RAW_POST_DATA"]:"";
        if (!empty($postStr)){
            $postObj = simplexml_load_string($postStr, 'SimpleXMLElement', LIBXML_NOCDATA);
            $RX_TYPE = trim($postObj->MsgType);
            $openid = $postObj->FromUserName;
            if($RX_TYPE == 'event'){
                $result = $this->receiveEvent($postObj);
                echo $result;
            }else if($RX_TYPE == 'text'){
                $result = $this->keyreply($postObj);
                echo $result; 
                
            }else if($RX_TYPE =='image'){
                Log::info('你在哪里？有没到===》image');
                if($openid =='ozpF6t-RkY4483G4Z4PZwSdfk4ig'){
                  $result = $this->receiveImage($postObj); 
                  echo $result; 
                 }        
            }

        }
    }

    private function receiveImage($object){

                $media_id = $object->MediaId;
                Log::info("到存储media_id之前0-----》》》".json_encode($object));
                Log::info("到存储media_id之前1-----》》》".gettype($media_id).$media_id);
                $media = Media::create_new($media_id);
                // Cache::put('media_id',$media_id,4320);
                // $str = '{"media_id":"'.$media_id.'"}';
                // file_put_contents(dirname(app_path())."/public/assets/json/MediaId.json",$str);
                Log::info('到存储media_id了么====>？');
                $textTpl = "<xml>
                    <ToUserName><![CDATA[".$object->FromUserName."]]></ToUserName>
                    <FromUserName><![CDATA[".$object->ToUserName."]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[红包图片已经更新]]></Content>
                    </xml>";
                return $textTpl;
        }


    public function keyreply($object){
        $keyword = trim($object->Content);
        if($keyword =='你好'){
            $textTpl = "<xml>
                <ToUserName><![CDATA[".$object->FromUserName."]]></ToUserName>
                <FromUserName><![CDATA[".$object->ToUserName."]]></FromUserName>
                <CreateTime>".time()."</CreateTime>
                <MsgType><![CDATA[transfer_customer_service]]></MsgType>
                </xml>";
            return $textTpl;
        }
    }


    //接收事件消息
    private function receiveEvent($object){
        $content = "";
        $media_id= "";
        $openid = $object->FromUserName;
        switch ($object->Event){
            case "subscribe":
                 $content = '发财树——懒人理财！马上参与‘拉上好友赢现金’活动，奖励无上限！www.51fa.la';
                $this->total_api($openid,$object->EventKey);
                
                // $content = array();
                // $content[] = array("Title"=>"发财树感恩节大抽奖，狂送6S!",  "Description"=>"10万壕礼等你拿！据说颜值搞的人都能中奖", "PicUrl"=>asset('/assets/images/900X500banner.jpg'), "Url" =>"http://giving.51fa.la");
                // return $this->transmitNews($object,$content);
                break;
            case "unsubscribe":
                $content = "";
                // $this->total_api($openid,$object->EventKey);
                break;
            case "SCAN":
                // $content = "扫描场景 ".$object->EventKey;
                $content = '';
                $this->total_api($openid,$object->EventKey);
                break;
            case "CLICK":
                switch ($object->EventKey) {
                    case 'V1001_START_LOGIN': //开启免登录
                        $user = User::where('openid',$openid)->first();
                        if($user){
                            $content = '亲，你已经开启了免登录模式，若想关闭，请点击<a href="'.action_https('disbind',array('openid'=>$openid)).'">【关闭免登录功能】</a>';
                        }else{
                            $content = '想实时掌握资产收益，又不想每次登录输密码？立刻<a href="'.action_https('bind_phone',array('openid'=>$openid)).'">【开启免登录模式】</a>';
                        }
                        // $content = '功能正在开发中，敬请期待';
                        break;
                    case 'V1001_WX_SERVICES': //客服
                        $content = '亲，如果有问题想咨询，欢迎拨打发财树客服电话：021-61725271，或者在微信服务号留言。服务时间：工作日10:00-18:00。';
                        break;
                    case 'V1001_WX_MONEY'://红包
                        Log::info('红包点击-------》1');  
                        $media = Media::first();
                        $media_id = $media->media_id;  
                        // $code = json_decode(file_get_contents(dirname(app_path())."/public/assets/json/MediaId.json"));
                        // if($code){
                        //     Log::info('红包点击-------》2'); 
                        //     $media_id = $code->media_id;
                        // }else{
                        //     Log::info('红包点击-------》3'); 
                        //     $media_id = serialize(Cache::get('media_id'));
                        // }
                        
                        // $media_id = Cache::get('media_id');
                        break;
                    default:
                        break;
                }
                break;
            default:
                break;
        }
        if(!empty($content)&&empty($media_id)){
            $result = $this->transmitText($object, $content);
            return $result;
        }else if(!empty($media_id)&&empty($content)){
            $result = $this->transmitImg($object, $media_id);
            return $result;
        }
    }

    private function transmitImg($object,$media_id){
            if(!isset($media_id) || empty($media_id)){
                return "";
            }
            $textTpl = "<xml>
                    <ToUserName><![CDATA[".$object->FromUserName."]]></ToUserName>
                    <FromUserName><![CDATA[".$object->ToUserName."]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[image]]></MsgType>
                    <Image>
                    <MediaId><![CDATA[".$media_id."]]></MediaId>
                    </Image>
                    </xml>";
            Log::info('得到==>'.$textTpl);
            return $textTpl;
    }

    private function transmitText($object, $content){
        $textTpl = "<xml>
                    <ToUserName><![CDATA[".$object->FromUserName."]]></ToUserName>
                    <FromUserName><![CDATA[".$object->ToUserName."]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[text]]></MsgType>
                    <Content><![CDATA[".$content."]]></Content>
                    </xml>";
         return $textTpl;
    }
    
    private function transmitNews($postObj,$newsArray)
    {
        if(!is_array($newsArray)){
            return;
        }
   //      $itemTpl = "<item>
            //      <Title><![CDATA[".$item['Title']."]]></Title>
            //      <Description><![CDATA[".$item['Description']."]]></Description>
            //      <PicUrl><![CDATA[".$item['PicUrl']."]]></PicUrl>
            //      <Url><![CDATA[".$item['Url']."]]></Url>
            //  </item>
            // ";
        $item_str = "";
        foreach ($newsArray as $item){
            $item_str .= "<item>
                                <Title><![CDATA[".$item['Title']."]]></Title>
                                <Description><![CDATA[".$item['Description']."]]></Description>
                                <PicUrl><![CDATA[".$item['PicUrl']."]]></PicUrl>
                                <Url><![CDATA[".$item['Url']."]]></Url>
                            </item>
                        ";
        }
        $newsTpl = "<xml>
                    <ToUserName><![CDATA[".$postObj->FromUserName."]]></ToUserName>
                    <FromUserName><![CDATA[".$postObj->ToUserName."]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                    <MsgType><![CDATA[news]]></MsgType>
                    <Content><![CDATA[]]></Content>
                    <ArticleCount>".count($newsArray)."</ArticleCount>
                    <Articles>
                    $item_str
                    </Articles>
                    </xml>";
        // $result = sprintf($newsTpl, $postObj->FromUserName, $postObj->ToUserName, time(), count($newsArray));
        return $newsTpl;
    }

    //生成菜单
    public function create_menu(){

        /**
         *      "type":"view",
         *      "name":"抽奖",
         *      "url":"http://giving.51fa.la"
        */
        $data = '{
                "button":[
                {  
                    "type":"view",
                    "name":"进入发财树",
                    "url":"'.action_https('product.index').'"
                },
                {
                "name":"快速投资",
                    "sub_button":[
                    {
                        "type":"view",
                        "name":"公募基金",
                        "url":"'.action_https('product.list_o').'"
                    },
                    {   
                        "type":"view",
                        "name":"明星产品",
                        "url":"'.action_https('product.list_n').'"
                    },
                    {
                        "type":"view",
                        "name":"新用户体验",
                        "url":"'.action_https('product.list_f').'"
                    }]
                },
                {
                "name":"服务中心",
                    "sub_button":[
                    {
                    "type":"click",
                    "name":"免登录功能",
                    "key":"V1001_START_LOGIN"
                    },
                    {
                        "type":"view",
                        "name":"快速注册",
                        "url":"'.action_https('user_add_phone').'"
                    },
                    {   
                        "type":"view",
                        "name":"我的资产",
                        "url":"'.action_https('myasset').'"
                    },
                    {   
                        "type":"click",
                        "name":"微信客服",
                        "key":"V1001_WX_SERVICES"
                    },
                    {
                        "type":"view",
                        "name":"关于发财树",
                        "url":"'.action_https('aboutus').'"
                    }
                    ]
                }]
            }';
        // $data = '{
        //         "button":[
        //         {  
        //             "type":"view",
        //             "name":"进入发财树",
        //             "url":"'.action_https('product.index').'"
        //         },
        //         {
        //             "type":"view",
        //             "name":"发财币",
        //             "url":"'.action_https('explain').'"
        //         },
        //         {
        //         "name":"产品列表",
        //             "sub_button":[
        //             {
        //                 "type":"view",
        //                 "name":"高收益",
        //                 "url":"'.action_https('product.list_n').'"
        //             },
        //             {   
        //                 "type":"view",
        //                 "name":"短期限",
        //                 "url":"'.action_https('product.list_f').'"
        //             }]
        //         }]
        //     }';
        $wxservice = $this->new_wxservice();
        echo $wxservice->create_menu_api($data);
    }

    //获取code
    public function get_openid(){
        $code  = $_GET['code'];
        $state = $_GET['state'];
        $wxservice = $this->new_wxservice();
        $openid= $wxservice->getOpenid($code);
        Session::put('openid',$openid);
        $url = urldecode(base62_decode($state));
        if(strpos($url,'?')){
            return Redirect::to($url.'&openid='.$openid);
        }else{
            return Redirect::to($url.'?openid='.$openid);
        }
    }
    
    public function do_check(){
        $phone = Input::get('phone');
        $user = User::findByPhone($phone);
        if($user){
            echo 1;
        }else{
            echo 0;
        }
    }

    public function bind_phone($openid){
        Session::put('openid',$openid);
        Session::put('fcspgkey',md5('code_save_key'));
        $user = User::where('openid',$openid)->first();
        return View::make('phone.weixin.user_blind')->with(compact('user'));
    }

    public function do_bind(){
        $phone = Input::get('phone');
        $code = Input::get('code');
        $openid= Session::get('openid');
        if(Session::has('phone_code')){
            if($code = Session::get('phone_code')){
                DB::beginTransaction(); //开启事务
                try{
                    $user = User::findByPhone($phone);
                    $user->openid   = $openid;
                    $user->bind_time = date('Y-m-d H:i:s');
                    $user->save();

                    $this->bind_prize($user,$openid);
                   
                    Session::put('phone',$phone);
                    Session::put('userinfo',$user);
                }catch(Exception $e){
                    DB::rollback(); //回滚事务
                    return false;
                }
                DB::commit(); //提交事务
                
                echo 1;//成功
            }else{
                echo 2;//验证码错误
            }
        }else{
            echo 3;//验证码失效
        }
    }

    //微信绑定奖励
    private function bind_prize($user,$openid){
        $prize = Prize::where('type',5)->first();
        if($user->bind_prize == 0 && $prize->new_user > 0){ //未绑定过得用户
            $data = '{
                "touser":"'.$openid.'",
                "msgtype":"news",
                "news":{
                    "articles": [
                    {
                         "title":"开启免登录成功，获得'.$prize->new_user.'元发财币！",
                         "description":"恭喜你成功开启微信免登录功能。从此随时看收益，及时获取资产变动信息。",
                         "url":"'.action_https('my_money').'",
                 S        "picurl":"'.asset('/assets/images/414309858942424385.jpg').'"
                    }]
                }
            }';
            $wxservice = $this->new_wxservice();
            $url = "https://api.weixin.qq.com/cgi-bin/message/custom/send?access_token=".$wxservice->getAccessToken();
            $result = https_post($url,$data);
            $account = TreeAccount::firstOrCreate(['user_id'=>$user->id]);
            $account->prize_money = $prize->new_user + $account->prize_money;
            $account->save();

            $user->bind_prize = 1; //记录已经奖励过
            $user->save();

            Session::put('userinfo',$user);
            $user->prizelog_for_new($prize->new_user,$prize->new_type,10,$buy=0,$account->prize_money);
        }
    }

    public function disbind($openid){
        Session::put('fcspgkey',md5('code_save_key'));
        $user = User::where('openid',$openid)->first();
        return View::make('phone.weixin.user_disblind')->with(compact('user'));
    }

    public function do_disbind(){
        $phone = Input::get('phone');
        $code = Input::get('code');
        if(Session::has('phone_code')){
            if($code = Session::get('phone_code')){
                $user = User::findByPhone($phone);
                $user->openid   = '';
                $user->bind_time = '';
                $user->save();

                Session::forget('phone');
                Session::forget('userinfo');
                echo 1;//成功
            }else{
                echo 2;//验证码错误
            }
        }else{
            echo 3;//验证码失效
        }
    }

    //接口api
     public function total_api($openid,$event_key){
        $url ='http://event.51fa.la/wxapi/get_event.php';
        $url.='?event_key='.$event_key;
        $url.='&open_id='.$openid;
        $res = https_post($url);
        Log::info("{$openid}***{$event_key}***{$res}");
        return $res;
    }

    //获取openid api
    public function get_openid_api(){
        $url = Input::get('url');
        $url = base62_encode($url);
        $wxservice = $this->new_wxservice();
        $authorize_url = $wxservice->getPromise($url);
        return Redirect::to($authorize_url);
    }

    //获取给年中奖的openid 以及参数
    public function get_year_api(){
        $url = Input::get('url');
        $url = base62_encode($url);
        $wxservice = $this->new_wxservice();
        Log::info('开始获取jssdk');
        $jssdk = $wxservice->get_jssdk_config();
        $app = $jssdk['appId'];
        $nonceStr = $jssdk['nonceStr'];
        $timestamp = $jssdk['timestamp'];
        $signature = $jssdk['signature'];  
        $url = $url&$app&$nonceStr&$timestamp&$signature;
        $authorize_url = $wxservice->getPromise($url);
        return Redirect::to($authorize_url);
    }

    public function test(){
        $res = $this->total_api('123','123');
        echo $res;
    }

    //
    public function get_snsapi_userinfo(){
            $code = Input::get('code');
            $secret = Input::get('secret');
            $back_url = Input::get('back_url',0);
            if($code){
                $appid   = 'wx17a53cfc8631ac51';
                $secret = 'eb5246635936b887cb6a75f0aaa854c3';
                $result = file_get_contents("https://api.weixin.qq.com/sns/oauth2/access_token?appid=".$appid 

                    ."&secret=".$secret."&code=".$code."&grant_type=authorization_code");
                $result = json_decode($result);
                if(!empty($result->errcode)){
                    $return_msg = '{"errcode":"获取access_token失败！","errmsg":"'.$result->errmsg.'"}';
                }else{
                    $url = "https://api.weixin.qq.com/sns/userinfo?access_token=".$result->access_token 

                        ."&openid=".$result->openid."&lang=zh_CN";
                    $rel = file_get_contents($url);
                    $rel = json_decode($rel);
                    if(!empty($rel->errcode)){
                        $return_msg = '{"errcode":"获取用户信息失败！","errmsg":"'.$rel->errmsg.'"}';
                    }else{
                        $rel->errcode = '0';
                        $rel = json_encode($rel);
                        $return_msg = $rel;
                    }
                }
            }else{
                $return_msg = '{"errcode":"用户授权失败"}';
            }

            if(!$back_url){
                header("Location:http://event.51fa.la/annualbonus/yearaward.php?return_msg=".$return_msg);
            }else{
                header("Location:".$back_url."/yearaward.php?return_msg=".$return_msg);
            }
       }

    //微信模板消息
    public function wx_model($openid){
        $token_json = file_get_contents("https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=wx17a53cfc8631ac51&secret=eb5246635936b887cb6a75f0aaa854c3");
        $token_arr = json_decode($token_json,true);
        $token = $token_arr['access_token'];
        $push_url = "https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token;

        $postdata = '{
            "touser":"'.$openid.'",
            "template_id":"QDjY4dYjDTJY8AlMEeT96PtQ9Ml6LU20YAHMH2GNOdU",
            "url":"https://jinshuju.net/f/9QrwxV",
            "data":{
                "first":{
                    "value":"猜灯谜赢50元现金奖励！",
                    "color":"#173177"
                },
                "keyword1":{
                    "value":"发财树理财元宵灯谜会",
                    "color":"#173177"
                },
                "keyword2":{
                    "value":"2016-02-22",
                    "color":"#173177"
                },
                "remark":{
                    "value":"发财树理财“元宵猜灯谜大赛”开始啦，点击本条通知即可进入答题页面！前50位答对的用户，我们将为您随机送出5-50元发财币奖励！",
                    "color":"#173177"
                }
            }
        }';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_URL,$push_url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
        ob_start();
        curl_exec($ch);
        $result = ob_get_contents();
        ob_end_clean();

        print_r($result);
    }

    //发送
    public function push_msg(){
        $users = User::where('openid','<>','')->get();
        foreach ($users as $key => $user) {
            $this->wx_model($user->openid);
        }
    }

}