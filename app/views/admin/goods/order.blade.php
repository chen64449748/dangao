<div class="hpd get_order" style="width: 500px; margin-bottom: 40px;">
			
	<div class="control-group">
		<label class="control-label order_num" style="font-size: 20px;">货品单</label>
		<div class="controls">
			
		</div>
	</div>


	<div class="control-group">
		<label class="control-label">货号</label>
		<div class="controls">
			<input type="text" class="goods_number" placeholder="填写货号">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label">货号描述</label>
		<div class="controls">
			<input type="text" class="goods_desc" placeholder="填写货品描述">
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

	<div class="control-group delete">
		<label class="control-label"></label>
		<div class="controls">
			<input type="button" class="delete_order btn btn-danger" value="去掉这个货品单">
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