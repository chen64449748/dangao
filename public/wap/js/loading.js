function loading(selector, url, send_data, callback)
{
	$(document).scroll(function () {
		loading_f(selector, url, send_data, callback)
	});
}


function loading_f(selector, url, send_data, callback) {
	var offset = $(document).height() - $(document).scrollTop();	
	var _top = offset - $(window).height();
	if (_top > 60) {return;}

	$(document).off('scroll');
	var loading_img = '<div style="width: 60px; margin: 0 auto; padding-bottom: 60px;">\
			<img src="/wap/images/loading.gif" alt="">\
		</div>';

	var page = $('#page_hide').val();
	if (!page) {
		return alert('请添加hidden#page_hide');
	}

	$(selector).html(loading_img);

	send_data.page = page;
	$.get(url, send_data, function (data) {
		$(selector).html('');
		callback(data);
		if (data.status != 400) {
			$(document).scroll(function () {
				loading_f(selector, url, send_data, callback);
			});
		}
		

	});

}