<?php
/**
 * register custom post type to work with : Block
 */
function block_setup()	{
	$labels = array(
	    'name' => __('Blocks', 'wistiti'),
	    'singular_name' => __('Block', 'wistiti'),
	    'add_new' => __('New Block', 'wistiti'),
	    'add_new_item' => __('Add New Block', 'wistiti'),
	    'edit_item' => __('Edit Block', 'wistiti'),
	    'new_item' => __('New Block', 'wistiti'),
	    'all_items' => __('All Blocks', 'wistiti'),
	    'view_item' => __('View Block', 'wistiti'),
	    'search_items' => __('Search Blocks', 'wistiti'),
	    'not_found' =>  __('No blocks found', 'wistiti'),
	    'not_found_in_trash' => __('No blocks found in Trash', 'wistiti'),
	    'menu_name' => __('Blocks', 'wistiti')
	  );

	$args = array(
		'public' => true,
		'show_ui' => true,
    'show_in_menu' => true,
    'has_archive' => true,
    'map_meta_cap' => true,
		'labels' => $labels,
    'menu_icon' => 'dashicons-id-alt',
		'supports' => array('title', 'excerpt', 'editor')
	);

  register_post_type( 'block', $args );
}

add_action('init', 'block_setup');


/**
 * Register taxonomies : Type
 */
function block_register_taxonomies(){

	$labels = array(
		'name' => __( 'Type', 'wistiti' ),
		'label' => __( 'Type', 'wistiti' ),
		'add_new_item' => __( 'Add New Card Type', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Type', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'block-type', array( 'block' ), $args );
}
add_action( 'init', 'block_register_taxonomies' );

//Custom post fields for Card
function block_add_meta_boxes( $post ){
	add_meta_box( 'block_meta_box', __( 'Card', 'wistiti' ), 'block_build_meta_box', 'block', 'normal', 'low' );
}
add_action( 'add_meta_boxes_block', 'block_add_meta_boxes' );


function block_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'block_meta_box_nonce' );

  $current_coolid = get_post_meta( $post->ID, '_block_coolid', true );
	$current_action_label = get_post_meta( $post->ID, '_block_action_label', true);
	$current_action_url = get_post_meta( $post->ID, '_block_action_url', true );

	?>
	<div class='inside'>

		<h3><?php _e( 'Cool ID', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="coolid" value="<?php echo $current_coolid; ?>" />
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

function block_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['block_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['block_meta_box_nonce'], basename( __FILE__ ) ) ){
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

	if ( isset( $_REQUEST['coolid'] ) ) {
		update_post_meta( $post_id, '_block_coolid', sanitize_text_field( $_POST['coolid'] ) );
	}

	if ( isset( $_REQUEST['action-label'] ) ) {
		update_post_meta( $post_id, '_block_action_label', sanitize_text_field( $_POST['action-label'] ) );
	}

  if ( isset( $_REQUEST['action-url'] ) ) {
    update_post_meta( $post_id, '_block_action_url', sanitize_text_field( $_POST['action-url'] ) );
  }
}
add_action( 'save_post_block', 'block_save_meta_box_data' );

// add necessary content filters
/*add_filter( 'ww_content', 'wptexturize') ;
add_filter( 'ww_content', 'convert_smilies' );
add_filter( 'ww_content', 'convert_chars' );
add_filter( 'ww_content', 'wpautop' );
add_filter( 'ww_content', 'shortcode_unautop' );
add_filter( 'ww_content', 'do_shortcode', 11);
add_filter( 'ww_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
add_filter( 'ww_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );*/
