<?php
// Register Button Widget
pxl_add_custom_widget(
    array(
        'name' => 'pxl_cart',
        'title' => esc_html__('Pxl Cart', 'optione' ),
        'icon' => 'eicon-cart',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Setting', 'optione' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'icon_type',
                            'label' => esc_html__('Select Icon Type', 'optione'),
                            'type' => 'select',
                            'options' => [
                                'none' => esc_html__('None', 'optione'),
                                'lib' => esc_html__('Library', 'optione'),
                                'custom' => esc_html__('Custom', 'optione'),
                            ],
                            'default' => 'lib'
                        ),
                        array(
                            'name'             => 'selected_icon',
                            'label'            => esc_html__( 'Icon', 'optione' ),
                            'type'             => 'icons',
                            'default'          => [
                                'library' => 'pxli',
                                'value'   => 'pxli-shopping-cart'
                            ],
                            'condition' => ['icon_type' => 'lib']
                        ),
                        array(
                            'name'  => 'icon_size',
                            'label' => esc_html__( 'Icon Size(px)', 'optione' ),
                            'type'  => 'slider',
                            'range' => [
                                'px' => [
                                    'min' => 15,
                                    'max' => 300,
                                ],
                            ],
                            'condition' => ['icon_type' => 'lib'],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-cart-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],

                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'optione' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => ['icon_type!' => 'none'],
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-cart-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Hover Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-cart:hover pxl-cart-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'count_background',
                            'label' => esc_html__('Count Background', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-icon .pxl-cart-count' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'count_color',
                            'label' => esc_html__('Count Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-cart-icon .pxl-cart-count' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'         => 'align',
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
                                '{{WRAPPER}} .pxl-cart-wrap' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                    )
                ),  
            ),
        ),
    ),
    optione_get_class_widget_path()
);