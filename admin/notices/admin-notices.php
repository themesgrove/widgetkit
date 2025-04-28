<?php 

// Ads for ThriveDesk
add_action('admin_notices', 'wk_td_admin_ads');
add_action('admin_init','wk_td_ads_dismiss_notice');

function wk_td_admin_ads()
{
    if (get_option("wk-td-ads-notice")) {
        return;
    }
    
    // Create dismiss URL with nonce
    $dismiss_url = add_query_arg(array(
        'dismissed' => '1',
        'nonce' => wp_create_nonce('wk_td_dismiss_notice')
    ), admin_url('admin.php'));
?>

<div class="wk-td-ads-notice notice notice-success is-dismissible" style="padding: 30px 30px 20px">
    <img style="max-width:200px"
        src="<?php echo esc_attr(plugin_dir_url(__FILE__) . '../assets/images/thrivedesk-logo.png'); ?>">
    <p style="font-size:16px">
        <?php esc_html_e('Your customers deserve better customer support and You deserve the peace of mind.', 'widgetkit-for-elementor');?>
		<a href="<?php echo esc_url('https://www.thrivedesk.com');?>"><strong>Try ThriveDesk</strong></a>
    </p>
    <a href="<?php echo esc_url($dismiss_url); ?>" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></a>
</div>
<?php
}

/**
 * Dismiss the ThriveDesk notice
 */
function wk_td_ads_dismiss_notice(){
    if( isset($_GET['dismissed']) && $_GET['dismissed'] == 1 && 
        isset($_GET['nonce']) && wp_verify_nonce(sanitize_text_field(wp_unslash($_GET['nonce'])), 'wk_td_dismiss_notice')){
        update_option('wk-td-ads-notice', 1);
    }
}