<?php

// Register and load the widget
function wistiti_load_widget() {
	register_widget( 'wistiti_widget' );
}
add_action( 'widgets_init', 'wistiti_load_widget' );

// Creating the widget
class wistiti_widget extends WP_Widget {

  function __construct() {
  parent::__construct(

  // Base ID of your widget
  'wistiti_widget',

  // Widget name will appear in UI
  __('Wistiti Widget', 'wpb_widget_domain'),

  // Widget description
  array( 'description' => __( 'Sample widget based for Wistiti', 'wistiti' ), )
  );
  }

  public $args = array(
      'before_title'  => '<h4 class="f4">',
      'after_title'   => '</h4>',
      'before_widget' => '<div class="">',
      'after_widget'  => '</div></div>'
  );

  // Creating widget front-end

  public function widget( $args, $instance ) {

  //Override args...
  $args['before_title'] = '<h4 class="f4">';
  $args['after_title'] = '</h4>';
  $args['before_widget'] = '<div class="">';
  $args['after_widget']  = '</div></div>';

  $title = apply_filters( 'widget_title', $instance['title'] );
  // before and after widget arguments are defined by themes
  echo $args['before_widget'];
  if ( ! empty( $title ) )
  echo $args['before_title'] . $title . $args['after_title'];

  // This is where you run the code and display the output
  echo __( 'Hello, World!', 'wisiti' );
  echo $args['after_widget'];
  }

  // Widget Backend
  public function form( $instance ) {
  if ( isset( $instance[ 'title' ] ) ) {
  $title = $instance[ 'title' ];
  }
  else {
  $title = __( 'New title', 'wistiti' );
  }

  //$body = "";

  // Widget admin form
  ?>
  <p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
  <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
  </p>
  <?php
  }

  // Updating widget replacing old instances with new
  public function update( $new_instance, $old_instance ) {
    $instance = array();
    $instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
    //$instance['body'] = ( ! empty( $new_instance['body'] ) ) ? strip_tags( $new_instance['body'] ) : '';
    return $instance;
  }
  }

?>
