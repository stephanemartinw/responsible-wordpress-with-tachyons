<?php
//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
      'classes' => array(
        'wrapper_button' => 'white tc',
        'button' => "db w-100 bg-".get_theme_mod( 'smew_colors_brand', 'blue' )." white f4 ma0 pa4 bn pointer",
        'wrapper_definition' => 'ma0',
        'definition' => 'dn-js'
      )
);?>
