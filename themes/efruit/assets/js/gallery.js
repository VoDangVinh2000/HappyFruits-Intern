$(document).ready(function(){
    $(".fancybox").fancybox({
		openEffect	: 'none',
		closeEffect	: 'none'
	});
    $('.responsiveGallery-wrapper').responsiveGallery({
        animatDuration: 400, // ms
        autoplay: 1,
        $btn_prev: $('.responsiveGallery-btn_prev'),
        $btn_next: $('.responsiveGallery-btn_next')
    });
});