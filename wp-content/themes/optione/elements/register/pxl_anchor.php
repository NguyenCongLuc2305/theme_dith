<?php
$templates_df = [0 => esc_html__('None', 'optione')];
$templates = $templates_df + optione_get_templates_option('hidden-panel');

pxl_add_custom_widget(
    array(
        'name'       => 'pxl_anchor',
        'title'      => esc_html__( 'PXL Anchor', 'optione' ),
        'icon'       => 'eicon-anchor',
        'categories' => array('pxltheme-core'),
        'scripts'    => array(),
        'params' => array(
            'sections' => array(
                array(
                    'name'     => 'icon_section',
                    'label'    => esc_html__( 'Settings', 'optione' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'template',
                            'label' => esc_html__('Select Templates', 'optione'),
                            'type' => 'select',
                            'options' => $templates,
                            'default' => 'df' 
                        ),
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
                                'value'   => 'pxli-search-400'
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
                                '{{WRAPPER}} .pxl-anchor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-anchor-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                            ],

                        ),
                        array(
                            'name' => 'icon_margin',
                            'label' => esc_html__('Icon Margin(px)', 'optione' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => ['icon_type!' => 'none'],
                        ),
                        array(
                            'name'        => 'title',
                            'label'       => esc_html__( 'Title', 'optione' ),
                            'type'        => 'textarea',
                            'placeholder' => esc_html__( 'Menu', 'optione' ),
                        ),
                        array(
                            'name'         => 'title_typo',
                            'label'        => esc_html__( 'Title Typography', 'optione' ),
                            'type'         => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector'     => '{{WRAPPER}} .anchor-title',
                            'condition'    => ['title!' => '']
                        ),
                        array(
                            'name' => 'icon_color',
                            'label' => esc_html__('Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon.custom span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-icon svg' => 'fill: {{VALUE}};',
                            ],
                        ), 
                        array(
                            'name' => 'icon_color_hover',
                            'label' => esc_html__('Hover Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-anchor:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor-wrap .pxl-anchor-icon.custom.pxl-bars:hover span' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-anchor:hover pxl-anchor-icon svg' => 'fill: {{VALUE}};',
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
                                '{{WRAPPER}} .pxl-anchor-wrap' => 'justify-content: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'        => 'custom_class',
                            'label'       => esc_html__( 'Custom class', 'optione' ),
                            'type'        => 'text',
                        ),
                    ),
                )
            )
        )
    ),
    optione_get_class_widget_path()
);