<?php
extract($settings);

$opts = [
    'slides_to_show'                => $widget->get_setting('content_to_show'),
];
$widget->add_render_attribute( 'vertical', [
    'class'         => 'pxl-content-price swiper-container swiper-container-vertical col-12 col-lg-8',
    'dir'           => is_rtl() ? 'rtl' : 'ltr',
    'data-settings' => wp_json_encode($opts)
]);

if(count($tabs_list) > 0){
    $tab_bd_ids = [];
    ?>
    <div class="pxl-price-container ">
        <div class="pxl-price-wrap wrapper pxl-tabs-vertical row<?php echo esc_attr($template) ?>">
            <div class="pxl-sidebar-price swiper-container swiper-container-vertical col-12 col-lg-4">
                <div id="number_title_to_show" class="d-none">
                    <?php echo esc_attr(count($tabs_list)); ?>
                </div>
                <div class="pxl-sidebar-price_content">
                    <div class="list-tabs-title swiper-wrapper buttons">
                    <?php foreach ($tabs_list as $key => $tab) :
                        $title_key = $widget->get_repeater_setting_key( 'tab_title', 'tabs_list', $key );
                        $tabs_title[$title_key] = $tab['tab_title'];
                        $widget->add_inline_editing_attributes( $title_key, 'basic' );
                        $widget->add_render_attribute( $title_key, [
                            'class' => [ 'tab-title swiper-slide ' ],
                            'data-target' => '#' . $element_id.'-'.$tab['_id'],
                            'data-roller' => $key + 1,
                        ] );
                        ?>
                        <span <?php pxl_print_html($widget->get_render_attribute_string( $title_key )); ?>>
                            <?php echo pxl_print_html($tab['tab_title']); ?>
                        </span>
                    <?php endforeach; ?>
                    </div>
                </div>
            </div>
            <div <?php pxl_print_html($widget->get_render_attribute_string( 'vertical' )); ?>>
                <div id="number_content_to_show" class="d-none">
                    <?php echo esc_attr($content_to_show); ?>
                </div>
                <div class="list-tabs-content swiper-wrapper">
                    <?php foreach ($tabs_list as $key => $tab):
                        $content_key = $widget->get_repeater_setting_key( 'tab_content', 'tabs_list', $key );
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
                        $widget->add_render_attribute( $content_key, [
                            'class' => [ 'tab-content swiper-slide' ],
                            'id' => $element_id.'-'.$tab['_id'],
                            'data-roller' => $key + 1,
                        ] );
                        if($tab['content_type'] == 'df'){
                            $widget->add_inline_editing_attributes( $content_key, 'advanced' );
                        }
                        ?>
                        <div 
                            <?php pxl_print_html($widget->get_render_attribute_string( $content_key )); ?>>
                            <?php pxl_print_html($tabs_content); ?>        
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
?>