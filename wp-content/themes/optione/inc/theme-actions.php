<?php 
/**
 * Actions Hook for the theme
 *
 * @package Optione
 */
 
add_action('after_setup_theme', 'optione_setup');
function optione_setup(){
    //Set the content width in pixels, based on the theme's design and stylesheet.
    $GLOBALS['content_width'] = apply_filters( 'optione_content_width', 1200 );

    // Make theme available for translation.
    load_theme_textdomain( 'optione', get_template_directory() . '/languages' );

    // Custom Header
    add_theme_support( 'custom-header' );

    // Add default posts and comments RSS feed links to head.
    add_theme_support( 'automatic-feed-links' );

    // Let WordPress manage the document title.
    add_theme_support( 'title-tag' );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support( 'post-thumbnails' );

    // Set post thumbnail size.
    set_post_thumbnail_size( 1160, 436 );
    $custom_sizes = optione_configs('custom_sizes'); 
    foreach ($custom_sizes as $option => $values) {
        add_image_size( $option, $values[0], $values[1], $values[2] );
    }
   
    // This theme uses wp_nav_menu() in one location.
    register_nav_menus( array(
        'primary' => esc_html__( 'Primary', 'optione' ),
    ) );

    // Add theme support for selective refresh for widgets.
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add support for core custom logo.
    add_theme_support( 'custom-logo', array(
        'height'      => 250,
        'width'       => 250,
        'flex-width'  => true,
        'flex-height' => true,
    ) );
    // Post formats
    add_theme_support( 'post-formats', array(
        'video',
        'audio',
        'quote',
        'link',
    ) );

    // Enable support for Post Thumbnails on posts and pages.
    add_theme_support('post-thumbnails');
    add_theme_support( 'woocommerce', array(
        'thumbnail_image_width' => 768,
        'gallery_thumbnail_image_width' => 768,
        'single_image_width' => 768,
    ) );
    add_theme_support( 'wc-product-gallery-zoom' );
    add_theme_support( 'wc-product-gallery-lightbox' );
    add_theme_support( 'wc-product-gallery-slider' );
    remove_theme_support('widgets-block-editor');

}

/**
 * Register Widgets Position.
 */
add_action( 'widgets_init', 'optione_widgets_position' );
function optione_widgets_position() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'optione' ),
		'id'            => 'sidebar-blog',
		'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
		'after_widget'  => '</div></section>',
		'before_title'  => '<h3 class="widget-title"><span>',
		'after_title'   => '</span></h3>',
	) );
     
	if (class_exists('ReduxFramework') && class_exists('Pxltheme_Core')) {
		register_sidebar( array(
			'name'          => esc_html__( 'Page Sidebar', 'optione' ),
			'id'            => 'sidebar-page',
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}

	if ( class_exists( 'Woocommerce' ) ) {
		register_sidebar( array(
			'name'          => esc_html__( 'Shop Sidebar', 'optione' ),
			'id'            => 'sidebar-shop',
			'before_widget' => '<section id="%1$s" class="widget %2$s"><div class="widget-content">',
			'after_widget'  => '</div></section>',
			'before_title'  => '<h3 class="widget-title"><span>',
			'after_title'   => '</span></h3>',
		) );
	}
}

/**
 * Enqueue Styles Scripts : Front-End
 */
add_action( 'wp_enqueue_scripts', 'optione_scripts' );
function optione_scripts() {  
    /* Icons Lib */
    wp_enqueue_style( 'optione-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.0.0');
    wp_enqueue_style( 'flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css', array(), '1.0.0');
    wp_enqueue_style( 'material', get_template_directory_uri() . '/assets/fonts/material/css/font-material.min.css', array(), '1.0.0');
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/css/magnific-popup.css', array(), '1.0.0' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css', array(), '1.0.0' );
	wp_enqueue_style( 'optione-grid', get_template_directory_uri() . '/assets/css/grid.css', array(), optione()->get_version() );
	wp_enqueue_style( 'optione-style', get_template_directory_uri() . '/assets/css/style.css', array(), optione()->get_version() );
	wp_add_inline_style( 'optione-style', optione_inline_styles() );
    wp_enqueue_style( 'optione-base', get_template_directory_uri() . '/style.css', array(), optione()->get_version() );
	wp_enqueue_style( 'optione-google-fonts', optione_fonts_url(), array(), null );
    wp_enqueue_script( 'nice-select', get_template_directory_uri() . '/assets/js/jquery.nice-select.min.js', array( 'jquery' ), '1.3.0', true );
    wp_enqueue_style( 'optione-gsap', get_template_directory_uri() . '/assets/js/gsap.min.js', array(), optione()->get_version() );


    wp_enqueue_script( 'tilt', get_template_directory_uri() . '/assets/js/tilt.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/js/magnific-popup.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/assets/js/wow.min.js', array( 'jquery' ), '1.3.0', true );
    wp_enqueue_script( 'slick-min', get_template_directory_uri() . '/assets/js/slick.min.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'easy-pie-chart-lib', get_template_directory_uri() . '/assets/js/easy-pie-chart.js', array( 'jquery' ), '1.0.0', true );
    wp_enqueue_script( 'optione-main', get_template_directory_uri() . '/assets/js/theme.js', array( 'jquery' ), optione()->get_version(), true );
    wp_enqueue_script( 'optione-cursor', get_template_directory_uri() . '/assets/js/cursor.js', array( 'jquery' ), '1.0.0', true );
    wp_localize_script( 'optione-main', 'main_data', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    $smoothscroll = optione()->get_theme_opt( 'smoothscroll', false );
    if(isset($smoothscroll) && $smoothscroll) {
        wp_enqueue_script('optione-customizer', get_template_directory_uri() . '/assets/js/customizer.js', array('jquery'), '1.0.0', true);
    }
    do_action( 'optione_scripts');
}

/**
 * Enqueue Styles Scripts : Back-End
 */
add_action('admin_enqueue_scripts', 'optione_admin_style');
function optione_admin_style() {
    wp_enqueue_style('optione-admin', get_template_directory_uri() . '/assets/css/admin.css', array(), '1.0.0');
    wp_enqueue_style('optione-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.0.0');
    wp_enqueue_style('flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css', array(), '1.0.0');
    wp_enqueue_style('material', get_template_directory_uri() . '/assets/fonts/material/css/font-material.min.css', array(), '1.0.0');
    wp_enqueue_script( 'admin-widget', get_template_directory_uri() . '/inc/admin/assets/js/widget.js', array( 'jquery' ), array( 'jquery' ), '1.0.0', true );
}

add_action( 'elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_style( 'optione-custom-editor', get_template_directory_uri() . '/assets/css/custom-editor.css', array(), '1.0.0' );
    wp_enqueue_style( 'admin-optione-icon', get_template_directory_uri() . '/assets/fonts/pixelart/style.css', array(), '1.0.0' );
    wp_enqueue_style( 'admin-flaticon', get_template_directory_uri() . '/assets/fonts/flaticon/css/flaticon.css', array(), '1.0.0' );
    wp_enqueue_style( 'admin-material', get_template_directory_uri() . '/assets/fonts/material/css/font-material.min.css', array(), '1.0.0' );
} );

//* Favicon
add_action('wp_head', 'optione_site_favicon');
function optione_site_favicon(){
    $favicon = optione()->get_theme_opt( 'favicon' );
    if(!empty($favicon['url']))
        echo '<link rel="icon" type="image/png" href="'.esc_url($favicon['url']).'"/>';
}

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
add_action( 'wp_head', 'optione_pingback_header' );
function optione_pingback_header(){
    if ( is_singular() && pings_open() )
    {
        echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
    }
}

add_action( 'elementor/preview/enqueue_styles', 'optione_add_editor_preview_style' );
function optione_add_editor_preview_style(){
    wp_add_inline_style( 'editor-preview', optione_editor_preview_inline_styles() );
}
function optione_editor_preview_inline_styles(){
    $theme_colors = optione_configs('theme_colors');
    ob_start();
        echo '.elementor-edit-area-active{';
            foreach ($theme_colors as $color => $value) {
                printf('--%1$s-color: %2$s;', str_replace('#', '',$color),  $value['value']);
            }
        echo '}';
    return ob_get_clean();
}

/**
 * Add field subtitle to post.
 */
add_action( 'edit_form_after_title', 'optione_add_subtitle_field' );
function optione_add_subtitle_field() {
	global $post;

	$screen = get_current_screen();

	if ( in_array( $screen->id, array( 'acm-post' ) ) ) {

		$value = get_post_meta( $post->ID, 'post_subtitle', true );

		echo '<div class="subtitle"><input type="text" name="post_subtitle" value="' . esc_attr( $value ) . '" id="subtitle" placeholder = "' . esc_attr__( 'Subtitle', 'optione' ) . '" style="width: 100%;margin-top: 4px;"></div>';
	}
}

add_action('wp_footer', 'optione_backtotop',2);
function optione_backtotop($args = []){
    $back_totop_on = optione()->get_theme_opt('back_totop_on', true);
    if ('1' !== $back_totop_on) return;
    ?>
    <a href="javascript:void(0);" class="pxl-scroll-top"> 
        <svg class="pxl-progress-circle" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </a>
<?php 
} 

add_action( 'pxltheme_anchor_target', 'optione_hook_anchor_side_mobile_default');
function optione_hook_anchor_side_mobile_default(){
    $header_mobile_layout = (int)optione()->get_opt('header_mobile_layout'); 
    if( $header_mobile_layout > 0 ) return;
    ?>
    <nav class="pxl-hidden-template pos-left pxl-side-mobile">
        <div class="pxl-panel-header">
            <div class="panel-header-inner">
                <a href="#" class="pxl-close" data-target=".pxl-side-mobile" title="<?php echo esc_attr__( 'Close', 'optione' ) ?>"></a>
            </div>
        </div> 
        <div class="pxl-panel-content custom_scroll">
            <div class="menu-main-container-wrap">
                <div id="mobile-menu-container" class="menu-main-container">
                    <?php 
                        if ( has_nav_menu( 'primary' ) ){
                            wp_nav_menu( 
                                array(
                                    'theme_location' => 'primary',
                                    'container'      => '',
                                    'menu_id'        => 'pxl-mobile-menu',
                                    'menu_class'     => 'pxl-mobile-menu clearfix',
                                    'link_before'    => '<span class="pxl-menu-title">',
                                    'link_after'     => '</span>',  
                                    'walker'         => '',
                                ) 
                            );
                        }else{
                            printf(
                                '<ul class="pxl-mobile-menu pxl-primary-menu primary-menu-not-set"><li><a href="%1$s">%2$s</a></li></ul>',
                                esc_url( admin_url( 'nav-menus.php' ) ),
                                esc_html__( 'Create New Menu', 'optione' )
                            );
                        }
                    ?>
                </div>
            </div>
        </div>
    </nav>
    <?php 
}

add_action( 'pxltheme_anchor_target', 'optione_hook_anchor_templates_hidden_panel');
function optione_hook_anchor_templates_hidden_panel(){

    $hidden_templates = optione_get_templates_slug('hidden-panel');
    if(empty($hidden_templates)) return;
    foreach ($hidden_templates as $slug => $values){
        $args = [
            'slug' => $slug,
            'post_id' => $values['post_id'],
            'position' => !empty($values['position']) ? $values['position'] : 'custom-pos'
        ];
        if( did_action('pxl_anchor_target_hidden_panel_'.$values['post_id']) <= 0){
            do_action( 'pxl_anchor_target_hidden_panel_'.$values['post_id'], $args );
        }
    }
}

function optione_hook_anchor_hidden_panel($args){
    ?>
    <div class="pxl-hidden-template pxl-hidden-template-<?php echo esc_attr($args['post_id'])?> pos-<?php echo esc_attr($args['position']) ?>">
        <div class="pxl-hidden-template-wrap">
            <div class="pxl-panel-header">
                <div class="panel-header-inner">
                    <a href="#" class="pxl-close" title="<?php echo esc_attr__( 'Close', 'optione' ) ?>"></a>
                </div>
            </div>
            <div class="pxl-panel-content custom_scroll">
                <?php echo Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$args['post_id']); ?>
            </div>
        </div>
    </div>
    <?php
}
function optione_hook_anchor_custom(){
    return;
}

add_action( 'pxltheme_anchor_target', 'optione_header_popup_cart');
function optione_header_popup_cart(){  
    if(!class_exists('Woocommerce')) return;
    ?>
    <div class="pxl-hidden-template pxl-side-cart">
        <div class="pxl-hidden-template-wrap">
            <div class="pxl-panel-header">
                <div class="panel-header-inner">
                    <h3 class="cart-title"><?php echo esc_html__( 'Shopping Cart', 'optione' ) ?></h3>
                    <a href="#" class="pxl-close" title="<?php echo esc_attr__( 'Close', 'optione' ) ?>"></a>
                </div>
            </div>
            <div class="pxl-side-panel-content widget_shopping_cart custom_scroll">
                <div class="widget_shopping_cart_content">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}

//* Custom archive link
function pxl_custom_archive_post_type_link() {
    $pxl_case_study_archive_link = optione()->get_theme_opt('pxl_case_study_archive_link', '');
    $pxl_service_archive_link = optione()->get_theme_opt('pxl_service_archive_link', '');
    if( is_post_type_archive( 'pxl-case-study' ) && !empty($pxl_case_study_archive_link) ) {
        wp_redirect( $pxl_case_study_archive_link, 301 );
        exit();
    }
    if( is_post_type_archive( 'pxl-service' ) && !empty($pxl_service_archive_link) ) {
        wp_redirect( $pxl_service_archive_link, 301 );
        exit();
    }
}
add_action( 'template_redirect', 'pxl_custom_archive_post_type_link' );