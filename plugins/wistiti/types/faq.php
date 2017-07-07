<?php
/**
 * register custom post type to work with : FAQ
 */

function FAQ_setup() {
	// set up labels
	$labels = array(
 			'name' => 'FAQs',
    	'singular_name' => 'FAQ',
    	'add_new' => 'Add New FAQ',
    	'add_new_item' => 'Add New FAQ',
    	'edit_item' => 'Edit FAQ',
    	'new_item' => 'New FAQ',
    	'all_items' => 'All FAQs',
    	'view_item' => 'View FAQ',
    	'search_items' => 'Search FAQs',
    	'not_found' =>  'No FAQs Found',
    	'not_found_in_trash' => 'No FAQs found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'FAQs',
    );
    //register post type
	register_post_type( 'FAQ', array(
		'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
		'has_archive' => true,
    'map_meta_cap' => true,
    'menu_icon' => 'dashicons-info',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'FAQ-group' ),
		)
	);
}
add_action( 'init', 'FAQ_setup' );


/**
 * Register taxonomies : Family as example
 */
function FAQ_register_taxonomies(){

	$labels = array(
		'name' => __( 'Group', 'wistiti' ),
		'label' => __( 'Group', 'wistiti' ),
		'add_new_item' => __( 'Add New FAQ Group', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Group', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'FAQ-group', array( 'FAQ' ), $args );
}
add_action( 'init', 'FAQ_register_taxonomies' );?>
