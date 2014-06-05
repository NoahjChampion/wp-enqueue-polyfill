<?php
if(!class_exists('View_WP_Enqueue_Polyfill')){
  class View_WP_Enqueue_Polyfill{

    public static function do_items($model){

      foreach($model->queue as $conditional => $scripts){
        self::render_template('conditional', array('conditional' => $conditional, 'scripts' => $scripts, 'model' => $model));
      }

    }

    public static function do_item($script, $model){
      self::render_template('script', array('script' => $script, 'src' => $model->registered[$script]['src'], 'version' => $model->registered[$script]['version']));
    }

    private static function render_template($template, $template_data = array()){
      $template_path = apply_filters('wp_enqueue_polyfill_template_path', WP_ENQUEUE_POLYFILL_PATH . 'inc/templates/');
      $template_file_path = apply_filters('wp_enqueue_polyfill_' . $template . '_template_file_path', $template_path . $template . '-template.php', $template, $template_path);
      $template_data = apply_filters('wp_enqueue_polyfill_' . $template . '_template_data', $template_data);
      if(!empty($template_data)){
        extract($template_data);
      }
      ob_start();
      include($template_file_path);
      echo apply_filters('wp_enqueue_polyfill_' . $template . '_template', ob_get_clean());
    }
 
  }
}
