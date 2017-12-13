@extends('wap.header')

@section('content')
<style>
	body{background-color: white;}
</style>
<div class="top">
	<span>特云妮亚</span>
	<br class="clear" />
</div>
<div style="height: 44px;"></div>
<div class="content">
{{$news->content}}
</div>

<audio id="mp3Btn" loop="loop" autoplay="autoplay">
    <source src="{{$news->bg_mic}}" type="audio/mpeg" />
</audio>

<script>
(function audioAutoPlay() {
     var audio = document.getElementById('mp3Btn');
        audio.play();
    document.addEventListener("WeixinJSBridgeReady", function () {
        audio.play();
     }, false);
 })();
</script>
@stop
