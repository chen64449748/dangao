@extends('wap.header')

@section('content')
	<div class="top">
		<span>订单确认</span>
		<a href="javascript:history.go(-1)" class="lf marginleft10"><img src="/wap/images/icon/back.png" style="position: relative; top: 18px;" alt="" height="16"></a>
		<a href="/" class="rt marginright10"><img style="position: relative; top: 16px;" src="/wap/images/icon/home.png" alt="" height="16"></a>
		<br class="clear" />
	</div>
	<div style="height: 50px;"></div>
    <form method="post" action="/shopping/order.php">

	<a href="/order/addressSelect/{{$order->id}}">
		<div class="address">
			<div class="font_size03">
				<span class="line_height50 lf show_name_phone">{{$order->name}} {{$order->mobile}}</span>
				<span class="rt"><img src="/wap/images/icon/arrow02.png" alt="" height="16"></span>
				<br class="clear" />
			</div>
			<div class="show_address color_silver">{{$order->address}}</div>
		</div>
	</a>

    <div class="add_address" style="height: 70px;">
        <table cellspacing="0" cellpadding="0" width="100%" class="add_tb bg01 bdbottom01 paddingbuding01 dn">
            <tr>
                <td width="20%" class="color_silver">收货人</td>
                <td width="45%"><div contenteditable="true" class="user_address_name" style="min-height: 16px;padding:8px;" onfocus="true"></div></td>
                <td width="35%"></td>
            </tr>
            <tr>
                <td width="20%" class="color_silver">手机号</td>
                <td width="45%"><div contenteditable="true" class="user_address_phone" style="min-height: 16px;padding:8px;" onfocus="true"></div></td>
                <td width="35%"></td>
            </tr>
            <tr>
                <td width="20%" class="color_silver">添加地址</td>
                <td width="45%"><div contenteditable="true" placeholder="只限江苏省 南通市" class="user_address" style="min-height: 16px;padding:8px;" onfocus="true"></div></td>
                <td width="35%"><span style="font-size: 5px;">江苏 南通</span></td>
            </tr>
            <tr>
                <td width="20%" class="color_silver"></td>
                <td width="60%">
                    <a href="javascript:void(0)" style="color:white;" order_id="{{$order->id}}" class="anniu03 lf addr_add marginright10">添加</a>
                    <a href="javascript:void(0)" style="color:white; background: #c9c9c9" class="anniu03 lf cancel marginright10">取消</a>
                </td>
                <td width="20%"></td>
            </tr>
        </table>
        <a href="javascript:void(0)" class="add_address_new"><img src="/wap/images/icon/add.png" alt="" height="15">添加收货地址</a>
    </div>



	<div class="bdbottom01 bg01" style="padding:10px 0;">
		<div class="position_relative">
            @foreach ($order_detail as $item)
			<div  class="lf div_img2"><div class="div_buding"><span><img src="{{$item->goods->goods_img}}" alt="" width="100%"></span></div></div>
			<div class="lf div_block2">
				<div class="gouwu_title" style="margin-top: 10px;">{{$item->goods->goods_title}}</div>
				<div>
					<div class="font_size01 color_silver">
                        @foreach ($item->p->skuPrices as $sku_price)
                            {{$sku_price->skuValue->value}}&nbsp;
                        @endforeach
                    </div>
					<div>
                        @if ($item->old_price != $item->price)
                        <del class="color_silver">￥{{$item->old_price}}</del>
                        @endif
                        <a class="color_pink">￥{{$item->price}}</a><span>×{{$item->buy_count}}</span>
                    </div>
                    @if (!$item->goods->is_active)
					<div class="color_red font_size01"><span class="color_pink marginright10">不参与活动</span></div>
					@endif
                    <br class="clear">
				</div>
			</div>
            <div class="clear"></div>
            @endforeach
		</div>
	</div>

	<div class="font_size02 align_right bg01 paddingbuding01">商品总额:￥{{number_format($total_price, 2)}}</div>
	
 <!--{if $activity_arr}-->
    <div class="paddingbuding03 bg01 bdbottom01 margintop10">
        @if ($old_total_price - $total_price)
        <table cellspacing="0" cellpadding="0" width="100%" class="bg01 paddingbuding02 ">
            <tr>
                <td width="20%" class="font_size03">促销优惠</td>
            </tr>
        </table>
        <div class="font_size02" id="txt">
            <table cellspacing="0" cellpadding="0" width="100%" class="bg01 bdbottom01">
                <tr>
                    <td><div class="color_blue font_size01 paddingbuding02">活动商品，已优惠{{$old_total_price - $total_price}}元</div></td>
                </tr>
            </table>
        </div>
        @endif
    </div>
    <!--{/if}-->

	

    <style>
        .coupon-check input[type=checkbox] {margin-top: 10px;}
            .check {display: none;}
    </style>

    <div class="layer pay_alert" onclick="" style=""></div>
    <div class="shares pay_alert" style="margin-top: 150px;">
        <img src="/wap/images/pays.png" alt="" width="30%">
        <div style="color: white; font-size: 24px; margin-top: 16px;">支付完成</div>
        <div style="margin:5%;"><a href="javascript:void(0);" onclick=""
                                   class="anniu01" style="background-color: #595959;width:48%;float:left;">查看订单</a></div>
        <div style="margin:5%;"><a href="javascript:void(0);" onclick="hidelayer();"
                                   class="anniu01" style="background-color: #595959;width:48%;float:right;">返回</a></div>
        <br class="clear"/>
    </div>


	<div class="paddingbuding01 bg01" style="display: none;">
		<div class="paddingbuding02 zk_yc font_size03" >店铺活动<img src="/wap/images/icon/arrow03.png" alt="" width="14" class="rt" style="margin-top: 4px;"><span class="rt marginright10 activity_name"><!--{$activity_default.activity_name}--></span><br class="clear" /></div>
		<ul class="youhuiquan2 txt" style="display: none;">
            <!--{foreach from=$activity_arr item=v key=k}-->
			<li class="<!--{if $v.activity_id == $activity_default.activity_id}-->choose2<!--{/if}--> activity_select" data-id="<!--{$v.activity_id}-->" data-name="<!--{$v.activity_name}-->" data-money="<!--{if $v.base_id == 5 || $v.base_id == 8}--><!--{$v.detail.detail.money}--><!--{else}-->0<!--{/if}-->" data-shipfee="<!--{$v.is_free_shipfee}-->" data-bid="<!--{$v.base_id}-->"><span class="font_size03 color_pink "><!--{$v.activity_name}--></span></li>
            <!--{/foreach}-->
		</ul>
	</div>
	<div class="paddingbuding01 bg01 font_size03 bdbottom01" >邮费 <span class="color_pink rt postage" >店铺包邮</span><br class="clear" /></div>
	<!-- <div class="paddingbuding01 margintop10 bg01">
		<div class="paddingbuding02 zk_yc font_size03">开具发票<img src="/wap/images/icon/arrow03.png" alt="" width="14" class="rt"><br class="clear" /></div>
		<div class="font_size02 color_silver txt" style="display: none;">
			<table cellspacing="0" cellpadding="0" width="100%" class="bg01 bdbottom01" style="display: none;">
				<tr>
					<td width="25%" class="font_size03">发票类型</td>
					<td width="25%"><a href="javascript:;" class="imgbuding margintop05 moren" ><img src="/wap/images/icon/ok2.png" alt="" height="16">&nbsp;电子发票</a></td>
					<td width="25%"><a href="javascript:;" class="imgbuding margintop05 moren color_gray" ><img src="/wap/images/icon/ok3.png" alt="" height="16">&nbsp;纸质发票</a></td>
					<td align="right"><a href="javascript:void(0)"><img src="/wap/images/icon/help.png" alt="" width="16"></a></td>
				</tr>
			</table>
			<table cellspacing="0" cellpadding="0" width="100%" class="bg01 bdbottom01 paddingbuding02"  id="invoice_anchor">
				<tr>
					<td width="25%" class="font_size03">发票抬头</td>
					<td width="25%"><a href="javascript:;" class="imgbuding margintop05 moren color_gray invoice_title" data-type="personage" ><img src="/wap/images/icon/ok3.png" alt="" height="16">&nbsp;个人</a></td>
					<td width="25%"><a href="javascript:;" class="imgbuding margintop05 moren color_gray invoice_title" data-type="company" ><img src="/wap/images/icon/ok3.png" alt="" height="16">&nbsp;单位</a></td>
					<td align="right"><a href="javascript:void(0)"><img src="/wap/images/icon/help.png" alt="" width="16"></a></td>
				</tr>
			</table>
			<div class="bg01 paddingbuding02">
                <input type="text" id="invoice_content" class="receipt_title" placeholder="请填写发票抬头" style="line-height: 35px;width: 100%;border:none;background: none;display: none;font-size: 14px;">
                <input type="text" class="duty_paragraph" placeholder="请填写税号" style="line-height: 35px;width: 100%;border:none;background: none;display: none;font-size: 14px;">
            </div>
		</div>
    </div> -->
	<table cellspacing="0" cellpadding="0" width="100%" class="bg01 bdbottom01 paddingbuding01">
		<tr>
			<td width="20%" class="color_silver">备注说明</td>
			<td><div contenteditable="true" class="user_remark" style="min-height: 16px;padding:8px;" onfocus="true"></div></td>
		</tr>
	</table>

	<div style="height: 60px;"></div>
	<div class="jiesuan" style="position: fixed;width: 100%;max-width: 640px;bottom: 0px;background-color: #fff;border-top:1px #eee solid;padding: 6px 0;">
		<div class="lf">
			<div class="font_size02 line_height36 marginleft10">应付总额：<span class="color_pink">￥</span><span class="pay_money color_pink">{{number_format($total_price, 2)}}</span></div>
		</div>
		
        @if ($shop->shop_work) 
        <a href="javascript:void(0)" class="anniu03 rt marginright10" id="submit_order">去支付</a>
        @else
        <a href="javascript:void(0)" class="anniu03 rt marginright10">店铺已打烊</a>
        @endif
        <br class="clear" />
	</div>
    </form>
	<script type="text/javascript">

    $('#no_ticket').on('click',function(){
        if($(this).is(':checked')){
            $('.coupon-check').each(function(){
                $(this).find('.tip').hide();
                $(this).find('.is_check').show();
            });
            $('.is_check').prop("checked", 0);
        }
        $('.ticket_name').html('');
        var pay_money = $('#sum').val();
        var is_postage = $('#shipfee').val();
        var postage = $('#postage').val();
         var activity_money = $('#activity_money').val();
        if (!is_postage) {
            pay_money = parseFloat(pay_money) + parseFloat(postage);
        }
        pay_money = pay_money - activity_money;
        $('.pay_money').html(parseFloat(pay_money).toFixed(2));
    });

    $('.is_check').click(function(){
        $('#no_ticket').prop("checked", 0);
        var check_id = {};
        var no_check_id = {};
        var i = 0;
        var ticket_money = 0;
        $('.is_check').each(function(){
            if ($(this).is(':checked')) {
                var id = $(this).data('id');
                check_id[i] = $(this).data('gid');
                ticket_money = parseFloat(ticket_money) + parseFloat($(this).data('money'));
            } else {
                var id = $(this).data('id');
                no_check_id[i] = $(this).data('gid');
            }
            i++;
        });

        var check_arr= new Array();
        var no_check_arr= new Array();

        $.each(check_id, function (n, value) {
            check_arr =  check_arr.concat(String(value).split(","));
        });

        $('.is_check').each(function(){
            if (!$(this).is(':checked')) {
                var chktrue = 0;

                $.each(String($(this).data('gid')).split(","), function (n, value) {
                    if(chktrue==0 && $.inArray(value, check_arr)!=-1){
                        chktrue = 1;
                    }
                });

                if(chktrue==1){
                    var id = $(this).data('id');
                    $('#ticket_'+id).hide();
                    $('#no_use_'+id).show();
                }else{
                    var id = $(this).data('id');
                    $('#ticket_'+id).show();
                    $('#no_use_'+id).hide();
                }

            }
        });
        var pay_money = $('#sum').val();
        var is_postage = $('#shipfee').val();
        var postage = $('#postage').val();
        var activity_money = $('#activity_money').val();
        if (!is_postage) {
            pay_money = parseFloat(pay_money) + parseFloat(postage);
        }
        pay_money = pay_money - ticket_money- activity_money;
        $('.ticket_name').html('-'+ticket_money+'元');
        $('.pay_money').html(parseFloat(pay_money).toFixed(2));

    });


    $("div[contenteditable='true']").focus();
    $("#invoice_content").focus(function(){
        $(this).css('color','#212121');
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
    /* productdetail */
    // $('.zk_yc').click(function(){
    //  if($(this).siblings('.txt').css('display')=='none'){
    //      $(this).find('img').attr('src','<!--{$smarty.const.BNMP_STYLE}-->/wap/images/icon/arrow.png');
    //  }else{
    //      $(this).find('img').attr('src','<!--{$smarty.const.BNMP_STYLE}-->/wap/images/icon/arrow03.png');
    //  }
    //  $(this).siblings('.txt').slideToggle();
    // })
</script>

</body>
</html>
<script type="text/javascript">

    

    $('.need_receipt').click(function(){
        if ($(this).hasClass('choose2')) {
            $('#need_receipt').val(0);
        }else{
            $('#need_receipt').val(1);
        }
    });

    function invoiceTitle (type) {
        if (type == 'personage') {
            if ($(this).hasClass('color_gray')) {
                alert(type);
            }
            $('#receipt_type').val(0);
            $('#invoice_content').hide();
        } else if (type == 'company') {
            $('#receipt_type').val(1);
            $('#invoice_content').show();
        }
    }

    $('.invoice_title').click(function(){
        var type = $(this).data('type');
        if (type == 'personage') {
            if (!$(this).hasClass('color_gray')) {
                $('#receipt_type').val(1);
            } else {
                $('#receipt_type').val(0);
            }
            $('#invoice_content').hide();
            $('.duty_paragraph').hide();

        } else if(type == 'company') {
            if (!$(this).hasClass('color_gray')) {
                $('#receipt_type').val(2);
            } else {
                $('#receipt_type').val(0);
            }
            $('#invoice_content').show();
            $('.duty_paragraph').show();

        }
    });

    

</script>
<!-- 收获地址 -->

<script type="text/javascript">

    $('.add_address_new').click(function () {
        $('.user_address').text('');
        $('.user_address_name').text('');
        $('.user_address_phone').text('');
        $('.add_tb').show();
        $('.add_address').css('height', '240px');
    });

    $('.cancel').click(function () {
        $('.add_address').css('height', '70px');
        $('.add_tb').hide();
    });

    $('.addr_add').click(function () {
        var address = $('.user_address').text();
        var name = $('.user_address_name').text();
        var phone = $('.user_address_phone').text();
        var order_id = $(this).attr('order_id');

        if (!name || !address || !phone) {
            return alert('收获信息必填');
        }

        $.post('/user/addAddress', {address: address, name: name, phone: phone, order_id: order_id}, function (data) {
            alert(data.message);
            if (data.status == 1) {
                $('.add_address').css('height', '70px');
                $('.add_tb').hide();
                $('.show_name_phone').text(name + ' ' + phone);
                $('.show_address').text(address);
                $('#address_id').val(data.address_id);
            }
        });
    });

</script>
<script type="text/javascript">
    var jsApiParameters='';
    var id = $('input[name=order_id]').val();

    $('#submit_order').click(function(){
        $.post('/order/wxpay', {id:id}, function (data) {
            if (data.status) {
                jsApiParameters=v.data;
                wxpay();
            }else{
                alert(data.msg);return;
            }
        },'json');
    });
    function wxpay(){
        if(typeof WeixinJSBridge != "undefined"){
            wxpayConditionComplete();
        }else{
            if( document.addEventListener ){
                document.addEventListener('WeixinJSBridgeReady', wxpayConditionComplete, false);
            }else if (document.attachEvent){
                document.attachEvent('WeixinJSBridgeReady', wxpayConditionComplete);
                document.attachEvent('onWeixinJSBridgeReady', wxpayConditionComplete);
            }
        }
    }   
    //防止页面没有加载完成启动微信支付
    function wxpayConditionComplete(){
        if(typeof window._WXPAY_COUNTER == 'undefined'){
            window._WXPAY_COUNTER = 2;
        }
        window._WXPAY_COUNTER = window._WXPAY_COUNTER - 1;
        if(window._WXPAY_COUNTER <= 0 && jsApiParameters != ''){
            window.setTimeout(jsApiCall,0);
        }
    }
    function jsApiCall()
    {
        var id = $('input[name=order_id]').val();
        $("#submit_order").html("支付中");
        WeixinJSBridge.invoke(
            'getBrandWCPayRequest',
            eval("("+jsApiParameters+")"),
            function(res){
                jsApiParameters="";

                if(res.err_msg == "get_brand_wcpay_request:ok" ) {
                    var whenpayok=function(){
                       $('.shares').show();
                                    // window.location.href="/activity_group/detail?oid="+group_oid;
                    };
                    isruning=true;
                    $("#submit_order").html("确认中").addClass("buttondisabled");
                    $.post('/order/wxpay', {id:id}, function (data) {
                            whenpayok();
                    });

                }else{
                    isruning=false;
                    $("#submit_order").html("支付").removeClass("buttondisabled");
                }
            }
        );
    }
</script>

@stop