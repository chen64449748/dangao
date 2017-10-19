@extends('admin.template')

@section('content')

<div class="page-head">
 	<h2>页面设置</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">店铺设置</a></li>
    	<li class="active">配置表</li>
  	</ol>
</div>

<div class="form-horizontal page-head" id="shop">
	<div class="control-group">
		<label class="control-label">店铺名</label>
		<div class="controls">
			<input type="text" id="shop_name" value="{{$shop->shop_name}}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">商家手机号</label>
		<div class="controls">
			<input type="text" id="shop_phone" value="{{$shop->shop_phone}}">
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">商家介绍</label>
		<div class="controls">
			<textarea id="shop_discrib" style="width:200px;height:100px;">{{$shop->shop_discrib}}</textarea> 
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">店铺状态</label>
		<div class="controls">
			<select id="shop_work">
				<option @if ($shop->shop_work == 1) selected @endif value="1">开店</option>
				<option @if ($shop->shop_work === 0) selected @endif value="0">打烊</option>
			</select>
		</div>
	</div>

	<div class="control-group">
		<label class="control-label">配送地区</label>
		<div class="controls">
			<input type="text" id="send_address" placeholder="如江苏省 南通市" value="{{$shop->send_address}}">
		</div>
	</div>
	
	<div class="control-group">
		<label class="control-label">图片品质</label>
		<div class="controls">
			<input type="number" id="img_quality" placeholder="如江苏省 南通市" value="{{$shop->img_quality}}"> 1 - 100 当觉得网站加载慢可能是图片过大将品质设置低点
		</div>
	</div>

	<div class="control-group">
		<label class="control-label"></label>
		<div class="controls">
			<input type="button" class="btn btn-primary" id="save" value="保存">
		</div>
	</div>
</div>

@stop

@section('script')
<script type="text/javascript">
	$('#save').click(function () {
		var shop_phone = $('#shop_phone').val();
		var shop_name = $('#shop_name').val();
		var shop_discrib = $('#shop_discrib').val();
		var shop_work = $('#shop_work').find('option:selected').val();
		var send_address = $('#send_address').val();
		var img_quality = $('#img_quality').val();

		if (!shop_name) {
			return window.wxc.xcConfirm('请填写店铺名', window.wxc.xcConfirm.typeEnum.info);
		}

		if (!send_address) {
			return window.wxc.xcConfirm('请填写配送地地区', window.wxc.xcConfirm.typeEnum.info);
		}

		if(!(/^1[3|4|5|7|8|9][0-9]\d{4,8}$/.test(shop_phone))){
            return window.wxc.xcConfirm('请填写正确的手机号', window.wxc.xcConfirm.typeEnum.info);
        }

        var send_data = {shop_name: shop_name, shop_phone: shop_phone,shop_discrib:$.trim(shop_discrib), shop_work: shop_work, send_address: send_address, img_quality: img_quality};
        var txt= "确定修改？";
		var option = {
			title: "修改店铺",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('');
				$.post('/admin/shop/save', send_data, function (data) {
					LayerHide();
					if (data.status == 1) {
						window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
						setTimeout(function () {
							window.location.href = '/admin/shop';
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