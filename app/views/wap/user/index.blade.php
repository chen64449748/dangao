@extends('wap.header')

@section('content')
<style type="text/css">
	.box-phone{display:none;}
	.hide {display: none;}
	.show {display: block;}
	.pic_edit {position: fixed;top: 0;width: 100%;height: 100%;z-index: 108;background:#3d3d3d;max-width:640px;}
	#clipArea {margin: 0 auto;height: 520px;}
	/*#clipBtn{margin-top: 5px;background-color: rgb(221, 39, 39);color: #fff;padding: 8px 20px;border-radius: 5px;width: 40%;}*/
	/*#upload2{margin-top: 5px;background-color: rgb(221, 39, 39);color: #fff;padding: 8px 20px;border-radius: 5px;width: 40%;margin-left: 3%;}*/
	#hit {position: fixed;top: 19%;left: 9.375%;background: gainsboro;}
	.logo {position: absolute;bottom: 12%;z-index: 100;width: 46%;left: 27%;}

	/*适应小屏*/
	@media screen and (max-height: 320px) {
	.show_labour .show_img {width: 5%;margin-top: 22%;}
	.show_labour .show5 {width: 80%;left: 10%;margin-top: 22%;}
	.show_labour .show5_btn {width: 62%;}
	/*#clipBtn, #upload2 {margin-top: 0px;padding: 5px 20px;}*/
	}
	.lazy_tip{position: absolute;margin-top: 70px;top:0;z-index: 1001;font-size: 20px;width: 100%;color: #05E2FF;line-height: 30px;text-align: center;left: 0;}
	.lazy_cover {width: 100%;height: 100%;background-color: black;z-index: 1000;color: #4eaf7a;font-size: 25px;opacity: 0.7;position: fixed;top: 0;left: 0;}
	#plan{ position:absolute;top:0;left:0; width:100%; clear:both; height:100%;display: none;
	background: rgb(255, 255, 255);
	vertical-align: baseline;
	text-align: center;
	line-height: 1.5;
	padding-top: 25%;}
	#plan canvas{clear:both;}
	.button{width: 100%;position: fixed;bottom: 0px;height: 40px;line-height: 40px;font-size: 14px;color: red;background-color: #f2f2f2;}
	.button div{padding:0 15px;}
	/*适应小屏*/
	@media screen and (max-width: 414px) {
		#clipArea {margin: 0 auto;height: 320px;}
	}
	td {padding: 16px 0;}
</style>

<div class="position_relative">
		<div class="personal_div01">会员中心</div>
		<img src="/wap/images/bg/personal.jpg" alt="" width="100%">

            <div class="personal_div02" style="height:42.7%;overflow: hidden;">               
                <img id="header_img" src="/wap/20170926101954.jpg" alt="" style="position: absolute;right: 0px;top:0;z-index: 9;width: 100%;height: 100%;">
            </div>
        <div class="personal_div03" style="color: #fff;">182324446</div>
        
		<a href="<!--{$my_shop_url}-->" class="personal_div05" style="white-space: nowrap;overflow: hidden;text-overflow: ellipsis;width: 70%;"><!--{$my_shop_url}--></a>
        
		
		<div style="margin-top: 12%;"></div>
	</div>
	

  
	<div class="paddingbuding01 margintop10 bg01">
		<div class="font_size03 paddingbuding02">我的订单</div>
	</div>
	<table cellpadding="0" cellspacing="0" width="100%" class="table01">
		<tr>
			<td width="25%" align="center">
				<a href="/user/orders?status=waiting" style="width: 100%;height: 100%; display: block;">
                <img src="/wap/images/icon/daifukuan.png" alt="" height="15">

				<div class="line_height20 color_gray">{{$waiting_count}}</div>
				<div class="color_silver line_height20">待付款</div>
                </a>
			</td>
			
			<td width="25%" align="center">
				<a href="/user/orders?status=payed" style="width: 100%;height: 100%; display: block;">
                <img src="/wap/images/icon/daishouhuo.png" alt="" height="18">
				<div class="line_height20 color_gray">{{$payed_count}}</div>
				<div class="color_silver line_height20">已付款</div>
                </a>
			</td>
		</tr>
		<tr>
			<td width="25%" align="center">
				<a href="/user/orders?status=close" style="width: 100%;height: 100%; display: block;">
                <img src="/wap/images/icon/yiguanbi.png" alt="" height="18">
				<div class="line_height20 color_gray">{{$close_count}}</div>
				<div class="color_silver">已关闭</div>
                </a>
			</td>
			<td width="25%" align="center">
				<a href="/user/orders?status=ok" style="width: 100%;height: 100%; display: block;">
                <img src="/wap/images/icon/quanbudingdan.png" alt="" height="15">
				<div class="line_height20 color_gray">{{$ok_count}}</div>
				<div class="color_silver line_height20">已完成</div>
                </a>
			</td>
			
		</tr>
	</table>

	<a href="<!--{$smarty.const.WESHOP_WWW}-->/help/content.php?id=120" class="paddingbuding01 bg01 display_block margintop10 bdbottom01">
		<div class="font_size03 paddingbuding02 lf">收货地址</div>
		<img src="/wap/images/icon/arrow02.png" alt="" height="12" class="margintop10 rt">
		<br class="clear">
	</a>
	<a href="<!--{$smarty.const.WESHOP_WWW}-->/help/" class="paddingbuding01 bg01 display_block">
		<div class="font_size03 paddingbuding02 lf">客服电话(18329042977)</div>
		<img src="/wap/images/icon/arrow02.png" alt="" height="12" class="margintop10 rt">
		<br class="clear">
	</a>
	<!-- <div class="paddingbuding01 margintop10"><a href="javascript:voind(0);" onclick="loginout();" class="anniu02" style="margin-bottom: 0;">退出</a></div> -->
	<a href="javascript:void(0)" class="totop"><img src="/wap/images/icon/totop.png" alt="" height="35"></a>
	<div style="height: 60px;"></div>


@include('wap.menu')
@stop