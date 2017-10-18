@extends('/admin/template')

@section('content')

<div class="page-head">
    <h2>管理员列表</h2>
    <ol class="breadcrumb">
 
        <li><a href="#">管理员</a></li>
        <li class="active">列表</li>
         <a class="btn btn-info btn-sm" href="/admin/add">添加</a>
    </ol>
</div>

<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>手机</th>
        <th>操作</th>
    </tr>
    
    @foreach ($admin as $item)
    <tr>
        <td>{{$item->id}}</td>
        <td>{{$item->mobile}}</td>
        <td>
            <a class="btn btn-info btn-sm changepwd" data-toggle="modal" data-target="#changepwd"  admin_id="{{$item->id}}" href="javascript:;">修改密码</a>
            <a class="btn btn-primary btn-sm remove" admin_id="{{$item->id}}" href="javascript:;">删除</a>
        </td>
    </tr>
    @endforeach


</table>
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
          <input type="password" class="input" style="height:30px" id="oldpwd" placeholder="原密码">
        </div>
    </div>
    <div class="control-group">
        <label class="control-label" for="inputnew">新密码</label>
        <div class="controls">
          <input type="password" class="input" style="height:30px" id="newpwd" placeholder="新密码">
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
        alert('原密码不能为空');return;
    }
    if(newpwd==''){
        alert('新密码不能为空');return;
    }
    if(newpwd.length<6){
        alert('新密码不能小于6位');return;
    }
    if(admin_id==''){
        alert('请刷新重试！');return;
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