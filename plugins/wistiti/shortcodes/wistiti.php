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
layout_variant = variant of layout (alternate)
display : media, card or collapsible
background_image : a background image url
background_default_fallback_color : a background fallback color
firstheadinghierarchy : Hx starting level
*/

function wistiti_shortcode($atts = [], $content = null, $tag = '') {

    //Default values according to type
    $default_id = '';
    $default_type = 'element';
    $default_mode = 'query';
    $default_order = 'ASC';
    $default_orderby = 'menu_order';
    $default_limit = -1;
    $default_title = '';
    $default_layout = 'block';
    $default_layout_variant = '';
    $default_display = 'default';
    $default_firstheadinghierarchy = 3;
    $default_background_image = '';
    $default_background_fallback_color = 'white';
    $default_pagination = false;

    //Determine tax key and value from id if set...
    $default_tax_key = '';
    $default_tax_value = '';
    if (isset($atts['id']) && !empty($atts['id'])) {
        //to do : get the tax key and value
    }

		$atts = shortcode_atts(
		array(
      'mode' => $default_mode,
      'title' => $default_title,
      'type' => $default_type,
      'id' => $default_id,
      'meta_key' => '',
      'meta_value' => '',
      'tax_key' => $default_tax_key,
			'tax_value' => $default_tax_value,
      'order' => $default_order,
      'orderby' => $default_orderby,
      'limit' => $default_limit,
			'layout' => $default_layout,
      'layout_variant' => $default_layout_variant,
			'display' => $default_display,
      'background_image' => $default_background_image,
      'background_fallback_color' => $default_background_fallback_color,
 			'firstheadinghierarchy' => $default_firstheadinghierarchy,
      'pagination' => $default_pagination
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


      $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
      $limit = $atts['limit'];
      $offset = ( $limit * $paged ) - $limit;
  		$args = array(
  	      'post_type' => $atts['type'],
          'p' => $atts['id'],
          'meta_key' => $meta_key,
          'meta_value' => $meta_value,
  				'tax_query' => $tax_arg,
  	      'orderby'=> $atts['orderby'],
  	      'order' => $atts['order'],
  	      'post_status' => 'publish',
          'offset' => $offset,
          'posts_per_page' => $limit
  	    );

  	  $atts['query'] = new WP_Query( $args );
    }
    //View mode from current query
    else $atts['query'] = $GLOBALS['wp_query'];

		//Template
		ob_start();

		if (!empty($atts['query']))
      wistiti_get_template($atts['layout'].'.php', $atts);

    global $context;
    $context ='shortcode';

		return ob_get_clean();
}

add_shortcode( 'wistiti', 'wistiti_shortcode' );

?>
