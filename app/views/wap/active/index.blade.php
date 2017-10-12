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
	<div class="active_item"><a href="/active/detail/{{$item->id}}" class="dsp_blk"><img src="{{$item->active_img}}" width="100%"></a></div>
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