
<?php

//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
      'classes' => array(
        'title' => "f2",
        'excerpt' => "f3",
        'content' => "",
        'hr' => '',
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
