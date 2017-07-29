<?php
/**
 * register custom post type to work with : Element
 */
function element_setup()	{
	$labels = array(
	    'name' => __('Elements', 'wistiti'),
	    'singular_name' => __('Element', 'wistiti'),
	    'add_new' => __('New Element', 'wistiti'),
	    'add_new_item' => __('Add New Element', 'wistiti'),
	    'edit_item' => __('Edit Element', 'wistiti'),
	    'new_item' => __('New Element', 'wistiti'),
	    'all_items' => __('All Elements', 'wistiti'),
	    'view_item' => __('View Element', 'wistiti'),
	    'search_items' => __('Search Elements', 'wistiti'),
	    'not_found' =>  __('No Element found', 'wistiti'),
	    'not_found_in_trash' => __('No Elements found in Trash', 'wistiti'),
	    'menu_name' => __('Elements', 'wistiti')
	  );

	$args = array(
		'public' => true,
		'show_ui' => true,
    'show_in_menu' => true,
    'has_archive' => true,
    'map_meta_cap' => true,
		'labels' => $labels,
    'menu_icon' => 'dashicons-id-alt',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'page-attributes' )
	);

  register_post_type( 'element', $args );
}

add_action('init', 'element_setup');


/**
 * Register taxonomies : Type
 */
function element_register_taxonomies(){

	$labels = array(
		'name' => __( 'Type', 'wistiti' ),
		'label' => __( 'Type', 'wistiti' ),
		'add_new_item' => __( 'Add New Element Type', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Type', 'wistiti' ),
		'hierarchical' => true,
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'element-type', array( 'element' ), $args );

	//Tags
	$labels = array(
		'name' => __( 'Tags', 'wistiti' ),
		'label' => __( 'Tags', 'wistiti' ),
		'add_new_item' => __( 'Add New Elements Tags', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Tag', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'element-tag', array( 'element' ), $args );
}
add_action( 'init', 'element_register_taxonomies' );

//Custom post fields for Element
function element_add_meta_boxes( $post ){
	add_meta_box( 'element_icon_meta_box', __( 'Icon', 'wistiti' ), 'element_icon_build_meta_box', 'element', 'normal', 'low' );
	add_meta_box( 'element_source_meta_box', __( 'Source', 'wistiti' ), 'element_source_build_meta_box', 'element', 'normal', 'low' );
	add_meta_box( 'element_action_meta_box', __( 'Action', 'wistiti' ), 'element_action_build_meta_box', 'element', 'normal', 'low' );
	add_meta_box( 'element_social_meta_box', __( 'Social networks', 'wistiti' ), 'element_social_build_meta_box', 'element', 'normal', 'low' );
}
add_action( 'add_meta_boxes_element', 'element_add_meta_boxes' );

function element_icon_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'service_meta_box_nonce' );

	$current_icon_name = get_post_meta( $post->ID, '_element_icon_name',true );
	?>
	<div class='inside'>

		<h3><?php _e( 'Icon name', 'wistiti' ); ?></h3>
		<em><?php _e('Use native SVG defs in your HTML. See for example : https://github.com/jxnblk/geomicons-open', 'wistiti');?></em>
		<p>
			<input type="text" name="icon-name" value="<?php echo $current_icon_name; ?>" />
		</p>

	</div>
	<?php
}

function element_action_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'element_meta_box_nonce' );

	$current_action_label = get_post_meta( $post->ID, '_element_action_label', true);
	$current_action_url = get_post_meta( $post->ID, '_element_action_url', true );

	?>
	<div class='inside'>

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


function element_source_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'element_meta_box_nonce' );

  $current_source_name = get_post_meta( $post->ID, '_element_source_name', true );
	$current_source_url = get_post_meta( $post->ID, '_element_source_url', true );
	?>
	<div class='inside'>

		<h3><?php _e( 'Source', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="source-name" value="<?php echo $current_source_name; ?>" />
		</p>

    <h3><?php _e( 'Source URL', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="source-url" value="<?php echo $current_source_url; ?>" />
		</p>

	</div>
	<?php
}

function element_social_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'element_meta_box_nonce' );

	$max = 5;
	$current_socials = array();
	for ($i=0; $i<$max; $i++) {
  	$current_socials[$i]['name']= get_post_meta( $post->ID, '_element_social_name_'.$i, true );
		$current_socials[$i]['url'] = get_post_meta( $post->ID, '_element_social_url_'.$i, true );
	}

	?>
	<div class='inside'>

		<?php for ($i=0; $i<$max; $i++) {?>
			<h3><?php _e( 'Network', 'wistiti' ); echo $i; ?></h3>

			<h4><?php _e( 'Name', 'wistiti' ); ?></h4>
			<p>
				<input type="text" name="social-name-<?php echo $i;?>" value="<?php echo $current_socials[$i]['name']; ?>" />
			</p>

	    <h4><?php _e( 'URL', 'wistiti' ); ?></h4>
			<p>
				<input type="text" name="social-url-<?php echo $i;?>" value="<?php echo $current_socials[$i]['url']; ?>" />
			</p>
		<?php }?>

	</div>
	<?php
}

function element_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['element_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['element_meta_box_nonce'], basename( __FILE__ ) ) ){
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

	// Store custom fields values :
	//Icon
	if ( isset( $_REQUEST['icon-name'] ) ) {
		update_post_meta( $post_id, '_element_icon_name', sanitize_text_field( $_POST['icon-name'] ) );
	}

	//Source
	if ( isset( $_REQUEST['source-name'] ) ) {
		update_post_meta( $post_id, '_element_source_name', sanitize_text_field( $_POST['source-name'] ) );
	}

	if ( isset( $_REQUEST['source-url'] ) ) {
	  update_post_meta( $post_id, '_element_source_url', sanitize_text_field( $_POST['source-url'] ) );
	}

	//Action
	if ( isset( $_REQUEST['action-label'] ) ) {
		update_post_meta( $post_id, '_element_action_label', sanitize_text_field( $_POST['action-label'] ) );
	}

	if ( isset( $_REQUEST['action-url'] ) ) {
		update_post_meta( $post_id, '_element_action_url', sanitize_text_field( $_POST['action-url'] ) );
	}

	//Social networks
	$max = 5;
	for ($i=0; $i<$max; $i++) {
		if ( isset( $_REQUEST['social-name-'.$i] ) ) {
			update_post_meta( $post_id, '_element_social_name_'.$i, sanitize_text_field( $_POST['social-name-'.$i] ) );
		}

		if ( isset( $_REQUEST['social-url-'.$i] ) ) {
			update_post_meta( $post_id, '_element_social_url_'.$i, sanitize_text_field( $_POST['social-url-'.$i] ) );
		}
	}

}
add_action( 'save_post_element', 'element_save_meta_box_data' );

// add necessary content filters
add_filter( 'ww_content', 'wptexturize') ;
add_filter( 'ww_content', 'convert_smilies' );
add_filter( 'ww_content', 'convert_chars' );
add_filter( 'ww_content', 'wpautop' );
add_filter( 'ww_content', 'shortcode_unautop' );
add_filter( 'ww_content', 'do_shortcode', 11);
add_filter( 'ww_content', array( $GLOBALS['wp_embed'], 'run_shortcode' ), 8 );
add_filter( 'ww_content', array( $GLOBALS['wp_embed'], 'autoembed' ), 8 );
