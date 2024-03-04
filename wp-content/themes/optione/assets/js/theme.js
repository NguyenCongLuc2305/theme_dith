;(function ($) {
    "use strict";
    var scroll_top;
    var window_height;
    var window_width;
    var scroll_status = '';
    var lastScrollTop = 0;
   

    $( document ).ready( function() {
        optione_header_sticky();
        optione_open_menu_toggle();
        optione_panel_mobile_menu();
        optione_cart_toggle();
        optione_panel_anchor_toggle();
        optione_sidebar_tabs_toggle();
        optione_document_click();
        optione_scroll_to_top();
        optione_footer_fixed();
        optione_magnific_popup();
        optione_fancyBoxAccordion();
        optione_svgDrawing();
        backtotopIndicator();
        optione_set_height();
        optione_nice_select();
        // optione_scroll_animate();
        optione_change_span();
        optione_carosel_mobile();
     
     

        //* For Shop
        optione_shop_view_layout();
        optione_wc_single_product_gallery();
        optione_quantity_plus_minus();
        optione_quantity_plus_minus_action();
        // optione_table_cart_content();
        // optione_table_move_column('.woocommerce-cart-form__contents', '.woocommerce-cart-form__cart-item' ,0, 5, '', '.product-subtotal', '');
    });

    $(window).on('load', function () {
        $("#pxl-loadding.content-image").fadeOut("slow");
        setTimeout(function() {
            $("#pxl-loadding").fadeOut("slow");
        },500);
        wowInit();
        optione_nice_select();
    });

    $(window).on('resize', function () {
        optione_set_height();
        optione_carosel_mobile();
    });

      /// refersh code 
    setInterval(function() {
        refresh_code();
    }, 1000);

    $(window).on('scroll', function () {
        scroll_top = $(window).scrollTop();
        window_height = $(window).height();
        window_width = $(window).width();
        if (scroll_top < lastScrollTop) {
            scroll_status = 'up';
        } else {
            scroll_status = 'down';
        }
        lastScrollTop = scroll_top;
        optione_header_sticky();
        optione_scroll_to_top();

    });
    jQuery( document ).on( 'updated_wc_div', function() {
        optione_quantity_plus_minus();
        // optione_table_cart_content();
        // optione_table_move_column('.woocommerce-cart-form__contents', '.woocommerce-cart-form__cart-item' ,0, 5, '', '.product-subtotal', '');
    } );

    function refresh_code(){
        if($('span').hasClass('woocommerce-Price-amount')){
            $('.woocommerce-Price-amount bdi').each(function () {
                var divValue = $(this).text();
                var parts = divValue.split('.');
                var intValue = parts[0];
                var decimalValue = parts[1];
                var newHtml = '';
                for (var i = 0; i < intValue.length; i++) {
                    newHtml += '<span>' + intValue[i] + '</span>';
                }
                if (decimalValue) {
                    newHtml += '<span>.</span>';
                }
                for (var i = 0; i < decimalValue.length; i++) {
                    newHtml += '<span class="number-0">' + decimalValue[i] + '</span>';
                }
                $(this).html(newHtml);
            });
        }
        if($('div').hasClass('woocommerce-tabs')){
            const specifiedClass = document.querySelector('.woocommerce-tabs .tabs .reviews_tab');
            const isActive = specifiedClass.classList.contains('active');
            if (isActive) {
              $('.woocommerce-tabs .additional_information_tab').css({
                'border-top' : 0
            });
              $('.woocommerce-tabs .additional_information_tab').css({
                'border-bottom' : '1px solid #DBE6EE'
            });
            }
            else{
            $('.woocommerce-tabs .additional_information_tab').css({
                'border-bottom' : 0
            });
            }
        }
    }


    jQuery(document).ready(function($) {
        $('.woocommerce-widget-layered-nav .wvs-widget-item-wrapper').removeAttr('data-wvstooltip');
    });

    const images = document.querySelectorAll('.pxl-shop-item-wrap .pxl-products-thumb .image-wrap img');
    const padding_img = document.querySelectorAll('.pxl-shop-item-wrap .pxl-products-thumb .image-wrap');
    images.forEach(image => {
        if (image.src.includes('.jpg')) {
            image.classList.add('padding_0');
        }
    });

    function optione_header_sticky() {
        var offsetTop = $('.pxl-header-main').outerHeight();
        var h_header = $('.pxl-header-sticky').outerHeight();
        var offsetTopAnimation = offsetTop + 200;
        if (scroll_top > offsetTopAnimation) {
            $(document).find('.pxl-header-sticky').addClass('h-fixed');
        } else {
            $(document).find('.pxl-header-sticky').removeClass('h-fixed');
        }
        
        if (window_width > 992) {
            $('.pxl-header-sticky').css({
                'height': h_header
            });
        }
        
    }

    function optione_carosel_mobile(){
        if($('div').hasClass('pxl-related-post')){
        /*Retated Post */
            $('.pxl-related-post .pxl-related-post-inner').slick({
                dots: true,
                infinite: true,
                arrows: false,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: false,
                autoplaySpeed: 2000,
                slides_gutter: 40,
                responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        dots: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        dots: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                ]
            });
        }
        if($('section').hasClass('related')){
            $('.related .products').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                speed: 300,
                responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        dots: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        dots: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                ]
            });
        }
        if($('ol').hasClass('flex-control-nav')){
            window_width = $(window).width();
            if (window_width < 1199) {
                $('.pxl-product-page-style2 .flex-control-nav').addClass('pxl-mobile-carousel');
            } else{
                $('.pxl-product-page-style2 .flex-control-nav').removeClass('pxl-mobile-carousel');
            }

            $('.pxl-mobile-carousel').slick({
                infinite: true,
                slidesToShow: 4,
                slidesToScroll: 1,
                speed: 300,
                slides_gutter: 40,
                responsive: [
                {
                    breakpoint: 1199,
                    settings: {
                        dots: false,
                        slidesToShow: 2,
                        slidesToScroll: 1,
                    }
                },
                {
                    breakpoint: 767,
                    settings: {
                        dots: false,
                        slidesToShow: 1,
                        slidesToScroll: 1,
                    }
                },
                ]
            });
        }
    }

    /// header sticky up down Header will show when scrolling up and hide when scrolling down.

        // $('.header-sticky-up-down .pxl-header-sticky').addClass("pxl-header-sticky-up-down");
        // $('.header-sticky-up-down .pxl-header-sticky-up-down').removeClass("pxl-header-sticky");

        // if($('div').hasClass('pxl-header-sticky-up-down')){    
        //     var topHeader = document.querySelector(".pxl-header-sticky-up-down");
        //     let lastScrollPosition = 0;
        //     window.addEventListener('scroll', () => {
        //         const currentScrollPosition = window.scrollY;
        //         if (currentScrollPosition > lastScrollPosition || currentScrollPosition < 100) {
        //             topHeader.classList.remove('h-fixed');
        //         } else {
        //             topHeader.classList.add('h-fixed');
        //         }
        //         lastScrollPosition = currentScrollPosition;
        //     });
        // }

    function optione_set_height() {

        var h_header_sticky = $('.pxl-header .pxl-header-sticky-up-down').outerHeight();
        var padding_top = $('.pxl-header .pxl-header-sticky-up-down section').css('padding-top').replace(/\D/g, '');
        $('.pxl-header .pxl-primary-menu .sub-menu').css({
            'top': h_header_sticky - padding_top 
        });

        var h_height_tab = $('.pxl-product-page-style1 .woocommerce-tabs .woocommerce-Tabs-panel--description').outerHeight();
        $('.pxl-product-page-style1 .woocommerce-tabs .woocommerce-Tabs-panel').css({
            'min-height': h_height_tab
        });

        var h_related_product = $('.pxl-product-page-style1 .related.products').outerHeight();
        $('.single-product .pxl-page .bg-related-product').css({
            'min-height': h_related_product
        });

        if($('div').hasClass('pxl-tabs-vertical')){
            
            if (window.innerWidth > 991) {
                let number_content = $('.pxl-tabs-vertical .pxl-content-price #number_content_to_show')[0].innerText.trim();
                var tab_content = $('.pxl-tabs-vertical .pxl-content-price .tab-content > div');
                var h_height_tab_content = 0;
                for( let number_content_show = 0; number_content_show < number_content; number_content_show ++){
                    h_height_tab_content += tab_content[number_content_show].offsetHeight + 35;
                    $('.pxl-tabs-vertical .pxl-content-price').css({
                        'max-height': h_height_tab_content
                    });
                }
            }
            if (window.innerWidth <= 991) {
                var h_height_tab_content = $('.pxl-tabs-vertical .pxl-content-price .tab-content > div').outerHeight();
                $('.pxl-tabs-vertical .pxl-content-price').css({
                    'max-height': h_height_tab_content + 35
                });
               
            }
        
            let number_title = $('.pxl-tabs-vertical .pxl-sidebar-price #number_title_to_show')[0].innerText.trim();
            var tab_title = $('.pxl-tabs-vertical .pxl-sidebar-price .tab-title');
            var h_height_tab_title = 0;
            for( let number_title_show = 0; number_title_show < number_title; number_title_show ++){
                h_height_tab_title += tab_title[number_title_show].offsetHeight + 22;
                $('.pxl-tabs-vertical .pxl-sidebar-price .pxl-sidebar-price_content').css({
                    'max-height': h_height_tab_title + 35
                });
            }
        }
    }
    function optione_open_menu_toggle(){
        'use strict';
        //* Add toggle button to parent Menu
        $('.sub-menu .current-menu-item').parents('.menu-item-has-children').addClass('current-menu-ancestor');
        $('.is-arrow .pxl-primary-menu > li.menu-item-has-children').append('<span class="main-menu-toggle"></span>');
        $('.pxl-mobile-menu li.menu-item-has-children').append('<span class="main-menu-toggle"></span>');
        $('.main-menu-toggle').on('click', function () {
            $(this).toggleClass('open');
            $(this).parent().find('> .sub-menu').toggleClass('submenu-open');
            $(this).parent().find('> .sub-menu').slideToggle();
        });

        //* Menu Dropdown
        var $menu = $('.pxl-main-navigation');
        $menu.find('.pxl-primary-menu li').each(function () {
            var $submenu = $(this).find('> ul.sub-menu');
            if ($submenu.length == 1) {
                $(this).hover(function () {
                    if ($submenu.offset().left + $submenu.width() > $(window).width()) {
                        $submenu.addClass('back');
                    } else if ($submenu.offset().left < 0) {
                        $submenu.addClass('back');
                    }
                }, function () {
                    $submenu.removeClass('back');
                });
            }
        });
    }
    function optione_panel_mobile_menu(){
        'use strict';
        $(document).on('click','.btn-nav-mobile',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('cliked');
            $(target).toggleClass('open');
            $('body').toggleClass('side-panel-open');
        });
    }
    function optione_panel_anchor_toggle(){
        'use strict';
        $(document).on('click','.pxl-anchor.side-panel',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('cliked');
            $(target).toggleClass('open');
            $('body').toggleClass('side-panel-open');
            setTimeout(function(){
                $('.pxl-search-form input[name="s"]').focus();
            },1000);
        });
    }
    function optione_sidebar_tabs_toggle(){
        'use strict';
        $(".anchor-inner-item").first().addClass('active');
        $(document).on('click','.pxl-sidebar-tabs .anchor-link-item',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(target).addClass('active').siblings().removeClass('active');
        });
    }
    function optione_cart_toggle(){
        'use strict';
        $(document).on('click','.pxl-cart.side-panel',function(e){
            e.preventDefault();
            e.stopPropagation();
            var target = $(this).attr('data-target');
            $(this).toggleClass('cliked');
            $(target).toggleClass('open');
            $('body').toggleClass('side-panel-open');
            setTimeout(function(){
                $('.pxl-search-form input[name="s"]').focus();
            },1000);
        });
    }

    function optione_document_click(){
        $(document).on('click',function (e) {
            var target = $(e.target);
            var check = '.btn-nav-mobile';

            if (!(target.is(check)) && target.closest('.pxl-hidden-template').length <= 0 && $('body').hasClass('side-panel-open')) {
                $('.btn-nav-mobile').removeClass('cliked');
                //$('.pxl-cart-toggle').removeClass('cliked');
                $('.pxl-hidden-template').removeClass('open');
                $('body').removeClass('side-panel-open');
            }
        });
        $(document).on('click','.pxl-close',function(e){
            e.preventDefault();
            e.stopPropagation();
            $(this).closest('.pxl-hidden-template').toggleClass('open');
            $('.btn-nav-mobile').removeClass('cliked');
            // $('.pxl-cart-toggle').removeClass('cliked');
            $('body').toggleClass('side-panel-open');
        });
    }

    //* Scroll To Top
    function optione_scroll_to_top() {
        if (scroll_top < window_height) {
            $('.pxl-scroll-top').addClass('off').removeClass('on');
        }
        if (scroll_top > window_height) {
            $('.pxl-scroll-top').addClass('on').removeClass('off');
        }
        $('.pxl-scroll-top').click(function (e) {
            e.preventDefault();
            e.stopPropagation();
            $('html, body').stop().animate({scrollTop: 0}, 800);
        });
    }

    /* Back To Top With Progress Indicator */
    function backtotopIndicator() {
        var $isHome = $('body .pxl-scroll-top');
        if ($isHome.length) {
            var progressPath = document.querySelector('.pxl-progress-circle path');
            var pathLength = progressPath.getTotalLength();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
            progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
            progressPath.style.strokeDashoffset = pathLength;
            progressPath.getBoundingClientRect();
            progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
            var updateProgress = function () {
                var scroll = $(window).scrollTop();
                var height = $(document).height() - $(window).height();
                var progress = pathLength - (scroll * pathLength / height);
                progressPath.style.strokeDashoffset = progress;
            }
            updateProgress();
            $(window).scroll(updateProgress);
        }
    }

    //* Footer Fixed
    function optione_footer_fixed() {
        setTimeout(function(){
            var h_footer = $('.pxl-footer-fixed .footer-type-el').outerHeight() - 1;
            $('.pxl-footer-fixed #pxl-main').css('margin-bottom', h_footer + 'px');
        }, 600);
    }


    // nice-select
    function optione_nice_select(){
        $(".pxl-view-sort .woocommerce-ordering select").niceSelect();
        $(".form-main-1 .wpcf7-form-control-wrap select").niceSelect();
        $(".widget_text select").niceSelect();

    }

    //* Wow Animation
    function wowInit() {
        var wow = new WOW(
            {
                boxClass:     'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset:       0,          // distance to the element when triggering the animation (default is 0)
                mobile:       true,       // trigger animations on mobile devices (default is true)
                live:         true,       // act on asynchronously loaded content (default is true)
                callback:     function(box) {
                    // the callback is fired every time an animation is started
                    // the argument that is passed in is the DOM node being animated
                },
                scrollContainer: null,    // optional scroll container selector, otherwise use window,
                resetAnimation: true,     // reset animation on end (default is true)
            }
        );
        wow.init();
    }

    //* Video Popup
    function optione_magnific_popup() {
        $('a.video-play-button').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });
        /* Images Light Box - Gallery:True */
        $('.images-light-box').each(function () {
            $(this).magnificPopup({
                delegate: 'a.light-box',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-fade',
            });
        });
    }

    /* Image Effect */
        if($('.pxl-image-tilt').length){
            $('.pxl-image-tilt').each(function () {
                $(this).tilt({
                    maxTilt: 10,
                    speed: 400,
                });
            });
        }


    // FancyBox Accordion
    function optione_fancyBoxAccordion() {
        var widgetList = jQuery('.pxl-fancy-box-accordion');
        if (!widgetList.length) {
            return;
        }
        widgetList.each(function () {
            var itemClass = '.box-item';
            jQuery(this)
                .find(itemClass + ':first-child')
                .addClass('active');
            jQuery(this)
                .find(itemClass)
                .on('mouseover', function () {
                    jQuery(this).addClass('active').siblings().removeClass('active');
                });
        });
    }

    // Svg Drawing
    function optione_svgDrawing() {
        $(".svg-drawing").each(function(){
            var $selector = jQuery(this);
            $(window).scroll(function() {
                var hT = $selector.offset().top,
                    hH = $selector.outerHeight(),
                    wH = $(window).height(),
                    wS = $(this).scrollTop();
                if (wS > (hT-wH)){
                    $selector.find('.drawing').each(function () {
                        let path = $(this).get(0);
                        let length = path.getTotalLength();
                        path.style.strokeDasharray = length;
                        path.style.strokeDashoffset = length;
                    });
                    $selector.addClass('dr-start');
                }
            });

        });
    }

    function optione_shop_view_layout(){

        $(document).on('click','.pxl-view-layout .view-icon a', function(e){
            e.preventDefault();
            if(!$(this).parent('li').hasClass('active')){
                $('.pxl-view-layout .view-icon').removeClass('active');
                $(this).parent('li').addClass('active');
                $(this).parents('.pxl-content-area').find('ul.products').removeAttr('class').addClass($(this).attr('data-cls'));
            }
        });
    }

    function optione_wc_single_product_gallery(){
        'use strict';
        if(typeof $.flexslider != 'undefined'){
            $('.wc-gallery-sync').each(function() {
                var itemW      = parseInt($(this).attr('data-thumb-w')),
                    itemH      = parseInt($(this).attr('data-thumb-h')),
                    itemN      = parseInt($(this).attr('data-thumb-n')),
                    itemMargin = parseInt($(this).attr('data-thumb-margin')),
                    window_w = $(window).outerWidth(),
                    itemSpace  = itemH - itemW + itemMargin;
                var gallery_layout = window_w > 575 ? 'vertical' : 'horizontal';

                if($(this).hasClass('thumbnail-vertical')){
                    $(this).flexslider({
                        selector       : '.wc-gallery-sync-slides > .wc-gallery-sync-slide',
                        animation      : 'slide',
                        controlNav     : false,
                        directionNav   : true,
                        prevText       : '<span class="flex-prev-icon"></span>',
                        nextText       : '<span class="flex-next-icon"></span>',
                        asNavFor       : '.woocommerce-product-gallery',
                        direction      : gallery_layout,
                        slideshow      : false,
                        animationLoop  : false,
                        itemWidth      : itemW, // add thumb image height
                        itemMargin     : itemSpace, // need it to fix transform item
                        move           : 1,
                        start: function(slider){
                            var asNavFor     = slider.vars.asNavFor,
                                height       = $(asNavFor).height(),
                                height_thumb = $(asNavFor).find('.flex-viewport').height();
                            if(window_w > 575) {
                                slider.css({'max-height' : height_thumb, 'overflow': 'hidden'});
                                slider.find('> .flex-viewport > *').css({'height': height, 'width': ''});
                            }
                        }
                    });
                }
                if($(this).hasClass('thumbnail-horizontal')){
                    $(this).flexslider({
                        selector       : '.wc-gallery-sync-slides > .wc-gallery-sync-slide',
                        animation      : 'slide',
                        controlNav     : false,
                        directionNav   : true,
                        prevText       : '<span class="flex-prev-icon"></span>',
                        nextText       : '<span class="flex-next-icon"></span>',
                        asNavFor       : '.woocommerce-product-gallery',
                        slideshow      : false,
                        animationLoop  : false, // Breaks photoswipe pagination if true.
                        itemWidth      : itemW,
                        itemMargin     : itemMargin,
                        start: function(slider){

                        }
                    });
                };
            });
        }
    }

    function optione_quantity_plus_minus(){
        "use strict";
        $( ".quantity input" ).wrap( "<div class='pxl-quantity'></div>" );
        $('<span class="quantity-button quantity-down"></span>').insertBefore('.quantity input');
        $('<span class="quantity-button quantity-up"></span>').insertAfter('.quantity input');
        // contact form 7 input number
        $('<span class="pxl-input-number-spin"><span class="pxl-input-number-spin-inner pxl-input-number-spin-up"></span><span class="pxl-input-number-spin-inner pxl-input-number-spin-down"></span></span>').insertAfter('.wpcf7-form-control-wrap input[type="number"]');
    }
    function optione_ajax_quantity_plus_minus(){
        "use strict";
        $('<span class="quantity-button quantity-down"></span>').insertBefore('.quantity input');
        $('<span class="quantity-button quantity-up"></span>').insertAfter('.quantity input');
    }
    function optione_quantity_plus_minus_action(){
        "use strict";
        $(document).on('click','.quantity .quantity-button',function () {
            var $this = $(this),
                spinner = $this.closest('.quantity'),
                input = spinner.find('input[type="number"]'),
                step = input.attr('step'),
                min = input.attr('min'),
                max = input.attr('max'),value = parseInt(input.val());
            if(!value) value = 0;
            if(!step) step=1;
            step = parseInt(step);
            if (!min) min = 0;
            var type = $this.hasClass('quantity-up') ? 'up' : 'down' ;
            switch (type)
            {
                case 'up':
                    if(!(max && value >= max))
                        input.val(value+step).change();
                    break;
                case 'down':
                    if (value > min)
                        input.val(value-step).change();
                    break;
            }
            if(max && (parseInt(input.val()) > max))
                input.val(max).change();
            if(parseInt(input.val()) < min)
                input.val(min).change();
        });
        $(document).on('click','.pxl-input-number-spin-inner',function () {
            var $this = $(this),
                spinner = $this.parents('.wpcf7-form-control-wrap'),
                input = spinner.find('input[type="number"]'),
                step = input.attr('step'),
                min = input.attr('min'),
                max = input.attr('max'),value = parseInt(input.val());
            if(!value) value = 0;
            if(!step) step=1;
            step = parseInt(step);
            if (!min) min = 0;
            var type = $this.hasClass('pxl-input-number-spin-up') ? 'up' : 'down' ;
            switch (type)
            {
                case 'up':
                    if(!(max && value >= max))
                        input.val(value+step).change();
                    break;
                case 'down':
                    if (value > min)
                        input.val(value-step).change();
                    break;
            }
            if(max && (parseInt(input.val()) > max))
                input.val(max).change();
            if(parseInt(input.val()) < min)
                input.val(min).change();
        });
    }

    /* Custom Shop Page */
    $('.woocommerce .pxl-wc-img-summary.row.style1').parents('.product').addClass('pxl-product-page-style1');
    $('.woocommerce .pxl-wc-img-summary.row.style2').parents('.product').addClass('pxl-product-page-style2');

    /*column galary single product*/
    $('.pxl-product-page-style1 .style1 .pxl-single-product-gallery-wraps').addClass('col-xl-6');
    $('.pxl-product-page-style1 .style1 .pxl-single-product-gallery-wraps').removeClass('col-md-8');
    $('.pxl-product-page-style1 .style1 .pxl-single-product-summary-wrap').addClass('col-xl-6');
    $('.pxl-product-page-style1 .style1 .pxl-single-product-summary-wrap').removeClass('col-xl-4');


    var woo_tabs = $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper').clone();
    $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper').remove();
    $('.woocommerce .product.pxl-product-page-style2 .pxl-single-product-summary-wrap .summary').append(woo_tabs);

    var woo_tabs_des = $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper .woocommerce-Tabs-panel--description').clone();
    $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper .woocommerce-Tabs-panel--description').remove();
    $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper .wc-tabs .description_tab').append(woo_tabs_des);

    var woo_tabs_infor = $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper .woocommerce-Tabs-panel--additional_information').clone();
    $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper .woocommerce-Tabs-panel--additional_information').remove();
    $('.woocommerce .product.pxl-product-page-style2 .woocommerce-tabs.wc-tabs-wrapper .wc-tabs .additional_information_tab').append(woo_tabs_infor);

    var comment_form = $('.comment-respond .comment-form .comment-form-cookies-consent').clone();
    $('.comment-respond .comment-form .comment-form-cookies-consent').remove();
    $('.comment-respond .comment-form .pxl-comment-form-fields-message').append(comment_form);


    //pxl-product-page-style1
     $(".pxl-product-page-style1 .woocommerce-tabs .description_tab a").text("Description");

     const newDiv = document.createElement("div");
     newDiv.setAttribute('class', 'bg-related-product');
      $('.single-product .pxl-page .pxl-main').append(newDiv);

     ///
    // function optione_table_cart_content(){
    //     "use strict";
    //     var table = jQuery('.woocommerce-cart-form__contents'),
    //         table_head = table.find('thead');
    //     // table_head.find('.product-remove').remove();
    //     table_head.find('.product-thumbnail').remove();
    //     table_head.find('.product-name').attr('colspan',2);
    //     // table_head.find('tr').append('<th class="product-remove">&nbsp;</th>');
    // }

    function optione_table_move_column(table, selected ,from, to, remove, colspan, colspan_value) {
        "use strict";
        var rows = jQuery(selected, table);
        var cols;
        rows.each(function() {
            cols = jQuery(this).children('th, td');
            cols.eq(from).detach().insertAfter(cols.eq(to));
        });
        var rows_remove = jQuery(remove, table);
        rows_remove.each(function(){
            jQuery(this).remove(remove);
        });
        var colspan = jQuery(colspan, table);
        colspan.each(function(){
            jQuery(this).attr('colspan',colspan_value);
        });
    }

            //* Scroll Animate
    // function optione_scroll_animate() {

    //     /*scroll single product*/
    //     if($('div').hasClass('single-author-info')){
    //         var $single_if = $('.single-author-info');
    //         const middleOfScreen = $(window).height() / 2;
    //         $(window).scroll(function() {
    //             const single_ifTop = $single_if.offset().top - $(window).scrollTop();
    //             if (single_ifTop < middleOfScreen && single_ifTop > -middleOfScreen) {
    //               $single_if.addClass('in-view');
    //           } 
    //       });
    //     };
    // }

    function optione_change_span(){
        document.querySelectorAll('.related.products h2').forEach(button => button.innerHTML = '<span>' + button.textContent.trim().split('').join('</span><span>') + '</span>');
        document.querySelectorAll('.pxl-mega-menu .box-title').forEach(button => button.innerHTML = '<span>' + button.textContent.trim().split('').join('</span><span>') + '</span>');

        const mega_menu = document.querySelectorAll('.pxl-mega-menu .box-title span');

        for (let i = 0; i < mega_menu.length; i++) {
            if (mega_menu[i].innerHTML.trim() === '') {
             mega_menu[i].innerHTML = '&nbsp;';
            }
        }
        
        const delays = document.querySelectorAll('.pxl-heading-effect .wow.letter'); // Lấy tất cả các phần tử có class là 'my-class'
        let count = 0; // Khởi tạo biến đếm
        delays.forEach(element => { // Duyệt từng phần tử
          const delay = count * 0.1; // Tính toán giá trị của transition-delay cho phần tử hiện tại
          element.style.transitionDelay = delay + 's'; // Thiết lập giá trị mới cho transition-delay
          count++; // Tăng biến đếm lên 1
        });

        /*transition-delay*/
        const mainClasses = document.querySelectorAll('.pxl-heading-effect');

        mainClasses.forEach(mainClass => {
            const subClasses = mainClass.querySelectorAll('.wow.letter');
            let delay = 0;

            subClasses.forEach(subClass => {
              subClass.style.transitionDelay = delay + 's';
              delay += 0.15;
          });
        });
    }

})(jQuery);
