<?php
class WKFE_Dashboard_Sidebar
{
    private static $instance;

    public static function init()
    {
        if (null === self::$instance) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function __construct()
    {
        $this->wkfe_dashboard_sidebar_content();
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

    public function wkfe_dashboard_sidebar_content()
    {
?>
        <div wk-sticky="offset: 40">
            <div class="td-banner">
                <a href="<?php echo esc_url('https://www.thrivedesk.com'); ?>">
                    <?php $this->render_image('../assets/images/td-banner.png', array('style' => 'max-width:260px; margin-bottom:20px')); ?>
                </a>
            </div>
            <div class="wk-card wk-card-default wk-card-body wk-background-small wk-text-center">
                <?php $this->render_image('../assets/images/widgetkit-pro.svg', array('width' => '150', 'wk-svg' => '', 'class' => 'wk-margin-small-top')); ?>
                <p class="wk-text-muted">Get the pro version of <strong>WidgetKit</strong> for more stunning elements and customization options.</p>
                <a href="https://themesgrove.com/widgetkit-for-elementor/?utm_campaign=widgetkit-pro&utm_medium=wp-admin&utm_source=pro-feature-button" target="_blank" class="wk-button wk-button-primary wk-padding-remove-vertical wk-padding-small"><span class="wk-icon wk-margin-small-right" wk-icon="unlock"></span>Upgrade to Pro</a>
            </div>
        </div>
<?php
    }
}
?>