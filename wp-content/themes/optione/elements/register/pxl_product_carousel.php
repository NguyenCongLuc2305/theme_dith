<?php
$pt_supports = ['post', 'portfolio'];
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_product_carousel',
        'title'      => esc_html__('PXL Product Carousel', 'optione'),
        'icon' => 'eicon-slider-push',
        'categories' => array('pxltheme-core'),
        'scripts' => [
            'swiper',
            'optione-swiper',
        ],
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__('Layout', 'optione'),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__('Templates', 'optione'),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'optione'),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_product_carousel-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'pxl-product-carousel-layout-'
                        )
                    )
                ),

                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'optione'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name'    => 'query_type',
                            'label'   => esc_html__('Select Query Type', 'optione'),
                            'type'    => 'select',
                            'default' => 'recent_product',
                            'options' => [
                                'recent_product'   => esc_html__('Recent Products', 'optione'),
                                'best_selling'     => esc_html__('Best Selling', 'optione'),
                                'featured_product' => esc_html__('Featured Products', 'optione'),
                                'top_rate'         => esc_html__('High Rate', 'optione'),
                                'on_sale'          => esc_html__('On Sale', 'optione'),
                                'recent_review'    => esc_html__('Recent Review', 'optione'),
                                'deals'            => esc_html__('Product Deals', 'optione'),
                                'separate'         => esc_html__('Product separate', 'optione'),
                            ]
                        ),
                        array(
                            'name'     => 'taxonomies',
                            'label'    => esc_html__('Select Term of Product', 'optione'),
                            'type'     => 'select2',
                            'multiple' => true,
                            'options'  => pxl_get_product_grid_term_options()
                        ),
                        array(
                            'name'     => 'product_ids',
                            'label'    => esc_html__('Products id (123,124,135...)', 'optione'),
                            'type'     => 'text',
                            'default'  => '',
                            'condition' => array('query_type' => 'separate')
                        ),
                        array(
                            'name'     => 'post_per_page',
                            'label'    => esc_html__('Post per page', 'optione'),
                            'type'     => 'text',
                            'default'  => '10'
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shop-item-wrap .pxl-product-title' => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'review_color',
                            'label' => esc_html__('Review Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-product-carousel .pxl-swiper-slide .woocommerce-product-rating .woocommerce-review-link' => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'price_color',
                            'label' => esc_html__('Price  Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shop-item-wrap .price' => 'color: {{VALUE}};'
                            ],
                        ),
                        array(
                            'name' => 'sale_color',
                            'label' => esc_html__('Price Sale Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-shop-item-wrap .price del' => 'color: {{VALUE}};'
                            ],
                        ),
                       
                    ),
                ),
                array(
                    'name' => 'carousel_setting',
                    'label' => esc_html__('Carousel Settings', 'optione' ),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array_merge(
                        optione_carousel_column_settings(),
                        array( 
                            array(
                                'name' => 'slides_to_scroll',
                                'label' => esc_html__('Slides to scroll', 'optione' ),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => '1',
                                'options' => [
                                    '1' => '1',
                                    '2' => '2',
                                    '3' => '3',
                                    '4' => '4',
                                    '5' => '5',
                                    '6' => '6',
                                ],
                            ),
                            array(
                                'name' => 'arrows',
                                'label' => esc_html__('Show Arrows', 'optione'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'arrow_prev_position',
                                'label' => esc_html__('Arrow Previous Position', 'optione'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'default',
                                'options' => [
                                    'default' => esc_html('Default', 'optione'),
                                    'absolute' => esc_html('Custom', 'optione'),
                                ],
                            ),
                            array(
                                'name' => 'arrow_prev_offset_orientation_h',
                                'label' => esc_html__('Horizontal Orientation', 'optione'),
                                'type' => \Elementor\Controls_Manager::CHOOSE,
                                'default' => 'left',
                                'control_type' => 'responsive',
                                'options' => [
                                    'left' => [
                                        'title' => 'Start',
                                        'icon' => 'eicon-h-align-left',
                                    ],
                                    'right' => [
                                        'title' => 'End',
                                        'icon' => 'eicon-h-align-right',
                                    ],
                                ],
                                'render_type' => 'ui',
                                'condition' => [
                                    'arrow_prev_position' => 'absolute'
                                ]
                            ),
                            array(
                                'name' => 'arrow_prev_offset_x',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-prev' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                                ],
                                'condition' => [
                                    'arrow_prev_offset_orientation_h!' => 'right',
                                    'arrow_prev_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrow_prev_offset_x_end',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-prev' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                                ],
                                'condition' => [
                                    'arrow_prev_offset_orientation_h' => 'right',
                                    'arrow_prev_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrow_prev_offset_orientation_v',
                                'label' => esc_html__('Vertical Orientation', 'optione'),
                                'type' => \Elementor\Controls_Manager::CHOOSE,
                                'default' => 'top',
                                'control_type' => 'responsive',
                                'options' => [
                                    'top' => [
                                        'title' => 'Top',
                                        'icon' => 'eicon-v-align-top',
                                    ],
                                    'bottom' => [
                                        'title' => 'Bottom',
                                        'icon' => 'eicon-v-align-bottom',
                                    ],
                                ],
                                'render_type' => 'ui',
                                'condition' => [
                                    'arrow_prev_position' => 'absolute'
                                ]
                            ),
                            array(
                                'name' => 'arrow_prev_offset_y',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-prev' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                                ],
                                'condition' => [
                                    'arrow_prev_offset_orientation_v!' => 'bottom',
                                    'arrow_prev_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrow_prev_offset_y_end',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-prev' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
                                ],
                                'condition' => [
                                    'arrow_prev_offset_orientation_v' => 'bottom',
                                    'arrow_prev_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrow_next_position',
                                'label' => esc_html__('Arrow Next Position', 'optione'),
                                'type' => \Elementor\Controls_Manager::SELECT,
                                'default' => 'default',
                                'options' => [
                                    'default' => esc_html('Default', 'optione'),
                                    'absolute' => esc_html('Custom', 'optione'),
                                ],
                            ),
                            array(
                                'name' => 'arrow_next_offset_orientation_h',
                                'label' => esc_html__('Horizontal Orientation', 'optione'),
                                'type' => \Elementor\Controls_Manager::CHOOSE,
                                'default' => 'left',
                                'control_type' => 'responsive',
                                'options' => [
                                    'left' => [
                                        'title' => 'Start',
                                        'icon' => 'eicon-h-align-left',
                                    ],
                                    'right' => [
                                        'title' => 'End',
                                        'icon' => 'eicon-h-align-right',
                                    ],
                                ],
                                'render_type' => 'ui',
                                'condition' => [
                                    'arrow_next_position' => 'absolute'
                                ]
                            ),
                            array(
                                'name' => 'arrow_next_offset_x',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-next' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                                ],
                                'condition' => [
                                    'arrow_next_offset_orientation_h!' => 'right',
                                    'arrow_next_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrow_next_offset_x_end',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-next' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                                ],
                                'condition' => [
                                    'arrow_next_offset_orientation_h' => 'right',
                                    'arrow_next_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrow_next_offset_orientation_v',
                                'label' => esc_html__('Vertical Orientation', 'optione'),
                                'type' => \Elementor\Controls_Manager::CHOOSE,
                                'default' => 'top',
                                'control_type' => 'responsive',
                                'options' => [
                                    'top' => [
                                        'title' => 'Top',
                                        'icon' => 'eicon-v-align-top',
                                    ],
                                    'bottom' => [
                                        'title' => 'Bottom',
                                        'icon' => 'eicon-v-align-bottom',
                                    ],
                                ],
                                'render_type' => 'ui',
                                'condition' => [
                                    'arrow_next_position' => 'absolute'
                                ]
                            ),
                            array(
                                'name' => 'arrow_next_offset_y',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-next' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                                ],
                                'condition' => [
                                    'arrow_next_offset_orientation_v!' => 'bottom',
                                    'arrow_next_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrow_next_offset_y_end',
                                'label' => esc_html__('Offset', 'optione'),
                                'type' => \Elementor\Controls_Manager::SLIDER,
                                'range' => [
                                    'px' => [
                                        'min' => -1000,
                                        'max' => 1000,
                                        'step' => 1,
                                    ],
                                    '%' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vw' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                    'vh' => [
                                        'min' => -200,
                                        'max' => 200,
                                    ],
                                ],
                                'control_type' => 'responsive',
                                'size_units' => ['px', '%', 'vw', 'vh', 'custom'],
                                'default' => [
                                    'size' => 0,
                                    'unit' => 'px'
                                ],
                                'selectors' => [
                                    '{{WRAPPER}} .nav-out-vertical .pxl-swiper-arrow-next' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
                                ],
                                'condition' => [
                                    'arrow_next_offset_orientation_v' => 'bottom',
                                    'arrow_next_position' => 'absolute',
                                ],
                            ),
                            array(
                                'name' => 'arrows_on_hover',
                                'label' => esc_html__('Show Arrows on Hover', 'optione'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                                'default' => 'false',
                                'condition' => [
                                    'arrows' => 'true'
                                ]
                            ),
                            array(
                                'name' => 'dots',
                                'label' => esc_html__('Show Dots', 'optione'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'pause_on_hover',
                                'label' => esc_html__('Pause on Hover', 'optione'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay',
                                'label' => esc_html__('Autoplay', 'optione'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'autoplay_speed',
                                'label' => esc_html__('Autoplay Speed', 'optione'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 5000,
                                'condition' => [
                                    'autoplay' => 'true'
                                ]
                            ),
                            array(
                                'name' => 'infinite',
                                'label' => esc_html__('Infinite Loop', 'optione'),
                                'type' => \Elementor\Controls_Manager::SWITCHER,
                            ),
                            array(
                                'name' => 'speed',
                                'label' => esc_html__('Animation Speed', 'optione'),
                                'type' => \Elementor\Controls_Manager::NUMBER,
                                'default' => 500,
                            ),
                        ),
                        optione_elementor_animation_opts([
                            'name'   => 'item',
                            'label' => esc_html__('Item', 'optione'),
                        ])
                    ),
                ),
            ),
        ),
    ),
    optione_get_class_widget_path()
);
