<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Wistiti
 */

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

if ( ! function_exists( 'wistiti_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function wistiti_entry_footer($args) {
	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {

		wistiti_element_footer('post','',$args);

		/* translators: used between list items, there is a space after the comma */
		//https://developer.wordpress.org/reference/functions/get_the_category_list/
		// No way to customize markup !
		/*$categories_list = get_the_category_list( esc_html__( ', ', 'wistiti' ) );
		if ( $categories_list && wistiti_categorized_blog() ) {
			printf( '<span>' . esc_html__( 'Posted in %1$s', 'wistiti' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}*/
		//To be replaced with...???
		/*$categories = get_the_category();
		if (!empty($categories)) {
				echo '<span class="'.$args['categories'].'">';
				$thelist='';
				foreach($categories as $category) {
					$thelist .= '<a class= "'.$args['category_link'].'" href="'.get_category_link( $category->term_id ).'">' . $category->cat_name . '</a>';
				}
				echo apply_filters( 'the_category', $thelist, ',', '' );
				echo '</span>';

		}*/

		/* translators: used between list items, there is a space after the comma */
		//https://developer.wordpress.org/reference/functions/get_the_tag_list/
		// No way to customize markup !
		/*$tags_list = get_the_tag_list( '', esc_html__( ', ', 'wistiti' ) );
		if ( $tags_list ) {
			printf( ' <span>' . esc_html__( 'Tagged %1$s', 'wistiti' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}*/
		//To be replaced with...???
		/*$tags = get_the_tags();
		wistiti_display_taxonomy_terms('post', 'post_tag', $tags, $args);*/
		/*if (!empty($tags)) {
				echo '<span class="'.$args['tags'].'">';
				$thelist=array();
				foreach($tags as $tag) {
					$tag_link = get_term_link( $tag, 'post_tag' );
					$thelist[] = '<a class= "'.$args['tag_link'].'" href="'.$tag_link.'">' . $tag->name . '</a>';
				}
				$links = apply_filters( "term_links-post_tag", $thelist );
 				echo join( ',' , $links );
				echo '</span>';
		}*/
	}

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


if ( ! function_exists( 'wistiti_element_footer' ) ) :
/**
 * Prints HTML with meta information for the taxonomies for Wistiti elements
 */
function wistiti_element_footer($type, $taxonomy='', $args=array()) {

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
		echo '<div class="'.$args['taxonomies'][$taxonomy]['wrapper'].'">';
		$thelist=array();
		foreach($terms as $term) {
			$term_link = get_term_link( $term, $taxonomy );
			$thelist[] = '<a class= "'.$args['taxonomies'][$taxonomy]['link'].'" href="'.$term_link.'" role="button">' . $term->name . '</a>';
		}
		$links = apply_filters( "term_links-".$taxonomy, $thelist );
		echo join( ',' , $links );
		echo '</div>';
	}
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
