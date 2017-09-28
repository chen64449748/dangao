@extends('wap.index')

@section('content')
<div class="top" style="z-index: 103;">
    <span>活动精选</span>
    <br class="clear">
</div>
<style type="text/css">
	.active_item {padding: 0 16px; margin-top: 16px;}

</style>

<div class="active" style="padding: 50px 0;">

	<div class="active_item"><a href="/active/detail/1" class="dsp_blk"><img src="/wap/1467603508.jpg" width="100%"></a></div>
	<div class="active_item"><a href="" class="dsp_blk"><img src="/wap/1467603508.jpg" width="100%"></a></div>
	<div class="active_item"><a href="" class="dsp_blk"><img src="/wap/1467603508.jpg" width="100%"></a></div>
	<div class="active_item"><a href="" class="dsp_blk"><img src="/wap/1467603508.jpg" width="100%"></a></div>
	<div class="align_center">
        <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 50px 0 10px 0;">
        <div class="color_gray font_size02">暂无数据</div>
    </div>
</div>

@include('wap.menu')

@stop