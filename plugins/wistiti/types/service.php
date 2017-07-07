<?php
/**
 * register custom post type to work with : Service
 */

function service_setup() {
	// set up labels
	$labels = array(
 		'name' => 'Services',
    	'singular_name' => 'Service',
    	'add_new' => 'Add New Service',
    	'add_new_item' => 'Add New Service',
    	'edit_item' => 'Edit Service',
    	'new_item' => 'New Service',
    	'all_items' => 'All Services',
    	'view_item' => 'View Service',
    	'search_items' => 'Search Services',
    	'not_found' =>  'No Services Found',
    	'not_found_in_trash' => 'No Services found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'Services',
    );
    //register post type
	register_post_type( 'service', array(
		'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
		'has_archive' => true,
    'map_meta_cap' => true,
    'menu_icon' => 'dashicons-hammer',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'service-family' ),
		)
	);
}
add_action( 'init', 'service_setup' );


/**
 * Register taxonomies : Family as example
 */
function service_register_taxonomies(){

	$labels = array(
		'name' => __( 'Family', 'wistiti' ),
		'label' => __( 'Family', 'wistiti' ),
		'add_new_item' => __( 'Add New Service Family', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Family', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'service-family', array( 'service' ), $args );
}
add_action( 'init', 'service_register_taxonomies' );

//Custom post fields for Service
function service_add_meta_boxes( $post ){
	add_meta_box( 'service_meta_box', __( 'Service options', 'wistiti' ), 'service_build_meta_box', 'service', 'normal', 'low' );
}
add_action( 'add_meta_boxes_service', 'service_add_meta_boxes' );


function service_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'service_meta_box_nonce' );

	$current_iconname = get_post_meta( $post->ID, '_service_iconname',true );
	?>
	<div class='inside'>

		<h3><?php _e( 'Icon name', 'wistiti' ); ?></h3>
		<em><?php _e('Use native SVG defs in your HTML. See for example : https://github.com/jxnblk/geomicons-open', 'wistiti');?></em>
		<p>
			<input type="text" name="iconname" value="<?php echo $current_iconname; ?>" />
		</p>

	</div>
	<?php
}

function service_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['service_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['service_meta_box_nonce'], basename( __FILE__ ) ) ){
		return;
	}

	// return if autosave
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){
		return;
	}

  // Check the user's permissions.
	if ( ! current_user_can( 'edit_post', $post_id ) ){
		return;
	}

	// Store custom fields values
	if ( isset( $_REQUEST['iconname'] ) ) {
		update_post_meta( $post_id, '_service_iconname', sanitize_text_field( $_POST['iconname'] ) );
	}

}
add_action( 'save_post_service', 'service_save_meta_box_data' );
?>
