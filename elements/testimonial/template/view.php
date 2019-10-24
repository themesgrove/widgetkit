<?php
    $testimonials = $settings = $this->get_settings(); 
    $id = $this->get_id();?>

        <div class="wk-testimonial" wk-slider="center:<?php echo $testimonials['center_mode_enable'] == 'yes'? 'true' :'false'; ?>; sets:<?php echo $testimonials['set_mode_enable'] == 'yes'? 'true' :'false'; ?>; autoplay:<?php echo $testimonials['autoplay_mode_enable'] == 'yes'? 'true' :'false'; ?>; autoplay-interval:<?php echo $testimonials['content_interval_option'];?>;">
            <div class="wk-visible-toggle wk-light " tabindex="-1">
                <?php if ($testimonials['center_mode_enable'] == 'yes'): ?>
                    <ul class="wk-grid-<?php echo $testimonials['column_gap']?> wk-slider-items wk-child-width-1-2@s" wk-grid>
                <?php else: ?>
                    <ul class="wk-grid-<?php echo $testimonials['column_gap']?> wk-slider-items wk-flex wk-child-width-1-<?php echo $testimonials['item_column'];?>@m wk-child-width-1-2@s wk-child-width-1-<?php echo $testimonials['item_column'];?>@l" wk-grid>
                <?php endif; ?>
                        <?php foreach ( $testimonials['testimonial_content'] as $testimonial ) : ?>
                             <li class="wk-flex wk-flex-center wk-grid-match">
                                <div class="wk-card <?php echo $testimonial['content_meta'] || $testimonial['testimonial_title'] || $testimonial['testimonial_content']? 'wk-card-default' : '';?> wk-margin-small-bottom">
                                    <?php if($testimonial['testimonial_thumb_image']):?>
                                        <?php if($testimonials['thumbnail_position'] == 'top'): ;?>
                                            <div class="wk-card-media-top wk-overflow-hidden">
                                                <a class="wk-display-block" href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                                    <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                                </a> 
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?> 
                                    <?php if( $testimonial['testimonial_designation'] || $testimonial['testimonial_title'] || $testimonial['testimonial_content']):?>
                                    <div class="wk-card-body">
                                        <?php if ($testimonial['testimonial_designation']): ?>
                                            <span class="wk-text-meta wk-inline-block"><?php echo $testimonial['testimonial_designation']; ?></span>
                                        <?php endif; ?>
                                        <?php if ($testimonial['testimonial_title']): ?>
                                            <<?php echo $testimonials['custom_header_tag'];?>  class="wk-card-title wk-margin-remove">
                                                <?php if ($testimonial['content_demo_link']): ?>
                                                     <a href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo $testimonial['testimonial_title']; ?></a>
                                                <?php else: ?>
                                                        <?php echo $testimonial['testimonial_title']; ?>
                                                <?php endif; ?>  
                                            </<?php echo $testimonials['custom_header_tag'];?>>  
                                        <?php endif; ?>
                                        <?php if ($testimonial['testimonial_content']): ?>
                                            <p class=" wk-margin-small-bottom"><?php echo $testimonial['testimonial_content']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php endif; ?> 
                                    <?php if($testimonials['thumbnail_position'] == 'bottom'):?>
                                        <div class="wk-card-media-bottom wk-overflow-hidden">
                                            <a class="wk-display-block" href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                                <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                            </a> 
                                        </div>
                                    <?php endif; ?> 
                                
                                </div>
                            </li>
                        <?php endforeach; ?>
                </ul>

                <?php if ($testimonials['arrow_enable']):?>
                    <a class=" <?php echo $testimonials['arrow_position'] == 'out'? 'wk-position-center-left-out' : 'wk-position-center-left'; ?> wk-position-medium wk-slidenav-small <?php echo $testimonials['arrow_on_hover'] == 'yes'? 'wk-hidden-hover' : ''; ?> " href="#" wk-slidenav-previous wk-slider-item="previous"></a>
                    <a class="<?php echo $testimonials['arrow_position'] == 'out'? 'wk-position-center-right-out' : 'wk-position-center-right'; ?> wk-position-medium  wk-slidenav-small <?php echo $testimonials['arrow_on_hover'] == 'yes'? 'wk-hidden-hover' : ''; ?>  " href="#" wk-slidenav-next wk-slider-item="next"></a>
                <?php endif; ?>

            </div>

                <?php if ($testimonials['dot_enable']):?>
                    <ul class="wk-slider-nav wk-dotnav wk-flex-<?php echo $testimonials['dot_nav_align'];?> wk-margin-medium-top"></ul>
                <?php endif; ?>

        </div>

