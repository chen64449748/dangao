//购物车结算按钮
$(document).on('click','.submit-btn',function(){
	//按钮有disabled 或者没有选中商品 不操作
	if( $(this).hasClass('disabled') || $('.gwc_tb2 input[name=newslist]:checked').length < 1){
		alert('请选择要结算的商品');
        return false;
	}
	$('#order_submit').addClass('disabled');
	//遍历购物车 获取选中的商品
	var goods_ids = '';
    $('input:checkbox[name=newslist]:checked').each(function(){
        goods_ids += goods_ids ? ',' +　$(this).attr('data-goods_id') : $(this).attr('data-goods_id');
    });
	$.ajax({
        type: "post",
        url:"/shopping/shoppingcart.php",
        data: {act:'selected',goods_ids:goods_ids},
        dataType: "json",
        async : false,
        success: function(data) {
            if (data.status) {
                $('#order_submit').removeClass('disabled').submit();
            }else{
                alert(data.info);
            }
        }
	});
});
//支付订单
$(document).on('click','#submit_order',function(){
	if( $(this).hasClass('disabled')){
		return false;
	}
	$('#order').addClass('disabled').submit();
});
//购物车数量减少按钮
$(document).on('click', '.shoppingcart_min', function(){
	$('.add').css({'color':'#757575','cursor':'pointer'});
	var index = $(this).attr('data-index'),
		v = $('#text_box'+index),
		next_t = parseInt(v.val()) - 1;
	if( next_t <= 0){
		deleteShopCart(index);
	}else{
		asyncChangeShoppingCartNumber('min',index, next_t);
		v.val( next_t);
        $('#goods_number-'+index).html(next_t);
        setTotal( index);
		GetCount();		
	}
});
//购物车数量增加按钮
$(document).on('click', '.shoppingcart_add', function(){
	$('.sub').css({'color':'#757575','cursor':'pointer'});
	var index = $(this).attr('data-index'),
		v = $('#text_box'+index),
		next_t = parseInt( v.val()) + 1,
		usable = parseInt( v.attr('data-usable')),
        quota = parseInt(v.attr('data-quota'));
    if (next_t > quota) {
//        alert('不能大于限购数量');
        $(this).css({'color':'#ddd','cursor':'no-drop'});
        asyncChangeShoppingCartNumber('modify',index, next_t);
        v.val(quota);
        $('#goods_number').html(quota);
        setTotal( index);
        GetCount();
        return false;
    }
	if( next_t >= usable){
		$(this).css({'color':'#ddd','cursor':'no-drop'});
	}else{
		$(this).css({'color':'#757575','cursor':'pointer'});
	}
	if( next_t > usable){
		alert('不能大于库存');
	}else{
		asyncChangeShoppingCartNumber('modify',index, next_t);
		v.val(next_t);
        $('#goods_number-'+index).html(next_t);
		setTotal( index);
		GetCount();
	}
});
//购物车input数量改变
$(document).on('change', '.number_box', function(){
	var index = $(this).attr('data-index'),
        v = $('#text_box'+index),
        usable = parseInt( v.attr('data-usable')),
        quota = parseInt(v.attr('data-quota')),
		t = $(this).val();
    if (t > quota) {

        $(this).css({'color':'#ddd','cursor':'no-drop'});
        asyncChangeShoppingCartNumber('modify',index, t);

        v.val(quota);
        $('#goods_number').html(quota);
        setTotal( index);
        GetCount();
        return false;
    }
    if( t > usable){
        alert('不能大于库存');
    }else{
        asyncChangeShoppingCartNumber('modify' ,index,t);
        $('#text_box'+index).val(t)
        $('#goods_number-'+index).html(t);
        valueControl($(this));
        setTotal( index);
        GetCount();
    }

});
//购物车inpu键盘输入
$(document).on('keyup', '.number_box', function(){
	valueControl($(this));
});

// 控制数值大小
function valueControl(_that){
	var usable = parseInt($(_that).attr('data-usable')),
        quota = parseInt($(_that).attr('data-quota')),
		t = $(_that).val();
	if( isNaN( t) || t <=0){
		t = 1;
		$(_that).val(1);
	}else if( t > usable){
        t = usable;
        if (isNaN( quota) || quota == '' ) {
            alert('不能大于库存');
            $(_that).val(usable);
        } else {
            alert('不能大于限购');
            $(_that).val(quota);

        }
		$(_that).siblings('.shoppingcart_add').css({'color':'#ddd','cursor':'no-drop'});
	}
}
// 购物车单个
$(document).on('click', '.gwc_tb2 input[name=newslist]',function(){
    var count = $('input:checkbox[name=newslist]:checked').size(),
        amount = $('#count').data('count');
    if ($(this).val() == 0 || !$(this).data('usable')) {
        return false;
    }
    if (count < amount) {
        $('.c-all').prop("checked", false);
    }
    if (count == amount) {
        $('.c-all').prop("checked", true);
    }
	if ($(this).is(':checked')) {
		$('.anniu03').removeClass('disabled');
	} else {
		if ($(".gwc_tb2 input[name=newslist]:checked").length == 0) {
			$('.anniu03').addClass('disabled');
		}
	}

	GetCount();
});
//购物车列表 删除商品
function deleteShopCart( index,url){
    confirm('你要删除该商品吗?',function(res){
        if(res){
            asyncChangeShoppingCartNumber('delete',index);
            $('#newslist-'+index).parents('table').remove();
            GetCount();
            checkShopCart();
        }
    })
}
//异步商品数量
function asyncChangeShoppingCartNumber( act,index,number){

	var sku = $('#newslist-'+index),
		goods_id = sku.attr('data-goods_id'),
		shoppingcart_id =  sku.attr('data-shoppingcart_id'),
		parameter = {act : 'change_shoppingcart_info', change:act, goods_id : goods_id, shoppingcartid : shoppingcart_id};
	
	if( act != 'delete'){
		parameter['number'] = number;
	}
	$.ajax({
        type: "post",
        url:"/shopping/shoppingcart.php",
        data: parameter,
        dataType: "json",
        success: function(data) {
    	   	if( parseInt(data.status) == 200){
    	   		
           	} else {
                alert(data.info);
            }
        }
	});
}
//  计算所有产品价格
function GetCount() {
	var conts = 0;
	var aa = 0; //已选商品
	$(".gwc_tb2 input[name=newslist]").each(function() {
		if ($(this).is(":checked")) {
			for ( var i = 0; i < $(this).length; i++) {
				conts = accAdd(conts, $(this).val());
				aa += 1;
			}
		}
	});
	if( aa === 0){
		$('.submit-btn').addClass('disabled');
        $('#del').addClass('disabled');
	}else{
		$('.submit-btn').removeClass('disabled');
		$('#del').removeClass('disabled');
	}
	$("#zong1").html(conts.toFixed(2));
}
// 计算单商品价格
function setTotal( index) {
	if(index == undefined){
		$.each( $('.number_box'),function(index, item){
			setTotal($(item).attr('data-index'));
		});
	}else{
		//$("#total1").html((parseInt(t.val()) * 10).toFixed(2)); //显示单个产品价格
		var sku_total = $("#newslist-"+index),
			t = parseInt( $('#text_box'+index).val());
		sku_total.val( accMul(t, sku_total.attr('data-sale_price')));
	}
}
//js算法有漏洞  乘法函数
function accMul(arg1,arg2){
	var m=0,s1=arg1.toString(),s2=arg2.toString(); 
	try{m+=s1.split(".")[1].length}catch(e){} 
	try{m+=s2.split(".")[1].length}catch(e){} 
	return Number(s1.replace(".",""))*Number(s2.replace(".",""))/Math.pow(10,m) 
}
//加法函数
function accAdd(arg1,arg2){   
	  var r1,r2,m;   
	  try{r1=arg1.toString().split(".")[1].length}catch(e){r1=0}   
	  try{r2=arg2.toString().split(".")[1].length}catch(e){r2=0}   
	  m=Math.pow(10,Math.max(r1,r2))   
	  return (arg1*m+arg2*m)/m
}
//检查购物车
function checkShopCart(){
    if($('.gwc_tb2 input[name=newslist]').length < 1){
        str = '<div class="align_center">'+'<img src="http://bnmpstyle.bookuu.cn/wap/images/icon/dingdan3.png" alt="" height="48" style="margin: 50px 0 10px 0;">'
            +'<div class="color_gray font_size02">您的购物车为空</div>'+'<a href="/index.php" class="anniu03 margintop10 marginbottom10 jz" style="background-color: #e7526f;">去逛逛</a></div>'
        $('.gwc').prepend(str);
        $('#base').hide();
        $('#del').hide();
    }
}