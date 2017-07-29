<?php

//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
    'classes' => array(
      'wrapper' => '',
      'title' => 'f1 f1-m f-subheadline-ns ma0',
      'excerpt' => 'f3 f2-m f1-ns',
      'content' => 'f4 f3-m f2-ns',
      'hr' => '',
      'action_wrapper' => '',
      'action_link' => "dib bg-".get_theme_mod( 'smew_colors_brand', 'blue' )." white pa3 mv3 link shadow-hover"
    )
);

//Extend here the default skin, according to the element $id if necessary
/*switch ($atts['id']) {
  case '<id>':
    $partial_args['classes']['title'] = / += ... for example
  break;

  default:
  break;
}*/

?>
