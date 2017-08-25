<?php
global $wistiti_args;
$wistiti_args = array(
  'header' => array(
    'classes' => array(
      'progressive' => 'no-js',
      'html' => 'lh-copy sans-serif'
    )
  ),
  'index' => array (
    'post' => array(
      'options' => array(
        'layout' => 'list',
        'display' => 'media'
      )
    ),
    'element' => array(
      'options' => array(
        'layout' => 'list',
        'display' => 'media'
      )
    )
  ),
  'single' => array (
    'post' => array(
      'options' => array(
        'layout' => 'block',
        'display' => 'unique'
      )
    ),
    'element' => array(
      'options' => array(
        'layout' => 'block',
        'display' => 'unique'
      )
    )
  ),
  'archive' => array (
    'post' => array(
      'options' => array(
        'layout' => 'list',
        'display' => 'media'
      )
    ),
    'element' => array(
      'options' => array(
        'layout' => 'list',
        'display' => 'media'
      ),
      'element-type' => array(
        'options' => array(
          'layout' => 'grid',
          'display' => 'card'
        )
      ),
      'element-tag' => array(
        'options' => array(
          'layout' => 'grid',
          'display' => 'card'
        )
      )
    )
  )
);
?>
