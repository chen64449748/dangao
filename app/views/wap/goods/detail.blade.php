@extends('wap.header')

@section('content')
<div class="top" style="z-index: 100;">
		<span>商品详情</span>
		<a href="javascript:history.back(-1);" class="lf marginleft10"><img src="/wap/images/icon/back.png" alt="" style="position: relative; top: 18px;" height="16"></a>
		<!-- <a href="javascript:void(0);" class="share marginleft10 marginright10 rt"><img src="/wap/images/icon/share.png" alt="" height="16"></a> -->
		<a href="/index.php" class="rt marginright10"><img src="/wap/images/icon/home.png" alt="" style="position: relative; top: 18px;" height="16"></a>
		<br class="clear" />
	</div>
	<div style="height: 50px;"></div>
	<!-- banner -->
	<div class="flexslider">
		<ul class="slides cp">
			<li><div class="div_buding"><span><img src="{{$goods->goods_img}}" alt="" width="100%"></span></div></li>
		</ul>
        
        <div style="position: absolute;bottom: 0;z-index: 10;width: 100%;height: 35px;background-color: #099;padding:0 2%;overflow: hidden;">
            <div style="line-height: 35px;color: #fff;">
                <!-- <span class="font_size03">￥68.00</span>&nbsp;
                <del class="font_size01 color_gray">￥125.00 </del>&nbsp; -->
                <span class="font_size01">优惠活动中</span>&nbsp;
            </div>
        </div>
        
	</div>
	<div class="bg01 paddingbuding01 bdbottom01">
		<div class="font_size02 sku_name">{{$goods->goods_title}}</div>
		<!-- <div class="font_size01 color_silver">小蛋糕</div> -->
	</div>
	<div class="bg01 paddingbuding01">
		
			<span class="font_size04 color_red lf sku_sale_price">￥{{$goods->show_price}}</span>
			<!-- <del class="font_size01 color_silver marginleft08 lf">市场价:￥299</del> -->
			<span style="font-size: 10px;color: #e71d36;border-radius: 2px;border:1px #e71d36 solid;padding:2px 6px;margin-left: 5px;">运费：60元包邮</span>  </span>
			<span class="marginleft10 font_size01"><span class="color_red">预售</span>现货<span class="color_red">缺货</span></span>
			<br class="clear" />
	</div>
	
	
	
	<table cellpadding="0" cellspacing="5" width="100%" class="bg01 bdbottom01 font_size01 imgbuding" style="border-collapse: separate;padding: 5px 0;">
		<tr>
			<td width="33.3%" align="center"><span style="background-color: #fc5e1f;width: 50px;color: #fff;font-size: 12px;text-align: center;border-radius: 10px;padding:2px 12px;">配送</span><!--{/if}-->   <span class="rt">|</span><br class="clear" /></td>
			<td width="33.3%" align="center">销量:<span class="goods_used">{{$goods->sale_num}}</span>件<span class="rt">|</span><br class="clear" /></td>
			<td align="center">库存:<span class="good_usable">10</span>件 充足</td>
		</tr>
	</table>
<!-- 	<table cellpadding="0" cellspacing="5" width="100%" class="bg01 font_size01 imgbuding" style="border-collapse: separate;">
		<tr>
			<td width="30%" align="center"><img src="/wap/images/icon/zhengpin.png" alt="" height="22">&nbsp;正品保障</td>
			<td width="40%" align="center"><img src="/wap/images/icon/qitian.png" alt="" height="22">&nbsp;7天无理由退款</td>
			<td width="30%" align="center"><img src="/wap/images/icon/jifen.png" alt="" height="22">&nbsp;配送</td>
		</tr>
	</table> -->

	<!-- 优惠 -->
	<!-- <div class="paddingbuding01 margintop10 bg01">
		<div class="paddingbuding02 zk_yc">
			<span class="lf line_height20">优惠活动</span>
			<div class="lf biaoqians">
				<span class="biaoqian" style="display: none;">满送优惠券</span>
				<span class="biaoqian" style="font-size:13px;" style="padding:0;">测试活动</span><br class="clear">
			</div>
			<img src="/wap/images/icon/arrow.png" alt="" width="14" class="rt" style="margin-top: 5px;">
			<br class="clear" />
		</div>

		<div class="font_size02 txt">
			<table cellpadding="0" cellspacing="0" width="100%" class="table02">
                
				<tr>
					<td><span class="biaoqian marginright10">新品热卖</span><span class="color_red font_size01 note"></span></td>
				</tr>

			</table>
		</div>

	</div> -->



	<a href="javascript:void(0)" class="home_title02">
		<div class="lf" style="width: 40px;height: 40px;border-radius:2px;overflow:hidden;margin-right: 4px;"><img src="/wap/images/icon/shu.png" alt="" style="width: 40px;height: 40px;"></div>
		<span class="lf" href="tel:95105940">
			<span class="line_height20">terentia</span><br style="height: 0;">
			<span class="font_size01 color_silver line_height20">客服热线:16464481654</span>
		</span>
		<span class="rt">
			<span><img src="/wap/images/icon/tel.png" alt="" height="12" style="margin-top: 7px;"></span>
		</span>
		<br class="clear" />
	</a>
	
	<!-- <div class="paddingbuding01 margintop10 bg01">
		<div class="paddingbuding02 zk_yc font_size02">商品参数<img src="/wap/images/icon/arrow.png" alt="" width="14" class="rt"><br class="clear" /></div>
		<div class="font_size02 color_silver txt">
			<table cellpadding="0" cellspacing="0" width="100%" class="table02">
					<tr>
						<td width="30%">尺寸</td>
						<td width="70%">14寸</td>
					</tr>

					<tr>
						<td width="30%">口味</td>
						<td width="70%">可乐味</td>
					</tr>
			</table>
		</div>
	</div> -->
	
	<!-- 详情 -->
	<div class="paddingbuding01 margintop10 bg01">
		{{$goods->content}}
	</div>
	

    

<table cellspacing="0" cellpadding="0" width="100%" class="margintop10 bg01 paddingbuding01" style="display: none;">
	<tr>
		<td width="50%" align="center"><img src="/wap/images/book.jpg" alt="" width="80%"></td>
		<td align="center">
			<div><img src="/wap/images/ewm.jpg" alt="" width="40%" class="bd01"></div>
			<div class="font_size00 color_silver">长按二维码，在弹出框中点“识别图中二维码”即可查询详情</div>
		</td>
	</tr>
</table>

    
	<div class="home_box01 margintop10 bdbottom01">
		<div class="home_title01"><span class="font_size02 color_blue">推荐</span></div>
	</div>
	<ul class="home_ul02 align_center" style="padding-bottom: 50px;">
		
		@foreach ($hot as $hot_goods)
        <li class="lf">
        	<div style="border:1px #f5f5f5 solid;border-right-color: #fff;border-top-color: #fff;">
	            <div class="div_buding"><a href="/detail/{{$hot_goods->id}}" style="height: 100%;display: block;"><img src="{{$hot_goods->goods_img}}" alt="{{$hot_goods->goods_title}}" width="100%"></a></div>
	            <div class="font_size01 div02">{{$hot_goods->goods_title}}</div>
	            <div class="div01">
	            	<span class="font_size01 color_pink">￥{{$hot_goods->show_price}}</span>&nbsp;
	            	<!-- <del class="font_size00 color_silver">￥299</del> -->
	            </div>
            </div>
        </li>
        @endforeach
        <br class="clear">
    </ul>
    

	<div class="layer"></div>
	<div class="shares">
		<img src="/wap/images/share.png" alt="" width="90%">
	</div>


	

	<!-- 底部操作 -->
	<table cellspacing="0" cellpadding="0" width="100%" class="menu02">
		<tr>
			<td align="center" width="10%">
				<a href="/cart" class="position_relative"><img src="/wap/images/icon/menu_gouwu.png" alt="" height="24"><span class="gouwuche_count" >1</span></a>

			</td>
			<td align="center" width="70%">
                <a href="javascript:;" class="anniu08 marginright10 rt gm buy"  >立即购买</a>
				<a href="javascript:;" data-id="{{$goods->id}}" class="anniu07 marginright10 addproduct rt cart" >加入购物车</a>
				<br class="clear" />
			</td>
		</tr>
	</table>

	<a href="javascript:scroll(0,0);" class="totop" style="display: inline;"><img src="http://style.v.mfnbook.com/wap/images/icon/totop.png" alt="" height="35"></a>
	
	<script type="text/javascript">

	
		// 倒计时
		function getTime(){

			var start_time = new Date().getTime();

			$('.time').each(function(){

				var end_time = $(this).attr('end-time');

				end_time =  new Date(end_time.replace(/-/g, "/")).getTime();

				if(end_time>0){

					var time_distance = end_time - start_time;
					
					// 时
					var int_hour = Math.floor(time_distance/3600000);
					time_distance -= int_hour * 3600000;
					// 分
					var int_minute = Math.floor(time_distance/60000);
					time_distance -= int_minute * 60000;
					// 秒
					var int_second = Math.floor(time_distance/1000);


					$(this).html(int_hour+'时'+int_minute+'分'+int_second+'秒');
				}

			});

			setTimeout('getTime()',1000);
		}

		getTime();
		

		$('.cart').click(function () {
			var goods_id = $(this).data('id');
			sku_select_show(goods_id, function (sku_value_ids, count) {
				$.post('/cart/add', {goods_id: goods_id, sku_value_ids: sku_value_ids, count: count}, function (data) {
					alert(data.message);
					if (data.status == 1) {
						$('.gouwuche_count').text( Number($('.gouwuche_count').text()) + 1 );
					}
				});

			});
		});

		shoppingcart_add();
		shoppingcart_min();

	</script>

@stop