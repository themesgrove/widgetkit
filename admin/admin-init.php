<?php

class Widgetkit_Admin
{
    // Widgets keys

    public $widgetkit_elements_keys = [
        'widget-slider-animation',
        'widget-slider-content-animation',
        'widget-slider-box-animation',
        'widget-gallery',
        'widget-portfolio',
        'widget-pricing-single',
        'widget-pricing-icon',
        'widget-pricing-tab',

        'widget-testimonial',

        'widget-testimonial-single',
        'widget-testimonial-center',
        'widget-team',
        'widget-team-overlay',
        'widget-team-verticle-icon',
        'widget-team-round',
        'widget-team-animation',
        'widget-blog-carousel',
        'widget-blog-sidebar',
        'widget-blog-revert',
        'widget-blog-hover-animation',
        'widget-blog-image',
        'widget-countdown',
        'widget-animation-text',
        'widget-content-carousel',
        'widget-button',
        'widget-hover-image',
        'widget-feature-box',
        'widget-social-share-animation',
        'widget-social-share-collapse',
        'widget-post-carousel',
        'wkpro-post-tab',
        'wkpro-post-carousel',
        'wkpro-post-list',
        'wkpro-grid-slider',
        'wkpro-headline-slider',
        'widget-image-compare',
        'widget-tilt-box',
        'widget-contact-form',
        'widget-pros-cons',
        'widget-click-tweet'
    ];

    public $widgetkit_woo_keys = [
        'wke-woo-product',
        'wke-woo-product-carousel',
        'wke-woo-categories',
        'wke-woo-recent-product',
    ];

    public $widgetkit_ld_keys = [
        'wke-ld-course-list',
        'wke-ld-course-tab',
    ];

    public $widgetkit_lp_keys = [
        'wke-lp-course-list',
        'wke-lp-course-tab',
    ];
    
    public $widgetkit_sensei_keys = [
        'wke-sensei-course-list',
        'wke-sensei-course-tab',
    ];
    private $pro_enable_status;
    
    // Default settings
    private $widgetkit_default_settings;
    private $widgetkit_woo_settings;
    private $widgetkit_ld_settings;
    private $widgetkit_lp_settings;
    private $widgetkit_sensei_settings;
    // widgetkit settings
    private $widgetkit_settings;
    private $wk_woo_settings;
    private $wk_ld_settings;
    private $wk_lp_settings;
    private $wk_sensei_settings;
    // widgetkit get settings
    private $widgetkit_get_settings;
    private $widgetkit_get_woo_settings;
    private $widgetkit_get_ld_settings;
    private $widgetkit_get_lp_settings;
    private $widgetkit_get_sensei_settings;

    /**
     * Register construct
     */
    private $api_url = 'https://widgetkit.themesgrove.com/wp-json/wk/changelog';
    public function __construct()
    {
        //$this->includes();
        session_start();
        $this->init_hooks();
    }
    
    /**
     * Register a custom opitons.
     */
	public function widgetkit_for_elementor_admin_options(){
	    add_menu_page( 
	        'Admin Menu',
            __( 'WidgetKit', 'widgetkit-for-elementor' ),
	        'manage_options',
	        'widgetkit-settings',
	        array($this, 'display_settings_pages'),
	        plugins_url('/assets/images/wk-icon-white.svg', __FILE__ ), 55
        ); 
        if(!apply_filters('wkpro_enabled', false)):
        add_submenu_page( 
            'widgetkit-settings', 
            '', 
            '<span class="dashicons dashicons-star-filled" style="color:#f44336; font-size: 17px"></span> ' . __( 'Go Pro', 'widgetkit-for-elementor' ) ,
            'manage_options', 
            'widgetkit-gopro', 
            array($this, 'handle_external_redirects')
        );
        endif;
    }

    /**
     * Register all hooks
     */
    public function init_hooks()
    {
        // Build admin main menu
        add_action('admin_menu', [$this, 'widgetkit_for_elementor_admin_options']);
        // Build admin notice
        //add_action('admin_notices', array($this, 'switch_lite_welcome_admin_notice'));

        // Build admin script
        add_action('admin_enqueue_scripts', [$this, 'widgetkit_for_elementor_admin_page_scripts']);

        // Param check
        add_action('admin_init', [$this, 'widgetkit_for_elementor_admin_get_param_check']);
        // Build admin view and save
        add_action('wp_ajax_widgetkit_save_admin_addons_settings', [$this, 'widgetkit_for_elementor_sections_with_ajax']);
    }

    /**
     * Register scripts
     */
    public function widgetkit_for_elementor_admin_page_scripts () {
        wp_enqueue_style( 'widgetkit-admin',  WK_URL.'/dist/css/wk-dashboard.css', array(), WK_VERSION, '' );
        // wp_enqueue_style( 'widgetkit-sweetalert2-css', plugins_url('/assets/css/sweetalert2.min.css', __FILE__ ));
        
        wp_enqueue_script('widgetkit-elementor-admin-js', plugins_url('/assets/js/admin.js', __FILE__) , array('jquery','jquery-ui-tabs'), '1.0' , true );
        wp_enqueue_script( 'widgetkit-sweet-js',  plugins_url('/assets/js/core.js', __FILE__), array( 'jquery' ), '1.0', true );
		// wp_enqueue_script( 'widgetkit-sweetalert2-js', plugins_url('/assets/js/sweetalert2.min.js', __FILE__), array( 'jquery', 'widgetkit-sweet-js' ), '1.0', true );
        wp_enqueue_script( 'admin-notice-js', plugins_url('/assets/js/admin-notice.js', __FILE__), array( 'jquery' ), '1.0', true );
       /**
        * Load uikit only inside widgetkit setting page
        */
        global $wp;  
        $current_url = add_query_arg(array($_GET), $wp->request);
        $current_url_slug = explode("=", $current_url);
        if($current_url && $current_url_slug[1] === 'widgetkit-settings' ){
            wp_enqueue_style( 'wkkit',  plugins_url('/dist/css/uikit.custom.min.css', dirname(__FILE__)  ));
            wp_enqueue_style( 'widgetkit-sweetalert2-css', plugins_url('/assets/css/sweetalert2.min.css', __FILE__ ));

            wp_enqueue_script( 'wkkit',  plugins_url('/dist/js/uikit.min.js', dirname(__FILE__)  ));
            wp_enqueue_script( 'wkkit-icon',  plugins_url('/dist/js/uikit-icons.min.js', dirname(__FILE__)  ));
            wp_enqueue_script( 'widgetkit-sweetalert2-js', plugins_url('/assets/js/sweetalert2.min.js', __FILE__), array( 'jquery', 'widgetkit-sweet-js' ), '1.0', true );
        }
    }

    public function widgetkit_for_elementor_admin_get_param_check()
    {
        if (isset($_GET['dismissed']) && $_GET['dismissed'] == 1) {
            update_option('notice_dissmissed', 1);
        }
        $this->handle_external_redirects();
    }

    public function handle_external_redirects()
    {
        if (empty($_GET['page'])) {
            return;
        }
        if ('widgetkit-gopro' === $_GET['page']) {
            wp_redirect('https://themesgrove.com/widgetkit-for-elementor/?utm_source=wp-menu&utm_campaign=widgetkit_gopro&utm_medium=wp-dash');
            exit;
        }
    }

    /**
     * Register display view
     */
    public function display_settings_pages()
    {
        $js_info = [
            'ajaxurl' => admin_url('admin-ajax.php')
        ];
        wp_localize_script('widgetkit-elementor-admin-js', 'settings', $js_info);

        $this->pro_enable_status = apply_filters('wkpro_enabled', false);
       
	    $this->widgetkit_default_settings = array_fill_keys( $this->widgetkit_elements_keys, true );
        $this->widgetkit_woo_settings = array_fill_keys( $this->widgetkit_woo_keys, true );
        $this->widgetkit_ld_settings = array_fill_keys( $this->widgetkit_ld_keys, true );
        $this->widgetkit_lp_settings = array_fill_keys( $this->widgetkit_lp_keys, true );
        $this->widgetkit_sensei_settings = array_fill_keys( $this->widgetkit_sensei_keys, true );
       
	    $this->widgetkit_get_settings = get_option( 'widgetkit_save_settings', $this->widgetkit_default_settings );
        $this->widgetkit_get_woo_settings = get_option( 'widgetkit_save_woo_settings', $this->widgetkit_woo_settings );
        $this->widgetkit_get_ld_settings = get_option( 'widgetkit_save_ld_settings', $this->widgetkit_ld_settings );
        $this->widgetkit_get_lp_settings = get_option( 'widgetkit_save_lp_settings', $this->widgetkit_lp_settings );
        $this->widgetkit_get_sensei_settings = get_option( 'widgetkit_save_sensei_settings', $this->widgetkit_sensei_settings );
        
        /**
         * Check if found any difference between db and local key
         */
	    $widgetkit_new_settings = array_diff_key( $this->widgetkit_default_settings, $this->widgetkit_get_settings );
	    $widgetkit_new_woo_settings = array_diff_key( $this->widgetkit_woo_settings, $this->widgetkit_get_woo_settings );
	    $widgetkit_new_ld_settings = array_diff_key( $this->widgetkit_ld_settings, $this->widgetkit_get_ld_settings );
	    $widgetkit_new_lp_settings = array_diff_key( $this->widgetkit_lp_settings, $this->widgetkit_get_lp_settings );
        $widgetkit_new_sensei_settings = array_diff_key( $this->widgetkit_sensei_settings, $this->widgetkit_get_sensei_settings );
        
        /**
         * If any difference found then update the db
         */
        if( ! empty( $widgetkit_new_settings ) ) {
            $widgetkit_updated_settings = array_merge( $this->widgetkit_get_settings, $widgetkit_new_settings );
            update_option( 'widgetkit_save_settings', $widgetkit_updated_settings );
        }
        if( ! empty( $widgetkit_new_woo_settings ) ) {
            $widgetkit_updated_woo_settings = array_merge( $this->widgetkit_get_woo_settings, $widgetkit_new_woo_settings );
            update_option( 'widgetkit_save_woo_settings', $widgetkit_updated_woo_settings );
        }
        if( ! empty( $widgetkit_new_ld_settings ) ) {
            $widgetkit_updated_ld_settings = array_merge( $this->widgetkit_get_ld_settings, $widgetkit_new_ld_settings );
            update_option( 'widgetkit_save_ld_settings', $widgetkit_updated_ld_settings );
        }
        if( ! empty( $widgetkit_new_lp_settings ) ) {
            $widgetkit_updated_lp_settings = array_merge( $this->widgetkit_get_lp_settings, $widgetkit_new_lp_settings );
            update_option( 'widgetkit_save_lp_settings', $widgetkit_updated_lp_settings );
        }
        if( ! empty( $widgetkit_new_sensei_settings ) ) {
            $widgetkit_updated_sensei_settings = array_merge( $this->widgetkit_get_sensei_settings, $widgetkit_new_sensei_settings );
            update_option( 'widgetkit_save_sensei_settings', $widgetkit_updated_sensei_settings );
        }

        $this->widgetkit_get_settings = get_option( 'widgetkit_save_settings', $this->widgetkit_default_settings );
        $this->widgetkit_get_woo_settings = get_option( 'widgetkit_save_woo_settings', $this->widgetkit_woo_settings );
        $this->widgetkit_get_ld_settings = get_option( 'widgetkit_save_ld_settings', $this->widgetkit_ld_settings );
        $this->widgetkit_get_lp_settings = get_option( 'widgetkit_save_lp_settings', $this->widgetkit_lp_settings );
        $this->widgetkit_get_sensei_settings = get_option( 'widgetkit_save_sensei_settings', $this->widgetkit_sensei_settings );

?>


    <div class="wrap wk-dashboard-wrapper">
        <div class="response-wrap"></div>
        <form action="" method="POST" id="widgetkit-settings" name="widgetkit-settings">
            <div class="wk-container">
                <div class="wk-header wk-padding-small wk-card wk-card-default wk-margin-medium-top">
                    <div class="wk-header__top wk-margin-small-bottom">
                        <div class="wk-text-center wk-padding-small">
                            <img src="<?php echo plugins_url('/assets/images/logo-t.svg', __FILE__)?>" width="200" wk-svg>
                        </div>
                    </div>
                    <div class="wk-navbar wk-margin-small-top" wk-grid>
                        <div class="wk-width-expand">
                            <ul class="wk-tab-bottom wk-margin-remove-bottom" wk-tab="connect: #wk-options; animation: wk-animation-slide-left-small, wk-animation-slide-right-small">
                                <li><a href="#"><span class="wk-icon wk-margin-small-right" wk-icon="home"></span> Overview</a></li>
                                <li><a href="#"><span class="wk-icon wk-margin-small-right" wk-icon="thumbnails"></span> Elements</a></li>
                                <li><a href="#"><span class="wk-icon wk-margin-small-right" wk-icon="bolt"></span>Pro Integration</a></li>
                                <!-- <li><a href="#"><span class="wk-icon wk-margin-small-right" wk-icon="info"></span> Info</a></li>-->
                                <?php if (!apply_filters('wkpro_enabled', false)) :?>
                                    <li><a class="wk-text-danger" href="#"><span class="wk-icon wk-margin-small-right" wk-icon="star"></span> Pro Features</a></li>
                                <?php endif;?>
                                <li><a href="#"><span class="wk-icon wk-margin-small-right" wk-icon="file-text"></span>Changelog</a></li>

                            </ul>
                        </div>
                        <div class="wk-width-1-5 wk-text-right">
                            <button type="submit" class="wk-button wk-button-danger widgetkit-save-button wk-flex wk-flex-right">Save Settings</button>
                        </div>
                    </div>
                </div>

                <div class="wk-main wk-margin wk-padding-small wk-background-default">
                    <div class="wk-grid">
                        <?php if (!apply_filters('wkpro_enabled', false)) :?>
                        <div class="wk-width-3-4">
                        <?php else: ?>
                        <div class="wk-width-1-1">
                        <?php endif; ?>
                            <div class="wk-card-small">
                                <ul id="wk-options" class="wk-switcher">
                                    <!-- overview -->
                                    <li>
                                        <div class="wk-grid wk-child-width-1-3 wk-grid-match" wk-grid>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-body">
                                                    <h3 class="wk-card-title wk-margin-remove-top">Documentation</h3>
                                                    <p>It’s highly recommended to check out documentation and FAQ before using this plugin. <a class="wk-alert-primary" target="_blank" href="https://themesgrove.com/support/"><code class="wk-alert-primary">Click Here</code></a> for more details.</p>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-secondary wk-card-body">
                                                    <h3 class="wk-card-title wk-margin-remove-top"><?php echo  __( 'Need Any Help?');?></h3>
                                                    <p>If you need help just shoot us an email <code>help@themesgrove.com</code>.</p>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-body">
                                                    <h3 class="wk-card-title wk-margin-remove-top"><?php echo  __( 'Social Community');?></h3>
                                                    <p>Feel free to join us in our <a target="_blank" href="https://www.facebook.com/groups/widgetkitcommunity/"><code class="wk-alert-primary">Official Facebook Group</code></a> for discussion, support and chill.
                                                </div>
                                            </div>
                                            <div class="wk-width-1-1">
                                                <div class="wk-card wk-card-primary wk-card-body">
                                                    <h3 class="wk-card-title wk-margin-remove-top"><?php echo  __( 'Show your Love?');?></h3>
                                                    <p>We love to have you in Themesgrove family. We are making WidgetKit more awesome everyday. Take your 2 minutes to review the plugin and spread the love to encourage us to keep it going.</p>
                                                    <a href="https://wordpress.org/support/plugin/widgetkit-for-elementor/reviews/" target="_blank" class="wk-button wk-button-default"><span class="wk-margin-small-right" wk-icon="icon: heart"></span> Leave a Review</a>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </li>
                                    <!-- Elements -->
                                    <li>
                                        <div class="wk-grid wk-grid-small wk-child-width-1-3" wk-grid>

                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Animated Headline', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-animation-text" name="widget-animation-text" <?php checked(1, $this->widgetkit_get_settings['widget-animation-text'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Blog Carousel', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-blog-carousel" name="widget-blog-carousel" <?php checked(1, $this->widgetkit_get_settings['widget-blog-carousel'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Blog Image', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-blog-image" name="widget-blog-image" <?php checked(1, $this->widgetkit_get_settings['widget-blog-image'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Button + Modal', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-button" name="widget-button" <?php checked(1, $this->widgetkit_get_settings['widget-button'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Blog Hover Animation', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-blog-hover-animation" name="widget-blog-hover-animation" <?php checked(1, $this->widgetkit_get_settings['widget-blog-hover-animation'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Click Tweet', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-click-tweet" name="widget-click-tweet" <?php checked(1, $this->widgetkit_get_settings['widget-click-tweet'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Contact Form', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-contact-form" name="widget-contact-form" <?php checked(1, $this->widgetkit_get_settings['widget-contact-form'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Content Carousel', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-content-carousel" name="widget-content-carousel" <?php checked(1, $this->widgetkit_get_settings['widget-content-carousel'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Countdown', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-countdown" name="widget-countdown" <?php checked(1, $this->widgetkit_get_settings['widget-countdown'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Filterable Portfolio', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-portfolio" name="widget-portfolio" <?php checked(1, $this->widgetkit_get_settings['widget-portfolio'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Gallery', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-gallery" name="widget-gallery" <?php checked(1, $this->widgetkit_get_settings['widget-gallery'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>                                            
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Hover Image', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-hover-image" name="widget-hover-image" <?php checked(1, $this->widgetkit_get_settings['widget-hover-image'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Info Box', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-feature-box" name="widget-feature-box" <?php checked(1, $this->widgetkit_get_settings['widget-feature-box'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Image Compare', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-image-compare" name="widget-image-compare" <?php checked(1, $this->widgetkit_get_settings['widget-image-compare'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo __('Pricing Single', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-pricing-single" name="widget-pricing-single" <?php checked(1, $this->widgetkit_get_settings['widget-pricing-single'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Pricing Icon', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-pricing-icon" name="widget-pricing-icon" <?php checked(1, $this->widgetkit_get_settings['widget-pricing-icon'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Pricing Tabs', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-pricing-tab" name="widget-pricing-tab" <?php checked(1, $this->widgetkit_get_settings['widget-pricing-tab'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            
                                            

                                            <!-- pro -->
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <span>
                                                        <?php echo esc_html__('Post Tab', 'widgetkit-for-elementor'); ?>
                                                        <span class="pro-text">
                                                            <?php echo esc_html__('Pro', 'widgetkit-for-elementor'); ?>
                                                        </span>
                                                    </span>
                                                    
                                                    <label class="switch <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                        <input type="checkbox" id="wkpro-post-tab" name="wkpro-post-tab" <?php checked(1, $this->widgetkit_get_settings['wkpro-post-tab'], $this->pro_enable_status) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- pro -->
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <span>
                                                        <?php echo esc_html__('Post Carousel', 'widgetkit-for-elementor'); ?>
                                                        <span class="pro-text">
                                                            <?php echo esc_html__('Pro', 'widgetkit-for-elementor'); ?>
                                                        </span>
                                                    </span>
                                                    
                                                    <label class="switch <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                        <input type="checkbox" id="wkpro-post-carousel" name="wkpro-post-carousel" <?php checked(1, $this->widgetkit_get_settings['wkpro-post-carousel'], $this->pro_enable_status) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- pro -->
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <span>
                                                        <?php echo esc_html__('Post List', 'widgetkit-for-elementor'); ?>
                                                        <span class="pro-text">
                                                            <?php echo esc_html__('Pro', 'widgetkit-for-elementor'); ?>
                                                        </span>
                                                    </span>
                                                    
                                                    <label class="switch <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                        <input type="checkbox" id="wkpro-post-list" name="wkpro-post-list" <?php checked(1, $this->widgetkit_get_settings['wkpro-post-list'], $this->pro_enable_status) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- pro -->
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <span>
                                                        <?php echo esc_html__('Post Grid Slider', 'widgetkit-for-elementor'); ?>
                                                        <span class="pro-text">
                                                            <?php echo esc_html__('Pro', 'widgetkit-for-elementor'); ?>
                                                        </span>
                                                    </span>
                                                
                                                    <label class="switch <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                        <input type="checkbox" id="wkpro-grid-slider" name="wkpro-grid-slider" <?php checked(1, $this->widgetkit_get_settings['wkpro-grid-slider'], $this->pro_enable_status) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <!-- pro -->
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <span>
                                                        <?php echo esc_html__('Post Headline Slider', 'widgetkit-for-elementor'); ?>    
                                                        <span class="pro-text">
                                                            <?php echo esc_html__('Pro', 'widgetkit-for-elementor'); ?>
                                                        </span>
                                                    </span>
                                                    
                                                    <label class="switch <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                        <input type="checkbox" id="wkpro-headline-slider" name="wkpro-headline-slider" <?php checked(1, $this->widgetkit_get_settings['wkpro-headline-slider'], $this->pro_enable_status) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div> 
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Pros & Cons', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-pros-cons" name="widget-pros-cons" <?php checked(1, $this->widgetkit_get_settings['widget-pros-cons'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo __('Slider Animation', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-slider-animation" name="widget-slider-animation" <?php checked(1, $this->widgetkit_get_settings['widget-slider-animation'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                    <!-- <div class="wk-position-top-left wk-label">Pro</div> -->
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Slider Content Animation', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-slider-content-animation" name="widget-slider-content-animation" <?php checked(1, $this->widgetkit_get_settings['widget-slider-content-animation'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Slider Box Animation', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-slider-box-animation" name="widget-slider-box-animation" <?php checked(1, $this->widgetkit_get_settings['widget-slider-box-animation'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Social Share Animation', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-social-share-animation" name="widget-social-share-animation" <?php checked(1, $this->widgetkit_get_settings['widget-social-share-animation'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Social Share Collapse', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-social-share-collapse" name="widget-social-share-collapse" <?php checked(1, $this->widgetkit_get_settings['widget-social-share-collapse'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Testimonial', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-testimonial" name="widget-testimonial" <?php checked(1, $this->widgetkit_get_settings['widget-testimonial'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Team', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-team" name="widget-team" <?php checked(1, $this->widgetkit_get_settings['widget-team'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Tilt Box', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-tilt-box" name="widget-tilt-box" <?php checked(1, $this->widgetkit_get_settings['widget-tilt-box'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>


                                            

                                            

                                            
                            
                                            
                                            <div class="wk-width-1-1">
                                                <h3>Legacy Widgets</h3>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Blog Sidebar', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-blog-sidebar" name="widget-blog-sidebar" <?php checked(1, $this->widgetkit_get_settings['widget-blog-sidebar'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Blog Revert', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-blog-revert" name="widget-blog-revert" <?php checked(1, $this->widgetkit_get_settings['widget-blog-revert'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Post Carousel', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-post-carousel" name="widget-post-carousel" <?php checked(1, $this->widgetkit_get_settings['widget-post-carousel'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Team Overlay', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-team-overlay" name="widget-team-overlay" <?php checked(1, $this->widgetkit_get_settings['widget-team-overlay'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Team Animation', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-team-animation" name="widget-team-animation" <?php checked(1, $this->widgetkit_get_settings['widget-team-animation'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Team Round', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-team-round" name="widget-team-round" <?php checked(1, $this->widgetkit_get_settings['widget-team-round'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Team Verticle Icon', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-team-verticle-icon" name="widget-team-verticle-icon" <?php checked(1, $this->widgetkit_get_settings['widget-team-verticle-icon'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Testimonial Single', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-testimonial-single" name="widget-testimonial-single" <?php checked(1, $this->widgetkit_get_settings['widget-testimonial-single'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                    <?php echo esc_html__('Testimonial Center', 'widgetkit-for-elementor'); ?>
                                                    <label class="switch">
                                                        <input type="checkbox" id="widget-testimonial-center" name="widget-testimonial-center" <?php checked(1, $this->widgetkit_get_settings['widget-testimonial-center'], true) ?>>
                                                        <span class="rectangle round"></span>
                                                    </label>
                                                </div>
                                            </div>

                                        </div>

                                    </li>
                                    <!-- pro integration -->
                                    <li class="pro-integrated-plugins-data">
                                        <div class="wk-pro-integrated-plugin">
                                            <!-- WooCommerce -->
                                            <div class="wk-padding-small wk-background-muted">
                                                <div class="" wk-grid>
                                                    <div class="wk-width-auto@m wk-card-media-left wk-cover-container">
                                                        <img src="<?php echo plugins_url('/assets/images/woocommerce-logo.svg', __FILE__)?>" width="100">
                                                    </div>
                                                    <div class="wk-width-expand@m">
                                                        <div class="wk-card-body wk-padding-remove">
                                                            <div class="wk-flex wk-flex-between wk-flex-middle wk-margin-small-bottom">
                                                                <h3 class="wk-card-title wk-margin-remove-top wk-margin-remove-bottom"><?php esc_html_e('WooCommerce', 'widgetkit-for-elementor')?></h3>
                                                                <a class="demo-button-for-pro wk-button-primary" href="https://widgetkit.themesgrove.com/#pro-element" target="_blank"><?php esc_html_e('Demo', 'widgetkit-for-elementor');?></a>
                                                                <!-- <?php //if (!apply_filters('wkpro_enabled', false)): ?>
                                                                    <span class="wk-label">Pro</span>
                                                                <?php //else:?>
                                                                    <label class="switch">
                                                                        <input type="checkbox" id="widgetkit-pro-woocommerce" name="widgetkit-pro-woocommerce" <?php //checked(1, 'widgetkit-pro-woocommerce', true) ?>>
                                                                        <span class="rectangle round"></span>
                                                                    </label>
                                                                <?php //endif; ?> -->
                                                            </div>
                                                            <p><?php esc_html_e('Build your shop quickly with our powerful WooCommerce Elements.', 'widgetkit-for-elementor');?></p>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="woo-elements">
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('Woo Products', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?> <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-woo-product" name="wke-woo-product" <?php checked(1, $this->widgetkit_get_woo_settings['wke-woo-product'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('Woo Product Carousel', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-woo-product-carousel" name="wke-woo-product-carousel" <?php checked(1, $this->widgetkit_get_woo_settings['wke-woo-product-carousel'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('Woo Categories', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-woo-categories" name="wke-woo-categories" <?php checked(1, $this->widgetkit_get_woo_settings['wke-woo-categories'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('Woo Recent Product', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-woo-recent-product" name="wke-woo-recent-product" <?php checked(1, $this->widgetkit_get_woo_settings['wke-woo-recent-product'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- LearnDash -->
                                            <div class="wk-padding-small wk-background-muted">
                                                <div class="" wk-grid>
                                                    <div class="wk-width-auto@m wk-card-media-left wk-cover-container">
                                                        <img src="<?php echo plugins_url('/assets/images/learndash-logo.png', __FILE__)?>" width="100">
                                                    </div>
                                                    <div class="wk-width-expand@m">
                                                        <div class="wk-card-body wk-padding-remove">
                                                            <div class="wk-flex wk-flex-between wk-flex-middle wk-margin-small-bottom">
                                                                <h3 class="wk-card-title wk-margin-remove-top wk-margin-remove-bottom"><?php esc_html_e('LearnDash', 'widgetkit-for-elementor')?></h3>
                                                                <a class="demo-button-for-pro wk-button-primary" href="https://widgetkit.themesgrove.com/#pro-element" target="_blank"><?php esc_html_e('Demo', 'widgetkit-for-elementor');?></a>
                                                            </div>
                                                            <p><?php esc_html_e('Our learndash elments helps you to create your course landing page more smoothly.', 'widgetkit-for-elementor');?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="woo-elements">
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('LearnDash Course List', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-ld-course-list" name="wke-ld-course-list" <?php checked(1, $this->widgetkit_get_ld_settings['wke-ld-course-list'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('LearnDash Course Tab', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-ld-course-tab" name="wke-ld-course-tab" <?php checked(1, $this->widgetkit_get_ld_settings['wke-ld-course-tab'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- LearnPress -->
                                            <div class="wk-padding-small wk-background-muted">
                                                <div class="" wk-grid>
                                                    <div class="wk-width-auto@m wk-card-media-left wk-cover-container">
                                                        <img src="<?php echo plugins_url('/assets/images/learnpress-logo.png', __FILE__)?>" width="100">
                                                    </div>
                                                    <div class="wk-width-expand@m">
                                                        <div class="wk-card-body wk-padding-remove">
                                                            <div class="wk-flex wk-flex-between wk-flex-middle wk-margin-small-bottom">
                                                                <h3 class="wk-card-title wk-margin-remove-top wk-margin-remove-bottom"><?php esc_html_e('LearnPress', 'widgetkit-for-elementor')?></h3>
                                                                <a class="demo-button-for-pro wk-button-primary" href="https://widgetkit.themesgrove.com/#pro-element" target="_blank"><?php esc_html_e('Demo', 'widgetkit-for-elementor');?></a>
                                                            </div>
                                                            <p><?php esc_html_e('Our more customizable learnpress elements lets you to build your site more quickly.', 'widgetkit-for-elementor');?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="woo-elements">
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('LearnPress Course List', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-lp-course-list" name="wke-lp-course-list" <?php checked(1, $this->widgetkit_get_lp_settings['wke-lp-course-list'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('LearnPress Course Tab', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-lp-course-tab" name="wke-lp-course-tab" <?php checked(1, $this->widgetkit_get_lp_settings['wke-lp-course-tab'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Sensei -->
                                            <div class="wk-padding-small wk-background-muted">
                                                <div class="" wk-grid>
                                                    <div class="wk-width-auto@m wk-card-media-left wk-cover-container">
                                                        <img src="<?php echo plugins_url('/assets/images/sensei-logo.png', __FILE__)?>" width="100">
                                                    </div>
                                                    <div class="wk-width-expand@m">
                                                        <div class="wk-card-body wk-padding-remove">
                                                            <div class="wk-flex wk-flex-between wk-flex-middle wk-margin-small-bottom">
                                                                <h3 class="wk-card-title wk-margin-remove-top wk-margin-remove-bottom"><?php esc_html_e('Sensei', 'widgetkit-for-elementor')?></h3>
                                                                <a class="demo-button-for-pro wk-button-primary" href="https://widgetkit.themesgrove.com/#pro-element" target="_blank"><?php esc_html_e('Demo', 'widgetkit-for-elementor');?></a>
                                                            </div>
                                                            <p><?php esc_html_e('We are working hard to bring some niche elements which are integrated with Sensei.', 'widgetkit-for-elementor');?></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="woo-elements">
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        <?php echo __('Sensei Course List', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-sensei-course-list" name="wke-sensei-course-list" <?php checked(1, $this->widgetkit_get_sensei_settings['wke-sensei-course-list'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                    <div class="wk-card wk-background-default wk-card-body wk-card-small wk-flex wk-flex-between wk-flex-middle">
                                                        
                                                        <?php echo __('Sensei Course Tab', 'widgetkit-for-elementor'); ?>
                                                        <label class="switch  <?php echo !$this->pro_enable_status ? 'disable' : ''; ?>">
                                                            <input type="checkbox" id="wke-sensei-course-tab" name="wke-sensei-course-tab" <?php checked(1, $this->widgetkit_get_sensei_settings['wke-sensei-course-tab'], $this->pro_enable_status) ?>>
                                                            <span class="rectangle round"></span>
                                                        </label>
                                                    </div>
                                                    
                                                </div>
                                            </div>
                                            
                                        </div>
                                    </li>
                                    <!-- pro panel for free -->
                                    <?php if (!apply_filters('wkpro_enabled', false)) :?>
                                    <li>
                                        <div class="wk-card wk-card-default wk-grid-collapse wk-child-width-1-2@s wk-margin" wk-grid>
                                            <div class="wk-card-media-left wk-cover-container">
                                                <img src="https://themesgrove.com/wp-content/uploads/2018/12/wigetkit-banner-bg.png" alt="" wk-cover>
                                                <canvas width="100" height="120"></canvas>
                                            </div>
                                            <div>
                                                <div class="wk-card-body">
                                                    <h3 class="wk-card-title">Upgrade to WidgetKit Pro!</h3>
                                                    <p>Seems to be convinced, You need more to empower your Elementor capabilities.</p>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="wk-text-center wk-h2"><?php echo esc_html__('Awesome Post Widgets','widgetkit-for-elementor');?></h3>
                                        <div class="wk-child-width-1-3@m wk-grid-match" wk-grid>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/post-grid-slider.jpg', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Ajax based grid slider</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/post-tabs.jpg', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Posts tab with ajax</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/post-smart-list.jpg', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Smart list widget</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="wk-text-center wk-h2"><?php echo esc_html__('Premium WooCommerce Widgets','widgetkit-for-elementor');?></h3>
                                        <div class="wk-child-width-1-3@m wk-grid-match" wk-grid>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/woo-smart-products.jpg', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Woo smart products</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/woo-smart-cat.jpg', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Woo smart categories</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/woo-ajax-cart.jpg', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Ajax add to cart</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="wk-text-center wk-h2"><?php echo esc_html__('LearnDash Widgets','widgetkit-for-elementor');?></h3>
                                        <div class="wk-child-width-1-3@m wk-grid-match" wk-grid>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/ld1.png', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Course List Style</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/ld2.png', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Course Tab Style</h4>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                                                    <img width="100%" src="<?php echo plugins_url('/assets/images/premium/ld3.png', __FILE__)?>" alt="">
                                                    <h4 class="wk-margin-small-top wk-text-light">Course Carousel Style</h4>
                                                </div>
                                            </div>
                                            <div class="wk-width-1-1 wk-text-center">
                                                <div><a href="https://themesgrove.com/widgetkit-for-elementor/?utm_campaign=widgetkit-pro&utm_medium=wp-admin&utm_source=pro-feature-button" target="_blank" class="wk-button wk-button-primary">And Many More <span wk-icon="icon: arrow-right"></span></a></div>
                                            </div>
                                        </div>
                                    </li>
                                    <?php endif;?>
                                    <!-- change log -->
                                    <li class="wk-changelog">
                                        <!-- WooCommerce -->
                                        <div class="wk-padding-remove">

                                            <?php 
                                            $Parsedown = new Parsedown();
                                            $get_changelog_data = $this->widgetkit_get_changelog_data();
                                            $changelog_data = $get_changelog_data ? $get_changelog_data : $_SESSION['changes'];
                                            ?>

                                            <div class="wk-changelog-list">
                                                <div class="wk-changes">
                                                    <ul class="version version-2.2.0 wk-background-muted wk-padding-small wk-margin-small-bottom">
                                                        <li class="release-version-date"><h4>2.2.1</h4><span>09-01-2020</span></li>
                                                        <li><span class="wk-text-success">New </span> – Changelog Tab added in Dashboard</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Demo link updated in dashboard</li>
                                                    </ul>
                                                    <ul class="version version-2.2.0 wk-background-muted wk-padding-small wk-margin-small-bottom">
                                                        <li class="release-version-date"><h4>2.2.0</h4><span>17-12-2019</span></li>
                                                        <li><span class="wk-text-success">New </span> – Tilt Box Element</li>
                                                        <li><span class="wk-text-success">New </span> – Image Compare Element</li>
                                                        <li><span class="wk-text-success">New </span> – Contact Form Element</li>
                                                        <li><span class="wk-text-bugfix">Bug Fix </span> – Element disable enable issue in Widgetkit Dashboard</li>
                                                        <li><span class="wk-text-bugfix">Bug Fix </span> – Conflict with weDocs plugin</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Animation Headline element spacing</li>
                                                    </ul>
                                                    <ul class="version version-2.1.1 wk-background-muted wk-padding-small wk-margin-small-bottom">
                                                        <li class="release-version-date"><h4>2.1.1</h4><span>28-11-2019</span></li>
                                                        <li><span class="wk-text-improved">Improved </span> – 1 new layout options for the Gallery element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Added discount option to Pricing Single element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Responsive update to Testimonial element</li>
                                                    </ul>
                                                    <ul class="version version-2.1.0 wk-background-muted wk-padding-small wk-margin-small-bottom">
                                                        <li class="release-version-date"><h4>2.1.0</h4><span>21-11-2019</span></li>
                                                        <li><span class="wk-text-success">New </span> – Gallery Element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Pros & Cons Element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Filterable Portfolio elementt</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Pricing Single element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Team element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Feature Icon box elementt</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Hover Image element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Slider Animation element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Blog Carousel element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Blog Image element</li>
                                                    </ul>
                                                    <ul class="version version-2.0 wk-background-muted wk-padding-small wk-margin-small-bottom">
                                                        <li class="release-version-date"><h4>2.0</h4><span>20-11-2019</span></li>
                                                        <li><span class="wk-text-success">New </span> – Content Carousel element</li>
                                                        <li><span class="wk-text-success">New </span> – Team element</li>
                                                        <li><span class="wk-text-success">New </span> – Testimonial element</li>
                                                        <li><span class="wk-text-bugfix">Bug Fix </span> – WooCommerce Integration error</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Dashboard</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Pricing Element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Button + Modal Element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Pros & Const Element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Slider Element</li>
                                                        <li><span class="wk-text-improved">Improved </span> – Portfolio Element</li>
                                                    </ul>
                                                </div>
                                                <div class="wkp-changes wk-background-muted wk-pro-changelog">
                                                    <h3 class="wkp-headline">WidgetKit Pro</h3>

                                                    <?php foreach($changelog_data as $data): ?>
                                                        <div class="version version-<?php echo $data['plugin_version'];?> wk-background-muted wk-padding-small wk-margin-small-bottom">
                                                            <div class="release-version-date"> 
                                                                <h4><?php echo $data['plugin_version']; ?> </h4>
                                                                <span> <?php echo $data['publish_date'] ?>  </span>
                                                            </div>
                                                            <?php echo $Parsedown->text($data['plugin_changelog']); ?>
                                                        </div>
                                                    <?php endforeach; ?>

                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    
                                </ul>
                            </div>
                        </div>
                        
                        <?php if (!apply_filters('wkpro_enabled', false)) :?>
                        <div class="wk-width-1-4 pro-sidebar">
                            <div wk-sticky="offset: 40">
                                <div class="wk-card wk-card-default wk-card-body  wk-background-small wk-text-center">
                                    <img class="wk-margin-small-top" src="<?php echo plugins_url('/assets/images/widgetkit-pro.svg', __FILE__)?>" width="150" wk-svg>
                                    <p class="wk-text-muted">Get the pro version of <strong>WidgetKit</strong> for more stunning elements and customization options.</p>
                                    <a href="https://themesgrove.com/widgetkit-for-elementor/?utm_campaign=widgetkit-pro&utm_medium=wp-admin&utm_source=pro-feature-button" target="_blank" class="wk-button wk-button-primary wk-padding-remove-vertical wk-padding-small"><span class="wk-icon wk-margin-small-right" wk-icon="unlock"></span>Upgrade to Pro</a>
                                </div>
                            </div>
                        </div>
                        <?php endif;?>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script type="text/javascript">!function(e,t,n){function a(){var e=t.getElementsByTagName("script")[0],n=t.createElement("script");n.type="text/javascript",n.async=!0,n.src="https://beacon-v2.helpscout.net",e.parentNode.insertBefore(n,e)}if(e.Beacon=n=function(t,n,a){e.Beacon.readyQueue.push({method:t,options:n,data:a})},n.readyQueue=[],"complete"===t.readyState)return a();e.attachEvent?e.attachEvent("onload",a):e.addEventListener("load",a,!1)}(window,document,window.Beacon||function(){});</script>
    <script type="text/javascript">window.Beacon('init', '940f4d8a-7f6f-432c-ae31-0ed5819fdbe4')</script>
<?php
    }
        
    /**
     * Register sections
     */
    public function widgetkit_for_elementor_sections_with_ajax()
    {
        if (isset($_POST['fields'])) {
            parse_str($_POST['fields'], $settings);
        } else {
            return;
        }

        $this->widgetkit_settings = [
            // Slider Animation
            'widget-slider-animation' => intval($settings['widget-slider-animation'] ? 1 : 0),
            // Slider Content Animation
            'widget-slider-content-animation' => intval($settings['widget-slider-content-animation'] ? 1 : 0),
            // Slider Box Animation
            'widget-slider-box-animation' => intval($settings['widget-slider-box-animation'] ? 1 : 0),
            // Gallery
            'widget-gallery' => intval($settings['widget-gallery'] ? 1 : 0),            
            // Portfolio
            'widget-portfolio' => intval($settings['widget-portfolio'] ? 1 : 0),
            // Feature section
            'widget-feature-box' => intval($settings['widget-feature-box'] ? 1 : 0),
            // Animation Text
            'widget-animation-text' => intval($settings['widget-animation-text'] ? 1 : 0),
            // Countdown
            'widget-countdown' => intval($settings['widget-countdown'] ? 1 : 0),
            // Pricing Single
            'widget-pricing-single' => intval($settings['widget-pricing-single'] ? 1 : 0),
            // Pricing Icon
            'widget-pricing-icon' => intval($settings['widget-pricing-icon'] ? 1 : 0),
            // Pricing Tab
            'widget-pricing-tab' => intval($settings['widget-pricing-tab'] ? 1 : 0),
            // Team 
            'widget-team' => intval($settings['widget-team'] ? 1 : 0),
            // Team Round
            'widget-team-round' => intval($settings['widget-team-round'] ? 1 : 0),
            // Team Animation
            'widget-team-animation' => intval($settings['widget-team-animation'] ? 1 : 0),
            // Team Verticle Icon
            'widget-team-verticle-icon' => intval($settings['widget-team-verticle-icon'] ? 1 : 0),
            // Team Overlay
            'widget-team-overlay' => intval($settings['widget-team-overlay'] ? 1 : 0),
            // Button
            'widget-button' => intval($settings['widget-button'] ? 1 : 0),
            // Hover Image
            'widget-hover-image' => intval($settings['widget-hover-image'] ? 1 : 0),
            // Post Carousel
            'widget-content-carousel' => intval($settings['widget-content-carousel'] ? 1 : 0),
            // Blog Revert
            'widget-blog-revert' => intval($settings['widget-blog-revert'] ? 1 : 0),
            // Blog Hover Animation
            'widget-blog-hover-animation' => intval($settings['widget-blog-hover-animation'] ? 1 : 0),
            // Blog Image
            'widget-blog-image' => intval($settings['widget-blog-image'] ? 1 : 0),
            // Blog carousel
            'widget-blog-carousel' => intval($settings['widget-blog-carousel'] ? 1 : 0),
            // Blog Sidebar
            'widget-blog-sidebar' => intval($settings['widget-blog-sidebar'] ? 1 : 0),
             // Testimonial
            'widget-testimonial' => intval($settings['widget-testimonial'] ? 1 : 0),
            // Testimonial Single
            'widget-testimonial-single' => intval($settings['widget-testimonial-single'] ? 1 : 0),
            // Testimonial Center
            'widget-testimonial-center' => intval($settings['widget-testimonial-center'] ? 1 : 0),
            // Social Share Animation
            'widget-social-share-animation' => intval($settings['widget-social-share-animation'] ? 1 : 0),
            // Social Share collapse
            'widget-social-share-collapse' => intval($settings['widget-social-share-collapse'] ? 1 : 0),
            // Post carousel
            'widget-post-carousel' => intval($settings['widget-post-carousel'] ? 1 : 0),
            // Image compare
            'widget-image-compare' => intval($settings['widget-image-compare'] ? 1 : 0),

             // Tilt Box
            'widget-tilt-box' => intval($settings['widget-tilt-box'] ? 1 : 0),
            // Contact form
            'widget-contact-form' => intval($settings['widget-contact-form'] ? 1 : 0),
            'widget-click-tweet' => intval($settings['widget-click-tweet'] ? 1 : 0),
            'widget-pros-cons' => intval($settings['widget-pros-cons'] ? 1 : 0),


            /**
             * pro
             */
            'wkpro-post-tab' => intval($settings['wkpro-post-tab'] ? 1 : 0),
            'wkpro-post-carousel' => intval($settings['wkpro-post-carousel'] ? 1 : 0),
            'wkpro-post-list' => intval($settings['wkpro-post-list'] ? 1 : 0),
            'wkpro-grid-slider' => intval($settings['wkpro-grid-slider'] ? 1 : 0),
            'wkpro-headline-slider' => intval($settings['wkpro-headline-slider'] ? 1 : 0),
        ];
        $this->wk_woo_settings = [
            'wke-woo-product' => intval($settings['wke-woo-product'] ? 1 : 0),
            'wke-woo-product-carousel' => intval($settings['wke-woo-product-carousel'] ? 1 : 0),
            'wke-woo-categories' => intval($settings['wke-woo-categories'] ? 1 : 0),
            'wke-woo-recent-product' => intval($settings['wke-woo-recent-product'] ? 1 : 0),
        ];

        $this->wk_ld_settings = [
            'wke-ld-course-list' => intval($settings['wke-ld-course-list'] ? 1 : 0),
            'wke-ld-course-tab' => intval($settings['wke-ld-course-tab'] ? 1 : 0),
        ];
        $this->wk_lp_settings = [
            'wke-lp-course-list' => intval($settings['wke-lp-course-list'] ? 1 : 0),
            'wke-lp-course-tab' => intval($settings['wke-lp-course-tab'] ? 1 : 0),
        ];
        $this->wk_sensei_settings = [
            'wke-sensei-course-list' => intval($settings['wke-sensei-course-list'] ? 1 : 0),
            'wke-sensei-course-tab' => intval($settings['wke-sensei-course-tab'] ? 1 : 0),
        ];
        update_option('widgetkit_save_settings', $this->widgetkit_settings);
        update_option('widgetkit_save_woo_settings', $this->wk_woo_settings);
        update_option('widgetkit_save_ld_settings', $this->wk_ld_settings);
        update_option('widgetkit_save_lp_settings', $this->wk_lp_settings);
        update_option('widgetkit_save_sensei_settings', $this->wk_sensei_settings);

        return true;
        die();
    }

    public function widgetkit_get_changelog_data(){
        
        $curl = curl_init();
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => $this->api_url,
            // CURLOPT_USERAGENT => 'Codular Sample cURL Request'
        ]);
        $resp = curl_exec($curl);
        curl_close($curl);
        $res_data = json_decode($resp, true);
        $changes_data = $res_data['changes'];
        if($changes_data){
            $_SESSION['changes'] = $changes_data;
        }
        return $changes_data;
        
    }
}

new Widgetkit_Admin;
