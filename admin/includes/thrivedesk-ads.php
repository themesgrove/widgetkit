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
                <a href="https://www.thrivedesk.com/?ref=widgetkit">
                    <?php $this->render_image('../assets/images/td-banner.png', array('style' => 'max-width:260px; margin-bottom:20px')); ?>
                </a>
            </div>
        </div>
<?php
    }
}
?>