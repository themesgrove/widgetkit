<?php

use Elementor\Icons_Manager;
use Elementor\Plugin;

$settings = $this->get_settings_for_display();
$tabs = $settings['tabs'] ?? [];
$id_int = substr($this->get_id_int(), 0, 3);

?>
<div class="wk-adv-tab-wrapper nav-pos-<?php echo esc_attr( $settings['nav_position'] ?? 'top' ); ?> nav-icon-pos-<?php echo esc_attr( $settings['nav_icon_position'] ?? 'left' ); ?> nav-align-<?php echo esc_attr( $settings['tab_nav_align'] ?? 'center' ); ?> <?php echo esc_attr( $settings['enable_tab_accordian_switcher'] ?? 'no' ) === 'yes' ? 'enable-accordian' : 'disable-accordian' ?>">
    <div class="wk-adv-tabs-nav">
        <?php if ( ( $settings['enable_tab_heading_switcher'] ?? 'no' ) === 'yes') : ?>
            <div class="wk-adv-tab-heading">
                <h3><?php echo esc_html($settings['heading_title'] ?? ''); ?></h3>
                <p><?php echo esc_html($settings['heading_desc'] ?? ''); ?></p>
            </div>
        <?php endif; ?>
        <ul>
            <?php foreach ($settings['tabs'] as $tab) : ?>
                <li class="<?php echo esc_attr( $tab['description'] ?? '' ) == '' ? 'no-nav-desc' : 'has-nav-desc' ?>">
                    <a href="#tab-<?php echo esc_attr( ($tab['_id'] ?? '') . $id_int ); ?>">
                        <?php if ( (($settings['nav_icon_position'] ?? 'left') === 'left' || ($settings['nav_icon_position'] ?? 'left') === 'right') && empty($tab['description'] ?? '') ) : ?>
                            <?php if (!empty($tab['title'] ?? '')) : ?>
                                <span class="wk-adv-tab-title">
                                    <?php if (!empty($tab['title'] ?? '') && ($settings['nav_icon_position'] ?? 'left') === 'left') : ?>
                                        <span class="wk-adv-tab-title-text">
                                            <?php if (!empty($tab['icon']['value'] ?? '')) : ?>
                                                <?php Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']); ?>
                                            <?php endif; ?>
                                            <?php echo esc_html($tab['title'] ?? ''); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($tab['description'] ?? '')) : ?>
                                        <span class="wk-adv-tab-title-desc"><?php echo esc_html($tab['description'] ?? ''); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        <?php else : ?>
                            <?php if (!empty($tab['icon']['value'] ?? '')) : ?>
                                <span class="wk-adv-tab-title-icon"><?php Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($tab['title'] ?? '') || !empty($tab['description'] ?? '')) : ?>
                                <span class="wk-adv-tab-title">
                                    <?php if (!empty($tab['title'] ?? '')) : ?>
                                        <span class="wk-adv-tab-title-text"><?php echo esc_html($tab['title'] ?? ''); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($tab['description'] ?? '')) : ?>
                                        <span class="wk-adv-tab-title-desc"><?php echo esc_html($tab['description'] ?? ''); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="wk-tabs-content-wrap">
        <?php foreach ($tabs as $tab) : ?>
            <div id="tab-<?php echo esc_attr( ($tab['_id'] ?? '') . $id_int ); ?>" class="wk-tabs-content">
                <?php $content_type = $tab['tabs_content_type'] ?? 'content'; ?>
                <?php if ('content' == $content_type) : ?>
                    <p><?php echo wp_kses_post($tab['tabs_tab_content'] ?? ''); ?></p>
                <?php elseif ('template' == $content_type) : ?>
                    <?php if (!empty($tab['primary_templates'] ?? '')) {
                        echo wp_kses_post(Plugin::$instance->frontend->get_builder_content( $tab['primary_templates'] ));
                    } ?>
                <?php elseif ('image' == $tab['tabs_content_type']) : ?>
                    <?php if (!empty($tab['tab_image'])) {
                        if (!empty($tab['tab_image']['id'])) {
                            echo wp_get_attachment_image($tab['tab_image']['id'], 'full', false, array('alt' => ''));
                        } else {
                            // phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
                            echo '<img src="' . esc_url($tab['tab_image']['url']) . '" alt="">';
                        }
                    } ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>