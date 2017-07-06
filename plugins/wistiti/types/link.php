<?php
/**
 * register custom post type to work with : Link
 */

function link_setup() {
	// set up labels
	$labels = array(
 		'name' => 'Links',
    	'singular_name' => 'Link',
    	'add_new' => 'Add New Link',
    	'add_new_item' => 'Add New Link',
    	'edit_item' => 'Edit Link',
    	'new_item' => 'New Link',
    	'all_items' => 'All Links',
    	'view_item' => 'View Link',
    	'search_items' => 'Search Links',
    	'not_found' =>  'No Links Found',
    	'not_found_in_trash' => 'No Links found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'Links',
    );
    //register post type
	register_post_type( 'link', array(
		'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
		'has_archive' => true,
    'map_meta_cap' => true,
    'menu_icon' => 'dashicons-sticky',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'link-group' ),
		)
	);
}
add_action( 'init', 'link_setup' );


/**
 * Register taxonomies : Family as example
 */
function link_register_taxonomies(){

	$labels = array(
		'name' => __( 'Group', 'wistiti' ),
		'label' => __( 'Group', 'wistiti' ),
		'add_new_item' => __( 'Add New Link Group', 'wistiti' ),
	);

	$args = array(
		'labels' => $labels,
		'label' => __( 'Group', 'wistiti' ),
		'show_ui' => true,
		'show_admin_column' => true
	);
	register_taxonomy( 'link-group', array( 'link' ), $args );
}
add_action( 'init', 'link_register_taxonomies' );

//Custom post fields for Link
function link_add_meta_boxes( $post ){
	add_meta_box( 'link_meta_box', __( 'Link options', 'wistiti' ), 'link_build_meta_box', 'link', 'normal', 'low' );
}
add_action( 'add_meta_boxes_link', 'link_add_meta_boxes' );


function link_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'link_meta_box_nonce' );

	$current_linklabel = get_post_meta( $post->ID, '_link_label',true );
	$current_linkurl = get_post_meta( $post->ID, '_link_url', true );
  $current_linksource = get_post_meta( $post->ID, '_link_source', true );
	$current_linksourceurl = get_post_meta( $post->ID, '_link_sourceurl', true );
	?>
	<div class='inside'>

		<h3><?php _e( 'Link label', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="linklabel" value="<?php echo $current_linklabel; ?>" />
		</p>

		<h3><?php _e( 'Link URL', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="linkurl" value="<?php echo $current_linkurl; ?>" />
		</p>

		<h3><?php _e( 'Link source', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="linksource" value="<?php echo $current_linksource; ?>" />
		</p>

    <h3><?php _e( 'Link source URL', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="linksourceurl" value="<?php echo $current_linksourceurl; ?>" />
		</p>

		</p>
	</div>
	<?php
}

function link_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['link_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['link_meta_box_nonce'], basename( __FILE__ ) ) ){
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
	if ( isset( $_REQUEST['linklabel'] ) ) {
		update_post_meta( $post_id, '_link_label', sanitize_text_field( $_POST['linklabel'] ) );
	}

	if ( isset( $_REQUEST['linkurl'] ) ) {
		update_post_meta( $post_id, '_link_url', sanitize_text_field( $_POST['linkurl'] ) );
	}

	if ( isset( $_REQUEST['linksource'] ) ) {
		update_post_meta( $post_id, '_link_source', sanitize_text_field( $_POST['linksource'] ) );
	}

  if ( isset( $_REQUEST['linksourceurl'] ) ) {
    update_post_meta( $post_id, '_link_sourceurl', sanitize_text_field( $_POST['linksourceurl'] ) );
  }

}
add_action( 'save_post_link', 'link_save_meta_box_data' );

function link_shortcode($atts = [], $content = null, $tag = '') {

		//Attributes
		$atts = shortcode_atts(
		array(
      'type' => 'link',
			'group' => '',
			'layout' => 'grid',
			'col' => 3,
			'display' => 'card',
			'firstheadinghierarchy' => '3',
		), $atts);
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

		//Query
		$tax_arg = null;
		if (!empty($atts['group']))
			$tax_arg = array(
					array(
							'taxonomy' => 'link-group',
							'field' => 'slug',
							'terms' => $atts['group']
			));
		$args = array(
				'post_type' => 'link',
				'tax_query' => $tax_arg,
				'orderby'=> 'menu_order',
				'order' => 'ASC',
				'post_status' => 'publish'
			);

		$links_query = new WP_Query( $args );
		$atts['query'] = $links_query;

		//Template
		ob_start();

		wistiti_get_template($atts['layout'].'.php', $atts);

		return ob_get_clean();
}

add_shortcode( 'wistiti_links', 'link_shortcode' );
?>
