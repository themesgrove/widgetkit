<?php
    $settings = $this->get_settings();
    $social_icon_picker_for_handler = widgetkit_for_elementor_array_get($settings, 'social_icon_picker_for_handler');
    $site_social_default_list = widgetkit_for_elementor_array_get($settings, 'site_social_default_list');
    $site_social_icon_alignment = widgetkit_for_elementor_array_get($settings, 'site_social_icon_alignment');
    $site_social_platform_position = widgetkit_for_elementor_array_get($settings, 'site_social_platform_position');
    $site_social_platform_icon_color = widgetkit_for_elementor_array_get($settings, 'site_social_platform_icon_color');

?>

    <div class="wkfe-site-social">
        <div id="wkfe-site-social-<?php echo $this->get_id(); ?>" class="wkfe-site-social-wrapper wkfe-site-social-<?php echo $this->get_id(); ?>">
            <span class="click-handler"> <i class="<?php echo $social_icon_picker_for_handler['value'];?>"></i> </span>
            <div class="<?php echo $site_social_icon_alignment; ?> wkfe-site-social-platform-wrapper">
                <div class="social-platforms">
                    <?php 
                        foreach($site_social_default_list as $site_social):
                            $site_social_hover_color = $site_social["site_social_platform_hover_color"];
                            ?>
                                <a style="color: <?php echo $site_social_platform_icon_color; ?>" onMouseOver="this.style.color='<?php echo $site_social_hover_color; ?>'" onMouseOut="this.style.color='<?php echo $site_social_platform_icon_color; ?>'" href="<?php echo $site_social['social_link'];?>"><i class="<?php echo $site_social['social_icon_picker'];?>"></i></a>
                            <?php 
                        endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div><!-- animation-text -->

    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wkfe-site-social')){
                $('body').addClass('wkfe-site-social');
            }
        });

    </script>