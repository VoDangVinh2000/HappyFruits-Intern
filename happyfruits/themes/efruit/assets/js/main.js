function prepareForLocalScroll(is_layout_0){
    if(is_layout_0){
        $('.menu-items').masonry({
            itemSelector: '.y-grid-card',
        });
        $('.nav.products').each(function(){
            var id = $(this).attr('data-id');
            $(this).removeAttr('id');
            $(this).find('.y-grid-card').eq(0).attr('id', id);
        });
    }else{
        $('.menu-items').css('height', 'auto');
        $('.nav.products').each(function(){
            var id = $(this).attr('data-id');
            $(this).attr('id', id);
            $(this).find('.y-grid-card').eq(0).removeAttr('id');
        });
    }
}

$(window).on("load", function() {
    /* efruit-menu */
    if($('#efruit-menu').length){
        $('.switch-layout a').click(function(){
            prepareForLocalScroll($(this).hasClass('layout-0'));
        });
        prepareForLocalScroll($('.switch-layout a.active').hasClass('layout-0'));

        $('#efruit-menu').localScroll({hash:false});
        var AFFIX_TOP_LIMIT = 300;
        var AFFIX_OFFSET = 10;
        $(".efruit-menu").each(function () {
            var $affixNav = $(this),
                current = null,
                $links = $affixNav.find("a");
            function getClosestHeader(top) {
                var last = $links.find(':visible').first();

                if (top < AFFIX_TOP_LIMIT) {
                    return last;
                }

                for (var i = 0; i < $links.length; i++) {
                    var $link = $links.eq(i),
                        href = $link.attr("href");

                    if (href.charAt(0) === "#" && href.length > 1) {
                        var $anchor = $(href).first();

                        if ($anchor.length > 0) {
                            var offset = $anchor.offset();

                            if (top < offset.top - AFFIX_OFFSET) {
                                return last;
                            }

                            last = $link;
                        }
                    }
                }
                return last;
            }
            $(window).on("scroll", function (evt) {
                var top = window.scrollY;
                var $current = getClosestHeader(top);
                if (current !== $current) {
                    $affixNav.find(".active").removeClass("active");
                    $current.parent().addClass("active");
                    current = $current;
                }
            });
        });
    }
});

$(document).ready(function(){
    $('#change_captcha').click(function(e){
        e.preventDefault();
        $('#captcha').attr('src', base_url + 'get-captcha?' + Math.random());
        $('#captcha').focus();
    });
    
    var referer = $('#referer').val();
    pushEvent('Referer', referer.length?referer:'N/A', navigator.userAgent);

    $('#show-promotion').click(function(e){
        e.preventDefault();
        showPromotion();
    });
    
    $('#menu-order-flow').click(function(e){
        e.preventDefault();
        showOrderFlow();
    });
    
    $('.mobile-nav a.menu-bar').click(function(e){
        e.preventDefault();
        if($(this).hasClass('exit')){
            $(this).removeClass('exit');
            $('div.mobile-nav').removeClass('items-visible');
            $("#efruit_phone_div, #tidio-chat").removeClass('hidden');
            $('html').removeClass('no-overflow');
            $('div.menu-main-menu-container').addClass('hidden');
            setTimeout(function(){
                $('div.mobile-nav ul.menu li').hide();
            }, 500);
            
        }else{
            $(this).addClass('exit');
            $('div.mobile-nav ul.menu li').show(100, function(){
                $("#efruit_phone_div, #tidio-chat").addClass('hidden');
                $('html').addClass('no-overflow');
                $('div.mobile-nav').addClass('items-visible');
                $('div.menu-main-menu-container').removeClass('hidden');
            });
            
        }
    });
    
    $('.mobile-nav ul.menu > li > a').click(function(e){
        $('.mobile-nav a.menu-bar').trigger('click');
    });
    
    $().UItoTop({ 		
		scrollSpeed:500,
		easingType:'linear'
	});

    $('div[role="dialog"]').on('show.bs.modal', function() {
        $("#efruit_phone_div, #tidio-chat, #toTop").addClass('hidden');
        $('html').addClass('no-overflow');
    });
    $('div[role="dialog"]').on('hide.bs.modal', function() {
        $("#efruit_phone_div, #tidio-chat, #toTop").removeClass('hidden');
        $('html').removeClass('no-overflow');
    });

    $('#view-product-modal').on('show.bs.modal', function() {
        $('#view-product-modal input[type=checkbox]').prop('checked', false);
    });
    $('#share-order-group-modal').on('shown.bs.modal', function() {
        $('#share-order-group-qr-code').html('');
        $('#share-order-group-qr-code').qrcode({
            text: base_url + 'vi/?e=I809CECN5N',
            mode: 4,
            image: $('#loading img')[0],
            size: 128,
            mSize: 0.35
        });
    });

    if ($('body').hasClass('views-home')){
        $('#modal-notices .modal-body > div.message').each(function(){
            var now = new Date();
            if ($(this).find('.starttime').length){
                var starttime = $(this).find('.starttime').val();
                if (starttime.length){
                    if (now.getTime() < starttime*1000){
                        $(this).remove();
                        return;
                    }
                }
            }
            if ($(this).find('.endtime').length){
                var endtime = $(this).find('.endtime').val();
                if (endtime.length){
                    if (now.getTime() > endtime*1000){
                        $(this).remove();
                        return;
                    }
                }
            }
            if ($(this).hasClass('close-temporary'))
                $('#modal-notices .modal-body > div.message.close-everyday').remove();
        });
        if ($('#modal-notices .modal-body > div.message').length > 0)
            $('#modal-notices').modal('toggle');
    }

    $('#live-dialog .live-dialog-box > div.golden-time-row').each(function(){
        var now = new Date();
        if ($(this).find('.starttime').length){
            var starttime = $(this).find('.starttime').val();
            if (starttime.length){
                if (now.getTime() < starttime*1000){
                    $(this).remove();
                    return;
                }
            }
        }
        if ($(this).find('.endtime').length){
            var endtime = $(this).find('.endtime').val();
            if (endtime.length){
                if (now.getTime() > endtime*1000){
                    $(this).remove();
                    return;
                }
            }
        }
    });
    if ($('#live-dialog .live-dialog-box > div.golden-time-row').length <= 0)
        $('#live-dialog').hide();
        
    
    $('.subscribe-frm .minimize').click(function(){
        $('.subscribe-frm').addClass('open');
    });
    $('.frm-header').click(function(){
        $('.subscribe-frm').removeClass('open');
    });

    $('#live-dialog a.open, #live-dialog a.close').click(function(e){
        e.preventDefault();
        $('#live-dialog').toggleClass('opened_panel');
    });

    $('[data-countdown]').each(function() {
        var $this = $(this), finalDate = $(this).data('countdown');
        $this.countdown(finalDate, function(event) {
            $this.html(event.strftime('%H:%M:%S'));
        });
    });
    if (typeof $.fancybox == 'function'){
        $(".fancybox").fancybox({
            openEffect	: 'none',
            closeEffect	: 'none'
        });
    }

    var cat_id = get_parameter_from_url('cat');
    if (cat_id)
    $('.nav-categories li.picto.' + cat_id).click();

    var $category_list = $('.c-category-list');
    var category_list_top = $category_list.length?$category_list.offset().top:0;

    var $rhs_float_form = $('.float-form');
    var rhs_float_form_top = $rhs_float_form.length?$rhs_float_form.offset().top:0;

    $(window).scroll(function() {
        var sd = $(window).scrollTop();
        var $menu_container = $('#menu-container');
        if($menu_container.length && $menu_container.is(':visible') && $(window).width() > 768){
            var menu_container_height = $menu_container.height();
            var menu_container_top = $menu_container.offset().top;

            var $efruit_cart = $('.efruit-cart');
            var cart_height = $efruit_cart.height();
            var cart_width = $efruit_cart.width();
            
            var inline_style = $efruit_cart.attr('style');

            if(sd > menu_container_top + 48 - 30 && sd < menu_container_top + menu_container_height - cart_height){
                $('.nav-cart').hide();
                $efruit_cart.addClass('fixed');
                if(typeof inline_style == 'undefined' || inline_style.indexOf('width') == -1)
                   
                    $efruit_cart.css('width', cart_width + 'px');
            }else{
                $('.nav-cart').show();
                $efruit_cart.removeClass('fixed');
                $efruit_cart.css('width', '');
            }

            var $efruit_menu = $('#efruit-menu');
            var menu_height = $efruit_menu.height();
            var menu_width = $efruit_menu.width();
            var inline_style = $efruit_menu.attr('style');
            if(sd > menu_container_top + 48 - 30 && sd < menu_container_top + menu_container_height - menu_height){
                $efruit_menu.addClass('fixed');
                if(typeof inline_style == 'undefined' || inline_style.indexOf('width') == -1)
                    $efruit_menu.css('width', menu_width + 'px');
            }else{
                $efruit_menu.removeClass('fixed');
                $efruit_menu.css('width', '');
            }
        }else{
            if($('.efruit-cart').length){
                $('.nav-cart').show();
                $('.efruit-cart').removeClass('fixed').css('width', '');
            }
            if($('#efruit-menu').length){
                $('#efruit-menu').removeClass('fixed').css('width', '');
            }
        }


        if($category_list.length){
            if(sd > category_list_top && $(window).width() > 768){
                $category_list.addClass('fixed');
                $('.nav-cart').css('top', '1px');
            }else{
                $category_list.removeClass('fixed');
                $('.nav-cart').css('top', '');
            }
        }

        if($rhs_float_form.length){
            if(sd > rhs_float_form_top - 50 && $(window).width() > 768){
                $rhs_float_form.addClass('floating');
                var new_top = sd - $('.right-content').offset().top + 70;
                if(new_top < 0)
                    new_top = 0;
                if(new_top + $rhs_float_form.height() < $('.left-content').height())
                    $rhs_float_form.css('top', new_top + 'px');
            }else{
                $rhs_float_form.removeClass('floating');
            }
        }
    });

    bindCategoryMenu();

    $('.search-more #more').click(function(){
        if(typeof items_per_page == 'undefine')
            items_per_page = 8;
        var container_selector = '.product-listing';
        var item_selector = '.product-item';
        var page = $(this).attr('data-page');
        var $container = $(container_selector);
        if($container.length){
            var $hidden_items = $container.find(item_selector + '.e-hide');
            if($hidden_items.length < items_per_page){
                $hidden_items.removeClass('e-hide').show('slow');
                $(this).hide();
            }else{
                $hidden_items.slice(0, items_per_page).removeClass('e-hide').show('slow');
            }
            $(this).attr('data-page', parseInt(page) + 1);
        }
    });

    $('a[data-scroll-to]').click(function(e){
        var target_selector = $(this).attr('data-scroll-to');
        if($(target_selector).length){
            e.preventDefault();
            $('html, body').animate({
                scrollTop: $(target_selector).offset().top - 50
            }, 2000);
        }
    });

    var hash = window.location.hash;
    var scoll_to_target = null;
    if(hash.indexOf('to-cat-') != -1){
        scoll_to_target = hash.replace('#to-cat-','.product-cat-');
    }else if(hash.indexOf('to-tag-') != -1){
        scoll_to_target = hash.replace('#to-cat-','.product-cat-');
    }
    if(scoll_to_target && $(scoll_to_target).length){
        $('html, body').animate({
            scrollTop: $(scoll_to_target).offset().top - 50
        }, 2000);
    }else if(category_list_top){
        /* Auto scroll to content of page - weird behaviour */
        $('html, body').animate({
            scrollTop: category_list_top - 51
        }, 2000);
    }
});

function showPromotion()
{
    $('#modal-subscribe').modal('toggle');
}

function showOrderFlow()
{
    $('#modal-order-flow').modal('toggle');
}

function lightenDarkenColor(col, amt) {

    var usePound = false;

    if (col[0] == "#") {
        col = col.slice(1);
        usePound = true;
    }

    var num = parseInt(col,16);

    var r = (num >> 16) + amt;

    if (r > 255) r = 255;
    else if  (r < 0) r = 0;

    var b = ((num >> 8) & 0x00FF) + amt;

    if (b > 255) b = 255;
    else if  (b < 0) b = 0;

    var g = (num & 0x0000FF) + amt;

    if (g > 255) g = 255;
    else if (g < 0) g = 0;

    return (usePound?"#":"") + (g | (b << 8) | (r << 16)).toString(16);

}

function bindCategoryMenu(){
    return $(window).width() > 799 ? ($(".c-nav-category").superfish({
        animation: {
            height: "show"
        },
        delay: 250,
        speed: 100,
        cssArrows: !1,
        onHandleTouch: !1
    }), $(".c-nav").superfish({
        animation: {
            height: "show"
        },
        delay: 10,
        speed: 100,
        cssArrows: !1,
        onHandleTouch: !1
    })) : $(".c-nav .menu-item-has-children.menu-level-0 > a").click(function(t) {
        return t.preventDefault(), $(this).hasClass("sub-menu-open") ? ($(".c-nav .menu-item-has-children.menu-level-0 > a").removeClass("sub-menu-open"), $(".sub-menu").hide(250)) : ($(".sub-menu").hide(250), $(".c-nav .menu-item-has-children.menu-level-0 > a").removeClass("sub-menu-open"), $(this).addClass("sub-menu-open"), $(this).siblings(".sub-menu").show(250))
    }), $(document).on("click", ".cs-menu-toggle", function() {
        var t;
        return t = $(this).attr("data-submenu"), $(this).toggleClass("sub-menu-open"), $(".cat-sub-menu[data-submenu=" + t + "]").toggle(250)
    });
}