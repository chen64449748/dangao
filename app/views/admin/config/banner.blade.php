@extends('admin.template')

@section('content')

<div class="page-head">
 	<h2>页面设置</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">滚动广告</a></li>
    	<li class="active">配置表</li>
  	</ol>
</div>

<div class="page-head">
	<div class="fr">
		<a class="btn btn-primary" id="add_btn" data-toggle="modal" data-target="#bannerModal" href="javascript:;">添加广告</a>
		<input type="file" style="display: none;">
	</div>

	<div style="clear: both;"></div>
</div>

<div class="form-horizontal" id="banner">

	<div class="control-group">
		<label class="control-label">广告预览</label>
		<div class="controls">
			<img src="/wap/wu.jpg" style="width: 640px; height: 290px;" id="show_pic" class="img-polaroid">
		</div>
	</div>

	@foreach ($banners as $key => $item)
	<div class="control-group update_div">
		<label class="control-label">广告{{$key + 1}}</label>
		<div class="controls">
			<input type="text" data-id="{{$item->id}}" class="banner_url" placeholder="填写连接" value="@if ($item->banner_url == 'javascript:;')@else{{$item->banner_url}}@endif">
			<input type="button" value="上传" class="btn btn-info u_btn">
			<input type="file" style="display:none" class="u_file">
			<input type="button" value="预览图片" data-id="{{$item->id}}" data-img="{{$item->banner_img}}" class="btn btn-info p_btn">
		</div>
	</div>
	@endforeach
	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">		
			<input type="button" value="保存修改" class="btn btn-info save">
		</div>
	</div>
</div>

<div id="bannerModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="bannerModalLabel" aria-hidden="true">
	<input type="hidden" id="sku_id" value="">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="skuValueTitle">添加广告</h3>
	</div>
	<div class="modal-body form-horizontal pic_div">
		
		<div class="control-group">
    		<label class="control-label" for="c_item">连接</label>
    		<div class="controls">
    			<input type="text" id="add_url" placeholder="填写连接">
    		</div>
  		</div>

  		<div class="control-group">
    		<label class="control-label" id="sku_name_label" for="c_item">图片</label>
    		<div class="controls">
    			<input type="button" value="上传" class="btn btn-info add_pic">
    			<input type="file" id="add_file" style="display: none;" placeholder="">
    		</div>
  		</div>

  		<div class="control-group">
    		<label class="control-label" id="sku_name_label" for="c_item">图片展示</label>
    		<div class="controls">
    			<img src="/wap/wu.jpg" style="width: 320px; height: 145px;" id="add_show_pic" class="img-polaroid">
    		</div>
  		</div>
	</div>
	<div class="modal-footer">
		<button class="btn cls" data-dismiss="modal" aria-hidden="true">关闭</button>
		<button class="btn btn-primary banner_add">添加广告</button>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript">
	$('.add_pic').click(function () {
		$('#add_file').click();
	});

	$('#add_btn').click(function () {
		$('#add_show_pic').attr('src', '/wap/wu.jpg');
		$('#add_url').val('');
	});

	$('.banner_add').click(function () {
		var banner_img = $('#add_show_pic').attr('src');
		var banner_url = $('#add_url').val();
		var send_data = {act: 'add', banner_img: banner_img, banner_url: banner_url};

		if (banner_img == '/wap/wu.jpg') {
			return window.wxc.xcConfirm('请上传图片', window.wxc.xcConfirm.typeEnum.error);
		}

		var txt= "确定添加广告？";
		var option = {
			title: "添加广告",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('');
				$.post('/admin/banner/save', send_data, function (data) {
					LayerHide();
					if (data.status == 1) {
						window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
						setTimeout(function () {
							window.location.href = '/admin/banner';
						}, 800);
					} else {
						return window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
					}

				})
			}
		}

		window.wxc.xcConfirm(txt, "custom", option);

	});


	// u_btn
	$('.u_btn').click(function () {
		var p_btn = $(this).parent('.controls').find('.p_btn');
		var u_file = $(this).parent('.controls').find('.u_file');
		u_file.click();

	});

	// 修改图片上传
	$('.u_file').change(function () {
		var p_btn = $(this).parent('.controls').find('.p_btn');
		var file = $(this).get(0);

		uploadImage(file.files[0], 'banner', function (status, data) {
			if (status == 200) {
				var data = JSON.parse(data);
				if (data.status == 1) {
					//修改图片
					p_btn.data('img', data.url);
					$('#show_pic').attr('src', data.url);
					$(file).val('');

				} else {
					return window.wxc.xcConfirm('上传失败' + data.message, window.wxc.xcConfirm.typeEnum.error);
				}
			} else {
				return window.wxc.xcConfirm('请求失败'+ status, window.wxc.xcConfirm.typeEnum.error);
			}
		});
	});

	// 预览
	$('.p_btn').click(function () {
		var src = $(this).data('img');
		$('#show_pic').attr('src', src);
	});

	$('#add_file').change(function () {
		var file = $(this).get(0);
		var img = $(file).parents('.pic_div').find('.img-polaroid');
		uploadImage(file.files[0], 'banner', function (status, data) {
			if (status == 200) {
				var data = JSON.parse(data);
				if (data.status == 1) {
					//修改图片
					img.attr('src', data.url);
					$(file).val('');

				} else {
					return window.wxc.xcConfirm('上传失败' + data.message, window.wxc.xcConfirm.typeEnum.error);
				}
			} else {
				return window.wxc.xcConfirm('请求失败'+ status, window.wxc.xcConfirm.typeEnum.error);
			}
		});
	});

	$('.save').click(function () {

		var data = [];

		$('.update_div').each(function (){
			var update_o = {};

			update_o.banner_url = $(this).find('.banner_url').val();
			update_o.banner_img = $(this).find('.p_btn').data('img');
			update_o.banner_id = $(this).find('.p_btn').data('id');

			data.push(update_o);
		});

		var send_data = {act: 'update', data: data};
		var txt= "确定修改广告？";
		var option = {
			title: "修改广告",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('');
				$.post('/admin/banner/save', send_data, function (data) {
					LayerHide();
					if (data.status == 1) {
						window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
						setTimeout(function () {
							window.location.href = '/admin/banner';
						}, 800);
					} else {
						return window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
					}

				})
			}
		}

		window.wxc.xcConfirm(txt, "custom", option);
	});

</script>
@stop