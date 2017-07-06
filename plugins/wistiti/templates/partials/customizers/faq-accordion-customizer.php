<?php
//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
      'classes' => array(
        'wrapper' => "pv2",
        'tab' => "db bg-".get_theme_mod( 'smew_colors_brand', 'blue' )." white ma0 pa1 pointer",
        'title' => 'white tc',
        'panel' => 'dn-js'
      )
);?>
