<?php
use \DrewM\MailChimp\MailChimp; 


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

// bizdrone Section subscribe ajax callback function
add_action( 'wp_ajax_wkfe_mailchimp_ajax_form_data_receiver', 'wkfe_mailchimp_ajax_form_data_receiver' );
add_action( 'wp_ajax_nopriv_wkfe_mailchimp_ajax_form_data_receiver', 'wkfe_mailchimp_ajax_form_data_receiver' );

//Subscribe JS File Enqueue
function bizdrone_subscribe_core_enqueue(){
	wp_enqueue_script( 'subscribe-main', BIZDRONE_PLUGDIRURI.'js/subscribe.main.js' ,array('jquery'), '1.0', true );
	wp_localize_script(
		'subscribe-main',
		'subscribeajax',
		array(
		'action_url' => admin_url( 'admin-ajax.php' )
		)
	);
}
 function wkfe_mailchimp_ajax_form_data_receiver( ){
	if($_POST){
		// parse form data in $mailchimp_data variable
		parse_str($_POST['fields'], $mailchimp_data);
	}
	$apiKey = "5f207f7919cf3cf5ee05dc94b47a9dd7-us15";
	$listid = "4f935ae4b6";
	$email = $mailchimp_data['email'];

	
	
	// echo '<pre>';
	// var_dump($mailchimp_data);
	// echo '</pre>';
	// die();
	   
    if( !empty( $apiKey ) && !empty( $listid )  ){
        $MailChimp = new MailChimp( $apiKey );
        if( !empty( $email ) ){
            $result = $MailChimp->post("lists/{$listid}/members",[
                'email_address'    => esc_attr( $email ),
                'status'        => 'subscribed',
            ]);
        }else{
            $result = $MailChimp->post("lists/{$listid}/members",[
                'email_address'    => esc_attr( $email ),
                'status'        => 'subscribed',
            ]);
        }
        if ($MailChimp->success()) {
            if( $result['status'] == 'subscribed' ){
                echo '<div class="alert alert-success" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'bizdrone').'</div>';
            }
        }elseif( $result['status'] == '400' ) {
            echo '<div class="alert alert-danger" role="alert">'.esc_html__('This Email address is already exists.', 'bizdrone').'</div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">'.esc_html__('Sorry something went wrong.', 'bizdrone').'</div>';
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'bizdrone').'</div>';;
    }
    wp_die();       
 }