@extends('/admin/template')

@section('content')
<div class="page-head">
    <h2>分类管理</h2>
    <ol class="breadcrumb">
 
        <li><a href="#">分类</a></li>
        <li class="active">列表</li>
    </ol>
</div>

<div class="row page-head">
	<div class="fr">
		<a class="btn btn-primary addc" data-toggle="modal" data-target="#categoryModal">添加分类</a>
	</div>
</div>

<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>分类</th>
        <th>操作</th>
    </tr>
    
    @foreach ($categorys as $category)
    <tr>
        <td>{{$category->id}}</td>
        <td>{{$category->category}}</td>
        <td>
            <a class="btn btn-info btn-sm update" data-toggle="modal" data-target="#categoryModal" category="{{$category->category}}"  category_id="{{$category->id}}" href="javascript:;">修改</a>
            <a class="btn btn-danger btn-sm remove" category_id="{{$category->id}}" href="javascript:;">删除</a>
        </td>
    </tr>
    @endforeach
</table>

<!-- Modal -->
<div id="categoryModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="categoryModalLabel" aria-hidden="true">
	<input type="hidden" id="sku_id" value="">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="categoryTitle"></h3>
	</div>
	<div class="modal-body form-horizontal">
		<input type="hidden" id="category_id">
		<input type="hidden" id="act">
		<div class="control-group">
    		<label class="control-label" id="category_label" for="c_item">分类</label>
    		<div class="controls">
    			<input type="text" id="category" placeholder="填写分类">
    		</div>
  		</div>

	</div>
	<div class="modal-footer">
		<button class="btn cls" data-dismiss="modal" aria-hidden="true">关闭</button>
		<button class="btn btn-primary save">保存</button>
	</div>
</div>
@stop

@section('script')
<script type="text/javascript">
	$('.update').click(function () {
		var category_id = $(this).attr('category_id');
		var category = $(this).attr('category');
		$('#category_id').val(category_id);
		$('#categoryTitle').text('修改分类');
		$('#category').val(category);
		$('#act').val('update');
	});

	$('.addc').click(function() {
		$('#categoryTitle').text('添加分类');
		$('#category_id').val('');
		$('#category').val('');
		$('#act').val('add');
	});

	$('.save').click(function () {
		var act = $('#act').val();
		var category_id = $('#category_id').val();
		var category = $('#category').val();

		if (act == 'update') {
			if (category == '' || category_id =='') {
				return window.wxc.xcConfirm('请填写分类', window.wxc.xcConfirm.typeEnum.info);
			}
		} else if (act == 'add') {
			if (category == '') {
				return window.wxc.xcConfirm('请填写分类', window.wxc.xcConfirm.typeEnum.info);
			}
		}
		
		var alert_name = '';
		if (act == 'update') {
			alert_name = '修改';
		} else if (act == 'add') {
			alert_name = '添加';
		}

		var send_data = {category_id: category_id, category: category, act: act};
		var txt= "确定" + alert_name + '?';
		var option = {
			title: alert_name,
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('');
				$.post('/category/save', send_data, function (data) {
					LayerHide();
					if (data.status == 1) {
						window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
						setTimeout(function () {
							window.location.href = '/category/list';
						}, 800);
					} else {
						return window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
					}

				})
			}
		}

		window.wxc.xcConfirm(txt, "custom", option);

	});

	
	$('.remove').click(function () {
		var category_id = $(this).attr('category_id');
		var btn = $(this);

		var send_data = {category_id: category_id, act: 'delete'};
		var txt= "确定删除";
		var option = {
			title: '删除分类',
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('');
				$.post('/category/save', send_data, function (data) {
					LayerHide();
					if (data.status == 1) {
						window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
						btn.parents('tr').remove();
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