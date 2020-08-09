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
class wkfe_custom_post_card extends Widget_Base {

	public function get_name() {
		return 'widgetkit-custom-post-card';
	}

	public function get_title() {
		return esc_html__( 'Custom Post Card', 'widgetkit-pro' );
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
			// 'widgetkit-main',
		 ];
	}

	protected function _register_controls() {
		$args = array(
			'public'   => true,
			'_builtin' => false,
		 );
	 
		$output = 'names'; // names or objects, note names is the default
		$operator = 'and'; // 'and' or 'or'
		$all_custom_post_types = get_post_types($args, $output, $operator);


#	region layout config start
		$this->start_controls_section(
			'cpt_layout',
			[
				'label' => esc_html__( 'Layout', 'widgetkit-pro' ),
			]
		);

			$this->add_responsive_control(
				'wkfe_cpt_grid',
				[
					'label' => __('Grid', 'widgetkit-for-elementor'),
					'type' => Controls_Manager::SELECT,
					'default' => '4',
					'options' => [
						'1' => '1',
						'2' => '2',
						'3' => '3',
						'4' => '4',
						'5' => '5',
						'6' => '6',
					],
				]
			);
			$this->add_responsive_control(
				'cpt_layout_gap',
				[
					'label'   => esc_html__( 'Grid Gap', 'widgetkit-for-elementor' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' => 30,
					],
					'range'  => [
						'px' => [
							'min' => 0,
							'max' => 200,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .wkfe-custom-post-card .wkfe-grid' => 'grid-gap: {{SIZE}}{{UNIT}};',
					],
				]
			);

		$this->end_controls_section();

#	end region layout config 		


#	region card config start
	// Content options Start
	$this->start_controls_section(
		'cpt_card',
		[
			'label' => esc_html__( 'Card', 'widgetkit-pro' ),
		]
	);
		$this->add_control(
			'wkfe_selected_cpt',
			[
				'label' => __('Choose Custom Post Type', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SELECT,
				'options' => $all_custom_post_types,
			]
		);
		
		$this->add_control(
			'cpt_thumbnail_key',
			[
				'label' => __( 'Thumbnail', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'thumbnail_key', 'elementor' ),
			]
		);
		$this->add_control(
			'cpt_thumbnail_alternative_key',
			[
				'label' => __( 'Thumbnail Alternative', 'elementor' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'alternative_key', 'elementor' ),
			]
		);
		// $this->add_control(
		// 	'cpt_thumbnail_type',
		// 	[
		// 		'label' => __('Thumbnail Type', 'widgetkit-pro'),
		// 		'type' => Controls_Manager::SELECT2,
		// 		'options' => [
		// 			'string' => 'string',
		// 			'url' => 'url',
		// 			'image' => 'image',
		// 		],
		// 		'multiple' => true,
		// 	]
		// );

	$this->end_controls_section();
# 	end card config region 

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

#	start contact box style region
		$this->start_controls_section(
			'contact_box_style',
			[
				'label' => esc_html__( 'Thumb', 'widgetkit-pro' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);
			$this->add_responsive_control(
				'content_alignment',
				[
					'label'  => esc_html__( 'Alignment', 'widgetkit-pro' ),
					'type'  => Controls_Manager::CHOOSE,
					'default' => 'center',
					'options' => [
						'left' => [
							'title' => esc_html__( 'Left', 'widgetkit-pro' ),
							'icon'  => 'fa fa-align-left',
						],
						'center' => [
							'title' => esc_html__( 'Center', 'widgetkit-pro' ),
							'icon'  => 'fa fa-align-center',
						],
						'right' => [
							'title' => esc_html__( 'Right', 'widgetkit-pro' ),
							'icon'  => 'fa fa-align-right',
						],
					],
					'selectors' => [
						'{{WRAPPER}} .wkfe-custom-post-card .card-thumb' => 'text-align: {{VALUE}};',
					],
				]
			);
			$this->add_responsive_control(
				'cpt_layout_thumb_min_height',
				[
					'label'   => esc_html__( 'Min Height', 'widgetkit-for-elementor' ),
					'type'    => Controls_Manager::SLIDER,
					'default' => [
						'size' => 175,
					],
					'range'  => [
						'px' => [
							'min' => 0,
							'max' => 1000,
						],
					],
					'selectors' => [
						'{{WRAPPER}} .wkfe-custom-post-card .card-thumb' => 'height: {{SIZE}}{{UNIT}};',
					],
				]
			);
			$this->add_control(
				'card_thumb_color',
				[
					'label' => __( 'Color', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-custom-post-card .card-thumb .thumb-wrapper' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => __( 'Typography', 'widgetkit-pro' ),
					'name' => 'card_thumb_typography',
					'selector' => '{{WRAPPER}} .wkfe-custom-post-card .card-thumb .thumb-wrapper',
				]
			);
			$this->add_control(
				'card_thumb_background_color',
				[
					'label' => __( 'Background', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-custom-post-card .card-thumb .thumb-wrapper' => 'background: {{VALUE}} !important',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(), 
				[
					'name'          => 'card_thumb_border',
					'selector'      => '{{WRAPPER}} .wkfe-custom-post-card .card-thumb',
				]
			);
			$this->add_control(
				'card_thumb_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-custom-post-card .card-thumb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wkfe-custom-post-card .card-thumb .thumb-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
				]
			);
		$this->end_controls_section();
#	end contact box style region 

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
						'{{WRAPPER}} .wkfe-custom-post-card .card-title' => 'color: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Typography::get_type(),
				[
					'label' => __( 'Typography', 'widgetkit-pro' ),
					'name' => 'content_title_typography',
					'selector' => '{{WRAPPER}} .wkfe-custom-post-card .card-title',
				]
			);
			$this->add_control(
				'content_title_background',
				[
					'label' => __( 'Background', 'widgetkit-pro' ),
					'type' => Controls_Manager::COLOR,
					'selectors' => [
						'{{WRAPPER}} .wkfe-custom-post-card .card-title' => 'background: {{VALUE}}',
					],
				]
			);
			$this->add_group_control(
				Group_Control_Border::get_type(), 
				[
					'name'          => 'content_title_border',
					'selector'      => '{{WRAPPER}} .wkfe-custom-post-card .card-title',
				]
			);
			$this->add_control(
				'content_title_border_radius',
				[
					'label' => esc_html__( 'Border Radius', 'widgetkit-pro' ),
					'type'  => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px' ],
					'selectors'  => [
						'{{WRAPPER}} .wkfe-custom-post-card .card-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wkfe-custom-post-card .card-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
						'{{WRAPPER}} .wkfe-custom-post-card .card-title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' => 'before'
				]
			);

		$this->end_controls_section();
#	end contact title style region

#	start card style
	
	$this->start_controls_section(
		'section_contact_icon_layout',
		[
			'label' => esc_html__( 'Card', 'widgetkit-pro' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		]
	);
		
		// card border
		$this->add_group_control(
			Group_Control_Border::get_type(), 
			[
				'name'          => 'card_border',
				'selector'      => '{{WRAPPER}} .wkfe-custom-post-card .wkfe-grid .card-wrapper',
				'separator'		=> 'before'
			]
		);
		// card border Radius 
		$this->add_responsive_control(
			'card_border_radius',
			[
				'label' => esc_html__( 'Border Radius', 'widgetkit-pro' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wkfe-custom-post-card .wkfe-grid .card-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'card_box_shadow',
			[
				'label' => __( 'Box Shadow', 'widgetkit-pro' ),
				'type' => Controls_Manager::BOX_SHADOW,
				'default' => [
				'color' => 'rgba(0,0,0,.08)',
				],
				'selectors' => [
				'{{WRAPPER}} .wkfe-custom-post-card .wkfe-grid .card-wrapper' => 'box-shadow: {{HORIZONTAL}}px {{VERTICAL}}px {{BLUR}}px {{SPREAD}}px {{COLOR}};',
				],
			]
		);
		// card padding 
		$this->add_responsive_control(
			'card_padding',
			[
				'label' => esc_html__( 'Padding', 'widgetkit-pro' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'separator' => 'before',
				'selectors'  => [
					'{{WRAPPER}} .wkfe-custom-post-card .wkfe-grid .card-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);
		// card margin 
		$this->add_responsive_control(
			'card_margin',
			[
				'label' => esc_html__( 'Margin', 'widgetkit-pro' ),
				'type'  => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .wkfe-custom-post-card .wkfe-grid .card-wrapper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	$this->end_controls_section();
#	end card style

	}

	protected function render() {
		require WK_PATH . '/elements/custom-post-card/template/view.php';
	}


}
