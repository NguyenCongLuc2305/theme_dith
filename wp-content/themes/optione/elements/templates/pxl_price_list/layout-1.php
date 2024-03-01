<?php
$default_settings = [
    'content_list' => [],
];

$settings = array_merge($default_settings, $settings);
extract($settings);

?>
<?php if(isset($content_list) && !empty($content_list) && count($content_list)): ?>
<div class="pxl-price-list layout-<?php echo esc_attr($settings['layout'])?>">
    <div class="pxl-list-inner">
        <div class="pxl-price-list-content ">
            <?php foreach ($content_list as $key => $value):
                $title       = isset($value['title']) ? $value['title'] : '';
                $description = isset($value['description']) ? $value['description'] : '';
                $pricing_price_currency =  isset($value['pricing_price_currency']) ? $value['pricing_price_currency'] : '';
                $pricing_price_value = isset($value['pricing_price_value']) ? $value['pricing_price_value'] : '';
                ?>
                <div class="pxl-price-list-item">
                    <div class="item-inner relative">
                        <div class="title-price">
                            <div class="item-title"><?php echo pxl_print_html($title); ?></div>
                            <span class="pricing-price-value">
                                <span class="pricing-price-currency"><?php echo esc_html($pricing_price_currency); ?></span><span><?php echo esc_html($pricing_price_value); ?></span>
                            </span>
                        </div>
                        <div class="item-desc"><?php echo pxl_print_html($description); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

</div>
<?php endif; ?>
