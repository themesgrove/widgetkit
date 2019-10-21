<?php

use Elementor\Group_Control_Box_Shadow;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Widget_Base;
use Elementor\Utils;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor WidgetKit Team
 *
 * Elementor widget for WidgetKit team
 *
 * @since 1.0.0
 */
class wkfe_team extends Widget_Base {

	public function get_name() {
		return 'widgetkit-for-elementor-team';
	} 

	public function get_title() {
		return esc_html__( 'Team', 'widgetkit-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-person';
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
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'widgetkit-for-elementor' ),
			]
		);


		$this->add_control(
			'item_option',
				[
					'label'     => esc_html__( 'Choose Content', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'single_content',
					'options'   => [
						'single_content'    => esc_html__( 'Single', 'widgetkit-for-elementor' ),
						'repeat_content'    => esc_html__( 'Repeat', 'widgetkit-for-elementor' ),
					],
				]
		);

		$this->add_control(
	       'single_image',
		        [
		            'label' => esc_html__( 'Image', 'widgetkit-for-elementor' ),
		            'type'  => Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
				  	],
				  	'condition'   => [
                        'item_option' => 'single_content',
                    ],
		     ]
	    );



	    $this->add_control(
		    'single_title',
		      	[
		           'label' => esc_html__( 'Title', 'widgetkit-for-elementor' ),
		           'type'  => Controls_Manager::TEXTAREA,
		           'default' => esc_html__( 'Alex Prokopenko', 'widgetkit-for-elementor' ),
		           'condition'   => [
                        'item_option' => 'single_content',
                    ],
		    	]
	    );


	   	$this->add_control(
		    'single_designation',
		      	[
		           'label' => esc_html__( 'Designation', 'widgetkit-for-elementor' ),
		           'type'  => Controls_Manager::TEXTAREA,
		           'default' => esc_html__( 'Graphics Designer', 'widgetkit-for-elementor' ),
		           'condition'   => [
                        'item_option' => 'single_content',
                    ],
		      	]
		);

		$this->add_control(
		    'single_content',
		      	[
		            'label' => esc_html__( 'Description', 'widgetkit-for-elementor' ),
		            'type'  => Controls_Manager::TEXTAREA,
		            'default' => esc_html__( 'This is the place to present the bio of Jason. He is a cat and dog loving person, who loves sunday ice creams, Lady Gaga and everything Apple related.', 'widgetkit-for-elementor' ),
		            'condition'   => [
                        'item_option' => 'single_content',
                    ],
		      	]
		);


		$this->add_control(
			'single_content_link',
				[
					'label' => __( 'Link', 'widgetkit-for-elementor' ),
					'type'  => Controls_Manager::URL,
					'dynamic' => [
						'active'  => true,
					],
					'placeholder' => __( 'https://your-link.com', 'widgetkit-for-elementor' ),
					'separator'   => 'after',
					'condition'   => [
                        'item_option' => 'single_content',
                    ],
                    'default' => [
							'url' => 'https://www.themesgrove.com', 
						],
				]
			);






			$repeater = new Repeater();

			    $repeater->add_control(
			      'title',
			      [
			          'label'   => esc_html__( 'Social Name', 'widgetkit-for-elementor' ),
			          'type'    => Controls_Manager::TEXT,
			          'default' => esc_html__( 'Facebook', 'widgetkit-for-elementor' ),
			      ]
			    );


				$repeater->add_control(
		            'social_link',
		            [
		                'label' => esc_html__( 'Social Link', 'widgetkit-for-elementor' ),
		                'type'  => Controls_Manager::URL,
		                'dynamic' => [
							'active' => true,
						],
						'placeholder' => __( 'https://www.facebook.com/themesgrove', 'widgetkit-for-elementor' ),
						'default' => [
							'url' => 'https://www.facebook.com/themesgrove', 
						],
		            ]
		        );

		        $repeater->add_control(
		            'social_icon',
		            [
		                'label' => esc_html__( 'Social Icon', 'widgetkit-for-elementor' ),
		                'type'  => Controls_Manager::ICON,
		                'default' => 'fa fa-facebook',
		            ]
		        );


			$this->add_control(
			    'social_share',
			      [
			          'label'       => esc_html__( 'Social Links', 'widgetkit-for-elementor' ),
			          'type'        => Controls_Manager::REPEATER,
			          'show_label'  => true,
			          'default'     => [
			              [
			              	'title'       => esc_html__( 'Facebook', 'widgetkit-for-elementor' ),
			                'social_link' => esc_html__( 'https://www.facebook.com/themesgrove', 'widgetkit-for-elementor' ),
			                'social_icon' => 'fa fa-facebook',
			 
			              ],
			              [
			              	'title'       => esc_html__( 'Twitter', 'widgetkit-for-elementor' ),
			                'social_link' => esc_html__( 'https://www.twitter.com/themesgrove', 'widgetkit-for-elementor' ),
			                'social_icon' => 'fa fa-twitter',
			 
			              ],
			              [
			              	'title'       => esc_html__( 'Linkedin', 'widgetkit-for-elementor' ),
			                'social_link' => esc_html__( 'https://www.linkedin.com/themesgrove', 'widgetkit-for-elementor' ),
			                'social_icon' => 'fa fa-linkedin',
			 
			              ]
			          ],
			          'fields'      => array_values( $repeater->get_controls() ),
			          'title_field' => '{{{title}}}',
			          'condition'   => [
                        	'item_option' => 'single_content',
                    	],
			      ]
			  );





		$repeater = new Repeater();

            $repeater->add_control(
               'repeater_image',
                    [
                      'label' => esc_html__( 'Image', 'widgetkit-for-elementor' ),
                      'type'  => Controls_Manager::MEDIA,
                      'default' => [
                        'url'   => Utils::get_placeholder_image_src(),
                      ],
                    ]
            );

            $repeater->add_control(
                'repeater_title',
                    [
                      'label'   => esc_html__( 'Title', 'widgetkit-for-elementor' ),
                      'type'    => Controls_Manager::TEXT,
                      'default' => esc_html__( 'Alex Prokopenko', 'widgetkit-for-elementor' ),
                    ]
            );

            $repeater->add_control(
                'repeater_designation',
                    [
                      'label'   => esc_html__( 'Designation', 'widgetkit-for-elementor' ),
                      'type'    => Controls_Manager::TEXT,
                      'default' => esc_html__( 'Business Development', 'widgetkit-for-elementor' ),
                    ]
            );

            $repeater->add_control(
                'repeater_content',
                    [
                      'label'   => esc_html__( 'Content', 'widgetkit-for-elementor' ),
                      'type'    => Controls_Manager::TEXTAREA,
                      'default' => esc_html__( '', 'widgetkit-for-elementor' ),
                    ]
            );

	        $repeater->add_control(
				'repeater_demo_link',
				[
					'label' => __( 'Link', 'widgetkit-for-elementor' ),
					'type'  => Controls_Manager::URL,
					'dynamic' => [
						'active'  => true,
					],
					'placeholder' => __( 'https://your-link.com', 'widgetkit-for-elementor' ),
					'separator'   => 'before',
				]
			);

			$repeater->add_control(
		                'social_heading',
		                [
		                    'label' => __( 'Social Links', 'widgetkit-for-elementor' ),
		                    'type'  => Controls_Manager::HEADING,
		                    //'separator' => 'before',
		                ]
		            );

			$repeater->add_control(
				'repeater_facebook_link',
					[
						'label' => __( 'Facebook', 'widgetkit-for-elementor' ),
						'type'  => Controls_Manager::URL,
						'dynamic' => [
							'active'  => true,
						],
						'placeholder' => __( 'https://facebook.com/themesgrove', 'widgetkit-for-elementor' ),					]
				);

			 $repeater->add_control(
				'repeater_twitter_link',
					[
						'label' => __( 'Twitter', 'widgetkit-for-elementor' ),
						'type'  => Controls_Manager::URL,
						'dynamic' => [
							'active'  => true,
						],
						'placeholder' => __( 'https://twitter.com/themesgrove', 'widgetkit-for-elementor' ),
						'separator'   => 'before',
					]
				);

			 $repeater->add_control(
				'repeater_linkeding_link',
					[
						'label' => __( 'Linkeding', 'widgetkit-for-elementor' ),
						'type'  => Controls_Manager::URL,
						'dynamic' => [
							'active'  => true,
						],
						'placeholder' => __( 'https://linkedin.com/themesgrove', 'widgetkit-for-elementor' ),
						'separator'   => 'before',
					]
				);



        $this->add_control(
            'repeater_content',
              [
                    'label'       => esc_html__( 'Repeater Contents', 'widgetkit-for-elementor' ),
                    'type'        => Controls_Manager::REPEATER,
                    'show_label'  => true,
                    'separator'  => 'before',
                    'default'     => [
                      [
                      	'repeater_image' => '',
                      	'repeater_title'       => esc_html__( 'Alex Prokopenko', 'widgetkit-for-elementor' ),
                        'repeater_designation'    => esc_html__( 'Business Development', 'widgetkit-for-elementor' ),
                        'repeater_content'     => esc_html__( '', 'widgetkit-for-elementor' ), 
                        'repeater_demo_link'   => '#',
                        'repeater_facebook_link'    =>'#',
                        'repeater_twitter_link'     => '#', 
                        'repeater_linkdeing_link'   => '#',
         
                      ],
                       [
                      	'repeater_image' => '',
                      	'repeater_title'       => esc_html__( 'Arturo Turcotte', 'widgetkit-for-elementor' ),
                        'repeater_designation'    => esc_html__( 'Technology Officer', 'widgetkit-for-elementor' ),
                        'repeater_content'     => esc_html__( '', 'widgetkit-for-elementor' ), 
                        'repeater_demo_link'   => '#',
                        'repeater_facebook_link'    =>'#',
                        'repeater_twitter_link'     => '#', 
                        'repeater_linkdeing_link'   => '#',
         
                      ],
                      [
                      	'repeater_image' => '',
                      	'repeater_title'       => esc_html__( 'Carley Mante', 'widgetkit-for-elementor' ),
                        'repeater_designation'    => esc_html__( 'UI/UX Designer', 'widgetkit-for-elementor' ),
                        'repeater_content'     => esc_html__( '', 'widgetkit-for-elementor' ), 
                        'repeater_demo_link'   => '#',
                        'repeater_facebook_link'    =>'#',
                        'repeater_twitter_link'     => '#', 
                        'repeater_linkdeing_link'   => '#',
         
                      ],
                  ],
                  'fields'      => array_values( $repeater->get_controls() ),
                  'title_field' => '{{{repeater_title}}}',
                  'condition'   => [
                        'item_option' => 'repeat_content',
                    ],
              ]
            );

            $this->add_control(
				'header_tag',
				[
					'label' => __( 'HTML Tag', 'widgetkit-for-elementor' ),
					'type' => Controls_Manager::SELECT,
					'options' => [
						'h1' => 'H1',
						'h2' => 'H2',
						'h3' => 'H3',
						'h4' => 'H4',
						'h5' => 'H5',
						'h6' => 'H6',
						'div' => 'div',
						'span' => 'span',
						'p' => 'p',
					],
					'default' => 'h3',
				]
			);


		$this->end_controls_section();



		$this->start_controls_section(
            'section_layout',
	            [
	                'label' => esc_html__( 'Layout', 'widgetkit-for-elementor' ),
	            ]
        );


	        $this->add_control(
	            'item_styles',
	                [
	                    'label'       => __( 'Choose Style', 'widgetkit-for-elementor' ),
	                    'type' => Controls_Manager::SELECT,
	                    'default' => '1',
	                    'options' => [
	                        '1'   => __( '1', 'widgetkit-for-elementor' ),
	                        '2'   => __( '2', 'widgetkit-for-elementor' ),
	                        '3'   => __( '3', 'widgetkit-for-elementor' ),
	                        '4'   => __( '4', 'widgetkit-for-elementor' ),
	                    ],
	                ]
	        );

            $this->add_control(
                'item_column',
                [
                    'label'   => __( 'Number of Colum', 'widgetkit-for-elementor' ),
                    'type'    => Controls_Manager::NUMBER,
                    'default' => 3,
                    'min'     => 1,
                    'max'     => 6,
                    'step'    => 1,
                    'condition'   => [
                        'item_option' => 'repeat_content',
                    ],
                ]
            );


	        $this->add_control(
	            'column_gap',
	                [
	                    'label'       => __( 'Colum Gap', 'widgetkit-for-elementor' ),
	                    'type' => Controls_Manager::SELECT,
	                    'default' => 'medium',
	                    'options' => [
	                        'collapse'=> __( 'None', 'widgetkit-for-elementor' ),
	                        'small'   => __( 'Small', 'widgetkit-for-elementor' ),
	                        'medium'  => __( 'Medium', 'widgetkit-for-elementor' ),
	                        'large'   => __( 'Large', 'widgetkit-for-elementor' ),
	                    ],
	                    'condition'   => [
                        	'item_option' => 'repeat_content',
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
            'section_style_image',
            [
                'label' => esc_html__( 'Image', 'widgetkit-for-elementor' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

	           $this->add_responsive_control(
	            'image_size',
	                [
	                    'label'   => esc_html__( 'Size(%)', 'widgetkit-for-elementor' ),
	                    'type'    => Controls_Manager::SLIDER,
	                    'default' => [
	                    'size'    => 100,
	                    ],
	                    'range'   => [
	                        '%'   => [
	                            'min' => 10,
	                            'max' => 100,
	                        ],
	                    ],
	                    'selectors' => [
	                        '{{WRAPPER}} .wk-team .wk-card .wk-card-media-top img' => 'width: {{SIZE}}%;',
	                    ],
	                ]
	            );


	            $this->add_responsive_control(
	                'image_height_custom',
	                    [
	                        'label'   => esc_html__( 'Height(px)', 'widgetkit-for-elementor' ),
	                        'type'    => Controls_Manager::SLIDER,
	                        'default' => [
	                           'size' =>'',
	                        ],
	                        'range'  => [
	                            '%' => [
	                                'min' => 10,
	                                'max' => 100,
	                            ],
	                        ],
	                        'selectors' => [
	                            '{{WRAPPER}} .wk-team .wk-card .wk-card-media-top' => 'max-height: {{SIZE}}{{UNIT}};',
	                            // '{{WRAPPER}} .content-carousel .wk-card .wk-card-media-bottom' => 'max-height: {{SIZE}}{{UNIT}};',
	                        ],
	                    ]
	                );

		        $this->add_control(
		            'image_border_radius',
		            [
		                'label' => esc_html__( 'Border Radius', 'widgetkit-for-elementor' ),
		                'type'  => Controls_Manager::DIMENSIONS,
		                'size_units' => [ 'px', '%' ],
		                'selectors'  => [
		                    '{{WRAPPER}} .wk-team .wk-card .wk-card-media-top img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );


         $this->end_controls_section();


		$this->start_controls_section(
			'content_style',
			[
				'label' => esc_html__( 'Contents', 'widgetkit-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
       		$this->add_control(
                'title_heading',
                [
                    'label' => __( 'Title', 'widgetkit-for-elementor' ),
                    'type'  => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );

			$this->add_control(
				'title_color',
				[
					'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::COLOR,
					'default'   => '#404040',
					'selectors' => [
						'{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-grid-small .wk-card-title a' => 'color: {{VALUE}};',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
					[
						'name'     => 'title_typography',
						'label'    => esc_html__( 'Typography', 'widgetkit-for-elementor' ),
						'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
						'selector' => '{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-grid-small .wk-card-title',
					]
			);
			$this->add_control(
	                'title_hover_color',
	                [
	                    'label'     => esc_html__( 'Hover Color', 'widgetkit-for-elementor' ),
	                    'type'      => Controls_Manager::COLOR,
	                    'default'   => '#0073aa',
	                    'selectors' => [
	                        '{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-grid-small .wk-card-title a:hover' => 'color: {{VALUE}}; text-decoration:none;',
	                    ],
	                ]
	            );


	            $this->add_responsive_control(
	                'title_spacing',
	                    [
	                        'label'   => esc_html__( 'Spacing', 'widgetkit-for-elementor' ),
	                        'type'    => Controls_Manager::SLIDER,
	                        'default' => [
	                        'size'    => 0,
	                        ],
	                        'range'  => [
	                            'px' => [
	                                'min' => 0,
	                                'max' => 100,
	                            ],
	                        ],
	                        'selectors' => [
	                            '{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-grid-small' => 'padding: {{SIZE}}{{UNIT}} 0 0;',
	                        ],
	                    ]
	            );


		        $this->add_control(
	                'designation_heading',
	                [
	                    'label' => __( 'Designation', 'widgetkit-for-elementor' ),
	                    'type'  => Controls_Manager::HEADING,
	                    'separator' => 'before',
	                ]
	            );

				$this->add_control(
					'designation_color',
					[
						'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-card-designation' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
						[
							'name'     => 'designation_typography',
							'label'    => esc_html__( 'Typography', 'widgetkit-for-elementor' ),
							'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
							'selector' => '{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-card-designation',
						]
				);


	            $this->add_responsive_control(
	                'designation_spacing',
	                    [
	                        'label'   => esc_html__( 'Spacing', 'widgetkit-for-elementor' ),
	                        'type'    => Controls_Manager::SLIDER,
	                        'default' => [
	                        'size'    => 0,
	                        ],
	                        'range'  => [
	                            'px' => [
	                                'min' => 0,
	                                'max' => 100,
	                            ],
	                        ],
	                        'selectors' => [
	                            '{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-card-designation' => 'margin-bottom: {{SIZE}}{{UNIT}};',
	                        ],
	                    ]
	            );


		        $this->add_control(
	                'description_heading',
	                [
	                    'label' => __( 'Description', 'widgetkit-for-elementor' ),
	                    'type'  => Controls_Manager::HEADING,
	                    'separator' => 'before',
	                ]
	            );

				$this->add_control(
					'description_color',
					[
						'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
						'type'      => Controls_Manager::COLOR,
						'default'   => '',
						'selectors' => [
							'{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-text-normal' => 'color: {{VALUE}};',
						],
					]
				);
				$this->add_group_control(
					Group_Control_Typography::get_type(),
						[
							'name'     => 'description_typography',
							'label'    => esc_html__( 'Typography', 'widgetkit-for-elementor' ),
							'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
							'selector' => '{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-text-normal',
						]
				);



				$this->add_control(
	                'content_bg_color',
	                [
	                    'label'     => esc_html__( 'Bg Color', 'widgetkit-for-elementor' ),
	                    'type'      => Controls_Manager::COLOR,
	                    'default'   => '',
	                    'selectors' => [
	                        '{{WRAPPER}} .wk-team .wk-card' => 'background: {{VALUE}};',
	                    ],
	                    'separator' => 'before',
	                ]
	            );


	            $this->add_group_control(
	                Group_Control_Box_Shadow::get_type(),
	                [
	                    'name' => 'content_box_shadow',
	                    'exclude' => [
	                        'box_shadow_position',
	                    ],
	                    'selector' => '{{WRAPPER}} .wk-team .wk-card',
	                ]
	            );

			    $this->add_control(
					'content_layout_align',
					[
						'label' => esc_html__( 'Alignment', 'widgetkit-for-elementor' ),
						'type'  => Controls_Manager::CHOOSE,
						'default'   => 'left',
						'options'   => [
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
						'selectors' => [
							'{{WRAPPER}} .wk-team .wk-card' => 'text-align: {{VALUE}};',
						],
					]
				);

				$this->add_control(
		            'content_padding',
		            [
		                'label' => esc_html__( 'Padding', 'widgetkit-for-elementor' ),
		                'type'  => Controls_Manager::DIMENSIONS,
		                'size_units' => [ 'px', '%' ],
		                'selectors'  => [
		                    '{{WRAPPER}} .wk-team .wk-card .wk-card-body' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
		                ],
		            ]
		        );

		$this->end_controls_section();

	

		$this->start_controls_section(
			'icon_style',
			[
				'label' => esc_html__( 'Social Links', 'widgetkit-for-elementor' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'icon_size',
				[
					'label' => esc_html__( 'Font Size', 'widgetkit-for-elementor' ),
					'type'  => Controls_Manager::SLIDER,
					'default'  => [
						'size' => 16,
					],
					'range' => [
						'px' => [
							'min' => 12,
							'max' => 30,
						],
					],
					'selectors' => [
						'{{WRAPPER}}  .wk-team .wk-card .wk-card-body .wk-icon svg' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);

			$this->add_control(
	            'border_radius',
	            [
	                'label' => esc_html__( 'Border Radius', 'widgetkit-for-elementor' ),
	                'type'  => Controls_Manager::DIMENSIONS,
	                'size_units' => [ 'px', '%' ],
	                'selectors'  => [
	                    '{{WRAPPER}} .wk-team .wk-card .wk-card-body .social-icons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
	                ],
	            ]
	        );


		$this->start_controls_tabs( 'tabs_social_style' );

			    $this->start_controls_tab(
			        'tab_social_normal',
			          [
			            'label' => esc_html__( 'Normal', 'widgetkit-for-elementor' ),
			          ]
			    );

			    		$this->add_control(
							'icon_color',
							[
								'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
								'type'      => Controls_Manager::COLOR,
								'default'   => '',
								'selectors' => [
									'{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-icon svg' => 'color: {{VALUE}};',
								],
							]
						);

						$this->add_control(
							'icon_bg_color',
							[
								'label'     => esc_html__( 'Bg Color', 'widgetkit-for-elementor' ),
								'type'      => Controls_Manager::COLOR,
								'default'   => '',
								'selectors' => [
									'{{WRAPPER}} .wk-team .wk-card .wk-card-body .social-icons a' => 'background-color: {{VALUE}};',
								],
							]
						);

			        $this->add_group_control(
			            Group_Control_Border::get_type(),
			            [
			                'name'  => 'icon_border',
			                'label' => esc_html__( 'Border', 'widgetkit-for-elementor' ),
			                'placeholder' => '1px',
			                'default'  => '1px',
			                'selector' => '
			                    {{WRAPPER}} .wk-team .wk-card .wk-card-body .social-icons a',
			                'separator' => 'before',
			            ]
			        );

				$this->end_controls_tab();

				$this->start_controls_tab(
			        'tab_social_hover',
			          [
			            'label' => esc_html__( 'Hover', 'widgetkit-for-elementor' ),
			          ]
			    );

			    		$this->add_control(
							'icon_hover_color',
							[
								'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
								'type'      => Controls_Manager::COLOR,
								'default'   => '',
								'selectors' => [
									'{{WRAPPER}} .wk-team .wk-card .wk-card-body .social-icons a:hover svg' => 'color: {{VALUE}};',
								],
							]
						);

						$this->add_control(
							'icon_hover_bg_color',
							[
								'label'     => esc_html__( 'Bg Color', 'widgetkit-for-elementor' ),
								'type'      => Controls_Manager::COLOR,
								'default'   => '',
								'selectors' => [
									'{{WRAPPER}} .wk-team .wk-card .wk-card-body .social-icons a:hover' => 'background-color: {{VALUE}}; transition:all 0.3s ease;',
								],
							]
						);

						$this->add_control(
							'icon_hover_border_color',
							[
								'label'     => esc_html__( 'Border Color', 'widgetkit-for-elementor' ),
								'type'      => Controls_Manager::COLOR,
								'default'   => '',
								'selectors' => [
									'{{WRAPPER}} .wk-team .wk-card .wk-card-body .social-icons a:hover' => 'border-color: {{VALUE}}; transition:all 0.3s ease;',
								],
							]
						);
				$this->end_controls_tab();

			$this->end_controls_tabs();




		// $this->add_control(
		// 	'icon_hover_color',
		// 	[
		// 		'label'     => esc_html__( 'Hover Color', 'widgetkit-for-elementor' ),
		// 		'type'      => Controls_Manager::COLOR,
		// 		'default'   => '',
		// 		'selectors' => [
		// 			'{{WRAPPER}} .wk-team .wk-card .wk-card-body .wk-grid-small .wk-icon svg:hover' => 'color: {{VALUE}};',
		// 		],
		// 	]
		// );


		// $this->add_responsive_control(
		// 	'icon_bottom_space',
		// 	[
		// 		'label' => esc_html__( 'Spacing', 'widgetkit-for-elementor' ),
		// 		'type'  => Controls_Manager::SLIDER,
		// 		'default'  => [
		// 			'size' => 10,
		// 		],
		// 		'range' => [
		// 			'px' => [
		// 				'min' => -10,
		// 				'max' => 50,
		// 			],
		// 		],
		// 		'selectors' => [
		// 			'{{WRAPPER}} .tgx-team-1 .team-container .team-each-wrap .team-social' => 'margin: {{SIZE}}{{UNIT}} 0;',
		// 		],
		// 	]
		// );






	$this->end_controls_section();
	}

	protected function render() {
		require WK_PATH . '/elements/team/template/view.php';
	}


}
