<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Icons_Manager;
use Elementor\Utils;
use Elementor\Repeater;
use Elementor\Core\Schemes\Typography;

if (!defined('ABSPATH')) {
    exit;
}
// Exit if accessed directly
class wkfe_advanced_tab extends Widget_Base {

	public function get_name() {
		return 'wk-advanced-tabs';
	}

	public function get_title() {
		return __( 'Advanced Tab', 'widgetkit-for-elementor');
	}

	public function get_icon() {
		return 'eicon-tabs wk-icon';
	}

	public function get_keywords() {
		return [ 
			'tabs',
			'section',
			'advanced',
			'advanced tab',
			'toggle'
		];
	}

	public function get_categories() {
		return [ 'widgetkit-for-elementor'];
	}

	protected function register_controls() {

		$this->start_controls_section(
			'content_heading',
			[
				'label' => __( 'Heading', 'widgetkit-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
				'condition' => [
					'tab_heading_switcher' => 'yes'
				]
			]
		);

		$this->add_control(
			'heading_title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => __( 'Title', 'widgetkit-for-elementor'),
				'label_block' => true,
				'default' => __( 'Tab Heading', 'widgetkit-for-elementor'),
				'placeholder' => __( 'Type Tab Heading', 'widgetkit-for-elementor'),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->add_control(
			'heading_desc',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => __( 'Description', 'widgetkit-for-elementor'),
				'default' => __( 'Tab Description', 'widgetkit-for-elementor'),
				'placeholder' => __( 'Type Tab Description', 'widgetkit-for-elementor'),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Content', 'widgetkit-for-elementor'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new Repeater();

		$repeater->add_control(
			'title',
			[
				'type' => Controls_Manager::TEXT,
				'label' => __( 'Title', 'widgetkit-for-elementor'),
				'default' => __( 'Tab Title', 'widgetkit-for-elementor'),
				'placeholder' => __( 'Type Tab Title', 'widgetkit-for-elementor'),
				'dynamic' => [
					'active' => true,
				]
			]
		);

		$repeater->add_control(
			'description',
			[
				'type' => Controls_Manager::TEXTAREA,
				'label' => __( 'Description', 'widgetkit-for-elementor'),
				'default' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'widgetkit-for-elementor'),
				'placeholder' => __( 'Type Tab Description', 'widgetkit-for-elementor'),
			]
		);

		$repeater->add_control(
			'icon',
			[
				'label' => __( 'Icon', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-star',
					'library' => 'fa-solid',
				],
			]
		);

		$repeater->add_control(
			'content',
			[
				'type' => Controls_Manager::WYSIWYG,
				'label' => __( 'Description', 'widgetkit-for-elementor'),
				'default' => __( 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec odio. Quisque volutpat mattis eros. Nullam malesuada erat ut turpis. Suspendisse urna nibh, viverra non, semper suscipit, posuere a, pede.', 'widgetkit-for-elementor'),
				'placeholder' => __( 'Type Tab Description', 'widgetkit-for-elementor')
			]
		);

		$this->add_control(
			'tabs',
			[
				'show_label' => false,
				'type' => Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'title_field' => '{{title}}',
				'default' => [
					[
						'title' => 'Tab 1',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore <br><br>et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					],
					[
						'title' => 'Tab 2',
						'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore <br><br>et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.',
					]
				]
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_options',
			[
				'label' => __( 'Options', 'widgetkit-for-elementor'),
			]
		);

		$this->add_control(
			'_enable_accordian_heading',
			[
				'label' => __( 'Accordian', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'enable_accordian_switcher',
			[
				'label' => __( 'Enable', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'On', 'widgetkit-for-elementor'),
				'label_off' => __( 'Off', 'widgetkit-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'_enable_heading_title',
			[
				'label' => __( 'Heading', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'enable_tab_heading_switcher',
			[
				'label' => __( 'Show', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'widgetkit-for-elementor'),
				'label_off' => __( 'No', 'widgetkit-for-elementor'),
				'return_value' => 'yes',
				'default' => 'no',
			]
		);

		$this->add_control(
			'_enable_arrows_title',
			[
				'label' => __( 'Arrow', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'enable_tab_arrow_switcher',
			[
				'label' => __( 'Show', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __( 'Yes', 'widgetkit-for-elementor'),
				'label_off' => __( 'No', 'widgetkit-for-elementor'),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);

		$this->add_control(
			'_heading_tab_title',
			[
				'label' => __( 'Tab Title', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'nav_position',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Position', 'widgetkit-for-elementor'),
				'description' => __( 'Only applicable for desktop', 'widgetkit-for-elementor'),
				'default' => 'top',
				'toggle' => false,
				'options' => [
					'left' => [
						'title' =>  __( 'Left', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' =>  __( 'Top', 'widgetkit-for-elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' =>  __( 'Right', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'nav_align_x',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Alignment', 'widgetkit-for-elementor'),
				'default' => 'x-left',
				'toggle' => false,
				'options' => [
					'x-left' => [
						'title' =>  __( 'Left', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'x-center' => [
						'title' =>  __( 'Center', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-center',
					],
					'x-justify' => [
						'title' =>  __( 'Stretch', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-stretch',
					],
					'x-right' => [
						'title' =>  __( 'Right', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav' => 'justify-content: {{VALUE}};'
				],
				'selectors_dictionary' => [
					'x-left' => 'flex-start',
					'x-right' => 'flex-end',
					'x-center' => 'center',
					'x-justify' => 'space-evenly'
				],
				'condition' => [
					'nav_position' => ['top', 'bottom'],
				],
				'style_transfer' => true,
				'render_type' => 'template',
			]
		);

		$this->add_control(
			'nav_align_y',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Alignment', 'widgetkit-for-elementor'),
				'default' => 'y-top',
				'toggle' => false,
				'options' => [
					'y-top' => [
						'title' =>  __( 'Top', 'widgetkit-for-elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'y-center' => [
						'title' =>  __( 'Center', 'widgetkit-for-elementor'),
						'icon' => 'eicon-v-align-middle',
					],
					'y-bottom' => [
						'title' =>  __( 'Right', 'widgetkit-for-elementor'),
						'icon' => 'eicon-v-align-bottom',
					],
				],
				'selectors' => [
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-left > .td-tabs__nav' => 'justify-content: {{VALUE}};',
					'(tablet+){{WRAPPER}} .td-tabs-{{ID}}.td-tabs--nav-right > .td-tabs__nav' => 'justify-content: {{VALUE}};',
				],
				'selectors_dictionary' => [
					'y-top' => 'flex-start',
					'y-center' => 'center',
					'y-bottom' => 'flex-end',
				],
				'condition' => [
					'nav_position' => ['left', 'right'],
				],
				'style_transfer' => true,
			]
		);

		$this->add_control(
			'_heading_tab_icon',
			[
				'label' => __( 'Tab Icon', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);

		$this->add_control(
			'nav_icon_position',
			[
				'type' => Controls_Manager::CHOOSE,
				'label' => __( 'Position', 'widgetkit-for-elementor'),
				'default' => 'left',
				'toggle' => false,
				'options' => [
					'left' => [
						'title' =>  __( 'Left', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-left',
					],
					'top' => [
						'title' =>  __( 'Top', 'widgetkit-for-elementor'),
						'icon' => 'eicon-v-align-top',
					],
					'right' => [
						'title' =>  __( 'Right', 'widgetkit-for-elementor'),
						'icon' => 'eicon-h-align-right',
					],
				],
				'style_transfer' => true,
			]
		);

		$this->end_controls_section();

		// Start Style Tab
		$this->start_controls_section(
			'_section_nav_heading',
			[
				'label' => __( 'Heading', 'widgetkit-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE,
				'condition' => [
					'tab_heading_switcher' => 'yes'
				]
			]
		);

		$this->add_responsive_control(
			'tab_heading_align',
			[
				'label' => esc_html__( 'Alignment', 'widgetkit-for-elementor'),
				'type'  => Controls_Manager::CHOOSE,
				'default'  =>'center' ,
				'options'  => [
					'left'    => [
						'title' => esc_html__( 'Left', 'widgetkit-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'widgetkit-for-elementor'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'widgetkit-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .tab-heading' => 'text-align: {{VALUE}};',
				]
			]
        );

		$this->add_control(
			'nav_heading_title_color',
			[
				'label' => __( 'Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-heading h3' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_heading_typography',
				'selector' => '{{WRAPPER}} .tab-heading h3',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_responsive_control(
			'nav_heading_title_spacing',
			[
				'label' => __( 'Spacing', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .tab-heading h3' => 'margin-bottom: {{SIZE}}px;'
				],
			]
		);

		$this->add_control(
			'nav_heading_desc_color',
			[
				'label' => __( 'Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tab-heading p' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_heading_desc_typography',
				'selector' => '{{WRAPPER}} .tab-heading p',
				'scheme' => Typography::TYPOGRAPHY_2,
			]
		);

		$this->add_responsive_control(
			'nav_heading_desc_spacing',
			[
				'label' => __( 'Spacing', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .tab-heading p' => 'margin-bottom: {{SIZE}}px;'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_tab_nav',
			[
				'label' => __( 'Title & Description', 'widgetkit-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nav_title_heading',
				[
					'label' => __( 'Title', 'widgetkit-for-elementor'),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
		);

		$this->add_control(
			'nav_title_color',
			[
				'label' => __( 'Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-text' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_title_hover_color',
			[
				'label' => __( 'Hover Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-text:hover' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_title_active_color',
			[
				'label' => __( 'Active Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .active .wk-adv-tab-title-text' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_typography',
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-text',
			]
		);

		$this->add_responsive_control(
			'nav_title_spacing',
			[
				'label' => __( 'Spacing', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-text' => 'margin-bottom: {{SIZE}}px;'
				],
			]
		);

		$this->add_control(
			'nav_description',
				[
					'label' => __( 'Description', 'widgetkit-for-elementor'),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
		);

		$this->add_control(
			'nav_desc_color',
			[
				'label' => __( 'Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-desc' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_desc_hover_color',
			[
				'label' => __( 'Hover Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-desc' => 'color: {{VALUE}};'
				]
			]
		);
		
		$this->add_control(
			'nav_desc_active_color',
			[
				'label' => __( 'Active Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .active .wk-adv-tab-title-desc' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'nav_desc_typography',
				'separator' =>'before',
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-desc',
			]
		);

		$this->add_control(
			'nav_title_desc_global_heading',
				[
					'label' => __( 'Global', 'widgetkit-for-elementor'),
					'type' => Controls_Manager::HEADING,
					'separator' => 'before',
				]
		);

		$this->add_responsive_control(
			'nav_tab_width',
			[
				'label' => __( 'Nav Area Width', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .nav-pos-left .wk-adv-tabs-nav, {{WRAPPER}} .nav-pos-right .wk-adv-tabs-nav' => 'flex: 0 0 {{SIZE}}{{UNIT}};',
					'{{WRAPPER}} .nav-pos-left .wk-tabs-content, {{WRAPPER}} .nav-pos-right .wk-tabs-content' => 'flex: 0 0 calc(100% - {{SIZE}}{{UNIT}});'
				],
			]
		);

		$this->add_responsive_control(
			'nav_margin_x',
			[
				'label' => __( 'Horizontal Margin (px)', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'step' => 'any',
				'selectors' => [
					
					'{{WRAPPER}} .nav-pos-left .wk-adv-tabs-nav li' => 'margin-right: {{VALUE}}px;',
					'{{WRAPPER}} .nav-pos-right .wk-adv-tabs-nav li' => 'margin-left: {{VALUE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'nav_margin_y',
			[
				'label' => __( 'Vertical Margin (px)', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::NUMBER,
				'step' => 'any',
				'selectors' => [
					'{{WRAPPER}} .nav-pos-left .wk-adv-tabs-nav li:not(:last-child)' => 'margin-bottom: {{VALUE}}px;',
					'{{WRAPPER}} .nav-pos-right .wk-adv-tabs-nav li:not(:last-child)' => 'margin-bottom: {{VALUE}}px;',
					'{{WRAPPER}} .nav-pos-left .wk-adv-tabs-nav li' => 'margin-bottom: {{VALUE}}px;',
					'{{WRAPPER}} .nav-pos-right .wk-adv-tabs-nav li' => 'margin-bottom: {{VALUE}}px;',
				],
			]
		);

		$this->add_responsive_control(
			'nav_padding',
			[
				'label' => __( 'Padding', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'nav_border_radius',
			[
				'label' => __( 'Border Radius', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->start_controls_tabs( '_tab_nav_stats' );
		$this->start_controls_tab(
			'_tab_nav_normal',
			[
				'label' => __( 'Normal', 'widgetkit-for-elementor'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_bg_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_border',
				'label' => __( 'Border', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_box_shadow',
				'label' => __( 'Box Shadow', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a'
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_nav_hover',
			[
				'label' => __( 'Hover', 'widgetkit-for-elementor'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_hover_bg_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_hover_border',
				'label' => __( 'Border', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a:hover'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_hover_box_shadow',
				'label' => __( 'Box Shadow', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a:hover'
			]
		);

		$this->end_controls_tab();
		$this->start_controls_tab(
			'_tab_nav_active',
			[
				'label' => __( 'Active', 'widgetkit-for-elementor'),
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'nav_active_bg_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .active a'
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'nav_active_border',
				'label' => __( 'Border', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .active a'
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'nav_active_box_shadow',
				'label' => __( 'Box Shadow', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .active a'
			]
		);

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();


		$this->start_controls_section(
			'_section_nav_icon',
			[
				'label' => __( 'Title Icon', 'widgetkit-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'nav_icon_color',
			[
				'label' => __( 'Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-icon>svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-icon>i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_icon_hover_color',
			[
				'label' => __( 'Hover Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a:hover .wk-adv-tab-title-icon>svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav a:hover .wk-adv-tab-title-icon>i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_icon_active_color',
			[
				'label' => __( 'Active Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .active .wk-adv-tab-title-icon>svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .active .wk-adv-tab-title-icon>i' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'nav_icon_spacing',
			[
				'label' => __( 'Margin', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px'],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-icon>svg, {{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-icon>i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'nav_icon_size',
			[
				'label' => __( 'Size', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => ['px'],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-adv-tabs-nav .wk-adv-tab-title-icon' => 'font-size: {{SIZE}}px;',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'_section_tab_content',
			[
				'label' => __( 'Content', 'widgetkit-for-elementor'),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'_heading_content_text',
			[
				'label' => __( 'Text', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'tab_content_typography',
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content',
			]
		);

		$this->add_control(
			'tab_content_color',
			[
				'label' => __( 'Color', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content' => 'color: {{VALUE}};'
				]
			]
		);

		$this->add_control(
			'_heading_content_img',
			[
				'label' => __( 'Image', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'tab_img_width',
			[
				'label' => __( 'Width', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'tab_img_margin',
			[
				'label' => __( 'Margin', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_img_border',
				'label' => __( 'Border', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content img',
			]
		);

		$this->add_control(
			'tab_img_border_radius',
			[
				'label' => __( 'Border Radius', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'tab_img_box_shadow',
				'label' => __( 'Box Shadow', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content img',
			]
		);

		$this->add_control(
			'_heading_content_global',
			[
				'label' => __( 'Global', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::HEADING,
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'tab_img_align',
			[
				'label' => esc_html__( 'Alignment', 'widgetkit-for-elementor'),
				'type'  => Controls_Manager::CHOOSE,
				'default'  =>'center' ,
				'options'  => [
					'left'    => [
						'title' => esc_html__( 'Left', 'widgetkit-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'widgetkit-for-elementor'),
						'icon'  => 'eicon-text-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'widgetkit-for-elementor'),
						'icon'  => 'eicon-text-align-left',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content' => 'text-align: {{VALUE}};',
				]
			]
        );

		$this->add_responsive_control(
			'content_padding',
			[
				'label' => __( 'Padding', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Border::get_type(),
			[
				'name' => 'tab_content_border',
				'label' => __( 'Border', 'widgetkit-for-elementor'),
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content'
			]
		);

		$this->add_control(
			'content_border_radius',
			[
				'label' => __( 'Border Radius', 'widgetkit-for-elementor'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%' ],
				'selectors' => [
					'{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Background::get_type(),
			[
				'name' => 'content_bg',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .wk-adv-tab-wrapper .wk-tabs-content-wrap .wk-tabs-content',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		require WK_PATH . '/elements/advanced-tab/template/view.php';
	}
}