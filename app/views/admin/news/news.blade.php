@extends('admin.template')

@section('content')
<div class="page-head">
 	<h2>文章</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">文章</a></li>
    	<li class="active">文章列表</li>
  	</ol>
</div>


<div class="row page-head">
<!--搜索条件-->
	<form class="form-inline" method="get">

	<div class="fr">
		<a class="btn btn-primary" href="/news/detail">添加</a>
	</div>

	</form>
</div>


<table class="table table-striped" >
	<tr>
		<th>#</th>
		<th>背景音乐</th>
		<th>链接</th>
		<th>操作</th>
	</tr>
	
	@foreach ($newses as $item)
	<tr style="line-height: 80px;">
		<td>{{$item->id}}</td>
		<td>{{$item->bg_mic}}</td>
		<td>{{$item->url}}</td>
		<td>
			<a class="btn btn-primary btn-sm" href="/news/detail?act=update&id={{$item->id}}">编辑</a>
			<a target="_blank" href="http://{{$item->url}}">预览</a>
		</td>
	</tr>
	@endforeach


</table>
<div class="pagination fr">
{{$newses->links()}}
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
