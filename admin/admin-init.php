<?php

class Widgetkit_Admin
{
    // Widgets keys

    public $widgetkit_elements_keys = [
        'widget-slider-animation',
        'widget-slider-content-animation',
        'widget-slider-box-animation',
        'widget-portfolio',
        'widget-pricing-single',
        'widget-pricing-icon',
        'widget-pricing-tab',
        'widget-testimonial-single',
        'widget-testimonial-center',
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
        'widget-post-carousel',
        'widget-button',
        'widget-hover-image',
        'widget-feature-box',
        'widget-social-share-animation',
        'widget-social-share-collapse',
    ];

    // Default settings
    private $widgetkit_default_settings;
    // Switch settings
    private $widgetkit_settings;
    // Switch get settings
    private $widgetkit_get_settings;

    /**
     * Register construct
     */
    public function __construct()
    {
        //$this->includes();
        $this->init_hooks();
    }

    /**
     * Register a custom opitons.
     */
    public function widgetkit_for_elementor_admin_options()
    {
        add_menu_page(
            'Admin Menu',
            __('WidgetKit', 'widgetkit-for-elementor'),
            'manage_options',
            'widgetkit-settings',
            [$this, 'display_settings_pages'],
            plugins_url('/assets/images/menu-icon.png', __FILE__),
            30
        );
        add_submenu_page(
            'widgetkit-settings',
            '',
            '<span class="dashicons dashicons-star-filled" style="color:#f44336; font-size: 17px"></span> ' . __('Go Pro', 'widgetkit-for-elementor'),
            'manage_options',
            'widgetkit-gopro',
            [$this, 'handle_external_redirects']
        );
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
        wp_enqueue_style( 'widgetkit-admin',  plugins_url('/assets/css/admin.css', __FILE__  ));
        wp_enqueue_style( 'widgetkit-sweetalert2-css', plugins_url('/assets/css/sweetalert2.min.css', __FILE__ ));
        
        wp_enqueue_script('widgetkit-elementor-admin-js', plugins_url('/assets/js/admin.js', __FILE__) , array('jquery','jquery-ui-tabs'), '1.0' , true );
        wp_enqueue_script( 'widgetkit-sweet-js',  plugins_url('/assets/js/core.js', __FILE__), array( 'jquery' ), '1.0', true );
		wp_enqueue_script( 'widgetkit-sweetalert2-js', plugins_url('/assets/js/sweetalert2.min.js', __FILE__), array( 'jquery', 'widgetkit-sweet-js' ), '1.0', true );
        wp_enqueue_script( 'admin-notice-js', plugins_url('/assets/js/admin-notice.js', __FILE__), array( 'jquery' ), '1.0', true );
       /**
        * Load uikit only inside widgetkit setting page
        */
        global $wp;  
        $current_url = add_query_arg(array($_GET), $wp->request);
        $current_url_slug = explode("=", $current_url);
        if($current_url && $current_url_slug[1] === 'widgetkit-settings' ){
            wp_enqueue_style( 'uikit',  plugins_url('/dist/css/uikit.min.css', dirname(__FILE__)  ));
            wp_enqueue_script( 'uikit',  plugins_url('/dist/js/uikit.min.js', dirname(__FILE__)  ));
            wp_enqueue_script( 'uikit-icon',  plugins_url('/dist/js/uikit-icons.min.js', dirname(__FILE__)  ));
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

        $this->widgetkit_default_settings = array_fill_keys($this->widgetkit_elements_keys, true);

        $this->widgetkit_get_settings = get_option('widgetkit_save_settings', $this->widgetkit_default_settings);

        $widgetkit_new_settings = array_diff_key($this->widgetkit_default_settings, $this->widgetkit_get_settings);

        if (!empty($widgetkit_new_settings)) {
            $widgetkit_updated_settings = array_merge($this->widgetkit_get_settings, $widgetkit_new_settings);
            update_option('widgetkit_save_settings', $widgetkit_updated_settings);
        }
        $this->widgetkit_get_settings = get_option('widgetkit_save_settings', $this->widgetkit_default_settings); ?>


<div class="wrap">
    <div class="response-wrap"></div>
    <form action="" method="POST" id="widgetkit-settings" name="widgetkit-settings">
        <div class="wk-header uk-padding-small uk-card uk-card-default">
            <div class="wk-header__top uk-margin-small-bottom">
                <div class="">
                    WidgetKit
                </div>
            </div>
            <div class="wk-navbar">
                <ul class="uk-tab-bottom uk-margin-remove-bottom"
                    uk-tab="connect: #wk-options; animation: uk-animation-slide-left-small, uk-animation-slide-right-small">
                    <li><a href="#">Overview</a></li>
                    <li><a href="#">Elements</a></li>
                    <li><a href="#">Info</a></li>
                    <li><a href="#">Go Premium</a></li>
                </ul>
            </div>
        </div>

        <div class="wk-main uk-margin">
            <div class="uk-grid">
                <div class="uk-width-3-4">
                    <div class="uk-card uk-card-default uk-card-body uk-card-small">
                        <ul id="wk-options" class="uk-switcher">
                            <li>
                                <div class="widgetkit-row uk-padding">
                                    <div class="widgetkit-col-half">
                                        <div class="widgetkit-about-panel">
                                            <div class="widgetkit-icon-container">
                                                <i class="dashicons dashicons-editor-help"></i>
                                            </div>
                                            <div class="widgetkit-text-container">
                                                <h4>What is Widgetkit?</h4>
                                                <p>WidgetKit is a completely free tool that enhances your pagebuilding
                                                    experience with Elementor pagebuilder. It doesn't matter whether you
                                                    are building simple or complex site, if you can imagine it you can
                                                    built it with Widgetkit.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widgetkit-col-half">
                                        <div class="widgetkit-about-panel">
                                            <div class="widgetkit-icon-container">
                                                <i class="dashicons dashicons-media-document"></i>
                                            </div>
                                            <div class="widgetkit-text-container">
                                                <h4>Documentation</h4>
                                                <p>It’s highly recommended to check out documentation and FAQ before
                                                    using this plugin. <a target="_blank"
                                                        href="https://themesgrove.com/">Click Here </a> for more
                                                    details.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widgetkit-row uk-padding">
                                    <div class="widgetkit-col-half">
                                        <div class="widgetkit-about-panel">
                                            <div class="widgetkit-icon-container">
                                                <i class="dashicons dashicons-format-chat"></i>
                                            </div>
                                            <div class="widgetkit-text-container">
                                                <h4><?php echo  __('Need Any Help?'); ?>
                                                </h4>
                                                <p>Feel free to join us in our <a target="_blank"
                                                        href="https://www.facebook.com/themesgrove/">Facebook Group</a>
                                                    and our <a target="_blank"
                                                        href="https://themesgrove.com/forum/">Community Forums</a> if
                                                    you need more help using the plugin.</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="widgetkit-col-half">
                                        <div class="widgetkit-about-panel">
                                            <div class="widgetkit-icon-container">
                                                <i class="dashicons dashicons-update"></i>
                                            </div>
                                            <div class="widgetkit-text-container">
                                                <h4><?php echo  __('Keep Updated'); ?>
                                                </h4>
                                                <p><?php echo  __('Join our Newsletter to get more info about our products updates.'); ?>
                                                    <a target="_blank"
                                                        href="https://themesgrove.com/wordpress-themes/"><?php echo  __('Click Here</a> to Join Now.'); ?>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="uk-grid uk-grid-small uk-child-width-1-3" uk-grid>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo __('Slider Animation', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-slider-animation"
                                                    name="widget-slider-animation" <?php checked(1, $this->widgetkit_get_settings['widget-slider-animation'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo esc_html__('Pricing Single', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-pricing-single"
                                                    name="widget-pricing-single" <?php checked(1, $this->widgetkit_get_settings['widget-pricing-single'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo esc_html__('Button & Modal', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-button" name="widget-button" <?php checked(1, $this->widgetkit_get_settings['widget-button'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo esc_html__('Testimonial Single', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-testimonial-single"
                                                    name="widget-testimonial-single" <?php checked(1, $this->widgetkit_get_settings['widget-testimonial-single'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo esc_html__('Slider Content Animation', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-slider-content-animation"
                                                    name="widget-slider-content-animation" <?php checked(1, $this->widgetkit_get_settings['widget-slider-content-animation'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo esc_html__('Pricing Icon', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-pricing-icon"
                                                    name="widget-pricing-icon" <?php checked(1, $this->widgetkit_get_settings['widget-pricing-icon'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo esc_html__('Hover Image', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-hover-image" name="widget-hover-image"
                                                    <?php checked(1, $this->widgetkit_get_settings['widget-hover-image'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div>
                                        <div
                                            class="uk-card uk-card-default uk-card-hover uk-card-body uk-card-small uk-flex uk-flex-between uk-flex-middle">
                                            <?php echo esc_html__('Testimonial Center', 'widgetkit-for-elementor'); ?>
                                            <label class="switch">
                                                <input type="checkbox" id="widget-testimonial-center"
                                                    name="widget-testimonial-center" <?php checked(1, $this->widgetkit_get_settings['widget-testimonial-center'], true) ?>>
                                                <span class="rectangle round"></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <h3>
                                    <?php echo esc_html__('System setup information useful for debugging purposes.', 'widgetkit-for-elementor'); ?>
                                </h3>
                                <pre
                                    class="uk-pre"><?php echo nl2br(widgetkit_get_sysinfo()); ?></pre>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="uk-width-1-4">
                    ads
                </div>
            </div>
        </div>



        <div class="widgetkit-settings-tabs">
            <ul class="widgetkit-settings-tabs-list">
                <li><a class="widgetkit-tab-list-item" href="#widgetkit-about">About</a></li>
                <li><a class="widgetkit-tab-list-item" href="#widgetkit-elements">Free Elements</a></li>
            </ul>
            <div id="widgetkit-about" class="widgetkit-settings-tab">
                <div class="widgetkit-row">
                    <div class="widgetkit-col-half">
                        <div class="widgetkit-about-panel">
                            <div class="widgetkit-icon-container">
                                <i class="dashicons dashicons-editor-help"></i>
                            </div>
                            <div class="widgetkit-text-container">
                                <h4>What is Widgetkit?</h4>
                                <p>WidgetKit is a completely free tool that enhances your pagebuilding experience with
                                    Elementor pagebuilder. It doesn't matter whether you are building simple or complex
                                    site, if you can imagine it you can built it with Widgetkit.</p>
                            </div>
                        </div>
                    </div>
                    <div class="widgetkit-col-half">
                        <div class="widgetkit-about-panel">
                            <div class="widgetkit-icon-container">
                                <i class="dashicons dashicons-media-document"></i>
                            </div>
                            <div class="widgetkit-text-container">
                                <h4>Documentation</h4>
                                <p>It’s highly recommended to check out documentation and FAQ before using this plugin.
                                    <a target="_blank" href="https://themesgrove.com/">Click Here </a> for more details.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="widgetkit-row">
                    <div class="widgetkit-col-half">
                        <div class="widgetkit-about-panel">
                            <div class="widgetkit-icon-container">
                                <i class="dashicons dashicons-format-chat"></i>
                            </div>
                            <div class="widgetkit-text-container">
                                <h4><?php echo  __('Need Any Help?'); ?>
                                </h4>
                                <p>Feel free to join us in our <a target="_blank"
                                        href="https://www.facebook.com/themesgrove/">Facebook Group</a> and our <a
                                        target="_blank" href="https://themesgrove.com/forum/">Community Forums</a> if
                                    you need more help using the plugin.</p>
                            </div>
                        </div>
                    </div>
                    <div class="widgetkit-col-half">
                        <div class="widgetkit-about-panel">
                            <div class="widgetkit-icon-container">
                                <i class="dashicons dashicons-update"></i>
                            </div>
                            <div class="widgetkit-text-container">
                                <h4><?php echo  __('Keep Updated'); ?>
                                </h4>
                                <p><?php echo  __('Join our Newsletter to get more info about our products updates.'); ?>
                                    <a target="_blank" href="https://themesgrove.com/wordpress-themes/"><?php echo  __('Click Here</a> to Join Now.'); ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div id="widgetkit-elements" class="widgetkit-settings-tab">

                <table class="widgetkit-elements-table">
                    <tbody>


                        <tr>

                            <th><?php echo esc_html__('Slider Box Animation', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-slider-box-animation"
                                        name="widget-slider-box-animation" <?php checked(1, $this->widgetkit_get_settings['widget-slider-box-animation'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                            <th><?php echo esc_html__('Pricing Tabs', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-pricing-tab" name="widget-pricing-tab" <?php checked(1, $this->widgetkit_get_settings['widget-pricing-tab'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                            <th><?php echo esc_html__('Blog Revert', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-blog-revert" name="widget-blog-revert" <?php checked(1, $this->widgetkit_get_settings['widget-blog-revert'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                            <th><?php echo esc_html__('Social Share Animation', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-social-share-animation"
                                        name="widget-social-share-animation" <?php checked(1, $this->widgetkit_get_settings['widget-social-share-animation'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>


                        </tr>


                        <tr>
                            <th><?php echo esc_html__('Portfolio', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-portfolio" name="widget-portfolio" <?php checked(1, $this->widgetkit_get_settings['widget-portfolio'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>


                            <th><?php echo esc_html__('Team Round', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-team-round" name="widget-team-round" <?php checked(1, $this->widgetkit_get_settings['widget-team-round'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>


                            <th><?php echo esc_html__('Blog Hover Animation', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-blog-hover-animation"
                                        name="widget-blog-hover-animation" <?php checked(1, $this->widgetkit_get_settings['widget-blog-hover-animation'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>


                            <th><?php echo esc_html__('Social Share Collapse', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-social-share-collapse"
                                        name="widget-social-share-collapse" <?php checked(1, $this->widgetkit_get_settings['widget-social-share-collapse'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                        </tr>


                        <tr>
                            <th><?php echo esc_html__('Feature Box', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-feature-box" name="widget-feature-box" <?php checked(1, $this->widgetkit_get_settings['widget-feature-box'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>



                            <th><?php echo esc_html__('Team Animation', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-team-animation" name="widget-team-animation"
                                        <?php checked(1, $this->widgetkit_get_settings['widget-team-animation'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>


                            <th><?php echo esc_html__('Blog Image', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-blog-image" name="widget-blog-image" <?php checked(1, $this->widgetkit_get_settings['widget-blog-image'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                            <th><?php echo esc_html__('Post Carousel', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-post-carousel" name="widget-post-carousel" <?php checked(1, $this->widgetkit_get_settings['widget-post-carousel'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>
                        </tr>



                        <tr>
                            <th><?php echo esc_html__('Animation Text', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-animation-text" name="widget-animation-text"
                                        <?php checked(1, $this->widgetkit_get_settings['widget-animation-text'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>


                            <th><?php echo esc_html__('Team Verticle Icon', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-team-verticle-icon"
                                        name="widget-team-verticle-icon" <?php checked(1, $this->widgetkit_get_settings['widget-team-verticle-icon'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                            <th><?php echo esc_html__('Blog Carousel', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-blog-carousel" name="widget-blog-carousel" <?php checked(1, $this->widgetkit_get_settings['widget-blog-carousel'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <th><?php echo esc_html__('Countdown', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-countdown" name="widget-countdown" <?php checked(1, $this->widgetkit_get_settings['widget-countdown'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                            <th><?php echo esc_html__('Team Overlay', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-team-overlay" name="widget-team-overlay" <?php checked(1, $this->widgetkit_get_settings['widget-team-overlay'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>

                            <th><?php echo esc_html__('Blog Sidebar', 'widgetkit-for-elementor'); ?>
                            </th>
                            <td>
                                <label class="switch">
                                    <input type="checkbox" id="widget-blog-sidebar" name="widget-blog-sidebar" <?php checked(1, $this->widgetkit_get_settings['widget-blog-sidebar'], true) ?>>
                                    <span class="rectangle round"></span>
                                </label>
                            </td>
                        </tr>



                    </tbody>
                </table>
                <input type="submit" value="Save Settings" class="button widgetkit-btn widgetkit-save-button">

            </div>


            <div>
                <p><?php echo  __('Did you like our plugin? Please'); ?><a
                        href="https://wordpress.org/support/plugin/widgetkit-for-elementor/reviews/#new-post"
                        target="_blank"> <?php echo  __('Click Here to Rate it ★★★★★'); ?></a>
                </p>
            </div>
    </form>
</div>
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
            'widget-post-carousel' => intval($settings['widget-post-carousel'] ? 1 : 0),

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

            // Testimonial Single
            'widget-testimonial-single' => intval($settings['widget-testimonial-single'] ? 1 : 0),
            // Testimonial Center
            'widget-testimonial-center' => intval($settings['widget-testimonial-center'] ? 1 : 0),

            // Social Share Animation
            'widget-social-share-animation' => intval($settings['widget-social-share-animation'] ? 1 : 0),
            // Social Share collapse
            'widget-social-share-collapse' => intval($settings['widget-social-share-collapse'] ? 1 : 0),
        ];
        update_option('widgetkit_save_settings', $this->widgetkit_settings);

        return true;
        die();
    }
}

new Widgetkit_Admin;
