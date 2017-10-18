<?php
class Wxservice extends Eloquent{

    public $_token     = 'token';

    private $appid     = 'wx30270429e437180c';
    private $appsecret = 'd24eb00c51f9fb46f0eafe1738220864';
    // private $appid     = 'wx425f5cea3ace2da5';
    // private $appsecret = 'c2ccae2b5473a496db813b63e24b88a5';

    //获取access_token
    private function getNewAccessToken(){
        $token_url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential';
        $token_url.= '&appid='.$this->appid;
        $token_url.= '&secret='.$this->appsecret;
        $json  =https_post($token_url);
        $result=json_decode($json,true);
        $access_token=$result['access_token'];
        return $access_token;
    }

    public function getAccessToken(){
        $access_token=$this->getNewAccessToken();
        return $access_token;
    }
     public function getaccesst($code){
        $str=file_get_contents('https://api.weixin.qq.com/sns/oauth2/access_token?appid='.$this->appid.'&secret='.$this->appsecret.'&code='.$code.'&grant_type=authorization_code');
        //echo $str;
        $data=json_decode($str,true);
        if(!isset($data['openid'])){
            die("获取openid失败！");
            return null;
        }
        return $data;
    } 
    private function getUserInfo($token){
        $access_token=$token['access_token'];
        $openid=$token['openid'];
        $str=file_get_contents('https://api.weixin.qq.com/sns/userinfo?access_token='.$access_token.'&openid='.$openid.'&lang=zh_CN');
        $data=json_decode($str,true);
        return $data;
    }

    //自定义菜单
    public function create_menu_api($jsonmenu){
        $menu_url  = 'https://api.weixin.qq.com/cgi-bin/menu/create?access_token='.$this->getAccessToken();
        $result = https_post($menu_url, $jsonmenu);
        return $result;
    }

    public function getPromise($url){        
        //获取code回调url
        Log::info('获取code回调url');
        // $url = base62_encode($url);
        //授权URL
        $authorize_url = "https://open.weixin.qq.com/connect/oauth2/authorize?";
        $authorize_url.= "appid=".$this->appid;
        $authorize_url.= "&redirect_uri=".urlencode(action_https('get_openid'));
        $authorize_url.= "&response_type=code&scope=snsapi_base&state=".$url;
        $authorize_url.= "#wechat_redirect";
        Log::info($authorize_url);
        return $authorize_url;
    }

    public function getOpenid($code){
        Log::info('code交换获取openid');
        $access_token_url = "https://api.weixin.qq.com/sns/oauth2/access_token?";
        $access_token_url.= "appid=".$this->appid;
        $access_token_url.= "&secret=".$this->appsecret;
        $access_token_url.= "&code=".$code;
        $access_token_url.= "&grant_type=authorization_code";
        $access_token_json = https_post($access_token_url);
        $access_token_array = json_decode($access_token_json, true);
        $openid = $access_token_array['openid'];
        return $openid;
    }

    //=========
        #jssdk配置参数
        public function get_jssdk_config(){
            $jsapiTicket = $this->getJsApiTicket();
            $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
            $timestamp = time();
            $nonceStr = $this->createNonceStr();
            // 这里参数的顺序要按照 key 值 ASCII 码升序排序
            $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
            $signature = sha1($string);
            $signPackage = array("appId"=>$this->appid,"nonceStr"=>$nonceStr,"timestamp"=>$timestamp,"url"=>$url,"signature"=>$signature,
                "rawString"=>$string);
            return $signPackage;
        }

        private function createNonceStr($length = 16){
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
            $str = "";
            for($i = 0; $i < $length; $i++){
                $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
            }
            return $str;
        }

        private function getJsApiTicket(){
          
            if(Cache::has('ticket') && !Cache::get('ticket')){
                $ticket = Cache::get('ticket');
            }else{
                $accessToken = $this->getAccessToken();
                $url = "https://api.weixin.qq.com/cgi-bin/ticket/getticket?type=jsapi&access_token=$accessToken 

";
                $res = json_decode($this->httpGet($url));
                $ticket = $res->ticket;
                Cache::put('ticket',$ticket,60);
            }
            return $ticket;
        }

        private function httpGet($url){
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($curl, CURLOPT_TIMEOUT, 500);
            curl_setopt($curl, CURLOPT_URL, $url);
            $res = curl_exec($curl);
            curl_close($curl);
            return $res;
        }




}