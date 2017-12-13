@extends('admin.template')

@section('content')
<link href="/js/umeditor1.2.3/themes/default/css/umeditor.css" type="text/css" rel="stylesheet">
<div class="page-head">
 	<h2>文章</h2>
 	<ol class="breadcrumb">
 
    	<li><a href="#">文章</a></li>
    	@if ($act == 'add')
    	<li class="active">添加文章</li>
  		@else 
  		<li class="active">文章详情</li>
  		@endif
  	</ol>
</div>

<form class="form-horizontal" id="news_order">
 	
 	<div class="" style="width: 1200px; margin-bottom: 40px;">
			
		<div class="control-group">
			<label class="control-label order_num" style="font-size: 20px;">
				@if ($act == 'add') 添加文章 @else 编辑文章 @endif
			</label>
			<div class="controls">
				
			</div>
		</div>

		
		<div class="control-group">
			<label class="control-label">音乐上传</label>
			<div class="controls">
				<form class="upload_from" enctype="multipart/form-data">
					<input type="file" name="mic" class="file_upload">
					<input type="button" value="上传" class="btn btn-info u_btn">
				</form>
			</div>
			<span id='mic_url'>{{$news->bg_mic}}</span>
		</div>

		<!-- 富文本编辑 -->
		<div class="control-group">
			<label class="control-label">详情编辑</label>
			<div class="controls">
				<script type="text/plain" id="myEditor" style="width: 640px;height:480px;">{{$news->content}}</script>
			</div>
		</div>
		

		<div class="control-group">
			<label class="control-label" for=""></label>
			<div class="controls">
				<input type="button" class="news_add  btn btn-primary" data-id="{{$news->id}}" data-act="{{$act}}" value="保存文章">
				<a type="button" class="btn btn-info" href="javascript:history.back(-1);" >取消</a>
			</div>
		</div>
	</div>

</form>
@stop

@section('script')
<script type="text/javascript" src="/js/umeditor1.2.3/third-party/template.min.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/umeditor1.2.3/umeditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="/js/umeditor1.2.3/umeditor.min.js"></script>
<script type="text/javascript" src="/js/umeditor1.2.3/lang/zh-cn/zh-cn.js"></script>
<script>
	var um = UM.getEditor('myEditor');
	$('.u_btn').click(function () {
		var file = $('.file_upload');
		var mic = $('#mic_url');
		
		uploadMic(file[0].files[0], 'mic', function (status, data) {
			if (status == 200) {
				var data = JSON.parse(data);
				if (data.status == 1) {
					//修改图片
					mic.html(data.url);
					file.val('');
				} else {
					return window.wxc.xcConfirm('上传失败' + data.message, window.wxc.xcConfirm.typeEnum.error);
				}
			} else {
				return window.wxc.xcConfirm('请求失败'+ status, window.wxc.xcConfirm.typeEnum.error);
			}
		});

	});
	
	$('.news_add').click(function () {

		var mic_url = $('#mic_url').text(),
			content = um.getContent();
		var act = $(this).data('act');

		if (!content) {
			return window.wxc.xcConfirm('文章必须填写', window.wxc.xcConfirm.typeEnum.info);
		}
		var id = $(this).data('id');
		var  send_data = {
			content: content,
			mic_url: mic_url,
			act : act,
		};

		if (act == 'update') {
			send_data.id = id;
		}

		var txt= "确定保存文章？";
		var option = {
			title: "保存文章",
			btn: parseInt("0011",2),
			onOk: function(){
				LayerShow('')
				$.post('/news/save', send_data, function (data) {
					LayerHide();
					if (data.status == 1) {
						window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
						setTimeout(function () {
							window.location.href = '/news/list';
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