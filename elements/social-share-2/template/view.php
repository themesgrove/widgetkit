<?php
   // Silence is golden.

    $settings = $this->get_settings();
    $id = $this->get_id();
?>
    <div id="<?php echo esc_attr($id);?>" class="tgx-social-share-2 profile">

        <?php if ($settings['social_share_2_image']):?> 
            <div class="photo">
                <img src="<?php echo esc_url($settings['social_share_2_image']['url']);?>" alt="<?php echo esc_attr($settings['social_share_2_name']);?>">
            </div>
        <?php endif;?>

        <div class="profile-content">
            <div class="text">
                <h3 class="profile-name"><?php echo esc_html($settings['social_share_2_name']);?></h3>
                <h6 class="profile-profession"><?php echo esc_html($settings['social_share_2_designation']);?></h6>
            </div>
            <div class="btn-bar click-<?php echo esc_attr($id);?>"><span></span></div>
        </div> <!-- profile-content -->

        <div class="box box-<?php echo esc_attr($id);?>">

            <?php if ( ! empty( $settings['social_share_2_social_share'] ) ) : ?>
                <?php foreach ( $settings['social_share_2_social_share'] as $social ) : ?>
                    <?php if ( ! empty( $social['social_share_2_social_link'] ) ) : ?>
                        <a target="_blank" href="<?php  echo esc_url($social['social_share_2_social_link']);?>" class="<?php  echo esc_attr(strtolower($social['social_share_2_title']));?>">
                                <i class="<?php echo esc_attr( $social['social_share_2_social_icon']); ?>"></i>
                        </a><!-- social-wrapper -->
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
        </div><!-- box -->

    </div><!-- profile -->

    <script type="text/javascript">
        jQuery(function($) {

            jQuery('.click-<?php echo esc_attr($id);?>').click(function() {
                jQuery(this).toggleClass('active');
                return $('.box-<?php echo esc_attr($id);?>').toggleClass('open');
              });

            },(jQuery));


    </script>

    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wk-social-share-collapse')){
                $('body').addClass('wk-social-share-collapse');
            }
        });

    </script>