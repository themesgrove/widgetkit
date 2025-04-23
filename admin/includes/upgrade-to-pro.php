<?php 
    class WKFE_Dashboard_Upgrade_to_PRO{
        private static $instance; 

        public static function init(){
            if(null === self::$instance){
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct(){
            $this->wkfe_dashboard_upgrade_to_pro_content();
        }

        /**
         * Helper function to output images in a way that satisfies the linter.
         * 
         * @param string $image_path Path to the image relative to the plugin.
         * @param array  $attributes Additional HTML attributes.
         * @param bool   $use_plugin_root Whether to use plugin root as base path.
         * @return void
         */
        private function render_image($image_path, $attributes = array(), $use_plugin_root = false) {
            $default_attributes = array(
                'alt' => '',
            );
            $attributes = wp_parse_args($attributes, $default_attributes);
            
            // Build the image URL
            $image_url = '';
            if ($use_plugin_root) {
                // Use main plugin file as reference
                $image_url = plugins_url($image_path, WK_FILE);
            } else {
                // Use current file as reference for relative paths
                $image_url = plugins_url('../assets/images/premium/' . basename($image_path), __FILE__);
            }
            
            // Set the src attribute
            $attributes['src'] = $image_url;
            
            // Build the img tag with wp_kses for security
            $allowed_html = array(
                'img' => array(
                    'src' => true,
                    'alt' => true,
                    'width' => true,
                    'height' => true,
                    'class' => true,
                    'id' => true,
                    'wk-cover' => true,
                ),
            );
            
            // Build opening tag
            $img_tag = '<img';
            
            // Add each attribute safely
            foreach ($attributes as $name => $value) {
                if ($value === '') {
                    $img_tag .= ' ' . esc_attr($name);
                } else {
                    $img_tag .= ' ' . esc_attr($name) . '="' . esc_attr($value) . '"';
                }
            }
            
            // Close the tag
            $img_tag .= '>';
            
            // Output with wp_kses for final safety check
            echo wp_kses($img_tag, $allowed_html);
        }

        public function wkfe_dashboard_upgrade_to_pro_content(){
            ?>
            <div class="wk-card wk-card-default wk-grid-collapse wk-child-width-1-2@s wk-margin" wk-grid>
                <div class="wk-card-media-left wk-cover-container">
                    <?php $this->render_image('assets/images/wigetkit-banner-bg.png', array('wk-cover' => ''), true); ?>
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
                        <?php $this->render_image('post-grid-slider.jpg', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Ajax based grid slider</h4>
                    </div>
                </div>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('post-tabs.jpg', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Posts tab with ajax</h4>
                    </div>
                </div>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('post-smart-list.jpg', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Smart list widget</h4>
                    </div>
                </div>
            </div>
            <h3 class="wk-text-center wk-h2"><?php echo esc_html__('Premium WooCommerce Widgets','widgetkit-for-elementor');?></h3>
            <div class="wk-child-width-1-3@m wk-grid-match" wk-grid>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('woo-smart-products.jpg', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Woo smart products</h4>
                    </div>
                </div>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('woo-smart-cat.jpg', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Woo smart categories</h4>
                    </div>
                </div>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('woo-ajax-cart.jpg', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Ajax add to cart</h4>
                    </div>
                </div>
            </div>
            <h3 class="wk-text-center wk-h2"><?php echo esc_html__('LearnDash Widgets','widgetkit-for-elementor');?></h3>
            <div class="wk-child-width-1-3@m wk-grid-match" wk-grid>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('ld1.png', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Course List Style</h4>
                    </div>
                </div>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('ld2.png', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Course Tab Style</h4>
                    </div>
                </div>
                <div>
                    <div class="wk-card wk-card-default wk-card-hover wk-card-body wk-text-center">
                        <?php $this->render_image('ld3.png', array('width' => '100%')); ?>
                        <h4 class="wk-margin-small-top wk-text-light">Course Carousel Style</h4>
                    </div>
                </div>
                <div class="wk-width-1-1 wk-text-center">
                    <div><a href="https://themesgrove.com/widgetkit-for-elementor/?utm_campaign=widgetkit-pro&utm_medium=wp-admin&utm_source=pro-feature-button" target="_blank" class="wk-button wk-button-primary">And Many More <span wk-icon="icon: arrow-right" style="display: inline-flex; vertical-align:middle;"></span></a></div>
                </div>
            </div>
            <?php 
        }
    }
?>