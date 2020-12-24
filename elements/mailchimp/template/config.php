<?php
use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;

if (!defined('ABSPATH')) exit; // Exit if accessed directly

/**
 * Layout
 * =============
 */
class wkfe_mailchimp extends Widget_Base
{

    public function get_name()
    {
        return 'widgetkit-for-elementor-mailchimp';
    }

    public function get_title()
    {
        return __('MailChimp', 'widgetkit-for-elementor');
    }

    public function get_icon()
    {
        return 'eicon-email-field';
    }

    public function get_categories()
    {
        return ['widgetkit_elementor'];
    }
    /**
	 * A list of style that the widgets is depended in
	 **/
	public function get_style_depends() {
        return [
            'widgetkit_bs',
            'fontawesome',
            'widgetkit_main',
        ];
    }

    /**
     * A list of scripts that the widgets is depended in
     *
     * @since 1.3.0
     **/
    public function get_script_depends() {
		return [ 
			'widgetkit-main',
		 ];
	}

    protected function _register_controls()
    {

        /* slides content title subtitle button and button link */
        $this->start_controls_section(
            'section_tab',
            [
                'label' => __('Layout', 'widgetkit-for-elementor'),
            ]
        );
        $this->add_control(
            'placeholder_text',
            [
                'label'       => __( 'Placeholder Text', 'widgetkit-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Type your email here', 'widgetkit-for-elementor' ),
                'placeholder' => __( 'Type your email address here', 'widgetkit-for-elementor' ),
            ]
        );
        $this->add_control(
            'button_text',
            [
                'label'       => __( 'Button Text', 'widgetkit-for-elementor' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => __( 'Submit', 'widgetkit-for-elementor' ),
                'placeholder' => __( 'Type your button text here', 'widgetkit-for-elementor' ),
            ]
        );

        $this->end_controls_section();

        /**
         * Style tab
         * =============
         */
        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Typography', 'widgetkit-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Input', 'widgetkit-for-elementor' ),
                'name' => 'email_input_typography',
                'selector' => '{{WRAPPER}}  .tx-newsletter-form-element input[type="email"]',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'label' => __( 'Button', 'widgetkit-for-elementor' ),
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}}  .tx-newsletter-form-element input[type="submit"]',
            ]
        );


        $this->end_controls_section();

        $this->start_controls_section(
            'input_style',
            [
                'label' => __( 'Input', 'widgetkit-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_responsive_control(
                'txnl-input-width',
                [
                    'label' => esc_html__( 'Width', 'widgetkit-for-elementor' ),
                    'type'  => Controls_Manager::SLIDER,
                    'default' => [
                        'size' =>100,
                    ],
                    'range'  => [
                        '%' => [
                            'max' => 100,
                        ],
                    ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'tablet_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'mobile_default' => [
                        'size' => 100,
                        'unit' => '%',
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-newsletter-form-element input[type="email"]' => 'width:{{SIZE}}%;',
                    ],
                ]
            );
            $this->add_responsive_control(
                'txnl_input_margin',
                [
                    'label' => esc_html__( 'Margin', 'widgetkit-for-elementor' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px' ],
                    'default' => [
                        'top' => 0,
                        'right' => 20,
                        'bottom' => 0,
                        'left' => 0,
                        'unit' => 'px',
                        'isLinked' => false,
                    ],
                    'devices' => [ 'desktop', 'tablet', 'mobile' ],
                    'desktop_default' => [
                        'size' => 20,
                        'unit' => 'px',
                    ],
                    'tablet_default' => [
                        'size' => 20,
                        'unit' => 'px',
                    ],
                    'mobile_default' => [
                        'size' => 10,
                        'unit' => 'px',
                    ],
                    'selectors'  => [
                        '{{WRAPPER}} .tx-newsletter-form-element div.email' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_responsive_control(
                'input_custom_padding',
                [
                    'label' => __( 'Padding', 'widgetkit-for-elementor' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .tx-newsletter-form-element input[type="email"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'  => 'txnl_input_border',
                    'label' => esc_html__( 'Border', 'widgetkit-for-elementor' ),
                    'placeholder' => '1px',
                    'default'   => '1px',
                    'fields_options' => [
                        'border' => [
                            'default' => 'solid',
                        ],
                        'width' => [
                            'default' => [
                                'top' => '2',
                                'right' => '2',
                                'bottom' => '2',
                                'left' => '2',
                                'isLinked' => true,
                            ],
                        ],
                        'color' => [
                            'default' => '#df7027',
                        ],
                    ],
                    'selector'  => '{{WRAPPER}} .tx-newsletter-form-element input[type="email"]',
                    'separator' => 'before',
                ]
            );
        
        $this->end_controls_section();


        $this->start_controls_section(
            'button_style',
            [
                'label' => __( 'Button', 'widgetkit-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->add_responsive_control(
            'button_custom_padding',
            [
                'label' => __( 'Button Padding', 'widgetkit-for-elementor' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .tx-newsletter-form-element input[type="submit"]' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        

        $this->start_controls_tabs( 'tabs_button_style' );
            /**
             * Button normal style is below
             * Hover style will start whle end of this control tab
             * nl prefix stands for newsletter
             */
            $this->start_controls_tab(
                'newsletter_button_normal',
                [
                    'label' => esc_html__( 'Normal', 'widgetkit-for-elementor' ),
                ]
            );
            
            $this->add_control(
                'txnl_button_text_color',
                [
                    'label'   => esc_html__( 'Text', 'widgetkit-for-elementor' ),
                    'type'    => Controls_Manager::COLOR,
                    'default' => '#fff',
                    'selectors' => [
                        '{{WRAPPER}}  .tx-newsletter-form-element input[type="submit"]' => 'color: {{VALUE}};',
                    ],
                ]
            );

            $this->add_control(
                'txnl_button_background_color',
                [
                    'label' => esc_html__( 'Background', 'widgetkit-for-elementor' ),
                    'type'  => Controls_Manager::COLOR,
                    'default' => '#df7027',
                    'selectors' => [
                        '{{WRAPPER}} .tx-newsletter-form-element input[type="submit"]' => 'background-color: {{VALUE}};',
                    ],
                ]
            );

            /**
             * No need to define color and border field
             * this group will produce those fields
             */
            $this->add_group_control(
                Group_Control_Border::get_type(),
                [
                    'name'  => 'txnl_button_border',
                    'label' => esc_html__( 'Border', 'widgetkit-for-elementor' ),
                    'placeholder' => '1px',
                    'default'   => '1px',
                    'fields_options' => [
                        'border' => [
                            'default' => 'solid',
                        ],
                        'width' => [
                            'default' => [
                                'top' => '2',
                                'right' => '2',
                                'bottom' => '2',
                                'left' => '2',
                                'isLinked' => true,
                            ],
                        ],
                        'color' => [
                            'default' => '#df7027',
                        ],
                    ],
                    'selector'  => '{{WRAPPER}} .tx-newsletter-form-element input[type="submit"]',
                    'separator' => 'before',
                ]
            );
            

            $this->end_controls_tab();
            
            /**
             * Button hover style tab starts here
             */
            $this->start_controls_tab(
                'newsletter_button_hover',
                [
                    'label' => esc_html__( 'Hover', 'widgetkit-for-elementor' ),
                ]
            );

                $this->add_control(
                    'txnl_button_text_hover_color',
                    [
                        'label'   => esc_html__( 'Text', 'widgetkit-for-elementor' ),
                        'type'    => Controls_Manager::COLOR,
                        'default' => '#df7027',
                        'selectors' => [
                            '{{WRAPPER}}  .tx-newsletter-form-element input[type="submit"]:hover' => 'color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_control(
                    'txnl_button_background_hover_color',
                    [
                        'label' => esc_html__( 'Background', 'widgetkit-for-elementor' ),
                        'type'  => Controls_Manager::COLOR,
                        'default' => '#fff',
                        'selectors' => [
                            '{{WRAPPER}} .tx-newsletter-form-element input[type="submit"]:hover' => 'background-color: {{VALUE}};',
                        ],
                    ]
                );

                $this->add_group_control(
                    Group_Control_Border::get_type(),
                    [
                        'name'  => 'txnl_button_hover_border',
                        'label' => esc_html__( 'Border', 'widgetkit-for-elementor' ),
                        'placeholder' => '1px',
                        'default'   => '1px',
                        'selector'  => '{{WRAPPER}} .tx-newsletter-form-element input[type="submit"]:hover',
                        'separator' => 'before',
                    ]
                );
                

            $this->end_controls_tab();

        $this->end_controls_tabs();
        
        $this->end_controls_section();

        $this->start_controls_section(
            'common_style',
            [
                'label' => __( 'Common', 'widgetkit-for-elementor' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
            $this->add_control(
                'txnl_button_border_radius',
                [
                    'label' => esc_html__( 'Border Radius', 'widgetkit-for-elementor' ),
                    'type'  => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%' ],
                    'selectors'  => [
                        '{{WRAPPER}} .tx-newsletter-form-element input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
                ]
            );
        $this->end_controls_tab();

    }

    protected function render()
    {
        $settings = $this->get_settings();
        $form_input_placeholder_text = widgetkit_for_elementor_array_get($settings, 'placeholder_text');
        $form_button_text = widgetkit_for_elementor_array_get($settings, 'button_text');
    ?>
    <?php
        // include( plugin_dir_path( __FILE__ ) . '../templates/tx-newsletter.php');
        require WK_PATH . '/elements/mailchimp/template/view.php';
        ?>
    <?php
    }
    protected function _content_template()
    {
    }
}
