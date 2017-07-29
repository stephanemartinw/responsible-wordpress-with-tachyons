
<?php

//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'options' => array(
    'mode' => 'normal', //or inverted ?
    'has_link' => false
  ),
  'classes' => array(
    'wrapper' => '',
    'thumbnail_wrapper' => '',
    'thumbnail' => 'w-100 h-auto',
    'thumbnail_link' => '',
    'title' => "f3",
    'excerpt' => "",
    'content' => "",
    'action' => "dib bg-".get_theme_mod( 'smew_colors_brand', 'blue' )." white pa3 mv3 link shadow-hover"
  )
);

//Extend or override here the default skin, according to $id if necessary
  /*switch ($atts['id']) {
    case '<id>':
      $partial_args['classes']['title'] = / += ... for example
    break;

    default:
    break;
  }*/
?>
