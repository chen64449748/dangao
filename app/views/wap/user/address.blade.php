@extends('wap.header')

@section('content')
<div class="top">
	<span>收货地址管理</span>
	<a href="/user" class="lf marginleft10">
        <img style="position:relative; top: 18px;" src="/wap/images/icon/back.png" alt="" height="16"></a>
	<a href="/user/address/detail" class="rt marginright10">
        <img style="position:relative; top: 18px;" src="/wap/images/icon/add2.png" alt="" height="16"></a>
	<br class="clear" />
</div>
<div style="height: 50px;"></div>

<div>
@if (isset($addresses[0]))
@foreach ($addresses as $address) 
<div class="address">
	<div class="font_size03">
        
        <span class="line_height30">{{$address->name}}&emsp;&emsp;{{$address->phone}}</span>
        <div class="color_silver">{{$address->address}}</div>
        
        <div class="paddingbuding02">
        <a href="javascript:void(0);" data-id="{{$address->id}}" class="imgbuding margintop05 moren lf" >
            @if ($address->is_default)
            <img class="moren_img" src="/wap/images/icon/ok2.png" alt="" height="16">&nbsp;默认地址
            @else
            <img class="moren_img" src="/wap/images/icon/ok3.png" alt="" height="16">&nbsp;默认地址
            @endif
        </a>
        <a href="javascript:void(0);" class="rt" style="margin-right: 10px;" onclick="deleteaddress(this, {{$address->id}});">
            <img src="/wap/images/icon/delete.png" alt="" height="16">
        </a>

        <a href="/user/address/detail?address_id={{$address->id}}&type=update" class="rt" style="margin-right: 10px;">
            <img src="/wap/images/icon/bianji.png" alt="" height="16">&emsp;
        </a>
        <br class="clear" />
		</div>
	</div>
</div>
@endforeach
@else
<div class="align_center">
	<img src="/wap/images/icon/dizhipng.png" alt="" height="48" style="margin: 50px 0 10px 0;">
	<div class="color_gray font_size02">暂时没有收货地址</div>
	<a href="/user/adddetail.php"class="anniu03 jz margintop10">立即添加</a>
</div>
@endif
</div>

<script type="text/javascript">
	function deleteaddress(obj, address_id)
	{
		confirm('确定删除？', function (res) {
			if (!res) return;

			$.post('/user/address/delete', {address_id: address_id}, function (data) {
				alert(data.message);

				if (data.status == 1) {
					$(obj).parents('.address').remove();
					if (data.is_default == 1) {
						window.location.reload();
					}
				}
			});
		});
		
	}

	$('.moren').click(function () {
		var address_id = $(this).data('id');

		if ($(this).find('.moren_img').attr('src') == '/wap/images/icon/ok2.png') {
			return;
		}
		var check_a = $(this);

		$.post('/user/address/default', {address_id: address_id}, function (data) {
			if (data.status == 1) {

				$('.moren').find('.moren_img').each(function () {
					$(this).attr('src', '/wap/images/icon/ok3.png');
				});
				check_a.find('.moren_img').attr('src', '/wap/images/icon/ok2.png');
			} else {
				alert(data.message);
			}
		})

	});

</script>
@stop