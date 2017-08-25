<?php
/**
 * Wistiti Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Wistiti_Theme
 */

 /**
  * JavaScript Detection.
  *
  * Adds a `js` class to the root `<html>` element when JavaScript is detected.
  */
 function wistiti_javascript_detection() {
 	echo "<script>(function(html){html.className = html.className.replace(/\bno-js\b/,'js')})(document.documentElement);</script>\n";
 }
 add_action( 'wp_head', 'wistiti_javascript_detection', 0 );


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
 * Return the custom logo
 */
function wistiti_theme_get_custom_logo($args) {
  if (has_custom_logo()) {
    $markup = get_custom_logo();
    //Replace wp native classes
    $markup = str_replace('custom-logo-link', $args['classes']['logo_link'], $markup);
    $markup = str_replace('custom-logo', $args['classes']['logo'], $markup);

    return $markup;
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
	//wp_enqueue_script( 'wistiti_theme-base', get_template_directory_uri() . '/assets/js/wistiti.js', array(), '20151215', true );

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
* Customizers finder
* Returns all customizers found (wistiti parent base and child override).
* This finder avoids the dev to overide the whole customizer but only necessary array fields.
*
*/
function wistiti_locate_theme_customizer($customizer_name, $customizer_path = '', $default_path = '') {

	$customizer=array();

	// Set default template path.
	if ( ! $default_path ) :
		$default_path = get_template_directory();
	endif;
	$customizer[] = $default_path . '/'.  $customizer_name.'-customizer.php';

	if ( ! $customizer_path ) :
		$customizer_path = get_stylesheet_directory();
	endif;
	$customizer[] = $customizer_path . '/'. $customizer_name.'-customizer.php';

	return apply_filters( 'wistiti_locate_customizer', $customizer, $customizer_name, $customizer_path, $default_path );
}

function wistiti_get_theme_customizer($customizer_name, $customizer_path = '', $default_path = '') {
	$customizer_files = wistiti_locate_theme_customizer($customizer_name, $customizer_path = '', $default_path = '');
	if (!empty($customizer_files)) {
		foreach ($customizer_files as $customizer_file) {
			if ( file_exists( $customizer_file ) )
			{
				include $customizer_file;
			}
		}
	}
}

/*
* Get the post taxonomy terms
* For future use ?
*/
/*function wistiti_get_template_post_key($template, $post_type, $post_id) {

  global $wistiti_args;
  $key = '';

  $taxonomies = get_object_taxonomies($post_type);
  foreach ($taxonomies as $taxonomy) {
    $terms = wp_get_post_terms( $post_id,  $taxonomy);
    //var_dump($terms);
    foreach ($terms as $term) {

      //Ancestors first
      $ancestors = get_ancestors($term->term_id, $taxonomy, 'taxonomy');
      if (!empty($ancestors)) {
        foreach ($ancestors as $ancestor) {
          $aterm= get_term($ancestor, $taxonomy);
          if (isset($wistiti_args[$template][$post_type][$aterm->slug]) && !empty($wistiti_args[$template][$post_type][$aterm->slug])) {
            $key = $aterm->slug;
            break;
          }
        }
      }

      //Parent
      if (isset($wistiti_args[$template][$post_type][$term->slug]) && !empty($wistiti_args[$template][$post_type][$term->slug])) {
        $key = $term->slug;
        break;
      }

    }
  }

  return $key;
}*/

/*
* Get template option in wistiti customizer
*/
function wistiti_get_template_options($template, $post_type, $taxonomy='', $term='') {

  global $wistiti_args;

  $options = array();
  if (isset($wistiti_args[$template][$post_type])) {

  	if (!empty($taxonomy) && isset($wistiti_args[$template][$post_type][$taxonomy])) {
        if (!empty($term) && isset($wistiti_args[$template][$post_type][$taxonomy][$term]))
          $options = $wistiti_args[$template][$post_type][$taxonomy][$term]['options'];
        else
          $options = $wistiti_args[$template][$post_type][$taxonomy]['options'];
    }
    else {
      $options = $wistiti_args[$template][$post_type]['options'];
    }
  }

  //default values ?
  if (!isset($options['layout']) || empty($options['layout']))
    $options['layout']='block';

  if (!isset($options['display']) || empty($options['display']))
      $options['display']='default';

  return $options;
}

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
			//Is this level to be expanded ?
			$expand = true;
			if (isset($this->wargs['options']['expand'])) $expand = $this->wargs['options']['expand'];
			$breakpoint_ext = '-ns';
			if (isset($this->wargs['options']['expand_breakpoint_ext'])) $breakpoint_ext = $this->wargs['options']['expand_breakpoint_ext'];

			if ($depth==0) {
				$classes_list = 'dn-js ';
				$classes_list .= $this->wargs['classes']['items']['level'][$depth+1]['list'];
				//$classes_list .= ' bw0 bw1'.$breakpoint_ext.' b--solid b--black'; //borders

				if ($expand) {
					if (!empty($breakpoint_ext)) $classes_list .= ' relative absolute'.$breakpoint_ext.' top-100 left-0';
					else  $classes_list .= ' absolute top-100 left-0';
				}
				else $classes_list .= ' absolute top-100 left-0';

			} else if ($depth==1) {
				//To do !
				//level 2
			}

			$output .= "<ul class='".$classes_list."' role='menu' tabindex='-1'>";
		}

		public function end_lvl( &$output, $depth = 0, $args = array() ) {
			$output .= "</ul>";
		}

		//Menu items
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

			//Root items
			if ($item->menu_item_parent=='0') {

				//Is this level to be expanded ?
				$expand = true;
				if (isset($this->wargs['options']['expand'])) $expand = $this->wargs['options']['expand'];
				$breakpoint_ext = '-ns';
				if (isset($this->wargs['options']['expand_breakpoint_ext'])) $breakpoint_ext = $this->wargs['options']['expand_breakpoint_ext'];

				//li
				$classes_item = 'relative';
				$classes_item .= ' '.$this->wargs['classes']['items']['level'][0]['element'];

				if ($expand) $classes_item .= ' db dib'.$breakpoint_ext;
				else $classes_item .= ' dib';

				//a
				$classes_link =  $this->wargs['classes']['items']['level'][0]['element_link'];
			}
			//Sub items
			else {

				//li
				$classes_item = "db";
				$classes_item .= ' '.$this->wargs['classes']['items']['level'][1]['element'];

				//a
				$classes_link = $this->wargs['classes']['items']['level'][1]['element_link'];
			}

			//Item has children
			if ($args->walker->has_children) $classes_item .= " js-menu-has-children toggler";

			//Current item
			if ( $item->current )
				$classes_link .= ' '. $this->wargs['classes']['items']["current"];

			$caret='';
			if ($args->walker->has_children)
				$caret = '<b class="'.$this->wargs['classes']['items']['caret'].'"></b>';

			$tabindex = $item->menu_order==1?0:-1;

			$output .= sprintf( "<li class='".$classes_item."' role='none'><a class='".$classes_link."' href='%s' role='menuitem' tabindex='".$tabindex."'>%s %s</a>",
					$item->url,
					$item->title,
					$caret
			);

			//Add a caret here
			//if ($args->walker->has_children) $output .= "<b class='dib ml1 v-mid w-0 h-0 bw2 bb-0 b--solid bt--black bl--transparent br--transparent'></b>";
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

			var $wargs = array();

			var $tree_type = 'comment';
			var $db_fields = array( 'parent' => 'comment_parent', 'id' => 'comment_ID' );

			// constructor – wrapper for the comments list
			function __construct($args) {
				$this->wargs = $args;
				?>

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
// Moved to wistiti plugin ?
//require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
?>
