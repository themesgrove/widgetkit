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
        public function wkfe_dashboard_header_content(){
            ?>
            <div class="wk-header wk-padding-small wk-card wk-card-default wk-margin-medium-top">
                <div class="wk-header__top wk-margin-small-bottom">
                    <div class="wk-text-center wk-padding-small">
                        <img src="<?php echo plugins_url('../assets/images/logo-t.svg', __FILE__)?>" width="200" wk-svg>
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

                        </ul>
                    </div>
                    <div class="wk-width-1-5 wk-text-right">
                        <button type="submit" class="wk-button wk-button-danger widgetkit-save-button wk-flex wk-flex-right">Save Settings</button>
                    </div>
                </div>
            </div>
            <?php 
        }
    }
?>