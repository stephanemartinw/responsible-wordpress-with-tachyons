<?php

  //Thank to https://wordpress.org/plugins/wysiwyg-widgets/

  // Register and load the widget
  function wistiti_load_widget() {
  	register_widget( 'wistiti_wysiwyg_widget' );
  }
  add_action( 'widgets_init', 'wistiti_load_widget' );

  class wistiti_wysiwyg_widget extends WP_Widget {

  	/**
  	 * Constructor
  	 */
  	public function __construct() {
  		parent::__construct(
  	 		'wistiti_wysiwyg_widget', // Base ID
  			'Wistiti Wysiwyg Widget', // Name
  			array( 'description' => __('Displays one of your Wistiti Widget Blocks.', 'wistiti') ) // Args
  		);
  	}

   	/**
  	 * Front-end display of widget.
  	 *
  	 * @see WP_Widget::widget()
  	 *
  	 * @param array $args     Widget arguments.
  	 * @param array $instance Saved values from database.
  	 */
  	public function widget( $args, $instance ) {
  		$id = ($instance['wysiwyg-widget-id']) ? $instance['wysiwyg-widget-id'] : 0;

  		$show_title = (isset($instance['show_title'])) ? $instance['show_title'] : 1;
  		$post = get_post( $id );

  		echo $args['before_widget'];

  		if( ! empty( $id ) && $post ) {

  			// Allow filtering of content
  			$content = apply_filters( 'ww_content', $post->post_content, $id );

  			if( $show_title ) {
  				// first check $instance['title'] so titles are not changed for people upgrading from an older version of the plugin
  				// titles WILL change when they re-save their widget..
  				$title = ( isset( $instance['title'] ) ) ? $instance['title'] : $post->post_title;
  				$title = apply_filters( 'widget_title', $title );
  				echo $args['before_title'] . $title . $args['after_title'];
  			}

  			echo $content;
  			echo '<!-- / WYSIWYG Widgets -->';

  		} elseif( current_user_can( 'manage_options' ) ) { ?>
  				<p>
  					<?php if( empty( $id ) ) {
  						_e( 'Please select a Widget Block to show in this area.', 'wistiti' );
  					} else {
  						printf( __( 'No widget block found with ID %d, please select an existing Widget Block in the widget settings.', 'wistiti' ), $id );
  					} ?>
  				</p>
  		<?php
  		}

  		echo $args['after_widget'];
  	}

  	/**
  	 * Sanitize widget form values as they are saved.
  	 *
  	 * @see WP_Widget::update()
  	 *
  	 * @param array $new_instance Values just sent to be saved.
  	 * @param array $old_instance Previously saved values from database.
  	 *
  	 * @return array Updated safe values to be saved.
  	 */
  	public function update( $new_instance, $old_instance ) {
  		$instance = array();
  		$instance['wysiwyg-widget-id'] = $new_instance['wysiwyg-widget-id'];
  		$instance['show_title'] = ( isset($new_instance['show_title'] ) && $new_instance['show_title'] == 1 ) ? 1 : 0;
  		return $instance;
  	}

  	/**
  	 * Back-end widget form.
  	 *
  	 * @see WP_Widget::form()
  	 *
  	 * @param array $instance Previously saved values from database.
  	 * @return string|void
  	 */
  	public function form( $instance ) {

  		$posts = (array) get_posts(array(
  			'post_type' => 'block',
  			'numberposts' => -1
  		));

  		$show_title = ( isset( $instance['show_title'] ) ) ? $instance['show_title'] : 1;
  		$selected_widget_id = ( isset( $instance['wysiwyg-widget-id'] ) ) ? $instance['wysiwyg-widget-id'] : 0;
  		$title = ($selected_widget_id) ? get_the_title( $selected_widget_id ) : 'No widget block selected.';
  		?>

  		<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="hidden" value="<?php echo esc_attr( $title ); ?>" />

  		<p>
  			<label for="<?php echo $this->get_field_id( 'wysiwyg-widget-id' ); ?>"><?php _e( 'Widget Block to show:', 'wistiti' ); ?></label>
  			<select class="widefat" id="<?php echo $this->get_field_id('wysiwyg-widget-id'); ?>" name="<?php echo $this->get_field_name( 'wysiwyg-widget-id' ); ?>" required>
  				<option value="0" disabled <?php selected( $selected_widget_id, 0 ); ?>>
  					<?php if( empty( $posts ) ) {
  						_e( 'No widget blocks found', 'wistiti' );
  					} else {
  						_e( 'Select a widget block', 'wistiti' );
  					} ?>
  				</option>
  				<?php foreach( $posts as $p ) { ?>
  					<option value="<?php echo $p->ID; ?>" <?php selected( $selected_widget_id, $p->ID ); ?>><?php echo $p->post_title; ?></option>
  				<?php } ?>
  			</select>
  		</p>

  		<p>
  			<label><input type="checkbox" id="<?php echo $this->get_field_id( 'show_title' ); ?>" name="<?php echo $this->get_field_name( 'show_title' ); ?>" value="1" <?php checked( $show_title, 1 ); ?> /> <?php _e( "Show title?", "wistiti" ); ?></label>
  		</p>

  		<p class="help"><?php printf( __( 'Manage your widget blocks %shere%s', 'wistiti' ), '<a href="'. admin_url( 'edit.php?post_type=wysiwyg-widget' ) .'">', '</a>' ); ?></p>
  		<?php
  	}
  }
?>
