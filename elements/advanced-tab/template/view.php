<?php

use Elementor\Icons_Manager;
use Elementor\Plugin;

$settings = $this->get_settings_for_display();
$tabs = $settings['tabs'];
$id_int = substr($this->get_id_int(), 0, 3);

?>
<div class="wk-adv-tab-wrapper nav-pos-<?php echo esc_attr($settings['nav_position']); ?> nav-icon-pos-<?php echo esc_attr($settings['nav_icon_position']); ?> nav-align-<?php echo esc_attr($settings['tab_nav_align']); ?> <?php echo esc_attr($settings['enable_tab_accordian_switcher']) == 'yes' ? 'enable-accordian' : 'disable-accordian' ?>">
    <div class="wk-adv-tabs-nav">
        <?php if ($settings['enable_tab_heading_switcher'] == 'yes') : ?>
            <div class="wk-adv-tab-heading">
                <h3><?php echo esc_html($settings['heading_title']); ?></h3>
                <p><?php echo esc_html($settings['heading_desc']); ?></p>
            </div>
        <?php endif; ?>
        <ul>
            <?php foreach ($settings['tabs'] as $tab) : ?>
                <li class="<?php echo esc_attr($tab['description']) == '' ? 'no-nav-desc' : 'has-nav-desc' ?>">
                    <a href="#tab-<?php echo esc_attr($tab['_id'] . $id_int); ?>">
                        <?php if (($settings['nav_icon_position'] == 'left' && $tab['description'] == '') || ($settings['nav_icon_position'] == 'right' && $tab['description'] == '')) : ?>
                            <?php if (!empty($tab['title'])) : ?>
                                <span class="wk-adv-tab-title">
                                    <?php if (!empty($tab['title']) && $settings['nav_icon_position'] == 'left') : ?>
                                        <span class="wk-adv-tab-title-text">
                                            <?php if ($tab['icon']['value'] != '') : ?>
                                                <?php Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']); ?>
                                            <?php endif; ?>
                                            <?php echo esc_html($tab['title']); ?>
                                        </span>
                                    <?php endif; ?>
                                    <?php if (!empty($tab['description'])) : ?>
                                        <span class="wk-adv-tab-title-desc"><?php echo esc_html($tab['description']); ?></span>
                                    <?php endif; ?>
                                </span>
                            <?php endif; ?>

                        <?php else : ?>
                            <?php if ($tab['icon']['value'] != '') : ?>
                                <span class="wk-adv-tab-title-icon"><?php Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']); ?></span>
                            <?php endif; ?>
                            <?php if (!empty($tab['title']) || !empty($tab['description'])) : ?>
                                <span class="wk-adv-tab-title">
                                    <?php if (!empty($tab['title'])) : ?>
                                        <span class="wk-adv-tab-title-text"><?php echo esc_html($tab['title']); ?></span>
                                    <?php endif; ?>
                                    <?php if (!empty($tab['description'])) : ?>
                                        <span class="wk-adv-tab-title-desc"><?php echo esc_html($tab['description']); ?></span>
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
        <?php foreach ($settings['tabs'] as $tab) : ?>
            <div id="tab-<?php echo esc_attr($tab['_id'] . $id_int); ?>" class="wk-tabs-content">
                <?php if ('content' == $tab['tabs_content_type']) : ?>
                    <p><?php echo esc_html($tab['tabs_tab_content']); ?></p>
                <?php elseif ('template' == $tab['tabs_content_type']) : ?>
                    <?php if (!empty($tab['primary_templates'])) {
                        echo Plugin::$instance->frontend->get_builder_content($tab['primary_templates']);
                    } ?>
                <?php elseif ('image' == $tab['tabs_content_type']) : ?>
                    <?php if (!empty($tab['tab_image'])) {?>
                        <img src="<?php echo esc_url($tab['tab_image']['url']);?>" alt="">
                        <?php
                    } ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>