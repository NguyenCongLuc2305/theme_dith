( function( $ ) {
	var pxl_swiper_vertical_handler = function( $scope, $ ) {
        const sliderThumbs = new Swiper('.pxl-sidebar-price .pxl-sidebar-price_content', { 

            direction: 'vertical', 
            slidesPerView: 10, 
            spaceBetween: 20,
            freeMode: true, 
            allowTouchMove: false,
            
        });


        var carousel = $scope.find(".pxl-content-price");
        if(carousel.length == 0){
            return false;
        }

        var data = carousel.data(),
        settings = data.settings;

        const sliderImages = new Swiper('.pxl-content-price', { 

            direction: 'vertical', 
            slidesPerView: settings['slides_to_show'], 

            //   direction: window.innerWidth <= 991 ? 'horizontal' : 'vertical',
            slidesPerView: window.innerWidth <= 991 ? 1 : settings['slides_to_show'], 
            allowTouchMove: window.innerWidth <= 991 ? false : true, // Chỉ cho phép lướt trên màn hình laptop

            spaceBetween: 35, 
            grabCursor: true, 
            loop: true,
            thumbs: { 
                swiper: sliderThumbs, 
            },
            
        });

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


    };

    // Make sure you run this code under Elementor.
    $( window ).on( 'elementor/frontend/init', function() {
        elementorFrontend.hooks.addAction( 'frontend/element_ready/pxl_tab_vertical.default', pxl_swiper_vertical_handler );
    } );
} )( jQuery );