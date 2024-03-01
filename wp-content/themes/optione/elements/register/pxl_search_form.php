<?php
// Register Search Form Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_search_form',
        'title' => esc_html__('Pxl Search Form', 'optione' ),
        'icon' => 'eicon-site-search',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'optione' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Templates', 'optione' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'optione' ),
                                    'image' => get_template_directory_uri() . '/elements/assets/layout-image/pxl_search_form-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'pxl-search-form-layout-'
                        ),
                        array(
                            'name' => 'search_type',
                            'label' => esc_html__('Search Type', 'optione' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Default', 'optione'),
                                '2' => esc_html__('Product', 'optione'),
                            ],
                            'default' => '1',
                        )
                    )
                ),
                array(
                    'name'     => 'text_section',
                    'label'    => esc_html__( 'Setting', 'optione' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name'     => 'placeholder',
                            'label'    => esc_html__('Placeholder text', 'optione'),
                            'type'     => 'text',
                            'label_block' => true,
                            'default'  => 'Enter Keywords...'
                        ),
                        array(
                            'name'    => 'search_text_width',
                            'label'   => esc_html__( 'Search text width', 'optione' ),
                            'type'    => 'slider',
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'default' => [
                                'unit' => 'px',
                                'unit' => '%',
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1200,
                                ],
                                '%' => [
                                    'min' => 5,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-form' => 'width: {{SIZE}}{{UNIT}}'
                            ],
                        ),
                        array(
                           'name' => 'border_height',
                            'label' => esc_html__( 'Search Height', 'optione' ),
                            'type'    => 'slider',
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'default' => [
                                'unit' => 'px',
                                'unit' => '%',
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1200,
                                ],
                                '%' => [
                                    'min' => 5,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-wrap .pxl-search-field' => 'height: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-search-wrap .pxl-search-submit' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                           'name' => 'button_width',
                            'label' => esc_html__( 'Button Width', 'optione' ),
                            'type'    => 'slider',
                            'control_type' => 'responsive',
                            'size_units'   => [ 'px', '%' ],
                            'default' => [
                                'unit' => 'px',
                                'unit' => '%',
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 100,
                                    'max' => 1200,
                                ],
                                '%' => [
                                    'min' => 5,
                                    'max' => 100,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-wrap .pxl-search-submit' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'border_width',
                            'label' => esc_html__( 'Border Width', 'optione' ),
                            'type' => \Elementor\Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-wrap .pxl-search-field' => 'border-width: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                            ],
                        ),
                        array(
                            'name' => 'border_color',
                            'label' => esc_html__( 'Border Color', 'optione' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'default' => '',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-wrap .pxl-search-field' => 'border-color: {{VALUE}} !important;',
                            ],
                        ),
                        array(
                            'name'         => 'align',
                            'label'        => esc_html__( 'Alignment', 'optione' ),
                            'type'         => 'choose',
                            'control_type' => 'responsive',
                            'default'      => '',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__( 'Left', 'optione' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__( 'Center', 'optione' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__( 'Right', 'optione' ),
                                    'icon' => 'eicon-text-align-right',
                                ]
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-search-wrap' => 'text-align: {{VALUE}}; justify-content: {{VALUE}};',
                            ],
                        ),
                    )
                ),  
            ),
        ),
    ),
    optione_get_class_widget_path()
);