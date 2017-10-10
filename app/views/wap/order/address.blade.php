@extends('wap.header')

@section('content')
<div class="top">
	<span>收货地址管理</span>
	<a href="javascript:history.back(-1);" class="lf marginleft10">
        <img src="/wap/images/icon/back.png" style="position: relative; top: 18px;" alt="" height="16"></a>
	<br class="clear" />
</div>
<div style="height: 50px;"></div>

<div>

<div class="address">
	<div class="font_size03">
        
        @foreach ($addresses as $address)
		<div style="border-bottom: 1px solid #c9c9c9">
			<a href="/buy/{{$order_id}}?address_id={{$address->id}}" >
				<span class="line_height30">{{$address->name}}&emsp;&emsp;{{$address->phone}}</span>
		        <div class="color_silver">{{$address->address}}</div>
		        <br class="clear" />
			</a>
		</div>
		@endforeach
		
	</div>
</div>

</div>
@stop