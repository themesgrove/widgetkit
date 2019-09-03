<?php
/*
Plugin Name: WidgetKit for Elementor
Description: Huge collection of pro quality element or section for use in Elementor page builder,which you help to create any kind of complicated design without coding.  Elementor Page Builder must be installed and activated.
Version: 1.5.5
Text Domain: widgetkit-for-elementor
Author: Themesgrove
Author URI: https://themesgrove.com
Plugin URI: http://widgetkit.themesgrove.com/
License: GPL3
License URI: https://www.gnu.org/licenses/gpl-3.0.txt
@package  WidgetKit_For_Elementor
Domain Path: /languages
*/

    /**
     * Define absoulote path
     * No access of directly access
     */
    if( !defined( 'ABSPATH' ) ) exit; 

    define('WKFE_VERSION', '1.5.4');
    define('WKFE_FILE', __FILE__); 
    define('WKFE_URL', plugins_url('/', __FILE__ ) );
    define('WKFE_PATH', plugin_dir_path( __FILE__ ) );


    class WidgetKit_For_Elementor {
        
        public function __construct() {
            add_action( 'plugins_loaded', array( $this, 'plugin_setup' ) );
            add_action( 'elementor/init', array( $this, 'elementor_init' ) );
            add_action( 'init', array( $this, 'elementor_resources' ), -999 );
        }

        public function activate(){
            flush_rewrite_rules();
        }
        public function deactivate(){
            flush_rewrite_rules();
        }

        public function plugin_setup() {
            $this->load_text_domain();
            $this->load_admin_files();
        }
        public function load_admin_files() {
            require_once(WKFE_PATH. 'includes/appsero-init.php');
            require_once(WKFE_PATH. 'includes/widgetkit-pro-init.php');
            require_once(WKFE_PATH. 'includes/elements.php');

            WKFE_Appsero_Init::init();
            WKFE_PRO_Init::init();
            WKFE_Elements::init();
        }
        public function load_text_domain() {
            load_plugin_textdomain( 'widgetkit-for-elementor' );
        }

        public function elementor_init(){
            require_once ( WKFE_PATH . 'includes/elementor-integration.php' );
        }
        public function elementor_addons() {
            require_once ( WKFE_PATH . 'includes/addons-integration.php' );
            require_once ( WKFE_PATH . 'includes/addons-integration-old.php' );
            WKFE_Addons_Integration::init();
            // WKFE_Addons_Integration_Old::init();
        }
        public function elementor_resources() {
            $this->elementor_addons();
        }

    }

    if (class_exists('WidgetKit_For_Elementor')) {
        $widgetkit_for_elementor = new WidgetKit_For_Elementor();
    }

    register_activation_hook( __FILE__, array($widgetkit_for_elementor, 'activate' ));
    register_deactivation_hook( __FILE__, array($widgetkit_for_elementor, 'deactivate' ));
