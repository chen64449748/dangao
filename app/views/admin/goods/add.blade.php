@extends('admin.template')

@section('content')

<link href="/js/umeditor1.2.3/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

<div class="page-head">
 	<h2>货品</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">货品</a></li>
    	<li class="active">添加货品</li>
  	</ol>
</div>


<div class="row page-head">

	<!-- <div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<input type="button" id="add_goods_order" class="btn btn-primary" value="添加一个货品单 +">
		</div>
	</div> -->
	
	<!-- <div class="control-group">
		<label class="control-label" for=""></label>
		<div class="controls">
				<input type="button" class="goods_add btn btn-primary btn-lg" value="添加货品">
			</div>
	</div> -->

	<style>
		.hpd {float: left; padding: 0 10px;}
	</style>

	<div class="form-horizontal" id="goods_order">
 		
	</div>
	
</div>


@stop


@section('script')
<script type="text/javascript" src="/js/umeditor1.2.3/third-party/template.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/umeditor1.2.3/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/umeditor1.2.3/umeditor.min.js"></script>
<script type="text/javascript" src="/js/umeditor1.2.3/lang/zh-cn/zh-cn.js"></script>

<script>

	getSign('#goods_order');
	skuRead();
	var um = '';
	// 初始化
	$.post('/goods/add/order', {}, function (data) {

		$('#goods_order').append(data);
		um = UM.getEditor('myEditor');
		$('.edui-icon-fullscreen').remove();

	});

	$('#goods_order').on('click', '.goods_add', function () {

		goodsAdd(function (data) {
			LayerHide();
			if (data.status == 1) {
				window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
				setTimeout(function () {
					window.location.href = '/goods/list';
				}, 800);
			} else {
				return window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
			}
		});
		
	});

	
	// 瀑布流布局
	// var container = document.querySelector('#goods_order');
	// var msnry = new Masonry( container, {
	//   columnWidth: 400,
	//   itemSelector: '.hpd',
	// });

	$('#add_goods_order').click(function () {
		
		var send_data = {
			
		};
		$.post('/goods/add/order', send_data, function (data) {

			$('#goods_order').append(data);

			$('#goods_order').find('.hpd').each(function (index) {
			
				var now_index = index + 1;
				// 循环货品单
				$(this).find('.order_num').text('货品单' + now_index);
				$(this).find('.delete_order').val('去掉货品单'+ now_index);
			});

		});

	});

	// 删除货品单
	$('#goods_order').on('click', '.delete_order', function () {
		$(this).parents('.hpd').remove();
		$('#goods_order').find('.hpd').each(function (index) {
			
			var now_index = index + 1;
			// 循环货品单
			$(this).find('.order_num').text('货品单' + now_index);
			$(this).find('.delete_order').val('去掉货品单'+ now_index);
		});
	});

	
	// 上传
	$('#goods_order').on('click', '.u_btn', function () {

		var form = $(this).parents('.hpd').find('.upload_from');
		var file = $(this).parents('.hpd').find('.file_upload');
		var img = $(this).parents('.hpd').find('.img-polaroid');

		if (file[0].files.length == 0) {
			return window.wxc.xcConfirm('请选择文件', window.wxc.xcConfirm.typeEnum.error);
		}

		uploadImage(file[0].files[0], 'goods', function (status, data) {
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

</script>

@stop