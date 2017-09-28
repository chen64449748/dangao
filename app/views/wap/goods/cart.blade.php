@extends('wap.header')

@section('content')
<div class="top">
	<span>购物车</span>
	<a href="javascript:history.back(-1);" class="lf marginleft10">
		<img src="/wap/images/icon/back.png" alt="" height="16" style="position: relative; top: 16px;" ></a> 
		<a href="javascript:void(0);" class="anniu03 marginright10 rt margintop05 disabled" id="del">删除</a>
		<br class="clear" />
</div>
<div style="height: 44px;"></div>

<div class="content">
	<div class="gwc" style="margin: auto;overflow: hidden;">
    <table cellpadding="0" cellspacing="0" class="gwc_tb2 paddingbuding01" id="count" width="100%">
		<tr>
			<td class="tb2_td1" width="30" align="center" style="position: relative;">
			
				<div class="md-md_arrow-con">
					<input type="checkbox" value=""  name="newslist" id="newslist" class="md-md_arrow checkbox-blue check"/>
				</div>

			</td>	
			<td class="tb2_td2" align="center" width="100">
				<div class="div_buding"><a href="/detail/1" style="height: 100%;display: block;"> <img src="/wap/20170926101954.jpg"alt="" width="100%"></a></div>
				<div class="font_size01 color_red align_center"></div>
			</td>
			<td>
				<table cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<td>
							<a href="/detail.php?id=<!--{$goods.goods_id}-->">蛋糕1</a>
							<div class="font_size01 color_silver margintop05" style="word-break: break-all;">10寸</div>
							<div><span class="color_pink font_size02">￥19.9</span>&emsp;<del class="font_size01 color_gray">￥109</del>&emsp;<span class="color_silver font_size02">x<span id="goods_number-<!--{$key}-->">1</span></span></div>
							<div class="font_size01 color_silver">现货</div>
						</td>
					</tr>
					<tr>
						<td class="count" style="border:none;">
							<div style="margin-top: 10px;">
								<div class="count lf">
									<a href="javascript:void(0);" id="" class="sub lf shoppingcart_min" >-</a>
	                                <input type="text" value="1" class="text lf number_box">
									<a href="javascript:void(0);" id="" class="add rt shoppingcart_add" >+</a>
									<br class="clear" />
								</div>
								<a href="javascript:void(0);" class="rt marginright10"><img src="/wap/images/icon/delete.png" onclick="deleteShopCart(<!--{$key}-->)" height="16"></a>
								<br class="clear">
							</div>
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>

	</div>
</div>

<div class="align_center">
    <img src="/wap/images/icon/dingdan3.png" alt="" height="48" style="margin: 50px 0 10px 0;">
    <div class="color_gray font_size02">您的购物车为空</div>
    <a href="/goods" class="anniu03 margintop10 marginbottom10 jz" style="background-color: #e7526f;">去逛逛</a>
</div>





<style type="text/css">
.submit-btn { display: block; background-color: #e7526f;}
.disabled { background-color: #c9c9c9; }
.md-md_arrow{-webkit-appearance: none;position: relative;width: 20px;height: 20px;margin-left: 10px;background-color: #d9d9d9;border-top-left-radius: 20px;border-top-right-radius: 20px;border-bottom-left-radius: 20px;border-bottom-right-radius: 20px;background-clip: padding-box;display: inline-block;}
.md-md_arrow:focus{outline: 0 none;outline-offset: -2px;}
.md-md_arrow:checked{background-color: #e7526f;}
.md-md_arrow:before{content: url(/wap/images/icon/gou.png);color: #fff;position: absolute;left: 4px;line-height: 20px;font-size: 20px;bottom:4px;}
.md-md_arrow.checkbox-blue:checked{background-color: #e7526f;}

.md_arrow{width: 0;height: 0;border-top: 8px solid #d50000;border-right: 8px solid transparent;border-bottom: 8px solid transparent;transform:rotate(-135deg);position: absolute;left: 50%;margin-left: -4px;bottom: -4px;}
</style>
<div style="height: 40px;"></div>

			<table cellpadding="0" cellspacing="0" class="gwc_tb3" width="100%" id="base" style="position: fixed;width: 100%;max-width: 640px;bottom: 50px;background-color: #fff;border-top:1px #eee solid;padding: 6px 0;">
				<tr>
					<td class="tb3_td3 " width="6%" align="center">
                        <div class="md-md_arrow-con">
							<input type="checkbox" value="" class="md-md_arrow checkbox-green c-all" checked name="newslist2"  id="newslist-<!--{$key}-->"/>
						</div>
					</td>


					<td class="font_size02">
                        <div class="lf" style="margin-left: 4px;">应付总额：</div>
						<span class="lf color_pink"><span>￥0.00</span><label id="zong1"></label></span>
						<br class="clear">
					</td>
					<td class="tb3_td4">
						<div class="rt">
							<a href="javascript:void(0);" class="anniu03 submit-btn marginright10" id="jz2">结算</a>
						</div> <br class="clear">
					</td>
				</tr>
			</table>


		</div>
		<div class="order" style="display:none;">
			<form action="/shopping/order.php" method="get" id="order_submit">
				<input name="selected" value="1" type="hidden"/>
			</form>
		</div>
	</div>
	<div style="height: 60px;"></div>

@include('wap.menu')
<script>		
confirm('123', function() {});
</script>
@stop