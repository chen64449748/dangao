<style type="text/css">
    #goods_sku { width: 100%; max-width: 640px; height: 530px; background: white; position: fixed; bottom: -558px; z-index: 10000; }
    #goods_sku .sku_submit { background: #e7526f; position: absolute; bottom: 0; max-width: 640px; width: 100%;}
    #goods_sku .sku_header {height: 90px;}

    #goods_sku .select_goods_img {
        width: 100px;
        height: 100px;
        position: absolute;
        top: -28px;
        left: 10px;
        border-radius: 4px;
        overflow: hidden;
        border: 1px solid rgba(0,0,0,.1);
        padding: 1px;
        background-color: #fff;
    }

    #goods_sku .select_goods_img img {
        vertical-align: middle;
    }

    #goods_sku .select_goods_price {
        color: #FF0036;
        margin-left: 130px;
        font-size: 14px;
        line-height: 18px;
        padding-right: 20px;
        width: 260px;
        padding-top: 24px;
    }

    #goods_sku .sku_close {
        position: absolute; top: 10px; right: 10px;
        width: 25px; height: 25px;
        background-image: url('/wap/images/icon_close.png');  
    }

    .sku_hr {
        border-bottom: 1px solid rgba(0,0,0,0.1); 
        width: 90%;
        margin: 0 auto;
        clear: both;
    }

    .sku_list {
        height: 260px;
        overflow-y: scroll; 
    }

    .sku_list li {
        padding: 10px 5%;
        
    }
    .sku_list .select_sku_name{

        color: #666;
        font-size: 13px;
        font-weight: 400;
        padding-bottom: 10px;
        padding-top: 10px;
    }

    .sku_list li .items .sku_check {
        position: relative;
        display: inline-block;
        border: 1px solid #f5f5f5;
        background-color: #f5f5f5;
        padding: 6px 12px;
        border-radius: 8px;
        font-size: 13px;
        margin: 0 8px 8px 0;
        color: #555;
    }

    .sku_list li .items .checked {
        border-color: #FF0036;
        background-color: #FF0036;
        color: #fff;
    }

    .sku_list li .items .sku_disable {
        border: 1px dashed gray;
    }

    #goods_sku .quantity-info {
        padding: 0 5%;
    }
    .sku-quantity .count {
        float: right;
    }
</style>
<div id="sku_select" style="display: none; width: 100%;max-width: 640px;height: 100%;position: fixed;background-color:#000000;opacity:0;text-align: center;z-index: 9998;top:0;"></div>
<div id="goods_sku">
    <div class="sku_header">
        <div class="select_goods_img">
            <img src="" class="j-summary-img" aria-label="选中的商品图">
        </div>

        <div class="select_goods_price">
            <div>￥  <span id="sku_select_price"></span>  </div>
            <div>请选择规格</div>
        </div>

    </div>

    <div class="sku_hr"></div>
    <!-- sku内容 -->
    <ul class="sku_list">
        
    </ul>

    <div class="sku_hr"></div>

    <div class="quantity-info">
        <div class="sku-quantity">
            <div style="margin-top: 15px; float: left;">购买数量 <span></span></div>
            <div class="count" style="border:none;">
                <div style="margin-top: 10px;">
                    <div class="count lf">
                        <a href="javascript:void(0);" id="" class="sub lf shoppingcart_min">-</a>
                        <input type="text" value="1" class="text lf number_box">
                        <a href="javascript:void(0);" id="" class="add rt shoppingcart_add">+</a>
                        <br class="clear">
                    </div>
                    <br class="clear">
                </div>
            </div>
        </div>
    </div>

    <div class="sku_submit anniu03">确定</div>
    <a class="sku_close" aria-label="关闭"></a>
</div>

<script>
function shoppingcart_add(callback) 
{
    $('.shoppingcart_add').click(function () {
        var now = $('.number_box').val();
        $('.number_box').val(Number(now) + 1);
        $('.shoppingcart_min').css('color', '');
        callback(Number(now) + 1);
    });  
}

function shoppingcart_min(callback)
{
    $('.shoppingcart_min').click(function () {
        var now = $('.number_box').val();
        if (now > 1) {
            $('.number_box').val(Number(now) - 1);
            
            if (now == 2)
            {
                $(this).css('color', 'rgb(221, 221, 221)');
            }
            callback(Number(now) - 1);

        }
            
        
        
    });
}
</script>