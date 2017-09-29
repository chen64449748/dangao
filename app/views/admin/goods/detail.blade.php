@extends('admin.template')

@section('content')
<link href="/js/umeditor1.2.3/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">

<div class="page-head">
 	<h2>商品</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">商品</a></li>
    	<li class="active">编辑商品</li>
  	</ol>
</div>
<a href="javascript:history.go(-1)" class="btn btn-info">返回列表</a>
<div id="goods_order">
	<div class="hpd form-horizontal get_order" style="width: 640px; margin-bottom: 40px;">
				
		<div class="control-group">
			<label class="control-label order_num" style="font-size: 20px;">商品ID: {{$goods->id}}</label>
			<div class="controls">
				
			</div>
		</div>


		<div class="control-group">
			<label class="control-label">标题</label>
			<div class="controls">
				<input type="text" class="goods_title" style="width: 640px;" placeholder="填写货号" value="{{$goods->goods_title}}">
			</div>
		</div>
		
		<div class="control-group">
			<label class="control-label">图片上传</label>
			<div class="controls">
				<form class="upload_from" enctype="multipart/form-data">
					<input type="file" name="img" class="file_upload">
					<input type="button" value="上传" class="btn btn-info u_btn">
					<span style="color: red">640 * 640 效果最佳</span>
				</form>
				
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">图片</label>
			<div class="controls">
				<img src="{{$goods->goods_img}}" width="640" height="640" class="img-polaroid">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">销量</label>
			<div class="controls">
				<input type="number" class="sale_num" placeholder="填写销量" value="{{$goods->sale_num}}">
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">分类</label>
			<div class="controls">
				<select class="category">
					@foreach ($categorys as $cat)
					<option @if ($cat->id == $goods->category_id) selected @endif value="{{$cat->id}}">{{$cat->category}}</option> 
					@endforeach
				</select>
			</div>
		</div>

		<div class="control-group">
			<label class="control-label">是否推荐</label>
			<div class="controls">
				<select class="is_hot">
					<option @if ($goods->is_hot == 0) selected @endif value="0">否</option>
					<option @if ($goods->is_hot == 1) selected @endif value="1">是</option>
				</select>
			</div>
		</div>

		<!-- sku -->
		<div class="control-group">
			<label class="control-label" for="cs">价格库存关联</label>
			<div class="controls skus_select">
			@foreach ($skus as $sku)
				<label for="{{$sku->id}}">{{$sku->sku_name}}</label>
				@foreach ($sku->skuValues as $sku_value)
				<span style="display: inline-block"><input type="checkbox" @if (in_array($sku_value->id, $sku_value_ids)) checked="checked" @endif id="{{$sku_value->id}}" value="{{$sku_value->id}}"><label for="{{$sku_value->id}}">{{$sku_value->value}}</label></span>
				@endforeach
			@endforeach
			</div>
		</div>
	
		<div class="control-group">
			<label class="control-label"></label>
			<div class="controls">
				<input type="button" class="sku_read btn btn-info" value="填写价格库存表">
			</div>
		</div>

		<div class="control-group sku_table">

		</div>

		<!-- 富文本编辑 -->
		<div class="control-group">
			<label class="control-label">详情编辑</label>
			<div class="controls">
				<script type="text/plain" id="myEditor" style="width: 640px;height:640px;">
				{{$goods_content->content}}
				</script>
			</div>
		</div>

		<div class="control-group delete">
			<label class="control-label"></label>
			<div class="controls">
				<input type="button" class="update_goods btn btn-primary" value="修改">
			</div>
		</div>
	</div>

</div>
@stop

@section('script')
<script type="text/javascript" src="/js/umeditor1.2.3/third-party/template.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/umeditor1.2.3/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/umeditor1.2.3/umeditor.min.js"></script>
<script type="text/javascript" src="/js/umeditor1.2.3/lang/zh-cn/zh-cn.js"></script>
<script>
$('.goods_nav').parent().addClass('active');
$('input').iCheck('destroy');
$('input').iCheck({
	checkboxClass: 'icheckbox_square-blue',
	radioClass: 'iradio_square-blue',
	increaseArea: '20%' // optional
});
addNumType();
skuRead("{{$goods->id}}");

// 富文本
var um = UM.getEditor('myEditor');

$('.sku_read').click();

$('.iCheck-helper').click(function() {
	$(this).parents('.get_order').find('.sku_table').html('');
});


$('.update_goods').click(function () {
	var goods_id = '{{$goods->id}}';
	var goods = {};

	var goods_title = $('.goods_title').val(),
		goods_img = $('.img-polaroid').attr('src'),
		category_id = $('.category').find('option:selected').val(),
		is_hot = $('.is_hot').find('option:selected').val(),
		sale_num = $('.sale_num').val();

		if (isNaN(sale_num)) {
			return window.wxc.xcConfirm('销量必须为数字', window.wxc.xcConfirm.typeEnum.info);
		}

		if (!goods_title) {
			return window.wxc.xcConfirm('标题必须填', window.wxc.xcConfirm.typeEnum.info);
		}


	goods.goods_title = goods_title;
	goods.goods_img = goods_img;
	goods.category_id = category_id;
	goods.is_hot = is_hot;
	goods.sale_num = sale_num;
	goods.sku_price = [];
	goods.goods_sku = [];
	goods.content = um.getContent();

	// sku关联
	$('.skus_select').find('input:checked').each(function () {
		goods.goods_sku.push($(this).val());
	});


	// skuprice 价格库存填写
	if ($('.sku_table table').size() == 0) {
		return window.wxc.xcConfirm('必须点击填写库存价格按钮', window.wxc.xcConfirm.typeEnum.info);
	}
	var sku_price_flag = true;
	var sku_stock_num = 0;
	$('.sku_table table').find('tr.sku_price_stock').each(function () {
		//循环tr
		var sku_price_o = {
			'stock' : 0,
			'sku_value_id' : [],
		};

		//读取价格 
		var price = $(this).find('input.price').val();
		var stock = $(this).find('input.stock').val();

		if (price && !stock) {
			sku_price_flag = false;
			return window.wxc.xcConfirm('填了价格必须填库存', window.wxc.xcConfirm.typeEnum.info);
		}

		if (isNaN(price)) {
			sku_price_flag = false;
			return window.wxc.xcConfirm('价格必须是数字', window.wxc.xcConfirm.typeEnum.info);
		}

		if (price) {
			sku_price_o.price = price;
		}

		if (stock) {
			// 有填库存信息的加进去
			sku_stock_num ++;

			sku_price_o.stock = stock;

			//读取priceid 如果有加进去 为修改 没有不加 为添加
			if ($(this).data('priceid')) {
				sku_price_o.price_id = $(this).data('priceid');
			}

			// 读取sku_value_id this tr 
			$(this).find('td.sku_value_id').each(function () {
				//this  td
				sku_price_o.sku_value_id.push($(this).data('skuvalueid'));
			});

			goods.sku_price.push(sku_price_o);

		}

	});

	if (sku_stock_num == 0) {
		return window.wxc.xcConfirm('至少要填一个库存', window.wxc.xcConfirm.typeEnum.info);
	}

	if (!sku_price_flag) {
		return;
	}

	var send_data = {
		'goods': goods,
		'goods_id': goods_id,
	}

	var txt= "确定修改商品？";
	var option = {
		title: "修改商品",
		btn: parseInt("0011",2),
		onOk: function(){
			LayerShow('')
			$.post('/goods/detail/update', send_data, function (data) {
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