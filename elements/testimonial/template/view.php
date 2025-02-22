<?php
use Elementor\Group_Control_Image_Size;
$testimonials = $settings = $this->get_settings(); 
$id = $this->get_id();
?>

<div class="wk-testimonial" wk-slider="center:<?php echo esc_attr($testimonials['center_mode_enable']) == 'yes'? 'true' :'false'; ?>; sets:<?php echo esc_attr($testimonials['set_mode_enable']) == 'yes'? 'true' :'false'; ?>; autoplay:<?php echo esc_attr($testimonials['autoplay_mode_enable']) == 'yes'? 'true' :'false'; ?>; autoplay-interval:<?php echo esc_attr($testimonials['content_interval_option']);?>;">

    <div class="wk-visible-toggle wk-light <?php echo esc_attr($testimonials['arrow_position']) == 'in'? 'wk-position-relative' : '' ;?>" tabindex="-1">

        <?php if ($testimonials['center_mode_enable'] == 'yes'): ?>
            <div class="wk-grid-<?php echo esc_attr($testimonials['column_gap'])?> wk-slider-items wk-child-width-1-2@s" wk-grid>
        <?php else: ?>
            <div class="wk-grid-<?php echo esc_attr($testimonials['column_gap']);?> wk-slider-items wk-flex wk-child-width-1-<?php echo esc_attr($testimonials['item_column']);?>@m wk-child-width-1-1@s wk-child-width-1-<?php echo esc_attr($testimonials['item_column']);?>@l" wk-grid>
        <?php endif; ?>

            <?php 
                foreach ( $testimonials['testimonial_content'] as $testimonial ) : 
                    if ($testimonials['item_styles'] == 'screen_1'):
                        require WK_PATH . '/elements/testimonial/template/layout/layout-1.php';
                    elseif($testimonials['item_styles'] == 'screen_2'):
                        require WK_PATH . '/elements/testimonial/template/layout/layout-2.php';
                    elseif($testimonials['item_styles'] == 'screen_3'): 
                        require WK_PATH . '/elements/testimonial/template/layout/layout-3.php';
                    elseif($testimonials['item_styles'] == 'screen_4'):
                        require WK_PATH . '/elements/testimonial/template/layout/layout-4.php';    
                    elseif($testimonials['item_styles'] == 'screen_5'): 
                        require WK_PATH . '/elements/testimonial/template/layout/layout-5.php';
                    else: 
                        require WK_PATH . '/elements/testimonial/template/layout/default.php';
                    endif; 
                endforeach;
            ?>
        </div> <!-- conditional div   -->

        <?php if ($testimonials['arrow_enable'] == 'yes'):?>
            <div class="wk-slide-nav">
                <a class=" <?php echo esc_attr($testimonials['arrow_position']) == 'out'? 'wk-position-center-left-out' : 'wk-position-center-left'; ?> wk-position-medium wk-slidenav-small <?php echo esc_attr($testimonials['arrow_on_hover']) == 'yes'? 'wk-hidden-hover' : ''; ?> " href="#"  wk-slider-item="previous"><span wk-icon="arrow-left"></span></a>
                <a class="<?php echo esc_attr($testimonials['arrow_position']) == 'out'? 'wk-position-center-right-out' : 'wk-position-center-right'; ?> wk-position-medium  wk-slidenav-small <?php echo esc_attr($testimonials['arrow_on_hover']) == 'yes'? 'wk-hidden-hover' : ''; ?>  " href="#" wk-slider-item="next"><span wk-icon="arrow-right"></span></a>
            </div>
        <?php endif; ?>

    </div>

    <?php if ($testimonials['dot_enable'] == 'yes'):?>
        <ul class="wk-slider-nav wk-dotnav wk-flex-<?php echo esc_attr($testimonials['dot_nav_align']);?> wk-margin-medium-top"></ul>
    <?php endif; ?>

</div>
<script>
    jQuery(function($){
        if(!$('body').hasClass('wk-testimonial')){
            $('body').addClass('wk-testimonial');
        }
    });
</script>


