$(function(){

	function setContentSize() {
		$('.swiper-content').css({
			height: $(window).height()-$('.swiper-nav').height()-50
		})
	}
	setContentSize()
	$(window).resize(function(){
		setContentSize()
	})

	// Init Navigation


	// 自定义
    $('.swiper-nav .swiper-slide').click(function(){
        $('.swiper-nav .swiper-slide').removeClass('active-nav');
        $(this).addClass('active-nav');
    })

	// 切换到下一场

	// Init Content
	var contentSwiper = $('.swiper-content').swiper({
		onSlideChangeStart: function(){
			updateNavPosition()
		}
	})

	//Init Pages
	var pages = $('.swiper-pages').swiper()

	function updateNavPosition(){
		$('.swiper-nav .active-nav').removeClass('active-nav');
		var activeNav = $('.swiper-nav .swiper-slide').eq(contentSwiper.activeIndex).addClass('active-nav');
		if (!activeNav.hasClass('swiper-slide-visible')) {
			console.log(activeNav.index());
			console.log(navSwiper.activeIndex);
			if (activeNav.index()>navSwiper.activeIndex) {
				var thumbsPerNav = Math.floor(navSwiper.width/activeNav.width())-1;
				navSwiper.swipeTo(activeNav.index()-thumbsPerNav);
			}
			else {
				navSwiper.swipeTo(activeNav.index());
			}	
		}
	}

	//Scroll Containers 业内
	$('.scroll-container').each(function(){
		$(this).swiper({
			mode:'vertical',
			scrollContainer: true,
			mousewheelControl: true,
			scrollbar: {
				container:$(this).find('.swiper-scrollbar')[0]
			}
		})
	})

})