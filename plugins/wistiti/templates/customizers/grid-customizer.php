<?php
global $template_args;
$template_args = array(
  'options' => array(
    'cols' => array(
      'ns' => 3,
      'm' => 2
    ),
    'spacings' => array(
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
    'pagination' => 'center tc',
    'pagination_prev_link' => 'link underline',
    'pagination_next_link' => 'link underline'
  )
);
?>
