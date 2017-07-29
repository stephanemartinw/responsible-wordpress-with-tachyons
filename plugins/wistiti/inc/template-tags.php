<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wistiti
 */

 if ( ! function_exists( 'wistiti_post_navigation' ) ) :
 /**
  *
  */
 function wistiti_post_navigation($args) {

   $post_navigation_args = array();
   if (isset($args['post_navigation']['prev_text'])) $post_navigation_args['prev_text'] = $args['post_navigation']['prev_text'];
   if (isset($args['post_navigation']['next_text'])) $post_navigation_args['next_text'] = $args['post_navigation']['next_text'];
   if (isset($args['post_navigation']['in_same_term'])) {
     $post_navigation_args['post_navigation']['in_same_term'] = $args['post_navigation']['in_same_term'];
     if ($args['post_navigation']['in_same_term']==true && isset($args['post_navigation']['tax_value']) && (!empty($args['post_navigation']['tax_value'])))
     	$post_navigation_args['post_navigation']['taxonomy'] = $args['post_navigation']['tax_value'];
   }
   if (isset($args['post_navigation']['screen_reader_text'])) $post_navigation_args['screen_reader_text'] = $args['post_navigation']['screen_reader_text'];

   $markup = get_the_post_navigation($post_navigation_args);

	 //Replace and customize native classes
	 $markup = preg_replace('/\bnavigation\b/', $args['post_navigation']['wrapper'], $markup);
	 $markup = str_replace('nav-links',  $args['post_navigation']['links'], $markup);
	 $markup = str_replace('nav-previous', 'js-post-navigation-previous '.$args['post_navigation']['wrapper_previous'], $markup);
	 $markup = str_replace('nav-next', 'js-post-navigation-next '. $args['post_navigation']['wrapper_next'], $markup);
	 $markup = str_replace('screen-reader-text', 'screen-reader-text '. $args['post_navigation']['screen_reader_text'], $markup);
	 //To do with js ! previous and next <a> links cannot be accessed with PHP (no WP filter available to add a php_... class to be replaced)
	 $markup .= "<script>
		var navprevious = document.querySelector('.js-post-navigation-previous');
		if (navprevious!=null) {
		var prev_link = navprevious.querySelector('a');
		if (prev_link!=null) prev_link.classList.add(".wistiti_split_string_instrings($args['post_navigation']['previous_link']).");
		}
		var navnext = document.querySelector('.js-post-navigation-next');
		if (navnext!=null) {
		var next_link = navnext.querySelector('a');
		if (next_link!=null) next_link.classList.add(".wistiti_split_string_instrings($args['post_navigation']['next_link']).");
		}
		</script>";

   echo $markup;
}
endif;

 if ( ! function_exists( 'wistiti_previous_posts_link' ) ) :
 /**
  *
  */
function wistiti_previous_posts_link($label, $args){
	$markup = get_previous_posts_link($label);
	//Replace and customize native classes
	$markup = str_replace('php-posts-navigation-previous', $args['post_navigation']['previous_link'], $markup);
	return $markup;
}
endif;

if ( ! function_exists( 'wistiti_next_posts_link' ) ) :
/**
 *
 */
function wistiti_next_posts_link($label, $args){
	$markup = get_next_posts_link($label);
	//Replace and customize native classes
	$markup = str_replace('php-posts-navigation-next', $args['post_navigation']['next_link'], $markup);
 	return $markup;
}
endif;

if ( ! function_exists( 'wistiti_posted_on' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function wistiti_posted_on($args) {
	$time_string = '<time datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time datetime="%1$s">%2$s</time><time class="dn" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	$posted_on = sprintf(
		esc_html_x( 'Posted on %s', 'post date', 'wistiti' ),
		'<a class="'.$args['date_link'].'" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
	);

	$byline = sprintf(
		esc_html_x( 'by %s', 'post author', 'wistiti' ),
		'<a class="'.$args['author_link'].'" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a>'
	);

	echo '<span class="'.$args['date'].'">' . $posted_on . '</span><span class="'.$args['author'].'">' . $byline . '</span>';

}
endif;

if ( ! function_exists( 'wistiti_post_thumbnail' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 */
function wistiti_post_thumbnail($args) {

	$iconname = get_post_meta( get_the_ID(), '_element_icon_name', true );


	if ($args['options']['has_link']) echo '<a class="'.$args['classes']['thumbnail_link'].'" href="'.get_the_permalink().'"><?php endif; ?>';

		echo '<figure class="'. $args['classes']['thumbnail_wrapper'].'">';

			if (has_post_thumbnail()) {
				echo the_post_thumbnail( 'medium_large', ['alt' => '', 'class' => $args['classes']['thumbnail']] );
			} else {
				if (!empty($iconname)) {
					//For now, override this template and add here : display the icon according to the SVGs inlined in your wistiti child theme -->
					//For example : http://geomicons.com/. Embed only used icons.-->
					echo '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" class="'.$args['classes']['icon_color'].' w-'.$args['classes']['icon_size'].'">
						<use xlink:href="#'.$iconname.'"></use>
						</svg>';
				}
			}

		echo '</figure>';

	if ($args['options']['has_link']) echo '</a>';

}
endif;

if ( ! function_exists( 'wistiti_post_title' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 */
function wistiti_post_title($args, $headinghierarchy='1', $has_link = true) {
	  echo '<h'.$headinghierarchy.' class="'.$args['classes']['title'].'">';
		echo '<a class="'.$args['classes']['title_link'].'" href="'.get_the_permalink().'" rel="bookmark">';
		the_title();
		echo '</a>';
		echo '</h'.$headinghierarchy.'>';
}
endif;

if ( ! function_exists( 'wistiti_post_excerpt' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 */
function wistiti_post_excerpt($args, $headinghierarchy='2') {

	$theexcerpt = '';
  if(has_excerpt()) $theexcerpt = get_the_excerpt();
	if (!empty($theexcerpt)) {
		echo '<h'.$headinghierarchy.' class="'.$args['classes']['excerpt'].'">';
		echo $theexcerpt;
		echo '</h'.$secondheadinghierarchy.'>';
	}

}
endif;

if ( ! function_exists( 'wistiti_post_content' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 */
function wistiti_post_content($args) {
	 $thecontent = wpautop(get_the_content(__('Continue reading...', 'wistiti')));

	 //More link : replace and customize native classes
	 $morelink = 'more-link';
	 $thecontent = str_replace($morelink, $args['classes']['content_link'], $thecontent );

	if (!empty($thecontent)) {
		echo '<div class="'.$args['classes']['content'].'">';
		echo '<p>';
		echo $thecontent;
		echo '</p>';
		echo '</div>';

		/*if (isset($args['classes']['content_link']) && !empty($args['classes']['content_link'])) {
			echo "<script>
			var morewrapper= document.querySelector('.more-link');
			if (morewrapper!=null) {
				morewrapper.classList.add(".wistiti_split_string_instrings($args['classes']['content_link']).");
			}
			</script>";
		}*/
	}

}
endif;

if ( ! function_exists( 'wistiti_post_action' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 *
 */
function wistiti_post_action($args) {

	$theaction = get_post_meta( get_the_ID(), '_element_action_url', true );
  if (!empty($theaction)) {
		echo '<a class="'.$args['classes']['action_link'].'" href="'.$theaction.'" target="_blank" role="button" tabindex="0">';
		echo get_post_meta( get_the_ID(), '_element_action_label', true );
		echo '</a>';
	}
}
endif;

if ( ! function_exists( 'wistiti_post_source' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 *
 */
function wistiti_post_source($label, $args) {
	$name = get_post_meta( get_the_ID(), '_element_source_name', true );
	$url = get_post_meta( get_the_ID(), '_element_source_url', true );
	if (!empty($name) && !empty($url)) {
		echo '<div class="'.$args['classes']['source_wrapper'].'">';
		echo '<span>'.$label.'</span>';
		echo '<span><a class="'.$args['classes']['source_link'].'" href="'.$url.'">';
		echo $name;
		echo '</a></span>';
		echo '</div>';
	}
}
endif;


if ( ! function_exists( 'wistiti_post_social' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 *
 */
function wistiti_post_social($label, $args) {

	$i=0;
	$thelist = array();

	echo '<div class="'.$args['classes']['social_wrapper'].'">'.$label;
	while (!empty(get_post_meta( get_the_ID(), '_element_social_name_'.$i, true )) &&
		  	 !empty(get_post_meta( get_the_ID(), '_element_social_url_'.$i, true )))
	{

		$aspan = '<span class='.$args['classes']['social'].'><a class="'.$args['classes']['social_link'].'" href="'.get_post_meta( get_the_ID(), '_element_social_url_'.$i, true ).'">';
		$aspan .= get_post_meta( get_the_ID(), '_element_social_name_'.$i, true );
		$aspan .= '</a></span>';
		$thelist[] = $aspan;

		$i++;
	}
	$links = apply_filters( "social_links-".$taxonomy, $thelist );
	echo join( ',' , $links );
	echo '</div>';

}
endif;


if ( ! function_exists( 'wistiti_post_taxonomies' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 */
function wistiti_post_taxonomies($type, $taxonomy='', $args=array()) {

	//All taxonomies
	if ( $type === get_post_type() ) {
		if (empty($taxonomy)) $taxonomy_names = get_post_taxonomies();
		else $taxonomy_names = explode(',', $taxonomy);

		foreach ($taxonomy_names as $taxonomy_name) {
			$tags = wp_get_post_terms(get_post()->ID, $taxonomy_name);
			//Display the terms
			wistiti_display_taxonomy_terms($type, $taxonomy_name, $tags, $args);
		}
	}

}
endif;

if ( ! function_exists( 'wistiti_display_taxonomy_terms' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 */
function wistiti_display_taxonomy_terms($type ='post', $taxonomy, $terms, $args=array()) {
	if (!empty($terms)) {
		echo '<div class="'.$args['classes']['taxonomies'][$taxonomy]['wrapper'].'">';
		$thelist=array();
		foreach($terms as $term) {
			$term_link = get_term_link( $term, $taxonomy );
			$thelist[] = '<a class= "'.$args['classes']['taxonomies'][$taxonomy]['link'].'" href="'.$term_link.'" role="button">' . $term->name . '</a>';
		}
		$links = apply_filters( "term_links-".$taxonomy, $thelist );
		echo join( ',' , $links );
		echo '</div>';
	}
}
endif;

if ( ! function_exists( 'wistiti_post_comments_link' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wistiti_post_comments_link($args) {

	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="'.$args['comments_popup'].'">';
		comments_popup_link( esc_html__( 'Leave a comment', 'wistiti' ), esc_html__( '1 Comment', 'wistiti' ), esc_html__( '% Comments', 'wistiti' ), $args['comments_popup_link'] );
		echo '</span>';
	}

	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'wistiti' ),
			the_title( '<span class="clip screen-reader-text">"', '"</span>', false )
		),
		'<span>',
		'</span>'
	);
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function wistiti_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'wistiti_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'wistiti_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so wistiti_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so wistiti_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in wistiti_categorized_blog.
 */
function wistiti_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'wistiti_categories' );
}
add_action( 'edit_category', 'wistiti_category_transient_flusher' );
add_action( 'save_post',     'wistiti_category_transient_flusher' );
