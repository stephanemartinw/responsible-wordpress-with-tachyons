<?php
global $template_args;
$template_args = array(
  'options' => array(
    'spacings' => array(
      'default' => 4,
      'ns' => 4,
      'm' => 4
    ),
    'alternate' => false
  ),
  'classes' => array(
    'wrapper' => '',
    'item' => ''
  ),
  'post_navigation' =>  array(
    'wrapper' => 'center tc',
    'previous_label' => 'Previous',
    'previous_link' => 'link b--'.get_theme_mod( 'smew_colors_brand', 'blue' ).' bw1 b--solid pa2 '. get_theme_mod( 'smew_colors_brand', 'blue' ),
    'next_label' => 'Next',
    'next_link' => 'link b--'.get_theme_mod( 'smew_colors_brand', 'blue' ).' bw1 b--solid pa2 '. get_theme_mod( 'smew_colors_brand', 'blue' )
  )
);
?>
