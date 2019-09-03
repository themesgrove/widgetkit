<?php

if( ! defined( 'ABSPATH' ) ) exit();

class WKFE_Addons_Integration_Old{

    private static $instance;
    public static function init(){
        if(null === self::$instance ){
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __construct(){
        add_action( 'elementor/frontend/after_register_styles', array( $this, 'widgetkit_register_frontend_styles' ) );
        add_action( 'elementor/frontend/after_register_scripts', array( $this, 'widgetkit_register_frontend_scripts' ) );
    }

    public function widgetkit_register_frontend_styles(){
        wp_enqueue_style( 'widgetkit_base', WKFE_URL.'assets/css/base.css', array(), WKFE_VERSION, 'all');
        wp_enqueue_style( 'owl-css', WKFE_URL.'assets/css/owl.carousel.min.css', array(), WKFE_VERSION, 'all');
        wp_enqueue_style( 'animate-css', WKFE_URL.'assets/css/animate.css', array(), WKFE_VERSION, 'all');
        wp_enqueue_style( 'fontawesome', WKFE_URL.'assets/css/font-awesome.min.css', array(), WKFE_VERSION, 'all');
        wp_enqueue_style( 'ionsicon', WKFE_URL.'assets/css/ionicons.min.css', array(), WKFE_VERSION, 'all');
        wp_enqueue_style( 'widgetkit_demo', WKFE_URL.'assets/css/plugin-demo.css', array(), WKFE_VERSION, 'all');
        wp_enqueue_style( 'widgetkit_main', WKFE_URL.'assets/css/widgetkit.css', array(), WKFE_VERSION, 'all');
    }
    

    public function widgetkit_register_frontend_scripts(){
        wp_enqueue_script( 'bootstarp-js', WKFE_URL.'assets/js/bootstrap.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'owl-carousel', WKFE_URL.'assets/js/owl.carousel.min.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'hoverdir', WKFE_URL.'assets/js/jquery.hoverdir.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'modernizr', WKFE_URL.'assets/js/modernizr.min.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'animate-js', WKFE_URL.'assets/js/animate-text.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'mixitup-js', WKFE_URL.'assets/js/mixitup.min.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'anime-js', WKFE_URL.'assets/js/anime.min.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'widgetkit-imagesloaded', WKFE_URL.'assets/js/imagesloaded.pkgd.min.js', array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'widgetkit-slider-3', WKFE_URL.'assets/js/slider-3.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'countdown-js', WKFE_URL.'assets/js/countdown.js' , array('jquery'), WKFE_VERSION, true);
        wp_enqueue_script( 'widgetkit-main', WKFE_URL.'assets/js/widgetkit.js' , array('jquery'), WKFE_VERSION, true);
    }

}
