<?php
// Register Widget
pxl_add_custom_widget(
    array(
        'name'       => 'pxl_download',
        'title'      => esc_html__( 'PXL Download', 'optione' ),
        'icon' => 'eicon-file-download',
        'categories' => array('pxltheme-core'),
        'scripts'    => [],
        'params'     => array(
            'sections' => array(
                array(
                    'name'     => 'layout_section',
                    'label'    => esc_html__( 'Layout', 'optione' ),
                    'tab'      => 'layout',
                    'controls' => array(
                        array(
                            'name'    => 'layout',
                            'label'   => esc_html__( 'Layout', 'optione' ),
                            'type'    => 'layoutcontrol',
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__( 'Layout 1', 'optione' ),
                                    'image' => get_template_directory_uri() . '/elements/register/img-layout/pxl_download-1.jpg'
                                ],
                            ],
                            'prefix_class' => 'pxl-download-layout-',
                        ),
                    )
                ),
                array(
                    'name'     => 'list_section',
                    'label'    => esc_html__( 'Content Settings', 'optione' ),
                    'tab'      => 'content',
                    'controls' => array(
                        array(
                            'name' => 'el_title',
                            'label' => esc_html__('Element Title', 'optione'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'download_description',
                            'label' => esc_html__('Description', 'optione'),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'download',
                            'label' => esc_html__('Download Lists', 'optione'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'default' => [],
                            'controls' => array(
                                array(
                                    'name' => 'file_name',
                                    'label' => esc_html__('File Name', 'optione'),
                                    'type' => \Elementor\Controls_Manager::TEXTAREA,
                                    'label_block' => true,
                                ),
                                array(
                                    'name' => 'file_type_icon',
                                    'label' => esc_html__('File Icon', 'optione' ),
                                    'type' => \Elementor\Controls_Manager::ICONS,
                                    'fa4compatibility' => 'icon',
                                    'default' => [
                                        'value' => 'fas fa-star',
                                        'library' => 'fa-solid',
                                    ],
                                ),
                                array(
                                    'name' => 'file_size',
                                    'label' => esc_html__('File Size', 'optione'),
                                    'type' => \Elementor\Controls_Manager::TEXT,
                                ),
                                array(
                                    'name' => 'link',
                                    'label' => esc_html__('Link', 'optione' ),
                                    'type' => \Elementor\Controls_Manager::URL,
                                ),
                            ),
                            'title_field' => '{{{ file_name }}}',
                        ),
                    )
                )
            )
        )
    ),
    optione_get_class_widget_path()
);