<?php
  global $post_args;
  $post_args=array(
    'attributes' => array(
      'firstheadinghierarchy_single' => '1',
      'firstheadinghierarchy' => '2'
    ),
    'classes' => array(
      'wrapper' => 'mv5',
      'title_single' => 'f1 mv2 ' .get_theme_mod( 'smew_colors_brand', 'blue' ),
      'title' => 'f2 mv3',
      'title_link' => 'link ' . get_theme_mod( 'smew_colors_brand', 'blue' ),
      'posted-on' => array(
        'date' => '',
        'date_link' => 'link',
        'author' => '',
        'author_link' => 'link'
      ),
      'footer' => array(
        'categories' => 'db',
        'category_link' => 'link',
        'tags' => 'db',
        'tag_link' => 'link',
        'comments_popup' => 'db',
        'comments_popup_link' => 'link'
      ),
      'thumbnail' => 'w-100 h-auto'
    )
  );
?>
