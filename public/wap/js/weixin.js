

wx.ready(function () {

        wx.checkJsApi({
            jsApiList: [
                'onMenuShareAppMessage',
                'onMenuShareTimeline',
                'onMenuShareQQ',
                'onMenuShareWeibo',
                'onMenuShareQZone'
            ],
            success: function (res) {
                //alert(JSON.stringify(res));
            }
        });

    var title = $('meta[name=keywords]').attr('content');
    var desc = $('meta[name=description]').attr('content');
    var imgUrl = $('meta[name=imguri]').attr('content');
    var pageUrl = $('meta[name=pageuri]').attr('content');

    //首页分享给朋友
    wx.onMenuShareAppMessage({
        title: title,
        desc: desc,
        link: pageUrl,
        imgUrl: imgUrl,
        success:function(){

        },
        cancel:function(){

        }
    });


    //分享到朋友圈
    wx.onMenuShareTimeline({
        title: title,
        desc: desc,
        link: pageUrl,
        imgUrl: imgUrl,
        success:function(){

        },
        cancel:function(){

        }
    });

    //分享到QQ
    wx.onMenuShareQQ({
        title: title,
        desc: desc,
        link: pageUrl,
        imgUrl: imgUrl,
        success:function(){

        },
        cancel:function(){

        }
    });

    //分享到腾讯微博
    wx.onMenuShareWeibo({
        title: title,
        desc: desc,
        link: pageUrl,
        imgUrl: imgUrl,
        success:function(){

        },
        cancel:function(){

        }
    });

    //分享到QQ空间
    wx.onMenuShareQZone({
        title: title,
        desc: desc,
        link: pageUrl,
        imgUrl: imgUrl,
        success:function(){

        },
        cancel:function(){

        }
    });

    wx.error(function (res) {
      //  alert('wx.error: '+JSON.stringify(res));
    });

});


