<?php

use Elementor\Utils;
use Elementor\Group_Control_Image_Size;

$contents = $settings = $this->get_settings();
$id = $this->get_id();
?>

<div class="content-carousel" wk-slider="center:<?php echo esc_attr($contents['center_mode_enable']) == 'yes' ? 'true' : 'false'; ?>; sets:<?php echo esc_attr($contents['set_mode_enable']) == 'yes' ? 'true' : 'false'; ?>; autoplay:<?php echo esc_attr($contents['autoplay_mode_enable']) == 'yes' ? 'true' : 'false'; ?>; autoplay-interval:<?php echo esc_attr($contents['content_interval_option']); ?>;">
    <div class="wk-visible-toggle wk-light <?php echo esc_attr($contents['arrow_position']) == 'in' ? 'wk-position-relative' : ' '; ?> " tabindex="-1">
        <?php if ($contents['center_mode_enable'] == 'yes') : ?>
            <ul class="wk-grid-<?php echo esc_attr($contents['column_gap']); ?> wk-slider-items wk-child-width-1-2@s" wk-grid>
            <?php else : ?>
                <ul class="wk-grid-<?php echo esc_attr($contents['column_gap']); ?> 
                      wk-slider-items 
                      wk-child-width-1-<?php echo esc_attr($contents['item_column']); ?>@l
                      wk-child-width-1-<?php echo esc_attr(is_int($contents['item_column_tablet'])) ? esc_attr($contents['item_column_tablet']) : 2; ?>@m 
                      wk-child-width-1-<?php echo esc_attr(is_int($contents['item_column_mobile'])) ? esc_attr($contents['item_column_mobile']) : 1; ?>@s" wk-grid>
                <?php endif; ?>
                <?php if ($contents['item_option'] == 'custom_post') : ?>
                    <?php foreach ($contents['custom_content'] as $content) : ?>
                        <li class="wk-flex wk-flex-center wk-grid-match">
                            <div class="wk-card <?php echo esc_attr($content['content_meta']) || $content['content_title'] || $content['content_content'] ? 'wk-card-default' : ''; ?> wk-margin-small-bottom">
                                <?php if ($content['content_thumb_image']['url']) : ?>
                                    <?php if ($contents['thumbnail_position'] == 'top') :; ?>
                                        <div class="wk-card-media-top wk-overflow-hidden">
                                            <a class="wk-display-block" href="<?php echo esc_url($content['content_demo_link']['url']); ?>" <?php echo esc_attr($content['content_demo_link']['is_external']) ? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                                <?php if ($content['content_thumb_image']['id']) : ?>
                                                    <img src="<?php echo esc_url(Group_Control_Image_Size::get_attachment_image_src($content['content_thumb_image']['id'], 'cc_image', $contents)); ?>" alt="<?php echo esc_attr($content['content_title']); ?>">
                                                <?php else : ?>
                                                    <img src="<?php echo esc_url($content['content_thumb_image']['url']); ?>" alt="<?php echo esc_attr($content['content_title']); ?>">
                                                <?php endif; ?>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if ($content['content_meta'] || $content['content_title'] || $content['content_content']) : ?>
                                    <div class="wk-card-body">
                                        <?php if ($content['content_meta']) : ?>
                                            <span class="wk-text-meta wk-inline-block"><?php echo esc_html($content['content_meta']); ?></span>
                                        <?php endif; ?>
                                        <?php
                                        if ($content['content_title']) {
                                            $this->add_render_attribute('content_title', 'class', 'wk-card-title wk-margin-remove');
                                            $this->add_inline_editing_attributes('content_title', 'none');

                                            $title_html = esc_html($content['content_title']);
                                            if (!empty($content['content_demo_link']['url'])) {
                                                $title_html = '<a ' . $this->get_render_attribute_string(' link') . '>' . $title_html . '</a>';
                                            }
                                            $html = sprintf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                Utils::validate_html_tag($settings['custom_header_tag']),
                                                $this->get_render_attribute_string('content_title'),
                                                $title_html
                                            );

                                            Utils::print_unescaped_internal_string($html);
                                        }
                                        ?>

                                        <?php if ($content['content_content']) : ?>
                                            <p class=" wk-margin-small-bottom"><?php echo esc_html($content['content_content']); ?></p>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($contents['thumbnail_position'] == 'bottom') : ?>
                                    <div class="wk-card-media-bottom wk-overflow-hidden">
                                        <a class="wk-display-block" href="<?php echo esc_url($content['content_demo_link']['url']); ?>" <?php echo esc_attr($content['content_demo_link']['is_external']) ? 'target="_blank"' : '"rel="nofollow"'; ?>>
                                            <?php if ($content['content_thumb_image']['id']) : ?>
                                                <img src="<?php echo esc_url(Group_Control_Image_Size::get_attachment_image_src($content['content_thumb_image']['id'], 'cc_image', $contents)); ?>" alt="<?php echo esc_attr($content['content_title']); ?>">
                                            <?php else : ?>
                                                <img src="<?php echo esc_url($content['content_thumb_image']['url']); ?>" alt="<?php echo esc_html($content['content_title']); ?>">
                                            <?php endif; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                            </div>
                        </li>
                    <?php endforeach; ?>
                <?php else : ?>
                    <?php
                    $content = array(
                        'post_type' => 'post',
                        'category__in' => $contents['cat_multiple_id'],
                        'order' => $contents['items_order'],
                        'orderby' => $contents['items_orderby'],
                        'post_status'       => 'publish',
                        'posts_per_page'    => $contents['post_show'],
                        'ignore_sticky_posts' => 1
                    );
                    $content_query = new WP_Query($content);
                    if ($content_query->have_posts()) :
                        while ($content_query->have_posts()) :
                            $content_query->the_post();
                    ?>
                            <li class="wk-flex wk-flex-center wk-grid-match">
                                <div class="wk-card wk-card-default wk-margin-small-bottom">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php if ($contents['thumbnail_position'] == 'top') :; ?>
                                            <div class="wk-card-media-top wk-overflow-hidden">
                                                <a class="wk-display-block" href="<?php the_permalink(); ?>">
                                                    <?php //the_post_thumbnail($contents['thumbnail_size']);
                                                    ?>
                                                    <img src="<?php echo esc_url(Group_Control_Image_Size::get_attachment_image_src(get_post_thumbnail_id(), 'cc_image', $contents)); ?>" alt="<?php the_title(); ?>">
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <div class="wk-card-body">
                                        <?php if ($contents['meta_enable'] == 'yes') : ?>
                                            <?php if (has_category()) : ?>
                                                <span class="wk-text-meta wk-inline-block"><?php the_category(', ') ?></span>
                                            <?php endif; ?>

                                        <?php endif; ?>

                                        <?php
                                        if ($contents['title_word']) {
                                            $this->add_render_attribute('title_word', 'class', 'wk-card-title wk-margin-remove');
                                            $this->add_inline_editing_attributes('title_word', 'none');

                                            $title_html = esc_html($contents['title_word']);
                                            if (!empty($contents['content_demo_link']['url'])) {
                                                $title_html = '<a ' . $this->get_render_attribute_string(' link') . '>' . $title_html . '</a>';
                                            }
                                            $html = sprintf(
                                                '<%1$s %2$s>%3$s</%1$s>',
                                                Utils::validate_html_tag($settings['post_header_tag']),
                                                $this->get_render_attribute_string('title_word'),
                                                $title_html
                                            );

                                            Utils::print_unescaped_internal_string($html);
                                        }
                                        ?>
                                        <?php if ($contents['content_enable'] == 'yes') : ?>
                                            <p class="wk-margin-small-bottom">
                                                <?php echo esc_html(wp_trim_words(get_the_content(), $contents['content_word'], ' ')); ?>
                                            </p>
                                        <?php endif; ?>
                                    </div>
                                    <?php if ($contents['thumbnail_position'] == 'bottom') :; ?>
                                        <div class="wk-card-media-bottom wk-overflow-hidden">
                                            <a class="wk-display-block" href="<?php the_permalink(); ?>">
                                                <?php //the_post_thumbnail($contents['thumbnail_size']);
                                                ?>
                                                <img src="<?php echo esc_url(Group_Control_Image_Size::get_attachment_image_src(get_post_thumbnail_id(), 'cc_image', $contents)); ?>" alt="<?php the_title(); ?>">
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </li>
                    <?php endwhile;
                    endif;
                    wp_reset_postdata(); ?>
                <?php endif; ?>
                </ul>
                <?php if ($contents['arrow_enable'] == 'yes') : ?>
                    <a class=" <?php echo esc_attr($contents['arrow_position']) == 'out' ? 'wk-position-center-left-out' : 'wk-position-center-left'; ?> wk-position-medium wk-slidenav-small <?php echo esc_attr($contents['arrow_on_hover']) == 'yes' ? 'wk-hidden-hover' : ''; ?> " href="#" wk-slidenav-previous wk-slider-item="previous"></a>
                    <a class="<?php echo esc_attr($contents['arrow_position']) == 'out' ? 'wk-position-center-right-out' : 'wk-position-center-right'; ?> wk-position-medium  wk-slidenav-small <?php echo esc_attr($contents['arrow_on_hover']) == 'yes' ? 'wk-hidden-hover' : ''; ?>  " href="#" wk-slidenav-next wk-slider-item="next"></a>
                <?php endif; ?>

    </div>
    <?php if ($contents['dot_enable'] == 'yes') : ?>
        <ul class="wk-slider-nav wk-dotnav wk-flex-<?php echo esc_attr($contents['dot_nav_align']); ?> wk-margin-medium-top"></ul>
    <?php endif; ?>

</div>

<script>
    jQuery(function($) {
        if (!$('body').hasClass('wk-content-carousel')) {
            $('body').addClass('wk-content-carousel');
        }
    });
</script>