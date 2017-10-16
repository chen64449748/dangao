@extends('admin.template')

@section('content')
<div class="page-head">
 	<h2>活动</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">活动</a></li>
    	<li class="active">活动列表</li>
  	</ol>
</div>


<div class="row page-head">
<!--搜索条件-->
	<form class="form-inline" method="get">
	<div class="control-group fl">

		<input type="text" name="active_title" class="input" placeholder="输入标题" value="{{$active_title}}">
		<input type="text" name="begin_time" class="input time" placeholder="开始时间" value="{{$begin_time}}">
		<input type="text" name="end_time" class="input time" placeholder="结束时间" value="{{$end_time}}">
		<select name="type">
			<option value="">优惠类型</option>
			<option @if ($type == 1) selected="selected" @endif value="1">折扣</option>
			<option @if ($type == 2) selected="selected" @endif value="2">减价</option>
		</select>
		<input type="submit" class="btn btn-primary" value="搜索">
	</div>

	<div class="fr">
		<a class="btn btn-primary" href="/active/admin/detail">添加活动</a>
	</div>

	</form>
</div>


<table class="table table-striped" >
	<tr>
		<th>#</th>
		<th>活动标题</th>
		<th>优惠类型</th>
		<th>活动图</th>
		<th>开始时间</th>
		<th>结束时间</th>
		<th>是否首页推荐</th>
		<th>操作</th>
	</tr>
	
	@foreach ($actives as $item)
	<tr style="line-height: 80px;">
		<td>{{$item->id}}</td>
		<td>{{$item->active_title}}</td>
		<td>
			@if ($item->type == 1)
				折扣 {{$item->discount}}%
			@elseif ($item->type == 2)
				减价 优惠￥{{$item->money}}
			@endif
		</td>
		<td><img src="{{$item->active_img}}" style="width: 100px; height: 50px;" width="100" height="50"></td>
		<td>{{$item->begin_time}}</td>
		<td>{{$item->end_time}}</td>
		<td>
			@if ($item->is_fine)
			<a href="javascript:void(0)" class="btn btn-success fine" data-id="{{$item->id}}">是</a>
			@else 
			<a href="javascript:void(0)" class="btn btn-danger fine" data-id="{{$item->id}}">否</a>
			@endif
		</td> <!-- 改成select -->	
		<td>
			<a class="btn btn-primary btn-sm" href="/active/admin/detail?act=update&active_id={{$item->id}}">编辑活动</a>
		</td>
	</tr>
	@endforeach


</table>
<div class="pagination fr">
{{$actives->links()}}
</div>
@stop

@section('script')
<script type="text/javascript">
	$('.time').datetimepicker({
		format: 'yyyy-mm-dd hh:00:00',
		language: 'zh-CN',
		autoclose: true,
		todayHighlight: true,
		minView: 1,
	});

	$('.fine').click(function () {

		var active_id = $(this).data('id');
		var txt= "确定修改？";
		var option = {
			title: "修改是否首页显示",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('')
				$.post('/active/admin/updateFine', {active_id: active_id}, function (data) {
					LayerHide();
					if (data.status == 1) {
						window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
						setTimeout(function () {
							window.location.reload();
						}, 800);

					} else {
						return window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
					}

				});

			},
		}

		window.wxc.xcConfirm(txt, "custom", option);
	});

</script>
@stop
