<?php
use Elementor\Group_Control_Image_Size;
?>
<div class="wk-flex wk-flex-center wk-grid-match">
    <div class="wk-card wk-card-default wk-testimonial-4 wk-padding-large">
        <?php if($testimonial['testimonial_thumb_image']['url']):?>
            <?php if($testimonials['thumbnail_position_vertical'] == 'top'): ;?>
                <div class="wk-card-media-top wk-overflow-hidden wk-padding-bottom">
                <?php if($testimonial['testimonial_thumb_image']['id']): ?>
                    <img src="<?php echo esc_url(Group_Control_Image_Size::get_attachment_image_src($testimonial['testimonial_thumb_image']['id'], 'testimonial_image', $testimonials )); ?>" alt="<?php echo esc_attr($testimonial['testimonial_title']); ?>">
                <?php else:?>
                    <img src="<?php echo esc_url($testimonial['testimonial_thumb_image']['url']);?>" alt="<?php echo esc_attr($testimonial['testimonial_title']); ?>">  
                <?php endif;?>  
                </div>
            <?php endif; ?> 
        <?php endif; ?>

        <div class="wk-card-body wk-padding-remove">
        <?php if($testimonial['testimonial_thumb_image']['url'] && $testimonials['thumbnail_position_vertical'] == 'top'):?>
            <div></div>
        <?php else: ?>
            <div class="wk-position-absolute quote" wk-icon="quote-right"></div>
        <?php endif; ?>
            <?php if ($testimonial['testimonial_content']): ?>
                <div class="wk-position-relative wk-text-normal">
                <?php echo esc_html($testimonial['testimonial_content']); ?>
                    
                </div>
            <?php endif; ?>

            <?php if($testimonial['testimonial_thumb_image']['url']):?>
                <?php if($testimonials['thumbnail_position_vertical'] == 'bottom'):?>
            
                <div class="wk-card-media-bottom wk-overflow-hidden">
                <?php if($testimonial['testimonial_thumb_image']['id']): ?>
                    <img src="<?php echo esc_url(Group_Control_Image_Size::get_attachment_image_src($testimonial['testimonial_thumb_image']['id'], 'testimonial_image', $testimonials )); ?>" alt="<?php echo esc_attr($testimonial['testimonial_title']); ?>">
                <?php else:?>
                    <img src="<?php echo esc_url($testimonial['testimonial_thumb_image']['url']);?>" alt="<?php echo esc_attr($testimonial['testimonial_title']); ?>">  
                <?php endif;?>  
                </div>
                <?php endif; ?> 
            <?php endif; ?> 

            <?php if ($testimonial['testimonial_designation']): ?>
                <?php if ($testimonials['designation_position'] == 'vertical_top'): ?>
                    <span class="wk-text-meta wk-inline-block top"><?php echo esc_html($testimonial['testimonial_designation']); ?></span>
                <?php endif; ?>
            <?php endif; ?>

            <?php if ($testimonial['testimonial_title']): ?>
                <h4 class="wk-card-title wk-margin-remove">
                    <?php if ($testimonial['content_demo_link']): ?>
                        <a href="<?php echo esc_url($testimonial['content_demo_link']['url']); ?>" <?php echo esc_attr($testimonial['content_demo_link']['is_external']) ? 'target="_blank"' : '"rel="nofollow"'; ?>><?php echo esc_html($testimonial['testimonial_title']); ?></a>
                    <?php else: ?>
                            <?php echo esc_html($testimonial['testimonial_title']); ?>
                    <?php endif; ?> 
                    
                    <?php if ($testimonial['testimonial_designation']): ?>
                        <?php if ($testimonials['designation_position'] == 'horizontal_right'): ?>
                            <span class="wk-text-meta wk-inline-block right"><?php echo esc_html($testimonial['testimonial_designation']); ?></span>
                        <?php endif; ?>
                    <?php endif; ?>
                </h4>  
            <?php endif; ?>

            <?php if ($testimonial['testimonial_designation']): ?>
                <?php if ($testimonials['designation_position'] == 'vertical_bottom'): ?>
                    <span class="wk-text-meta wk-inline-block bottom"><?php echo esc_html($testimonial['testimonial_designation']); ?></span>
                <?php endif; ?>
            <?php endif; ?>
        </div>
    
    </div>
</div>