<?php
global $header_args;
$header_args = array(
  'options' => array(
    'activate' => get_theme_mod( 'smew_layout_header', true ),
    'inline' => true,
    'inline_breakpoint' => 'l'
  ),
	'classes' => array(
		'wrapper' => 'relative tc tl-l'
	)
); ?>
