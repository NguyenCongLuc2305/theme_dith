<?php
$default_settings = [
    'content_list' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);

?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
<div class="pxl-testimonial-list layout-<?php echo esc_attr($settings['layout'])?>">
    <div class="pxl-list-inner">
        <div <?php pxl_print_html($widget->get_render_attribute_string( 'list' )); ?>>
            <div class="pxl-testimonial-list-content ">
                <?php foreach ($content_list as $key => $value):
                    $image       = isset($value['image']) ? $value['image'] : [];
                    $name       = isset($value['name']) ? $value['name'] : '';
                    $title       = isset($value['title']) ? $value['title'] : '';
                    $position    = isset($value['position']) ? $value['position'] : '';
                    $description = isset($value['description']) ? $value['description'] : '';
                    $thumbnail = '';
                    if(!empty($image['id'])) {
                        $img = pxl_get_image_by_size( array(
                            'attach_id'  => $image['id'],
                            'thumb_size' => '250x250',
                            'class' => 'no-lazyload',
                        ));
                        $thumbnail = $img['thumbnail'];
                    }  
                    ?>
                    <div class="pxl-testimonial-list-item">
                        <div class="item-inner relative">
                            <?php if(!empty($value['rating']) && $value['rating'] != 'none') : ?>
                                <div class="item-rating-star">
                                    <div class="item-rating <?php echo esc_attr($value['rating']); ?>">
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                        <i class="fas fa-star"></i>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <div class="title-desc">
                                <div class="item-title"><?php echo pxl_print_html($title); ?></div>
                                <?php if(!empty($description)) :?>
                                    <div class="item-desc"><?php echo pxl_print_html($description); ?></div>
                                <?php endif; ?>
                            </div>
                            <div class="item-wrap row gx-20">
                                <?php if(!empty($thumbnail)) :?>
                                    <div class="item-image col-auto">
                                        <span class="img-outer">
                                            <?php echo wp_kses_post($thumbnail); ?>
                                        </span>
                                    </div>
                                <?php endif; ?>
                                <div class="item-info col-auto">
                                 <div class="title-rating">
                                    <h4 class="item-name"><?php echo esc_html($name); ?></h4>
                                </div>
                                <div class="item-position"><?php echo esc_html($position); ?></div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

</div>
<?php endif; ?>
