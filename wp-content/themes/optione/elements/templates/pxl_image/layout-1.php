<?php 
$default_settings = [
    'image' => '',
    'image_size' => '',
    'image_link' => '' ,
    'direction_parallax' => '',
    'animation_paralax' => '',
    'direction_tilt' => '',
    'remove_animation' => ''
];
 

$settings = array_merge($default_settings, $settings);
extract($settings);

$thumbnail    = '';
 
if(!empty($image['id'])){
    if (!empty($image_size)) {
        $img  = pxl_get_image_by_size( array(
            'attach_id'  => $image['id'],
            'thumb_size' => $image_size,
        ) );
        $thumbnail    = $img['thumbnail'];
    }
    else{
        $img  = pxl_get_image_by_size( array(
            'attach_id'  => $image['id'],
            'thumb_size' => 'full',
        ) );
        $thumbnail    = $img['thumbnail'];
    }
}
if ( ! empty( $image_link['url'] ) ) {
    $widget->add_render_attribute( 'image_link', 'href', $image_link['url'] );

    if ( $image_link['is_external'] ) {
        $widget->add_render_attribute( 'image_link', 'target', '_blank' );
    }

    if ( $image_link['nofollow'] ) {
        $widget->add_render_attribute( 'image_link', 'rel', 'nofollow' );
    }
}

if(!empty($image['id'])) : ?>
    <div class="pxl-image d-flex align-items-center <?php if(!empty($direction_tilt)) { echo esc_attr($direction_tilt); } ?> <?php if(!empty($remove_animation)) { echo esc_attr($remove_animation); } ?>" data-parallax='{"<?php if(!empty($direction_parallax)) { echo esc_attr($direction_parallax); } ?>": <?php if(!empty($animation_paralax)) { echo esc_attr($animation_paralax); } ?>}' data-tilt-axis="x">
        <?php if ( ! empty( $image_link['url'] ) ) { ?><a <?php pxl_print_html($widget->get_render_attribute_string( 'image_link' )); ?>><?php } ?>
            <?php if ( ! empty( $image['url'] ) ) { echo wp_kses_post($thumbnail); } ?>
        <?php if ( ! empty( $image_link['url'] ) ) { ?></a><?php } ?>
    </div>
<?php endif; ?>