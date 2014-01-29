<!--[if <?php echo $conditional; ?>]>
<?php
foreach($scripts as $script){
  self::do_item($script, $model);
}
?>
<![endif]-->
