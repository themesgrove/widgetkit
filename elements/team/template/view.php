<?php
// Silence is golden.
    $team = $this->get_settings();

?>

    <div class="wk-team">
        <?php if ($team['item_styles'] == '1'):?>
            <div class="wk-card wk-card-default style-1">
                <div class="wk-card-media-top wk-overflow-hidden">
                    <?php if( $team['single_content_link']):?>
                        <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                            <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                        </a>
                    <?php else: ?>
                        <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                    <?php endif; ?>
                </div> <!-- wk-card-image -->

                 <div class="wk-card-body">
                    <div class="wk-grid-small wk-flex-middle" wk-grid>
                        <?php if( $team['single_title']):?>
                            <div class="wk-width-expand">
                                <<?php echo $team['header_tag'];?> class="wk-card-title wk-margin-remove">
                                    <?php if( $team['single_content_link']):?>
                                        <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                            <?php echo $team['single_title']; ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo $team['single_title']; ?>
                                    <?php endif; ?>
                                </<?php echo $team['header_tag'];?>>
                            </div> <!-- wk-width-expand-->
                        <?php endif; ?>

                        <?php if( $team['social_share']):?>
                            <div class="wk-width-auto social-icons">
                                <?php foreach ( $team['social_share'] as $social ) : ?>
                                    <a href="<?php echo $social['social_link']['url']; ?>" 
                                        <?php echo $social['social_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                        
                                        <?php 
                                            $icon = explode(" ", $social['social_icon']);
                                            $social_name = explode('-', $icon['1']);
                                         ?>
                                        <span wk-icon="<?php echo $social_name[1]; ?>"></span>
                                    </a>
                                <?php endforeach; ?>
                            </div> <!-- wk-width-auto-->
                        <?php endif; ?>
                    </div>
                
                    <?php if( $team['single_designation']):?>
                        <span class="wk-card-designation wk-inline-block"><?php echo $team['single_designation']; ?></span>
                    <?php endif; ?>
                    <?php if( $team['single_content']):?>
                        <p class="wk-text-normal wk-margin-small"><?php echo $team['single_content']; ?></p>
                    <?php endif; ?>
                </div> <!-- wk-card-body -->
            </div> <!-- wk-card-->


            <?php elseif($team['item_styles'] == '2'): ?>
                <div class="wk-card wk-card-default style-2">
                    <div class="wk-card-media-top wk-overflow-hidden">
                        <?php if( $team['single_content_link']):?>
                            <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                            </a>
                        <?php else: ?>
                            <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                        <?php endif; ?>
                    </div> <!-- wk-card-image -->

                     <div class="wk-card-body">
                        <?php if( $team['single_title']):?>
                            <<?php echo $team['header_tag'];?> class="wk-card-title wk-margin-remove">
                                <?php if( $team['single_content_link']):?>
                                    <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                        <?php echo $team['single_title']; ?>
                                    </a>
                                <?php else: ?>
                                    <?php echo $team['single_title']; ?>
                                <?php endif; ?>
                            </<?php echo $team['header_tag'];?>>
                        <?php endif; ?>

                        <?php if( $team['single_designation']):?>
                            <span class="wk-card-designation wk-inline-block"><?php echo $team['single_designation']; ?></span>
                        <?php endif; ?>

                        <?php if( $team['social_share']):?>
                            <div class="social-icons">
                                <?php foreach ( $team['social_share'] as $social ) : ?>
                                    <a href="<?php echo $social['social_link']['url']; ?>" 
                                        <?php echo $social['social_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                        
                                        <?php 
                                            $icon = explode(" ", $social['social_icon']);
                                            $social_name = explode('-', $icon['1']);
                                         ?>
                                        <span wk-icon="<?php echo $social_name[1]; ?>"></span>
                                    </a>
                                <?php endforeach; ?>
                            </div> <!-- wk-width-auto-->
                        <?php endif; ?>

                        <?php if( $team['single_content']):?>
                            <p class="wk-text-normal wk-margin-small"><?php echo $team['single_content']; ?></p>
                        <?php endif; ?>
                    </div> <!-- wk-card-body -->
                </div> <!-- wk-card-->



            <?php elseif($team['item_styles'] == '3'): ?>
                <div class="wk-card uk-card-default wk-grid-collapse uk-child-width-1-2@s wk-margin style-3 wk-flex-middle" wk-grid>
                    <div class="wk-card-media-left wk-cover-container">
                        <?php if( $team['single_content_link']):?>
                            <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                            </a>
                        <?php else: ?>
                            <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                        <?php endif; ?>
                    </div> <!-- wk-card-image -->
                    <div>
                         <div class="wk-card-body">
                            <?php if( $team['single_title']):?>
                                <<?php echo $team['header_tag'];?> class="wk-card-title wk-margin-remove">
                                    <?php if( $team['single_content_link']):?>
                                        <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                            <?php echo $team['single_title']; ?>
                                        </a>
                                    <?php else: ?>
                                        <?php echo $team['single_title']; ?>
                                    <?php endif; ?>
                                </<?php echo $team['header_tag'];?>>
                            <?php endif; ?>

                            <?php if( $team['single_designation']):?>
                                <span class="wk-card-designation wk-inline-block"><?php echo $team['single_designation']; ?></span>
                            <?php endif; ?>

                            <?php if( $team['single_content']):?>
                                <p class="wk-text-normal wk-margin-small"><?php echo $team['single_content']; ?></p>
                            <?php endif; ?>
                            <?php if( $team['social_share']):?>
                                <div class="social-icons">
                                    <?php foreach ( $team['social_share'] as $social ) : ?>
                                        <a href="<?php echo $social['social_link']['url']; ?>" 
                                            <?php echo $social['social_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                            
                                            <?php 
                                                $icon = explode(" ", $social['social_icon']);
                                                $social_name = explode('-', $icon['1']);
                                             ?>
                                            <span wk-icon="<?php echo $social_name[1]; ?>"></span>
                                        </a>
                                    <?php endforeach; ?>
                                </div> <!-- wk-width-auto-->
                            <?php endif; ?>
                        </div> <!-- wk-card-body -->
                    </div>
                </div> <!-- wk-card-->

            <?php else: ?>
                <div class="wk-card wk-card-default">
                    <div class="wk-card-media-top wk-overflow-hidden">
                        <?php if( $team['single_content_link']):?>
                            <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                            </a>
                        <?php else: ?>
                            <img src="<?php echo $team['single_image']['url']; ?>" alt="">
                        <?php endif; ?>
                    </div> <!-- wk-card-image -->

                     <div class="wk-card-body">
                        <div class="wk-grid-small wk-flex-middle" wk-grid>
                            <?php if( $team['single_title']):?>
                                <div class="wk-width-expand">
                                    <<?php echo $team['header_tag'];?> class="wk-card-title wk-margin-remove">
                                        <?php if( $team['single_content_link']):?>
                                            <a class="wk-display-block" href="<?php echo $team['single_content_link']['url']; ?>" <?php echo $team['single_content_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                                <?php echo $team['single_title']; ?>
                                            </a>
                                        <?php else: ?>
                                            <?php echo $team['single_title']; ?>
                                        <?php endif; ?>
                                    </<?php echo $team['header_tag'];?>>
                                </div> <!-- wk-width-expand-->
                            <?php endif; ?>

                            <?php if( $team['social_share']):?>
                                <div class="wk-width-auto social-icons">
                                    <?php foreach ( $team['social_share'] as $social ) : ?>
                                        <a href="<?php echo $social['social_link']['url']; ?>" 
                                            <?php echo $social['social_link']['is_external']? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                            
                                            <?php 
                                                $icon = explode(" ", $social['social_icon']);
                                                $social_name = explode('-', $icon['1']);
                                             ?>
                                            <span wk-icon="<?php echo $social_name[1]; ?>"></span>
                                        </a>
                                    <?php endforeach; ?>
                                </div> <!-- wk-width-auto-->
                            <?php endif; ?>
                        </div>
                    
                        <?php if( $team['single_designation']):?>
                            <span class="wk-card-designation wk-inline-block"><?php echo $team['single_designation']; ?></span>
                        <?php endif; ?>
                        <?php if( $team['single_content']):?>
                            <p class="wk-text-normal wk-margin-small"><?php echo $team['single_content']; ?></p>
                        <?php endif; ?>
                    </div> <!-- wk-card-body -->
                </div> <!-- wk-card-->
        <?php endif; ?>
    </div><!-- wk-grid-->
