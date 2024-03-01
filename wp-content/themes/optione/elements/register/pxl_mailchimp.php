<?php
pxl_add_custom_widget(
    array(
        'name' => 'pxl_mailchimp',
        'title' => esc_html__('PXL Mailchimp', 'optione'),
        'icon' => 'eicon-email-field',
        'categories' => array('pxltheme-core'),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'section_style',
                    'label' => esc_html__('Style', 'optione'),
                    'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                    'controls' => array(
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'optione' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style-default' => esc_html__('Default', 'optione' ),
                                'style-1' => esc_html__('Style 1', 'optione' ),
                            ],
                            'default' => 'style-default',
                        ),
                        array(
                            'name' => 'button_width',
                            'label' => esc_html__('Button Width (px)', 'optione' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .pxl-mailchimp-form .input-email' => 'max-width: {{SIZE}}{{UNIT}};',
                            ],

                        ),
                    ),
                ),
            ),
        ),
    ),
    optione_get_class_widget_path()
);