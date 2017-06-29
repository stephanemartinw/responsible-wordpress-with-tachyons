<?php
/**
 * Wistiti Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wistiti_Theme
 */

if ( ! function_exists( 'wistiti_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wistiti_theme_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on components, use a find and replace
	 * to change 'wistiti_theme' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wistiti_theme', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	//add_image_size( 'wistiti_theme-featured-image', 640, 9999 );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'menu-1' => esc_html__( 'Top', 'wistiti_theme' ),
		) );

	/**
	 * Add support for core custom logo.
	 */
	add_theme_support( 'custom-logo', array(
		'height'      => 200,
		'width'       => 200,
		'flex-width'  => true,
		'flex-height' => true,
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

}
endif;
add_action( 'after_setup_theme', 'wistiti_theme_setup' );


/*
* Add scripts to wp_head()
*/
function wistiti_theme_head_script() {
	global $post;
	//We do not want to use a SEO plugin
?>
	<meta name="description" content="<?php echo get_post_meta($post->ID, 'description', true);?>">
<?php }
add_action( 'wp_head', 'wistiti_theme_head_script' );


/**
 * Return early if Custom Logos are not available.
 *
 * @todo Remove after WP 4.7
 */
function wistiti_theme_the_custom_logo() {
	if ( ! function_exists( 'the_custom_logo' ) ) {
		return;
	} else {
		the_custom_logo();
	}
}

/*
 * Return custom logo src
 */
function wistiti_theme_the_custom_logo_src() {
    if (has_custom_logo()) {
      $custom_logo_id = get_theme_mod( 'custom_logo' );
      $image = wp_get_attachment_image_src( $custom_logo_id , 'full' );
      echo $image[0];
    }
  }

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wistiti_theme_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wistiti_theme' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer1', 'wistiti_theme' ),
		'id'            => 'footer-1',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer2', 'wistiti_theme' ),
		'id'            => 'footer-2',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer3', 'wistiti_theme' ),
		'id'            => 'footer-3',
		'description'   => '',
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wistiti_theme_widgets_init' );


/**
 * Enqueue scripts and styles.
 */
function wistiti_theme_scripts() {

	//wp_enqueue_style( 'wistiti_theme_base-style', get_template_directory_uri() . '/style.css' );
	wp_enqueue_style( 'wistiti_theme-style', get_stylesheet_uri() );


	//Dequeue jQuery too ?
	wp_deregister_script( 'jquery' );
	//We do not want another one...
	//wp_register_script('jquery', get_stylesheet_directory_uri() . '/js/jquery.min.js', false);
 	//wp_enqueue_script('jquery');

	wp_enqueue_script( 'wistiti_theme-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '20151215', true );
	wp_enqueue_script( 'wistiti_theme-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );
	wp_enqueue_script( 'wistiti_theme-base', get_template_directory_uri() . '/assets/js/wistiti.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wistiti_theme_scripts' );


/**
 * Remove the migrate script from the list of jQuery dependencies.
 * https://github.com/cedaro/dequeue-jquery-migrate/blob/develop/dequeue-jquery-migrate.php
 */
function wistiti_theme_dequeue_jquery_migrate( $scripts ) {

	if ( ! is_admin() && ! empty( $scripts->registered['jquery'] ) ) {
		//Only dequeue jQuery Migrate ?
		$jquery_dependencies = $scripts->registered['jquery']->deps;
		$scripts->registered['jquery']->deps = array_diff( $jquery_dependencies, array( 'jquery-migrate' ) );
	}

}
add_action( 'wp_default_scripts', 'wistiti_theme_dequeue_jquery_migrate' );



/*
* Add editor's Format button
* Custom styles can be added in child theme
*/
add_editor_style();

function wistiti_child_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wistiti_child_mce_buttons_2');


/*
* Callback function to filter the MCE settings
* For future use
*/
/*function wistiti_child_mce_before_init_insert_formats( $init_array ) {

	$style_formats = array(
			array(
				'title' => 'Bold',
				'block' => 'span',
				'classes' => 'bold',
				'wrapper' => false,
			),

	);

	$init_array['style_formats'] = json_encode( $style_formats );

	return $init_array;

}
add_filter( 'tiny_mce_before_init', 'wistiti_child_mce_before_init_insert_formats' );
*/

/*
* WP Override menu
*/
class Walker_Quickstart_Menu extends Walker {

    // Tell Walker where to inherit it's parent and id values
    var $db_fields = array(
        'parent' => 'menu_item_parent',
        'id'     => 'db_id'
    );

    /**
     * At the start of each element, output a <li> and <a> tag structure.
     *
     * Note: Menu objects include url and title properties, so we will use those.
     */
    function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
        $output .= sprintf( "\n<li class='relative pa3 db dib-l'><a class='db link black-l white f5-l f4' href='%s'%s>%s</a></li>\n",
            $item->url,
            ( $item->object_id === get_the_ID() ) ? ' class="current"' : '',
            $item->title
        );
    }
}

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
?>
