<div class="hpd get_order" style="width: 1200px; margin-bottom: 40px;">
			
	<div class="control-group">
		<label class="control-label order_num" style="font-size: 20px;">添加商品</label>
		<div class="controls">
			
		</div>
	</div>


	<div class="control-group">
		<label class="control-label">标题</label>
		<div class="controls">
			<input type="text" class="goods_title" style="width: 640px;" placeholder="填写标题">
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
			<img src="/wap/wu.jpg" width="640" height="640" class="img-polaroid">

		</div>
	</div>

	<div class="control-group">
		<label class="control-label">销量</label>
		<div class="controls">
			<input type="number" class="sale_num" placeholder="填写销量" value="0">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">分类</label>
		<div class="controls">
			<select class="category">
				@foreach ($categorys as $cat)
				<option value="{{$cat->id}}">{{$cat->category}}</option> 
				@endforeach
			</select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">是否推荐</label>
		<div class="controls">
			<select class="is_hot">
				<option value="0">否</option>
				<option value="1">是</option>
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
				<span style="display: inline-block"><input type="checkbox" id="{{$sku_value->id}}" value="{{$sku_value->id}}"><label>{{$sku_value->value}}</label></span>
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
			<script type="text/plain" id="myEditor" style="width: 640px;height:480px;">
			</script>
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label" for=""></label>
		<div class="controls">
				<input type="button" class="goods_add btn btn-primary" value="添加商品">
			</div>
	</div>

</div>
<script>
$('input').iCheck('destroy');
$('input').iCheck({
	checkboxClass: 'icheckbox_square-blue',
	radioClass: 'iradio_square-blue',
	increaseArea: '20%' // optional
});

$('.iCheck-helper').click(function() {
	$(this).parents('.get_order').find('.sku_table').html('');
});
</script>