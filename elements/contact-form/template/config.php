<?php
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Control_Media;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Widget_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 * Elementor WidgetKit Contact Form 7
 *
 * Elementor widget for WidgetKit contact form 7
 *
 * @since 1.0.0
 */

class wkfe_contact_form extends Widget_Base {

	public function get_name() {
		return 'widgetkit-for-elementor-contact-form';
	}

	public function get_title() {
		return esc_html__( 'Contact Form', 'widgetkit-for-elementor' );
	}

	public function get_icon() {
		return 'eicon-form-horizontal wk-icon';
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
            'section_contact',
            [
                'label'                 => __( 'Contact Form', 'widgetkit-for-elementor' ),
            ]
        );

            $this->add_control(
                'contact_form_list',
                    [
                        'label'       => __( 'Contact Forms', 'widgetkit-for-elementor' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'overlay',
                        'options' => [
                            'contact-7'   => __( 'Contact Form 7', 'widgetkit-for-elementor' ),
                            'weforms'     => __( 'Weforms', 'widgetkit-for-elementor' ),
                            'wpforms'     => __( 'Wpforms', 'widgetkit-for-elementor' ),
                        ],
                        
                    ]
            );

        
            $this->add_control(
                'choose_form_7',
                [
                    'label'                 => esc_html__( 'Choose Form', 'widgetkit-for-elementor' ),
                    'type'                  => Controls_Manager::SELECT,
                    'label_block'           => true,
                    'options'               => widgetkit_contact_form_7(),
                    'default'               => '0',
                    'condition' => [
                        'contact_form_list' => 'contact-7',
                    ],
                ]
            );
            $this->add_control(
                'choose_weforms',
                [
                    'label'                 => esc_html__( 'Choose Form', 'widgetkit-for-elementor' ),
                    'type'                  => Controls_Manager::SELECT,
                    'label_block'           => true,
                    'options'               => widgetkit_weform(),
                    'default'               => '0',
                    'condition' => [
                        'contact_form_list' => 'weforms',
                    ],
                ]
            );

            $this->add_control(
                'choose_wpforms',
                [
                    'label'                 => esc_html__( 'Choose Form', 'widgetkit-for-elementor' ),
                    'type'                  => Controls_Manager::SELECT,
                    'label_block'           => true,
                    'options'               => widgetkit_wpforms(),
                    'default'               => '0',
                    'condition' => [
                        'contact_form_list' => 'wpforms',
                    ],
                ]
            );

            // $this->add_control(
            //     'label_heading',
            //     [
            //         'label' => esc_html__( 'Labels', 'widgetkit-for-elementor' ),
            //         'type'  => Controls_Manager::HEADING,
            //         'separator' => 'before',
            //     ]
            // );


            // $this->add_control(
            //     'labels_enable',
            //     [
            //         'label'                 => __( 'Display', 'widgetkit-for-elementor' ),
            //         'type'                  => Controls_Manager::SWITCHER,
            //         'default'               => 'yes',
            //         'label_on'              => __( 'Show', 'widgetkit-for-elementor' ),
            //         'label_off'             => __( 'Hide', 'widgetkit-for-elementor' ),
            //         'return_value'          => 'yes',
            //     ]
            // );



        $this->end_controls_section();




        $this->start_controls_section(
            'section_message',
            [
                'label' => __( 'Message', 'widgetkit-for-elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

            $this->add_control(
                'error_messages',
                [
                    'label'                 => __( 'Error', 'widgetkit-for-elementor' ),
                    'type'                  => Controls_Manager::SELECT,
                    'default'               => 'show',
                    'options'               => [
                        'show'          => __( 'Show', 'widgetkit-for-elementor' ),
                        'hide'          => __( 'Hide', 'widgetkit-for-elementor' ),
                    ],
                    'selectors_dictionary'  => [
                        'show'          => 'block',
                        'hide'          => 'none',
                    ],
                    'selectors'             => [
                        '{{WRAPPER}} .pp-contact-form-7 .wpcf7-not-valid-tip' => 'display: {{VALUE}} !important;',
                    ],
                ]
            );

            $this->add_control(
                'validation_errors',
                [
                    'label'                 => __( 'Validation', 'widgetkit-for-elementor' ),
                    'type'                  => Controls_Manager::SELECT,
                    'default'               => 'show',
                    'options'               => [
                        'show'          => __( 'Show', 'widgetkit-for-elementor' ),
                        'hide'          => __( 'Hide', 'widgetkit-for-elementor' ),
                    ],
                    'selectors_dictionary'  => [
                        'show'          => 'block',
                        'hide'          => 'none',
                    ],
                    'selectors'             => [
                        '{{WRAPPER}} .pp-contact-form-7 .wpcf7-validation-errors' => 'display: {{VALUE}} !important;',
                    ],
                ]
            );


        $this->end_controls_section();

        // $this->start_controls_section(
        //     'section_layout',
        //     [
        //         'label' => __( 'Layout', 'widgetkit-for-elementor' ),
        //         'tab'   => Controls_Manager::TAB_CONTENT,
        //     ]
        // );


            // $this->add_control(
            //     'content_position',
            //         [
            //             'label'       => __( 'Content Position', 'widgetkit-for-elementor' ),
            //             'type' => Controls_Manager::SELECT,
            //             'default' => 'overlay',
            //             'options' => [
            //                 'overlay'   => __( 'Overlay', 'widgetkit-for-elementor' ),
            //                 'bottom'    => __( 'Bottom', 'widgetkit-for-elementor' ),
            //             ],
                        
            //         ]
            // );

            // $this->add_control(
            //     'content_align',
            //     [
            //         'label' => esc_html__( 'Alignment', 'widgetkit-for-elementor' ),
            //         'type'  => Controls_Manager::CHOOSE,
            //         'default'   => 'left',
            //         'options' => [
            //             'left'    => [
            //                 'title' => esc_html__( 'Left', 'widgetkit-for-elementor' ),
            //                 'icon'  => 'eicon-text-align-left',
            //             ],
            //             'center' => [
            //                 'title' => esc_html__( 'Center', 'widgetkit-for-elementor' ),
            //                 'icon'  => 'eicon-text-align-center',
            //             ],
            //             'right' => [
            //                 'title' => esc_html__( 'Right', 'widgetkit-for-elementor' ),
            //                 'icon'  => 'eicon-text-align-left',
            //             ],
            //         ],
            //     ]
            // );

            // $this->add_control(
            //     'effect_enable',
            //     [
            //         'label' => __( 'Effect Enable', 'widgetkit-for-elementor' ),
            //         'type' => Controls_Manager::SWITCHER,
            //         'yes' => __( 'Yes', 'widgetkit-for-elementor' ),
            //         'no' => __( 'No', 'widgetkit-for-elementor' ),
            //         'return_value' => 'yes',
            //         'default'   => 'yes',
            //         'separator' => 'before',
            //     ]
            // );


            // $this->add_control(
            //     'select_effect',
            //         [
            //             'label'       => __( 'Choose Effect', 'widgetkit-for-elementor' ),
            //             'type' => Controls_Manager::SELECT,
            //             'default' => 'default',
            //             'options' => [
            //                 'default'   => __( 'Default', 'widgetkit-for-elementor' ),
            //                 'glare'     => __( 'Glare', 'widgetkit-for-elementor' ),
            //                 'reverse'   => __( 'Reverse', 'widgetkit-for-elementor' ),
            //                 'floating'  => __( 'Floating', 'widgetkit-for-elementor' ),
            //                 'listening'  => __( 'Listening', 'widgetkit-for-elementor' ),
            //                 'x'  => __( 'X axis', 'widgetkit-for-elementor' ),
            //                 'y'  => __( 'Y axis', 'widgetkit-for-elementor' ),
            //             ],
                        
            //             'condition' => [
            //                 'effect_enable' => 'yes',
            //             ],
            //         ]
            // );


        // $this->add_control(
        //     'hide_overlay',
        //     [
        //         'label' => __( 'Display Overlay', 'widgetkit-for-elementor' ),
        //         'type' => Controls_Manager::SWITCHER,
        //         'label_on' => __( 'Yes', 'widgetkit-for-elementor' ),
        //         'label_off' => __( 'No', 'widgetkit-for-elementor' ),
        //         'return_value' => 'yes',
        //         'description' => __( 'Hide overlay with before and after label', 'widgetkit-for-elementor' ),
        //         'style_transfer' => true,
        //     ]
        // );



        // $this->end_controls_section();

        /**
         * Style Tab: Input & Textarea
         * -------------------------------------------------
         */
        $this->start_controls_section(
            'section_fields_style',
            [
                'label'                 => __( 'Input & Textarea', 'widgetkit-for-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );


        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'field_typography',
                'label'                 => __( 'Typography', 'widgetkit-for-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea',
                'separator'             => 'before',
            ]
        );

        $this->start_controls_tabs( 'tabs_fields_style' );

        $this->start_controls_tab(
            'tab_fields_normal',
            [
                'label'                 => __( 'Normal', 'widgetkit-for-elementor' ),
            ]
        );

        $this->add_control(
            'field_text_color',
            [
                'label'                 => __( 'Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_bg',
            [
                'label'                 => __( 'Background Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'field_border',
                'label'                 => __( 'Border', 'widgetkit-for-elementor' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea',
               
            ]
        );

        $this->add_control(
            'field_radius',
            [
                'label'                 => __( 'Border Radius', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator'             => 'before',
            ]
        );

        
        $this->add_responsive_control(
            'input_spacing',
            [
                'label'                 => __( 'Spacing', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '5',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea' => 'margin-bottom: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label'                 => __( 'Padding', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    
        
        $this->add_responsive_control(
            'input_width',
            [
                'label'                 => __( 'Width', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1200,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form input[type="text"], {{WRAPPER}} .wk-contact-form input[type="email"], {{WRAPPER}} .wk-contact-form textarea' => 'width: {{SIZE}}{{UNIT}}',
                ],
            ]
        );
        



        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_fields_focus',
            [
                'label'                 => __( 'Focus', 'widgetkit-for-elementor' ),
            ]
        );
        
        $this->add_control(
            'field_bg_focus',
            [
                'label'                 => __( 'Background Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form input[type="text"]:focus, {{WRAPPER}} .wk-contact-form input[type="email"]:focus, {{WRAPPER}} .wk-contact-form textarea:focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'input_border_focus',
                'label'                 => __( 'Border', 'widgetkit-for-elementor' ),
                'placeholder'           => '1px',
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .wk-contact-form input[type="text"]:focus, {{WRAPPER}} .wk-contact-form input[type="email"]:focus, {{WRAPPER}} .wk-contact-form textarea:focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'focus_box_shadow',
                'selector'              => '{{WRAPPER}} .wk-contact-form input[type="text"]:focus, {{WRAPPER}} .wk-contact-form input[type="email"]:focus, {{WRAPPER}} .wk-contact-form textarea:focus',
                'separator'             => 'before',
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();

        /**
         * Style Tab: Placeholder Section
         */
        $this->start_controls_section(
            'section_placeholder_style',
            [
                'label'                 => __( 'Placeholder', 'widgetkit-for-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );
        
        // $this->add_control(
        //     'placeholder_switch',
        //     [
        //         'label'                 => __( 'Show Placeholder', 'widgetkit-for-elementor' ),
        //         'type'                  => Controls_Manager::SWITCHER,
        //         'default'               => 'yes',
        //         'label_on'              => __( 'Yes', 'widgetkit-for-elementor' ),
        //         'label_off'             => __( 'No', 'widgetkit-for-elementor' ),
        //         'return_value'          => 'yes',
        //     ]
        // );

        $this->add_control(
            'text_color_placeholder',
            [
                'label'                 => __( 'Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form ::-webkit-placeholder, {{WRAPPER}} .wk-contact-form ::placeholder' => 'color: {{VALUE}}',
                ],
            ]
        );
        
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'typography_placeholder',
                'label'                 => __( 'Typography', 'widgetkit-for-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .wk-contact-form ::-webkit-placeholder, {{WRAPPER}} .wk-contact-form ::placeholder',
            ]
        );
        
        $this->end_controls_section();


                /**
         * Style Tab: Submit Button
         */
        $this->start_controls_section(
            'section_submit_button_style',
            [
                'label'                 => __( 'Submit Button', 'widgetkit-for-elementor' ),
                'tab'                   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'                  => 'button_typography',
                'label'                 => __( 'Typography', 'widgetkit-for-elementor' ),
                'scheme'                => Scheme_Typography::TYPOGRAPHY_4,
                'selector'              => '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]',
                'separator'             => 'before',
            ]
        );
        

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label'                 => __( 'Normal', 'widgetkit-for-elementor' ),
            ]
        );
        $this->add_control(
            'button_text_color_normal',
            [
                'label'                 => __( 'Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color_normal',
            [
                'label'                 => __( 'Background Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]' => 'background-color: {{VALUE}}',
                ],
            ]
        );



        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'                  => 'button_border_normal',
                'label'                 => __( 'Border', 'widgetkit-for-elementor' ),
                'default'               => '1px',
                'selector'              => '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label'                 => __( 'Border Radius', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );



        $this->add_control(
            'button_width_type',
            [
                'label'                 => __( 'Width', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::SELECT,
                'default'               => 'default',
                'options'               => [
                    'default'       => __( 'Default', 'widgetkit-for-elementor' ),
                    'full-width'    => __( 'Full Width', 'widgetkit-for-elementor' ),
                    'custom'        => __( 'Custom', 'widgetkit-for-elementor' ),
                ],
                'prefix_class'      => 'wk-form-button-',
            ]
        );
        
        $this->add_responsive_control(
            'button_width',
            [
                'label'                 => __( 'Set Width', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'default'               => [
                    'size'      => '100',
                    'unit'      => 'px'
                ],
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 1120,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .wk-submit-button-custom.wk-contact-form button, {{WRAPPER}} .wk-submit-button-custom.wk-contact-form input[type="button"], {{WRAPPER}} .wk-submit-button-custom wk-contact-form input[type="reset"], {{WRAPPER}} .wk-submit-button-custom.wk-contact-form input[type="submit"]' => 'width: {{SIZE}}{{UNIT}}',
                ],
                'condition'             => [
                    'button_width_type' => 'custom',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_align',
            [
                'label'                 => __( 'Alignment', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::CHOOSE,
                'default'               => 'left',
                'options'               => [
                    'left'        => [
                        'title'   => __( 'Left', 'widgetkit-for-elementor' ),
                        'icon'    => 'eicon-h-align-left',
                    ],
                    'center'      => [
                        'title'   => __( 'Center', 'widgetkit-for-elementor' ),
                        'icon'    => 'eicon-h-align-center',
                    ],
                    'right'       => [
                        'title'   => __( 'Right', 'widgetkit-for-elementor' ),
                        'icon'    => 'eicon-h-align-right',
                    ],
                ],
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form.button-right button, .wk-contact-form.button-right input[type="button"], .wk-contact-form.button-right input[type="reset"], .wk-contact-form.button-right input[type="submit"]'   => 'float: {{VALUE}}; ',
                    '{{WRAPPER}} .wk-contact-form.button-center button, .wk-contact-form.button-right input[type="button"], .wk-contact-form.button-center input[type="reset"], .wk-contact-form.button-center input[type="submit"]' => 'display:flex;margin:20px auto;',
                    '{{WRAPPER}} .wk-contact-form.button-left button, .wk-contact-form.button-left input[type="button"], .wk-contact-form.button-left input[type="reset"], .wk-contact-form.button-left input[type="submit"]' => 'float: {{VALUE}}; ',
                ],
                'condition'             => [
                    'button_width_type' => ['default', 'custom'],
                ],
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label'                 => __( 'Padding', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::DIMENSIONS,
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .wk-contact-form button, {{WRAPPER}} .wk-contact-form input[type="button"], {{WRAPPER}} .wk-contact-form input[type="reset"], {{WRAPPER}} .wk-contact-form input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'button_margin',
            [
                'label'                 => __( 'Margin Top', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::SLIDER,
                'range'                 => [
                    'px'        => [
                        'min'   => 0,
                        'max'   => 100,
                        'step'  => 1,
                    ],
                ],
                'size_units'            => [ 'px', 'em', '%' ],
                'selectors'             => [
                    '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]' => 'margin-top: {{SIZE}}{{UNIT}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name'                  => 'button_box_shadow',
                'selector'              => '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]',
                'separator'             => 'before',
            ]
        );
        
        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label'                 => __( 'Hover', 'widgetkit-for-elementor' ),
            ]
        );

        $this->add_control(
            'button_bg_color_hover',
            [
                'label'                 => __( 'Background Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'background-color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_text_color_hover',
            [
                'label'                 => __( 'Text Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'button_border_color_hover',
            [
                'label'                 => __( 'Border Color', 'widgetkit-for-elementor' ),
                'type'                  => Controls_Manager::COLOR,
                'default'               => '',
                'selectors'             => [
                    '{{WRAPPER}} .pp-contact-form-7 .wpcf7-form input[type="submit"]:hover' => 'border-color: {{VALUE}}',
                ],
            ]
        );
        
        $this->end_controls_tab();
        
        $this->end_controls_tabs();
        
        $this->end_controls_section();
    }


	protected function render() {
        require WK_PATH . '/elements/contact-form/template/view.php';

    }


    public function _content_template() {
    }
}
