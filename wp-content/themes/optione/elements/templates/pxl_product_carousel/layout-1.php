<?php
extract($settings);
$html_id = pxl_get_element_id($settings);
$query_type = $widget->get_setting('query_type', 'recent_product');
$post_per_page = $widget->get_setting('post_per_page', 8);
$product_ids = $widget->get_setting('product_ids', '');
$categories = $widget->get_setting('taxonomies', '');
$categories_exclude = $widget->get_setting('taxonomies_exclude', '');
$param_args = [];

$loop = optione_woocommerce_query($query_type, $post_per_page, $product_ids, $categories, $param_args);
extract($loop);

$arrows = $widget->get_setting('arrows', 'false');
$arrows_on_hover_cls = $arrows_on_hover == 'true' ? 'arrow-on-hover' : '';
$dots = $widget->get_setting('dots', 'false');

$opts = [
    'slide_direction'               => 'horizontal',
    'slide_percolumn'               => '1',
    'slide_mode'                    => 'slide',
    'slides_to_show_xxl'            => $widget->get_setting('col_xxl', '4'),
    'slides_to_show'                => $widget->get_setting('col_xl', '3'),
    'slides_to_show_lg'             => $widget->get_setting('col_lg', '3'),
    'slides_to_show_md'             => $widget->get_setting('col_md', '2'),
    'slides_to_show_sm'             => $widget->get_setting('col_sm', '2'),
    'slides_to_show_xs'             => $widget->get_setting('col_xs', '1'),
    'slides_to_scroll'              => $widget->get_setting('slides_to_scroll', '1'),
    'slides_gutter'                 => (int)$widget->get_setting('space_between', '40'),
    'arrow'                         => $arrows,
    'dots'                          => $dots,
    'dots_style'                    => 'bullets',
    'autoplay'                      => $widget->get_setting('autoplay', 'false'),
    'pause_on_hover'                => $widget->get_setting('pause_on_hover', 'true'),
    'pause_on_interaction'          => 'true',
    'delay'                         => $widget->get_setting('autoplay_speed', '5000'),
    'loop'                          => $widget->get_setting('infinite', 'false'),
    'speed'                         => $widget->get_setting('speed', '500')
];

$layout               = $widget->get_setting('layout', '1');
$item_animation          = $widget->get_setting('item_animation', '');
$item_animation_duration = $widget->get_setting('item_animation_duration', 'normal');
$item_animation_delay    = $widget->get_setting('item_animation_delay', '150');

$widget->add_render_attribute('carousel', [
    'class'         => 'pxl-swiper-container',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

$data_animation = [];
$animate_cls = '';
if (!empty($item_animation)) {
    $animate_cls = ' pxl-animate pxl-invisible animated-' . $item_animation_duration;
    $data_animation['animation'] = $item_animation;
    $data_animation['animation_delay'] = $item_animation_delay;
}

if ($total <= 0) {
    echo '<div class="pxl-no-post-grid">' . esc_html__('No Product Found', 'optione') . '</div>';
    return;
}
?>

<div class="pxl-swiper-slider pxl-product pxl-product-carousel layout-1">
    <div class="pxl-swiper-slider-wrap pxl-carousel-inner overflow-hidden">
        <div <?php pxl_print_html($widget->get_render_attribute_string('carousel')); ?>>
            <div class="pxl-swiper-wrapper swiper-wrapper">
                <?php
                $d = 0;
                while ($posts->have_posts()) {
                    $posts->the_post();
                    global $product;
                    $d++;
                    $term_list = array();
                    $term_of_post = wp_get_post_terms($product->get_ID(), 'product_cat');
                    foreach ($term_of_post as $term) {
                        $term_list[] = $term->slug;
                    }
                    $filter_class = implode(' ', $term_list);
                    if (!empty($data_animation)) {
                        $data_animation['animation_delay'] = ((float)$item_animation_delay * $d);
                        $data_animations = json_encode($data_animation);
                        $data_settings = 'data-settings="' . esc_attr($data_animations) . '"';
                    }
                    if (!wc_review_ratings_enabled()) {
                        return;
                    }

                    $review_count = $product->get_review_count();
                   $product_attributes = $product->get_attributes();

                ?>
                    <div class="pxl-swiper-slide swiper-slide wvs-archive-product-wrapper">
                        <div class="pxl-shop-item-wrap">
                            <div class="pxl-products-thumb relative">
                                <?php 
                                    if ( $product->is_on_sale() ) : ?>
                                        <?php echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . esc_html__( 'Sale!', 'optione') . '</span>', $product ); ?>
                                        <?php
                                    endif;
                                ?>
                                <a class="image-wrap" href="<?php the_permalink(); ?>">
                                    <?php woocommerce_template_loop_product_thumbnail(); ?>
                                </a>
                                <div class="woocommerce-add-to-cart">
                                    <?php woocommerce_template_loop_add_to_cart(); ?> 
                                </div>
                                
                            </div>
                           <div class="pxl-products-content">
                               <div class="pxl-products-content-wrap">
                                   <div class="pxl-products-content-inner">
                                       <h3 class="pxl-product-title">
                                           <a href="<?php the_permalink(); ?>" ><?php the_title(); ?></a>
                                       </h3>
                                        <?php if($review_count > 0) : ?>
                                            <div class="woocommerce-product-rating">
                                                <?php woocommerce_template_loop_rating(); ?>
                                                <a href="#reviews" class="woocommerce-review-link pxl-scroll-down" rel="nofollow"><?php printf(_n('(%s Review)', '(%s Reviews)', $review_count, 'optione'), '<span class="count">' . esc_html($review_count) . '</span>'); ?></a>
                                            </div>
                                        <?php endif; ?>
                                       <div class="price-content-inner d-md-flex gx-30 justify-content-between">
                                           <?php
                                                woocommerce_template_loop_price(); 
                                            ?>
                                       </div>
                                   </div>
                               </div>
                           </div>
                            <div class="d-none product-carousel-none">
                                <?php ?>
                                <?php 
                                    do_action( 'woocommerce_before_shop_loop_item' );
                                    do_action( 'woocommerce_before_shop_loop_item_title' );
                                    do_action( 'woocommerce_shop_loop_item_title' );
                                    do_action( 'woocommerce_after_shop_loop_item_title' );
                                    do_action( 'woocommerce_after_shop_loop_item' );
                                ?>
                            </div> 
                        </div> 
                    </div>
                <?php
                }
                ?>
            </div>
            <?php wp_reset_postdata(); ?>
        </div>
        <?php if ($arrows !== 'false') : ?>
            <div class="pxl-swiper-arrows nav-out-vertical <?php echo esc_attr($arrows_on_hover_cls) ?>">
                <div class="pxl-swiper-arrow pxl-swiper-arrow-prev"><span class="pxl-icon pxli-arrow-left"></span></div>
                <div class="pxl-swiper-arrow pxl-swiper-arrow-next"><span class="pxl-icon pxli-arrow-right"></span></div>
            </div>
        <?php endif; ?>
        <?php if ($dots !== 'false') : ?>
            <div class="pxl-swiper-dots"></div>
        <?php endif; ?>
    </div>
</div>