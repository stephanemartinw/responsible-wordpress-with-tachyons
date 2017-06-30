<?php

/*
* Callback function to filter the MCE settings
* Customize this function if you need to propose your styles in WP's Editor. Use tachyons classes.
*/
/*function my_wistiti_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(
	
	// Each array child is a format with it's own settings
	// Notice that each array has title, block, classes, and wrapper arguments
 	// Title is the label which will be visible in Formats menu
	// Block defines whether it is a span, div, selector, or inline style
	// Classes allows you to define CSS classes
	// Wrapper whether or not to add a new block-level element around any selected elements

			//Example :

			array(
				'title' => 'Colored bold',
				'block' => 'span',
				'classes' => 'fw7 green',
				'wrapper' => true,
			),
			array(
				'title' => 'Big paragraph',
				'block' => 'p',
				'classes' => 'f4',
				'wrapper' => false,
		)
	);

	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
add_filter( 'tiny_mce_before_init', 'my_wistiti_mce_before_init_insert_formats' );*/


/*
 * Child theme styles & scripts
 */
function my_wistiti_enqueue_styles() {

		wp_enqueue_script( 'my_wistiti_script', get_stylesheet_directory_uri() . '/js/mywistiti.js', array(), '20151215', true );
}
add_action( 'wp_enqueue_scripts', 'my_wistiti_enqueue_styles' );
