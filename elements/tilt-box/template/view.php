<?php
    $tilt_box = $this->get_settings();
    $content_overlay_position = $tilt_box['content_overlay_position'];
    $id = $this->get_id();
    use Elementor\Icons_Manager;
?>
    <div class="wk-tilt-box">
        <div id="wk-tilt-<?php echo esc_attr($id);?>" class="tilt-element <?php echo esc_attr($tilt_box['content_position']== 'overlay')? 'wk-flex wk-flex-' .esc_attr($content_overlay_position) : '';?>" data-tilt  <?php echo esc_attr($tilt_box['select_effect'] == 'glare')? 'data-tilt-glare data-tilt-max-glare="0.8"' : '';?>  <?php echo esc_attr($tilt_box['select_effect'] == 'reverse')? 'data-tilt-reverse="true"' : '';?> <?php echo esc_attr($tilt_box['select_effect'] == 'floating')? 'data-tilt-reset="true"' : '';?> <?php echo esc_attr($tilt_box['select_effect'] == 'listening')? 'data-tilt-full-page-listening' : '';?>  <?php echo esc_attr($tilt_box['select_effect'] == 'x')? 'data-tilt-axis="y"' : '';?> <?php echo esc_attr($tilt_box['select_effect'] == 'y')? 'data-tilt-axis="x"' : '';?> >

            <?php if ($tilt_box['content_position']== 'overlay'):?>
                <?php if ($tilt_box['content_icon'] || $tilt_box['content_title'] || $tilt_box['content_description'] || $tilt_box['content_button']):?>
                    <div class="wk-tilt-card wk-text-<?php echo esc_attr($tilt_box['content_align']);?> content-<?php echo esc_attr($tilt_box['content_position']);?> wk-padding">
                        <?php if ($tilt_box['content_icon']):?>
                            <div class="wk-tilt-card-icon-top">
                                <?php 
                                    Icons_Manager::render_icon( $tilt_box['content_icon'], [ 'aria-hidden' => 'true' ] );
                                ?>
                            </div>
                        <?php endif; ?>

                        <div class="wk-tilt-card-body">
                            <?php if ($tilt_box['content_title']):?>
                                <h3 class="wk-tilt-card-title">
                                    <a href="<?php echo esc_url($tilt_box['content_link']['url']); ?>" 
                                        <?php echo esc_attr($tilt_box['content_link']['is_external']) ? 'target="_blank"' : ''; ?>>
                                        <?php echo esc_html($tilt_box['content_title']); ?>
                                    </a>
                                </h3>
                            <?php endif; ?>

                            <?php if ($tilt_box['content_description']):?>
                                <p class="wk-tilt-card-desc"><?php echo esc_html($tilt_box['content_description']); ?></p>
                            <?php endif; ?>

                            <?php if ($tilt_box['content_button']):?>
                                <a href="<?php echo esc_url($tilt_box['content_link']['url']); ?>" <?php echo esc_attr($tilt_box['content_link']['is_external']) ? 'target="_blank"' : ''; ?>  class="wk-button wk-button-text">
                                    <?php echo esc_html($tilt_box['content_button']); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>
        </div>
        <?php if ($tilt_box['content_position']== 'bottom'):?>
            <?php if ($tilt_box['content_icon'] || $tilt_box['content_title'] || $tilt_box['content_description'] || $tilt_box['content_button'] ):?>
                <div class="wk-tilt-card wk-text-<?php echo esc_attr($tilt_box['content_align']);?> wk-card-default wk-padding content-<?php echo esc_attr($tilt_box['content_position']);?>">
                    <?php if ($tilt_box['content_icon']):?>
                        <div class="wk-tilt-card-icon-top">
                            <?php 
                                Icons_Manager::render_icon( $tilt_box['content_icon'], [ 'aria-hidden' => 'true' ] );
                            ?>
                        </div>
                    <?php endif; ?>

                    <div class="wk-tilt-card-body">
                        <?php if ($tilt_box['content_title']):?>
                            <h3 class="wk-tilt-card-title">
                                <a href="<?php echo esc_url($tilt_box['content_link']['url']); ?>" 
                                    <?php echo esc_attr($tilt_box['content_link']['is_external']) ? 'target="_blank"' : ''; ?>>
                                    <?php echo esc_html($tilt_box['content_title']); ?>
                                </a>
                            </h3>
                        <?php endif; ?>

                        <?php if ($tilt_box['content_description']):?>
                            <p class="wk-tilt-card-desc"><?php echo esc_html($tilt_box['content_description']); ?></p>
                        <?php endif; ?>

                        <?php if ($tilt_box['content_button']):?>
                            <a href="<?php echo esc_url($tilt_box['content_link']['url']); ?>" <?php echo esc_attr($tilt_box['content_link']['is_external']) ? 'target="_blank"' : ''; ?>  class="wk-button wk-button-text">
                                <?php echo esc_html($tilt_box['content_button']); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>



    <?php if ($tilt_box['effect_enable'] == 'yes'):?> 

        <?php 
            wp_enqueue_script(
                'vanilla-tilt',
                plugins_url('assets/js/vanilla-tilt.min.js', WK_FILE),
                array(), // No dependencies
                '1.7.0', // Version number
                array(
                    'strategy' => 'defer', // Load script in footer
                    'in_footer' => true
                )
            );
        ?>

        <script type="text/javascript">
            VanillaTilt.init(document.querySelector("#wk-tilt-<?php echo esc_attr($id);?> .tilt-element"), {
                max: 25,
                speed: 400,
        });
        

        </script>
    <?php endif; ?>
    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wk-tilt-box')){
                $('body').addClass('wk-tilt-box');
            }
        });

    </script>



