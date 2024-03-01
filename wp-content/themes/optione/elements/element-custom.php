<?php

add_action( 'elementor/element/section/section_structure/after_section_end', 'optione_add_custom_section_controls' );
add_action( 'elementor/element/column/layout/after_section_end', 'optione_add_custom_columns_controls' );
function optione_add_custom_section_controls( \Elementor\Element_Base $element) {

	$element->start_controls_section(
		'section_pxl',
		[
			'label' => esc_html__( 'Optione Settings', 'optione' ),
			'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
		]
	);

    $element->add_control(
        'pxl_section_offset',
        [
            'label' => esc_html__( 'Section Offset', 'optione' ),
            'type'         => \Elementor\Controls_Manager::SELECT,
            'prefix_class' => 'pxl-section-offset-',
            'hide_in_inner' => true,
            'options'      => array(
                'none'    => esc_html__( 'None', 'optione' ),
                'left'   => esc_html__( 'Left', 'optione' ),
                'right'     => esc_html__( 'Right', 'optione' ),
            ),
            'default'      => 'none',
            'condition' => [
                'layout' => 'full_width'
            ]
        ]
    );

    $element->add_control(
        'pxl_container_width',
        [
            'label' => esc_html__( 'Container Width', 'optione' ),
            'type'         => \Elementor\Controls_Manager::SELECT,
            'prefix_class' => 'pxl-container-width-',
            'hide_in_inner' => true,
            'options'      => array(
                'container-1200'    => esc_html__( '1200px', 'optione' ),
                'container-1570'    => esc_html__( '1570px', 'optione' )
            ),
            'default'      => 'container-1200',
            'condition' => [
                'layout' => 'full_width',
                'pxl_section_offset!' => 'none'
            ]
        ]
    );
    
    $element->add_control(
        'pxl_shape_divider',
        [
            'label'   => esc_html__( 'Shape Divider', 'optione' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => array(
                'none'           => esc_html__( 'None', 'optione' ),
                'svg'   => esc_html__( 'SVG', 'optione' ),
                'mask'   => esc_html__( 'Mask', 'optione' ),
            ),
            'control_type' => 'responsive',
            'label_block'  => true,
            'default'      => 'none',
            'prefix_class' => 'pxl-shape-divider-'
        ]
    );
    $element->add_control(
        'pxl_shape_divider_pos',
        [
            'label'   => esc_html__( 'Shape Divider SVG', 'optione' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => array(
                'top'   => esc_html__( 'Top', 'optione' ),
                'bottom'   => esc_html__( 'Bottom', 'optione' ),
            ),
            'label_block'  => true,
            'default'      => 'top',
            'prefix_class' => 'pxl-shape-divider-pos-',
            'condition' => ['pxl_shape_divider!' => 'none']
        ]
    );
    $element->add_control(
        'pxl_shape_divider_svg',
        [
            'label'   => esc_html__( 'Shape Divider SVG', 'optione' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => array(
                'waves'   => esc_html__( 'Waves', 'optione' ),
            ),
            'label_block'  => true,
            'default'      => 'waves',
            //'frontend_available' => true,
            'prefix_class' => 'pxl-shape-divider-',
            'condition' => ['pxl_shape_divider' => 'svg']
        ]
    );

    $element->add_control(
        'pxl_img_mask',
        [
            'label' => esc_html__('Upload Image Mask', 'optione'),
            'type' => \Elementor\Controls_Manager::MEDIA,
            'default' => [],
            'condition' => ['pxl_shape_divider' => 'mask']
        ]
    );

	$element->end_controls_section();
};

function optione_add_custom_columns_controls( \Elementor\Element_Base $element) {
	$element->start_controls_section(
		'columns_pxl',
		[
			'label' => esc_html__( 'Optione Settings', 'optione' ),
			'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
		]
	);
	$element->add_control(
		'pxl_col_auto',
		[
            'label'   => esc_html__( 'Element Auto Width', 'optione' ),
            'type'    => \Elementor\Controls_Manager::SELECT,
            'options' => array(
                'default'           => esc_html__( 'Default', 'optione' ),
                'auto'   => esc_html__( 'Auto', 'optione' ),
            ),
            'control_type' => 'responsive',
            'label_block'  => true,
            'default'      => 'default',
            'prefix_class' => 'pxl-column-element-'
		]
	);

	$element->end_controls_section();
}

add_filter( 'pxl-custom-section/before-render', 'optione_custom_section_before_render', 10, 1 );
function optione_custom_section_before_render($settings){
    if( isset($settings['pxl_shape_divider']) && $settings['pxl_shape_divider'] !== 'none'){

        $pxl_img_mask = ! empty( $settings['pxl_img_mask']['url'] )  ? $settings['pxl_img_mask']['url'] : '';
        $pxl_img_mask_style = 'style="--ss-mask-url: url('. esc_url($pxl_img_mask) .')"';
        $custom =  '<div class="pxl-shape-divider '. $settings['pxl_shape_divider'] .'" '.$pxl_img_mask_style.'></div>';
        return $custom;
    }

}

//* Animation
add_action( 'elementor/element/after_add_attributes', 'optione_custom_el_attributes', 10, 1 );
function optione_custom_el_attributes($el){
    $settings = $el->get_settings();
    $_animation = ! empty( $settings['_animation'] );
    $animation = ! empty( $settings['animation'] );
    $has_animation = $_animation && 'none' !== $settings['_animation'] || $animation && 'none' !== $settings['animation'];
    if ( $has_animation ) {
        $is_static_render_mode = \Elementor\Plugin::$instance->frontend->is_static_render_mode();
        if ( ! $is_static_render_mode ) {
            // Hide the element until the animation begins
            $el->add_render_attribute( '_wrapper', 'class', 'pxl-elementor-animate' );
        }
    }

}
