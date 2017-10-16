<?php
class wxpay {
    public static function getjsApiParameters($out_trade_no, $body, $total_fee, $openid, $from = null) {
        include_once '../wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init($from);

        $jsApi = new JsApi_pub();

        $unifiedOrder = new UnifiedOrder_pub();

        $unifiedOrder->setParameter("openid", $openid); //openid
        $unifiedOrder->setParameter("body", $body); //商品描述
        $unifiedOrder->setParameter("out_trade_no", $out_trade_no); //商户订单号
        $unifiedOrder->setParameter("total_fee", $total_fee); //总金额
        $unifiedOrder->setParameter("notify_url", WxPayConf_pub::$NOTIFY_URL); //通知地址
        $unifiedOrder->setParameter("trade_type", "JSAPI"); //交易类型
        //非必填参数，商户可根据实际情况选填
        //$unifiedOrder->setParameter("sub_mch_id","XXXX");//子商户号
        //$unifiedOrder->setParameter("device_info","XXXX");//设备号
        //$unifiedOrder->setParameter("attach","XXXX");//附加数据
        //$unifiedOrder->setParameter("time_start","XXXX");//交易起始时间
        //$unifiedOrder->setParameter("time_expire","XXXX");//交易结束时间
        //$unifiedOrder->setParameter("goods_tag","XXXX");//商品标记
        //$unifiedOrder->setParameter("openid","XXXX");//用户标识
        //$unifiedOrder->setParameter("product_id","XXXX");//商品ID

        $prepay_id = $unifiedOrder->getPrepayId();
        //=========步骤3：使用jsapi调起支付============
        $jsApi->setPrepayId($prepay_id);

        $jsApiParameters = $jsApi->getParameters();
        //var_dump($unifiedOrder);
        //echo $jsApiParameters;
        return $jsApiParameters;
    }

    public static function notify() {
        include_once constant('APP_PATH') . 'wxpay/log_.php';
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();

        //使用通用通知接口
        $notify = new Notify_pub();

        //存储微信的回调
        // $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $xml = file_get_contents("php://input");
        // Logs::write($xml, 'wxpay');
        $notify->saveData($xml);

        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        //Logs::write(print_r($notify->data,true));
        if ($notify->checkSign() == FALSE) {
            $notify->setReturnParameter("return_code", "FAIL"); //返回状态码
            $notify->setReturnParameter("return_msg", "签名失败"); //返回信息
        } else {
            if ($notify->data["return_code"] == "SUCCESS" && $notify->data["result_code"] == "SUCCESS") {
                $re = wxpay_callback::payok($notify->data["out_trade_no"], $notify->data["transaction_id"], $notify->data);
                if (!$re) {
                    $notify->setReturnParameter("return_code", "FAIL"); //返回状态码
                    $notify->setReturnParameter("return_msg", "签名失败"); //返回信息
                } else {
                    $notify->setReturnParameter("return_code", "SUCCESS"); //设置返回码
                }
            } else {
                $notify->setReturnParameter("return_code", "SUCCESS"); //设置返回码
            }

        }
        $returnXml = $notify->returnXml();

        echo $returnXml;

    }

    public static function notify_miniapp() {
        include_once constant('APP_PATH') . 'wxpay/log_.php';
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init('miniapp');

        //使用通用通知接口
        $notify = new Notify_pub();

        //存储微信的回调
        // $xml = $GLOBALS['HTTP_RAW_POST_DATA'];
        $xml = file_get_contents("php://input");
        // Logs::write($xml, 'wxpay');
        $notify->saveData($xml);

        //验证签名，并回应微信。
        //对后台通知交互时，如果微信收到商户的应答不是成功或超时，微信认为通知失败，
        //微信会通过一定的策略（如30分钟共8次）定期重新发起通知，
        //尽可能提高通知的成功率，但微信不保证通知最终能成功。
        //Logs::write(print_r($notify->data,true));
        if ($notify->checkSign() == FALSE) {
            $notify->setReturnParameter("return_code", "FAIL"); //返回状态码
            $notify->setReturnParameter("return_msg", "签名失败"); //返回信息
        } else {
            if ($notify->data["return_code"] == "SUCCESS" && $notify->data["result_code"] == "SUCCESS") {
                $re = wxpay_callback::payok($notify->data["out_trade_no"], $notify->data["transaction_id"], $notify->data);
                if (!$re) {
                    $notify->setReturnParameter("return_code", "FAIL"); //返回状态码
                    $notify->setReturnParameter("return_msg", "签名失败"); //返回信息
                } else {
                    $notify->setReturnParameter("return_code", "SUCCESS"); //设置返回码
                }
            } else {
                $notify->setReturnParameter("return_code", "SUCCESS"); //设置返回码
            }

        }
        $returnXml = $notify->returnXml();

        echo $returnXml;

    }

    public static function queryorder($out_trade_no) {
        include_once '../wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();
        $queryorder = new OrderQuery_pub();
        $queryorder->setParameter("out_trade_no", $out_trade_no); //商户订单号
        return $queryorder->getResult();
    }

    public static function queryrefund($out_trade_no) {
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();
        $queryrefund = new RefundQuery_pub();
        $queryrefund->setParameter("out_trade_no", $out_trade_no); //商户订单号
        return $queryrefund->getResult();
    }

    public static function queryrefund_outrefundno($out_refund_no) {
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();
        $queryrefund = new RefundQuery_pub();
        $queryrefund->setParameter("out_refund_no",$out_refund_no); //商户订单号
        return $queryrefund->getResult();
    }
    // C 端支付
    public static function sysorderpaystatus($out_trade_no) {
        $ret = self::queryorder($out_trade_no);
        if ($ret["return_code"] == "SUCCESS" && $ret["result_code"] == "SUCCESS" && $ret["trade_state"] == "SUCCESS") {
            orders::payok($out_trade_no);
            return true;
        } else {
            return false;
        }

    }

    public static function closeorder($out_trade_no) {
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();
        $closeorder = new CloseOrder_pub();
        $closeorder->setParameter("out_trade_no", $out_trade_no); //商户订单号
        return $closeorder->getResult();

    }

    public static function refund($out_refund_no, $out_trade_no, $total_fee, $refund_fee) {
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();

        $refund = new Refund_pub();
        $refund->setParameter("out_refund_no", $out_refund_no); //商品描述
        $refund->setParameter("out_trade_no", $out_trade_no); //商户订单号
        $refund->setParameter("total_fee", $total_fee); //总金额
        $refund->setParameter("refund_fee", $refund_fee); //总金额
        $refund->setParameter("op_user_id", WxPayConf_pub::$MCHID); //
        return $refund->getResult();

    }
    public static function fahongbao($mch_billno, $nick_name, $re_openid, $total_amount, $act_name, $wishing, $remark, $client_ip) {
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();

        $hongbao = new Hongbao_pub();
        $hongbao->setParameter("mch_billno", $mch_billno);
        $hongbao->setParameter("nick_name", $nick_name);
        $hongbao->setParameter("re_openid", $re_openid);
        $hongbao->setParameter("total_amount", $total_amount);
        $hongbao->setParameter("wishing", $wishing);
        $hongbao->setParameter("client_ip", $client_ip);
        $hongbao->setParameter("act_name", $act_name);
        $hongbao->setParameter("remark", $remark);
        return $hongbao->getResult();
    }

    public static function fagrouphongbao($mch_billno, $send_name, $re_openid, $total_amount, $total_num, $act_name, $wishing, $remark, $client_ip) {
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init();

        $groupHongbao = new GroupHongbao_pub();
        $groupHongbao->setParameter("send_name", $send_name);
        $groupHongbao->setParameter("mch_billno", $mch_billno);
        $groupHongbao->setParameter("total_num", $total_num);
        // $groupHongbao->setParameter("nick_name",$nick_name);
        $groupHongbao->setParameter("re_openid", $re_openid);
        $groupHongbao->setParameter("total_amount", $total_amount);
        $groupHongbao->setParameter("wishing", $wishing);
        $groupHongbao->setParameter("client_ip", $client_ip);
        $groupHongbao->setParameter("act_name", $act_name);
        $groupHongbao->setParameter("remark", $remark);
        return $groupHongbao->getResult();
    }

    public static function zhuangzhang($partner_trade_no, $openid, $amount, $desc, $spbill_create_ip, $from = null) {
        include_once constant('APP_PATH') . 'wxpay/WxPayPubHelper/WxPayPubHelper.php';
        WxPayConf_pub::init($from);

        $zhuangzhang = new ZhuanZhang_pub();
        $zhuangzhang->setParameter("partner_trade_no", $partner_trade_no);
        $zhuangzhang->setParameter("openid", $openid);
        $zhuangzhang->setParameter("amount", $amount);
        $zhuangzhang->setParameter("desc", $desc);
        $zhuangzhang->setParameter("spbill_create_ip", $spbill_create_ip);
        return $zhuangzhang->getResult();
    }

}