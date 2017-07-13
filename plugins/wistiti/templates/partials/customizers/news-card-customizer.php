<?php
//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'classes' => array(
    'wrapper' => 'ph4 pb4',
    'thumbnail_wrapper' => 'ma0 aspect-ratio aspect-ratio--16x9',
    'thumbnail' => 'aspect-ratio--object',
    'title' => 'f2 lh-title',
    'excerpt' => 'fw6',
    'content' => 'mb2',
    'label' => 'db',
    'label_link' => 'link underline '.get_theme_mod( 'smew_colors_brand', 'blue' ),
    'source' => '',
    'source_link' => 'link underline '.get_theme_mod( 'smew_colors_brand', 'blue' ),
    'footer' => array(
      'taxonomies' => array(
        'news-tag' => array(
          'wrapper' => 'db mt3',
          'link' => 'link pa1 white bg-'.get_theme_mod( 'smew_colors_brand', 'blue' )
        )
      )
    )
  )
);
?>
