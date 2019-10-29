<?php
    $testimonials = $settings = $this->get_settings(); 
    $id = $this->get_id();?>



    <div class="wk-testimonial" wk-slider="center:<?php echo $testimonials['center_mode_enable'] == 'yes'? 'true' :'false'; ?>; sets:<?php echo $testimonials['set_mode_enable'] == 'yes'? 'true' :'false'; ?>; autoplay:<?php echo $testimonials['autoplay_mode_enable'] == 'yes'? 'true' :'false'; ?>; autoplay-interval:<?php echo $testimonials['content_interval_option'];?>;">
            <div class="wk-visible-toggle wk-light " tabindex="-1">
                    <?php if ($testimonials['center_mode_enable'] == 'yes'): ?>
                      <div class="wk-grid-<?php echo $testimonials['column_gap']?> wk-slider-items wk-child-width-1-2@s" wk-grid>
                    <?php else: ?>
                      <div class="wk-grid-<?php echo $testimonials['column_gap']?> wk-slider-items wk-flex wk-child-width-1-<?php echo $testimonials['item_column'];?>@m wk-child-width-1-2@s wk-child-width-1-<?php echo $testimonials['item_column'];?>@l" wk-grid>
                    <?php endif; ?>

                        <?php foreach ( $testimonials['testimonial_content'] as $testimonial ) : ?>

                           <?php if ($testimonials['item_styles'] == 'screen_1'):?>
                               <div class="wk-flex wk-flex-center wk-grid-match">
                                  <div class="wk-card wk-card-default wk-testimonial-1 wk-padding">
                                    <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                        <?php if($testimonials['thumbnail_position_vertical'] == 'top'): ;?>
                                            <div class="wk-card-media-top wk-overflow-hidden wk-padding-bottom">
                                                <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?>

                                    <div class="wk-card-body wk-padding-remove">
                                        <?php if ($testimonial['testimonial_content']): ?>
                                            <p class=""><?php echo $testimonial['testimonial_content']; ?></p>
                                        <?php endif; ?>

                                         <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_top'): ?>
                                                  <span class="wk-text-meta wk-inline-block top"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                          <?php endif; ?>

                                        <?php if ($testimonial['testimonial_title']): ?>
                                            <<?php echo $testimonials['custom_header_tag'];?>  class="wk-card-title wk-margin-remove">
                                                <?php if ($testimonial['content_demo_link']): ?>
                                                     <a href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo $testimonial['testimonial_title']; ?></a>
                                                <?php else: ?>
                                                        <?php echo $testimonial['testimonial_title']; ?>
                                                <?php endif; ?> 
                                               
                                                <?php if ($testimonial['testimonial_designation']): ?>
                                                    <?php if ($testimonials['designation_position'] == 'horizontal_right'): ?>
                                                        <span class="wk-text-meta wk-inline-block right"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                      
                                          </<?php echo $testimonials['custom_header_tag'];?>>  
                                        <?php endif; ?>

                                        <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_bottom'): ?>
                                                  <span class="wk-text-meta wk-inline-block bottom"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                        <?php endif; ?>
                                    </div>

                                    <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                        <?php if($testimonials['thumbnail_position_vertical'] == 'bottom'):?>
                                      
                                          <div class="wk-card-media-bottom wk-overflow-hidden">
                                              <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                          </div>
                                        <?php endif; ?> 
                                    <?php endif; ?> 
                                
                                </div>
                            </div>

                            <?php elseif($testimonials['item_styles'] == 'screen_2'): ?>
                                <div class="wk-flex wk-flex-center wk-grid-match">
                                  <div class="wk-card wk-card-default wk-testimonial-2 wk-padding">
                                    <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                        <?php if($testimonials['thumbnail_position_vertical'] == 'top'): ;?>
                                            <div class="wk-card-media-top wk-overflow-hidden wk-padding-bottom">
                                                <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?>

                                    <div class="wk-card-body wk-padding-remove">
                                        <?php if ($testimonial['testimonial_content']): ?>
                                            <p class=""><?php echo $testimonial['testimonial_content']; ?></p>
                                        <?php endif; ?>

                                        <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_top'): ?>
                                                  <span class="wk-text-meta wk-inline-block top"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($testimonial['testimonial_title']): ?>
                                            <<?php echo $testimonials['custom_header_tag'];?>  class="wk-card-title wk-margin-remove">
                                                <?php if ($testimonial['content_demo_link']): ?>
                                                     <a href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo $testimonial['testimonial_title']; ?></a>
                                                <?php else: ?>
                                                        <?php echo $testimonial['testimonial_title']; ?>
                                                <?php endif; ?> 
                                                <?php if ($testimonial['testimonial_designation']): ?>
                                                    <?php if ($testimonials['designation_position'] == 'horizontal_right'): ?>
                                                        <span class="wk-text-meta wk-inline-block right"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>

                                            </<?php echo $testimonials['custom_header_tag'];?>>  
                                          <?php endif; ?>

                                          <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_bottom'): ?>
                                                  <span class="wk-text-meta wk-inline-block bottom"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                          <?php endif; ?>
                                    </div>

                                    <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                        <?php if($testimonials['thumbnail_position_vertical'] == 'bottom'):?>
                                      
                                          <div class="wk-card-media-bottom">
                                              <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                          </div>
                                        <?php endif; ?> 
                                    <?php endif; ?> 
                                
                                </div>
                              </div>

                            <?php elseif($testimonials['item_styles'] == 'screen_3'): ?>
                                <div class="wk-flex wk-flex-center wk-grid-match">
                                    <div class="wk-card wk-card-default wk-grid-collapse wk-margin wk-testimonial-3" wk-grid>
                                  
                                    <?php if($testimonials['thumbnail_position_horizontal'] == 'left'): ;?>
                                      <div class="wk-cover-container wk-width-auto">
                                          <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                       
                                              <div class="wk-card-media-left wk-overflow-hidden wk-padding-bottom">
                                                  <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                              </div>
                                         
                                          <?php endif; ?>
                                      </div>
                                    <?php endif; ?> 

                                    <div class="wk-width-expand">
                                        <div class="wk-card-body">
                                          <?php if ($testimonial['testimonial_content']): ?>
                                            <p class=""><?php echo $testimonial['testimonial_content']; ?></p>
                                          <?php endif; ?>
                                          <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_top'): ?>
                                                  <span class="wk-text-meta wk-inline-block top"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                          <?php endif; ?>

                                          <?php if ($testimonial['testimonial_title']): ?>
                                            <<?php echo $testimonials['custom_header_tag'];?>  class="wk-card-title wk-margin-remove">
                                                <?php if ($testimonial['content_demo_link']): ?>
                                                     <a href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo $testimonial['testimonial_title']; ?></a>
                                                <?php else: ?>
                                                        <?php echo $testimonial['testimonial_title']; ?>
                                                <?php endif; ?> 
                                                <?php if ($testimonial['testimonial_designation']): ?>
                                                    <?php if ($testimonials['designation_position'] == 'horizontal_right'): ?>
                                                        <span class="wk-text-meta wk-inline-block right"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                          </<?php echo $testimonials['custom_header_tag'];?>>  
                                        <?php endif; ?>

                                            <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_bottom'): ?>
                                                  <span class="wk-text-meta wk-inline-block bottom"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                          <?php endif; ?>

                                        </div>
                                    </div>
                                     <?php if($testimonials['thumbnail_position_horizontal'] == 'right'): ;?>
                                        <div class="wk-cover-container wk-width-auto">
                                            <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                             
                                                <div class="wk-card-media-right wk-overflow-hidden wk-padding-bottom">
                                                    <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                                </div>
                                         
                                          <?php endif; ?>
                                        </div>
                                    <?php endif; ?> 
                                </div>
                              </div>

                              <?php elseif($testimonials['item_styles'] == 'screen_4'): ?>
                                  <div class="wk-flex wk-flex-center wk-grid-match">
                                    <div class="wk-card wk-card-default wk-testimonial-4 wk-padding-large">
                                      <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                          <?php if($testimonials['thumbnail_position_vertical'] == 'top'): ;?>
                                              <div class="wk-card-media-top wk-overflow-hidden wk-padding-bottom">
                                                  <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                              </div>
                                          <?php endif; ?> 
                                      <?php endif; ?>

                                      <div class="wk-card-body wk-padding-remove">
                                          <div class="wk-position-absolute quote" wk-icon="quote-right"></div>
                                          <?php if ($testimonial['testimonial_content']): ?>
                                              <p class="wk-position-relative">
                                                <?php echo $testimonial['testimonial_content']; ?>
                                                  
                                                </p>
                                          <?php endif; ?>

                                           <?php if ($testimonial['testimonial_designation']): ?>
                                                <?php if ($testimonials['designation_position'] == 'vertical_top'): ?>
                                                    <span class="wk-text-meta wk-inline-block top"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                <?php endif; ?>
                                            <?php endif; ?>

                                          <?php if ($testimonial['testimonial_title']): ?>
                                              <<?php echo $testimonials['custom_header_tag'];?>  class="wk-card-title wk-margin-remove">
                                                  <?php if ($testimonial['content_demo_link']): ?>
                                                       <a href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo $testimonial['testimonial_title']; ?></a>
                                                  <?php else: ?>
                                                          <?php echo $testimonial['testimonial_title']; ?>
                                                  <?php endif; ?> 
                                                 
                                                  <?php if ($testimonial['testimonial_designation']): ?>
                                                      <?php if ($testimonials['designation_position'] == 'horizontal_right'): ?>
                                                          <span class="wk-text-meta wk-inline-block right"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                      <?php endif; ?>
                                                  <?php endif; ?>
                                        
                                            </<?php echo $testimonials['custom_header_tag'];?>>  
                                          <?php endif; ?>

                                          <?php if ($testimonial['testimonial_designation']): ?>
                                                <?php if ($testimonials['designation_position'] == 'vertical_bottom'): ?>
                                                    <span class="wk-text-meta wk-inline-block bottom"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                <?php endif; ?>
                                          <?php endif; ?>
                                      </div>

                                      <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                          <?php if($testimonials['thumbnail_position_vertical'] == 'bottom'):?>
                                        
                                            <div class="wk-card-media-bottom wk-overflow-hidden">
                                                <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                            </div>
                                          <?php endif; ?> 
                                      <?php endif; ?> 
                                  
                                  </div>
                              </div>

                              <?php elseif($testimonials['item_styles'] == 'screen_5'): ?>
                                  <div class="wk-flex wk-flex-center wk-grid-match">
                                    <div class="wk-card wk-card-default wk-testimonial-5 wk-padding wk-text-left">

                                      <div class="wk-card-body wk-padding-remove">
                                          <div class="wk-position-absolute quote" wk-icon="quote-right"></div>
                                            <?php if ($testimonial['testimonial_content']): ?>
                                                <p class="wk-position-relative">
                                                  <?php echo $testimonial['testimonial_content']; ?>
                                                </p>
                                            <?php endif; ?>


                                            <div class="wk-grid-small wk-flex-middle" wk-grid>
                                                <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                                    <?php if($testimonials['thumbnail_position_horizontal'] == 'left'): ;?>
                                                        <div class="wk-width-auto">
                                                      
                                                            <div class="wk-card-media-left wk-overflow-hidden wk-padding-bottom">
                                                                <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" width="80" height="80" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                                            </div>
                                                              
                                                        </div>
                                                    <?php endif; ?> 
                                                <?php endif; ?>

                                                <div class="wk-width-auto">
                                                  <?php if ($testimonial['testimonial_designation']): ?>
                                                        <?php if ($testimonials['designation_position'] == 'vertical_top'): ?>
                                                            <span class="wk-text-meta wk-inline-block top"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                        <?php endif; ?>
                                                    <?php endif; ?>

                                                  <?php if ($testimonial['testimonial_title']): ?>
                                                      <<?php echo $testimonials['custom_header_tag'];?>  class="wk-card-title wk-margin-remove">
                                                          <?php if ($testimonial['content_demo_link']): ?>
                                                               <a href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo $testimonial['testimonial_title']; ?></a>
                                                          <?php else: ?>
                                                                  <?php echo $testimonial['testimonial_title']; ?>
                                                          <?php endif; ?> 
                                                         
                                                          <?php if ($testimonial['testimonial_designation']): ?>
                                                              <?php if ($testimonials['designation_position'] == 'horizontal_right'): ?>
                                                                  <span class="wk-text-meta wk-inline-block right"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                              <?php endif; ?>
                                                          <?php endif; ?>
                                                
                                                    </<?php echo $testimonials['custom_header_tag'];?>>  
                                                  <?php endif; ?>

                                                  <?php if ($testimonial['testimonial_designation']): ?>
                                                        <?php if ($testimonials['designation_position'] == 'vertical_bottom'): ?>
                                                            <span class="wk-text-meta wk-inline-block bottom"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                        <?php endif; ?>
                                                  <?php endif; ?>
                                              </div>
                                               <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                                    <?php if($testimonials['thumbnail_position_horizontal'] == 'right'): ;?>
                                                        <div class="wk-width-auto">
                                                           
                                                            <div class="wk-card-media-right wk-overflow-hidden wk-padding-bottom">
                                                                <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" width="80" height="80" alt="<?php echo $testimonial['testimonial_title']; ?>">   
                                                            </div>
                                                           
                                                        </div>
                                                    <?php endif; ?> 
                                                <?php endif; ?>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                            <?php else: ?>
                                <div class="wk-flex wk-flex-center wk-grid-match">
                                  <div class="wk-card wk-card-default wk-testimonial-1 wk-padding">
                                    <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                        <?php if($testimonials['thumbnail_position'] == 'top'): ;?>
                                            <div class="wk-card-media-top wk-overflow-hidden wk-padding-bottom">
                                                <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?>

                                    <div class="wk-card-body wk-padding-remove">
                                        <?php if ($testimonial['testimonial_content']): ?>
                                            <p class=""><?php echo $testimonial['testimonial_content']; ?></p>
                                        <?php endif; ?>
                                        <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_top'): ?>
                                                  <span class="wk-text-meta wk-inline-block top"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                        <?php endif; ?>
                                        <?php if ($testimonial['testimonial_title']): ?>
                                            <<?php echo $testimonials['custom_header_tag'];?>  class="wk-card-title wk-margin-remove">
                                                <?php if ($testimonial['content_demo_link']): ?>
                                                     <a href="<?php echo $testimonial['content_demo_link']['url']; ?>" <?php echo $testimonial['content_demo_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo $testimonial['testimonial_title']; ?></a>
                                                <?php else: ?>
                                                        <?php echo $testimonial['testimonial_title']; ?>
                                                <?php endif; ?> 
                                                <?php if ($testimonial['testimonial_designation']): ?>
                                                    <?php if ($testimonials['designation_position'] == 'horizontal_right'): ?>
                                                        <span class="wk-text-meta wk-inline-block right"><?php echo $testimonial['testimonial_designation']; ?></span>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                        </<?php echo $testimonials['custom_header_tag'];?>>  
                                        <?php endif; ?>

                                        <?php if ($testimonial['testimonial_designation']): ?>
                                              <?php if ($testimonials['designation_position'] == 'vertical_bottom'): ?>
                                                  <span class="wk-text-meta wk-inline-block bottom"><?php echo $testimonial['testimonial_designation']; ?></span>
                                              <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($testimonial['testimonial_thumb_image']['url']):?>
                                        <?php if($testimonials['thumbnail_position'] == 'bottom'):?>
                                      
                                          <div class="wk-card-media-bottom wk-overflow-hidden">
                                              <img src="<?php echo $testimonial['testimonial_thumb_image']['url'];?>" alt="<?php echo $testimonial['testimonial_title']; ?>">  
                                          </div>
                                        <?php endif; ?> 
                                    <?php endif; ?> 
                                
                                </div>
                            </div>
                          <?php endif; ?>
                    <?php endforeach; ?>
                </div>

                <?php if ($testimonials['arrow_enable']):?>
                  <div class="wk-slide-nav">
                      <a class=" <?php echo $testimonials['arrow_position'] == 'out'? 'wk-position-center-left-out' : 'wk-position-center-left'; ?> wk-position-medium wk-slidenav-small <?php echo $testimonials['arrow_on_hover'] == 'yes'? 'wk-hidden-hover' : ''; ?> " href="#"  wk-slider-item="previous"><span wk-icon="arrow-left"></span></a>
                      <a class="<?php echo $testimonials['arrow_position'] == 'out'? 'wk-position-center-right-out' : 'wk-position-center-right'; ?> wk-position-medium  wk-slidenav-small <?php echo $testimonials['arrow_on_hover'] == 'yes'? 'wk-hidden-hover' : ''; ?>  " href="#" wk-slider-item="next"><span wk-icon="arrow-right"></span></a>
                  </div>
           
                <?php endif; ?>

            </div>

                <?php if ($testimonials['dot_enable']):?>
                    <ul class="wk-slider-nav wk-dotnav wk-flex-<?php echo $testimonials['dot_nav_align'];?> wk-margin-medium-top"></ul>
                <?php endif; ?>

        </div>

