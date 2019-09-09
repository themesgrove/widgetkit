<?php
    $settings = $this->get_settings();
    $title = widgetkit_for_elementor_array_get($settings, 'feature_title');
    $icon = widgetkit_for_elementor_array_get($settings, 'feature_icon');
    $lists = widgetkit_for_elementor_array_get($settings, 'feature_lists');
?>

    <div class="wkfe-feature-list row">
        <div class="feature-list-wrapper">

            <div class="col-md-12 column">
                <h2 class="title">
                    <span class="icon">
                        <i class="<?php echo $icon; ?>"></i>
                    </span>
                    <span class="title-text"><?php echo esc_html($title); ?></span>
                </h2>
                <ul class="lists">
                    <?php foreach($lists as $list): ?>
                        <li>
                            <i class="<?echo $list['single_feature_icon']; ?>"></i>
                            <span>
                                <?php echo $list['single_feature_input']; ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

        </div>
    </div>