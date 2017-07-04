<?php
/**
 * register custom post type to work with : Card
 */

function card_setup() {
	// set up labels
	$labels = array(
 		'name' => 'Cards',
    	'singular_name' => 'Card',
    	'add_new' => 'Add New Card',
    	'add_new_item' => 'Add New Card',
    	'edit_item' => 'Edit Card',
    	'new_item' => 'New Card',
    	'all_items' => 'All Cards',
    	'view_item' => 'View Card',
    	'search_items' => 'Search Cards',
    	'not_found' =>  'No Cards Found',
    	'not_found_in_trash' => 'No Cards found in Trash',
    	'parent_item_colon' => '',
    	'menu_name' => 'Cards',
    );
    //register post type
	register_post_type( 'card', array(
		'labels' => $labels,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
		'has_archive' => true,
    'map_meta_cap' => true,
    'menu_icon' => 'dashicons-id-alt',
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail','page-attributes' ),
    'taxonomies' => array( 'card-type' ),
		)
	);
}
add_action( 'init', 'card_setup' );


/**
 * Register taxonomies : Type
 */
function card_register_taxonomies(){

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
	register_taxonomy( 'card-family', array( 'card' ), $args );
}
add_action( 'init', 'card_register_taxonomies' );

//Custom post fields for Card
function card_add_meta_boxes( $post ){
	add_meta_box( 'card_meta_box', __( 'Card', 'wistiti' ), 'card_build_meta_box', 'card', 'normal', 'low' );
}
add_action( 'add_meta_boxes_card', 'card_add_meta_boxes' );


function card_build_meta_box( $post ){
	// make sure the form request comes from WordPress
	wp_nonce_field( basename( __FILE__ ), 'card_meta_box_nonce' );

  $current_id = get_post_meta( $post->ID, '_card_id', true );
	$current_action_label = get_post_meta( $post->ID, '_card_action_label', true );
	$current_action_url = get_post_meta( $post->ID, '_card_action_url', true );

	?>
	<div class='inside'>

		<h3><?php _e( 'ID', 'wistiti' ); ?></h3>
		<p>
			<input type="text" name="cid" value="<?php echo $current_id; ?>" />
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

function card_save_meta_box_data( $post_id ){
	// verify meta box nonce
	if ( !isset( $_POST['card_meta_box_nonce'] ) || !wp_verify_nonce( $_POST['card_meta_box_nonce'], basename( __FILE__ ) ) ){
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

	if ( isset( $_REQUEST['cid'] ) ) {
		update_post_meta( $post_id, '_card_id', sanitize_text_field( $_POST['cid'] ) );
	}

	if ( isset( $_REQUEST['action-label'] ) ) {
		update_post_meta( $post_id, '_card_action_label', sanitize_text_field( $_POST['action-label'] ) );
	}

  if ( isset( $_REQUEST['action-url'] ) ) {
    update_post_meta( $post_id, '_card_action_url', sanitize_text_field( $_POST['action-url'] ) );
  }
}
add_action( 'save_post_card', 'card_save_meta_box_data' );

function card_shortcode($atts = [], $content = null, $tag = '') {

		$atts = shortcode_atts(
		array(
			'id' => '',
			'display' => 'classic',
			'firstheadinghierarchy' => '3',
			'background' => ''
		), $atts);
		$atts = array_change_key_case((array)$atts, CASE_LOWER);

    //Query
    $card_query = '';
    if (isset($atts['id']) && !empty($atts['id'])) {
      $args = array(
          'post_type' => 'card',
					'meta_key' => '_card_id',
					'meta_value' => $atts['id']
        );

      $card_query = new WP_Query( $args );
      $atts['query'] = $card_query;
    }

    //Layout
		ob_start();

		if (!empty($card_query)) wistiti_get_template('card.php', $atts);

		return ob_get_clean();
}

add_shortcode( 'wistiti_card', 'card_shortcode' );
?>
