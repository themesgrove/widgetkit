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
class WKFE_Pros_Cons_Config extends Widget_Base {

	public function get_name() {
		return 'widgetkit-for-elementor-pros-cons';
	}

	public function get_title() {
		return esc_html__( 'Pros & Cons', 'widgetkit-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-animation-text';
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
            'animate-css',
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

	/**
	 * pros
	 */
	$this->start_controls_section(
		'section_pros_content',
		[
			'label' => esc_html__( 'Pros', 'widgetkit-for-elementor' ),
		]
	);

		$this->add_control(
		    'pros_title',
		      	[
		          'label' => esc_html__( 'Title', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::TEXT,
		          'default' => esc_html__( 'Pros', 'widgetkit-for-elementor' ),
		    	]
		);
		$this->add_control(
		    'pros_icon',
		      	[
		          'label' => esc_html__( 'Icon', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::ICON,
		          'default' => esc_html__( 'fa fa-thumbs-up', 'widgetkit-for-elementor' ),
		    	]
	    );

        $repeater = new Repeater();
        $repeater->add_control(
            'pros_feature_input',
            [
                'label'   => esc_html__( 'Feature', 'widgetkit-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Feature', 'widgetkit-for-elementor' ),
            ]
		);
		$repeater->add_control(
            'pros_feature_icon',
            [
                'label'   => esc_html__( 'Icon', 'widgetkit-for-elementor' ),
                'type'    => Controls_Manager::ICON,
                'default' => esc_html__( 'fa fa-check', 'widgetkit-for-elementor' ),
            ]
        );

        $this->add_control(
            'pros_feature_lists',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => array_values( $repeater->get_controls() ),
                'default' => [
                    [
                        'pros_feature_input' => esc_html__( 'Feature 1', 'widgetkit-for-elementor' ),
                        'feature_icon' => esc_html__( 'fa fa-check', 'widgetkit-for-elementor' ),
                    ],
                    [
                        'pros_feature_input' => esc_html__( 'Feature 2', 'widgetkit-for-elementor' ),
                        'feature_icon' => esc_html__( 'fa fa-check', 'widgetkit-for-elementor' ),
                    ],
                    
                ],
                'title_field' => '{{{ pros_feature_input }}}',
            ]
        );

        
	$this->end_controls_section();
	/**
	 * cons
	 */
	$this->start_controls_section(
		'section_cons_content',
		[
			'label' => esc_html__( 'Cons', 'widgetkit-for-elementor' ),
		]
	);

		$this->add_control(
		    'cons_title',
		      	[
		          'label' => esc_html__( 'Title', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::TEXT,
		          'default' => esc_html__( 'Cons', 'widgetkit-for-elementor' ),
		    	]
		);
		$this->add_control(
		    'cons_icon',
		      	[
		          'label' => esc_html__( 'Icon', 'widgetkit-for-elementor' ),
		          'type'  => Controls_Manager::ICON,
		          'default' => esc_html__( 'fa fa-thumbs-down', 'widgetkit-for-elementor' ),
		    	]
	    );

        $repeater = new Repeater();
        $repeater->add_control(
            'cons_feature_input',
            [
                'label'   => esc_html__( 'Feature', 'widgetkit-for-elementor' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'Feature', 'widgetkit-for-elementor' ),
            ]
		);
		$repeater->add_control(
            'cons_feature_icon',
            [
                'label'   => esc_html__( 'Icon', 'widgetkit-for-elementor' ),
                'type'    => Controls_Manager::ICON,
                'default' => esc_html__( 'fa fa-close', 'widgetkit-for-elementor' ),
            ]
        );

        $this->add_control(
            'cons_feature_lists',
            [
                'type'    => Controls_Manager::REPEATER,
                'fields'  => array_values( $repeater->get_controls() ),
                'default' => [
                    [
                        'cons_feature_input' => esc_html__( 'Feature 1', 'widgetkit-for-elementor' ),
                        'feature_icon' => esc_html__( 'fa fa-close', 'widgetkit-for-elementor' ),
                    ],
                    [
                        'cons_feature_input' => esc_html__( 'Feature 2', 'widgetkit-for-elementor' ),
                        'feature_icon' => esc_html__( 'fa fa-close', 'widgetkit-for-elementor' ),
                    ],
                    
                ],
                'title_field' => '{{{ cons_feature_input }}}',
            ]
        );

        
	$this->end_controls_section();


	// Content options End


		$this->start_controls_section(
		'section_content_layout',
		[
			'label' => esc_html__( 'Animation Options', 'widgetkit-for-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		]
	);


        $this->add_control(
			'choose_animation_text',
				[
					'label'     => esc_html__( 'Choose Animation', 'widgetkit-for-elementor' ),
					'type'      => Controls_Manager::SELECT,
					'default'   => 'rotate',
					'options'   => [
						'rotate'  => esc_html__('Rotate', 'widgetkit-for-elementor'),
						'clip'    => esc_html__( 'Clip', 'widgetkit-for-elementor' ),
						'loading_bar'    => esc_html__( 'Loading', 'widgetkit-for-elementor' ),
						'push'    => esc_html__( 'Push', 'widgetkit-for-elementor' ),
					],
				]
		);



	$this->end_controls_section();


	$this->start_controls_section(
		'section_animate_title',
		[
			'label' => esc_html__( 'Title', 'widgetkit-for-elementor' ),
			'tab'   => Controls_Manager::TAB_STYLE,
		]
	);

     	$this->add_control(
			'animaton_title_color',
			[
				'label'     => esc_html__( 'Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#333',
				'selectors' => [
					'{{WRAPPER}} .animation-text .text-slide .cd-headline' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
				[
					'name'     => 'animation_title_typography',
					'label'    => esc_html__( 'Title Typography', 'widgetkit-for-elementor' ),
					'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
					'selector' => '{{WRAPPER}} .animation-text .text-slide .cd-headline',
				]
		);

		$this->add_control(
			'animaton_bold_color',
			[
				'label'     => esc_html__( 'Animat Text Color', 'widgetkit-for-elementor' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#ed485f',
				'selectors' => [
					'{{WRAPPER}} .animation-text .text-slide .cd-headline b' => 'color: {{VALUE}};',
					'{{WRAPPER}} .cd-headline.loading-bar .cd-words-wrapper:after' => 'background: {{VALUE}};',
				],
			]
		);


		$this->add_responsive_control(
			'text_animation_align',
			[
				'label' => esc_html__( 'Alignment', 'widgetkit-for-elementor' ),
				'type'  => Controls_Manager::CHOOSE,
				'default'   => 'left',
				'options' => [
					'left'    => [
						'title' => esc_html__( 'Left', 'widgetkit-for-elementor' ),
						'icon'  => 'fa fa-align-left',
					],
					'center' => [
						'title' => esc_html__( 'Center', 'widgetkit-for-elementor' ),
						'icon'  => 'fa fa-align-center',
					],
					'right' => [
						'title' => esc_html__( 'Right', 'widgetkit-for-elementor' ),
						'icon'  => 'fa fa-align-right',
					],
					'justify' => [
						'title' => esc_html__( 'Justified', 'widgetkit-for-elementor' ),
						'icon'  => 'fa fa-align-justify',
					],
				],
				'selectors' => [
					'{{WRAPPER}} .animation-text .text-slide .cd-headline' => 'text-align: {{VALUE}};',
				],
			]
		);


	$this->end_controls_section();

	}

	protected function render() {
		require WKFE_PATH . '/elements/pros-cons/template/view.php';
	}


}
