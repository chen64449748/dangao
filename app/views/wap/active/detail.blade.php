@extends('wap.header')

@section('content')

<div class="top">
	<span>测试</span>
	<a href="javascript:history.back(-1);" class="lf marginleft10"><img src="/wap/images/icon/back.png" alt="" style="position: relative; top: 18px;" height="16"></a>
	<br class="clear" />
</div>
<div style="height: 50px;"></div>

<div class="divs" style="margin-bottom: 10px;">
    
	<div><img src="/wap/1467603508.jpg" alt="" width="100%"></div>

	<div class="bg01 paddingbuding01">
	
		<div>内容提要:<span class="color_silver">体压迫</span></div>
		<div class="paddingbuding02">活动说明: <span class="color_pink">特价</span></div>

	</div>

	<div id="special_list">
		<input type="hidden" value="<!--{$nextlm}-->" id="nextlm"/>
		<input type="hidden" value="unlock" id="islock"/>
		<div class="home_box01 bdbottom01">
			<div class="home_title01" style="text-align:center;"><span class="font_size02 color_pink">特价</span></div>
		</div>
		<ul class="home_ul02 align_center" id="tag<!--{$lm[0].id}-->">
			
			<li class="lf">
				<div style="border:1px #f5f5f5 solid;border-right-color: #fff;border-top-color: #fff;">
					<div class="div_buding"><a href="/detail/1" style="height:100%;display:block;">
						<img src="/wap/20170926101954.jpg" alt="" width="100%"></a></div>
					<div class="font_size01 div02">蛋糕1</div>
					<div class="div01">
						<span class="font_size01 color_pink">￥95</span>&nbsp;
						<del class="font_size00 color_silver">￥120</del>
						<a href="javascript:void(0);" onclick="addcart();"><img src="/wap/images/mdimages/icon/shop.png" height="16" class="fr"></a>
 
					</div>
                   
				</div>
			</li>

			<div class="align_center">
	            <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 50px 0 10px 0;">
	            <div class="color_gray font_size02">暂无数据</div>
	        </div>

			<br class="clear">
		</ul>
	</div>
</div>

@stop