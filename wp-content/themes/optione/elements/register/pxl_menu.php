<?php

use Elementor\Controls_Manager;

$menus = get_terms( 'nav_menu', array( 'hide_empty' => false ) );
$custom_menus = array(
    '' => esc_html__('Default', 'optione')
);
if ( is_array( $menus ) && ! empty( $menus ) ) {
    foreach ( $menus as $single_menu ) {
        if ( is_object( $single_menu ) && isset( $single_menu->name, $single_menu->slug ) ) {
            $custom_menus[ $single_menu->slug ] = $single_menu->name;
        }
    }
} else {
    $custom_menus = '';
}
pxl_add_custom_widget(
    array(
        'name' => 'pxl_menu',
        'title' => esc_html__('Pxl Menu', 'optione'),
        'icon' => 'eicon-nav-menu',
        'categories' => array('pxltheme-core'),
        'scripts' => array(),
        'params' => array(
            'sections' => array(
                 
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source Settings', 'optione'),
                    'tab' => 'content',
                    'controls' => array(
                        array(
                            'name' => 'type',
                            'label' => esc_html__('Type', 'optione' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Primary Menu', 'optione'),
                                '2' => esc_html__('Menu Inner', 'optione'),
                                '3' => esc_html__('Mobile Menu', 'optione'),
                                '4' => esc_html__('Sidebar Menu', 'optione'),
                            ],
                            'default' => '1',
                        ),
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Sidebar Widget Title', 'optione'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                            'condition' => [
                                'type' => '4',
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Menu Style', 'optione' ),
                            'type' => 'select',
                            'options' => [
                                '1' => esc_html__('Default', 'optione'),
                                '2' => esc_html__('Style 2', 'optione'),
                            ],
                            'default' => '1',
                            'condition' => [
                                'type' => ['1','2'],
                            ]
                        ),
                        array(
                            'name' => 'menu',
                            'label' => esc_html__('Select Menu', 'optione'),
                            'type' => 'select',
                            'options' => $custom_menus,
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
                                '{{WRAPPER}} .pxl-primary-menu, {{WRAPPER}} .pxl-mobile-menu' => 'justify-content: {{VALUE}};'
                            ],
                            'condition' => [
                                'type' => ['1','3'],
                            ]
                        ),
                        array(
                            'name' => 'menu_flex_grow',
                            'label' => esc_html__( 'Flex Grow', 'optione' ),
                            'type' => 'choose',
                            'control_type' => 'responsive',
                            'options' => [
                                '0' => [
                                    'title' => esc_html__( 'Inherit', 'optione' ),
                                    'icon' => 'eicon-h-align-center',
                                ],
                                '1' => [
                                    'title' => esc_html__( 'Fill available space', 'optione' ),
                                    'icon' => 'eicon-h-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}}' => 'flex-grow: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'first_section',
                    'label' => esc_html__('Style First Level', 'optione'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'color',
                            'label' => esc_html__('Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'color_hover',
                            'label' => esc_html__('Color Hover', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a:hover'                      => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item > a'          => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor > a'      => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:hover:before'                   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-item:before'       => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li.current-menu-ancestor:before'   => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a:hover'                       => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'underline_color',
                            'label' => esc_html__('Underline Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li:before' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'typography',
                            'label' => esc_html__('Typography', 'optione' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li > a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu > li > a',
                        ),
                        array(
                            'name'  => 'show_arrow',
                            'label' => esc_html__('Show Arrow', 'optione'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'type' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'arrow_color',
                            'label' => esc_html__('Arrow Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-primary-menu > li > a:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu > li .main-menu-toggle:before' => 'color: {{VALUE}};',
                            ],
                            'condition' => [
                                'show_arrow' => ['yes'],
                            ],
                        ),
                        array(
                            'name'  => 'show_underline',
                            'label' => esc_html__('Show Underline', 'optione'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                            'condition' => [
                                'type' => ['1'],
                            ],
                        ),
                        array(
                            'name' => 'item_space',
                            'label' => esc_html__('Item Space', 'optione' ),
                            'type' => 'dimensions',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px', 'em', '%', 'rem' ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-primary-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                                '{{WRAPPER}} .pxl-mobile-menu > li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'sub_section',
                    'label' => esc_html__('Style Sub Level', 'optione'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['1','3'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'sub_color',
                            'label' => esc_html__('Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_color_hover',
                            'label' => esc_html__('Color Hover', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu .current-menu-item a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu .current-menu-item a:after' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a:hover:after' => 'background: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a:hover' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_typography',
                            'label' => esc_html__('Typography', 'optione' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-primary-menu li .sub-menu a, {{WRAPPER}} .pxl-nav-menu .pxl-mobile-menu li .sub-menu a',
                        ),
                        array(
                            'name' => 'sub_bg_color',
                            'label' => esc_html__('Subtitle Background Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-primary-menu .sub-menu' => 'background: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_border_color',
                            'label' => esc_html__('Subtitle Border Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-primary-menu .sub-menu' => 'border-color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-primary-menu .sub-menu li a' => 'border-color: {{VALUE}};',
                            ],
                        ),
                    ),
                ),

                array(
                    'name' => 'nav_section',
                    'label' => esc_html__('Style', 'optione'),
                    'tab' => 'content',
                    'condition' => [
                        'type' => ['2'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'nav_color',
                            'label' => esc_html__('Color', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner li' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-inner .menu-item > a span:after' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'nav_color_hover',
                            'label' => esc_html__('Color Hover', 'optione' ),
                            'type' => 'color',
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a:hover' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .pxl-nav-menu.pxl-nav-menu-inner .menu-item > a:hover span:after' => 'background: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name'  => 'border_hover',
                            'label' => esc_html__('Border Hover', 'optione'),
                            'type'  => 'switcher',
                            'return_value' => 'yes',
                            'default' => 'yes',
                        ),
                        array(
                            'name' => 'nav_typography',
                            'label' => esc_html__('Typography', 'optione' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner a',
                        ),
                        array(
                            'name' => 'nav_item_space',
                            'label' => esc_html__('Item Space', 'optione' ),
                            'type' => 'slider',
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-nav-menu .pxl-nav-inner li + li' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    optione_get_class_widget_path()
);