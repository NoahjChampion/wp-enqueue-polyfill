<?php
if(!class_exists('Enqueue_Polyfill')){
  class Enqueue_Polyfill{

    private $model;

    // Setup singleton pattern
    public static function get_instance(){
      static $instance;

      if(null === $instance){
        $instance = new self();
      }

      return $instance;
    }

    private function __clone(){
      return null;
    }

    private function __wakeup(){
      return null;
    }

    public static function deactivate(){
      self::clear_options();
    }

    private static function clear_options(){
      global $wpdb;
      $options = $wpdb->get_col('SELECT option_name FROM ' . $wpdb->options . ' WHERE option_name LIKE \'%enqueue_polyfill%\'');
      foreach($options as $option){
        delete_option($option);
      }
    }

    private function __construct(){
      require_once(ENQUEUE_POLYFILL_PATH . 'inc/class-model-enqueue-polyfill.php');

      $this->model = new Model_Enqueue_Polyfill();

      add_action('init', array($this, 'add_update_hook'));
      add_action('wp_enqueue_scripts', array($this, 'register_defaults'));
      add_action('wp_print_scripts', array($this, 'print_polyfill_scripts'));
    }

    public function add_update_hook(){
      if(get_option('enqueue_polyfill_version') !== PLUGIN_NAME_VERSION){
        update_option('enqueue_polyfill_update_timestamp', time());
        update_option('enqueue_polyfill_version', PLUGIN_NAME_VERSION);
        do_action('enqueue_polyfill_updated');
      }
    }

    public function register_polyfill($handle, $src, $condition = 'IE', $version = false){
      $this->model->register_polyfill($handle, $src, $condition, $version);
    }

    public function enqueue_polyfill($handle, $src, $condition = 'IE', $version = false){
      $this->model->enqueue_polyfill($handle, $src, $condition, $version);
    }

    public function print_polyfill_scripts(){
      require_once(ENQUEUE_POLYFILL_PATH . 'inc/class-view-enqueue-polyfill.php');

      $this->model->all_deps();

      View_Enqueue_Polyfill::do_items($this->model);
    }

    public function register_defaults(){
      $this->register_polyfill('addEventListener', ENQUEUE_POLYFILL_URL . 'js/event-listener.js', 'IE 8');
    }

  }
}
