<?php

    $settings = $this->get_settings();
    $id = $this->get_id();

?>




<div id="<?php echo esc_attr($id);?>" class="modal-container">
    <div class="
    <?php if ($settings['button_modal_hover_effect'] == 'border'){
        echo esc_attr("btn-border-modal");
        }else{
            echo esc_attr("click-btn ");
        }
        ?>">

    <?php if ($settings['button_options_select'] == 'modal'):?>

        <button onclick="document.getElementById('modal-button-<?php echo esc_attr($id);?>').style.display='block'" class="btn-hover-<?php echo esc_attr($settings['button_modal_hover_effect']);?>  booking-button">


        <?php if ($settings['button_modal_hover_effect'] == 'border'): ?>
            <div class="btn-line btn-normal btn-hover-<?php echo esc_attr($settings['button_modal_hover_effect']);?>">
                <a href="#">
                    <p> <?php echo esc_html($settings['modal_text']);?>
                            <?php if ($settings['modal_icon']):?>
                        <i style="float:<?php echo esc_attr($settings['modal_icon_align']);?>;" class="<?php echo esc_attr($settings['modal_icon']);?>"></i>
                    <?php endif; ?>
                        
                    </p>
                    <span class="top"></span>
                    <span class="right"></span>
                    <span class="bottom"></span>
                    <span class="left"></span>
                </a>
            </div>

        <?php elseif($settings['button_modal_hover_effect'] == 'bfm' || $settings['button_modal_hover_effect'] == 'fourcorner'): ?>
            <span>
                <?php echo esc_html($settings['modal_text']);?>
                <?php if ($settings['modal_icon']):?>
                    <i style="float:<?php echo esc_attr($settings['modal_icon_align']);?>;" class="<?php echo esc_attr($settings['modal_icon']);?>"></i>
                <?php endif; ?>
            </span>

        
        <?php else: ?>
            <?php echo esc_html($settings['modal_text']);?>
                <?php if ($settings['modal_icon']):?>
                    <i style="float:<?php echo esc_attr($settings['modal_icon_align']);?>;" class="<?php echo esc_attr($settings['modal_icon']);?>"></i>
                <?php endif; ?>
            <?php endif; ?>
        </button> <!-- /button -->






    <?php else: ?>

        <?php if ($settings['button_modal_hover_effect'] == 'border'): ?>
            <div class="btn-line btn-hover-<?php echo esc_attr($settings['button_modal_hover_effect']);?>">
                <a 
                href="<?php echo esc_attr($settings['normal_btn_link']['url']);?>" 
                target="<?php echo esc_attr($settings['normal_btn_link']['is_external']) ? '_blank' : '';  ?>"
                rel="<?php echo esc_attr($settings['normal_btn_link']['nofollow']) ? 'nofollow' : ''; ?>"
                >
                    <p> <?php echo esc_html($settings['modal_text']);?>
                            <?php if ($settings['modal_icon']):?>
                        <i style="float:<?php echo esc_attr($settings['modal_icon_align']);?>;" class="<?php echo esc_attr($settings['modal_icon']);?>"></i>
                    <?php endif; ?>
                        
                    </p>
                    <span class="top"></span>
                    <span class="right"></span>
                    <span class="bottom"></span>
                    <span class="left"></span>
                </a>
            </div>
        <?php else: ?>
        <a  
        href="<?php echo esc_url($settings['normal_btn_link']['url']); ?>" 
        class="btn-hover-<?php echo esc_attr($settings['button_modal_hover_effect']);?>  button-normal"
        target="<?php echo esc_attr($settings['normal_btn_link']['is_external']) ? '_blank' : ''; ?>"
        rel="<?php echo esc_attr($settings['normal_btn_link']['nofollow']) ? 'nofollow' : ''; ?>"
        >
            <?php if ($settings['button_modal_hover_effect'] == 'bfm' || $settings['button_modal_hover_effect'] == 'fourcorner' ): ?>
                <span>
                    <?php echo esc_html($settings['modal_text']);?>
                    <?php if ($settings['modal_icon']):?>
                        <i style="float:<?php echo esc_attr($settings['modal_icon_align']);?>;" class="<?php echo esc_attr($settings['modal_icon']);?>"></i>
                    <?php endif; ?>
                </span>
        
            <?php else: ?>
                <?php echo esc_html($settings['modal_text']);?>
                    <?php if ($settings['modal_icon']):?>
                        <i style="float:<?php echo esc_attr($settings['modal_icon_align']);?>;" class="<?php echo esc_attr($settings['modal_icon']);?>"></i>
                    <?php endif; ?>
                <?php endif; ?>
            </a> <!-- /button -->
        <?php endif; ?>


    <?php endif;?>


    </div> <!-- /click btn -->

    <?php if ($settings['button_options_select'] == 'modal'):?>
        <div id="modal-button-<?php echo esc_attr($id);?>" class="tgx-modal">
            <div class="tgx-modal-content tgx-<?php echo esc_attr($settings['modal_effect']);?>">

                <header class="tgx-container tgx-teal"> 
                    <span onclick="document.getElementById('modal-button-<?php echo esc_attr($id);?>').style.display='none'" 
                    class="tgx-button tgx-display-topright">&times;</span>
                    <h2><?php echo esc_html($settings['modal_tile']);?></h2>
                </header><!-- /header -->

                <div class="tgx-container">
                <?php
                        // Define allowed HTML tags and attributes for the iframe *before* the conditions
                        $allowed_html_iframe = [
                            'iframe' => [
                                'src'             => true, // Allow src attribute
                                'height'          => true, // Allow height attribute
                                'width'           => true, // Allow width attribute
                                'frameborder'     => true, // Allow frameborder attribute
                                'allowfullscreen' => true, // Allow allowfullscreen attribute
                                'allow'           => true, // For attributes like 'encrypted-media'
                                'gesture'         => true, // For attributes like 'media'
                            ],
                        ];

                        // Now check the content type and render accordingly
                        if ( $settings['modal_content'] === 'modal_shortcode' ) {
                            echo do_shortcode( $settings['modal_shortcode'] );
                        } elseif ( $settings['modal_content'] === 'modal_video' ) {
                            // Use the pre-defined allowed HTML for iframes
                            echo wp_kses(html_entity_decode($settings['modal_video']), $allowed_html_iframe); // Decode HTML entities
                        } else {
                            // Fallback to shortcode as in the original code
                            echo do_shortcode( $settings['modal_shortcode'] );
                        }
                    ?>
                </div><!-- /tgx-container -->

            </div><!-- /tgx-content -->
        </div><!-- /modal-button -->
    <?php endif; ?>
</div><!-- /modal-container -->

    <script type="text/javascript">
          jQuery(function($){
              if(!$('body').hasClass('wk-button-modal')){
                  $('body').addClass('wk-button-modal');
              }
          });

    </script>

