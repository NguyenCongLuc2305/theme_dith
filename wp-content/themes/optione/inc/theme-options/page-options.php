<?php
 
add_action( 'pxl_post_metabox_register', 'optione_page_options_register' );
function optione_page_options_register( $metabox ) {
	$panels = [
		'post' => [
			'opt_name'            => 'post_option',
			'display_name'        => esc_html__( 'Post Settings', 'optione' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'post_settings' => [
					'title'  => esc_html__( 'Post Settings', 'optione' ),
					'icon'   => 'el el-refresh',
					'fields' => array_merge(
						optione_sidebar_pos_opts(['prefix' => 'post_', 'default' => true, 'default_value' => '-1']),
						optione_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
                        array(
                            array(
                                'id'          => 'featured-video-url',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Video URL', 'optione' ),
                                'description' => esc_html__( 'Video will show when set post format is video', 'optione' ),
                                'validate'    => 'url',
                                'msg'         => 'Url error!',
                            ),
                            array(
                                'id'          => 'featured-audio-url',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Audio URL', 'optione' ),
                                'description' => esc_html__( 'Audio that will show when set post format is audio', 'optione' ),
                                'validate'    => 'url',
                                'msg'         => 'Url error!',
                            ),
                            array(
                                'id'=>'featured-quote-text',
                                'type' => 'textarea',
                                'title' => esc_html__('Quote Text', 'optione'),
                                'default' => '',
                            ),
                            array(
                                'id'          => 'featured-quote-cite',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Quote Cite', 'optione' ),
                                'description' => esc_html__( 'Quote will show when set post format is quote', 'optione' ),
                            ),
                            array(
                                'id'       => 'featured-link-url',
                                'type'     => 'text',
                                'title'    => esc_html__( 'Format Link URL', 'optione' ),
                                'description' => esc_html__( 'Link will show when set post format is link', 'optione' ),
                            ),
                            array(
                                'id'          => 'featured-link-text',
                                'type'        => 'text',
                                'title'       => esc_html__( 'Format Link Text', 'optione' ),
                            ),
                        )
					)
				]
			]
		],
		'page' => [
			'opt_name'            => 'pxl_page_options',
			'display_name'        => esc_html__( 'Page Settings', 'optione' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'header' => [
					'title'  => esc_html__( 'Header', 'optione' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
				        optione_header_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
                        array(
                            array(
                                'id'       => 'remove_header',
                                'title'    => esc_html__('Remove Header', 'optione'),
                                'subtitle' => esc_html__('Header will not display.', 'optione'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','optione'),
                                    '0'  => esc_html__('No','optione'),
                                ),
                                'default'  => '0',
                            ),
                        ),
						array(
					        array(
				                'id'       => 'pd_menu',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu', 'optione' ),
				                'options'  => optione_get_nav_menu_slug(),
				                'default' => '-1',
				            ),
					    )
				    )
				],
				'header_mobile' => [
					'title'  => esc_html__( 'Header Mobile', 'optione' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
				        optione_header_mobile_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
						array(
					        array(
				                'id'       => 'pm_menu',
				                'type'     => 'select',
				                'title'    => esc_html__( 'Menu', 'optione' ),
				                'options'  => optione_get_nav_menu_slug(),
				                'default' => '-1',
				            ),
					    )
				    )
				],
				'page_title' => [
					'title'  => esc_html__( 'Page Title', 'optione' ),
					'icon'   => 'el el-indent-left',
					'fields' => array_merge(
				        optione_page_title_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'optione' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'optione' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
				    )

				],
				'content' => [
					'title'  => esc_html__( 'Content', 'optione' ),
					'icon'   => 'el-icon-pencil',
					'fields' => array_merge(
						optione_sidebar_pos_opts(['prefix' => 'page_', 'default' => false, 'default_value' => '0']),
						array(
							array(
								'id'             => 'content_padding',
								'type'           => 'spacing',
								'output'         => array( '#pxl-main' ),
								'right'          => false,
								'left'           => false,
								'mode'           => 'padding',
								'units'          => array( 'px' ),
								'units_extended' => 'false',
								'title'          => esc_html__( 'Content Padding', 'optione' ),
								'default'        => array(
									'padding-top'    => '',
									'padding-bottom' => '',
									'units'          => 'px',
								)
							),
                            array(
                                'id'       => 'content_bg_color',
                                'type'     => 'color_rgba',
                                'title'    => esc_html__( 'Background Color', 'optione' ),
                                'subtitle' => esc_html__( 'Content background color.', 'optione' ),
                                'output'   => array( 'background-color' => 'body' )
                            ),
						)  
					)
				],
				'footer' => [
					'title'  => esc_html__( 'Footer', 'optione' ),
					'icon'   => 'el el-website',
					'fields' => array_merge(
				        optione_footer_opts([
							'default'         => true,
							'default_value'   => '-1'
						]),
                        array(
                            array(
                                'id'       => 'remove_footer',
                                'title'    => esc_html__('Remove Footer', 'optione'),
                                'subtitle' => esc_html__('Footer will not display.', 'optione'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','optione'),
                                    '0'  => esc_html__('No','optione'),
                                ),
                                'default'  => '0',
                            ),
                        ),
				    )
				],
				'colors' => [
					'title'  => esc_html__( 'Colors', 'optione' ),
					'icon'   => 'el el-website',
					'fields' => array(
				        array(
				            'id'          => 'primary_color',
				            'type'        => 'color',
				            'title'       => esc_html__('Primary Color', 'optione'),
				            'transparent' => false,
				            'default'     => ''
				        ), 
				        array(
				            'id'          => 'secondary_color',
				            'type'        => 'color',
				            'title'       => esc_html__('Secondary Color', 'optione'),
				            'transparent' => false,
				            'default'     => ''
				        ),
				    )
				]
			]
		],
        //product
		'product' => [ 
			'opt_name'            => 'pxl_product_options',
			'display_name'        => esc_html__( 'Product Settings', 'optione' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'general' => [
					'title'  => esc_html__( 'General', 'optione' ),
					'icon'   => 'el-icon-website',
					'fields' => array_merge(
						array(
							array(
					            'id'=> 'product_feature_text',
					            'type' => 'text',
					            'title' => esc_html__('Featured Text', 'optione'),
					            'default' => '',
					        ),
                            array(
                                'id'       => 'gallery_layout',
                                'type'     => 'button_set',
                                'title'    => esc_html__('Single Gallery', 'optione'),
                                'options'  => array(
                                    'simple' => esc_html__('Simple', 'optione'),
                                    'horizontal' => esc_html__('Horizontal', 'optione'),
                                    'vertical' => esc_html__('Vertical', 'optione'),
                                ),
                                'default'  => 'horizontal'
                            ),
                            array(
                                'id'    => 'product_page_style',
                                'type'  => 'select',
                                'title' => esc_html__('Product Page Style', 'optione'),
                                'options' => [
                                    'style1'           => esc_html__('Style 1', 'optione'),
                                    'style2'           => esc_html__('Style 2', 'optione'),
                                ],
                                'default' => 'style1',
                            ),
                            
						),
				    )
				],
                'header' => [
                    'title'  => esc_html__( 'Header', 'optione' ),
                    'icon'   => 'el-icon-website',
                    'fields' => array_merge(
                        optione_header_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'       => 'remove_header',
                                'title'    => esc_html__('Remove Header', 'optione'),
                                'subtitle' => esc_html__('Header will not display.', 'optione'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','optione'),
                                    '0'  => esc_html__('No','optione'),
                                ),
                                'default'  => '0',
                            ),
                        ),
                    
                        array(
                            array(
                                'id'       => 'pd_menu',
                                'type'     => 'select',
                                'title'    => esc_html__( 'Menu', 'optione' ),
                                'options'  => optione_get_nav_menu_slug(),
                                'default' => '-1',
                            ),
                        )
                    )
                ],
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'optione' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        optione_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'optione' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'optione' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )

                ],
                'footer' => [
                    'title'  => esc_html__( 'Footer', 'optione' ),
                    'icon'   => 'el el-website',
                    'fields' => array_merge(
                        optione_footer_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'       => 'remove_footer',
                                'title'    => esc_html__('Remove Footer', 'optione'),
                                'subtitle' => esc_html__('Footer will not display.', 'optione'),
                                'type'     => 'button_set',
                                'options'  => array(
                                    '1'  => esc_html__('Yes','optione'),
                                    '0'  => esc_html__('No','optione'),
                                ),
                                'default'  => '0',
                            ),
                        ),
                    )
                ],
			],
		],
		'pxl-case-study' => [ //post_type
			'opt_name'            => 'pxl_case_study_options',
			'display_name'        => esc_html__( 'Page Settings', 'optione' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'optione' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        optione_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'optione' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'optione' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )

                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'optione' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#pxl-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'optione' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                            array(
                                'id'       => 'title_tag_on',
                                'title'    => esc_html__('Title & Tags', 'optione'),
                                'subtitle' => esc_html__('Display the Title & Tags at top of post.', 'optione'),
                                'type'     => 'switch',
                                'default'  => '0'
                            ),
                        )
                    )
                ],
			]
		],
        'pxl-service' => [ //post_type
            'opt_name'            => 'pxl_service_options',
            'display_name'        => esc_html__( 'Page Settings', 'optione' ),
            'show_options_object' => false,
            'context'  => 'advanced',
            'priority' => 'default',
            'sections'  => [
                'page_title' => [
                    'title'  => esc_html__( 'Page Title', 'optione' ),
                    'icon'   => 'el el-indent-left',
                    'fields' => array_merge(
                        optione_page_title_opts([
                            'default'         => true,
                            'default_value'   => '-1'
                        ]),
                        array(
                            array(
                                'id'           => 'custom_main_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Main Title', 'optione' ),
                                'subtitle'     => esc_html__( 'Custom heading text title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            ),
                            array(
                                'id'           => 'custom_sub_title',
                                'type'         => 'text',
                                'title'        => esc_html__( 'Custom Sub title', 'optione' ),
                                'subtitle'     => esc_html__( 'Add short description for page title', 'optione' ),
                                'required' => array( 'pt_mode', '=', 'bd' )
                            )
                        )
                    )

                ],
                'content' => [
                    'title'  => esc_html__( 'Content', 'optione' ),
                    'icon'   => 'el-icon-pencil',
                    'fields' => array_merge(
                        array(
                            array(
                                'id'             => 'content_padding',
                                'type'           => 'spacing',
                                'output'         => array( '#pxl-main' ),
                                'right'          => false,
                                'left'           => false,
                                'mode'           => 'padding',
                                'units'          => array( 'px' ),
                                'units_extended' => 'false',
                                'title'          => esc_html__( 'Content Padding', 'optione' ),
                                'default'        => array(
                                    'padding-top'    => '',
                                    'padding-bottom' => '',
                                    'units'          => 'px',
                                )
                            ),
                        )
                    )
                ],
                'additional_data' => [
                    'title'  => esc_html__( 'Additional Data', 'optione' ),
                    'icon'   => 'el el-list-alt',
                    'fields' => array(
                        array(
                            'id'       => 'area_icon_type',
                            'type'     => 'button_set',
                            'title'    => esc_html__('Icon Type', 'optione'),
                            'desc'     => esc_html__( 'This image icon will display in post grid or carousel', 'optione' ),
                            'options'  => array(
                                'icon'  => esc_html__('Icon', 'optione'),
                                'image'  => esc_html__('Image', 'optione'),
                            ),
                            'default'  => 'image'
                        ),
                        array(
                            'id'       => 'area_icon',
                            'type'     => 'pxl_iconpicker',
                            'title'    => esc_html__( 'Select Icon', 'optione' ),
                            'default'  => '',
                            'required' => array( 0 => 'area_icon_type', 1 => 'equals', 2 => 'icon' ),
                        ),
                        array(
                            'id'       => 'area_img',
                            'type'     => 'media',
                            'title'    => esc_html__('Select Image', 'optione'),
                            'default' => '',
                            'required' => array( 0 => 'area_icon_type', 1 => 'equals', 2 => 'image' ),
                            'force_output' => true
                        ),

                    ),

                ],
            ]
        ],
		'pxl-template' => [ //post_type
			'opt_name'            => 'pxl_hidden_template_options',
			'display_name'        => esc_html__( 'Template Settings', 'optione' ),
			'show_options_object' => false,
			'context'  => 'advanced',
			'priority' => 'default',
			'sections'  => [
				'general' => [
					'title'  => esc_html__( 'General', 'optione' ),
					'icon'   => 'el-icon-website',
					'fields' => array(
						array(
							'id'    => 'template_type',
							'type'  => 'select',
							'title' => esc_html__('Template Type', 'optione'),
				            'options' => [
                                'default'      => esc_html__('Default', 'optione'),
								'header'       => esc_html__('Header', 'optione'), 
								'footer'       => esc_html__('Footer', 'optione'), 
								'mega-menu'    => esc_html__('Mega Menu', 'optione'), 
								'page-title'   => esc_html__('Page Title', 'optione'), 
								'hidden-panel' => esc_html__('Hidden Panel', 'optione'),
                                'tab'          => esc_html__('Tab', 'optione'), 
                            ],
				            'default' => 'default',
				        ),
				        array(
							'id'       => 'template_position',
							'type'     => 'select',
							'title'    => esc_html__('Hidden Panel Position', 'optione'),
							'options'  => [
                                'full' => esc_html__('Full Screen', 'optione'),
                                'top'   => esc_html__('Top Position', 'optione'),
								'left'   => esc_html__('Left Position', 'optione'),
								'right'  => esc_html__('Right Position', 'optione'),
                                'center'  => esc_html__('Center Position', 'optione'),
				            ],
							'default'  => 'full',
							'required' => [ 'template_type', '=', 'hidden-panel']
				        ),
					),
				    
				],
			]
		],
	];
 
	$metabox->add_meta_data( $panels );
}
 