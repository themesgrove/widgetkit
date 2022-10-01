<?php

use Elementor\Icons_Manager;

$settings = $this->get_settings_for_display();
$tabs = $settings['tabs'];

?>
<div class="wk-adv-tab-wrapper nav-pos-<?php echo $settings['nav_position'] ?> nav-icon-pos-<?php echo $settings['nav_icon_position'] ?>">
    <div class="wk-adv-tabs-nav">
        <ul>
            <?php foreach ($settings['tabs'] as $tab) : ?>
                <li>
                    <a href="#tab-<?php echo esc_attr($tab['_id']) ?>">
                        <span class="wk-adv-tab-title-icon"><?php Icons_Manager::render_icon($tab['icon'], ['aria-hidden' => 'true']); ?></span>
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