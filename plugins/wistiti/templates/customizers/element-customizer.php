<?php
global $template_args;
$template_args = array(
  'post_navigation' => array (
    'wrapper' => 'mt4',
    'links' => 'flex justify-between',
    'wrapper_previous' => '',
    'previous_link' => 'link underline', //not used for now
    'wrapper_next' => '',
    'next_link' => 'link underline', //not used for now
    'prev_text' => 'Previous post: %title',
    'next_text' => 'Next post: %title',
    /*'in_same_term' => false,
    'screen_reader_text' => ''*/
  )
);
?>
