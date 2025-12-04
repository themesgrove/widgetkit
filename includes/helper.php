<?php
if (! function_exists('wk_element_get_settings')) {
    function wk_element_get_settings($option_name, $element = null) {
        $elements = get_option($option_name);
        return (isset($element) ? (isset($elements[$element]) ? $elements[$element] : 0) : array_keys(array_filter($elements)));
    }
}

if (! function_exists('wk_get_pro_notice')) {
    function wk_get_pro_notice()
    {
        $img_src     = esc_url(WK_URL . 'assets/images/pro.png');
        $upgrade_url = esc_url('https://themesgrove.com/widgetkit-for-elementor/');

        return sprintf(
            '<div class="wk-pro-notice">
				<img src="%s" alt="%s" />
				<div class="wk-pro-notice-content">
					<h4>%s</h4>
					<p>%s</p>
					<a target="__blank" rel="nofollow" class="elementor-button elementor-button-default" href="%s">%s</a>
				</div>
			</div>',
            $img_src,
            esc_attr(__('Upgrade Notice', 'widgetkit-for-elementor')),
            __('Upgrade to premium plan to unlock the amazing features!', 'widgetkit-for-elementor'),
            __('Upgrade to get access to all premium feature.', 'widgetkit-for-elementor'),
            $upgrade_url,
            __('Upgrade WidgetKit Pro', 'widgetkit-for-elementor')
        );
    }
}