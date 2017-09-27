/**
 * Created by Administrator on 2016/4/18.
 */


window.autoLoad = {
    dataList: 'data',//返回数据中参数的字段
    isPaused: false,//暂停标识
    pageSize: 10, //每页获取数量
    currentPage: 1, // 当前页
    isDone: false, //是否已经完成全部页面拉去
    htmlNode: '',//数据添加节点
    scrollNode: null,//绑定div的滚动条id 默认document
    url: false,// 获取数据链接
    bindAction: null,//item中绑定的事件
    finished: null,//数据加载完成后执行的方法
    finishedMsg: '已经到最后一页了',
    template: null,//数据处理模版
    getData: function () {
        this.isPaused = true;
        if (this.isDone) {
            return false;
        }
        page = parseInt(this.currentPage) + 1;
        var that = this;
        $.get(this.url, {page: page, page_size: this.pageSize}, function (data) {
            that.currentPage++;
            if (typeof that.template == 'function' || typeof eval(that.template) == 'function') {
                if (typeof that.template == 'function') {
                    call_template_func = that.template;
                } else {
                    call_template_func = eval(that.template);
                }
                data = eval("(" + data + ")");
                that.removeMsg();
                if (typeof data[that.dataList].length == 'undefined' || data[that.dataList].length == 0 || data[that.dataList].length < data[that.dataList].page_size) {
                    that.isDone = true;
                    try {
                        if (typeof that.finished == 'function' || typeof eval(that.finished) == 'function') {
                            if (typeof callback == 'function') {
                                call_finished_func = that.finished;
                            } else {
                                call_finished_func = eval(that.finished);
                            }
                            call_finished_func()
                        }
                    } catch (e) {

                    }
                    that.showMsg(that.finishedMsg);
                    setTimeout(function () {
                        $("#loading-msg").fadeOut(1000);
                    }, 2000)
                } else {
                    that.isPaused = false;
                    temp = call_template_func(data);
                    $("#" + that.htmlNode).append(temp);
                    try {
                        if (typeof that.bindAction == 'function' || typeof eval(that.bindAction) == 'function') {
                            if (typeof callback == 'function') {
                                call_bind_func = that.bindAction;
                            } else {
                                call_bind_func = eval(that.bindAction);
                            }
                            call_bind_func()
                        }
                    } catch (e) {

                    }
                }
            } else {
                console.log(data);
            }
            $("#loading-image").remove();

        });
    },
    init: function (params) {
        var that = this;

        if (typeof params != 'undefined')
            for (var i in params) {
                that[i] = params[i];
            }
        if (that.url === false) {
            alert('缺少请求地址');
            return false;
        }

        if (that.htmlNode == '') {
            alert('缺少请求页面加载节点');
            return false;
        }
        if (typeof params.currentPage == 'undefined') {
            that.currentPage = 1;
        } else {
            that.currentPage = parseInt(that.currentPage);
        }
        that.isPaused = false;
        that.isDone = false;
        if (typeof scrollNode == 'undefined') {
            that.scrollNode = $(document);
        } else {
            that.scrollNode = $("#" + scrollNode);
        }

        that.scrollNode.scroll(function () {
            if (that.scrollNode.height() - $(window).height() < that.scrollNode.scrollTop() + 10) {
                if (!that.isPaused) {
                    that.loading();
                    that.getData();
                    that.removeMsg();
                    that.showMsg('正在加载...');
                }

            }
        })
    },
    loading: function (img) {
        var w_h = $(window).height();
        pad = (w_h - 100) / 2;
        var div = '<div id="loading-image" style="text-align: center; width: 100%;height: 40px;max-width: 640px;color: #e7526f;line-height: 20px;padding-top: ' + pad + 'px;">' +
            '<img src="' + this.load_image + '" style="display:none;">加载中...</div>';
        $('body').append(div);
    },
    showMsg: function (msg) {
        var div = '<div id="loading-msg" style="text-align: center; width: 100%;height: 40px;max-width: 640px;color: #cacaca;padding-top: 10px;line-height: 20px;">' + msg + '</div>';
        $("#" + this.htmlNode).append(div);
    },
    removeMsg: function () {
        $("#loading-msg").remove();
    },
    removeDate:function(){
        $("#" + this.htmlNode).html('');
    }
};