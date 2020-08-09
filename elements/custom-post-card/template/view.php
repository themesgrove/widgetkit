<?php
    use Elementor\Icons_Manager;
    $settings = $this->get_settings();
    $wkfe_cpt_grid = widgetkit_for_elementor_array_get($settings, 'wkfe_cpt_grid');
    $wkfe_cpt_grid_tablet = widgetkit_for_elementor_array_get($settings, 'wkfe_cpt_grid_tablet');
    $wkfe_cpt_grid_mobile = widgetkit_for_elementor_array_get($settings, 'wkfe_cpt_grid_mobile');
    $wkfe_selected_cpt = widgetkit_for_elementor_array_get($settings, 'wkfe_selected_cpt');
    $cpt_thumbnail_key = widgetkit_for_elementor_array_get($settings, 'cpt_thumbnail_key');
    $cpt_thumbnail_alternative_key = widgetkit_for_elementor_array_get($settings, 'cpt_thumbnail_alternative_key');
    
?>

    <div class="wkfe-custom-post-card">
        <div id="wkfe-custom-post-card-<?php echo $this->get_id(); ?>" class="wkfe-custom-post-card-wrapper wkfe-custom-post-card-<?php echo $this->get_id(); ?>">
            
            <div class="wkfe-grid <?php echo 'grid-'.$wkfe_cpt_grid; ?> <?php echo 'grid-tablet-'.$wkfe_cpt_grid_tablet; ?> <?php echo 'grid-mobile-'.$wkfe_cpt_grid_mobile; ?> wkfe-custom-post-card-content-wrapper" style="">
                <?php 
                    $posts = get_posts(
                        array(
                            'post_type'   => $wkfe_selected_cpt,
                            'post_status' => 'publish',
                            'posts_per_page' => -1,
                            'fields' => 'ids'
                        )
                    );
                    if($posts):
                        foreach($posts as $p): 
                            $thumbnail = $cpt_thumbnail_key ? get_post_meta($p, $cpt_thumbnail_key, true) : null ;
                            $thumbnail_alternative = $cpt_thumbnail_alternative_key ? get_post_meta($p, $cpt_thumbnail_alternative_key, true) : null;
                        ?>
                            <div class="card-wrapper">
                                <div class="card-thumb">
                                    <?php if($thumbnail): ?>
                                        <?php $is_valid_url = filter_var($thumbnail, FILTER_VALIDATE_URL); ?>
                                        <?php if($is_valid_url): ?>
                                            <iframe src="<?php echo $thumbnail; ?>" frameborder="0"></iframe>
                                            <?php else: ?>
                                            <div class="thumb-wrapper">
                                                <?php echo $thumbnail; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php elseif($thumbnail_alternative): ?>
                                        <?php $is_valid_url = filter_var($thumbnail_alternative, FILTER_VALIDATE_URL); ?>
                                        <?php if($is_valid_url): ?>
                                            <iframe src="<?php echo $thumbnail_alternative; ?>" frameborder="0"></iframe>
                                            <?php else: ?>
                                            <div class="thumb-wrapper">
                                                <?php echo $thumbnail_alternative; ?>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="card-title">
                                    <?php echo get_the_title($p); ?>
                                </div>
                            </div>
                        <?php endforeach;
                    else:
                        echo 'No Posts';
                    endif;
                ?>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        jQuery(function($){
            if(!$('body').hasClass('wkfe-custom-post-card')){
                $('body').addClass('wkfe-custom-post-card');
            }
        });
    </script>