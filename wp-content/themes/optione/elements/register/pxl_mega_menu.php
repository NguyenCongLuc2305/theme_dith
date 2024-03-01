<?php
// Register Fancy Box Widget
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_mega_menu',
        'title'      => esc_html__( 'PXL Mega Menu', 'optione' ),
        'icon'       => 'eicon-info-box',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                
                array(
                    'name'     => 'content_section',
                    'label'    => esc_html__( 'Content', 'optione' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Styles Hover', 'optione' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'st-none',
                            'options' => [
                                'st-none' => esc_html__('None', 'optione' ),
                                'st-scroll' => esc_html__('Scroll', 'optione' ),
                            ],
                        ),
                        array(
                            'name'             => 'selected_img',
                            'label'            => esc_html__( 'Image', 'optione' ),
                            'type'             => 'media',
                            'default'          => '',
                        ),
                        array(
                            'name'     => 'title',
                            'label'    => esc_html__('Title', 'optione'),
                            'type'     => 'textarea',
                            'default'  => esc_html__('Your Title', 'optione')
                        ),
                        array(
                            'name' => 'button_text_1',
                            'label' => esc_html__('Button Text', 'optione'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name'        => 'link_1',
                            'label'       => esc_html__( 'Custom Link', 'optione' ),
                            'type'        => 'url',
                            'placeholder' => esc_html__( 'https://your-link.com', 'optione' ),
                            'default'     => [
                                'url'         => '#',
                                'is_external' => 'on'
                            ],
                        ),
                        array(
                            'name' => 'button_text_2',
                            'label' => esc_html__('Button Text 2', 'optione'),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name'        => 'link_2',
                            'label'       => esc_html__( 'Custom Link', 'optione' ),
                            'type'        => 'url',
                            'placeholder' => esc_html__( 'https://your-link.com', 'optione' ),
                            'default'     => [
                                'url'         => '#',
                                'is_external' => 'on'
                            ],
                        ),
                    )
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'optione' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                            array(
                                'name' => 'title_color',
                                'label' => esc_html__('Title Color', 'optione' ),
                                'type' => 'color',
                                'selectors' => [
                                    '{{WRAPPER}} .pxl-mega-menu .box-inner .box-title' => 'color: {{VALUE}};',
                                ],
                            ),
                            array(
                                'name' => 'title_typography',
                                'label' => esc_html__('Title Typography', 'optione' ),
                                'type' => \Elementor\Group_Control_Typography::get_type(),
                                'control_type' => 'group',
                                'selector' => '{{WRAPPER}} .pxl-mega-menu .box-inner .box-title',
                            ),
                    ),
                ),
            )
        )
    ),
    optione_get_class_widget_path()
);