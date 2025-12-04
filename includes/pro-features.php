<?php
namespace WidgetKit;

if (! defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

class WK_PRO_FEATURES
{
    public static function init()
    {
        $image_elements = [
            [
                'name'    => 'image',
                'section' => 'section_image',
            ],

        ];
        foreach ($image_elements as $element) {
            add_action('elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
                __CLASS__,
                'register_image_animation_controls',
            ], 10, 2);
        }

        $text_elements = [
            [
                'name'    => 'heading',
                'section' => 'section_title',
            ],
            [
                'name'    => 'text-editor',
                'section' => 'section_editor',
            ]
        ];
        foreach ($text_elements as $element) {
            add_action('elementor/element/' . $element['name'] . '/' . $element['section'] . '/after_section_end', [
                __CLASS__,
                'register_text_animation_controls',
            ], 10, 2);
        }
    }

    public static function register_text_animation_controls($element)
    {
        $element->start_controls_section(
            '_section_wk_text_animation',
            [
                'label' => sprintf('<i class="wk-logo"></i> %s <span class="wkpro_text">%s<span>', __('Text Animation', 'animation-addons-for-elementor'), __('WK', 'animation-addons-for-elementor')),
            ]
        );

        $element->add_control(
            'wk_text_animation_upgrade_notice',
            [
                'label' => '',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => wk_get_pro_notice(),
                'content_classes' => 'wkaddon-getpro-clr',
            ]
        );

        $element->end_controls_section();
    }

    public static function register_image_animation_controls($element)
    {

        $element->start_controls_section(
            '_section_wk_image_animation',
            [
                'label' => sprintf('<i class="wk-logo"></i> %s <span class="wkpro_text">%s<span>', __('Image Animation', 'animation-addons-for-elementor'), __('WK', 'animation-addons-for-elementor')),
            ]
        );

        $element->add_control(
            'wk_image_animation_upgrade_notice',
            [
                'label' => '',
                'type' => \Elementor\Controls_Manager::RAW_HTML,
                'raw' => wk_get_pro_notice(),
                'content_classes' => 'wkaddon-getpro-clr',
            ]
        );

        $element->end_controls_section();
    }
}

if (!class_exists('WidgetKit_Pro')) {
    WK_PRO_FEATURES::init();
}
