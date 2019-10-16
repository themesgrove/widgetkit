<?php
    $contents = $settings = $this->get_settings();
    $id = $this->get_id();?>

        <div class="content-carousel" wk-slider="center:<?php echo $contents['center_mode_enable'] == 'yes'? 'true' :'false'; ?>">
            <div class="wk-visible-toggle wk-light" tabindex="-1">
                <?php if ($contents['center_mode_enable'] == 'yes'): ?>
                    <ul class="wk-grid-small wk-slider-items wk-child-width-1-2@s wk-grid">
                <?php else: ?>
                      <ul class="wk-grid-small wk-slider-items wk-flex wk-child-width-1-<?php echo $contents['item_column'];?>@m wk-child-width-1-1@s wk-child-width-1-<?php echo $contents['item_column'];?>@l">
                <?php endif; ?>
                    <?php if ($contents['item_option'] == 'custom_post'): ?>
                        <?php foreach ( $contents['custom_content'] as $content ) : ?>
                             <li class="wk-flex wk-flex-center wk-grid-match">
                                <div class="wk-card wk-card-default wk-margin-small-right wk-margin-small-bottom">
                                    <?php if($content['content_thumb_image']):?>
                                        <?php if($contents['thumbnail_position'] == 'top'): ;?>
                                            <div class="wk-card-media-top">
                                                <a href="<?php echo $content['content_demo_link']; ?>">
                                                    <img src="<?php echo $content['content_thumb_image']['url'];?>" alt="<?php echo $content['content_title']; ?>">  
                                                </a> 
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?> 

                                    <div class="wk-card-body">
                                        <?php if ($content['content_meta']): ?>
                                            <span class="wk-text-meta wk-inline-block"><?php echo $content['content_meta']; ?></span>
                                        <?php endif; ?>
                                        <?php if ($content['content_title']): ?>
                                            <h3 class="wk-card-title wk-margin-remove">
                                                <?php if ($content['content_demo_link']): ?>
                                                     <a href="<?php echo $content['content_demo_link']; ?>"><?php echo $content['content_title']; ?></a>
                                                <?php else: ?>
                                                        <?php echo $content['content_title']; ?>
                                                <?php endif; ?>  
                                            </h3>  
                                        <?php endif; ?>
                                        <?php if ($content['content_content']): ?>
                                            <p class=" wk-margin-small-bottom"><?php echo $content['content_content']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    
                                    <?php if($contents['thumbnail_position'] == 'bottom'):?>
                                        <div class="wk-card-media-bottom">
                                            <a href="<?php echo $content['content_demo_link']; ?>">
                                                <img src="<?php echo $content['content_thumb_image']['url'];?>" alt="<?php echo $content['content_title']; ?>">  
                                            </a> 
                                        </div>
                                    <?php endif; ?> 
                                </div>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                            <?php
                                $content = array(
                                    'post_type' => 'post',
                                    'order' => $contents['items_order'],
                                    'orderby' => $contents['items_orderby'],
                                    'post_status'       => 'publish',
                                    'posts_per_page'    =>$contents['post_show'],
                                    'ignore_sticky_posts' => 1
                                );
                                $content_query = new WP_Query( $content );
                                if($content_query->have_posts()):
                                    while($content_query->have_posts()): 
                                        $content_query->the_post(); 
                            ?>
                            <li class="wk-flex wk-flex-center wk-grid-match">
                                <div class="wk-card wk-card-default wk-margin-small-right wk-margin-small-bottom">
                                  <?php if ( has_post_thumbnail() ): ?>
                                        <?php if($contents['thumbnail_position'] == 'top'): ;?>
                                            <div class="wk-card-media-top">
                                                <a href="<?php the_permalink();?>">
                                                    <?php the_post_thumbnail($contents['thumbnail_size']);?> 
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="wk-card-body">

                                        <?php if (has_category()):?>
                                            <span class="wk-text-meta wk-inline-block"><?php the_category(', ') ?></span>

                                        <?php endif; ?>
                                        <h3 class="wk-card-title wk-margin-remove">    
                                            <a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $contents['title_word'], ' ' );?>    
                                            </a>

                                        </h3>
                                        <?php if ( $contents['content_enable'] == 'yes' ): ?>
                                            <p class="wk-margin-small-bottom">
                                                <?php echo wp_trim_words( get_the_content(), $contents['content_word'], ' ' );?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($contents['thumbnail_position'] == 'bottom'): ;?>
                                        <div class="wk-card-media-bottom">
                                            <a href="<?php the_permalink();?>">
                                                <?php the_post_thumbnail($contents['thumbnail_size']);?> 
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                     <?php  endwhile; endif; wp_reset_postdata(); ?>
                    <?php endif; ?>
                </ul>
                <?php if ($contents['arrow_enable']):?>
                    <a class=" <?php echo $contents['arrow_position'] == 'out'? 'wk-position-center-left-out' : 'wk-position-center-left'; ?> wk-position-medium wk-slidenav-small" href="#" wk-slidenav-previous wk-slider-item="previous"></a>
                    <a class="<?php echo $contents['arrow_position'] == 'out'? 'wk-position-center-right-out' : 'wk-position-center-right'; ?> wk-position-medium  wk-slidenav-small" href="#" wk-slidenav-next wk-slider-item="next"></a>
                <?php endif; ?>

            </div>
                <?php if ($contents['dot_enable']):?>
                    <ul class="wk-slider-nav wk-dotnav wk-flex-center wk-margin-medium-top"></ul>
                <?php endif; ?>

        </div>

