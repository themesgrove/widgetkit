<?php
/*
Plugin Name: WidgetKit for Elementor
Description: Huge collection of pro quality element or section for use in Elementor page builder,which you help to create any kind of complicated design without coding.  Elementor Page Builder must be installed and activated.
Version: 1.0.2
Text Domain: widgetkit-for-elementor
Author: Themesgrove
Author URI: https://themesgrove.com
Plugin URI: http://widgetkit.themesgrove.com/
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
@package  WidgetKit_For_Elementor
Domain Path:       /languages
*/

    if( !function_exists('add_action') ) {
        die('Elementor not Installed'); // if Elementor not installed kill the page.
    }

    // Define absoulote path
    if( !defined( 'ABSPATH' ) ) exit; // No access of directly access

    // Define file
    define('WKFE_FILE', __FILE__);
    // Define url
    define('WKFE_URL', plugins_url('/', __FILE__ ) );
    // Define path
    define('WKFE_PATH', plugin_dir_path( __FILE__ ) );


    class WidgetKit_For_Elementor {
        // Activate 
        function activate(){
            flush_rewrite_rules();
        }

        // Deactivate 
        function deactivate(){
            flush_rewrite_rules();
        }

        // Widget register
        function __construct() {
            add_action( 'elementor/widgets/widgets_registered', array( $this, 'widgetkit_for_elementor_widget_bundle') );
        }

        // widgetkit widget bundle
        function widgetkit_for_elementor_widget_bundle(){

            // Portfolio elements
            require_once WKFE_PATH . '/elements/portfolio/widget.php';
            // Pricing 1 elements
            require_once WKFE_PATH . '/elements/pricing-1/widget.php';
            // Pricing 2 elements
            require_once WKFE_PATH . '/elements/pricing-2/widget.php';
            // Pricing tab elements
            require_once WKFE_PATH . '/elements/pricing-tab/widget.php';

            // Testimonial-1 elements
            require_once WKFE_PATH . '/elements/testimonial-1/widget.php';
            // Testimonial-2 elements
            require_once WKFE_PATH . '/elements/testimonial-2/widget.php';


            // Team-1 elements
            require_once WKFE_PATH . '/elements/team-1/widget.php';
            // Team-2 elements
            require_once WKFE_PATH . '/elements/team-2/widget.php';
            // Team-3 elements
            require_once WKFE_PATH . '/elements/team-3/widget.php';
            // Team-4 elements
            require_once WKFE_PATH . '/elements/team-4/widget.php';


            // Custom blog elements 1
            require_once WKFE_PATH . '/elements/blog-1/widget.php';
            // Custom blog elements 2
            require_once WKFE_PATH . '/elements/blog-2/widget.php';
            // Custom blog elements 3
            require_once WKFE_PATH . '/elements/blog-3/widget.php';
            // Custom blog elements 4
            require_once WKFE_PATH . '/elements/blog-4/widget.php';
            // Custom blog elements 5
            require_once WKFE_PATH . '/elements/blog-5/widget.php';

            // Slider 1 elements
            require_once WKFE_PATH . '/elements/slider-1/widget.php';
            // Slider 2 elements
            require_once WKFE_PATH . '/elements/slider-2/widget.php';
            // Slider 3 elements
            require_once WKFE_PATH . '/elements/slider-3/widget.php';


            // Custom Feature elements
            require_once WKFE_PATH . '/elements/image-feature/widget.php';

            // Animation text elements
            require_once WKFE_PATH . '/elements/animation-text/widget.php';


            // Custom carousel elements
            require_once WKFE_PATH . '/elements/carousel/widget.php';
            // Button modal elements
            require_once WKFE_PATH . '/elements/button-modal/widget.php';



            // Social Share 1 elements
            require_once WKFE_PATH . '/elements/social-share-1/widget.php';
            // Social Share 2 elements
            require_once WKFE_PATH . '/elements/social-share-2/widget.php';


            // helper functions
            require_once WKFE_PATH . '/elements/helper-functions.php';
        }



        // Register style & script
        function widgetkit_for_elementor_register(){
            add_action('wp_head', array($this, 'widgetkit_for_elementor_css'));
            add_action('wp_enqueue_scripts', array($this, 'widgetkit_for_elementor_script'));
        }


        // Css include
        function widgetkit_for_elementor_css(){
            // Base css
            wp_enqueue_style( 'widgetkit_base', plugins_url('/assets/css/base.css',__FILE__ ));

            // owl-carousel css
            wp_enqueue_style( 'owl-css', plugins_url('/assets/css/owl.carousel.min.css',__FILE__ ));

            // Animation css
            wp_enqueue_style( 'animate', plugins_url('/assets/css/animate.css',__FILE__ ));

            // Fontawesome css
            wp_enqueue_style( 'fontawesome', plugins_url('/assets/css/font-awesome.min.css',__FILE__ ));

            // Ionsicon css
            wp_enqueue_style( 'ionsicon', plugins_url('/assets/css/ionicons.min.css',__FILE__ ));

            // Plugin-demo css
            wp_enqueue_style( 'widgetkit_demo', plugins_url('/assets/css/plugin-demo.css',__FILE__ ));

            // Main plugin css
            wp_enqueue_style( 'widgetkit_main', plugins_url('/assets/css/widgetkit.css',__FILE__ ));

        }

        // Script include
        function widgetkit_for_elementor_script(){

            // Bootstarp Script
            wp_enqueue_script( 'bootstarp-js', plugins_url('/assets/js/bootstrap.js', __FILE__ ) , array('jquery'), false, true);
              
            // Owl-carousel js
            wp_enqueue_script( 'owl-carousel', plugins_url('/assets/js/owl.carousel.min.js', __FILE__ ) , array('jquery'), false, true);

            // Hoverdie js
            wp_enqueue_script( 'hoverdir', plugins_url('/assets/js/jquery.hoverdir.js', __FILE__ ) , array('jquery'), false, true);

            // Mordernizer js
            wp_enqueue_script( 'modernizr', plugins_url('/assets/js/modernizr.min.js', __FILE__ ) , array('jquery'), false, true);

              // Animate text js
            wp_enqueue_script( 'animate-text', plugins_url('/assets/js/animate-text.js', __FILE__ ) , array('jquery'), false, true);

            // Mixitup js
            wp_enqueue_script( 'mixitup-js', plugins_url('/assets/js/mixitup.min.js', __FILE__ ) , array('jquery'), false, true);

            // Imagepackagelaod Js
           wp_enqueue_script( 'widgetkit-imagesloaded', plugins_url('/assets/js/imagesloaded.pkgd.min.js',  __FILE__ ), array('jquery'), '4.1.1', true);
           
            // Anime js
            wp_enqueue_script( 'anime', plugins_url('/assets/js/anime.min.js', __FILE__ ) , array('jquery'), false, true);

            // Slider 3 js
            wp_enqueue_script( 'widgetkit-slider-3', plugins_url('/assets/js/slider-3.js', __FILE__ ) , array('jquery'), false, true);

            // Main plugin js
            wp_enqueue_script( 'widgetkit-main', plugins_url('/assets/js/widgetkit.js', __FILE__ ) , array('jquery'), false, true);
        }

    }

    // Class Register
    if (class_exists('WidgetKit_For_Elementor')) {
        # code...
        $widgetkit_for_elementor = new WidgetKit_For_Elementor();
        $widgetkit_for_elementor->widgetkit_for_elementor_register();
        $widgetkit_for_elementor->widgetkit_for_elementor_widget_bundle();

    }

    // Activation
    register_activation_hook( __FILE__, array($widgetkit_for_elementor, 'activate' ));

    // Deactivation
    register_deactivation_hook( __FILE__, array($widgetkit_for_elementor, 'deactivate' ));



