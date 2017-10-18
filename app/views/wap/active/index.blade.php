@extends('wap.header')

@section('content')
<div class="top" style="z-index: 103;">
    <span>活动精选</span>
    <br class="clear">
</div>
<style type="text/css">
	.active_item {padding: 0 16px; margin-top: 16px;}

</style>

<div class="active" style="padding: 50px 0;">
	@if (count($actives))
	@foreach ($actives as $item)
	<div class="active_item"><a href="javascript:void(0)" class="dsp_blk"><img style="width: 640px; height: 220px;" src="{{$item->active_img}}" width="100%"></a></div>
	<div class="paddingbuding02">活动说明: 
		<span class="color_pink">
			<div>
				时间范围：{{$item->begin_time}} --- {{$item->end_time}}
			</div>
			<div>
				优惠 
				@if ($item->type == 1)
				折扣 {{$item->discount}}
				@elseif ($item->type == 2)
				减价 ￥{{$item->money}}
				@endif 
			</div>
		</span>
	</div>
	@endforeach
	@else
	<div class="align_center">
        <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 50px 0 10px 0;">
        <div class="color_gray font_size02">暂无活动</div>
    </div>
    @endif
</div>

@include('wap.menu')

@stop