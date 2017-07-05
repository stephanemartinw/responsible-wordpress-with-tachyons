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
      return $image[0];
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

function wistiti_theme_mce_buttons_2($buttons) {
	array_unshift($buttons, 'styleselect');
	return $buttons;
}
add_filter('mce_buttons_2', 'wistiti_theme_mce_buttons_2');


/*
* Callback function to filter the MCE settings
* For future use
*/
/*function wistiti_theme_mce_before_init_insert_formats( $init_array ) {

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
* Posts : Modify The Read More Link Text
*/
function wistiti_modify_read_more_link() {

    return '<a class="link underline" href="' . get_permalink() . '">'.sprintf(
			/* translators: %s: Name of current post. */
		  __( 'Continue reading %s', 'wistiti'),
			the_title( '<span class="clip screen-reader-text">"', '"</span>', false )
		).'</a>';
}
add_filter( 'the_content_more_link', 'wistiti_modify_read_more_link' );

/*
* WP Override navigation menu
* Let child themes override it again.
*/

if (!class_exists('Wistiti_Walker_Main_Menu')) {
	class Wistiti_Walker_Main_Menu extends Walker  {

		var $wargs = array();

		// Tell Walker where to inherit it's parent and id values
		var $db_fields = array(
				'parent' => 'menu_item_parent',
				'id'     => 'db_id'
		);

	 function __construct($args) {
		 $this->wargs = $args;
	 }
	 function __destruct() {}

		//Menu levels (from level 1, level 0 is not managed here)
		public function start_lvl( &$output, $depth = 0, $args = array() ) {

			//ul
			//level 1
			if ($depth==0) {
				$classes_list = "dn relative absolute-l top-100 left-0"; //position and display
				$classes_list .= " ph3 pv2"; //spacings
				$classes_list .= " bg-white-l"; //background
				$classes_list .= " bw0 bw1-l b--solid b--light-gray"; //borders
			} else if ($depth==1) {
				//To do !
				//level 2
				$classes_list  = "dn relative absolute-l top-0 right-0"; //position and position
				$classes_list .= " bg-white"; //background
				$classes_list .= " pa0"; //spacings
			}

			$output .= "<ul class='".$classes_list."'>";
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= "</ul>";
		}

		//Menu items
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			//Root items
			if ($item->menu_item_parent=='0') {

				//li
				$classes_item = "relative db dib-l"; //position and display
				$classes_item .= " pa3 ph0-l ph3-l pv1-l"; //spacings

				//a
				$classes_link = 'dib link black f5-l f4 underline-hover';
			}
			//Sub items
			else {

				//li
				$classes_item = "db"; //display and position
				$classes_item .= " pa3 ph0-l pv2-l"; //spacings

				//a
				$classes_link = 'dib link black f5-l f4 underline-hover';
			}

			//Item has children
			if ($args->walker->has_children) $classes_item .= " js-menu-has-children toggler";

			//Current item
			if ( $item->current )
			  //$classes_item .= ' bb-l bw1 b--'.get_theme_mod( 'smew_colors_brand', 'blue' );
				$classes_link .= " underline";

			$output .= sprintf( "<li class='".$classes_item."'><a class='".$classes_link."' href='%s'>%s</a>",
					$item->url,
					$item->title
			);

			//Add a caret here
			if ($args->walker->has_children) $output .= "<b class='dib ml1 v-mid w-0 h-0 bw2 bb-0 b--solid bt--black bl--transparent br--transparent'></b>";

		}

		public function end_el( &$output, $item, $depth = 0, $args = array() ) {
			$output .= "</li>";
		}

	}
}


/*
* WP Override comments list
* Let child themes override it again.
* Inspired from https://gist.github.com/georgiecel/9445357
*/
if (!class_exists('Wistiti_Walker_Comment')) {
	class Wistiti_Walker_Comment extends Walker_Comment {
			var $tree_type = 'comment';
			var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

			// constructor – wrapper for the comments list
			function __construct($args) {?>

				<section>

			<?php }

			// start_lvl – wrapper for child comments list
			function start_lvl( &$output, $depth = 0, $args = array() ) {
				$GLOBALS['comment_depth'] = $depth + 2; ?>

				<section>

			<?php }

			// end_lvl – closing wrapper for child comments list
			function end_lvl( &$output, $depth = 0, $args = array() ) {
				$GLOBALS['comment_depth'] = $depth + 2; ?>

				</section>

			<?php }

			// start_el – HTML for comment template
			function start_el( &$output, $comment, $depth = 0, $args = array(), $id = 0 ) {
				$depth++;
				$GLOBALS['comment_depth'] = $depth;
				$GLOBALS['comment'] = $comment;
				$parent_class = ( empty( $args['has_children'] ) ? '' : 'parent' );

				if ( 'article' == $args['style'] ) {
					$tag = 'article';
					$add_below = 'comment';
				} else {
					$tag = 'article';
					$add_below = 'comment';
				} ?>

				<article <?php comment_class(empty( $args['has_children'] ) ? '' :'parent') ?> id="comment-<?php comment_ID() ?>">
					<figure class="ma0"><?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar' ); ?></figure>
					<div role="complementary">
						<h3 class="f3">
							<a class="link" href="<?php comment_author_url(); ?>"><?php comment_author(); ?></a>
						</h2>
						<time datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>"><?php comment_date('jS F Y') ?>, <a class="link" href="#comment-<?php comment_ID() ?>"><?php comment_time() ?></a></time>
						<?php edit_comment_link('<p class="db">'._e('Edit this comment','wistiti').'</p>','',''); ?>
						<?php if ($comment->comment_approved == '0') : ?>
							<p><e_('Your comment is awaiting moderation.', 'wistiti');?></p>
						<?php endif; ?>
					</div>
					<div>
						<?php comment_text() ?>
						<?php
						//To customize ! See https://developer.wordpress.org/reference/functions/get_comment_reply_link/
						comment_reply_link(array_merge( $args, array('add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
					</div>

			<?php }

			// end_el – closing HTML for comment template
			function end_el(&$output, $comment, $depth = 0, $args = array() ) { ?>

				</article>

			<?php }

			// destructor – closing wrapper for the comments list
			function __destruct() { ?>

				</section>

			<?php }

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
