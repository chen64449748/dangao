@extends('wap.header')

@section('content')
<div class="top" id="top_address">
    <span>地址</span>
    <a href="javascript:history.back(-1);" class="lf marginleft10 back"><img style="position:relative; top: 18px;" src="/wap/images/icon/back.png" alt="" height="16"></a>
    <a href="/" class="rt marginright10"><img style="position:relative; top: 18px;" src="/wap/images/icon/home.png" alt="" height="16"></a>
    <br class="clear" />
</div>
    <div class="buding" style="height: 50px;"></div>

<div>

<!--====================地址修改或者添加=========================-->
<form action="" id="address_form" method="post">
<div class="paddingbuding01" style="background: white;">
    <table cellpadding="0" cellspacing="0" width="100%" class="table04">
        <tr>
            <td align="left" width="25%">收货人姓名</td>
            <td align="left" class="color_silver"><input name="name" type="text" class="input06" placeholder="请填写收货人姓名" value="{{$address->name}}" /></td>
        </tr>
        <tr>
            <td align="left">手机号码</td>
            <td align="left"><input type="text" name="phone" class="input06" placeholder="请输入手机号码" value="{{$address->phone}}"></td>
        </tr>
        <tr>
            <td align="left">说明</td>
            <td align="left">
                <a href="javascript:void(0);" class="color_silver buding" style="height: 100%;display: block;">
                   
                    <span class="lf area_content" style="color: #a9a9a9;">只配江苏省 南京市 启东</span>
                    
                    <!-- <img src="/wap/images/icon/arrow02.png" alt="" height="12" class="margintop20 rt"> -->
                    <br class="clear">
                </a>
            </td>
        </tr>
        <tr>
            <td align="left">说明</td>
            <td align="left"><input type="text" name="address" class="input06" placeholder="请输入详细地址" value="{{$address->address}}" /></td>
        </tr>
        <!-- <tr>
            <td align="left">邮编号码</td>
            <td align="left"><input type="text" id="consignee_postcode" class="input06" placeholder="请输入邮编号码" value="" /></td>
        </tr> -->

    </table>
    <div class="paddingbuding02">
        <span class="font_size03 margintop10 lf">是否设为默认地址</span>
        <a href="javascript:void(0);" class="switch rt">
            @if ($address->is_default)
            <img src="/wap/images/icon/switch2.png" alt="" height="40">
            @else
            <img src="/wap/images/icon/switch.png" alt="" height="40">
            @endif
        </a>
        <br class="clear">
    </div>

    <a href="javascript:void(0);" class="anniu02 margintop20 add_save ck" data-type="{{$type}}">保存</a>
</div>
<input id="add_type" type="hidden" name="is_default" value="{{$address->is_default}}">
</form>

<!--==========================省份==============================-->

<div id="province" style="display: none;">
    <div class="top">
        <span>省市区</span>
        <a href="javascript:void(0);" onclick="showaddress();" class="lf marginleft10 back"><img src="/wap/images/icon/back.png" alt="" height="16"></a>
        <br class="clear" />
    </div>

    <div style="height: 54px;"></div>
    <!--{foreach from=$provinces item=pv}-->
    <a href="javascript:void(0);" class="home_title01 bdbottom01 add_province" data-provincename="<!--{$pv.province_name}-->" data-provinceid="<!--{$pv.province_id}-->">
        <span class="lf"><!--{$pv.province_name}--></span>
        <img src="/wap/images/icon/arrow02.png" alt="" height="12" class="margintop20 rt">
        <br class="clear">
    </a>
    <!--{/foreach}-->
</div>

<!--==========================城市==============================-->

<div id="city" style="display: none;">

</div>

<!--==========================县区==============================-->

<div id="county" style="display: none;">

</div>

</div>


<script type="text/javascript">
	$('.switch').click(function(){
        if($(this).find('img').attr('src')=='/wap/images/icon/switch.png'){
            $(this).find('img').attr('src','/wap/images/icon/switch2.png');
            $("#add_type").val("1");
        }else{
            $(this).find('img').attr('src','/wap/images/icon/switch.png');
            $("#add_type").val("0");
        }
    });

    $('.ck').click(function () {
    	var type = $(this).data('type');
    	var send_data = $('#address_form').serialize();
    	
    	var phone = $("input[name=phone]").val();
        if(!(/^1[3|4|5|7|8|9][0-9]\d{4,8}$/.test(phone))){
            alert('请填写正确的手机号码！');return false;
        }

    	send_data += '&type'+ type;

    	$.post('/user/address/save', send_data, function (data) {
    		alert(data.message);
    		if (data.status == 1) {
    			window.location.href = '/user/address';
    		}
    	});
    });
</script>
@stop