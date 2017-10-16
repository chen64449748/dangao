// 判断数组是否相等
// Warn if overriding existing method
if(Array.prototype.equals)
    console.warn("Overriding existing Array.prototype.equals. Possible causes: New API defines the method, there's a framework conflict or you've got double inclusions in your code.");
// attach the .equals method to Array's prototype to call it on any array
Array.prototype.equals = function (array) {
    // if the other array is a falsy value, return
    if (!array)
        return false;

    // compare lengths - can save a lot of time 
    if (this.length != array.length)
        return false;

    for (var i = 0, l = this.length; i < l; i++) {
        // Check if we have nested arrays
        if (this[i] instanceof Array && array[i] instanceof Array) {
            // recurse into the nested arrays
            if (!this[i].equals(array[i]))
                return false;       
        }           
        else if (this[i] != array[i]) { 
            // Warning - two different object instances will never be equal: {x:20} != {x:20}
            return false;   
        }           
    }       
    return true;
}
// Hide method from for-in loops
Object.defineProperty(Array.prototype, "equals", {enumerable: false});

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

        $('.shoppingcart_min').css('color', 'rgb(221, 221, 221)');
        $('.number_box').val(1);

        $('.sku_close').off('click');
        $('.sku_close').on('click', sku_select_close);

        var goods = data.data['goods'];

        $('.select_goods_img').find('img').attr('src', goods.goods_img);
        $('#sku_select_price').text(goods.show_price);

        var sku = data.data['sku_prices']['sku'];
        var select_config = data.data['sku_prices']['cont_select'];
        var price_list = data.data['sku_prices']['price_list'];

        var price_list_json = JSON.stringify(price_list);
        var select_config_json = JSON.stringify(select_config);
        // sku选择框
        var sku_list = $('.sku_list');
        sku_list.attr('price_list', price_list_json);
        sku_list.attr('select_config', select_config_json);
        sku_list.html('');
        for (var i in sku) {
            // 一个种类sku 一个 li
            var li = $('<li></li>');

            var sku_name_div = $('<div class="select_sku_name"></div>'); // sku name在下个循环中
            var sku_name = '';
            
            var items_div = $('<div class="items"></div>');
            for (var j in sku[i]) {
                sku_name = sku[i][j]['sku']['sku_name'];
                var a = $('<a  href="javascript:void(0)" sku_value_id="'+ sku[i][j]['sku_value']['id'] +'" data-value="'+ sku[i][j]['sku']['id'] + '_' + sku[i][j]['sku_value']['id'] +'" class="sku_check">'+ sku[i][j]['sku_value']['value'] +'</a>');
                
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

                submit_sku_value_ids.push(Number($(this).find('.checked').attr('sku_value_id')));
            });

            if (submit_flag == 0) {
                return alert('每项规格必选');
            }

            var count = $('.number_box').val();
            sku_select_close();
            callback(submit_sku_value_ids, count);

        });

    });

}

$('#goods_sku').on('click', '.items .sku_check', function () {
    $(this).parent('.items').find('.sku_check').removeClass('checked');
    $(this).addClass('checked');

    var sku_id = $(this).parent('.items').attr('sku_id');
    var sku_value_id = $(this).attr('sku_value_id');
    var price_list = JSON.parse($('.sku_list').attr('price_list'));
    var select_config = JSON.parse($('.sku_list').attr('select_config')); // 不可选配置
    // 计算价格
    var flag_price = 1; // 计算 价格标识
    var price_key = '';

    var can_select = []; // 可选组合

    var selected = []; // 已经选
    $('.sku_list').find('.items').each(function () {
        price_key += '_' + $(this).find('.checked').data('value');
        // 重置除去选中所有
        $(this).find('a').removeClass('sku_disable');
        $(this).find('a').addClass('sku_check');
        $(this).find('a.checked').addClass('sku_check');
    });

    $('.sku_list').find('.items').find('a').each(function () {
        if ($(this).hasClass('checked')) {
            selected.push($(this).attr('sku_value_id'));
        }
    });

    // 要选最后个配置时
    if (select_config.length > 0) {

        if (selected.length >= 2 && selected.length == select_config[0].length) {
            selected.splice(selected.length - 2, 1);
        }

        // 做不可选配置
        for (var i in select_config) {
            var flag = 1; // 假设在里面
            for (var j in selected) {
                var index = $.inArray(Number(selected[j]), select_config[i]);
              
                if (index == -1) {
                    // 如果存在一个不在那就 
                    flag = 0;
                }   
            }

            if (flag) {
                for (var l in selected) {
                    var del_index = $.inArray(Number(selected[l]), select_config[i]);
                    select_config[i].splice(del_index, 1);
                }

                $('.sku_list').find('.items').find('a[sku_value_id='+ select_config[i][0] +']').addClass('sku_disable');
                $('.sku_list').find('.items').find('a[sku_value_id='+ select_config[i][0] +']').removeClass('sku_check');
                $('.sku_list').find('.items').find('a[sku_value_id='+ select_config[i][0] +']').removeClass('checked');
            }
        }
    }

    // if (select_config.length > 0 && selected.length == select_config[0].length) {
        
        

    //     for (var i in select_config) {
    //         if (selected.equals(select_config[i])) {
    //             alert('没有该规格组合');
    //             $('.sku_list').find('.items').find('a').removeClass('checked');
    //             $('.sku_list').find('.items').find('a').removeClass('sku_disable');
    //             $('.sku_list').find('.items').find('a').addClass('sku_check');
    //         }
    //     }
    // }

    

    price_key = price_key.substr(1, (price_key.length - 1));
    
    var price = price_list[price_key];

    if (flag_price) {
        $('#sku_select_price').text(price);
    }
})