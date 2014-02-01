<?php
/*
Plugin Name: WP Enqueue Polyfill
Plugin URI:
Description: Add conditional polyfills.
Author: Kyle Reicks
Version: 0.1.0
Author URI: http://github.com/kylereicks/
*/

define('WP_ENQUEUE_POLYFILL_PATH', plugin_dir_path(__FILE__));
define('WP_ENQUEUE_POLYFILL_URL', plugins_url('/', __FILE__));
define('WP_ENQUEUE_POLYFILL_VERSION', '0.1.0');

require_once(WP_ENQUEUE_POLYFILL_PATH . 'inc/class-wp-enqueue-polyfill.php');
require_once(WP_ENQUEUE_POLYFILL_PATH . 'inc/functions-wp-enqueue-polyfill.php');

register_deactivation_hook(__FILE__, array('WP_Enqueue_Polyfill', 'deactivate'));

add_action('plugins_loaded', array('WP_Enqueue_Polyfill', 'get_instance'));
