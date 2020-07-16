<?php
    $settings = $this->get_settings();
    $tsocial_icon_picker_for_handleritle = widgetkit_for_elementor_array_get($settings, 'social_icon_picker_for_handler');
    $site_social_default_list = widgetkit_for_elementor_array_get($settings, 'site_social_default_list');
    $site_social_icon_alignment = widgetkit_for_elementor_array_get($settings, 'site_social_icon_alignment');
    $site_social_platform_position = widgetkit_for_elementor_array_get($settings, 'site_social_platform_position');

?>

    <div class="wkfe-site-social">
        <div id="wkfe-site-social-<?php echo $this->get_id(); ?>" class="wkfe-site-social-wrapper wkfe-site-social-<?php echo $this->get_id(); ?>">
            <span class="click-handler"> <i class="<?php echo $tsocial_icon_picker_for_handleritle['value'];?>"></i> </span>
            <div class="<?php echo $site_social_icon_alignment; ?> wkfe-site-social-platform-wrapper">
                <div class="social-platforms">
                    <?php 
                        foreach($site_social_default_list as $site_social):
                            ?>
                                <a href="<?php echo $site_social['social_link'];?>"><i class="<?php echo $site_social['social_icon_picker'];?>"></i></a>
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