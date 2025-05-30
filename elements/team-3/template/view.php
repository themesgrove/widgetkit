<?php
// Silence is golden.

    $settings = $this->get_settings();

?>
    <div class="tgx-team-3">
        <div class="team-container">
            <!-- First Team Block -->
            <div class="team-each-wrap">
               
                <div class="team-block">
                    <?php if (!empty($settings['team_image']['id'])) {
                        echo wp_get_attachment_image($settings['team_image']['id'], 'full', false, ['alt' => esc_attr($settings['team_name'])]);
                    } elseif (!empty($settings['team_image']['url'])) {
                        // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                        echo '<img src="' . esc_url($settings['team_image']['url']) . '" alt="' . esc_attr($settings['team_name']) . '">';
                    } ?>  
                    <div class="spin"></div>             
                </div>

                <div class="team-info">
                    <div class="name">
                        <?php if ( ! empty( $settings['team_name'] ) ) : ?>
                            <?php if ( ! empty( $settings['image_external_link'] ) ) : ?>        
                                <a <?php if( $settings['image_external_link'] ['is_external'])
                                        { echo 'target="_blank"'; }else{ echo 'rel="nofollow"';}?>  
                                        href="<?php  echo esc_url($settings['image_external_link']['url']);?>">
                                <h4 class="team-title"><?php echo esc_html($settings['team_name']);?></h4>
                                </a>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if ( ! empty( $settings['designation'] ) ) : ?>
                            <span class="team-designation"><?php echo esc_html($settings['designation']);?></span>
                        <?php endif; ?>
                    </div>

                    <?php if ( ! empty( $settings['content'] ) ) : ?>
                        <div class="team-content">
                            <p><?php echo esc_html($settings['content']); ?></p>
                        </div>
                    <?php endif; ?> 

                    <?php if ( ! empty( $settings['social_share_3'] ) ) : ?>
                        <div class="team-social">
                            <?php foreach ( $settings['social_share_3'] as $social ) : ?>
                                <?php if ( ! empty( $social['social_link'] ) ) : ?>
                                    <a <?php if($social['social_link'] ['is_external'])
                                    { echo 'target="_blank"'; }else{ echo 'rel="nofollow"';}?>
                                    href="<?php  echo esc_url($social['social_link']['url']);?>" class="<?php  echo esc_attr(strtolower($social['title']));?>">
                                         <i class="<?php echo esc_attr( $social['social_icon']); ?>"></i>
                                    </a>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>  
                    <?php endif; ?>
                </div><!-- end .hover content -->
            </div><!-- end .team wrap -->
        </div><!-- end .tema container -->
    </div> <!-- end .section -->

    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wk-team-round')){
                $('body').addClass('wk-team-round');
            }
        });

    </script>
