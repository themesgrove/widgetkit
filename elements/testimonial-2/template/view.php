<?php
// Silence is golden.

	$settings = $this->get_settings();
  $id = $this->get_id();

?>

    <div class="tgx-testimonial-2 <?php echo esc_attr($id); ?>">
          <?php foreach ( $settings['testimonial_option_2'] as $testimonial ) : ?>
            <div class="testimoni-wrapper text-center">
                  <?php if ($settings['testimoni_position'] == 'top'):?>
                      <div class="testimony">
                          <p> <?php echo esc_html($testimonial['testimoni_content_2']);?></p>
                      </div>
                 <?php endif; ?>
                <?php if ($testimonial['testimoni_image_2']):?>
                  <div class="author">
                        <span>
                            <?php if (!empty($testimonial['testimoni_image_2']['id'])) {
                                echo wp_get_attachment_image($testimonial['testimoni_image_2']['id'], 'full', false, array('class' => 'testimonial-image', 'alt' => esc_attr(get_the_title())));
                            } else {
                                // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                echo '<img class="testimonial-image" src="' . esc_url($testimonial['testimoni_image_2']['url']) . '" alt="' . esc_attr(get_the_title()) . '">';
                            } ?>
                        </span>     
                  </div>
                <?php endif;?>


                <div class="designation">                    
                     <?php if ($testimonial['title_2']):?>
                        <h4 class="name"><?php echo esc_html($testimonial['title_2']);  ?></h4>
                      <?php endif; ?>

                      <?php if ($testimonial['designation_2']):?>
                        <p class="designation"><?php echo esc_html($testimonial['designation_2']);  ?></p>
                      <?php endif; ?>
                </div>


              <?php if ($settings['testimoni_position'] == 'bottom'):?>
                    <div class="testimony">
                        <p> <?php echo esc_html($testimonial['testimoni_content_2']);?></p>
                    </div>
              <?php endif; ?>
          </div>
        <?php endforeach; ?>           
    </div><!-- /.section -->

    <script type='text/javascript'>
          jQuery(document).ready(function($) {
            jQuery(".<?php echo esc_attr($id); ?>").addClass("owl-carousel").owlCarousel({
                  pagination: false,
                  margin:10,
                  dots:false,
                  loop:true,
                  <?php if ($settings['nav_enable_2'] == 'yes'): ?>
                        nav: true,
                  <?php else: ?>
                       nav:false,
                  <?php endif; ?>
                  
                  navClass: ['owl-carousel-left','owl-carousel-right'],
                  navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                  autoHeight : true,
                  <?php if ($settings['autoplay_enable_2'] == 'yes'): ?>
                        autoplay:true,
                  <?php else: ?>
                         autoplay:false,
                  <?php endif; ?>

                  responsive:{
                      0:{
                          items:1
                      },
                      600:{
                          items:1
                      },
                      1000:{
                          items:1
                      }
                  }
               });
        });


    </script>

    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wk-testimonial-center')){
                $('body').addClass('wk-testimonial-center');
            }
        });

    </script>