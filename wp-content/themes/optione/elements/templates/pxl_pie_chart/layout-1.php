<?php
$default_settings = [
    'title' => '',
    'description' => '',
    'percentage_value' => '',
    'bar_color' => '',
    'track_color' => '',
    'chart_size' => '',
    'chart_border_width' => '',
];
$settings = array_merge($default_settings, $settings);
$is_new = \Elementor\Icons_Manager::is_migration_allowed();
extract($settings); ?>
<div class="pxl-piechart-layout1">
    <div class="pxl-piechart">
        <div class="item--value percentage" style="min-height: <?php echo esc_attr($chart_size['size']); ?>px;" data-size="<?php echo esc_attr($chart_size['size']); ?>" data-bar-color="<?php if(!empty($bar_color)) { echo esc_attr($bar_color); } else { echo '#189195'; } ?>" data-track-color="<?php if(!empty($track_color)) { echo esc_attr($track_color); } else { echo 'transparent'; } ?>" data-line-width="<?php echo esc_attr($chart_border_width['size']); ?>" data-percent="-<?php echo esc_attr($percentage_value); ?>" >
            <?php if($settings['style'] == 'style1') : ?>
                <span><?php echo esc_attr($percentage_value); ?>%</span>
            <?php endif; ?>
            <?php if ( $settings['style'] == 'style2' && !empty( $settings['pxl_icon'] ) ) : ?>
                <?php if ( $is_new ):
                    \Elementor\Icons_Manager::render_icon( $settings['pxl_icon'], [ 'aria-hidden' => 'true' ] );
                elseif(!empty($settings['pxl_icon'])): ?>
                    <i class="<?php echo esc_attr( $settings['pxl_icon'] ); ?>" aria-hidden="true"></i>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <div class="item--content">
            <h4 class="item--title"><?php echo pxl_print_html($title); ?></h4>
            <?php if(!empty($description)): ?>
                <div class="item--description"><?php echo pxl_print_html($description); ?></div>
            <?php endif; ?>
        </div>
    </div>
</div>
   