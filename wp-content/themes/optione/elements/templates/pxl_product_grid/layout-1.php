<?php 
$html_id = pxl_get_element_id($settings);
$query_type = $widget->get_setting('query_type', 'recent_product');
$post_per_page = $widget->get_setting('post_per_page', 8);
$product_ids = $widget->get_setting('product_ids', '');
$categories = $widget->get_setting('taxonomies', '');
$categories_exclude = $widget->get_setting('taxonomies_exclude', '');
$param_args=[];
 

$loop = optione_woocommerce_query($query_type,$post_per_page,$product_ids,$categories,$param_args);
extract($loop);
extract($settings);

$layout               = $widget->get_setting('layout', '1');
$filter_default_title = $widget->get_setting('filter_default_title', 'Shop All');
$filter               = $widget->get_setting('filter', 'false');
$pagination_type      = $widget->get_setting('pagination_type', 'false');
$layout_mode          = $widget->get_setting('layout_mode', 'fitRows');

$item_animation          = $widget->get_setting('item_animation', '') ;
$item_animation_duration = $widget->get_setting('item_animation_duration', 'normal');
$item_animation_delay    = $widget->get_setting('item_animation_delay', '150');  



$load_more = array(
    'layout'             => $layout,
    'query_type'         => $query_type,
    'product_ids'        => $product_ids,
    'categories'         => $categories,
    'param_args'         => $param_args,
    'startPage'          => $paged,
    'maxPages'           => $max,
    'total'              => $total,
    'limit'              => $post_per_page, 
    'nextLink'           => $next_link,
    'layout_mode'         => $layout_mode,
    'filter'              => $filter,
    'item_animation'          => $item_animation ,
    'item_animation_duration' => $item_animation_duration,  
    'item_animation_delay'    => $item_animation_delay, 
    'col_xs'                  => $widget->get_setting('col_xs', '1'),
    'col_sm'                  => $widget->get_setting('col_sm', '2'),  
    'col_md'                  => $widget->get_setting('col_md', '2'), 
    'col_lg'                  => $widget->get_setting('col_lg', '3'),
    'col_xl'                  => $widget->get_setting('col_xl', '4'),  
    'col_xxl'                 => $widget->get_setting('col_xxl', '4')
);

$widget->add_render_attribute( 'wrapper', [
    'id'               => $html_id,
    'class'            => trim('pxl-grid pxl-product-grid layout-'.$layout),
    'data-layout-mode' => $layout_mode,
    'data-start-page'  => $paged,
    'data-max-pages'   => $max,
    'data-total'       => $total,
    'data-perpage'     => $post_per_page,
    'data-next-link'   => $next_link
]);
 
if(is_admin())
    $grid_class = 'pxl-grid-inner pxl-grid-masonry-adm row relative';
else
    $grid_class = 'pxl-grid-inner pxl-grid-masonry row relative';

$widget->add_render_attribute( 'grid', 'class', $grid_class);
 
if( $total <= 0){
    echo '<div class="pxl-no-post-grid">'.esc_html__( 'No Post Found', 'optione' ). '</div>';
    return;
}
 
$col_xxl = 'col-xxl-'.str_replace('.', '',12 / floatval( $settings['col_xxl']));
$col_xl  = 'col-xl-'.str_replace('.', '',12 / floatval( $settings['col_xl']));
$col_lg  = 'col-lg-'.str_replace('.', '',12 / floatval( $settings['col_lg']));
$col_md  = 'col-md-'.str_replace('.', '',12 / floatval( $settings['col_md']));
$col_sm  = 'col-sm-'.str_replace('.', '',12 / floatval( $settings['col_sm'])); 
$col_xs  = 'col-'.str_replace('.', '',12 / floatval( $settings['col_xs'])); 

$item_class = trim(implode(' ', ['grid-item wvs-archive-product-wrapper', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

$data_animation = []; 
$animate_cls = '';
$data_settings = '';
if ( !empty( $item_animation ) ) {
    $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
    $data_animation['animation'] = $item_animation;
    $data_animation['animation_delay'] = $item_animation_delay;
}
 
?>

<div <?php pxl_print_html($widget->get_render_attribute_string( 'wrapper' )) ?>>
    <div class="pxl-grid-overlay"></div>
    <?php if ($filter == "true" && !empty($categories) ): ?>
        <div class="grid-filter-wrap d-flex">
            <span class="filter-item active" data-filter="*"><?php echo esc_html($filter_default_title); ?></span>
            <?php foreach ($categories as $category): ?>
                <?php $term = get_term_by('slug',$category, 'product_cat'); ?>
                <span class="filter-item" data-filter="<?php echo esc_attr('.' . $term->slug); ?>">
                    <?php echo esc_html($term->name); ?>
                </span>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div <?php pxl_print_html($widget->get_render_attribute_string('grid')); ?>> 
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

                if ( !empty( $data_animation ) ) { 
                    $data_animation['animation_delay'] = ((float)$item_animation_delay * $d);
                    $data_animations = json_encode($data_animation);
                    $data_settings = 'data-settings="'.esc_attr($data_animations).'"';
                }
                if(count($tabs_list) > 0){
                    $tab_bd_ids = [];
                    foreach ($tabs_list as $key => $tab){
                        $tabs_content = '';
                        if($tab['content_type'] == 'template'){
                            if(!empty($tab['content_template'])){
                                $content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$tab['content_template']);
                                $tabs_content = $content;
                                $tab_bd_ids[] = (int)$tab['content_template'];
                            }
                        }elseif($tab['content_type'] == 'df'){
                            $tabs_content = $tab['tab_content'];
                        }
                        if($d == $tab['tab_title']) {
                            echo '<div class="grid-item col-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">'; 
                                    pxl_print_html($tabs_content);
                            echo '</div>';
                            $d++;
                        }
                    }
                }
               
                ?>
                <div class="<?php echo trim(implode(' ', [$item_class, $filter_class, $animate_cls])); ?>" <?php pxl_print_html($data_settings); ?>>
                    <?php
                        do_action( 'woocommerce_before_shop_loop_item' );
                        do_action( 'woocommerce_before_shop_loop_item_title' );
                        do_action( 'woocommerce_shop_loop_item_title' );
                        do_action( 'woocommerce_after_shop_loop_item_title' );
                        do_action( 'woocommerce_after_shop_loop_item' );
                    ?>
                </div>
            <?php 
            }  
         
            if($layout_mode == 'masonry')
                echo '<div class="grid-sizer '.$item_class.'"></div>';
        ?>
        <?php wp_reset_postdata(); ?>
    </div>
    

    <?php if ($pagination_type == 'pagination') { ?>
        <div class="pxl-grid-pagination pagin-product d-flex" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-query="<?php echo esc_attr(json_encode($args)); ?>">
            <?php optione()->page->get_pagination($query, true); ?>
        </div>
    <?php } ?>
    <?php if (!empty($next_link) && $pagination_type == 'loadmore'): 
        ?>
        <div class="pxl-load-more product d-flex" data-loadmore="<?php echo esc_attr(json_encode($load_more)); ?>" data-loading-text="<?php echo esc_attr__('Loading', 'optione') ?>" data-loadmore-text="<?php echo esc_html($settings['loadmore_text']); ?>">
            <span class="pxl-btn btn-product-grid-loadmore right">
                <span class="btn-icon pxl-icon right flaticon flaticon-next"></span>
                <span class="btn-text"><?php echo esc_html($settings['loadmore_text']); ?></span>
                <span class="pxl-btn-icon pxli-spinner"></span>
            </span>
        </div>
    <?php endif; ?>
</div>