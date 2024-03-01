<?php
use Elementor\Utils;
if(!empty($settings['link_1']['url'])){
    $widget->add_render_attribute( 'link_1', 'class', 'btn btn-more btn-default btn-multi' );
    $widget->add_render_attribute( 'link_1', 'href', $settings['link_1']['url'] );

    if ( $settings['link_1']['is_external'] ) {
        $widget->add_render_attribute( 'link_1', 'target', '_blank' );
    }

    if ( $settings['link_1']['nofollow'] ) {
        $widget->add_render_attribute( 'link_1', 'rel', 'nofollow' );
    }
    if ( ! empty( $settings['link_1']['custom_attributes'] ) ) {
        // Custom URL attributes should come as a string of comma-delimited key|value pairs
        $custom_attributes = Utils::parse_custom_attributes( $settings['link_1']['custom_attributes'] );
        $widget->add_render_attribute( 'link_1', $custom_attributes);
    }
}
$link_1_attributes = $widget->get_render_attribute_string( 'link_1' );
if(!empty($settings['link_2']['url'])){
    $widget->add_render_attribute( 'link_2', 'class', 'btn btn-more btn-default btn-one' );
    $widget->add_render_attribute( 'link_2', 'href', $settings['link_2']['url'] );

    if ( $settings['link_2']['is_external'] ) {
        $widget->add_render_attribute( 'link_2', 'target', '_blank' );
    }

    if ( $settings['link_2']['nofollow'] ) {
        $widget->add_render_attribute( 'link_2', 'rel', 'nofollow' );
    }
    if ( ! empty( $settings['link_2']['custom_attributes'] ) ) {
        // Custom URL attributes should come as a string of comma-delimited key|value pairs
        $custom_attributes = Utils::parse_custom_attributes( $settings['link_2']['custom_attributes'] );
        $widget->add_render_attribute( 'link_2', $custom_attributes);
    }
}
$link_2_attributes = $widget->get_render_attribute_string( 'link_2' );
$thumbnail = '';
if( ! empty( $settings['selected_img']['id'] ) ){
    $img  = pxl_get_image_by_size( array(
        'attach_id'  => $settings['selected_img']['id'],
        'thumb_size' => 'full',
    ) );
    $thumbnail = $img['thumbnail'];
}
?>
<div class="pxl-mega-menu layout-1 <?php echo esc_html($settings['style']); ?>">
    <div class="box-inner">
        <div class="item-feature">
                <?php echo wp_kses_post($thumbnail); ?>
                <div class="menu-item-links">
                     <?php if(!empty($widget->get_setting('button_text_1'))): ?>
                        <a <?php echo implode( ' ', [ $link_1_attributes ] ); ?>>
                            <span><?php echo esc_html($settings['button_text_1']); ?></span>
                        </a>
                    <?php endif; ?>
                    <?php if(!empty($widget->get_setting('button_text_2'))): ?>
                        <a <?php echo implode( ' ', [ $link_2_attributes ] ); ?>>
                            <span><?php echo esc_html($settings['button_text_2']); ?></span>
                        </a>
                    <?php endif; ?>

            </div>
        </div>

        <h3 class="box-title">
            <?php pxl_print_html( nl2br($widget->get_setting('title'))); ?>
        </h3>
    </div>

</div>  
 



