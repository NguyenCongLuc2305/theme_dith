<?php
extract($settings);

if(count($tabs_list) > 0){
	$tab_bd_ids = [];
    ?>
    <div class="pxl-tabs">
        <div class="tabs-content">
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
                    'class' => [ 'tab-content' ],
                    'id' => $element_id.'-'.$tab['_id'],
                ] );
                if($tab['content_type'] == 'df'){
                    $widget->add_inline_editing_attributes( $content_key, 'advanced' );
                }
                if($active_tab == $key + 1){
                    $widget->add_render_attribute( $content_key, 'class', 'active');
                }
                ?>
                <div <?php pxl_print_html($widget->get_render_attribute_string( $content_key )); ?>><?php pxl_print_html($tabs_content); ?></div>
            <?php endforeach; ?>
        </div>
        <div class="tabs-title">
            <?php foreach ($tabs_list as $key => $tab) :
                $title_key = $widget->get_repeater_setting_key( 'tab_title', 'tabs_list', $key );
                $tabs_title[$title_key] = $tab['tab_title'];
                $widget->add_inline_editing_attributes( $title_key, 'basic' );
                $widget->add_render_attribute( $title_key, [
                    'class' => [ 'tab-title' ],
                    'data-target' => '#' . $element_id.'-'.$tab['_id'],
                ] );
                if($active_tab == $key + 1){
                    $widget->add_render_attribute( $title_key, 'class', 'active');
                }
                $image    = isset($tab['image']) ? $tab['image'] : [];
                $thumbnail = '';
                if(!empty($image)) {
        			$img = pxl_get_image_by_size( array(
                        'attach_id'  => $image['id'],
                        'thumb_size' => '150x150',
                        'class' => 'no-lazyload',
                    ));
                    $thumbnail = $img['thumbnail'];
                }

                ?>
                <div <?php pxl_print_html($widget->get_render_attribute_string( $title_key )); ?>>
                    <?php if(!empty($thumbnail)) { ?>
                                <div class="item-image">
                                    <?php echo wp_kses_post($thumbnail); ?> 
                                </div>
                    <?php } ?>
                    <span><?php echo pxl_print_html($tab['tab_title']); ?></span>
                </div>
                
            <?php endforeach; ?>
        </div>
    </div>
    <?php
}
?>