@extends('admin.template')

@section('content')
<div class="page-head">
 	<h2>货品</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">货品</a></li>
    	<li class="active">货品列表</li>
  	</ol>
</div>


<div class="row page-head">
<!--搜索条件-->
	<form class="form-inline" method="get">
	<div class="control-group fl">

		<input type="text" name="goods_title" class="input" placeholder="输入标题" value="{{$goods_title}}">
		<input type="text" style="width: 120px;" name="goods_id" class="input" placeholder="商品ID" value="{{$goods_id}}">
			
		<select name="category_id" style="width: 120px;">
			<option value="">分类选择</option>
			@foreach ($categorys as $category)
			<option @if ($category_id == $category->id) selected="selected" @endif value="{{$category->id}}">{{$category->category}}</option>
			@endforeach
		</select>

		<select name="is_onsale" style="width: 120px;">
			<option value="">上下架</option>
			<option @if ($is_onsale == 1) selected="selected" @endif value="1">上架</option>
			<option @if ($is_onsale === '0') selected="selected" @endif value="0">下架</option>
		</select>
	
		<select name="is_active" style="width: 120px;">
			<option value="">参与活动状态</option>
			<option @if ($is_active == 1) selected="selected" @endif value="1">参与</option>
			<option @if ($is_active === '0') selected="selected" @endif value="0">不参与</option>
		</select>

		<select name="is_hot" style="width: 120px;">
			<option value="">推荐状态</option>
			<option @if ($is_hot == 1) selected="selected" @endif value="1">推荐</option>
			<option @if ($is_hot === '0') selected="selected" @endif value="0">不是推荐</option>
		</select>

		<input type="submit" class="btn btn-primary" value="搜索">
	</div>

	<div class="fr">
		<a class="btn btn-primary" href="/goods/add">添加货品</a>
	</div>

	</form>
</div>


<table class="table table-striped" >
	<tr>
		<th>#</th>
		<th>商品标题</th>
		<th>商品图</th>
		<th>销量</th>
		<th>分类</th>
		<th>库存价格</th>
		<th>是否参与活动</th>
		<th>是否上架</th>
		<th>是否为推荐</th>
		<th>操作</th>
	</tr>
	
	@foreach ($goods as $item)
	<tr style="line-height: 80px;">
		<td>{{$item->id}}</td>
	
		<td>{{$item->goods_title}}</td>
		<td><img src="{{$item->goods_img}}" width="50" height="50"></td>
		<td>{{$item->sale_num}}</td>
		<td>{{$item->category->category}}</td>
		<td>
			<select>
			@foreach ($item->prices as $price)
				@if ($price->is_show)
					<option value="">{{$price->price}}元|
					@foreach ($price->skuPrices as $sp)
					{{$sp->skuValue->value}} 
					@endforeach
					</option>
				@endif
			@endforeach
			</select>
		</td> <!-- 改成select -->
		<th>
			@if ($item->is_active == 0)
			<a href="javascript:void(0)" class="btn btn-danger actived" data-id="{{$item->id}}">不参与</a>
			@else
			<a href="javascript:void(0)" class="btn btn-success actived" data-id="{{$item->id}}">参与</a>
			@endif
		</th>
		<th>
			@if ($item->is_onsale == 0)
			<a href="javascript:void(0)" class="btn btn-danger onsale" data-id="{{$item->id}}">已下架</a>
			@else
			<a href="javascript:void(0)" class="btn btn-success onsale" data-id="{{$item->id}}">已上架</a>
			@endif
		</th>
		<th>
			@if ($item->is_hot == 0)
			<a href="javascript:void(0)" class="btn btn-danger hot" data-id="{{$item->id}}">否</a>
			@else
			<a href="javascript:void(0)" class="btn btn-success hot" data-id="{{$item->id}}">是</a>
			@endif
		</th>
		<td>
			<a class="btn btn-primary btn-sm" href="/goods/detail?id={{$item->id}}">编辑货品</a>
		</td>
	</tr>
	@endforeach


</table>
<div class="pagination fr">
{{$goods->links()}}
</div>
@stop

@section('script')
<script type="text/javascript">
	$('.hot').click(function () {
		var goods_id = $(this).data('id');
		var send_data = {goods_id: goods_id, act: 'hot'};

		var txt= "确定改变推荐状态？";
		var option = {
			title: "修改商品",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('')
				$.post('/goods/goodsAttr', send_data, function (data) {
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

	$('.onsale').click(function () {
		var goods_id = $(this).data('id');
		var send_data = {goods_id: goods_id, act: 'onsale'};

		var txt= "确定改变上下架状态？";
		var option = {
			title: "修改商品",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('')
				$.post('/goods/goodsAttr', send_data, function (data) {
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

	$('.actived').click(function () {
		var goods_id = $(this).data('id');
		var send_data = {goods_id: goods_id, act: 'active'};

		var txt= "确定改变活动状态？";
		var option = {
			title: "修改商品",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('')
				$.post('/goods/goodsAttr', send_data, function (data) {
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