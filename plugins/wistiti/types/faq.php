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
add_action( 'init', 'FAQ_register_taxonomies' );

//Custom post fields for FAQ
function FAQ_add_meta_boxes( $post ){
	add_meta_box( 'FAQ_meta_box', __( 'FAQ options', 'wistiti' ), 'FAQ_build_meta_box', 'FAQ', 'normal', 'low' );
}
add_action( 'add_meta_boxes_FAQ', 'FAQ_add_meta_boxes' );


function FAQ_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'FAQ_meta_box_nonce' );

	// retrieve the _FAQ_field1 current value
	$current_field1 = get_post_meta( $post->ID, '_FAQ_field1', true );

	// retrieve the _FAQ_field2 current value
	$current_field2 = get_post_meta( $post->ID, '_FAQ_field2', true );

	$field3 = array( 'Value 1', 'Value 2');

	// stores _FAQ_field3 array
	$current_field3 = ( get_post_meta( $post->ID, '_FAQ_field3', true ) ) ? get_post_meta( $post->ID, '_FAQ_field3', true ) : array();

	?>
	<div class='inside'>

		<h3><?php _e( 'Field1', 'wistiti' ); ?></h3>
		<p>
			<input type="radio" name="field1" value="0" <?php checked( $current_field1, '0' ); ?> /> Yes<br />
			<input type="radio" name="fiel1" value="1" <?php checked( $current_field1, '1' ); ?> /> No
		</p>

		<h3><?php _e( 'Field2', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="field2" value="<?php echo $current_field2; ?>" />
		</p>

		<h3><?php _e( 'Field3', 'wistiti' ); ?></h3>
		<p>
		<?php
		foreach ( $field3 as $field3item ) {
			?>
			<input type="checkbox" name="field3[]" value="<?php echo $field3item; ?>" <?php checked( ( in_array( $field3item, $current_field3 ) ) ? $field3item : '', $field3item ); ?> /><?php echo $field3item; ?> <br />
			<?php
		}
		?>
		</p>
	</div>
	<?php
}

function FAQ_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['FAQ_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['FAQ_meta_box_nonce'], basename( __FILE__ ) ) ){
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

	// store custom fields values
	// field1 string
	if ( isset( $_REQUEST['field1'] ) ) {
		update_post_meta( $post_id, '_FAQ_field1', sanitize_text_field( $_POST['field1'] ) );
	}

	// store custom fields values
	// field2 string
	if ( isset( $_REQUEST['field2'] ) ) {
		update_post_meta( $post_id, '_FAQ_field2', sanitize_text_field( $_POST['field2'] ) );
	}

	// store custom fields values
	// field3 array
	if( isset( $_POST['field3'] ) ){
		$field3 = (array) $_POST['field3'];

		// sinitize array
		$field3 = array_map( 'sanitize_text_field', $field3 );

		// save data
		update_post_meta( $post_id, '_FAQ_field3', $field3 );
	}else{
		// delete data
		delete_post_meta( $post_id, '_FAQ_field3' );
	}
}
add_action( 'save_post_FAQ', 'FAQ_save_meta_box_data' );
?>
