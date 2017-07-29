
<?php

//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'options' => array(
      'has_link' => true
      ),
      'classes' => array(
        'wrapper' => '',
        'thumbnail_wrapper' => '',
        'thumbnail' => 'w-100 h-auto',
        'thumbnail_link' => '',
        'title' => "f3",
        'title_link' => 'link ' . get_theme_mod( 'smew_colors_brand', 'blue' ),
        'excerpt' => "",
        'content' => "",
        'content_link' => "link underline ".get_theme_mod( 'smew_colors_brand', 'blue' ),
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
