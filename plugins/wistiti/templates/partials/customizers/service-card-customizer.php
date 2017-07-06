<?php
//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'classes' => array(
    'wrapper' => 'ph4 pb4',
    'thumbnail_wrapper' => 'ma0 aspect-ratio aspect-ratio--16x9',
    'thumbnail' => 'aspect-ratio--object',
    'icon_size' => '5',
    'icon_color' => get_theme_mod( 'smew_colors_brand', 'blue' ),
    'title' => 'f2 lh-title',
    'excerpt' => 'fw6'
  )
);

?>
