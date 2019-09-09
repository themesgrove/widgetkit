<?php
    $settings = $this->get_settings();
    $pros_title = widgetkit_for_elementor_array_get($settings, 'pros_title');
    $pros_icon = widgetkit_for_elementor_array_get($settings, 'pros_icon');
    $pros_lists = widgetkit_for_elementor_array_get($settings, 'pros_feature_lists');
    $cons_title = widgetkit_for_elementor_array_get($settings, 'cons_title');
    $cons_icon = widgetkit_for_elementor_array_get($settings, 'cons_icon');
    $cons_lists = widgetkit_for_elementor_array_get($settings, 'cons_feature_lists');
?>

    <div class="wkfe-pros-cons">
        <div class="pros-cons-wrapper">

            <div class="col-md-6 column pros">
                <h2 class="title">
                    <i class="<?php echo $pros_icon; ?>"></i>
                    <span><?php echo esc_html($pros_title); ?></span>
                </h2>
                <ul class="feature-lists">
                    <?php foreach($pros_lists as $list): ?>
                        <li>
                            <i class="<?echo $list['pros_feature_icon']; ?>"></i>
                            <span>
                                <?php echo $list['pros_feature_input']; ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <div class="col-md-6 column cons">
                <h2 class="title">
                    <i class="<?php echo $cons_icon; ?>"></i>
                    <span><?php echo esc_html($cons_title); ?></span>
                </h2>
                <ul class="feature-lists">
                    <?php foreach($cons_lists as $list): ?>
                        <li>
                            <i class="<?echo $list['cons_feature_icon']; ?>"></i>
                            <span>
                                <?php echo $list['cons_feature_input']; ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            
        </div>
    </div>