@extends('/admin/template')

@section('content')

<div class="page-head">
    <h2>管理员</h2>
    <ol class="breadcrumb">
 
        <li><a href="#">添加管理员</a></li>
        <li class="active"></li>
    </ol>
</div>


<div class="row ">


    <form class="form-horizontal" name="add">
        <div class="control-group">
            <label class="control-label" for="company_name">手机号码</label>
            <div class="controls">
                <input type="text" id="" name="mobile" placeholder="手机号">
            </div>
        </div>

        <div class="control-group">
            <label class="control-label" for="company_faren">密码</label>
            <div class="controls">
                <input type="password" id="company_faren" name="password" placeholder="密码">
            </div>
        </div>
        
        <div class="control-group">
            <label class="control-label" for=""></label>
            <div class="controls">
                <input type="button" class="company_add btn btn-primary" value="添加管理员">
            </div>
        </div>
    </form>
</div>

@stop


@section('script')

<script>

    $('.company_add').click(function () {

        var company = {};

        var mobile = $('input[name=mobile]').val();
        var password = $('input[name=password]').val();
    
        if (!mobile || !password) {
            return window.wxc.xcConfirm('手机号和密码', window.wxc.xcConfirm.typeEnum.info);
        }

        company.mobile = mobile;
        company.password = password;



        var send_data = {
            
            'data': {
                'admin': company,
            }
        };

        var txt= "确定添加管理员？";
        var option = {
            title: "添加管理员",
            btn: parseInt("0011",2),
            onOk: function(){

                $.post('/admin/add/data', send_data, function (data) {

                    if (data.status == 1) {

                        window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.success);
                        setTimeout(function () {
                            window.location.href = '/admin';
                        }, 800);

                    } else {
                        return window.wxc.xcConfirm(data.message, window.wxc.xcConfirm.typeEnum.error);
                    }

                });

            },
        }

        window.wxc.xcConfirm(txt, "custom", option);

    });

</script>

@stop