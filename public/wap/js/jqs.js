/* 
 * @Author: zeng
 * @Date:   2016-03-03
 * @Last Modified by:
 * @Last Modified time:
 */

$(document).ready(function(){
    var temp, w ,h, h2;
    // var fixWidth;
    /* 公用 */
    $('.div_buding, .box-block, .img-block').show();
    $('.imgbuding img').css('margin-top', '-4px');
    $('.layer, .shares').click(function () {
        $('.youhuiquan').hide();
        $('.shares').hide();
        $('.layer').hide();
        $('.products').hide();
        $('body').css('overflow','auto');
        $('.fenlei_div').hide(0);
        $('.shaixuan_div').hide(0);
    })
    $("input").keyup(function () {
        if($(this).val().length==0){
            $("a[class*=anniu0]").css('background-color', '#c9c9c9').attr('disabled',true);
        }else{
            $("a[class*=anniu0]").css('background-color', '#2ab4e8').attr('disabled',false);
        }
        $('.xieyi').show();
        $('.tishi').hide();
    })
    $("textarea").keyup(function () {
        if($(this).val().length==0){
            $("a[class*=anniu0]").css('background-color', '#c9c9c9').attr('disabled',true);
        }else{
            $("a[class*=anniu0]").css('background-color', '#2ab4e8').attr('disabled',false);
        }
    })
    $('.a01').click(function(){
        $(this).addClass('color_blue');
        $(this).parent().siblings().find('a').removeClass('color_blue');
    })

    // 图片
    $('.div_buding').height(function () {
        return $(this).width();
    });
    $('.div_buding').each(function(){
        tmp_w=$(this).find('img').width();
        tmp_h=$(this).find('img').height();
       if(tmp_w<tmp_h){
            $(this).find('img').height(function () {
                return $(this).parent().parent().width();
            });
            $(this).find('img').width(function () {
                return "auto";
            });
        }
        // 解决网速慢图片高度计算出错，判断图片加载的函数
        if($(this).find('img').height() != 0){
            if(tmp_w>tmp_h){
                tmp_x=(tmp_w-tmp_h)/2;
                $(this).find('img').css('margin-top',tmp_x);
            }
        }
    })

    // 图片
    $(window).on('resize load scroll',function(){
        $('.div_buding, .box-block, .img-block').show();
        var tmp_w,tmp_h,tmp_x;
        $('.div_buding').height(function () {
            return $(this).width();
        });
        $('.div_buding').each(function(){
            tmp_w=$(this).find('img').width();
            tmp_h=$(this).find('img').height();
           if(tmp_w<tmp_h){
                $(this).find('img').height(function () {
                    return $(this).parent().parent().width();
                });
                $(this).find('img').width(function () {
                    return "auto";
                });
            }
            // 解决网速慢图片高度计算出错，判断图片加载的函数
            if($(this).find('img').height() != 0){
                if(tmp_w>tmp_h){
                    tmp_x=(tmp_w-tmp_h)/2;
                    $(this).find('img').css('margin-top',tmp_x);
                }
            }
        })

    })

    /* search */
    $('.searches2 input').keyup(function () {
        if($(this).val().length==0){
            $(this).siblings('img').attr('src', stylehost + '/wap/images/icon/search2.png');
            $(this).parent().css('border', '1px #c9c9c9 solid');
        }else{
            $(this).siblings('img').attr('src', stylehost + '/wap/images/icon/search.png');
            $(this).parent().css('border', '1px #2ab4e8 solid');
        }
    })
    /* menu */
    $(".menu a").eq(0).addClass('menu_shouye');
    $(".menu a").eq(1).addClass('menu_qianggou');
    $(".menu a").eq(2).addClass('menu_fenlei');
    $(".menu a").eq(3).addClass('menu_gouwu');
    $(".menu a").eq(4).addClass('menu_geren');
    /* gouwu */
    $('.choose').click(function () {
        $(this).toggleClass('choose2');
    })
    /* youhuiquan */
    $('.youhui').click(function () {
        $('.youhuiquan').show();
        $('.layer').show();
    })
    $('.youhuiquan li').click(function () {
        $(this).addClass('choose2');
        $(this).siblings().removeClass('choose2');
        $('.youhuiquan').delay(300).fadeOut(0);
        $('.layer').delay(300).fadeOut(0);
        $('.youhuixinxi').show();
    })
    /* youhuiquan2 */
    $('.youhuiquan2 li').click(function () {
        $(this).addClass('choose2');
        $(this).siblings().not('.zk_yc').removeClass('choose2');
    })
    /* home */
    $('.share').click(function () {
        $('.shares').show();
        $('.layer').show();
        $('.shaixuan_div').hide();
        $('.fenlei_div').hide();
        $('body').css('overflow-y','hidden');
        var ua = window.navigator.userAgent.toLowerCase();
        if(ua.match(/MicroMessenger/i) == 'micromessenger'){
            $('.shares img').attr('src', stylehost + '/wap/images/share.png');
        }else if(ua.match(/qq/i) == 'qq'){
            $('.shares img').attr('src', stylehost + '/wap/images/share3.png');
        }else{
            $('.shares img').attr('src', stylehost + '/wap/images/share2.png');
        }
    });
    $(window).on('scroll',function(){
        if($(window).scrollTop>10){
            $('.totop').show();
        }else{
            $('.totop').hide();
        }
    })
    $(".totop").click(function() {
        $(document).scrollTop(0);
    })
    /* productdetail */
    $('.zk_yc').click(function () {
        if ($(this).siblings('.txt').css('display') == 'none') {
            $(this).find('img').attr('src', stylehost + '/wap/images/icon/arrow.png');
            $('.txt .biaoqian, .txt .intro').show();
            $('.biaoqians').hide();
        } else {
            $(this).find('img').attr('src', stylehost + '/wap/images/icon/arrow03.png');
            $('.txt .biaoqian, .txt .intro').hide();
            $('.biaoqians').show();
        }
        $(this).siblings('.txt').slideToggle();
    })
    $('.products_a a').click(function () {
        $(this).addClass('products_a03');
        $(this).siblings().removeClass('products_a03');
    })
    /* eye */
    $('.eye').click(function () {
        if ($(this).attr('src') == stylehost + '/wap/images/icon/eye.png') {
            $(this).attr('src', stylehost + '/wap/images/icon/eye2.png');
            $(this).siblings('input').attr('type', 'password');
        } else {
            $(this).attr('src', stylehost + '/wap/images/icon/eye.png');
            $(this).siblings('input').attr('type', 'text');
        }
    })
    $('.anniu07').click(function () {
        if ($('.text').val() == 1) {
            $('.sub').css({'color': '#ddd', 'cursor': 'no-drop'});
        }
        // if ($('.text').val() == 'usable') {
        //     $('.add').css({'color': '#ddd', 'cursor': 'no-drop'});
        // }
    })
    /* zhifu */
    $('.zhifu_list').click(function () {
        $(this).find('.choose3').addClass('choose2');
        $(this).siblings().find('.choose3').removeClass('choose2');
    })
});


// 更新不可选选项UI  lx  加入购物车商品分类
function updateChooseUI(skuDetailId) {
    var skuDetailId = skuDetailId ? skuDetailId :
        $('.products_a01.lf.products_a03:first').attr('data-sku_detail_id') ?
            $('.products_a01.lf.products_a03:first').attr('data-sku_detail_id') :
            $('.products_a01.lf:first').attr('data-sku_detail_id');
    var skuDetailCanChoose = getCanChooseDetailId(getFirstSkuDetailId(skuDetailId));

    //遍历bunch的sku_detail_id 列表
    $.each(bunch, function (index_bunch, bunch_item) {
        //将bunch_list数据切割成数组
        bunch_list = bunch_item.bunch.split("_");
        //判断选择的选项 是否有 下一级
        if (in_array(skuDetailId, bunch_list)) {
            // 仅显示一级选项
            $('.sku_item:gt(0)').addClass('display_none');
            // 如果有则 显示当前'一级目录下的'多级选项
            for (var i = 1; i < bunch_list.length; i++) {
                $('.sku_item').eq(i).removeClass('display_none');
            }
        }
    });

    // 遍历每个选项 如果 '在skuDetailCanChoose列表' 则 移除  待选class  '否则' 移除 选中class 添加 待选class
    $.each($('.products_a01.lf'), function (index, sku_detail) {
        allSkuDetailIdItem = $(sku_detail).attr('data-sku_detail_id');
        if (in_array(allSkuDetailIdItem, skuDetailCanChoose)) {
            $('#sku_detail_' + allSkuDetailIdItem).removeClass('products_a04');
        } else {
            $('#sku_detail_' + allSkuDetailIdItem).addClass('products_a04').removeClass('products_a03');
        }
    });

    // 选择项 是第一项 且 没有子类可选
    if (getFirstSkuDetailId(skuDetailId) == skuDetailId && getCanChooseDetailId(skuDetailId).length == 1) {
        $('#sku_detail_' + skuDetailId).siblings().removeClass('products_a04');
    }
}
//遍历 '选中的' sku_detail_id 推入到  sku_detail_choosed_list
function getChooesedList() {
    var sku_detail_choosed_list = [];  // 所有选中 sku_detail_id
    $.each($('.products_a01.lf.products_a03'), function (index, item) {
        sku_detail_choosed_list.push($(item).attr('data-sku_detail_id'));
    });
    return sku_detail_choosed_list;
}

//根据 所有选择的 sku_detail_id 读取商品id
function getGoodsId(detailIdChoosedList) {

    var goods_id = false;
    var arr= new Array();
    $.each(bunch, function (index_bunch, bunch_item) {
        arr =  arr.concat(String(bunch_item['bunch']).split("_"));
        if (arr.length == detailIdChoosedList.length) {
            $.each(detailIdChoosedList, function (n, value) {
                if ( $.inArray(value, arr) ==-1) {
                    goods_id = false;
                    return false;
                } else {
                    goods_id = bunch_item.goods_id;
                }
            });
        }
        if (goods_id) {
            return false;
        }
    });
    return goods_id;
}

// 获取当前选项的一级目录
function getFirstSkuDetailId(sku_detail_id) {
    var first_sku_detail_id = 0;
    $.each(bunch, function (index_bunch, bunch_item) {
        //将_数据切割成数组
        bunch_list = bunch_item.bunch.split("_");
        if (in_array(sku_detail_id, bunch_list)) {
            first_sku_detail_id = bunch_list[0];
            return false;
        }
    });
    return first_sku_detail_id;
}

// 根据一级目录遍历出所有可选项
function getCanChooseDetailId(first_sku_detail_id) {
    var canChooseList = [];
    $.each(bunch, function (index_bunch, bunch_item) {
        //将_数据切割成数组
        bunch_list = bunch_item.bunch.split("_");
        if (in_array(first_sku_detail_id, bunch_list)) {
            $.merge(canChooseList, bunch_list);
        }
    });
    return $.unique(canChooseList);
}

//判断在数组中是否已经存在
function in_array($item, $array) {
    $result = false;
    $.each($array, function (index, t_item) {
        if (t_item == $item) {
            $result = true;
        }
    });
    return $result;
}

//遍历 '选中的' sku_detail_id 推入到  sku_detail_choosed_list
function getChooesedList() {
    var sku_detail_choosed_list = [];  // 所有选中 sku_detail_id
    $.each($('.products_a01.lf.products_a03'), function (index, item) {
        sku_detail_choosed_list.push($(item).attr('data-sku_detail_id'));
    });
    return sku_detail_choosed_list;
}

//根据 所有选择的 sku_detail_id 读取商品id
//function getGoodsId(detailIdChoosedList) {
//    var list_str = detailIdChoosedList.join('_');
//    var goods_id = false;
//    $.each(bunch, function (index_bunch, bunch_item) {
//        if (bunch_item['bunch'] === list_str) {
//            goods_id = bunch_item.goods_id;
//            return false;
//        }
//    });
//    return goods_id;
//}

// 获取当前选项的一级目录
function getFirstSkuDetailId(sku_detail_id) {
    var first_sku_detail_id = 0;
    $.each(bunch, function (index_bunch, bunch_item) {
        //将_数据切割成数组
        bunch_list = bunch_item.bunch.split("_");
        if (in_array(sku_detail_id, bunch_list)) {
            first_sku_detail_id = bunch_list[0];
            return false;
        }
    });
    return first_sku_detail_id;
}

// 根据一级目录遍历出所有可选项
function getCanChooseDetailId(first_sku_detail_id) {
    var canChooseList = [];
    $.each(bunch, function (index_bunch, bunch_item) {
        //将_数据切割成数组
        bunch_list = bunch_item.bunch.split("_");
        if (in_array(first_sku_detail_id, bunch_list)) {
            $.merge(canChooseList, bunch_list);
        }
    });
    return $.unique(canChooseList);
}

//初始化skuDetail选择项
function initDefaultSelect() {
    var sku_detail_arr = false;
    $.each(bunch, function (index, item) {
        if (item.goods_id == goods_id) {
            sku_detail_arr = item.bunch.split("_");
            return false;
        }
    });
    $.each(sku_detail_arr, function (index, sku_detail_id) {
        $("#sku_detail_" + sku_detail_id).addClass('products_a03');
    });
}

//判断在数组中是否已经存在
function in_array($item, $array) {
    $result = false;
    $.each($array, function (index, t_item) {
        if (t_item == $item) {
            $result = true;
        }
    });
    return $result;
}

/**
 * 页面弹出框
 * @param msg
 */
function alert(msg, callback) {
    var w_h = $(window).height();
    $("#alert-msg-info").remove();
    var div = '<div id="alert-msg-info" style="width: 100%;max-width: 640px;height: 100%;opacity:0.8;position: fixed;text-align: center;z-index: 20000;top:0;padding-top: ' + (w_h - 20) / 2 + 'px">' +
        '<a style="padding: 10px;background-color:#000000;color: #fff;border-radius: 5px;font-size: 14px;">' + msg + '</a></div>';
    $('body').append(div);
    t = setTimeout(function () {
        $("#alert-msg-info").fadeOut(1000);
        if (typeof callback == 'function' || (typeof eval(callback) == 'function')) {
            if (typeof callback == 'function') {
                call_use_func = callback;
            } else {
                call_use_func = eval(callback);
            }
            call_use_func()
        }
    }, 1000);
    $("#alert-msg-info").click(function () {
        $("#alert-msg-info").fadeOut(1000);
        clearTimeout(t);
        if (typeof callback == 'function' || (typeof eval(callback) == 'function')) {
            if (typeof callback == 'function') {
                call_use_func = callback;
            } else {
                call_use_func = eval(callback);
            }
            call_use_func()
        }
    });

}
/**
 * 页面确认框
 * @param msg
 * @param callback
 */
function confirm(msg, callback) {
    var w_h = $(window).height();
    pad = (w_h - 100) / 2;
    $("#alert-msg-info,#alert-msg-info-shadow").remove();
    var div = '<div id="alert-msg-info-shadow" style="width: 100%;max-width: 640px;height: 100%;position: fixed;background-color:#000000;opacity:0.38;text-align: center;z-index: 9998;top:0;"></div>';
    div += '<div id="alert-msg-info" style="width: 100%;height: 100%;max-width: 640px;position: fixed;z-index: 9999;top:0;padding-top: ' + pad + 'px">' +
        '<div style="width: 70%;margin:0 auto;height: auto;padding:20px;background-color:#FFFFFF;display: block;box-shadow: 0 2px 8px rgba(0, 0, 0, .24);"><div>' +
        '<a style="font-size: 16px;font-family: \'Microsoft YaHei\';">' + msg + '</a></div>' +
        '<div style="margin-top: 12px;text-align: right;font-size: 15px;">' +
        '<a id="confirm-cancel" style="height: 30px;padding: 8px;border-radius: 4px;color:#2AB4EB; ">取消</a>' +
        '<a id="confirm-ok" style="height: 30px;padding: 8px;margin-left: 20px;border-radius: 4px;color:#2AB4EB;">确定</a></div>' +
        '</div></div>';
    $('body').append(div);

    $("#confirm-cancel,#confirm-ok").click(function () {
        $(this).css('background-color', '#eeeeee').unbind('click');
        $("#alert-msg-info,#alert-msg-info-shadow").fadeOut(500);
        if ($(this).attr('id') == 'confirm-ok') {
            confirm_re = true;
        } else {
            confirm_re = false;
        }
        if (typeof callback == 'function' || (typeof eval(callback) == 'function')) {
            if (typeof callback == 'function') {
                call_use_func = callback;
            } else {
                call_use_func = eval(callback);
            }
            call_use_func(confirm_re)
        }
    });
}



//弹框提醒
function remind(content, title) {
    $.gDialog.alert(content, {
        title: title,
        animateIn: "bounceIn",
        animateOut: "bounceOut"
    });
}

