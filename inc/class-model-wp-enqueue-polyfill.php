<?php
if(!class_exists('Model_WP_Enqueue_Polyfill')){
  class Model_WP_Enqueue_Polyfill{

    public $registered = array();
    public $done = array();
    public $queue = array();

    public function register_polyfill($handle, $src, $condition = 'IE', $version = false){
      $polyfill_data = array(
        'handle' => $handle,
        'src' => $src,
        'condition' => $condition,
        'version' => $version
      );

      if(!array_key_exists($handle, $this->registered)){
        $this->registered[$handle] = $polyfill_data;
        wp_register_script($handle, $src, array(), $version);
      }
    }

    public function enqueue_polyfill($handle, $src = '', $condition = '', $version = false){
      if(!array_key_exists($handle, $this->registered)){
        $this->register_polyfill($handle, $src, $condition, $version);
      }

      $this->add_to_queue($handle);
    }

    public function all_deps(){
      global $wp_scripts;

      if(!empty($wp_scripts->queue)){
        foreach($wp_scripts->queue as $script){
          foreach($wp_scripts->registered[$script]->deps as $dependency){
            if(array_key_exists($dependency, $this->registered)){
              $this->add_to_queue($dependency);
              $wp_scripts->queue = array_merge(array_diff($wp_scripts->queue, array($dependency)));
              $wp_scripts->done[] = $dependency;
            }
          }
        }
      }
    }

    private function add_to_queue($handle){
      if(!array_key_exists($this->registered[$handle]['condition'], $this->queue)){
        $this->queue[$this->registered[$handle]['condition']] = array($handle);
      }else{
        if(!in_array($script, $this->queue[$this->registered[$handle]['condition']])){
          $this->queue[$this->registered[$handle]['condition']][] = $handle;
        }
      }
    }

  }
}
