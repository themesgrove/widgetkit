<?php

use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor Perfecto WidgetKit Gallery
 *
 * Elementor widget for WidgetKit Gallery
 *
 * @since 1.0.0
 */
class wkfe_gallery extends Widget_Base {

	public function get_name() {
		return 'widgetkit-gallery';
	}

	public function get_title() {
		return esc_html__( 'Gallery', 'widgetkit-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-apps';
	}

	public function get_categories() {
		return [ 'widgetkit_elementor' ];
	}
	/**
	 * A list of style that the widgets is depended in
	 **/
	public function get_style_depends() {
        return [
            'widgetkit_bs',
            'widgetkit_main',
            'uikit',
        ];
    }
	/**
	 * A list of scripts that the widgets is depended in
	 **/
	public function get_script_depends() {
		return [ 
			'widgetkit-main',
			'uikit-js',
            'uikit-icons',
		 ];
	}
	
	protected function _register_controls() {
			// Content options Start
	$this->start_controls_section(
		'section_content',
		[
			'label' => esc_html__( 'Galleries', 'widgetkit-for-elementor' ),
		]
	);


	$repeater = new Repeater();
	    $repeater->add_control(
		    'gallery_title',
		      	[
		          'label'   => esc_html__( 'Title', 'widgetkit-for-elementor' ),
		          'type'    => Controls_Manager::TEXT,
		          'default' => esc_html__( 'Switch Pro', 'widgetkit-for-elementor' ),
		    	]
	    );




		$repeater->add_control(
	       'gallery_thumb_image',
		        [
		          'label' => esc_html__( 'Main Image', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::MEDIA,
		           'default'  => [
						'url' => Utils::get_placeholder_image_src(),
					],
		        ]
	    );

	    $repeater->add_control(
	       'gallery_preview_image',
		        [
		          'label' => esc_html__( 'Preview Image', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::MEDIA,
		           'default'  => [
						'url' => Utils::get_placeholder_image_src(),
					],
		        ]
	    );

		$repeater->add_control(
		    'gallery_desc',
		      	[
		          'label'   => esc_html__( 'Description', 'widgetkit-for-elementor' ),
		          'type'    => Controls_Manager::TEXTAREA,
		          'default' => esc_html__( '', 'widgetkit-for-elementor' ),
		      	]
		);

		$repeater->add_control(
			'filter_tag',
			[
				'label'   => esc_html__( 'Filter Tag', 'widgetkit-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'business', 'widgetkit-for-elementor' ),
			]
		);

		$repeater->add_control(
            'item_order',
                [
                    'label'       => __( 'Orderby', 'widgetkit-for-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'default',
                    'options' => [
                        'default' => __( 'Defualt', 'widgetkit-for-elementor' ),
                        'first'   => __( 'First', 'widgetkit-for-elementor' ),
                        'last'    => __( 'Last', 'widgetkit-for-elementor' ),
                    ],
                ]
        );


		$repeater->add_control(
			'demo_link',
			[
				'label' => __( 'Link', 'widgetkit-for-elementor' ),
				'type' => Controls_Manager::URL,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'https://your-link.com', 'widgetkit-for-elementor' ),
				'default' => [
					'url' => '#',
				],
			]
		);


		$this->add_control(
		    'gallery_content',
		      [
		          'label'       => esc_html__( 'Contents', 'widgetkit-for-elementor' ),
		          'type'        => Controls_Manager::REPEATER,
		          'show_label'  => true,
		          'default'     => [
		              [
		                'gallery_title' => esc_html__( 'Switch Pro', 'widgetkit-for-elementor' ),
		                'gallery_desc' => esc_html__( 'Multiple Business WordPress Theme', 'widgetkit-for-elementor'),
		                'gallery_thumb_image' => '',
		                'gallery_preview_image' => '',
		                'filter_tag' => esc_html__('business', 'widgetkit-for-elementor'),
		                'demo_link' => 'https://themesgrove.com/product/switch-pro/',
		 
		              ],
		              [
		                'gallery_title' => esc_html__( 'Exploore', 'widgetkit-for-elementor' ),
		                'gallery_desc' => esc_html__( 'WordPress Bloging Theme', 'widgetkit-for-elementor'),
		                'gallery_thumb_image' => '',
		                'gallery_full_image' => '',
		                'filter_tag' => esc_html__('business', 'widgetkit-for-elementor'),
		                'demo_link' => 'https://themesgrove.com/product/exploore/',
		 
		              ],
		              [
		                'gallery_title' => esc_html__( 'Universidad', 'widgetkit-for-elementor' ),
		                'gallery_desc'  => esc_html__( 'Education WordPress Theme', 'widgetkit-for-elementor'),
		                'gallery_thumb_image' => '',
		                'gallery_preview_image' => '',
		                'filter_tag' => esc_html__('education', 'widgetkit-for-elementor'),
		                'demo_link' => 'https://themesgrove.com/product/universidad/',
		 
		              ]


		          ],
		          'fields'      => array_values( $repeater->get_controls() ),
		          'title_field' => '{{{gallery_title}}}',
		      ]
		  );

	$this->end_controls_section();
	// Content options End



		$this->start_controls_section(
			'item_layout',
			[
				'label' => esc_html__( 'Layout', 'widgetkit-for-elementor' ),
				// 'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'colmun_width',
				[
					'label'     => esc_html__( 'Column Width', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'grid',
					'options'   => [
						'grid'     => esc_html__( 'Grid', 'widgetkit-for-elementor' ),
						'auto'     => esc_html__( 'Auto', 'widgetkit-for-elementor' ),
					],
				]
		);


		$this->add_control(
			'colmun_layout',
				[
					'label'     => esc_html__( 'Number of Column', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => '1-3',
					'options'   => [
						'1-1'     => esc_html__( '1', 'widgetkit-for-elementor' ),
						'1-2'     => esc_html__( '2', 'widgetkit-for-elementor' ),
						'1-3'     => esc_html__( '3', 'widgetkit-for-elementor' ),
						'1-4'     => esc_html__( '4', 'widgetkit-for-elementor' ),
						'1-5'     => esc_html__( '5', 'widgetkit-for-elementor' ),
						'1-6'     => esc_html__( '6', 'widgetkit-for-elementor' ),
					],
					'condition' => [
						'colmun_width' => 'grid',
					],
				]
		);


        $this->add_control(
            'column_gap',
                [
                    'label'       => __( 'Colum Gap', 'widgetkit-for-elementor' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'small',
                    'options' => [
                        'collapse'=> __( 'None', 'widgetkit-for-elementor' ),
                        'small'   => __( 'Small', 'widgetkit-for-elementor' ),
                        'medium'  => __( 'Medium', 'widgetkit-for-elementor' ),
                        'large'   => __( 'Large', 'widgetkit-for-elementor' ),
                    ],
                ]
        );

        $this->add_control(
			'hover_effect',
				[
					'label'     => esc_html__( 'Hover Effect', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'square',
					'options'   => [
						'from-right'    => esc_html__( 'From Right', 'widgetkit-for-elementor' ),
						'from-left'     => esc_html__( 'From Left', 'widgetkit-for-elementor' ),
						'square'        => esc_html__( 'Square', 'widgetkit-for-elementor' ),
					],
				]
		);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_contorls',
			[
				'label' => esc_html__( 'Controls', 'widgetkit-for-elementor' ),
				// 'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

			$this->add_control(
				'masonary_enable',
				[
					'label'     => esc_html__( 'Masonary', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'enable'    => esc_html__( 'Enable', 'widgetkit-for-elementor' ),
					'disable'   => esc_html__( 'Disable', 'widgetkit-for-elementor' ),
				]
			);

			$this->add_control(
				'lightcase_enable',
				[
					'label'     => esc_html__( 'Lightcase', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'enable'    => esc_html__( 'Enable', 'widgetkit-for-elementor' ),
					'disable'   => esc_html__( 'Disable', 'widgetkit-for-elementor' ),
				]
			);

			$this->add_control(
				'lightcase_animation',
					[
						'label'     => esc_html__('Animation', 'widgetkit-for-elementor' ),
						'type'      => Controls_Manager::SELECT,
						'default'   => 'scale',
						'options'   => [
							'none'     => esc_html__( 'None', 'widgetkit-for-elementor' ),
							'slide'    => esc_html__( 'Slide', 'widgetkit-for-elementor' ),
							'fade'     => esc_html__( 'Fade', 'widgetkit-for-elementor' ),
							'scale'    => esc_html__( 'Scale', 'widgetkit-for-elementor' ),
						],
						'condition' => [
							'lightcase_enable' => 'yes',
						],
					]
			);

			$this->add_control(
				'link_enable',
				[
					'label'     => esc_html__( 'Link', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SWITCHER,
					'default'   => 'yes',
					'enable'    => esc_html__( 'Enable', 'widgetkit-for-elementor' ),
					'disable'   => esc_html__( 'Disable', 'widgetkit-for-elementor' ),
				]
			);


		$this->end_controls_section();

		$this->start_controls_section(
			'section_content_filter',
			[
				'label' => esc_html__( 'Filter', 'widgetkit-for-elementor' ),
				// 'tab'   => Controls_Manager::TAB_STYLE,
			]
		);


		$this->add_control(
			'filter_enable',
			[
				'label'     => esc_html__( 'Display', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'yes',
				'enable'    => esc_html__( 'Enable', 'widgetkit-for-elementor' ),
				'disable'   => esc_html__( 'Disable', 'widgetkit-for-elementor' ),
			]
		);

		$this->add_control(
			'filter_show_title',
			[
				'label'   => esc_html__( 'Show All', 'widgetkit-for-elementor' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( 'All', 'widgetkit-for-elementor' ),
				'condition' => [
					'filter_enable' => 'yes',
				],
			]
		);

		$this->end_controls_section();



	/**
	 * Pro control panel 
	 */
	if(!apply_filters('wkpro_enabled', false)):
		$this->start_controls_section(
			'section_widgetkit_pro_box',
			[
				'label' => esc_html__( 'Go Premium for more layout & feature', 'widgetkit-for-elementor' ),
			]
		);
			$this->add_control(
				'wkfe_control_go_pro',
				[
					'label' => __('Unlock more possibilities', 'widgetkit-for-elementor'),
					'type' => Controls_Manager::CHOOSE,
					'default' => '1',
					'description' => '<div class="elementor-nerd-box">
					<div class="elementor-nerd-box-message"> Get the  <a href="https://themesgrove.com/widgetkit-for-elementor/" target="_blank">Pro version</a> of <a href="https://themesgrove.com/widgetkit-for-elementor/" target="_blank">WidgetKit</a> for more stunning elements and customization options.</div>
					<a class="widgetkit-go-pro elementor-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="https://themesgrove.com/widgetkit-for-elementor/" target="_blank">Go Pro</a>
					</div>',
				]
			);
		$this->end_controls_section();
	endif;


		$this->start_controls_section(
			'section_style',
			[
				'label' => esc_html__( 'Filter', 'widgetkit-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition'=> [
			        'filter_enable' => 'yes',
			    ],
			]
		);

			$this->add_group_control(
				Group_Control_Typography::get_type(),
					[
						'name'     => 'filter_typography',
						'label'    => esc_html__( 'Typography', 'widgetkit-for-elementor' ),
						'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
						'selector' => '{{WRAPPER}} .wk-gallery .wk-tab li a',
						'condition'=> [
			                'filter_enable' => 'yes',
			            ],
					]
			);

			$this->add_control(
				'filter_layout_align',
				[
					'label' => esc_html__( 'Alignment', 'widgetkit-for-elementor' ),
					'type'  => Controls_Manager::CHOOSE,
					'default'   => 'center',
					'options' => [
						'left'    => [
							'title' => esc_html__( 'Left', 'widgetkit-for-elementor' ),
							'icon'  => 'eicon-text-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'widgetkit-for-elementor' ),
							'icon'  => 'eicon-text-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'widgetkit-for-elementor' ),
							'icon'  => 'eicon-text-align-left',
						],
					],
					'condition' => [
						'filter_enable' => 'yes',
					],
				]
			);

			$this->add_group_control(
	            Group_Control_Border::get_type(),
	            [
	                'name'  => 'filter_border',
	                'label' => esc_html__( 'Border', 'widgetkit-for-elementor' ),
	                'placeholder' => '1px',
	                'default'  => '1px',
	                'selector' => '
	                    {{WRAPPER}} .wk-gallery .wk-tab li a',
	                //'separator' => 'before',
	                'condition'=> [
		                'filter_enable' => 'yes',
		            ],
	            ]
	        );
		    $this->add_control(
	            'filter_border_radius',
	            [
	                'label' => esc_html__( 'Border Radius', 'widgetkit-for-elementor' ),
	                'type'  => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', '%' ],
	                'selectors'  => [
	                    '{{WRAPPER}} .wk-gallery .wk-tab li a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	                'condition'=> [
		                'filter_enable' => 'yes',
		            ],
	            ]
	        );


	        $this->add_control(
	            'filternav_padding',
	            [
	                'label' => esc_html__( 'Padding', 'widgetkit-for-elementor' ),
	                'type'  => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', '%' ],
	                'selectors'  => [
	                    '{{WRAPPER}} .wk-gallery .wk-tab li a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	               'condition'=> [
		                'filter_enable' => 'yes',
		            ],
	            ]
	        );

		    $this->add_responsive_control(
				'filter_spacing',
					[
						'label'   => esc_html__( 'Spacing', 'widgetkit-for-elementor' ),
						'type'    => Controls_Manager::SLIDER,
						'default' => [
						'size' =>60,
						],
						'range'  => [
							'px' => [
								'min' =>0,
								'max' => 200,
							],
						],
						'selectors' => [
							'{{WRAPPER}} .wk-gallery .wk-tab' => 'margin-bottom:{{SIZE}}{{UNIT}};',
						],
						'condition'=> [
			                'filter_enable' => 'yes',
			            ],
					]
				);



		    $this->start_controls_tabs( 'tabs_nav_style' );

		    $this->start_controls_tab(
		        'filter_nav_normal',
		          [
		            'label' => esc_html__( 'Normal', 'widgetkit-for-elementor' ),
		            'condition'=> [
		                'filter_enable' => 'yes',
		            ],
		          ]
		    );
			$this->add_control(
				'filter_color',
				[
					'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .wk-gallery .wk-tab li a' => 'color: {{VALUE}};',
					],
					'condition' => [
		                'filter_enable' => 'yes',
		            ],
				]
			);


            $this->add_control(
                'filter_background_color',
                    [
                        'label' => esc_html__( 'Background Color', 'widgetkit-for-elementor' ),
                        'type'  => Controls_Manager::COLOR,
                        'default'   => '',
                        'selectors' => [
                          '{{WRAPPER}} .wk-gallery .wk-tab li a' => 'background-color: {{VALUE}};',
                        ],
                        'condition'=> [
		                	'filter_enable' => 'yes',
		            	],
                    ]
            );




		    $this->end_controls_tab();


		    $this->start_controls_tab(
		        'tab_nav_hover',
		            [
		                'label' => esc_html__( 'Hover', 'widgetkit-for-elementor' ),
		                'condition'=> [
		                	'filter_enable' => 'yes',
		            	],
		            ]
		    );

		    $this->add_control(
				'filter_hover_color',
				[
					'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '',
					'selectors' => [
						'{{WRAPPER}} .wk-gallery .wk-tab li a:hover, {{WRAPPER}} .wk-gallery .wk-tab .wk-active a' => 'color: {{VALUE}};',
					],
					'condition' => [
		                'filter_enable' => 'yes',
		            ],
				]
			);



		    $this->add_control(
		        'filter_background_hover_color',
		            [
		                'label' => esc_html__( 'Background Color', 'widgetkit-for-elementor' ),
		                'type'  => Controls_Manager::COLOR,
		                'default'   => '',
		                'selectors' => [
		                  '{{WRAPPER}} .wk-gallery .wk-tab li a:hover, {{WRAPPER}} .wk-gallery .wk-tab .wk-active a' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
		                ],
		               'condition'=> [
			                'filter_enable' => 'yes',
			            ],
		            ]
		    );

	    	$this->add_group_control(
				Group_Control_Box_Shadow::get_type(),
				[
					'name'    => 'filter_box_shadow',
					'label'     => esc_html__( 'Shadow', 'widgetkit-for-elementor' ),
					'exclude' => [
						'box_shadow_position',
					],
					'condition'=> [
			            'filter_enable' => 'yes',
			        ],
					'selector' => '{{WRAPPER}} .wk-gallery .wk-tab li a:hover, {{WRAPPER}} .wk-gallery .wk-tab .wk-active a',
				]
			);

	    $this->end_controls_tab();


	    $this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'section_overlay_style',
			[
				'label' => esc_html__( 'Overlay', 'widgetkit-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'overlay_color',
			[
				'label'     => esc_html__( 'Overlay Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => 'rgba(0,0,0,0.66)',
				'selectors' => [
					'{{WRAPPER}} .wk-gallery .wk-card:before
						'  => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
            'portfolio_overlay_title',
            [
                'label' => esc_html__( 'Title', 'widgetkit-for-elementor' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
			'overlay_title_color',
			[
				'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .wk-gallery .wk-card .wk-card-body a .wk-card-title,
					{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .wk-card-title' => 'color: {{VALUE}};',
				],
			]
		);


		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'overlay_title_typography',
					'label'    => esc_html__( 'Typography', 'widgetkit-for-elementor' ),
					'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .wk-card-title',
				]
		);

		$this->add_control(
            'gallery_desc_heading',
            [
                'label' => esc_html__( 'Description', 'widgetkit-for-elementor' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'overlay_desc_color',
			[
				'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#fff',
				'selectors' => [
					'{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .wk-text-desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'overlay_desc_typography',
					'label'    => esc_html__( 'Typography', 'widgetkit-for-elementor' ),
					'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .wk-text-desc',
				]
		);


		$this->add_control(
            'icon_heading',
            [
                'label' => esc_html__( 'Icon', 'widgetkit-for-elementor' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

		$this->add_control(
			'overlay_icon_color',
			[
				'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .gallery-lightbox a' => 'color: {{VALUE}};',
					],
			]
		);

		$this->add_control(
			'overlay_icon_bg_color',
			[
				'label'     => esc_html__( 'Background Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .gallery-lightbox a' => 'background-color: {{VALUE}}; border:1px solid {{VALUE}}; ',
				],
			]
		);

		$this->add_control(
			'overlay_icon_hover_bg_color',
			[
				'label'     => esc_html__( 'Hover Background Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .gallery-lightbox a:hover' => 'background-color: {{VALUE}};'
					 
					],
			]
		);

		$this->add_control(
            'overlay_icon_border_radius',
            [
                'label' => esc_html__( 'Border Radius', 'widgetkit-for-elementor' ),
                'type'  => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors'  => [
                    '{{WRAPPER}} .wk-gallery .wk-card .wk-card-body .gallery-lightbox a
                    ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );


		$this->end_controls_section();
	}

	protected function render() {
		require WK_PATH . '/elements/gallery/template/view.php';
	}


}
