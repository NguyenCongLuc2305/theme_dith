<?php
$default_settings = [
    'content_list' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);

?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
<div class="pxl-text-list layout-<?php echo esc_attr($settings['layout'])?>">
    <div class="pxl-list-inner">
        <div class="pxl-text-list-content ">
            <?php foreach ($content_list as $key => $value):
                $title       = isset($value['title']) ? $value['title'] : '';
                $description = isset($value['description']) ? $value['description'] : '';  
                ?>
                <div class="item-inner relative">
                    <div class="item-title"><?php echo pxl_print_html($title); ?></div>
                    <?php if(!empty($description)) :?>
                        <div class="item-desc"><?php echo pxl_print_html($description); ?></div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div> 
    </div>
</div>
<?php endif; ?>
