<?php

//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'options' => array(
    'mode' => 'normal' //or inverted ?
  ),
  'classes' => array(
    'wrapper' => 'cf pv3',
    'media_image' => 'fl w-100 w-50-ns tc pa2',
    'thumbnail' => 'w-100 h-auto',
    'icon_size' => '75',
    'icon_color' => get_theme_mod( 'smew_colors_brand', 'blue' ),
    'media_body' => 'fl w-100 w-50-ns pa2',
    'title' => 'f2 f1-l lh-title',
    'excerpt' => 'fw6',
    'content' => ''
  ));
?>
