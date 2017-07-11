<?php
/**
 * register custom post type to work with : News
 */

function news_setup() {
	// set up labels
	$labels = array(
 		  'name' => 'News',
    	'singular_name' => 'News',
    	'add_new' => 'Add New News',
    	'add_new_item' => 'Add New News',
    	'edit_item' => 'Edit News',
    	'new_item' => 'New News',
    	'all_items' => 'All News',
    	'view_item' => 'View News',
    	'search_items' => 'Search News',
    	'not_found' =>  'No News Found',
    	'not_found_in_trash' => 'No News found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'News',
    );
    //register post type
	register_post_type( 'news', array(
		'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
		'has_archive' => true,
    'map_meta_cap' => true,
    'menu_icon' => 'dashicons-sticky',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'news-group' ),
		)
	);
}
add_action( 'init', 'news_setup' );


/**
 * Register taxonomies : Family as example
 */
function news_register_taxonomies(){

	$labels = array(
		'name' => __( 'Group', 'wistiti' ),
		'label' => __( 'Group', 'wistiti' ),
		'add_new_item' => __( 'Add New News Group', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Group', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'news-group', array( 'news' ), $args );

	//Tags
	$labels = array(
		'name' => __( 'Tags', 'wistiti' ),
		'label' => __( 'Tags', 'wistiti' ),
		'add_new_item' => __( 'Add New News Tags', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Tag', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'news-tag', array( 'news' ), $args );

}
add_action( 'init', 'news_register_taxonomies' );

//Custom post fields for News
function news_add_meta_boxes( $post ){
	add_meta_box( 'news_meta_box', __( 'News options', 'wistiti' ), 'news_build_meta_box', 'news', 'normal', 'low' );
}
add_action( 'add_meta_boxes_news', 'news_add_meta_boxes' );


function news_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'news_meta_box_nonce' );

	$current_newslabel = get_post_meta( $post->ID, '_news_label',true );
	$current_newsurl = get_post_meta( $post->ID, '_news_url', true );
  $current_newssource = get_post_meta( $post->ID, '_news_source', true );
	$current_newssourceurl = get_post_meta( $post->ID, '_news_sourceurl', true );
	?>
	<div class='inside'>

		<h3><?php _e( 'News label', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="newslabel" value="<?php echo $current_newslabel; ?>" />
		</p>

		<h3><?php _e( 'News URL', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="newsurl" value="<?php echo $current_newsurl; ?>" />
		</p>

		<h3><?php _e( 'News source', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="newssource" value="<?php echo $current_newssource; ?>" />
		</p>

    <h3><?php _e( 'News source URL', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="newssourceurl" value="<?php echo $current_newssourceurl; ?>" />
		</p>

		</p>
	</div>
	<?php
}

function news_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['news_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['news_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	if ( isset( $_REQUEST['newslabel'] ) ) {
		update_post_meta( $post_id, '_news_label', sanitize_text_field( $_POST['newslabel'] ) );
	}

	if ( isset( $_REQUEST['newsurl'] ) ) {
		update_post_meta( $post_id, '_news_url', sanitize_text_field( $_POST['newsurl'] ) );
	}

	if ( isset( $_REQUEST['newssource'] ) ) {
		update_post_meta( $post_id, '_news_source', sanitize_text_field( $_POST['newssource'] ) );
	}

  if ( isset( $_REQUEST['newssourceurl'] ) ) {
    update_post_meta( $post_id, '_news_sourceurl', sanitize_text_field( $_POST['newssourceurl'] ) );
  }

}
add_action( 'save_post_news', 'news_save_meta_box_data' );
?>
