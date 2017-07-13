<?php
/**
 ***************************************************
* minimal SEO for Wistiti
*****************************************************/

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function wistiti_seo_setup() {

	/*
	 * Remove WordPress manage the document title.
	 * ....If you want to cutomize the page <custom_title>
	 */
	remove_theme_support( 'title-tag' );

}
add_action( 'after_setup_theme', 'wistiti_seo_setup', 100);

/*
* Add a custom title to wp_head()
* Important : title_tag has to be not supported !
*/
	function wistiti_seo_insert_custom_title() {
		echo '<title>'.wistiti_seo_get_title(' | ').'</title>';
}
add_action('wp_head','wistiti_seo_insert_custom_title');


//From https://digwp.com/2010/04/custom-page-titles/
/*
Set the custom_title custom field in page or post to define a custom title template :
Available tags in custom title template :
%title%  = blog name
%slogan% = blog description
%post% = post title-text
%sep% = separator*/
function wistiti_seo_get_title($separator = '&raquo;') {

	if (have_posts()) {

		the_post();

		$input = get_post_meta(get_the_ID(), 'custom_title', true);
		if ($input) {
	  //Replace template-tags
			$output = str_replace(
		    array('%title%', '%slogan%', '%post%', '%sep%'),
		    array(get_bloginfo('name'), get_bloginfo('description'), get_the_title(), $separator),
		    $input);

	 	}
		//default title
		else {
	      if (is_tag()) {
	         $output = single_tag_title("Tag Archive for &quot;") . '&quot; - '; }
	      elseif (is_archive()) {
	         $output = wp_title('', false) . ' Archive - '; }
	      elseif ((is_single()) || (is_page()) && (!(is_front_page())) ) {
	         $output = wp_title('', false) . $separator; }

	      if (is_home()) {
	         $output .= get_bloginfo('name') . $separator . get_bloginfo('description'); }
	      else {
	         $output .= get_bloginfo('name') . $separator . get_bloginfo('description');;
				  }

	      if ($paged>1) {
	         $output .= $separator . 'page '. $paged;
				 }
		}

	} else {
		$output = __('Page not found','wistiti');
	}

	rewind_posts();

	return $output;
}

/*
* Add met description to wp_head()
*/
function wistiti_seo_head_script() {
	if (have_posts()) {

		the_post();
?>
	<meta name="description" content="<?php echo get_post_meta(get_the_ID(), 'description', true);?>">
<?php
		rewind_posts();
	}
}
add_action( 'wp_head', 'wistiti_seo_head_script' );


?>
