<?php

//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'options' => array(
    'mode' => 'normal', //or inverted ?
    'has_link' => true
  ),
  'classes' => array(
    'wrapper' => 'ph4 pb4',
    'media_image' => 'fl w-100 w-50-ns tc pa2',
    'thumbnail_wrapper' => '',
    'thumbnail' => 'w-100 h-auto',
    'thumbnail_link' => '',
    'media_body' => 'fl w-100 w-50-ns pa2',
    'title' => 'f2 mv3',
    'title_link' => 'link ' . get_theme_mod( 'smew_colors_brand', 'blue' ),
    'excerpt' => 'fw6',
    'content' => '',
    'content_link' => "link underline ".get_theme_mod( 'smew_colors_brand', 'blue' ),
    'posted-on' => array(
      'date' => '',
      'date_link' => 'link underline ' . get_theme_mod( 'smew_colors_brand', 'blue' ),
      'author' => '',
      'author_link' => 'link underline ' . get_theme_mod( 'smew_colors_brand', 'blue' )
    ),
    'taxonomies' => array(
      'category' => array(
        'wrapper' => 'db',
        'link' => "link underline " . get_theme_mod( 'smew_colors_brand', 'blue' )
      ),
      'post_tag' => array(
        'wrapper' => 'db mt3',
        'link' => 'link pa1 white bg-'.get_theme_mod( 'smew_colors_brand', 'blue' )
      )
    ),
    'comments_popup' => 'db mt3',
    'comments_popup_link' =>  "link underline " . get_theme_mod( 'smew_colors_brand', 'blue' )
  ));
?>
