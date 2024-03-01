<?php
$editor_title = $widget->get_settings_for_display( 'title' );
$editor_title = $widget->parse_text_editor( $editor_title );
$editor_title_2 = $widget->get_settings_for_display( 'title_2' );
$editor_title_2 = $widget->parse_text_editor( $editor_title_2 );
?>
<div class="pxl-heading-effect">
	<div class="pxl-heading--inner">
		<<?php echo esc_attr($settings['title_tag']); ?> class="pxl-item--title <?php echo esc_attr($settings['divider']) ;?> <?php if($settings['pxl_animate'] !== 'wow letter') { echo esc_attr($settings['pxl_animate']); } ?> <?php echo esc_attr($settings['title_custom_font_family']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay']); ?>ms">
			<?php if($settings['source_type'] == 'text' && !empty($editor_title)) {
				if($settings['pxl_animate'] == 'wow letter') {
					$arr_str = explode(' ', $editor_title); ?>
					<span class="pxl-item--text">
			            <?php foreach ($arr_str as $index => $value) {
			                $arr_str[$index] = '<span class="pxl-text--slide"><span class="'.$settings['pxl_animate'].'">' . $value . '</span></span>';
			            }
			            $str = implode(' ', $arr_str);
			            echo wp_kses_post($str); ?>
			        </span>
				<?php } else {
					echo wp_kses_post($editor_title);
				} 
			} elseif($settings['source_type'] == 'title') {
				$titles = optione()->page->get_title();
				pxl_print_html($titles['title']);
			}?>	

			<?php if($settings['source_type'] == 'text' && !empty($editor_title_2)) {
				if($settings['pxl_animate'] == 'wow letter') {
					$arr_str = explode(' ', $editor_title_2); ?>
					<span class="pxl-item--text--2">
			            <?php foreach ($arr_str as $index => $value) {
			                $arr_str[$index] = '<span class="pxl-text--slide"><span class="'.$settings['pxl_animate'].'">' . $value . '</span></span>';
			            }
			            $str = implode(' ', $arr_str);
			            echo wp_kses_post($str); ?>
			        </span>
				<?php } else {
					echo wp_kses_post($editor_title_2);
				} 
			} elseif($settings['source_type'] == 'title_2') {
				$titles = optione()->page->get_title();
				pxl_print_html($titles['title_2']);
			}?>	


		</<?php echo esc_attr($settings['title_tag']); ?>>
		<?php if(!empty($settings['sub_title'])) : ?>
			<div class="pxl-item--subtitle <?php echo esc_attr($settings['pxl_animate_sub']); ?>" data-wow-delay="<?php echo esc_attr($settings['pxl_animate_delay_sub']); ?>ms"><span><?php echo esc_attr($settings['sub_title']); ?></span></div>
		<?php endif; ?>
	</div>
</div>