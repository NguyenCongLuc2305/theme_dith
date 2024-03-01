<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_image',
        'title' => esc_html__('PXL Image', 'optione' ),
        'icon' => 'eicon-image',
        'categories' => array('pxltheme-core'),
        'scripts' => array(
            'optione-gsap',
            'optione-parallax',
            'tilt'
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'content_section',
                    'label' => esc_html__('Content', 'optione' ),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Image', 'optione' ),
                            'type' => 'media',
                        ),                        
                        array(
                            'name' => 'image_size',
                            'label' => esc_html__('Image Size', 'optione' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'description' =>  esc_html__('Enter image size (Example: "thumbnail", "medium", "large", "full" or other sizes defined by theme). Alternatively enter size in pixels (Default: 370x300 (Width x Height)).', 'optione'),
                            
                        ), 
                        array(
                            'name' => 'image_max_width',
                            'label' => esc_html__('Max Width', 'optione' ),
                            'type' => 'slider',
                            'description' => esc_html__('Enter number.', 'optione' ),
                            'size_units' => [ 'px' , '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 3000,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'control_type' => 'responsive',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image img' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name'         => 'image_align',
                            'label'        => esc_html__( 'Alignment', 'optione' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                'start' => [
                                    'title' => esc_html__( 'Start', 'optione' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'optione' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'end' => [
                                    'title' => esc_html__( 'End', 'optione' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-image' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'image_link',
                            'label' => esc_html__('Link', 'optione' ),
                            'type' => 'url',
                        ) 
                    ),
                ),
                array(
                    'name' => 'setting_section',
                    'label' => esc_html__('Setting Options', 'optione' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'      => 'show_parallax',
                            'label'     => esc_html__('Image Parallax', 'optione' ),
                            'type'      => \Elementor\Controls_Manager::SWITCHER,
                            'default'   => 'false',
                        ),
                        array(
                            'name'      => 'direction_parallax',
                            'label'     => esc_html__('Parallax Direction', 'optione' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'x',
                            'options' => [
                                'x' => esc_html__('Vertical', 'optione' ),
                                'y' => esc_html__('Horizontal', 'optione' ),
                            ],
                            'condition' => ['show_parallax' => 'true']
                        ),
                        array(
                            'name' => 'animation_paralax',
                            'label' => esc_html__('Animation Parallax', 'optione'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 50,
                            'condition' => ['show_parallax' => 'true']
                        ),
                        array(
                            'name'      => 'remove_animation',
                            'label'     => esc_html__('Remove Parallax On Mobile', 'optione' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'remove-parallax-none',
                            'options' => [
                                'remove-parallax-none' => esc_html__('Default', 'optione' ),
                                'remove-parallax-true' => esc_html__('Remove True', 'optione' ),
                            ],
                            'condition' => ['show_parallax' => 'true']
                        ),

                        array(
                            'name'      => 'direction_tilt',
                            'label'     => esc_html__('Image Parallax Hover Tilt', 'optione' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'pxl-none',
                            'options' => [
                                'pxl-none' => esc_html__('None', 'optione' ),
                                'pxl-image-tilt' => esc_html__('Tilt', 'optione' ),
                            ],
                        ),

                    )
                ),
            ),
        ),
    ),
    optione_get_class_widget_path()
);