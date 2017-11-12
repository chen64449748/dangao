@extends('/admin/template')

@section('content')

<div class="page-head">
    <h2>订单列表</h2>
    <ol class="breadcrumb">
 
        <li><a href="#">订单</a></li>
        <li class="active">列表</li>
    </ol>
</div>

<div class="page-head">
    <form class="form-inline" method="get">
    <div class="control-group fl">

        <select name="status">
            <option value="">全部订单状态</option>
            <option @if ($status == 'waiting') selected @endif value="waiting">待付款</option>
            <option @if ($status == 'payed') selected @endif value="payed">已付款</option>
            <option @if ($status == 'ok') selected @endif value="ok">已完成</option>
            <option @if ($status == 'close') selected @endif value="close">已取消</option>
        </select>

        <input type="text" name="wx_pay_order" class="input" placeholder="订单号" style="height:30px" value="{{$wx_pay_order}}">
        <input type="text" style="width: 200px;height:30px" name="mobile" class="input"  placeholder="手机号" value="{{$mobile}}">
        <input type="text" style="width: 200px;height:30px" name="name" class="input"  placeholder="姓名" value="{{$name}}">

        <input type="submit" class="btn btn-primary" value="搜索">
    </div>
    </form>
</div>

<div class="page-head">

    

    @foreach ($orders as $item)
    <div class="finance_order row border9">
        
        <div class="row order_title">
            订单状态: 
            <span style="color: red; font-size: 20px;">
            @if ((int)$item->status === 0 || $item->status == 1)
            待付款
            @elseif ($item->status == 2)
            已付款
            @elseif ($item->status == 3)
            已关闭
            @elseif ($item->status == 4)
            已完成
            @endif            
            </span>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
            订单编号：{{$item->id}} &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
            微信订单号：{{$item->wx_pay_order}} &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
            收件人：{{$item->name}};手机号：{{$item->mobile}} &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
            地址：{{$item->address}} &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp 
            结算时间：{{$item->created_at}}
            <button class="prt btn btn-info   changestatus" oid="{{$item->id}}" data-toggle="modal" data-target="#changestatus">状态修改</button>
        </div>

        <div>
            <div class="order_item" style="width: 40%;">
                商品
            </div>
            <div class="order_item" style="width: 20%;">规格</div>
            <div class="order_item" style="width: 10%;">数量/件</div>
            <div class="order_item" style="width: 10%;">付款时间</div>
            <div class="order_item" style="width: 10%;">单价/元</div>
            <div class="order_item" style="width: 10%;">合计/元</div>
            <div class="clr"></div>
        </div>
        @foreach ($item->orderDetails as $dkey => $ditem)
        <div>
            <div class="order_item" style="width: 40%;">
                <img style="height: 40px;" src="{{$ditem->goods->goods_img}}">
                {{$ditem->goods->goods_title}}
            </div>

            <div class="order_item" style="width: 20%;">
                @foreach ($ditem->p->skuPrices as $sku_price)
                    {{$sku_price->skuValue->value}}
                @endforeach
            </div>
            <div class="order_item" style="width: 10%;">{{$ditem->buy_count}}件</div>
            <div class="order_item" style="width: 10%;">{{$item->pay_time}}</div>
            <div class="order_item" style="width: 10%;">{{$ditem->price}}元</div>
            <div class="order_item" style="width: 10%;">{{number_format($ditem->price * $ditem->buy_count, 2)}}元</div>
            <div class="clr"></div>
        </div>
        @endforeach

        <div class="order_foot">
            总计: {{$item->price}}元
        </div>
    </div>
    @endforeach
</div>



<div class="pagination">
{{$orders->links()}}
</div>
@stop
<div class="modal hide fade" id="changestatus">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>修改状态</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
    <div class="control-group">
        <label class="control-label" for="inputold">订单状态</label>
        <div class="controls">
            <select id="choose">
                <option value="0">未付款</option>
                <option value="2">已付款</option>
                <option value="3">已关闭</option>
                <option value="4">已完成</option>
            </select>
        </div>
    </div>
</form>
 </div>
  <div class="modal-footer">
    <a href="javascript:;" class="btn btn-primary change">修改</a>
  </div>
</div>
@section('script')

<script type="text/javascript">
var admin_id = '';
$('.updateMake').click(function () {

    var company_id = $(this).data('id');

    var make_msg = $(this).find('span').text();

    var txt=  "确定要修改为：" + make_msg;
    var option = {
        title: "修改合作关系",
        btn: parseInt("0011",2),
        onOk: function(){
            $.get('/company/update/make', {company_id: company_id}, function (data) {   
                if (data.status == 1) {
                    window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
                } else {
                    window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
                }
            });
        }
    }
    window.wxc.xcConfirm(txt, "custom", option);

    return;
    

});

$('.changestatus').click(function () {
    oid = $(this).attr('oid');
});
$('.change').click(function(){
    var status =$('#choose').val();
    $.get('/orders/change', {oid:oid,status:status}, function (data) {   
                if (data.status == 1) {
                    window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
                    setTimeout(function () {
                        window.location.reload();
                    }, 800);
                } else {
                    window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
                }
            });
});

//删除
$('.remove').click(function(){
    var the = $(this);
    var id  = $(this).attr('admin_id');
    if(confirm('确认要删除吗？')){
        $.get('/admin/del', {id:id}, function (data) {   
                if (data.status == 1) {
                    window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
                    // setTimeout(function () {
                        the.parent().parent().remove();
                    // }, 800);
                } else {
                    window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
                }
            });
    }
});
</script>

@stop