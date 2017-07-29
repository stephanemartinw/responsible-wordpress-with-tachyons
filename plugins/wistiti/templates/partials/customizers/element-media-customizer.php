<?php

//Override this template partial in your wistiti child theme to fit your needs
global $partial_args;
$partial_args =array(
  'options' => array(
    'mode' => 'normal', //or inverted ?
    'has_link' => true,
    'show' => array(
      'title' => true,
      'thumbnail' => true,
      'excerpt' => true,
      'content' => true,
      'action' => true,
      'source' => true,
      'taxonomy' => true,
      'tag' => true,
      'social' => true
    )
  ),
  'classes' => array(
    'wrapper' => 'cf pv3',
    'media_image' => 'fl w-100 w-50-ns tc pa2',
    'thumbnail_wrapper' => '',
    'thumbnail' => 'w-100 h-auto',
    'thumbnail_link' => '',
    'icon_size' => '75',
    'icon_color' => get_theme_mod( 'smew_colors_brand', 'blue' ),
    'media_body' => 'fl w-100 w-50-ns pa2',
    'title' => 'f2 f1-l lh-title',
    'title_link' => 'link ' . get_theme_mod( 'smew_colors_brand', 'blue' ),
    'excerpt' => 'fw6',
    'content' => '',
    'content_link' => "link underline ".get_theme_mod( 'smew_colors_brand', 'blue' ),
    'action_wrapper' => '',
    'action_link' => "dib bg-".get_theme_mod( 'smew_colors_brand', 'blue' )." white pa3 mv3 link shadow-hover",
    'source_wrapper' => 'mt3',
    'source_link' => '',
    'social_wrapper' => 'mt3',
    'social' => '',
    'social_link' => '',
    'taxonomies' => array(
      'type' => array(
        'wrapper' => 'db',
        'link' => "link underline " . get_theme_mod( 'smew_colors_brand', 'blue' )
      ),
      'element-tag' => array(
        'wrapper' => 'db mt3',
        "link" => 'link pa1 white bg-'.get_theme_mod( 'smew_colors_brand', 'blue' )
      )
    )
  ));
?>
