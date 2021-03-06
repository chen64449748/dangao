@extends('wap.header')

@section('content')
<!-- 搜索 -->
<div class="box_fix1">
    <div class="md_search">
        <form action="/goods">
            <a href="javascript:viod(0)" id="sch"><img src="/wap/images/mdimages/icon/search.png" height="12" class="ic_sc"></a>
            <input name="k" type="text" placeholder="搜索" class="mgt_10" />
        </form>
    </div>
</div>

<!--==================轮播图====================-->
<div class="flexslider fix_patch1">
    <ul class="slides">
        @foreach ($banners as $banner)
        <li><a href="{{$banner->banner_url}}"><img src="{{$banner->banner_img}}" style="widht: 640px; height: 220px;" alt="" width="100%"></a></li>
        @endforeach

    </ul>
</div>


<!--===================菜单=====================-->


<script>
    $(document).ready(function(){
        var h=($('.img2').height())/2;
        $('.img1').each(function(){
            $(this).height(h);
        })
    })
    $(window).bind('resize load',function(){
        var h=($('.img2').height())/2;
        $('.img1').each(function(){
            $(this).height(h);
        })
    })
</script>

<div class="bgcl_wt pdb_10">

    
    <a href="javascript:;" class="mgt_10 a_lk">
        <span class="fl spr"></span>
        <span class="fl fs_15" style="position: relative; top : -6px;">店铺介绍</span>
        <img src="/wap/images/mdimages/icon/more.png" alt="" height="12" class="fr" style="margin-top: 4px;">
        <div class="cl"></div>
    </a>
    <p style="color:red;padding:15px">{{$shop->shop_discrib}}</p>
</div>

<!--==================精选活动====================-->
<div class="bgcl_wt pdb_10">

    
    <a href="/active" class="mgt_10 a_lk">
        <span class="fl spr"></span>
        <span class="fl fs_15" style="position: relative; top : -6px;">活动精选</span>
        <img src="/wap/images/mdimages/icon/more.png" alt="" height="12" class="fr" style="margin-top: 4px;">
        <div class="cl"></div>
    </a>
   
    

    @if (count($fines))
    @foreach ($fines as $fine)
    <div class="pdlr_02 mgt_10"><a href="/active/detail/{{$fine->id}}" class="dsp_blk"><img src="{{$fine->active_img}}" height="220" width="100%"></a></div>
    @endforeach

    @else
    <div class="align_center">
        <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 50px 0 10px 0;">
        <div class="color_gray font_size02">暂无活动</div>
    </div>
    @endif
</div>

<!--==================热销TOP10===================-->
<div class="bgcl_wt mgt_10 pdb_10">
    <div class="pdb_10">
        <a href="javascript:void(0);" class="mgt_10 a_lk">
            <span class="fl spr"></span>
            <span class="fl fs_15" style="position: relative; top : -6px;">热销</span>
            <div class="cl"></div>
        </a>
    </div>
    <div class="md_block3">
        @if (count($hot))
        @foreach ($hot as $hot_goods) 
        <div class="div_img fl">
            <div class="div_buding pd_08"><a href="detail/{{$hot_goods->id}}" class="dsp_blk"><img src="{{$hot_goods->goods_img}}" width="100%"></a></div>
            <div class="pdlr_03">
                <a href="javascript:void(0);" class="a_ttl">{{$hot_goods->goods_title}}</a>
                <div class="div_shop">
                    <span class="fs_12 cl_rd fl">￥{{$hot_goods->show_price}}</span>
                    <a href="javascript:void(0);" onclick="addcart({{$hot_goods->id}});"><img src="/wap/images/mdimages/icon/shop.png" height="16" class="fr"></a>
                    <div class="cl"></div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div class="align_center">
            <img src="/wap/images/icon/wudingdan.png" alt="" height="48" style="margin: 50px 0 10px 0;">
            <div class="color_gray font_size02">暂无热销推荐</div>
        </div>
        @endif
        <div class="cl"></div>
    </div>
</div>


<!-- 回到顶部 -->
<a href="#" class="md_totop"><img src="/wap/images/mdimages/icon/top.png" height="24"></a>
<div style="height: 60px;"></div>


@include('wap.menu')
<script src="/wap/js/swiper/swiper.min.js"></script>

</script>
<script type="text/javascript">
    $('#sch').click(function () {
        $(this).parent('form').submit();
    });
    numberBox();
    shoppingcart_add();
    shoppingcart_min();

    function openshop(){
        $.getJSON("/index.php",{act:'openshop'},
                function(data){window.location.href=data.url;}
        )
    }

    function addcart(id){
        if(!id){
            alert('商品不存在'); return false;
        }
        sku_select_show(id, function (sku_value_ids, count) {
            $.post('/cart/add', {goods_id: id, sku_value_ids: sku_value_ids, count: count}, function (data) {
                alert(data.message);
            });

        });
    }
</script>
@stop