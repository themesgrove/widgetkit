<?php
// Silence is golden.
    use Elementor\Icons_Manager;
    $settings = $this->get_settings();
?>
    <div class="tgx-image-feature">               
        <!-- feature Start -->
        <div class="block drop-shadow ">

            <?php if ($settings['title_position'] == 'top'):?>
                <?php if ($settings['feature_title']):?>
                    <?php if ($settings['feature_link']['url']): ?>
                        <a 
                        <?php if ( $settings['feature_link']['is_external'] ): ?>
                            target="_blank"
                        <?php else: ?>
                            rel="nofollow" 
                        <?php endif; ?>

                        href="<?php echo esc_url($settings['feature_link']['url']);?>"> 
                            <h4 class="feature-title"><?php echo esc_html($settings['feature_title']); ?></h4>
                        </a>
                    <?php else: ?>
                        <h4 class="feature-title"><?php echo esc_html($settings['feature_title']); ?></h4>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if( $settings['hover_effect'] == 'round'):?>
                <div class="hover-round">

                    <?php if ($settings['choose_media'] == 'image'): ?>
                        <?php if( $settings['feature_image']['url']):?>
                            <?php if (!empty($settings['feature_image']['id'])) {
                                echo wp_get_attachment_image($settings['feature_image']['id'], 'full', false, array('alt' => esc_attr(get_the_title())));
                            } else {
                                // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                echo '<img src="' . esc_url($settings['feature_image']['url']) . '" alt="' . esc_attr(get_the_title()) . '">'; 
                            } ?>
                        <?php endif; ?>

                    <?php else: ?>
                        <?php 
                        Icons_Manager::render_icon( $settings['feature_icon_updated'], [ 'aria-hidden' => 'true','class' => 'feature-icon' ] );
                        ?>
                        <?php //if( $settings['feature_icon']):?>
                            <!-- <i class="feature-icon fa <?php //echo $settings['feature_icon'];?>"></i> -->
                        <?php //endif; ?>

                    <?php endif ?>
                </div><!-- .custom-icon -->

            <?php else: ?>

                <div class="hover-angle">
                    <?php if ($settings['choose_media'] == 'image'): ?>
                        
                        <?php if( $settings['feature_image']['url']):?>
                            <?php if (!empty($settings['feature_image']['id'])) {
                                echo wp_get_attachment_image($settings['feature_image']['id'], 'full', false, array('class' => 'tgx-media', 'alt' => esc_attr(get_the_title())));
                            } else {
                                // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                echo '<img class="tgx-media" src="' . esc_url($settings['feature_image']['url']) . '" alt="' . esc_attr(get_the_title()) . '">'; 
                            } ?>
                        <?php endif; ?>

                    <?php else: ?>
                        <?php 
                            Icons_Manager::render_icon( $settings['feature_icon_updated'], [ 'aria-hidden' => 'true', 'class' => 'feature-icon' ] );
                        ?>
                        <?php //if( $settings['feature_icon']):?>
                             <!-- <i class="feature-icon fa <?php //echo $settings['feature_icon'];?>"></i> -->
                        <?php //endif; ?>
                        
                    <?php endif ?>

                </div>
            <?php endif; ?>


            <?php if ($settings['title_position'] == 'bottom'):?>
                <?php if ($settings['feature_title']):?>
                    <?php if ($settings['feature_link']['url']): ?>
                        <a 
                        <?php if ( $settings['feature_link']['is_external'] ): ?>
                            target="_blank"
                        <?php else: ?>
                            rel="nofollow" 
                        <?php endif; ?>
                        href="<?php echo esc_url($settings['feature_link']['url']);?>"> 
                            <h4 class="feature-title"><?php echo esc_html($settings['feature_title']); ?></h4>
                        </a>
                    <?php else: ?>
                         <h4 class="feature-title"><?php echo esc_html($settings['feature_title']); ?></h4>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($settings['feature_content']):?>
                <p class="feature-desc"><?php echo esc_html($settings['feature_content']); ?></p> 
            <?php endif; ?>           
        </div><!-- .block -->
    </div><!-- /.section -->

    <script type="text/javascript">
          jQuery(function($){
              if(!$('body').hasClass('wk-info-box')){
                  $('body').addClass('wk-info-box');
              }
          });

    </script>