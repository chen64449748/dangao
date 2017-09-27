@extends('wap.header')

@section('content')
<style type="text/css">
		a{color: #757575;}
	</style>
 

	<div class="top2" style="z-index: 106;">
		
		<a href="javascript:history.back(-1);" class="marginleft10 lf"><img src="/wap/images/icon/back.png" style="position:relative; top: 6px;" alt="" height="16"></a>

		<div class="searches2 lf" style="margin-left: 70px; "><img src="/wap/images/icon/search.png" onclick="alert(1)" alt="" height="12">
            <input type="text"/>
        </div>

		<a href="/" class="margintop05 rt"><img src="/wap/images/icon/home.png" style="position:relative; right: 8px;" alt="" height="16"></a>
		<br class="clear" />
	</div>

	<div style="height: 40px;"></div>
	<table cellpadding="0" cellspacing="0" width="100%" class="table03 imgbuding search_menu bdbottom01" style="padding-top:10px;">
		<tr>
			<td class="zonghe">
				<a href=""  class="color_silver">默认</a>
				<span class="rt">|</span>
				<br class="clear" />
			</td>
			<td>
				<a href="" class="xiaoliang color_silver">销量<img src="/wap/images/icon/px1.png" alt="" height="12" class="marginleft08"></a>
				<span class="rt">|</span>
				<br class="clear" />
			</td>
			<td>
				<a href="" class="xiaoliang color_pink">价格<img src="/wap/images/icon/paixu.png" alt="" height="12" class="marginleft08"></a>
				<span class="rt">|</span>
				<br class="clear" />
			</td>
			<td>
				<a href="javascript:viod(0);" class="fenlei">分类</a>
				<div class="fenlei_div">
					<a href="" class="lf marginright10 bg02">蛋糕<span>(100)</span></a>
					<br class="clear">
				</div>
			</td>
			
		</tr>
	</table>

	<ul class="home_ul01 align_center" style="margin-top: 104px;">
       
        <li class="lf">
        	<div style="border:1px #f5f5f5 solid;border-right-color: #fff;border-top-color: #fff;position: relative;">
	            <div class="div_buding"><a href="" style="height: 100%;display: block;"><img src="/wap/20170926101954.jpg" alt="蛋糕1" width="100%"></a></div>
	            <div class="font_size01 div02">蛋糕1</div>
	            <div class="div01">

	            	<span  style="background-color: #fc5e1f;color: #fff;font-size: 8px;border-radius: 10px;padding:0 5px;">包邮</span>
	            	<span class="color_pink font_size00">￥29.9</span>
	            	<del class=" color_silver" style="font-size: 9px;">￥109</del>
                    <span style="background-color: #d50000;padding:2px 6px;color: #fff;font-size: 12px;position: absolute;left: 0;top: 0;max-width: 24px;text-align: left;line-height: 14px;">热销</span>
	            </div>
            </div>
        </li>
    </ul>
	
	<!-- <div class="align_center">
        <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 100px 0 10px 0;">
        <div class="color_gray font_size02">对不起，没有找到您要的商品</div>
    </div> -->

	<div class="layer"></div>
	<a href="javascript:scroll(0,0);" class="totop"><img src="/wap/images/icon/totop.png" alt="" height="35"></a>
    
    <!-- infinite scroll 无限加载 -->
    <script src="/wap/js/loading/infinitescroll.min.js"></script>
    <script>

        $(function(){
			$('.fenlei_div a').hover(function(){
				$(this).toggleClass('bg02');
			})
			$('.share').click(function(){
				$('.layer').css('z-index','106');
				$('.search_menu').css('z-index','105');
			})
        	$('.table03 a').click(function(){
        		$('.table03 a').removeClass('color_pink');
        		$(this).addClass('color_pink');
        		$('.shares').hide();
		        $('.xiaoliang').find('img').attr('src', stylehost + '/wap/images/icon/paixu.png');
		        $('.table03 a').siblings('div').slideUp(0);
		        $(this).siblings('div').slideDown(0);
		        $('.layer').hide(0);
				$('.layer').css('z-index','105');
				$('.search_menu').css('z-index','106');
        	})
		    $('.fenlei').click(function () {
		        $('.layer').show(0);
		    })
		    $('.shaixuan').click(function () {
		        $('.layer').show(0);
		    })


    		$('.moren').click(function(){
				if($(this).find('img').attr('src')=='/wap/images/icon/ok2.png'){
					$(this).find('img').attr('src','/wap/images/icon/ok3.png');
					$(this).addClass('color_gray');
				}else{
					$(this).find('img').attr('src','/wap/images/icon/ok2.png');
					$(this).removeClass('color_gray');
				}
				$(this).parent().siblings().find('.moren').addClass('color_gray');
				$(this).parent().siblings().find('.moren').children('img').attr('src','/wap/images/icon/ok3.png');
			})


            // infinite scroll 无限加载
            $('.align_center').infinitescroll({
                navSelector: '.qd-page',
                nextSelector: '.qd-page .next',
                itemSelector: '.align_center li',
                loading: {
                    msgText: '　正在加载...',
                    img: '/wap/images/loading.gif',
            finishedMsg: '没有更多了'}
        	});
        });
    </script>

@stop