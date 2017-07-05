<?php
global $comments_args;
$comments_args = array(
  //Comments list
  'attributes' => array(
    'firstheadinghierarchy' => '2'
  ),
  'classes' => array(
    'heading' => 'f2',
    'items' => array()
  ),
  //Comment form
  'form' => array(
    'attributes' => array(
      'firstheadinghierarchy' => '3'
    ),
    'classes' => array(
      'title_reply_before' => "f3",
      'comment_field' => 'db',
      'submit_button' => "f5 bg-".get_theme_mod( 'smew_colors_brand', 'blue' ). " white bw0 pa3"
    )
  )
);
?>
