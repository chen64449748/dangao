@extends('admin.template')

@section('content')
<div class="page-head">
 	<h2>活动</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">活动</a></li>
    	@if ($act == 'add')
    	<li class="active">添加活动</li>
  		@else 
  		<li class="active">活动详情</li>
  		@endif
  	</ol>
</div>

<form class="form-horizontal" id="active_order">
 	
 	<div class="" style="width: 1200px; margin-bottom: 40px;">
			
		<div class="control-group">
			<label class="control-label order_num" style="font-size: 20px;">
				@if ($act == 'add') 添加活动 @else 编辑活动 @endif
			</label>
			<div class="controls">
				
			</div>
		</div>


		<div class="control-group">
			<label class="control-label">标题</label>
			<div class="controls">
				<input type="text" class="active_title" name="active_title" style="width: 640px;" placeholder="填写标题" value="{{$active->active_title}}">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">图片上传</label>
			<div class="controls">
				<form class="upload_from" enctype="multipart/form-data">
					<input type="file" name="img" class="file_upload">
					<input type="button" value="上传" class="btn btn-info u_btn">
					<span style="color: red">640 * 300 效果最佳</span>
				</form>
				
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">图片预览</label>
			<div class="controls" >
				<img src="{{$active->active_img}}" style="width: 640px; height: 300px;" width="640" height="300" class="img-polaroid active_img">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">开始时间</label>
			<div class="controls">
				<input type="text" class="begin_time  time" name="begin_time" placeholder="开始时间" value="{{$active->begin_time}}">
				如果两个活动时间重叠 系统会使用最新的活动
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">结束时间</label>
			<div class="controls">
				<input type="text" class="end_time time" name="end_time" placeholder="结束时间" value="{{$active->end_time}}">
			</div>
		</div>

		
		<div class="control-group">
			<label class="control-label">是否首页精品</label>
			<div class="controls">
				<select name="is_fine" class="is_fine">
					<option @if ($active->is_fine === 0) selected="selected" @endif value="0" >否</option>
					<option @if ($active->is_fine == 1) selected="selected" @endif value="1" >是</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">优惠方式</label>
			<div class="controls">
				<select name="type" class="type">
					<option @if ($active->type === 1) selected="selected" @endif value="1">折扣</option>
					<option @if ($active->type === 2) selected="selected" @endif value="2">减价</option>
				</select>
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">折扣</label>
			<div class="controls">
				<input type="number" name="discount" class="discount" placeholder="折扣 %" value="{{$active->discount}}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">减价</label>
			<div class="controls">
				<input type="number" name="money" class="money" placeholder="减价/元" value="{{$active->money}}">
			</div>
		</div>
		
		<!-- <div class="control-group">
			<label class="control-label" for="cs">参加活动商品</label>
			<div class="controls active_goods" style="height: 600px; overflow-y: scroll">
				
				<span style="float: left; margin: 0 0 20px 0; "><img class="img-polaroid" style="width: 180px; height: 180px" width="180" height="180" src=""><label style="width: 180px; "></label><input type="checkbox" id="" value=""></span>
				
				
			</div>
			<div style="clear: both"></div>
			<div class="controls">
				<input type="button" data-page="2" flag="1" class="active_goods_loading btn btn-primary" value="加载更多商品">
			</div>
		</div> -->

		<div class="control-group">
			<label class="control-label" for=""></label>
			<div class="controls">
				<input type="button" class="active_add  btn btn-primary" data-id="{{$active->id}}" data-act="{{$act}}" value="保存活动">
				<a type="button" class="btn btn-info" href="javascript:history.back(-1);" >取消</a>
			</div>
		</div>
	</div>

</form>
@stop

@section('script')
<script>
	$('input').iCheck('destroy');
	$('input').iCheck({
		checkboxClass: 'icheckbox_square-blue',
		radioClass: 'iradio_square-blue',
		increaseArea: '20%'
	});

	$('.time').datetimepicker({
		format: 'yyyy-mm-dd hh:00:00',
		language: 'zh-CN',
		autoclose: true,
		todayHighlight: true,
		minView: 1,
	});

	$('.active_goods_loading').click(active_goods_loading);

	function active_goods_loading()
	{
		var page = $(this).data('page');
		var flag = $(this).attr('flag');
		if (flag == '0') {
			return;
		}

		var loading = $(this);
		$(this).off('click');
		$.get('/active/goods/loading', {page: page}, function (data) {

			if (data.status == 400) {
				loading.attr('flag', '0');
				return ;
			}


			loading.data('page', Number(loading.data('page')) + 1);
			var goods = data.goods;
			for (var i in goods) {
				var html = '<span style="float: left; margin: 0 0 20px 0; "><img class="img-polaroid" style="width: 180px; height: 180px" width="180" height="180" src="'+ goods[i].goods_img +'"><label style="width: 180px; ">'+ goods[i].goods_title +'</label><input type="checkbox" id="" value="'+ goods[i].id +'"></span>';	
				$('.active_goods').append(html);
			};
			$('input').iCheck('destroy');
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' // optional
			});
			loading.click(active_goods_loading);
		})

	}

	$('.u_btn').click(function () {
		var file = $('.file_upload');
		var img = $('.active_img');
		
		uploadImage(file[0].files[0], 'active', function (status, data) {
			if (status == 200) {
				var data = JSON.parse(data);
				if (data.status == 1) {
					//修改图片
					img.attr('src', data.url);
					file.val('');

				} else {
					return window.wxc.xcConfirm('上传失败' + data.message, window.wxc.xcConfirm.typeEnum.error);
				}
			} else {
				return window.wxc.xcConfirm('请求失败'+ status, window.wxc.xcConfirm.typeEnum.error);
			}
		});

	});
	
	$('.active_add').click(function () {

		var active_title = $('.active_title').val(),
			active_img = $('.active_img').attr('src'),
			begin_time = $('.begin_time').val(),
			end_time = $('.end_time').val(),
			is_fine = $('.is_fine').find('option:selected').val(),
			type = $('.type').find('option:selected').val(),
			discount = $('.discount').val(),
			money = $('.money').val();
		var act = $(this).data('act');

			if (!active_title) {
				return window.wxc.xcConfirm('标题必填', window.wxc.xcConfirm.typeEnum.info);
			}

			if (type == 1 && discount == '') {
				return window.wxc.xcConfirm('折扣必填', window.wxc.xcConfirm.typeEnum.info);
			}

			
			if (type == 2 && money == '') {
				return window.wxc.xcConfirm('减价金额必填', window.wxc.xcConfirm.typeEnum.info);
			}

			if (active_img == '/wap/wu.jpg') {
				return window.wxc.xcConfirm('请选择图片上传', window.wxc.xcConfirm.typeEnum.info);
			}

			if (!begin_time || !end_time) {
				return window.wxc.xcConfirm('活动时间范围比选', window.wxc.xcConfirm.typeEnum.info);
			}
			var active_id = $(this).data('id');
			var  send_data = $('#active_order').serialize();
			send_data += '&active_img=' + active_img + '&act=' + act;

			if (act == 'update') {
				send_data += '&active_id='+ active_id;
			}

			var txt= "确定保存活动？";
			var option = {
				title: "保存活动",
				btn: parseInt("0011",2),
				onOk: function(){
					LayerShow('')
					$.post('/active/admin/save', send_data, function (data) {
						LayerHide();
						if (data.status == 1) {
							window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
							setTimeout(function () {
								window.location.href = '/active/list';
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