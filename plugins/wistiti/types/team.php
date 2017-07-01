<?php
/**
 * register custom post type to work with : Teammember
 */

function teammember_setup() {
	// set up labels
	$labels = array(
 		  'name' => 'Teammembers',
    	'singular_name' => 'Teammember',
    	'add_new' => 'Add New Teammember',
    	'add_new_item' => 'Add New Teammember',
    	'edit_item' => 'Edit Teammember',
    	'new_item' => 'New Teammember',
    	'all_items' => 'All Teammembers',
    	'view_item' => 'View Teammember',
    	'search_items' => 'Search Teammembers',
    	'not_found' =>  'No Teammembers Found',
    	'not_found_in_trash' => 'No Teammembers found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'Teammembers',
    );
    //register post type
	register_post_type( 'teammember', array(
		'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
		'has_archive' => true,
    'map_meta_cap' => true,
    'menu_icon' => 'dashicons-groups',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'teammember-team' ),
		)
	);
}
add_action( 'init', 'teammember_setup' );


/**
 * Register taxonomies : Team
 */
function teammember_register_taxonomies(){

	$labels = array(
		'name' => __( 'Team', 'wistiti' ),
		'label' => __( 'Team', 'wistiti' ),
		'add_new_item' => __( 'Add New Teammember Team', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Team', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'teammember-team', array( 'teammember' ), $args );
}
add_action( 'init', 'teammember_register_taxonomies' );

//Custom post fields for Teammember
function teammember_add_meta_boxes( $post ){
	add_meta_box( 'teammember_meta_box', __( 'Teammember options', 'wistiti' ), 'teammember_build_meta_box', 'teammember', 'normal', 'low' );
}
add_action( 'add_meta_boxes_teammember', 'teammember_add_meta_boxes' );


function teammember_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'teammember_meta_box_nonce' );


	// retrieve the _teammember_function current value
	$current_function = get_post_meta( $post->ID, '_teammember_function', true );

	?>
	<div class='inside'>

		<h3><?php _e( 'Function', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="function" value="<?php echo $current_function; ?>" />
		</p>

	</div>
	<?php
}

function teammember_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['teammember_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['teammember_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	// Function string
	if ( isset( $_REQUEST['function'] ) ) {
		update_post_meta( $post_id, '_teammember_function', sanitize_text_field( $_POST['function'] ) );
	}

}
add_action( 'save_post_teammember', 'teammember_save_meta_box_data' );

function team_shortcode($atts = [], $content = null, $tag = '') {

		$atts = shortcode_atts(
		array(
			'layout' => 'grid',
			'col' => 3,
			'display' => 'card',
 			'firstheadinghierarchy' => '3'
		), $atts);
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		//Query
		$args = array(
	      'post_type' => 'teammember',
	      'orderby'=> 'menu_order',
	      'order' => 'ASC',
	      'post_status' => 'publish'
	    );

	  $teammembers_query = new WP_Query( $args );
		$atts['query'] = $teammembers_query;

		//Template
		ob_start();

		wistiti_get_template('teammembers-'.$atts['layout'].'.php', $atts);

		return ob_get_clean();
}

add_shortcode( 'wistiti_team', 'team_shortcode' );
?>
