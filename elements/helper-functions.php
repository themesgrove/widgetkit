<?php

if (!function_exists('widgetkit_for_elementor_array_get')) {
    function widgetkit_for_elementor_array_get($array, $key, $default = null)
    {
        if (!is_array($array)) return $default;
        return array_key_exists($key, $array) ? $array[$key] : $default;
    }
}

add_filter( 'widget_text', 'do_shortcode' );


	// Contact Form 7 plugin
	if ( ! function_exists( 'widgetkit_contact_form_7' ) ) {
		function widgetkit_contact_form_7() {
	        if ( function_exists( 'wpcf7' ) ) {
	            $options = array();

	            $args = array(
	                'post_type'      => 'wpcf7_contact_form',
	                'posts_per_page' => -1,
	            );

	            $contact_forms = get_posts( $args );

	            if ( ! empty( $contact_forms ) && ! is_wp_error( $contact_forms ) ) {

	                $i = 0;

	                foreach ( $contact_forms as $post ) {
	                    if ( 0 === $i ) {
	                        $options[0] = esc_html__( 'Select Contact Form 7', 'widgetkit-for-elementor' );
	                    }
	                    $options[ $post->ID ] = $post->post_title;
	                    $i++;
	                }
	            }
	        } else {
	            $options = array();
	        }

	        return $options;
		}
	}

	// Weforms
    if ( ! function_exists( 'widgetkit_weform' ) ) {
	    function widgetkit_weform(){
	        $wpuf_form_list = get_posts(array(
	            'post_type' => 'wpuf_contact_form',
	            'showposts' => 999,
	        ));

	        $options = array();

	        if (!empty($wpuf_form_list) && !is_wp_error($wpuf_form_list)) {
	            $options[0] = esc_html__('Select weForm', 'widgetkit-for-elementor');
	            foreach ($wpuf_form_list as $post) {
	                $options[$post->ID] = $post->post_title;
	            }
	        } else {
	            $options[0] = esc_html__('Create a Form First', 'widgetkit-for-elementor');
	        }

	        return $options;
	    }
	}

	// WPForms
   if ( ! function_exists( 'widgetkit_wpforms' ) ) {
	    function widgetkit_wpforms(){
	        $options = array();

	        if (class_exists('\WPForms\WPForms')) {
	            $args = array(
	                'post_type' => 'wpforms',
	                'posts_per_page' => -1,
	            );

	            $contact_forms = get_posts($args);

	            if (!empty($contact_forms) && !is_wp_error($contact_forms)) {
	                $options[0] = esc_html__('Select a WPForm', 'widgetkit-for-elementor');
	                foreach ($contact_forms as $post) {
	                    $options[$post->ID] = $post->post_title;
	                }
	            }
	        } else {
	            $options[0] = esc_html__('Create a Form First', 'widgetkit-for-elementor');
	        }

	        return $options;
	    }
	}
