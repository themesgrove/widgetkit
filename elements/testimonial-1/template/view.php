<?php
// Silence is golden.

	$settings = $this->get_settings();
  $id = $this->get_id();

?>

    <div class="tgx-testimonial-1 <?php echo esc_attr($id); ?>">
          <?php foreach ( $settings['testimonial_option_1'] as $testimonial_1 ) : ?>
            <div class="testimoni-wrapper">
                <div class="testimony"> <p> <?php echo esc_html($testimonial_1['testimoni_content_1']);?></p></div>
                <div class="author">
                 <?php if ($testimonial_1['testimoni_image_1']['url']):?>

                    <?php
                        if ($settings['testimonial_items'] == '1'):?>
                          <div class="col-md-1">
                    <?php elseif ($settings['testimonial_items'] == '2'):?>
                        <div class="col-md-3">
                    <?php else:?>
                       <div class="col-md-4">
                    <?php endif;?>

                       <?php if ($testimonial_1['testimoni_image_1']['url']):?>
                              <span>
                                  <?php if (!empty($testimonial_1['testimoni_image_1']['id'])) {
                                      echo wp_get_attachment_image($testimonial_1['testimoni_image_1']['id'], 'full', false, ['class' => 'testimonial-image']);
                                  } elseif (!empty($testimonial_1['testimoni_image_1']['url'])) {
                                    // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                                      echo '<img class="testimonial-image" src="' . esc_url($testimonial_1['testimoni_image_1']['url']) . '">';
                                  } ?>
                              </span>
                      <?php endif;?>
                        
                    </div>
                  <?php endif; ?>
                    <?php
                        if ($settings['testimonial_items'] == '1'):?>
                            <div class="col-md-11">
                        <?php elseif ($settings['testimonial_items'] == '2'):?>
                            <div class="col-md-9">
                        <?php else:?>
                           <div class="col-md-8">
                        <?php endif;?>
                            <?php if ($testimonial_1['title_1']):?>
                              <h4 class="name"><?php echo esc_html($testimonial_1['title_1']);  ?></h4>
                            <?php endif; ?>

                            <?php if ($testimonial_1['designation_1']):?>
                              <p class="designation"><?php echo esc_html($testimonial_1['designation_1']);  ?></p>
                            <?php endif; ?>
                     </div>
                </div>
            </div>
          <?php endforeach; ?>            
    </div><!-- /.section -->

    <script type='text/javascript'>
          jQuery(document).ready(function($) {
            jQuery(".<?php echo esc_attr($id); ?>").addClass("owl-carousel").owlCarousel({
                  pagination: false,
                  margin:10,
                  dots:false,
                  
                  <?php if ($settings['testimonial_items'] == '2'):?>
                      center:false,
                  <?php else: ?>
                      center:true,
                  <?php endif; ?>
                  loop:true,
                  nav: false,
                  navClass: ['owl-carousel-left','owl-carousel-right'],
                  navText: ['<i class="fa fa-angle-left"></i>', '<i class="fa fa-angle-right"></i>'],
                  autoHeight : true,
               <?php if ($settings['autoplay_enable'] == 'yes'): ?>
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
                          items: <?php echo wp_json_encode((int) $settings['testimonial_items']); ?>
                      }
                  }
               });
        });


    </script>

    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wk-testimonial-single')){
                $('body').addClass('wk-testimonial-single');
            }
        });

    </script>
