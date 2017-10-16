<html>
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8"/>
    <meta name="viewport" content="width=device-width,initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <!-- <link rel="shortcut icon" href="" type="image/x-icon"/> -->
    <link rel="stylesheet" type="text/css" href="/wap/css/style.css"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/public.css?v=20161223"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/menu.css?v=20161223"/>
    <link rel="stylesheet" type="text/css" href="/wap/css/iconfonts.css?v=20161223"/>

    <script type="text/javascript" src="/wap/js/jquery-1.10.2.min.js"></script>
    <script>
        var stylehost='';
    </script>
    <script type="text/javascript" src="/wap/js/jqs.js"></script>
    <script type="text/javascript" src="/wap/js/public.js"></script>
    <script type="text/javascript" src="/wap/js/loading.js"></script>

    <script type="text/javascript" src="/wap/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript" src="/wap/js/weixin.js"></script>

<meta name="description" content="<!--{$describe[0].title}-->" />
<meta name="keywords" content="<!--{$shopinfo.shop_name}-->-<!--{$shopName.val}-->"/>
<meta name="imguri" content="<!--{$shop_signs_url}-->" />
<meta name="pageuri" content="<!--{$smarty.const.WESHOP_WWW}-->/" />
<!-- 滑屏 -->
<link rel="stylesheet" href="/wap/css/swiper/swiper.min.css">
	<!-- banner -->
	<script type="text/javascript" src="/wap/js/jquery.flexslider-min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		$('.flexslider').flexslider({
			directionNav: true,
			pauseOnAction: false
		});
	});
	</script>

<link rel="stylesheet" type="text/css" href="/wap/css/mdstyle.css"/>
<style>
    .cl-rd {
        color: #da2021;
    }
    /*swiper*/
    .swiper-container {
        margin:8px 0 0 0;
        width: 100%;
        overflow: hidden;
    }
    .swiper-wrapper .swiper-slide {
        margin-right: 8px;

        display: -webkit-box;
        display: -ms-flexbox;
        display: -webkit-flex;
        display: flex;
        -webkit-box-pack: center;
        -ms-flex-pack: center;
        -webkit-justify-content: center;
        justify-content: center;
        -webkit-box-align: center;
        -ms-flex-align: center;
        -webkit-align-items: center;
        align-items: center;
    }
    .swiper-wrapper .swiper-slide:last-child {margin-right: 0px;}
    .swiper-wrapper .swiper-slide a {
        background-color :#fff;
        text-align: center;
        line-height: 25px;
    }
    .swiper-wrapper .swiper-slide p {
        font-size: 10px;
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
    }
    .swiper-wrapper.gb-wrapper .swiper-slide p {
        padding: 0 5px;
    }
    .swiper-scrollbar {display: none;}
    .alg-ct {text-align: center;}

    @media screen and (min-width: 320px) {
        .swiper-container.gai img {
            width: 80px;
            height: auto;
        }
        .swiper-container img {
            width: 80px;
            height: 70px;
        }
        /*.swiper-container {height: 137px;}*/
        .swiper-wrapper .swiper-slide p {width: 80px;}
        .gb-library.gb li {
            width:80px;
        }
    }
    @media screen and (min-width: 375px) and (max-width: 414px) {
        .swiper-container.gai img {
            width: 100px;
            height: auto;
        }
        .swiper-container img {
            width: 100px;
            height: 86px;
        }
        /*.swiper-container {height: 137px;}*/
        .swiper-wrapper .swiper-slide p {width: 100px;}
        .gb-library.gb li {
            width:100px;
        }
    }
    @media screen and (min-width: 640px) {
        .swiper-container.gai img {
            width: 180px;
            height: auto;
        }
        .swiper-container img {
            width: 180px;
            height: 155px;
        }
        /*.swiper-container {height: 240px;}*/
        .swiper-wrapper .swiper-slide p {width: 180px;}
        .gb-library.gb li {
            width: 180px;
        }

    }

    .gb-library.gb {
        border: 1px #eee solid;
        border-width: 0 0 0 0;
    }
    .gb-library.gb li {
        position: relative;
        width: auto;
        border-bottom: 0 #eee solid;
    }
    .gb-library.gb li:nth-child(3n+2):before {
        content: "";
        position: absolute;
        left: 0;
        top: 0;
        width: 0;
        height: 100%;
        background-color: #eee;
    }
    .gb-library.gb li:after {
        content: "";
        position: absolute;
        right: 0;
        top: 0;
        width: 1px;
        height: 100%;
        background-color: #eee;
    }

    .a_lk{padding:10px 3% 0 3%;background-color: #fff;line-height: 30px;display: block;}

    .gb-buy li {
        width: 50%;
        position: relative;
    }
    .gb-buy li div {position: relative;}
    .gb-after:after {
        content: "";
        position: absolute;
        right: 0;
        top: 0;
        width: 1px;
        height: 100%;
        background-color: #eee;
    }
    .gb-buy li:nth-child(2):after {
        content: "";
        position: absolute;
        right: 0;
        top: 50%;
        width: 100%;
        height: 1px;
        background-color: #eee;
    }
    .gb-abc .div_buding {
        background-color: #f3f3f3;
        padding:8px 0 0 8px;
    }

    #goods_sku { width: 100%; max-width: 640px; height: 530px; background: white; position: fixed; bottom: -558px; z-index: 10000; }
    #goods_sku .sku_submit { background: #e7526f; position: absolute; bottom: 0; max-width: 640px; width: 100%;}
    #goods_sku .sku_header {height: 90px;}

    #goods_sku .select_goods_img {
        width: 100px;
        height: 100px;
        position: absolute;
        top: -28px;
        left: 10px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,.1);
        padding: 1px;
        background-color: #fff;
    }

    #goods_sku .select_goods_price {
        color: #FF0036;
        margin-left: 130px;
        font-size: 14px;
        line-height: 18px;
        padding-right: 20px;
        width: 260px;
        padding-top: 24px;
    }

    #goods_sku .sku_close {
        position: absolute; top: 10px; right: 10px;
        width: 25px; height: 25px;
        background-image: url('/wap/images/icon_close.png');  
    }

    .sku_hr {
        border-bottom: 1px solid rgba(0,0,0,0.1); 
        width: 90%;
        margin: 0 auto;
        clear: both;
    }

    .sku_list {
        height: 400px;
        overflow-y: scroll; 
    }

    .sku_list li {
        padding: 10px 5%;
        
    }
    .sku_list .select_sku_name{

        color: #666;
        font-size: 13px;
        font-weight: 400;
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .sku_list li .items a {
        position: relative;
        display: inline-block;
        border: 1px solid #f5f5f5;
        background-color: #f5f5f5;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        margin: 0 8px 8px 0;
        color: #555;
    }

    .sku_list li .items a.checked {
        border-color: #FF0036;
        background-color: #FF0036;
        color: #fff;
    }


</style>
<title>{{$shop->shop_name}}</title>
</head>

<body>
@include('wap.sku_select')
@yield('content')
</body>
</html>
<script type="text/javascript" src="/wap/js/cart.js"></script>
