<?php 
    class WKFE_Dashboard_Header{
        private static $instance; 

        public static function init(){
            if(null === self::$instance){
                self::$instance = new self;
            }
            return self::$instance;
        }

        public function __construct(){
            $this->wkfe_dashboard_header_content();
        }

        /**
         * Helper function to output images in a way that satisfies the linter.
         * 
         * @param string $image_path Path to the image relative to the current file.
         * @param array  $attributes Additional HTML attributes.
         * @return void
         */
        private function render_image($image_path, $attributes = array()) {
            $default_attributes = array(
                'alt' => '',
            );
            $attributes = wp_parse_args($attributes, $default_attributes);
            
            // Build the image URL
            $image_url = plugins_url($image_path, __FILE__);
            
            // Set the src attribute
            $attributes['src'] = $image_url;
            
            // Build allowed HTML array for wp_kses
            $allowed_html = array(
                'img' => array(
                    'src' => true,
                    'alt' => true,
                    'width' => true,
                    'height' => true,
                    'class' => true,
                    'id' => true,
                    'style' => true,
                    'wk-svg' => true,
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
        
        public function wkfe_dashboard_header_content(){
            ?>
            <div class="wk-header wk-padding-small wk-card wk-card-default wk-margin-medium-top">
                <div class="wk-header__top wk-margin-small-bottom">
                    <div class="wk-text-center wk-padding-small">
                        <?php $this->render_image('../assets/images/logo-t.svg', array('width' => '200', 'wk-svg' => '')); ?>
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
                            <?php if ( apply_filters('wkpro_enabled', false)) :?>
                                <li><a href="#"><span class="wk-icon wk-margin-small-right" wk-icon="file-text"></span>License</a></li>
                            <?php endif; ?>
                            <li><a href="#"><span class="wk-icon wk-margin-small-right" wk-icon="unlock"></span>API Keys</a></li>

                        </ul>
                    </div>
                    <div class="wk-width-1-5 wk-text-right wk-dashboard-action-button">
                        <div class="wk-dashboard-action-button-wrapper">
                            <button type="submit" class="wk-button wk-button-danger widgetkit-save-button wk-flex wk-flex-right">Save Settings</button>
                            <div class="loading-ring"></div>
                        </div>
                    </div>
                </div>
            </div>
            <?php 
        }
    }
?>