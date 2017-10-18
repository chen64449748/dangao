<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from condorthemes.com/cleanzone/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2013], Mon, 31 Mar 2014 14:35:05 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="/images/favicon.png">
    
    <title>{{$shop->shop_name}}管理系统</title>
    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
	
	<!-- Slider -->
	<link rel="stylesheet" type="text/css" href="/js/bootstrap.slider/css/slider.css" />
  
  
  <!-- Custom styles for this template -->
  <link href="/css/style.css" rel="stylesheet" />
  <link href="/js/jquery.icheck/skins/square/blue.css" rel="stylesheet">
  <link rel="stylesheet" href="/js/bootstrap.datetimepicker/css/bootstrap-datetimepicker.min.css">
  <link rel="stylesheet" href="/css/xcConfirm.css">
</head>


<body>



<!-- Fixed navbar -->
<div id="head-nav" style="height: 50px; line-height: 50px;" class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
     
      <a class="navbar-brand" href="#"><span>{{$shop->shop_name}}管理系统</span></a>
      <a class="navbar-brand" href="/logout"><span>退出</span></a>
    </div>
  </div>
</div>


<div id="cl-wrapper">
  <div class="cl-sidebar">
  	<div class="cl-toggle"><i class="fa fa-bars"></i></div>
  	<div class="cl-navblock">
      <div class="menu-space">
        <div class="content">
          <div class="side-user">
            <div class="avatar"><img src="/images/avatar1_50.jpg" alt="Avatar" /></div>
            <div class="info">
              <a href="#">{{$shop->shop_name}}</a>
              <img src="/images/state_online.png" alt="Status" /> <span>线上办公</span>
            </div>
          </div>
          <ul class="cl-vnavigation">
            @include('admin.silde')
          </ul>
        </div>
      </div>
      <div class="text-right collapse-button" style="padding:7px 9px;">
        <button id="sidebar-collapse" class="btn btn-default" style=""><i style="color:#fff;" class="fa fa-angle-left"></i></button>
      </div>
  	</div>
  </div>
  
    <style>
    #pcont {padding: 0 20px 60px 20px;}
    #notify_div * {box-sizing : border-box;}
    #notify_div {box-sizing : border-box; z-index: 123146487; width: 300px; min-height: 50px; background: white; position: fixed; bottom: -500px; right: 0;
        box-shadow: 0 0 15px #ccc; border-radius: 6px;
    }
    #notify_title_div { width: 100%; height: 50px; border-bottom: 1px solid #ccc; line-height: 50px; font-size: 16px; padding: 0 0 0 30px; }
    #notify_title {float: left;}
    #notify_toggle { float: right; padding: 0 20px; height: 50px; cursor: pointer; border-left: 1px solid #ccc;}

    #notify_item_div {height: 450px; width: 100%; overflow-y: scroll;}
    .notify_item {height: 50px; width: 100%; line-height: 50px; overflow: hidden; padding: 0 16px; }
    .notify_item:hover {background-color: rgba(0,0,0, 0.1);}
    .notify_item_title {font-size: 16px;}
    .notify_item_content {font-size: 10px;  text-overflow:ellipsis;}

    #notify_foot_div {height: 50px; text-align: center; line-height: 50px; font-size: 20px; width: 100%; background: #006dcc; color: white; cursor: pointer;}
    
    .notify_alert * {box-sizing: border-box;}
    .notify_alert {width: 300px; height: 200px; z-index: 1231464871; background: white; position: fixed; bottom: 0; right: -300px; border-radius: 6px; box-shadow: 0 0 15px #ccc;}
    .notify_alert_title_div {border-bottom: 1px solid #ccc; font-size: 20px;}
    .notify_alert_title {width: 225px; height: 50px; line-height: 50px; padding-left: 16px; float: left;  overflow: hidden; text-overflow : ellipsis; white-space:nowrap; }
    .notify_alert_close {width: 75px; float: right; line-height: 50px; padding: 0 16px; border-left: 1px solid #ccc; cursor: pointer;}
    .notify_alert_content {width: 100%; font-size: 16px; padding: 16px; overflow: hidden; text-overflow : ellipsis;}
    </style>

    
    

    <div class="container-fluid" id="pcont">

    	@yield('content')

    </div> 

    <div id="notify_div">
        <div id="notify_title_div">
            <div id="notify_title">消息盒子<input type="checkbox" id="mp3play" checked="checked">语言播报</div>
            <div id="notify_toggle">打开</div>
        </div>

        <div id="notify_item_div">
            
        </div>

        <div id="notify_foot_div">
            清空
        </div>
    </div>

    <div class="notify_alert">

        <div class="notify_alert_title_div">
            <div class="notify_alert_title">订单提示</div>
            <div class="notify_alert_close" onclick="notify_alert_close(this)">关闭</div>
            <div style="clear:both;"></div>
        </div>

        <div class="notify_alert_content">
            消息是大大大大阿萨德消息是大大大大阿萨德消息是大大大大阿萨德
        </div>
    </div>

</div>  
</body>

<audio id="mp3Btn">
    <source src="/orderadmin.mp3" type="audio/mpeg" />
</audio>
</html>
<script src="/js/jquery.js"></script>
<script src="/js/masonry-docs.min.js" type="text/javascript"></script>
<!-- <script src="/js/jquery.select2/select2.min.js" type="text/javascript"></script> -->
<!-- <script src="/js/jquery.parsley/dist/parsley.js" type="text/javascript"></script> -->
<script src="/js/bootstrap.slider/js/bootstrap-slider.js" type="text/javascript"></script>
<!-- <script type="text/javascript" src="/js/jquery.nanoscroller/jquery.nanoscroller.js"></script> -->
<!-- <script type="text/javascript" src="/js/jquery.nestable/jquery.nestable.js"></script> -->
<script type="text/javascript" src="/js/behaviour/general.js"></script>
<!-- <script src="/js/jquery.ui/jquery-ui.js" type="text/javascript"></script> -->
<!-- <script type="text/javascript" src="/js/bootstrap.switch/bootstrap-switch.js"></script> -->
<script type="text/javascript" src="/js/bootstrap.datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/js/bootstrap.datetimepicker/locales/bootstrap-datetimepicker.zh-CN.js"></script>
<script type="text/javascript" src="/js/jquery.icheck/icheck.min.js"></script>
<!-- <script type="text/javascript" src="/js/bootstrap.daterangepicker/moment.min.js"></script> -->
<!-- <script type="text/javascript" src="/js/bootstrap.daterangepicker/daterangepicker.js"></script> -->
<script src="/js/xcConfirm.js" type="text/javascript" charset="utf-8"></script>
<script src='/js/command.js' type="text/javascript"></script>


<script type="text/javascript">

$('#mp3play').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue',
    increaseArea: '20%' // optional
});

function notify_alert_close(obj, count)
{   
    $(obj).data('flag', '0');
    $('#notify_item_id'+ count).remove();
    $(obj).parents('.notify_alert').remove();
}

function notify_alert(title, content, count)
{
    var alert_html = '<div class="notify_alert_title_div">\
                        <div class="notify_alert_title">'+ title +'</div>\
                        <div class="notify_alert_close" data-flag="1" onclick="notify_alert_close(this, '+ count +')">关闭</div>\
                        <div style="clear:both;"></div>\
                    </div>\
                    <div class="notify_alert_content">'+ content +'</div>';

    var notify_alert = $('<div class="notify_alert"></div>');
    notify_alert.html(alert_html);
    $('body').append(notify_alert);
    notify_alert.animate({right: '0'}, 500, function () {
        notify_alert.animate({opacity: 0}, 6000, function () {
            notify_alert.remove();
        });
    });
}

function notify_item_add(title, content)
{
    var count = $('#notify_item_div').size();
    count = count + 1;
    var item_html = '<div id="notify_item_id'+ count +'" class="notify_item"><span class="notify_item_title">'+ title +'</span>：<span data-content="'+ content +'" class="notify_item_content">'+ content.substr(0, 10) +'...</span></div>';
    $('#notify_item_div').append(item_html);

    return count;
}

$(document).ready(function(){
    //initialize the javascript
    App.init();
    var flag = 0;
    $('#notify_toggle').click(function () {
        if (flag) {
            flag = 0;
            $('#notify_toggle').text('打开');
            $('#notify_div').animate({bottom: '-500px'});
        } else {
            flag = 1;
            $('#notify_toggle').text('收起');
            $('#notify_div').animate({bottom: '0'});
        }
    });

    $('#notify_foot_div').click(function () {
        $('#notify_item_div').text('');
    });

    $('#notify_div').on('click', '.notify_item', function () {
        var content = $(this).find('.notify_item_content').data('content');
        var title = $(this).find('.notify_item_title').text();
        notify_alert(title, content);
        $(this).remove();
    })

});


</script>
<script>

function loadDiv(text) {
     var div = "<div id='_layer_'> <div id='_MaskLayer_' style='filter: alpha(opacity=30); -moz-opacity: 0.3; opacity: 0.3;background-color: #000; width: 100%; height: 100%; z-index: 2147000001; position: fixed;" + "left: 0; top: 0; overflow: hidden; display: none'></div><div id='_wait_' style='z-index: 2147000002; position: fixed; width:430px;height:218px; display: none'  ><center><h3>" + "" + text + "<img src='/images/loading.gif' width=80 height=80 /></h3><button style='display: none;' class='btn btn-danger' onclick='LayerHide()'>关闭</button></center></div></div>"; 
   return div; 
}

function LayerShow(text) {
    var addDiv= loadDiv(text);  
    var element = $(addDiv).appendTo(document.body);     $(window).resize(Position);  
    var deHeight = $(document).height();    
    var deWidth = $(document).width();    
    Position();     
    $("#_MaskLayer_").show();   
    $("#_wait_").show();
}

function Position() {  
    $("#_MaskLayer_").width($(document).width());   
    var deHeight = $(window).height();     
    var deWidth = $(window).width();     
    $("#_wait_").css({ left: (deWidth - $("#_wait_").width()) / 2 + "px", top: (deHeight - $("#_wait_").height()) / 2 + "px" }); 
}

function LayerHide() { 
    $("#_MaskLayer_").hide(); 
    $("#_wait_").hide(); 
    del(); 
}

function del() { 
    var delDiv = document.getElementById("_layer_");     delDiv.parentNode.removeChild(delDiv); 
}
</script>


<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
  <!-- <script src="/js/behaviour/voice-commands.js"></script> -->
<script src="/js/bootstrap/dist/js/bootstrap.min.js"></script>
@yield('script')

<script type="text/javascript">

    var ws;
    var lockReconnect = false;//避免重复连接
    var retime = 0;
    var heartCheck = {
            timeout: 60000,//60ms
            timeoutObj: null,
            reset: function(){
                clearTimeout(this.timeoutObj);
        　　　　 this.start();
            },
            start: function(){
                this.timeoutObj = setTimeout(function(){
                    var send_data = {action: 'AdminPing', pwd: 'admin', admin_id: {{$manage->id}}};
                    send_data = JSON.stringify(send_data);
                    ws.send(send_data);
                }, this.timeout)
            }
        }

    

    function createWebSocket(url) {
        try {
            ws = new WebSocket(url);
            initEventHandle();
            retime = 0;
        } catch (e) {
            reconnect(url);
        }     
    }

    function reconnect(url) {
        if(lockReconnect) return;
        
        if (retime > 3000) {
            return;
        }
        retime++;
        lockReconnect = true;
        //没连接上会一直重连，设置延迟避免请求过多
        setTimeout(function () {
            createWebSocket(url);
            lockReconnect = false;
        }, 2000);
    }


    createWebSocket('ws://127.0.0.1:8282');

    function initEventHandle() {

        ws.onopen = function ()
        {
            var send_data = {action: 'AdminLogin', pwd: 'admin', admin_id: {{$manage->id}}};
            send_data = JSON.stringify(send_data);
            ws.send(send_data);

            heartCheck.start();
        }

        ws.onmessage = function (evt)
        {
            var data = JSON.parse(evt.data);

            if (data.action == 'OrderAdminSend') {
                var count = notify_item_add('订单提示', '订单号；'+ data.data.order_id + '<br>'+ data.data.message);
                notify_alert('订单提示', '订单号；'+ data.data.order_id + '<br>'+ data.data.message, count);
                
                if ($('#mp3play').prop('checked')) {
                    $('#mp3Btn').get(0).play();
                }
                
            } else if (data.action == 'AdminPing') {

                if (data.message == 'pong') {
                    heartCheck.reset();
                } else if (data.message == 'fail') {
                    var send_data = {action: 'AdminLogin', pwd: 'admin', admin_id: {{$manage->id}}};
                    send_data = JSON.stringify(send_data);
                    ws.send(send_data);
                }

                
            }
            
        }

        ws.onerror = function (evnt) {
           reconnect('ws://127.0.0.1:8282');
        };

        ws.onclose = function () {
            reconnect('ws://127.0.0.1:8282');
        }
    }
    

</script>
