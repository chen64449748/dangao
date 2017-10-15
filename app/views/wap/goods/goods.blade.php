@extends('wap.header')

@section('content')
<style type="text/css">
		a{color: #757575;}
	</style>
 
	<input type="hidden" id="page_hide" value="2">
	<div class="top2" style="z-index: 106;">
		
		<a href="javascript:history.back(-1);" class="marginleft10 lf"><img src="/wap/images/icon/back.png" style="position:relative; top: 6px;" alt="" height="16"></a>

		<form method="get" id="search_form" action="/goods?{{$query}}" class="searches2 lf" style="margin-left: 10px; "><img id="search" src="/wap/images/icon/search.png"  alt="" height="12">
            <input name="k" type="text" value="{{$k}}"/>
        </form>

		<a href="/" class="margintop05 rt"><img src="/wap/images/icon/home.png" style="position:relative; right: 8px;" alt="" height="16"></a>
		<br class="clear" />
	</div>

	<div style="height: 40px;"></div>
	<table cellpadding="0" cellspacing="0" width="100%" class="table03 imgbuding search_menu bdbottom01" style="padding-top:10px;">
		<tr>
			<td class="zonghe">
				<a href="/goods"  class="color_silver @if ($is_default) color_pink @endif">默认</a>
				<span class="rt">|</span>
				<br class="clear" />
			</td>
			<td>
				<a href="@if ($sale_num_order_t == '') /goods?sale_num_order=desc&category_id={{$category_id}} @else /goods?sale_num_order={{$sale_num_order_t}}&category_id={{$category_id}} @endif" class="xiaoliang color_silver @if ($sale_num_order) color_pink @endif">销量<img src="@if ($sale_num_order == 'desc') /wap/images/icon/px2.png @elseif ($sale_num_order =='asc') /wap/images/icon/px1.png @endif" alt="" height="12" class="marginleft08"></a>
				<span class="rt">|</span>
				<br class="clear" />
			</td>
			<td>
				<a href="@if ($show_price_order_t == '') /goods?show_price_order=desc&category_id={{$category_id}} @else /goods?show_price_order={{$show_price_order_t}}&category_id={{$category_id}} @endif" class="xiaoliang @if ($show_price_order) color_pink @endif">价格<img src="@if ($show_price_order == 'desc') /wap/images/icon/px2.png @elseif ($show_price_order =='asc') /wap/images/icon/px1.png @endif" alt="" height="12" class="marginleft08"></a>
				<span class="rt">|</span>
				<br class="clear" />
			</td>
			<td>
				<a href="javascript:viod(0);" class="fenlei">分类</a>
				<div class="fenlei_div">
					<a href="/goods" class="lf marginright10 bg02">全部<span></span></a>
					@foreach($categorys as $category)
					<a href="/goods?category_id={{$category->id}}" @if ($category_id == $category->id) style="background: red; color: white;" @endif class="lf marginright10 bg02">{{$category->category}}<span></span></a>
					@endforeach
					<br class="clear">
				</div>
			</td>
			
		</tr>
	</table>

	<ul class="home_ul01 align_center" style="margin-top: 104px;">
	
		@if (isset($goods[0]))
	    	@foreach ($goods as $item)
	        <li class="lf">

	        	<div style="border:1px #f5f5f5 solid;border-right-color: #fff;border-top-color: #fff;position: relative;">
		            <div class="div_buding"><a href="/detail/{{$item->id}}" style="height: 100%;display: block;"><img src="{{$item->goods_img}}" alt="{{$item->goods_title}}" width="100%"></a></div>
		            <div class="font_size01 div02">{{$item->goods_title}}</div>
		            <div class="div01">
						@if (!$item->is_active)
		            	<span  style="background-color: #fc5e1f;color: #fff;font-size: 8px;border-radius: 10px;padding:0 5px;">不参与活动</span>
		            	@endif
		            	<span class="color_pink font_size00">￥{{$item->show_price}}</span>
		            	<span class=" color_silver" style="font-size: 9px;">销量{{$item->sale_num}}</span>
		            	@if ($item->is_hot)
	                    <span style="background-color: #d50000;padding:2px 6px;color: #fff;font-size: 12px;position: absolute;left: 0;top: 0;max-width: 56px;text-align: left;line-height: 14px;">热门推荐</span>
	                    @endif
		            </div>
	            </div>
	        </li>
	        @endforeach
	    @else    
	        <div class="align_center">
		        <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 100px 0 10px 0;">
		        <div class="color_gray font_size02">对不起，没有找到您要的商品</div>
		    </div>
        @endif
    </ul>
	
	<div style="clear: both;"></div>

	<div class="foot_loding">
		
	</div>

		

	<div class="layer"></div>
	<a href="javascript:scroll(0,0);" class="totop"><img src="/wap/images/icon/totop.png" alt="" height="35"></a>
    @include('wap.menu')

    <script src="/wap/js/loading.js"></script>		
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

    		$('#search').click(function () {
    			$('#search_form').submit();
    		});

            loading('.foot_loding', '/goods/loading?{{$query}}', {}, function (goods) {
            	// home_ul01
            	if (goods.status != 1) {
            		return;
            	}

            	$('#page_hide').val(Number($('#page_hide').val()) + 1);

    			var data = goods.data;
    			console.log(data);
            	for (var i in data) {
            		var goods_html = '<li class="lf">\
			        	<div style="border:1px #f5f5f5 solid;border-right-color: #fff;border-top-color: #fff;position: relative;">\
				            <div class="div_buding"><a href="/detail/'+ data[i].id +'" style="height: 100%;display: block;"><img src="'+ data[i].goods_img +'" alt="' +data[i].goods_title + '" width="100%"></a></div>\
				            <div class="font_size01 div02">' + data[i].goods_title +'</div>\
				            <div class="div01">\
				            	<span  style="background-color: #fc5e1f;color: #fff;font-size: 8px;border-radius: 10px;padding:0 5px;">配送</span>\
				            	<span class="color_pink font_size00">￥'+ data[i].show_price +'</span>';

				    if (data[i].is_hot) {
				    	goods_html += '<span style="background-color: #d50000;padding:2px 6px;color: #fff;font-size: 12px;position: absolute;left: 0;top: 0;max-width:56px;text-align: left;line-height: 14px;">推荐</span>';
				    }

					goods_html += '</div>\
							            </div>\
							        </li>';          

            		$('.home_ul01').append(goods_html);
            	}
            });

        });
    </script>

@stop