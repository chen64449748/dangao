@extends('/admin/template')

@section('content')

<div class="page-head">
    <h2>订单列表</h2>
    <ol class="breadcrumb">
 
        <li><a href="#">订单</a></li>
        <li class="active">列表</li>
    </ol>
</div>

<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>商品名称</th>
        <th>收货人</th>
        <th>下单时间</th>
        <th>订单状态</th>
        <th>订单金额</th>
        <th>操作</th>
    </tr>
    
    @foreach ($orders as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->product_name}}</td>
        <td>{{$item->name}}&nbsp;&nbsp;{{$item->mobile}}&nbsp;&nbsp;{{$item->address}}</td>
        <td>{{$item->create_time}}</td>
        <th>@if ($item->status == '1')未支付 @elseif($item->status == '2') <span style="color:red">已支付</span> @elseif($item->status =='3') 取消订单 @else  @endif</th>
        <th>{{$item->pay}}</th>
        <td>
            <a class="btn btn-info btn-sm changepwd"  admin_id="{{$item->id}}" href="/admin/order_detail/?oid={{$item->id}}">查看详情</a>
        </td>
    </tr>
    @endforeach


</table>
<div class="pagination fr">
{{$orders->links()}}
</div>
@stop
<div class="modal hide fade" id="changepwd">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h3>修改密码</h3>
  </div>
  <div class="modal-body">
    <form class="form-horizontal">
    <div class="control-group">
        <label class="control-label" for="inputold">原密码</label>
        <div class="controls">
          <input type="text" id="oldpwd" placeholder="原密码">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputnew">新密码</label>
        <div class="controls">
          <input type="text" id="newpwd" placeholder="新密码">
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

$('.changepwd').click(function () {
    admin_id = $(this).attr('admin_id');
});
$('.change').click(function(){
    var oldpwd =$('#oldpwd').val();
    var newpwd = $('#newpwd').val();
    if(oldpwd==''){
        alert('原密码不能为空');
    }
    if(newpwd==''){
        alert('原密码不能为空');
    }
    if(admin_id==''){
        alert('请刷新重试！')
    }
    $.get('/admin/change', {admin_id:admin_id,old:oldpwd,new:newpwd}, function (data) {   
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