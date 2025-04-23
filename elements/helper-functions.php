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

// wkfe Section subscribe ajax callback function
add_action( 'wp_ajax_wkfe_mailchimp_ajax_form_data_receiver', 'wkfe_mailchimp_ajax_form_data_receiver' );
add_action( 'wp_ajax_nopriv_wkfe_mailchimp_ajax_form_data_receiver', 'wkfe_mailchimp_ajax_form_data_receiver' );

//Subscribe JS File Enqueue
function wkfe_subscribe_core_enqueue(){
	wp_enqueue_script( 'subscribe-main', wkfe_PLUGDIRURI.'js/subscribe.main.js' ,array('jquery'), '1.0', true );
	wp_localize_script(
		'subscribe-main',
		'subscribeajax',
		array(
		'action_url' => admin_url( 'admin-ajax.php' )
		)
	);
}
function wkfe_mailchimp_ajax_form_data_receiver(){
	
	if (
		isset($_POST['widgetkit_mailchimp_nonce']) && 
		wp_verify_nonce(sanitize_text_field(wp_unslash($_POST['widgetkit_mailchimp_nonce'])), 'widgetkit_mailchimp_action') &&
		isset($_POST['fields']) // Also check if 'fields' is set
	) {
		// Unslash and sanitize the fields input before parsing
		$fields_data = sanitize_text_field(wp_unslash($_POST['fields']));
		parse_str($fields_data, $mailchimp_data);
		
		// Now you can safely use $mailchimp_data
		// ... rest of your processing logic ...

	} elseif (isset($_POST['fields'])) { // Check if it's a POST request potentially missing nonce
		// Nonce is invalid or not set, handle the error
		wp_die(esc_html__('Security check failed!', 'widgetkit-for-elementor'));
	}
	
	$apiKey = get_option('wkfe_mailchimp_api_key') ;
	$listid = get_option('wkfe_mailchimp_list_id');
	$email = $mailchimp_data['email'];

	if(empty($email)){
		$err_response = [
			'success' => false,
			'message' => 'Please fill email properly'
		];
		wp_send_json_error($err_response, 400);
		die ();
	}

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
                echo '<div class="alert alert-success" role="alert">'.esc_html__('Thank you, you have been added to our mailing list.', 'widgetkit-for-elementor').'</div>';
            }
        }elseif( $result['status'] == '400' ) {
            echo '<div class="alert alert-danger" role="alert">'.esc_html__('This Email address is already exists.', 'widgetkit-for-elementor').'</div>';
        }else{
            echo '<div class="alert alert-danger" role="alert">'.esc_html__('Sorry something went wrong.', 'widgetkit-for-elementor').'</div>';
        }
    }else{
        echo '<div class="alert alert-danger" role="alert">'.esc_html__('Apikey Or Listid Missing.', 'widgetkit-for-elementor').'</div>';;
    }
    wp_die();       
}

add_action( 'wp_ajax_wkfe_mailchimp_api_keys', 'wkfe_mailchimp_api_keys' );
add_action( 'wp_ajax_nopriv_wkfe_mailchimp_api_keys', 'wkfe_mailchimp_api_keys' );

function wkfe_mailchimp_api_keys(){
	// Check if security nonce is set, unslash, sanitize, and verify it
	if (
		!isset($_REQUEST['security']) || 
		!wp_verify_nonce(sanitize_text_field(wp_unslash($_REQUEST['security'])), 'ajax-security-nonce')
	) {
		wp_send_json_error("No dirty business please", 400);
		return false;
	}

	// Check if fields array and specific keys are set
	if (!isset($_REQUEST['fields']) || !isset($_REQUEST['fields']['apiKey']) || !isset($_REQUEST['fields']['listID'])) {
		wp_send_json_error("Missing required fields", 400);
		return false;
	}

	// Unslash and sanitize API key and List ID
	$mailChimp_api_key = sanitize_text_field(wp_unslash($_REQUEST['fields']['apiKey']));
	$mailChimp_list_id = sanitize_text_field(wp_unslash($_REQUEST['fields']['listID']));
	
	if(empty($mailChimp_api_key) || empty($mailChimp_list_id)){
		wp_send_json_error("Please fill all input properly", 400);
		return false;
	}
	
	update_option( 'wkfe_mailchimp_api_key', $mailChimp_api_key );
	update_option( 'wkfe_mailchimp_list_id', $mailChimp_list_id );
	
	$response = [
		'success' => true,
		'message' => 'All Data Updated'
	];
	
	wp_send_json_success($response, 200 );
}