<?php
  global $partial_args;
  $partial_args=array(
    'options' => array(
      'has_link' => true
    ),
    'classes' => array(
      'wrapper' => '',
      'thumbnail_wrapper' => 'ma0 aspect-ratio aspect-ratio--16x9',
      'thumbnail' => 'aspect-ratio--object',
      'thumbnail_link' => '',
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
          "link" => 'link pa1 white bg-'.get_theme_mod( 'smew_colors_brand', 'blue' )
        )
      ),
      'comments_popup' => 'db mt3',
      'comments_popup_link' => 'link underline ' . get_theme_mod( 'smew_colors_brand', 'blue' )
    )
  );
?>
