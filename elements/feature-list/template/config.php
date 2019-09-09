<?php

use Elementor\Group_Control_Border;
use Elementor\Widget_Base;
use Elementor\Repeater;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit;

class WKFE_Feature_List_Config extends Widget_Base {

	public function get_name() {
		return 'widgetkit-for-elementor-pros-cons';
	}

	public function get_title() {
		return esc_html__( 'Feature List', 'widgetkit-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-editor-list-ul';
	}

	public function get_categories() {
		return [ 'widgetkit_elementor' ];
	}

	/**
	 * A list of stylesheet that 
	 * theis widget depends
	 **/
	public function get_style_depends() {
        return [
            'widgetkit_bs',
            'widgetkit_main',
            'animate-css',
        ];
    }
	/**
	 * A list of scripts that 
	 * this widget depends
	 **/
	public function get_script_depends() {
		return [ 
			'widgetkit-main',
		 ];
	}

	protected function _register_controls() {
	
	$this->start_controls_section(
		'section_feature_content',
		[
			'label' => esc_html__( 'Feature', 'widgetkit-for-elementor' ),
		]
	);

		$this->add_control(
		    'feature_title',
		      	[
		          'label' => esc_html__( 'Title', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::TEXT,
		          'default' => esc_html__( 'Pros', 'widgetkit-for-elementor' ),
		    	]
		);
		$this->add_control(
		    'feature_icon',
		      	[
		          'label' => esc_html__( 'Icon', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::ICON,
		          'default' => esc_html__( 'fa fa-thumbs-up', 'widgetkit-for-elementor' ),
		    	]
	    );
		/**
		 * single feature repeater
		 */
        $repeater = new Repeater();
        $repeater->add_control(
            'single_feature_input',
            [
                'label'   => esc_html__( 'Feature', 'widgetkit-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Feature', 'widgetkit-for-elementor' ),
            ]
		);
		$repeater->add_control(
            'single_feature_icon',
            [
                'label'   => esc_html__( 'Icon', 'widgetkit-for-elementor' ),
                'type'    => Controls_Manager::ICON,
                'default' => esc_html__( 'fa fa-check', 'widgetkit-for-elementor' ),
            ]
        );
        $this->add_control(
            'feature_lists',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => array_values( $repeater->get_controls() ),
                'default' => [
                    [
                        'single_feature_input' => esc_html__( 'Feature 1', 'widgetkit-for-elementor' ),
                        'single_feature_icon' => esc_html__( 'fa fa-check', 'widgetkit-for-elementor' ),
                    ],
                    [
                        'single_feature_input' => esc_html__( 'Feature 2', 'widgetkit-for-elementor' ),
                        'single_feature_icon' => esc_html__( 'fa fa-check', 'widgetkit-for-elementor' ),
                    ],
                    
                ],
                'title_field' => '{{{ single_feature_input }}}',
            ]
        );
        
	$this->end_controls_section();
	
	/**
	 * Style tab
	 * =============
	 */


	/**
	 * Feature title style
	 * -------------------
	 */
	$this->start_controls_section(
		'style_title', 
		[
			'label' => esc_html__('Title', 'widgetkit-for-elementor'),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Font', 'widgetkit-for-elementor' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .wkfe-feature-list h2.title span',
			]
	);
	$this->add_control(
		'title_color',
		[
			'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title span' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_control(
		'title_background',
		[
			'label'     => esc_html__( 'Background', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#f5f5f5',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title' => 'background-color: {{VALUE}};',
			],
		]
	);
	$this->add_responsive_control(
		'title_padding',
		[
			'label' => esc_html__( 'Title Padding', 'widgetkit-for-elementor' ),
			'type'  => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wkfe-feature-list h2.title span.title-text' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			// 'separator' => 'before',
		]
	);
	$this->add_control(
		'title_border_color',
		[
			'label'     => esc_html__( 'Border Color', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#ddd',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title' => 'border-color: {{VALUE}};',
			],
		]
	);
	$this->add_responsive_control(
		'title_border_size',
		[
			'label'   => esc_html__( 'Border Size', 'widgetkit-for-elementor' ),
			'type'    => Controls_Manager::SLIDER,
			'default' => [
				'size' =>1,
			],
			'range'  => [
				'px' => [
					'min' => 0,
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title' => 'border-bottom-width: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->add_control(
		'hr',
		[
			'type' => \Elementor\Controls_Manager::DIVIDER,
		]
	);
	$this->add_responsive_control(
		'title_icon_size',
		[
			'label'   => esc_html__( 'Icon Size', 'widgetkit-for-elementor' ),
			'type'    => Controls_Manager::SLIDER,
			'default' => [
				'size' =>20,
			],
			'range'  => [
				'px' => [
					'min' => 10,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->add_control(
		'title_icon_color',
		[
			'label'     => esc_html__( 'Icon Color', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title span.icon' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_control(
		'title_icon_bg_color',
		[
			'label'     => esc_html__( 'Icon Background', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title span.icon' => 'background-color: {{VALUE}};',
				'{{WRAPPER}} .wkfe-feature-list h2.title span.icon:after' => 'border-left-color: {{VALUE}};',
			],
		]
	);
	$this->add_responsive_control(
		'title_icon_spacing',
		[
			'label'   => esc_html__( 'Icon Spacing', 'widgetkit-for-elementor' ),
			'type'    => Controls_Manager::SLIDER,
			'default' => [
				'size' =>10,
			],
			'range'  => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list h2.title span.icon' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->add_responsive_control(
		'title_icon_padding',
		[
			'label' => esc_html__( 'Icon Padding', 'widgetkit-for-elementor' ),
			'type'  => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wkfe-feature-list h2.title span.icon' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);
	$this->end_controls_section();

	/**
	 * Feature list style
	 * ------------------
	 */
	$this->start_controls_section(
		'style_feature', 
		[
			'label' => esc_html__('Feature', 'widgetkit-for-elementor'),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_group_control(
		Group_Control_Typography::get_type(),
			[
				'name'     => 'feature_typography',
				'label'    => esc_html__( 'Font', 'widgetkit-for-elementor' ),
				'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
				'selector' => '{{WRAPPER}} .wkfe-feature-list li span',
			]
	);
	$this->add_control(
		'feature_color',
		[
			'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list li span' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_control(
		'feature_background_color',
		[
			'label'     => esc_html__( 'Background', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#fff',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list .lists' => 'background-color: {{VALUE}};',
			],
		]
	);
	$this->add_responsive_control(
		'feature_padding',
		[
			'label' => esc_html__( 'Padding', 'widgetkit-for-elementor' ),
			'type'  => Controls_Manager::DIMENSIONS,
			'size_units' => [ 'px', '%' ],
			'selectors'  => [
				'{{WRAPPER}} .wkfe-feature-list .lists' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
			],
			'separator' => 'before',
		]
	);
	$this->add_responsive_control(
		'feature_icon_size',
		[
			'label'   => esc_html__( 'Icon Size', 'widgetkit-for-elementor' ),
			'type'    => Controls_Manager::SLIDER,
			'default' => [
				'size' =>16,
			],
			'range'  => [
				'px' => [
					'min' => 10,
					'max' => 50,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list li i' => 'font-size: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->add_control(
		'feature_icon_color',
		[
			'label'     => esc_html__( 'Icon Color', 'widgetkit-for-elementor' ),
			'type'      => Controls_Manager::COLOR,
			'default'   => '#333',
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list li i' => 'color: {{VALUE}};',
			],
		]
	);
	$this->add_responsive_control(
		'feature_icon_spacing',
		[
			'label'   => esc_html__( 'Icon Spacing', 'widgetkit-for-elementor' ),
			'type'    => Controls_Manager::SLIDER,
			'default' => [
				'size' =>5,
			],
			'range'  => [
				'px' => [
					'min' => 0,
					'max' => 200,
				],
			],
			'selectors' => [
				'{{WRAPPER}} .wkfe-feature-list li i' => 'margin-right: {{SIZE}}{{UNIT}};',
			],
		]
	);
	$this->end_controls_section();

	/**
	 * box style
	 */
	$this->start_controls_section(
		'box', 
		[
			'label' => esc_html__('Box', 'widgetkit-for-elementor'),
			'tab' => Controls_Manager::TAB_STYLE,
		]
	);
	$this->add_group_control(
		Group_Control_Border::get_type(),
		[
			'name' => 'border',
			'label' => __( 'Border', 'widgetkit-for-elementor' ),
			'selector' => '{{WRAPPER}} .wkfe-feature-list .column'
		]
	);
	$this->end_controls_section();

	}

	protected function render() {
		require WKFE_PATH . '/elements/feature-list/template/view.php';
	}


}
