<?php

use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor WidgetKit animation text
 *
 * Elementor widget for WidgetKit animation text
 *
 * @since 1.0.0
 */
class wkfe_contact extends Widget_Base {

	public function get_name() {
		return 'widgetkit-pro-contact';
	}

	public function get_title() {
		return esc_html__( 'Contact', 'widgetkit-pro' );
	}

	public function get_icon() {
		return 'eicon-tel-field wk-icon';
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
            'animate-text',
            'widgetkit_main',
        ];
    }
	/**
	 * A list of scripts that the widgets is depended in
	 **/
	public function get_script_depends() {
		return [ 
			'widgetkit-main',
		 ];
	}

	protected function _register_controls() {

		// icon picker 
		// contact details 
			// header
			// title
			// description box for contact details

		// icon style config
		// title style config - color, typography, border
		// header style config - color, typography, border
		// description style config - color, typography
		// total contact box style config - background color, padding


#	region icon picker config start
	// Content options Start
	$this->start_controls_section(
		'content_icon_picker',
		[
			'label' => esc_html__( 'Icon', 'widgetkit-pro' ),
		]
	);
		$this->add_control(
			'contact_icon_for_handler',
			[
				'label' => esc_html__( 'Icon', 'widgetkit-pro' ),
				'type'              => Controls_Manager::ICONS,
				'default'    =>  [
					'value'     => 'fa fa-search',
					'library'   => 'fa-regular',
				],
				'label_block'   => true,
			]
		);
	$this->end_controls_section();
# 	end icon picker config region 

# 	start contact content config
	$this->start_controls_section(
		'section_text_contact_form',
		[
			'label' => esc_html__( 'Contact', 'widgetkit-pro' ),
		]
	);
		$this->add_control(
			'contact_header',
				[
					'label' => esc_html__( 'Header', 'widgetkit-pro' ),
					'type'  => Controls_Manager::TEXT,
					'default' => esc_html__( 'Search here', 'widgetkit-pro' ),
				]
		);
		$this->add_control(
			'contact_title',
				[
					'label' => esc_html__( 'Title', 'widgetkit-pro' ),
					'type'  => Controls_Manager::TEXT,
					'default' => esc_html__( 'Search', 'widgetkit-pro' ),
				]
		);
		$this->add_control(
			'contact_content',
			[
				'label'       => __( 'Content', 'widgetkit-pro' ),
				'type' => Controls_Manager::WYSIWYG,
				'default' => esc_html__('In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt.', 'widgetkit-pro'),
			]
		);
	$this->end_controls_section();

#	end contact content config

#	start pro config for free user
	/**
	 * Pro control panel 
	 */
	if(!apply_filters('wkpro_enabled', false)):
		$this->start_controls_section(
			'section_widgetkit_pro_box',
			[
				'label' => esc_html__( 'Go Premium for more layout & feature', 'widgetkit-pro' ),
			]
		);
			$this->add_control(
				'wkfe_control_go_pro',
				[
					'label' => __('Unlock more possibilities', 'widgetkit-pro'),
					'type' => Controls_Manager::CHOOSE,
					'default' => '1',
					'description' => '<div class="elementor-nerd-box">
					<div class="elementor-nerd-box-message"> Get the  <a href="https://themesgrove.com/widgetkit-pro/" target="_blank">Pro version</a> of <a href="https://themesgrove.com/widgetkit-pro/" target="_blank">WidgetKit</a> for more stunning elements and customization options.</div>
					<a class="widgetkit-go-pro elementor-nerd-box-link elementor-button elementor-button-default elementor-go-pro" href="https://themesgrove.com/widgetkit-pro/" target="_blank">Go Pro</a>
					</div>',
				]
			);
		$this->end_controls_section();
	endif;
#	end region for pro config

#	start contact icon style
	// Content options End
		$this->start_controls_section(
			'section_contact_icon_layout',
			[
				'label' => esc_html__( 'Icon', 'widgetkit-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'contact_icon_size',
				[
					'label'   => esc_html__( 'Size', 'widgetkit-pro' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' =>16,
					],
					'range'  => [
						'px' => [
							'min' => 0,
							'max' => 100,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .search-click-handler' => 'font-size: {{SIZE}}{{UNIT}};',
						'{{WRAPPER}} .wkfe-search .search-click-handler svg' => 'width: {{SIZE}}{{UNIT}};',
					],
				]
			);
			/**
             * tabs normal
             */
            $this->start_controls_tabs( 'contact_icon_style__tab' );
                /**
                 * Normal style
                 */
                $this->start_controls_tab(
                    'contact_icon_style_normal',
                    [
                        'label' => __('Normal', 'widgetkit-pro'),
                    ]
                );
					$this->add_control(
						'contact_icon_color',
						[
							'label' => __( 'Color', 'widgetkit-pro' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .wkfe-search .click-handler' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_control(
						'contact_icon_background_color',
						[
							'label' => __( 'Background', 'widgetkit-pro' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .wkfe-search .click-handler' => 'background-color: {{VALUE}}',
							],
						]
					);
                $this->end_controls_tab();
                /**
                 * Hover Style
                 */
                $this->start_controls_tab(
                    'contact_icon_style_hover',
                    [
                        'label' => __('Hover/Active', 'widgetkit-pro'),
                    ]
                );
					$this->add_control(
						'contact_icon_hover_color',
						[
							'label' => __( 'Icon', 'widgetkit-pro' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .wkfe-search .click-handler:hover' => 'color: {{VALUE}}',
								'{{WRAPPER}} .wkfe-search .click-handler.active' => 'color: {{VALUE}}',
							],
						]
					);
					$this->add_control(
						'contact_icon_hover_background_color',
						[
							'label' => __( 'Background', 'widgetkit-pro' ),
							'type' => Controls_Manager::COLOR,
							'selectors' => [
								'{{WRAPPER}} .wkfe-search .click-handler:hover' => 'background: {{VALUE}} !important',
								'{{WRAPPER}} .wkfe-search .click-handler.active' => 'background: {{VALUE}} !important',
							],
						]
					);
                $this->end_controls_tab();
        
            $this->end_controls_tabs();

			// icon border
			$this->add_group_control(
                Group_Control_Border::get_type(), 
                [
                    'name'          => 'contact_icon_border',
					'selector'      => '{{WRAPPER}} .wkfe-search .click-handler',
					'separator'		=> 'before'
                ]
			);
			// icon padding 
			$this->add_responsive_control(
                'contact_icon_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'widgetkit-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wkfe-search .click-handler' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
			// icon padding 
			$this->add_responsive_control(
                'contact_icon_padding',
                [
                    'label' => esc_html__( 'Padding', 'widgetkit-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wkfe-search .click-handler' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
                ]
            );
			// icon margin 
			$this->add_responsive_control(
                'contact_icon_margin',
                [
                    'label' => esc_html__( 'Margin', 'widgetkit-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wkfe-search .click-handler' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
		$this->end_controls_section();
#	end contact icon style


# 	start contact header style region
		$this->start_controls_section(
			'contact_Header_style',
			[
				'label' => esc_html__( 'Header', 'widgetkit-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'content_header_color',
				[
					'label' => __( 'Color', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => __( 'Typography', 'widgetkit-pro' ),
					'name' => 'content_header_typography',
					'selector' => '{{WRAPPER}} .smart-toggle-content .primary-title',
				]
			);
			$this->add_control(
				'content_header_background',
				[
					'label' => __( 'Background', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(), 
				[
					'name'          => 'content_header_border',
					'selector'      => '{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]',
				]
			);
			$this->add_control(
				'content_header_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}}  .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'content_header_padding',
				[
					'label' => esc_html__( 'Padding', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
				]
			);
			$this->add_responsive_control(
				'content_header_margin',
				[
					'label' => esc_html__( 'Margin', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
				]
			);
		$this->end_controls_section();
#	end contact header style region

# 	start contact title style region
		$this->start_controls_section(
			'contact_title_style',
			[
				'label' => esc_html__( 'Title', 'widgetkit-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'content_title_color',
				[
					'label' => __( 'Color', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => __( 'Typography', 'widgetkit-pro' ),
					'name' => 'content_title_typography',
					'selector' => '{{WRAPPER}} .smart-toggle-content .primary-title',
				]
			);
			$this->add_control(
				'content_title_background',
				[
					'label' => __( 'Background', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(), 
				[
					'name'          => 'content_title_border',
					'selector'      => '{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]',
				]
			);
			$this->add_control(
				'content_title_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}}  .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'content_title_padding',
				[
					'label' => esc_html__( 'Padding', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
				]
			);
			$this->add_responsive_control(
				'content_title_margin',
				[
					'label' => esc_html__( 'Margin', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
				]
			);

		$this->end_controls_section();
#	end contact title style region

# 	start contact contact style region
		$this->start_controls_section(
			'contact_contact_style',
			[
				'label' => esc_html__( 'Contact', 'widgetkit-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'content__color',
				[
					'label' => __( 'Color', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => __( 'Typography', 'widgetkit-pro' ),
					'name' => 'content__typography',
					'selector' => '{{WRAPPER}} .smart-toggle-content .primary-title',
				]
			);
			$this->add_control(
				'content__background',
				[
					'label' => __( 'Background', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(), 
				[
					'name'          => 'content__border',
					'selector'      => '{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]',
				]
			);
			$this->add_control(
				'content__border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}}  .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
			$this->add_responsive_control(
				'content__padding',
				[
					'label' => esc_html__( 'Padding', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
				]
			);
			$this->add_responsive_control(
				'content__margin',
				[
					'label' => esc_html__( 'Margin', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper input[type="text"]' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
				]
			);
		$this->end_controls_section();
#	end contact title style region


#	start contact box style region
		$this->start_controls_section(
			'contact_box_style',
			[
				'label' => esc_html__( 'Contact Box', 'widgetkit-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_control(
				'contact_box_background_color',
				[
					'label' => __( 'Background', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper' => 'background: {{VALUE}} !important',
					],
				]
			);
			// icon padding 
			$this->add_responsive_control(
                'contact_box_padding',
                [
                    'label' => esc_html__( 'Padding', 'widgetkit-pro' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .wkfe-search .wkfe-search-form-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
                ]
            );
		$this->end_controls_section();
#	end contact box style region 

	}

	protected function render() {
		require WK_PATH . '/elements/contact/template/view.php';
	}


}
