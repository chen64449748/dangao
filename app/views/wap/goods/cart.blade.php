@extends('wap.header')

@section('content')
<div class="top">
	<span>购物车</span>
		<!-- <a href="javascript:void(0);" class="anniu03 marginright10 rt margintop05 disabled" id="del">删除</a> -->
		<br class="clear" />
</div>
<div style="height: 44px;"></div>

@if (isset($carts[0]))

<div class="content">
	<div class="gwc" style="margin: auto;overflow: hidden;">

	    <table cellpadding="0" cellspacing="0" class="gwc_tb2 paddingbuding01" id="count" width="100%">
	    	@foreach ($carts as $cart_item) 
			<tr class="cart_tr">
				<td class="tb2_td1" width="30" align="center" style="position: relative;">
					@if ($cart_item->goods->is_onsale) 
					<div class="md-md_arrow-con">
						<input type="checkbox" value="{{$cart_item->id}}"  name="newslist" id="newslist" class="md-md_arrow checkbox-blue check"/>
					</div>
					@endif

				</td>
				<td class="tb2_td2" align="center" width="100">
					<div class="div_buding"><a href="/detail/{{$cart_item->goods_id}}" style="height: 100%;display: block;"> <img src="{{$cart_item->goods->goods_img}}"alt="" width="100%"></a></div>
					<div class="font_size01 color_red align_center"></div>
				</td>
				<td>
					<table class="a_cart" cellspacing="0" cellpadding="0" width="100%">
						<tr>
							<td>
								<a href="/detail/{{$cart_item->goods_id}}">{{$cart_item->goods->goods_title}}</a>
								<div class="font_size01 color_silver margintop05" style="word-break: break-all;">
									@foreach ($cart_item->price->skuPrices as $sku_price)
										{{$sku_price->skuValue->value}}&emsp;
									@endforeach
								</div>
								<div><span class="color_pink font_size02 t_price">￥{{number_format($cart_item->price->getRealPrice() * $cart_item->count, 2)}}</span>&emsp;<!-- <del class="font_size01 color_gray">￥109</del>&emsp; --><!-- <span class="color_silver font_size02">x<span id="">{{$cart_item->count}}</span></span> --></div>

								@if (!$cart_item->goods->is_onsale) 
								<div class="font_size01 color_pink">已下架</div>
								@endif
							</td>
						</tr>
						<tr>
							<td class="count" style="border:none;">
								<div style="margin-top: 10px;">
									<div class="count lf">
										<a href="javascript:void(0);" id="" @if ($cart_item->count == 1) style="color: rgb(221, 221, 221);" @endif class="sub lf shoppingcart_min" >-</a>
		                                <input type="text" value="{{$cart_item->count}}" price="{{number_format($cart_item->price->getRealPrice(), 2)}}" cart_id="{{$cart_item->id}}" class="text lf number_box">
										<a href="javascript:void(0);" id="" class="add rt shoppingcart_add" >+</a>
										<br class="clear" />
									</div>
									<a href="javascript:void(0);" class="rt marginright10"><img src="/wap/images/icon/delete.png" onclick="deleteShopCart(this,{{$cart_item->id}})" height="16"></a>
									<br class="clear">
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>
			@endforeach
		</table>





	</div>


</div>

@else
<div class="align_center">
    <img src="/wap/images/icon/dingdan3.png" alt="" height="48" style="margin: 50px 0 10px 0;">
    <div class="color_gray font_size02">您的购物车为空</div>
    <a href="/goods" class="anniu03 margintop10 marginbottom10 jz" style="background-color: #e7526f;">去逛逛</a>
</div>
@endif




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
							<input type="checkbox" value="" class="md-md_arrow checkbox-green c-all" name="newslist2"  id="newslist-<!--{$key}-->"/>
						</div>
					</td>


					<td class="font_size02">
                        <div class="lf" style="margin-left: 4px;">应付总额：</div>
						<span class="lf color_pink"><span class="total_price">￥0.00</span><label id="zong1"></label></span>
						<br class="clear">
					</td>
					<td class="tb3_td4">
						<div class="rt">
							<a href="javascript:void(0);" class="anniu03 disabled submit-btn marginright10" id="jz2">结算</a>
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
numberBox(updateCartCount);
shoppingcart_add(updateCartCount);
shoppingcart_min(updateCartCount);

function updateCartCount(number_box, num, cart_id, now) {
	$.post('/cart/cartCount', {cart_id: cart_id, count: num}, function (data) {
		if (data.status == 0) {
			alert(data.message);
			number_box.val(now);
			if (now == 0) {
				window.location.reload();
			}
		} else if (data.status == 1) {
			var price = number_box.attr('price');
			price = Number(price);
			var t_price = price * num;
			number_box.parents('.a_cart').find('.t_price').text('￥' + t_price.toFixed(2));

		}
	});
}

function deleteShopCart(obj, cart_id)
{
	var delete_i = $(obj);
	confirm('是否要删除?', function (res) {
		if (!res) { return }

		$.post('/cart/cartDelete', {cart_id: cart_id}, function (data) {

			if (data.status == 1) {
				delete_i.parents('.cart_tr').remove();

				if ($('.cart_tr').size() == 0) {
					window.location.reload();
				}

			} else {
				alert(data.message);	
			}
		});

	});
	
}

$('.check').click(function () {

	selectChackAll();
	priceChecked();
});

$('.c-all').click(function () {
	var flag = $(this).prop('checked');

	$('.check').each(function () {
		$(this).prop('checked', flag);
	});
	selectChackAll();
	priceChecked();
});

function selectChackAll()
{
	var all_size = $('.check').size();
	var checked_size = $('.check:checked').size();

	if (all_size == checked_size) {
		$('.c-all').prop('checked', true);	
	} else {
		$('.c-all').prop('checked', false);
	}

	if (checked_size > 0) {
		$('.submit-btn').removeClass('disabled');
	} else {
		$('.submit-btn').addClass('disabled');
	}
}


$('.submit-btn').click(function () {
	if ($('.check:checked').size() == 0) {
		return alert('请勾选要结算的商品');
	}
	var cart_ids = [];

	$('.check:checked').each(function() {
		cart_ids.push($(this).val());
	});

	$.post('/cart/cartBuy', {cart_id: cart_ids}, function (data) {
		alert(data.message);
		if (data.status == 1) {
			window.location.href = '/buy/'+ data.order_id;
		}
	});

});

</script>
@stop