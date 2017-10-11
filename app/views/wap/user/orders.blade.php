@extends('wap.header')

@section('content')
<div class="top" style="z-index: 108;">
    <span>我的订单</span>
    <a href="<!--{$smarty.const.WESHOP_WWW}-->/user/index.php" class="lf marginleft10"><img src="/wap/images/icon/back.png" alt="" height="16"></a>
    <br class="clear"/>
</div>
<div style="height: 50px;"></div>
<table cellpadding="0" cellspacing="0" id="header-nav" class="bg01 tb search_menu" width="100%" style="padding:10px 0;border-bottom: 1px #f3f3f3 solid;">
    <tr>
        <td align="center">
            <a data-case="0" class="color_pink">全部</a>
        </td>
        <td align="center">
            <a data-case="wait_pay" class="color_pink">待付款</a>
        </td>
        <td align="center">
            <a data-case="been_send" class="color_pink">待收货</a>
        </td>

        <td align="center">
            <a data-case="close" class="color_pink">已关闭</a>
        </td>
    </tr>
</table>
<div style="height: 35px;"></div>

<div id="user_order">
	@if ($orders) 
	@foreach ($orders as $order)
    <div class="bg01 user_order_div">
        <div class="tiyan bdbottom01">
            <div class="font_size03 lf">
                <div class="font_size03 color_silver lf" style="margin-left: 5px;">下单时间：{{$order->created_at}}</div>
                <br class="clear"/>
            </div>
            <div class="font_size01 rt color_pink">待付款</div>
            <br class="clear"/>
        </div>
        @foreach ($order->detail as $detail) 
        <a href="orderdetail.php?orderid=<!--{$list.order_id}-->" style="display: block;">
            
            <div class="position_relative paddingbuding02 bdbottom01">
                    <div class="div_img2 lf"><div class="div_buding"><span><img src="{{$detail->goods_img}}" alt="" width="100%"></span></div></div>
                    <div class="div_block2 lf">
                        <div class="gouwu_title" style="margin-top: 10px;">蛋糕</div>
                        <div class="jiage"><label class="color_pink">￥108.00</label><span>×2</span></div>
                    </div>
                    <div class="clear"></div>

            </div>

        </a>
        @endforeach
        <div class="paddingbuding01">
            <div class="align_right font_size02 line_height20">共<span class="color_red"><!--{$list.order_goods_count}--></span>件,总金额:<span class="color_pink">￥<!--{if $list.order_total > 0}--><!--{$list.order_total-$list.muti_act_money|number_format:2}--><!--{else}-->0.00<!--{/if}--></span><span class="color_silver font_size00">(含运费:￥<!--{$list.dispatch_price}-->)</span></div>
            <div class="paddingbuding02">

                <a href="/pay/pay.php?orderid=<!--{$list.order_id}-->&flag=1&pageurl=<!--{$pageurl}-->" class="anniu11 marginleft10 rt" style="background-color: #08a259;color: #fff;">立即付款</a>
                <a href="javascript:void(0);" onclick="" class="anniu11 marginleft10 rt">取消订单</a>
                <a href="javascript:void(0);" onclick="" class="anniu11 marginleft10 rt">再次购买</a>
                <a href="javascript:void(0);" onclick="" class="anniu11 marginleft10 rt">确认收货</a>

                <br class="clear"/>
            </div>
        </div>
    </div>
  	@endforeach
  	@else 
    <div class="align_center">
        <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 50px 0 10px 0;">
        <div class="color_gray font_size02">暂时无订单</div>
    </div>
    @endif
    <div id="no-data"><a href="<!--{$smarty.const.WESHOP_WWW}-->/user/orders.php?page=1"></a></div>
</div>

@stop