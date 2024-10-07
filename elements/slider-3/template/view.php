<?php

use Elementor\Utils;
$settings = $this->get_settings();
?>
<div class="tgx-slider-3">
    <div class="slideshow">
        <div class="slides">

            <?php $a = 0; ?>
            <?php foreach ($settings['tgx_slider_3_sliders'] as $sliders) : ?>
                <div class="text-center slider <?php echo esc_attr($a == 0) ? 'slide--current' : ''; ?>">
                    <div class="slide__img" style="background-image: url(<?php echo esc_url($sliders['tgx_slider_3_image']['url']); ?>)"></div>

                            <?php
                            if ($sliders['tgx_slider_3_title']) :
                                $this->add_render_attribute('tgx_slider_3_title', 'class', 'slide__title');

                                $title_html = esc_html($sliders['tgx_slider_3_title']);
                                $html = sprintf(
                                '<%1$s %2$s>%3$s</%1$s>',
                                Utils::validate_html_tag($settings['heading_tag']),
                                $this->get_render_attribute_string('tgx_slider_3_title'),
                                $title_html
                                );

                                Utils::print_unescaped_internal_string($html);
                            endif; 
                            ?>

                                <?php if ($sliders['tgx_slider_3_subtitle']) : ?>
                                    <p class="slide__desc"><?php echo esc_html($sliders['tgx_slider_3_subtitle']); ?></p>
                                <?php endif; ?>

                                <?php if ($sliders['tgx_slider_3_button_text']) : ?>
                                    <a class="slide__link" href="<?php echo esc_url($sliders['tgx_slider_3_button_link']['url']); ?>">
                                        <?php echo  esc_html($sliders['tgx_slider_3_button_text']); ?>
                                    </a>
                                <?php endif; ?>

                        </div> <!-- slider -->
                    <?php $a++;
                endforeach; ?>
                </div><!-- Slides --> 


                <nav class="slidenav">
                    <?php if ($settings['tgx_slider_3_nav_previous']) : ?>
                        <button class="slidenav__item slidenav__item--prev"><?php echo esc_html($settings['tgx_slider_3_nav_previous']); ?></button>
                    <?php endif; ?>

                    <?php if ($settings['tgx_slider_3_nav_divider']) : ?>
                        <span class="divider">
                            <?php echo esc_html($settings['tgx_slider_3_nav_divider']); ?>
                        </span>
                    <?php endif; ?>

                    <?php if ($settings['tgx_slider_3_nav_next']) : ?>
                        <button class="slidenav__item slidenav__item--next"><?php echo esc_html($settings['tgx_slider_3_nav_next']); ?></button>
                    <?php endif; ?>

                </nav><!-- Slidenav -->
                    
            </div> <!-- Slideshow -->
        </div> <!-- Slideshow -->

        <script type="text/javascript">
            jQuery(function($){
                if(!$('body').hasClass('wk-slider-3')){
                    $('body').addClass('wk-slider-3');
                }
            });

        </script>