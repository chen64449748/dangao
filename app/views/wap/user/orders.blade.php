@extends('wap.header')

@section('content')
<div class="top" style="z-index: 108;">
    <span>我的订单</span>
    <a href="/user" class="lf marginleft10"><img style="position:relative; top: 18px;" src="/wap/images/icon/back.png" alt="" height="16"></a>
    <br class="clear"/>
</div>
<div style="height: 50px;"></div>
<table cellpadding="0" cellspacing="0" id="header-nav" class="bg01 tb search_menu" width="100%" style="padding:10px 0;border-bottom: 1px #f3f3f3 solid;">
    <tr>
        <td align="center">
            <a href="/user/orders" data-case="0" @if ($status === '') class="color_pink" @endif>全部</a>
        </td>
        <td align="center">
            <a href="/user/orders?status=waiting" data-case="wait_pay" @if ($status == 'waiting') class="color_pink" @endif>待付款</a>
        </td>
        <td align="center">
            <a href="/user/orders?status=payed" data-case="been_send" @if ($status == 'payed') class="color_pink" @endif>已付款</a>
        </td>
        <td align="center">
            <a href="/user/orders?status=close" data-case="close" @if ($status == 'close') class="color_pink" @endif>已关闭</a>
        </td>
        <td align="center">
            <a href="/user/orders?status=ok" data-case="close" @if ($status == 'ok') class="color_pink" @endif>已完成</a>
        </td>
    </tr>
</table>
<div style="height: 35px;"></div>
<style>
    .pay_alert {
        width: 100%;
        height: 100%;
        max-width: 640px;
        background-color: #000;
        opacity: 0.75;
        position: fixed;
        top: 0;
        z-index: 105;
    }
</style>
<div class="pay_alert" style="display: none"></div>
<div id="user_order" @if ($orders)  style="background: #e8e8e8;" @endif>
	@if ($orders) 
	@foreach ($orders as $order)
    <div class="bg01 user_order_div">
        <div class="tiyan bdbottom01">
            <div class="font_size03 lf">
                <div class="font_size03 color_silver lf" style="margin-left: 5px;">下单时间：{{$order->created_at}}</div>
                <br class="clear"/>
            </div>
            @if ($order->status == 1 || $order->status == 0)
            <div class="font_size01 rt color_pink">待付款</div>
            @elseif ($order->status == 2)
            <div class="font_size01 rt color_pink">已付款</div>
            @elseif ($order->status == 3)
            <div class="font_size01 rt color_pink">已关闭</div>
            @endif

            <br class="clear"/>
        </div>
        @foreach ($order->detail as $detail) 
        <a href="/user/order/detail/{{$order->id}}" style="display: block;">
            
            <div class="position_relative paddingbuding02 bdbottom01">
                    <div class="div_img2 lf"><div class="div_buding"><span><img src="{{$detail->goods_img}}" alt="" width="100%"></span></div></div>
                    <div class="div_block2 lf">
                        <div class="gouwu_title" style="margin-top: 10px;">{{$detail->goods_title}}</div>
                        <div class="color_silver">{{$detail->sku_text}}</div>
                        <div class="jiage"><label class="color_pink">￥{{$detail->price}}</label><span>×{{$detail->buy_count}}</span></div>
                    </div>
                    <div class="clear"></div>

            </div>

        </a>
        @endforeach
        <div class="paddingbuding01">
            <div class="align_right font_size02 line_height20">共<span class="color_red">{{$order->goods_count}}</span>件,总金额:<span class="color_pink">￥{{$order->price}}</span><!-- <span class="color_silver font_size00">(含运费:￥)</span> --></div>
            <div class="paddingbuding02">
                @if ($order->status == 1 || $order->status == 0)
                <a href="/buy/{{$order->id}}" class="anniu11 marginleft10 rt" style="background-color: #08a259;color: #fff;">立即付款</a>
                <a href="javascript:void(0);" onclick="orderCancel({{$order->id}})" class="anniu11 marginleft10 rt">取消订单</a>
                @elseif ($order->status == 2 || $order->status == 4)
                <a href="javascript:void(0);" onclick="" class="anniu11 marginleft10 rt">再次购买</a>
                @endif
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

   
    
</div>
<input type="hidden" id="page_hide" value="2">
<div class="foot_loding">
    
</div>

<script>
loading('.foot_loding', '/user/order/loading?{{$query}}', {}, function (data) {
    $('#page_hide').val(Number($('#page_hide').val()) + 1);
    var orders = data.data;
    if (orders.length == 0) {
        return;
    }
    for (var i in orders) {
        var order = orders[i];
        var order_html_head = '<div class="bg01 user_order_div">\
                                    <div class="tiyan bdbottom01">\
                                        <div class="font_size03 lf">\
                                            <div class="font_size03 color_silver lf" style="margin-left: 5px;">下单时间：'+ order.created_at +'</div>\
                                            <br class="clear"/>\
                                        </div>';

        var order_html_status = '';
        if (order.status == 1 || orders.status == 0) {
            order_html_status = '<div class="font_size01 rt color_pink">待付款</div>';
        } else if (order.status == 2) {
            order_html_status = '<div class="font_size01 rt color_pink">已付款</div>';
        } else if (order.status == 3) {
            order_html_status = '<div class="font_size01 rt color_pink">已关闭</div>';
        } else if (order.status == 4) {
            order_html_status = '<div class="font_size01 rt color_pink">已完成</div>';
        }
        order_html_status += '<br class="clear"/></div>';

        // 订单详情
        var order_html_detail = '';
        
        for (var j in order.detail) {
            var detail = order.detail[j];
            order_html_detail += '<a href="/user/order/detail/'+ order.id +'" style="display: block;">\
                                        <div class="position_relative paddingbuding02 bdbottom01">\
                                                <div class="div_img2 lf"><div class="div_buding"><span><img src="'+ detail.goods_img +'" alt="" width="100%"></span></div></div>\
                                                <div class="div_block2 lf">\
                                                    <div class="gouwu_title" style="margin-top: 10px;">'+ detail.goods_title +'</div>\
                                                    <div class="color_silver">'+ detail.sku_text +'</div>\
                                                    <div class="jiage"><label class="color_pink">￥'+ detail.price +'</label><span>×'+ detail.buy_count +'</span></div>\
                                                </div>\
                                                <div class="clear"></div>\
                                        </div>\
                                    </a>';   

        }   

        var order_html_btn = '';

        if (order.status == 1 || order.status == 0) {
            order_html_btn = '<a href="/buy/'+ order.id +'" class="anniu11 marginleft10 rt" style="background-color: #08a259;color: #fff;">立即付款</a>\
                              <a href="javascript:void(0);" onclick="orderCancel('+ order.id +')" class="anniu11 marginleft10 rt">取消订单</a>';
        } else if (order.status == 2 || order.status == 4) {
            order_html_btn = '<a href="javascript:void(0);" onclick="" class="anniu11 marginleft10 rt">再次购买</a>';
        }

        var order_html_foot = '<div class="paddingbuding01">\
                                    <div class="align_right font_size02 line_height20">共<span class="color_red">'+ order.goods_count +'</span>件,总金额:<span class="color_pink">￥'+ order.price +'</span></div>\
                                    <div class="paddingbuding02">'+ order_html_btn +'<br class="clear"/>\
                                    </div>\
                                </div>\
                            </div>';
        
        
        $('#user_order').append(order_html_head + order_html_status + order_html_detail + order_html_foot);

    }


});


function orderCancel(order_id)
{
    confirm('确定取消？', function (res) {
        if (!res) {return;}
        $('.pay_alert').show();
        $.post('/user/order/status/update', {status: 'cancel', order_id: order_id}, function (data) {
            $('.pay_alert').hide();
        
            alert(data.message, function () {

                if (data.status == 1) {
                    window.location.reload();
                }

            });
        })
    });
}
</script>
@stop