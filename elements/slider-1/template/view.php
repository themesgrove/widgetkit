<?php
// Silence pro 1
use Elementor\Utils;
$settings = $this->get_settings();
$id = $this->get_id();

?>
<div id="tgx-hero-unit" class="tgx-slider-1">
    <div id="<?php echo esc_attr($id); ?>" class="carousel slide" data-ride="carousel" data-interval="
             <?php if ($settings['slider_interval']) :
                    echo esc_attr($settings['slider_interval']);
                endif; ?>" <?php echo esc_attr($settings['slider_data_pause'] == 'yes') ? '' : 'data-pause="false"'; ?>>
        <?php if ($settings['dot_enable_1']) : ?>
            <!-- Indicators -->
            <ol class="carousel-indicators">
                <?php for ($i = 0; $i < count($settings['slider_option']); $i++) :
                    $active = $i == 0 ? 'active' : ''; ?>
                    <li data-target="#<?php echo esc_attr($id); ?>" data-slide-to="<?php echo esc_attr($i); ?>" class="<?php echo esc_attr($active); ?>"></li>
                <?php endfor; ?>
            </ol>
        <?php endif; ?>
        <!-- Wrapper for slides -->
        <div class="carousel-inner ">
            <?php $i = 0; ?>
            <?php foreach ($settings['slider_option'] as $slider) : ?>
                <?php $active = $i == 0 ? 'active' : ''; ?>
                <div class="item <?php echo esc_attr($active); ?> slider-<?php echo esc_attr($i); ?>" style="background-image: url('<?php echo esc_url($slider['slider_image']['url']); ?>');">

                    <div class="carousel-caption ">
                        <?php if ($slider['title']) :
                            $this->add_render_attribute("title", "class", "slider-title animated animate-delay-1 {$slider['title_animation']}");

                            $title_html = esc_html($slider['title']);
                            $html = sprintf(
                                '<%1$s %2$s>%3$s</%1$s>',
                                Utils::validate_html_tag($settings['heading_tag']),
                                $this->get_render_attribute_string('title'),
                                $title_html
                            );

                            Utils::print_unescaped_internal_string($html);
                        endif;
                        ?>

                        <?php if ($slider['slider_content']) : ?>
                            <p class="slider-description animated animate-delay-2
                                    <?php echo esc_attr($slider['content_animation']); ?> ">
                                <?php echo esc_html($slider['slider_content']); ?>
                            </p>
                            <?php
                            //$shortcode = $slider['slider_content'];
                            //echo do_shortcode($shortcode);

                            ?>
                        <?php endif; ?>

                        <?php if ($slider['btn_text']) : ?>
                            <span class="slider-action">
                                <a class="btn btn-slider animated animate-delay-3 <?php echo esc_attr($slider['btn_animation']); ?>" href="<?php echo esc_url($slider['btn_link']['url']); ?>"> <?php echo esc_html($slider['btn_text']); ?>
                                </a>
                            </span>
                        <?php endif; ?>

                    </div>
                </div><!-- /.item -->

            <?php $i++;
            endforeach; ?>

        </div> <!-- /.inner -->
        <?php if ($settings['arrow_enable_1']) : ?>
            <a class="hidden-xs left carousel-control" href="#<?php echo esc_attr($id); ?>" data-slide="prev">
                <i class="fas fa-long-arrow-alt-left"></i>
            </a>
            <a class="hidden-xs right carousel-control" href="#<?php echo esc_attr($id); ?>" data-slide="next">
                <i class="fas fa-long-arrow-alt-right "></i>
            </a>
        <?php endif; ?>
    </div><!-- /.id -->
</div> <!-- /#hero-unit -->

<script type="text/javascript">
    jQuery(function($) {
        if (!$('body').hasClass('wk-slider-1')) {
            $('body').addClass('wk-slider-1');
        }
    });
</script>