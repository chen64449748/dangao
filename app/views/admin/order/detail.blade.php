@extends('/admin/template')

@section('content')

<div class="page-head">
    <h2>订单详情</h2>
    <ol class="breadcrumb">
 
        <li><a href="#">详情</a></li>
        <li class="active"></li>
    </ol>
</div>

<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>商品图片</th>
        <th>商品名称</th>
        <th>商品单价</th>
        <th>商品数量</th>
    </tr>
    
    @foreach ($order_detail as $key => $item)
    <tr>
        <td>{{$key+1}}</td>
        <td>{{$item->image}}</td>
        <td>{{$item->sku_name}}</td>
        <td>{{$item->price}}</td>
        <td>{{$item->num}}</td>
    </tr>
    @endforeach


</table>
@stop

@section('script')

<script type="text/javascript">
</script>

@stop