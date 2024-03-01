<?php
/**
 * Shop Columns.
 */
add_filter( 'loop_shop_columns', 'optione_loop_shop_columns', 20 );
function optione_loop_shop_columns() {
    $columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : optione()->get_theme_opt('products_columns', 3);
    return $columns;
}

/* Number of products per page (shop page) */
add_filter( 'loop_shop_per_page', 'optione_loop_shop_per_page', 20 );
function optione_loop_shop_per_page( $limit ) {
    $limit = optione()->get_theme_opt('product_per_page', 12);
    return $limit;
}

/* Modify image width theme support. */
add_filter('woocommerce_get_image_size_gallery_thumbnail', function ($size) {
    $size['width'] = 768;
    $size['height'] = 920;
    $size['crop'] = 1;
    return $size;
});

/*Resizing Shop Page Product Thumbnail Image*/
add_theme_support( 'woocommerce', apply_filters( 'storefront_woocommerce_args', array(
   'single_image_width' => 416,
   'thumbnail_image_width' => 324,
   'product_grid' => array(
      'default_columns' => 3,
      'default_rows' => 4,
      'min_columns' => 1,
      'max_columns' => 6,
      'min_rows' => 1
   )
)));

add_filter( 'storefront_woocommerce_args', 'bbloomer_resize_storefront_images' );
 
function bbloomer_resize_storefront_images( $args ) {
   $args['single_image_width'] = 999;
   $args['thumbnail_image_width'] = 222;
   return $args;
}
//
add_filter('single_product_archive_thumbnail_size', 'optione_woocommerce_product_size');
function optione_woocommerce_product_size($size){
    $size = 'full';
    return $size;
}

/*Enable breadcrumb*/

if ( ! function_exists( 'woocommerce_breadcrumb_cus' ) ) {
    function woocommerce_breadcrumb_cus( $args = array() ) {
        $args = wp_parse_args(
            $args,
            apply_filters(
                'woocommerce_breadcrumb_defaults',
                array(
                    'delimiter'   => '&nbsp; <i class="far fa-dot-circle"></i> &nbsp;',
                    'wrap_before' => '<nav class="pxl-breadcrumb-cus">',
                    'wrap_after'  => '</nav>',
                    'before'      => '',
                    'after'       => '',
                    'home'        => _x( 'Home', 'breadcrumb', 'optione' ),
                )
            )
        );  
        $breadcrumbs = new WC_Breadcrumb();

        if ( ! empty( $args['home'] ) ) {
            $breadcrumbs->add_crumb( $args['home'], apply_filters( 'woocommerce_breadcrumb_home_url', home_url() ) );
        }

        $args['breadcrumb'] = $breadcrumbs->generate();

        /**
         * WooCommerce Breadcrumb hook
         *
         * @hooked WC_Structured_Data::generate_breadcrumblist_data() - 10
         */
        do_action( 'woocommerce_breadcrumb', $breadcrumbs, $args );

        wc_get_template( 'global/breadcrumb.php', $args );
    }
}
add_action( 'woocommerce_before_single_product_summary', 'woocommerce_breadcrumb_cus', 5 );

/* Remove page title on archive page */
add_filter('woocommerce_show_page_title', function(){ return false;});



/* Add and Remove function hook in woocommerce/templates/content-product.php */
function optione_woocommerce_remove_loop_function() {
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
    remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash', 10);
    remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
    remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
}
add_action( 'init', 'optione_woocommerce_remove_loop_function' );

/* Custom Top table: catalog order and result count */
if(!function_exists('optione_woocommerce_catalog_result')){
    // remove
    remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
    remove_action('woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);
    // add back
    add_action('woocommerce_before_shop_loop','optione_woocommerce_catalog_result', 20);
    add_action('optione_woocommerce_catalog_ordering', 'woocommerce_catalog_ordering');
    add_action('optione_woocommerce_result_count', 'woocommerce_result_count');
    function optione_woocommerce_catalog_result(){
        $columns = isset($_GET['col']) ? sanitize_text_field($_GET['col']) : optione()->get_theme_opt('products_columns', '2');
        $display_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : optione()->get_theme_opt('shop_display_type', 'grid');
        $active_grid = 'active';
        $active_list = '';
        if( $display_type == 'list' ){
            $active_list = $display_type == 'list' ? 'active' : '';
            $active_grid = '';
        }
        ?>
        <div class="pxl-shop-topbar-wrap row justify-content-between align-items-center g-30">
            <div class="pxl-view-layout-wrap col-12 col-sm-auto order-md-3">
                <ul class="pxl-view-layout d-flex align-items-center">
                    <li class="lbl"><?php echo esc_html__( 'View','optione' ) ?></li>
                    <li class="view-icon view-grid <?php echo esc_attr($active_grid) ?>"><a href="javascript:void(0);" class="pxl-ttip tt-top-left" data-cls="products columns-<?php echo esc_attr($columns);?>" data-col="grid"><span class="tt-txt"><?php echo esc_html__('View Grid','optione') ?></span><span class="pxli-grid"></span></a></li>
                    <li class="view-icon view-list <?php echo esc_attr($active_list) ?>"><a href="javascript:void(0);" class="pxl-ttip tt-top-left" data-cls="products shop-view-list" data-col="list"><span class="tt-txt"><?php echo esc_html__('View List','optione') ?></span><span class="pxli-list"></span></a></li>
                </ul>
            </div>
            <div class="pxl-view-sort col-12 col-sm-auto order-md-2">
                <?php do_action('optione_woocommerce_catalog_ordering'); ?>
            </div>
            <div class="col text-heading number-result">
                <?php do_action('optione_woocommerce_result_count'); ?>
            </div>
        </div>
        <?php
    }
}

/* Loop Start */
add_filter( 'woocommerce_product_loop_start', 'optione_product_loop_start' );
function optione_product_loop_start(){
	$display_type = isset($_GET['type']) ? sanitize_text_field($_GET['type']) : optione()->get_theme_opt('shop_display_type', 'grid');
	if( $display_type == 'list')
		return '<ul class="products shop-view-list">';
	else
		return '<ul class="products columns-'. esc_attr( wc_get_loop_prop( 'columns' ) ) .'">';
}



/*change title related product*/
add_filter('woocommerce_product_related_products_heading',function(){
   return 'These would Look Good';
});


/// fkslhfjse

function woocommerce_get_product_related_aaa_thumbnail( $size = 'full', $attr = array(), $placeholder = true ) {
    global $product;

    if ( ! is_array( $attr ) ) {
        $attr = array();
    }

    if ( ! is_bool( $placeholder ) ) {
        $placeholder = true;
    }

    $image_size = apply_filters( 'single_product_archive_thumbnail_size', $size );
    return $product ? $product->get_image( $image_size, $attr, $placeholder ) : '';
}

/* Show Product in Loop */
if(!function_exists('optione_woocommerce_product_loop_item')){
    add_filter( 'woocommerce_after_shop_loop_item', 'optione_woocommerce_product_loop_item' );
    function optione_woocommerce_product_loop_item() {
        global $product;
        ?>
        <div class="pxl-shop-item-wrap">
            <div class="pxl-products-thumb relative">
                <div class="image-wrap">
                    <?php echo woocommerce_get_product_related_aaa_thumbnail();?>
                </div>
                <?php
                if ( $product->is_featured() ) {
                    $feature_text = get_post_meta($product->get_id(),'product_feature_text', true);
                    if (empty($feature_text)){
                        $feature_text = "NEW";
                    }
                    ?>
                    <span class="pxl-featured"><?php echo esc_html($feature_text); ?></span>
                    <?php
                }
                woocommerce_show_product_loop_sale_flash();
                ?>
                <div class="pxl-add-to-cart">
                    <?php woocommerce_template_loop_add_to_cart(); ?>
                </div>
                <?php
                ?>
            </div>
            <div class="pxl-products-content">
                <div class="pxl-products-content-wrap">
                    <div class="pxl-products-content-inner">
                        <h3 class="pxl-product-title">
                            <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
                        </h3>
                        <div class="top-content-inner d-md-flex gx-30 justify-content-between">
                            <?php
                            woocommerce_template_loop_price();
                            if( class_exists( 'WPCleverWoosc' ) || class_exists( 'WPCleverWoosq' ) || class_exists( 'WPCleverWoosw' )){
                                echo '<div class="pxl-shop-woosmart-wrap">';
                                do_action( 'woosw_button_position_archive_woosmart' );
                                echo '</div>';
                            }
                            ?>
                        </div>                       
                    </div>
                </div>
            </div>
            <div class="pxl-products-content-list-view d-none">
                <?php woocommerce_template_loop_price(); ?>
                <h3 class="pxl-product-title">
                    <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
                </h3>
                <div class="list-view-rating">
                    <?php woocommerce_template_loop_rating(); ?>
                    <?php
                    if( class_exists( 'WPCleverWoosc' ) || class_exists( 'WPCleverWoosq' ) || class_exists( 'WPCleverWoosw' )){
                        echo '<div class="pxl-shop-woosmart-wrap">';
                        do_action( 'woosw_button_position_archive_woosmart' );
                        echo '</div>';
                    }
                    ?>
                </div>
                <div class="pxl-loop-product-excerpt">
                    <?php the_excerpt(); ?>
                </div>
                <?php woocommerce_template_loop_add_to_cart(); ?>
            </div>
        </div>
    <?php }
}

/* Cart Button */
add_filter('woocommerce_loop_add_to_cart_link', 'optione_woocommerce_loop_add_to_cart_link', 10, 3);
function optione_woocommerce_loop_add_to_cart_link($button, $product, $args){
    return sprintf(
        '<a href="%s" data-quantity="%s" class="pxl-btn %s" %s><span class="pxl-btn-text">%s</span></a>',
        esc_url( $product->add_to_cart_url() ),
        esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
        esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
        isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
        esc_html( $product->add_to_cart_text() ),
    );
}

/* Paginate links */
add_filter('woocommerce_pagination_args', 'optione_woocommerce_pagination_args');
function optione_woocommerce_pagination_args($default){
    $default = array_merge($default, [
        'prev_text' => '<span class="pxli-angle-left"></span>',
        'next_text' => '<span class="pxli-angle-right"></span>',
        'type'      => 'plain',
    ]);
    return $default;
}


add_filter('woocommerce_sale_flash', 'ds_change_sale_text');
function ds_change_sale_text() {
return '<span class="onsale">Sale</span>';
}


add_filter( 'woocommerce_dropdown_variation_attribute_options_args', 'custom_wc_dropdown_variation_attribute_options_args', 10 );
function custom_wc_dropdown_variation_attribute_options_args( $args ) {
    $args['id'] = 'product_' . rand();
    return $args;
}


