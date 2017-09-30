
function sku_select_close()
{
    $('#goods_sku').animate({bottom: '-558px'}, 350);
    $('#sku_select').animate({opacity: '0'}, 400, function () {
    	$(this).css('display', 'none');
    });
}

function sku_select_show(goods_id, callback)
{

    $.get('/cart/getSkuSelect', {goods_id: goods_id}, function (data) {

        // var data = JSON.parse(data);

        if (data.status != 1) {
            return alert(data.message);
        }

        $('#goods_sku').css('bottom', '0px');
        $('#sku_select').css('opacity', '0.38');
        $('#sku_select').css('display', 'block');

        $('.sku_close').off('click');
        $('.sku_close').on('click', sku_select_close);

        var goods = data.data['goods'];

        $('.select_goods_img').find('img').attr('src', goods.goods_img);
        $('#sku_select_price').text(goods.show_price);

        var sku = data.data['sku_prices']['sku'];
        var select_config = data.data['sku_prices']['select_config'];
        var price_list = data.data['sku_prices']['price_list'];

        var price_list_json = JSON.stringify(price_list);

        // sku选择框
        var sku_list = $('.sku_list');
        sku_list.attr('price_list', price_list_json);
        sku_list.html('');
        for (var i in sku) {
            // 一个种类sku 一个 li
            var li = $('<li></li>');

            var sku_name_div = $('<div class="select_sku_name"></div>'); // sku name在下个循环中
            var sku_name = '';
            
            var items_div = $('<div class="items"></div>');
            for (var j in sku[i]) {
                sku_name = sku[i][j]['sku']['sku_name'];
                var a = $('<a  href="javascript:void(0)" select_config="'+ select_config[sku[i][j]['sku_value']['id']] +'" sku_value_id="'+ sku[i][j]['sku_value']['id'] +'" data-value="'+ sku[i][j]['sku']['id'] + '_' + sku[i][j]['sku_value']['id'] +'" class="sku_check">'+ sku[i][j]['sku_value']['value'] +'</a>');
                
                items_div.attr('sku_id', sku[i][j]['sku']['id']);
                items_div.append(a);

            };

            sku_name_div.text(sku_name);

            li.append(sku_name_div);
            li.append(items_div);

            sku_list.append(li);
        };


        $('.sku_submit').off('click');
        $('.sku_submit').on('click', function() {

            var submit_flag = 1;
            var submit_sku_value_ids = [];
            $('.sku_list').find('.items').each(function () {
                var checked_count = $(this).find('.checked').size();
                if (checked_count == 0) {
                    submit_flag = 0;
                }

                submit_sku_value_ids.push($(this).find('.checked').attr('sku_value_id'));
            });

            if (submit_flag == 0) {
                return alert('每项规格必选');
            }
            sku_select_close();
            callback(submit_sku_value_ids);

        });

    });

}

$('#goods_sku').on('click', '.items .sku_check', function () {
    $(this).parent('.items').find('.sku_check').removeClass('checked');
    $(this).addClass('checked');

    var sku_id = $(this).parent('.items').attr('sku_id');
    var sku_value = $(this).attr('select_config');
    var sku_value_ids = sku_value.split(',');
    var price_list = JSON.parse($('.sku_list').attr('price_list'));
    // 计算价格
    var flag_price = 1; // 计算 价格标识
    var price_key = '';

    $('.sku_list').find('.items').each(function () {

        var s = $(this).find('.checked').size();
        if (s == 0) {
            flag_price = 0;
        }
        price_key += '_' + $(this).find('.checked').data('value');

        if ($(this).attr('sku_id') == sku_id) {
            return;
        }
        // 重置所有
        $(this).find('a').removeClass('.sku_disable');
        $(this).find('a').addClass('.sku_check');

        $(this).find('a').each(function () {

            if ($.inArray($(this).attr('sku_value_id'), sku_value_ids) == -1) {
                $(this).removeClass('sku_check');
                $(this).removeClass('checked');
                $(this).addClass('sku_disable');
            } else {
                $(this).removeClass('sku_disable');
                $(this).addClass('sku_check');
            }

        });
    });

    price_key = price_key.substr(1, (price_key.length - 1));
    
    var price = price_list[price_key];

    if (flag_price) {
        $('#sku_select_price').text(price);
    }
})