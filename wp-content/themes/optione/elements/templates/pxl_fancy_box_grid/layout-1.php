<?php
use Elementor\Icons_Manager;
Icons_Manager::enqueue_shim();
$default_settings = [
    'col_xxl' => '3',
    'col_xl' => '3',
    'col_lg' => '2',
    'col_md' => '2',
    'col_sm' => '2',
    'col_xs' => '1',
    'content_list' => []
];
$settings = array_merge($default_settings, $settings);
extract($settings);
$col_xxl = 'col-xxl-'.str_replace('.', '',12 / floatval( $settings['col_xxl']));
$col_xl  = 'col-xl-'.str_replace('.', '',12 / floatval( $settings['col_xl']));
$col_lg  = 'col-lg-'.str_replace('.', '',12 / floatval( $settings['col_lg']));
$col_md  = 'col-md-'.str_replace('.', '',12 / floatval( $settings['col_md']));
$col_sm  = 'col-sm-'.str_replace('.', '',12 / floatval( $settings['col_sm'])); 
$col_xs  = 'col-'.str_replace('.', '',12 / floatval( $settings['col_xs'])); 

$item_class = trim(implode(' ', ['grid-item', $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));
$grid_sizer = trim(implode(' ', [ $col_xxl, $col_xl, $col_lg, $col_md, $col_sm, $col_xs]));

$animate_cls = '';
if ( !empty( $item_animation ) ) {
    $animate_cls = ' pxl-animate pxl-invisible animated-'.$item_animation_duration;
} 
$item_animation_delay = !empty($item_animation_delay) ? $item_animation_delay : '200';
    

if(is_admin())
    $grid_class = 'pxl-grid-inner pxl-grid-masonry-adm row relative';
else
    $grid_class = 'pxl-grid-inner pxl-grid-masonry row relative';
    
?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
    <div class="pxl-grid pxl-fancy-box-grid layout-1" data-layout-mode="fitRows">
        <div class="<?php echo esc_attr($grid_class) ?>">
            <?php foreach ($content_list as $key => $value):
                $title    = isset($value['title']) ? $value['title'] : '';
                $link     = isset($value['link']) ? $value['link'] : '';  
                $style     = isset($value['style']) ? $value['style'] : '';  
                $number     = isset($value['number']) ? $value['number'] : '';
                $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
                if ( ! empty( $link['url'] ) ) {
                    $widget->add_render_attribute( $link_key, 'href', $link['url'] );

                    if ( $link['is_external'] ) {
                        $widget->add_render_attribute( $link_key, 'target', '_blank' );
                    }

                    if ( $link['nofollow'] ) {
                        $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                    }
                }
                $link_attributes = $widget->get_render_attribute_string( $link_key );

                $increase = $key + 1; 
                $data_settings = '';
                if ( !empty( $item_animation ) ) {
                    $data_animation =  json_encode([
                        'animation'      => $item_animation,
                        'animation_delay' => ((float)$item_animation_delay * $increase)
                    ]);
                    $data_settings = 'data-settings="'.esc_attr($data_animation).'"';
                }
                  $content_key = $widget->get_repeater_setting_key( 'tab_content', 'tabs_list', $key );
                $tabs_content = '';
                if($value['content_type'] == 'template'){
                    if(!empty($value['content_template'])){
                        $content = Elementor\Plugin::$instance->frontend->get_builder_content_for_display( (int)$value['content_template']);
                        $tabs_content = $content;
                        $tab_bd_ids[] = (int)$value['content_template'];
                    }
                }elseif($value['content_type'] == 'df'){
                    $tabs_content = $value['tab_content'];
                }
                $widget->add_render_attribute( $content_key, [
                    'class' => [ 'tab-content' ],
                    'id' => $element_id.'-'.$value['_id'],
                ] );
                if($value['content_type'] == 'df'){
                    $widget->add_inline_editing_attributes( $content_key, 'advanced' );
                }
                

            	?>
                <div class="<?php echo esc_attr($item_class.' '.$animate_cls); ?> grid-item-<?php echo esc_attr($increase) ?> <?php echo esc_attr($style) ?>" <?php pxl_print_html($data_settings); ?>>
                    <div class="item-inner item-wrap relative">
                        <?php if(!empty($number)) : ?>
                            <div class="item-number">
                                <span class="number-content"><?php echo pxl_print_html($number); ?></span>
                                <span class="number-hover"><?php echo pxl_print_html($number); ?></span>
                            </div>
                        <?php endif; ?>
                        <?php if(!empty($title)) : ?>
                            <div class="item-title">
                                <?php if ( ! empty( $link['url'] ) ): ?><a <?php echo implode( ' ', [ $link_attributes ] ); ?>><?php endif; ?>
                                <?php echo pxl_print_html($title); ?>
                                <?php if ( ! empty( $link['url'] ) ): ?></a><?php endif; ?>

                            </div>
                        <?php endif; ?>
                        <?php if(!empty($tabs_content)) : ?>
                        <div <?php pxl_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php pxl_print_html($tabs_content); ?></div>
                        <?php endif; ?>
                    </div>
            </div>
            <?php endforeach; ?>
            <div class="grid-sizer <?php echo esc_attr($grid_sizer); ?>"></div>
        </div>
    </div>
<?php endif; ?>
