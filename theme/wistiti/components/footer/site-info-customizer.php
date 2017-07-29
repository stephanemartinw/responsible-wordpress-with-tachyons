<?php
$wcounter=0;
$wwidth=100;
$wlogo = 50;

//Columns count and width
if ( is_active_sidebar( 'footer-1' ) ) $wcounter++;
if ( is_active_sidebar( 'footer-2' ) ) $wcounter++;
if ( is_active_sidebar( 'footer-3' ) ) $wcounter++;
if ($wcounter!=0) $wwidth = floor(100 / $wcounter);

//Logo width
switch ($wcounter) {
  case 1;
    $wlogo = 10;
  break;

  case 2:
    $wlogo = 20;
  break;

  default:
  break;
}

//Arguments
global $footer_args;
$footer_args = array(
  'options' => array(
    'col' => $wcounter,
    'width' => $wwidth,
    'logo_show' => true,
    'logo_width' => $wlogo
  ),
  'classes' => array(
    'wrapper' => 'cf pv4',
    'logo_link' => 'link',
    'logo' => 'w-100-ns w-33 h-auto'
  )
);
?>
