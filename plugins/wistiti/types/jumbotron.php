<?php
/**
 * register custom post type to work with : Jumbotron
 */

function jumbotron_setup() {
	// set up labels
	$labels = array(
 		'name' => 'Jumbotrons',
    	'singular_name' => 'Jumbotron',
    	'add_new' => 'Add New Jumbotron',
    	'add_new_item' => 'Add New Jumbotron',
    	'edit_item' => 'Edit Jumbotron',
    	'new_item' => 'New Jumbotron',
    	'all_items' => 'All Jumbotrons',
    	'view_item' => 'View Jumbotron',
    	'search_items' => 'Search Jumbotrons',
    	'not_found' =>  'No Jumbotrons Found',
    	'not_found_in_trash' => 'No Jumbotrons found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'Jumbotrons',
    );
    //register post type
	register_post_type( 'jumbotron', array(
		'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
		'has_archive' => true,
    'map_meta_cap' => true,
    'menu_icon' => 'dashicons-megaphone',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'jumbotron-type' ),
		)
	);
}
add_action( 'init', 'jumbotron_setup' );


/**
 * Register taxonomies : Type
 */
function jumbotron_register_taxonomies(){

	$labels = array(
		'name' => __( 'Type', 'wistiti' ),
		'label' => __( 'Type', 'wistiti' ),
		'add_new_item' => __( 'Add New Jumbotron Type', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Type', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'jumbotron-family', array( 'jumbotron' ), $args );
}
add_action( 'init', 'jumbotron_register_taxonomies' );

//Custom post fields for Jumbotron
function jumbotron_add_meta_boxes( $post ){
	add_meta_box( 'jumbotron_meta_box', __( 'Jumbotron', 'wistiti' ), 'jumbotron_build_meta_box', 'jumbotron', 'normal', 'low' );
}
add_action( 'add_meta_boxes_jumbotron', 'jumbotron_add_meta_boxes' );


function jumbotron_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'jumbotron_meta_box_nonce' );

	$current_jid = get_post_meta( $post->ID, '_jumbotron_id', true );
	$current_action_label = get_post_meta( $post->ID, '_jumbotron_action_label', true );
	$current_action_url = get_post_meta( $post->ID, '_jumbotron_action_url', true );

	?>
	<div class='inside'>

		<h3><?php _e( 'ID', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="jid" value="<?php echo $current_id; ?>" />
		</p>

		<h3><?php _e( 'Action label', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="action-label" value="<?php echo $current_action_label; ?>" />
		</p>

    <h3><?php _e( 'Action URL', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="action-url" value="<?php echo $current_action_url; ?>" />
		</p>

	</div>
	<?php
}

function jumbotron_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['jumbotron_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['jumbotron_meta_box_nonce'], basename( __FILE__ ) ) ){
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

	if ( isset( $_REQUEST['jid'] ) ) {
		update_post_meta( $post_id, '_jumbotron_id', sanitize_text_field( $_POST['jid'] ) );
	}

	if ( isset( $_REQUEST['action-label'] ) ) {
		update_post_meta( $post_id, '_jumbotron_action_label', sanitize_text_field( $_POST['action-label'] ) );
	}

  if ( isset( $_REQUEST['action-url'] ) ) {
    update_post_meta( $post_id, '_jumbotron_action_url', sanitize_text_field( $_POST['action-url'] ) );
  }


}
add_action( 'save_post_jumbotron', 'jumbotron_save_meta_box_data' );

function jumbotron_shortcode($atts = [], $content = null, $tag = '') {

		$atts = shortcode_atts(
		array(
			'id' => '',
			'display' => 'classic',
			'firstheadinghierarchy' => '1',
			'background' => ''
		), $atts);
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		//Query
		$jumbotron_query = '';
		if (isset($atts['id']) && !empty($atts['id'])) {
			$args = array(
					'post_type' => 'jumbotron',
					'meta_key' => '_jumbotron_id',
					'meta_value' => $atts['id']
				);

			$jumbotron_query = new WP_Query( $args );
			$atts['query'] = $jumbotron_query;
		}

		//Template
		ob_start();

		if (!empty($jumbotron_query)) wistiti_get_template('jumbotron.php', $atts);

		return ob_get_clean();
}

add_shortcode( 'wistiti_jumbotron', 'jumbotron_shortcode' );
?>
