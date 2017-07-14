<?php

/* A generic shortcode to view a wistiti element (generic)

Attibutes :
mode =  query or view
title = title of the view
type = post type
id = post id (meta)
meta_key = meta key
meta_value = meta value
tax_key = taxonomy key
tax_value = taxonomy value
order = order direction (ASC, DESC)
orderby = order by
layout = list or grid
col : number of cols for grid layout
display : media, card or collapsible
background : a background url
firstheadinghierarchy : Hx starting level
*/

function wistiti_shortcode($atts = [], $content = null, $tag = '') {

    //Type
    if (!isset($atts['type']) || empty($atts['type'])) return false;

    //Default values according to type
    $default_mode = "query";
    $default_order = "DESC";
    $default_orderby = "menu_order";
    $default_title = "";
    $default_layout = 'grid';
    $default_display = 'card';
    $default_col = 3;
    $default_firstheadinghierarchy = 3;
    $default_background = '';

    //Automatic default atts / type
    switch ($atts['type']) {

      case 'block':
        $default_layout = 'element';
      break;

      default:
      break;
    }

    //Automatic default atts / display
    switch ($atts['display']) {
      case 'disclosure':
        $default_layout = 'dlist';
      break;

      default:
      break;
    }

    //Taxonomy
		$atts = shortcode_atts(
		array(
      'mode' => $default_mode,
      'title' => $default_title,
			'type' => '',
      'id' => '',
      'meta_key' => '',
      'meta_value' => '',
      'tax_key' => '',
			'tax_value' => '',
      'order' => $default_order,
      'orderby' => $default_orderby,
			'layout' => $default_layout,
			'col' => $default_col,
			'display' => $default_display,
      'background' => $default_background,
 			'firstheadinghierarchy' => $default_firstheadinghierarchy
		), $atts);
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		//Query
    if ($atts['mode']=='query') {

      //Post meta
      $meta_key = '';
      $meta_value = '';
      if (isset($atts['meta_key']) && !empty($atts['meta_key'])) {
        $meta_key = '_'.$atts['type'].'_'.$atts['meta_key'];
        $meta_value = $atts['meta_value'];
      }

      //Taxonomy
  		$tax_arg = null;
  		if (isset($atts['tax_key']) && !empty($atts['tax_value']))
  			$tax_arg = array(
  					array(
  							'taxonomy' => $atts['type'].'-'.$atts['tax_key'],
  							'field' => 'slug',
  							'terms' => $atts['tax_value']
  			));
  		$args = array(
  	      'post_type' => $atts['type'],
          'p' => $atts['id'],
          'meta_key' => $meta_key,
          'meta_value' => $meta_value,
  				'tax_query' => $tax_arg,
  	      'orderby'=> $atts['orderby'],
  	      'order' => $atts['order'],
  	      'post_status' => 'publish'
  	    );

  	  $atts['query'] = new WP_Query( $args );
    }
    //View mode from current query
    else $atts['query'] = $GLOBALS['wp_query'];

		//Template
		ob_start();

		if (!empty($atts['query']))
      wistiti_get_template($atts['layout'].'.php', $atts);

		return ob_get_clean();
}

add_shortcode( 'wistiti', 'wistiti_shortcode' );

?>
