<?php

use Elementor\Icons_Manager;

$settings = $this->get_settings_for_display();
$tabs = $settings['tabs'];

?>
<div
    class="wk-adv-tab-wrapper nav-pos-<?php echo $settings['nav_position'] ?> nav-icon-pos-<?php echo $settings['nav_icon_position'] ?> nav-align-<?php echo $settings['tab_nav_align'] ?>">
    <div class="wk-adv-tabs-nav">
        <?php if($settings['enable_tab_heading_switcher'] == 'yes'):?>
        <div class="wk-adv-tab-heading">
            <h3><?php echo $settings['heading_title'] ?></h3>
            <p><?php echo $settings['heading_desc'] ?></p>
        </div>
        <?php endif;?>
        <ul>
            <?php foreach ($settings['tabs'] as $tab) : ?>
            <li>
                <a href="#tab-<?php echo esc_attr($tab['_id']) ?>">
                    <span
                        class="wk-adv-tab-title-icon"><?php Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']); ?></span>
                    <span class="wk-adv-tab-title">
                        <span class="wk-adv-tab-title-text"><?php echo esc_html($tab['title']); ?></span>
                        <span class="wk-adv-tab-title-desc"><?php echo $tab['description']; ?></span>
                    </span>
                </a>
            </li>
            <?php endforeach; ?>
        </ul>
    </div>

    <div class="wk-tabs-content-wrap">
        <?php foreach ($settings['tabs'] as $tab) : ?>
        <div id="tab-<?php echo esc_attr($tab['_id']) ?>" class="wk-tabs-content">
            <p><?php echo $tab['content']; ?></p>
        </div>
        <?php endforeach; ?>
    </div>
</div>