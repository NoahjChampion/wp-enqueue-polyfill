<?php

function wp_register_polyfill($handle, $src, $condition = 'IE', $version = false){
  Enqueue_Polyfill::get_instance()->register_polyfill($handle, $src, $condition, $version);
}

function wp_enqueue_polyfill($handle, $src, $condition = 'IE', $version = false){
  Enqueue_Polyfill::get_instance()->enqueue_polyfill($handle, $src, $condition, $version);
}
