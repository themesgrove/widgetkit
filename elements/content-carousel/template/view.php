<?php
    $contents = $settings = $this->get_settings();
    $id = $this->get_id();?>

        <?php if ($contents['item_layout']): ?>
            <div class="content-carousel" uk-slider="center: <?php echo $contents['item_layout'];?>">
        <?php else: ?>
            <div class="content-carousel" uk-slider="center:true">
        <?php endif; ?>
            <div class="uk-visible-toggle uk-light" tabindex="-1">
                <?php if ($contents['item_layout'] == 'false'): ?>
                    <ul class="uk-grid-small uk-slider-items uk-flex uk-child-width-1-<?php echo $contents['item_column'];?>@m uk-child-width-1-1@s uk-child-width-1-<?php echo $contents['item_column'];?>@l">
                <?php else: ?>
                    <ul class="uk-grid-small uk-slider-items uk-child-width-1-2@s uk-grid">
                <?php endif; ?>
                    <?php if ($contents['item_option'] == 'custom_post'): ?>
                        <?php foreach ( $contents['custom_content'] as $content ) : ?>
                             <li class="uk-flex uk-flex-center uk-grid-match">
                                <?php //if(apply_filters('wkpro_enabled', false)):?>
                                    <div class="uk-card uk-card-default uk-margin-small-right uk-margin-small-bottom">
                                <?php //else: ?>
                                    <!-- <div class="uk-card uk-margin-small-right uk-margin-small-bottom"> -->
                                <?php //endif; ?>
                                    <?php if($content['content_thumb_image']):?>
                                        <?php if($contents['thumbnail_position'] == 'top'): ;?>
                                            <div class="uk-card-media-top">
                                                <a href="<?php echo $content['content_demo_link']; ?>">
                                                    <img src="<?php echo $content['content_thumb_image']['url'];?>" alt="<?php echo $content['content_title']; ?>">  
                                                </a> 
                                            </div>
                                        <?php endif; ?> 
                                    <?php endif; ?> 
                                    

                                    <div class="uk-card-body">
                                        <?php if ($content['content_meta']): ?>
                                            <span class="uk-text-meta uk-inline-block"><?php echo $content['content_meta']; ?></span>
                                        <?php endif; ?>
                                        <?php if ($content['content_title']): ?>
                                            <h3 class="uk-card-title uk-margin-remove">
                                                <?php if ($content['content_demo_link']): ?>
                                                     <a href="<?php echo $content['content_demo_link']; ?>"><?php echo $content['content_title']; ?></a>
                                                <?php else: ?>
                                                        <?php echo $content['content_title']; ?>
                                                <?php endif; ?>  
                                            </h3>  
                                        <?php endif; ?>
                                        <?php if ($content['content_content']): ?>
                                            <p class=" uk-margin-small-bottom"><?php echo $content['content_content']; ?></p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($contents['thumbnail_position'] == 'bottom'):?>
                                        <div class="uk-card-media-bottom">
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
                            <li class="uk-flex uk-flex-center uk-grid-match">
                                <div class="uk-card uk-card-default uk-margin-small-right uk-margin-small-bottom">
                                  <?php if ( has_post_thumbnail() ): ?>
                                        <?php if($contents['thumbnail_position'] == 'top'): ;?>
                                            <div class="uk-card-media-top">
                                                <a href="<?php the_permalink();?>">
                                                    <?php the_post_thumbnail($contents['thumbnail_size']);?> 
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="uk-card-body">

                                        <?php if (has_category()):?>
                                            <span class="uk-text-meta uk-inline-block"><?php the_category(', ') ?></span>

                                        <?php endif; ?>
                                        <h3 class="uk-card-title uk-margin-remove">    
                                            <a href="<?php the_permalink();?>"><?php echo wp_trim_words( get_the_title(), $contents['title_word'], ' ' );?>    
                                            </a>

                                        </h3>
                                        <?php if ( $contents['content_enable'] == 'yes' ): ?>
                                            <p class="uk-margin-small-bottom">
                                                <?php echo wp_trim_words( get_the_content(), $contents['content_word'], ' ' );?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if($contents['thumbnail_position'] == 'bottom'): ;?>
                                        <div class="uk-card-media-bottom">
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
                    <a class=" <?php echo $contents['arrow_position'] == 'out'? 'uk-position-center-left-out' : 'uk-position-center-left'; ?> uk-position-medium uk-slidenav-small" href="#" uk-slidenav-previous uk-slider-item="previous"></a>
                    <a class="<?php echo $contents['arrow_position'] == 'out'? 'uk-position-center-right-out' : 'uk-position-center-right'; ?> uk-position-medium  uk-slidenav-small" href="#" uk-slidenav-next uk-slider-item="next"></a>
                <?php endif; ?>

            </div>
                <?php if ($contents['dot_enable']):?>
                    <ul class="uk-slider-nav uk-dotnav uk-flex-center uk-margin-medium-top"></ul>
                <?php endif; ?>

        </div>

