<?php
// Test script to check plugin loading
define('ABSPATH', '/Users/dev/Herd/wp-test/');
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);

// Mock WordPress functions that the plugin might need
if (!function_exists('plugins_url')) {
    function plugins_url($path = '', $plugin = '') {
        return 'http://localhost/wp-content/plugins/widgetkit-for-elementor/';
    }
}

if (!function_exists('plugin_dir_path')) {
    function plugin_dir_path($file) {
        return dirname($file) . '/';
    }
}

if (!function_exists('plugin_dir_url')) {
    function plugin_dir_url($file) {
        return 'http://localhost/wp-content/plugins/widgetkit-for-elementor/';
    }
}

if (!function_exists('add_action')) {
    function add_action($hook, $callback, $priority = 10, $args = 1) {
        // Mock function
        return true;
    }
}

if (!function_exists('add_filter')) {
    function add_filter($hook, $callback, $priority = 10, $args = 1) {
        // Mock function
        return true;
    }
}

if (!function_exists('register_activation_hook')) {
    function register_activation_hook($file, $callback) {
        // Mock function
        return true;
    }
}

if (!function_exists('register_deactivation_hook')) {
    function register_deactivation_hook($file, $callback) {
        // Mock function
        return true;
    }
}

echo "Testing WidgetKit for Elementor plugin loading...\n";

try {
    // Test main plugin class
    require_once '/Users/dev/Herd/wp-test/wp-content/plugins/widgetkit-for-elementor/widgetkit-for-elementor.php';
    echo "✓ Main plugin file loaded successfully\n";
    
    echo "\n✅ All tests passed! Plugin should activate without fatal errors.\n";
    
} catch (Exception $e) {
    echo "\n❌ Error found: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
} catch (Error $e) {
    echo "\n❌ Fatal error found: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
}
