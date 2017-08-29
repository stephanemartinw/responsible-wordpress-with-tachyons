<?php
global $template_args;
$template_args = array(
  'options' => array(
    'cols' => array(
      'default' => 1,
      'ns' => 3,
      'm' => 2
    ),
    'spacings' => array(
      'default' => 4,
      'ns' => 4,
      'm' => 4
    ),
    'display_title' => false,
    'alternate' => true
  ),
  'classes' => array(
    'title' => '',
    'wrapper' => '',
    'row' => 'flex flex-wrap',
    'cell' => '', //do not set cell margins here, use spacings above !
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
