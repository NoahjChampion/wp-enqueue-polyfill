<?php
/*
Plugin Name: Enqueue Polyfill
Plugin URI:
Description: Add conditional polyfills.
Author: Kyle Reicks
Version: 0.1.0
Author URI: http://github.com/kylereicks/
*/

define('ENQUEUE_POLYFILL_PATH', plugin_dir_path(__FILE__));
define('ENQUEUE_POLYFILL_URL', plugins_url('/', __FILE__));
define('ENQUEUE_POLYFILL_VERSION', '0.1.0');

require_once(ENQUEUE_POLYFILL_PATH . 'inc/class-enqueue-polyfill.php');
require_once(ENQUEUE_POLYFILL_PATH . 'inc/class-functions-enqueue-polyfill.php');

register_deactivation_hook(__FILE__, array('Enqueue_Polyfill', 'deactivate'));

add_action('plugins_loaded', array('Enqueue_Polyfill', 'get_instance'));
