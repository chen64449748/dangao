/* 
 * @Author: zeng
 * @Date:   2016-099
 * @Last Modified by:
 * @Last Modified time:
 */

$(document).ready(function(){
    var img,tmpW,tmpH,tmp;
    // 图片控制块
    $('.box-block, .img-block').show();
    $('.box-block').each(function(){
        $(this).height(function () {
            return $(this).width();
        });
        img = $(this).find('img');
        tmpW = $(img).width();
        tmpH = $(img).height();
        if(tmpW < tmpH){
            $(img).height(function(){
                return $(this).parents('.box-block').width();
            })
            $(img).width(function(){
                return 'auto';
            })
        }
        if($(img).height() != 0){
            if(tmpW > tmpH){
                tmp = (tmpW - tmpH)/2;
                $(img).css('margin-top',tmp);
            }
        }
    })
    $(window).on('resize load scroll',function(){
        // 图片控制块
        $('.box-block, .img-block').show();
        $('.box-block').each(function(){
            $(this).height(function () {
                return $(this).width();
            });
            img = $(this).find('img');
            tmpW = $(img).width();
            tmpH = $(img).height();
            if(tmpW < tmpH){
                $(img).height(function(){
                    return $(this).parents('.box-block').width();
                })
                $(img).width(function(){
                    return 'auto';
                })
            }
            if($(img).height() != 0){
                if(tmpW > tmpH){
                    tmp = (tmpW - tmpH)/2;
                    $(img).css('margin-top',tmp);
                }
            }
        })

        // 弹窗
        tmpW=$("div[class*='alert-wd']").width()/2;
        $("div[class*='alert-wd']").css({'left':'50%','margin-left':-tmpW});
    })

    // 回到顶部
    $(".totop").on('click',function() {
        $(document).scrollTop(0);
    })

    // 文本编辑块
    $('div[contenteditable=true]').on('focus',function(){
        $(this).text('');
    })

    // 折叠展开组
    $("div[class*='btn-fold']").hide();
    $(".btn-foldall-arrow").show();
    $("div[class*='un-fold']").each(function(){
        // 40px
        if($(this).hasClass('un-fold')){
            if($(this).find('.txt-fold').height()>40){
                $(this).find('.btn-fold').show();
                $(this).find('.btn-fold').text('显示全部');
                $(this).find('.txt-fold').addClass('ht-40 oh');
            }else{
                $(this).find('.txt-fold').removeClass('ht-40 oh');
                $(this).find('.btn-fold').text('收起全部');
            }
        }
        // 82px
        if($(this).hasClass('un-fold-arrow')){
            if($(this).find('.txt-fold-arrow').height()>82){
                $(this).find('.btn-fold-arrow').show();
                $(this).find('.btn-fold-arrow').html('<div class="db">展开</div><img src="svg/arrowdown-gr.svg" height="14px">');
                $(this).find('.txt-fold-arrow').addClass('ht-82 oh');
            }else{
                $(this).find('.txt-fold-arrow').removeClass('ht-82 oh');
                $(this).find('.btn-fold-arrow').html('<img src="svg/arrowup-gr.svg" height="14px"><div class="db">收起</div>');
            }
        }
    })
    $("div[class*='btn-fold']").on('click',function(){
        // 40px
        if($(this).hasClass('btn-fold')){
            if($(this).siblings('.txt-fold').height()>40){
                $(this).siblings('.txt-fold').addClass('ht-40 oh');
                $(this).text('显示全部');
            }else{
                $(this).siblings('.txt-fold').removeClass('ht-40 oh');
                $(this).text('收起全部');
            }
        }
        // 82px
        if($(this).hasClass('btn-fold-arrow')){
            if($(this).siblings('.txt-fold-arrow').height()>82){
                $(this).siblings('.txt-fold-arrow').addClass('ht-82 oh');
                $(this).html('<div class="db">展开</div><img src="svg/arrowdown-gr.svg" height="14px">');
            }else{
                $(this).siblings('.txt-fold-arrow').removeClass('ht-82 oh');
                $(this).html('<img src="svg/arrowup-gr.svg" height="14px"><div class="db">收起</div>');
            }
        }
    })
    $(".btn-foldall-arrow").on('click',function(){
        var $obj=$(this).siblings('.txt-foldall-arrow');
        if($(this).siblings('.txt-foldall-arrow').css('display')=='block'){
            $(this).find('.icon-more-block-down').addClass('rt-180');
        }
        if($(this).siblings('.txt-foldall-arrow').css('display')=='none'){
            $(this).find('.icon-more-block-down').removeClass('rt-180');
        }
        $obj.slideToggle('fast');
    })

    // 弹窗
    $('.alert-click').on('click',function(){
        tmpW=$("div[class*='alert-wd']").width()/2;
        $("div[class*='alert-wd']").css({'left':'50%','margin-left':-tmpW});
        $('.ly').fadeIn('fast');
        $("div[class*='alert-wd']").fadeIn('fast');
        $('html').addClass('oh');
        return false;
    })
    $('.close').on('click',function(){
        $('.ly').fadeOut('fast');
        $("div[class*='alert-wd']").fadeOut('fast');
        $('html').removeClass('oh');
        return false;
    })

    // 滚动头部导航样式变化
    $(window).on('scroll',function(){
        if($(window).scrollTop()>10){
            $('.totop').show();
            $('.nav-scroll').removeAttr('style');
            $('.nav-scroll .icon-back-line, .nav-scroll .icon-home-block').removeClass('cl-wt').addClass('cl-6');
            $('.nav-scroll div').removeClass('cl-wt');
        }else{
            $('.totop').hide();
            $('.nav-scroll').css('background-color','transparent');
            $('.nav-scroll .icon-back-line, .nav-scroll .icon-home-block').removeClass('cl-6').addClass('cl-wt');
            $('.nav-scroll div').addClass('cl-wt');
        }
    })

    // 溢出隐藏滑屏时事件
    $('.oh-touch').on('touchmove',function(){
    })

    // 隐藏当前块
    $('.hide').on('click',function(){
        $(this).parents('.box-hide').hide();
    })
    
    // 关注
    $('.bt-zb-focus').on('click',function(){
        if($(this).hasClass('button-primary')){
            $(this).removeClass('button-primary').text('已关注');
        }else{
            $(this).addClass('button-primary').text('＋关注');
        }
        return false;
    })

    // radio提示框选择
    $('.div-radio').on('click',function(){
        $('.div-radio').removeClass('cl-bl').addClass('cl-gr');
        $(this).removeClass('cl-gr').addClass('cl-bl');
        $('.ly, .alert-wd-50p').delay(600).fadeOut('fast');
        var tmp=$(this).find('span').text();
        $('.div-checked').text(tmp);
        return false;
    })

    // 语音收听
    var audio,progress,progressT,dateM,dateS;
    window.onload = function(){
        $('.audio-stop').css('display','block');
        $('.audio-move').css('display','none');
        initAudio();
        dateM=parseInt(progressT/60);
        dateS=progressT-dateM*60;
        dateS=dateS.toString().slice(2,4);
        $('#audio-Time').text(dateM+":"+dateS);
    }
    function initAudio(){
        if( document.getElementById('audio')==null ){
            return false;
        }
        audio = document.getElementById('audio');
        progress = audio.duration;
        progressT=progress;
    }
    function playOrPaused(id,obj){
        if(audio.paused){
            audio.play();
            $('.audio-stop').css('display','none');
            $('.audio-move').css('display','block');
            return;
        }
        audio.pause();
        $('.audio-stop').css('display','block');
        $('.audio-move').css('display','none');
        // 重新播放
        audio.currentTime = 0;
        $('.audio-progress').stop(true,true).animate({ width:"0" },0);
    }
    $('.audio').on('click',function(){
        playOrPaused('firefox',this);
        var tmp=$('.audio').width();
        // 绑定进度条
        $('.audio-progress').delay(0).animate({ width:tmp },progress*1000);
    })
    // 监听语音播放，播放完成执行相应动作
    $('#audio').bind('ended',function(){
        $('.audio-stop').css('display','block');
        $('.audio-move').css('display','none');
        $('.audio-progress').stop(true,true).animate({ width:"0" },0);
    })

    // vip
    var tmpY=0,tmpP=0,tmpM=0;
    $('.vip-box .vip-grade-move').each(function(){
        tmpM++;
    })
    $('.vip-box .vip-grade-move.bc-yl').each(function(){
        tmpY++;
    })
    tmpP=100/tmpM*(tmpY-1);
    tmpStr=tmpP.toString()+"%";
    $('.vip-progress-move').css({'width':tmpStr,'margin-left':'15px'});

});
