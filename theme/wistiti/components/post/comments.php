<?php

if ( post_password_required() ) {
	return;
}

global $comments_args;
get_template_part( 'components/post/customizers/comments', 'customizer' );

//Attributes
$firstheadinghierarchy = $comments_args['attributes']['firstheadinghierarchy'];
$secondheadinghierarchy = $comments_args['attributes']['firstheadinghierarchy']+1;
?>

<div id="comments">
	<?php if ( have_comments() ) : ?>
		<h<?php echo $firstheadinghierarchy;?> class="<?php echo $comments_args['classes']['heading'];?>">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'wistiti' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h<?php echo $firstheadinghierarchy;?>>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : ?>
			<nav role="navigation">
				<h<?php echo $secondheadinghierarchy;?> class="clip screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wistiti' ); ?></h<?php echo $secondheadinghierarchy;?>>
				<div>
					<div><?php previous_comments_link( esc_html__( 'Older Comments', 'wistiti' ) ); ?></div>
					<div><?php next_comments_link( esc_html__( 'Newer Comments', 'wistiti' ) ); ?></div>
				</div>
			</nav>
		<?php endif; // Check for comment navigation. ?>

		<?php
			$list_comment_args = array();
			wp_list_comments( array(
				'walker' => new Wistiti_Walker_Comment($comments_args)
			) );
		?>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" role="navigation">
			<h<?php echo $secondheadinghierarchy;?> class="clip screen-reader-text"><?php esc_html_e( 'Comment navigation', 'wistiti' ); ?></h<?php echo $secondheadinghierarchy;?>>
			<div>
				<div><?php previous_comments_link( esc_html__( 'Older Comments', 'wistiti' ) ); ?></div>
				<div><?php next_comments_link( esc_html__( 'Newer Comments', 'wistiti' ) ); ?></div>
			</div>
		</nav>
		<?php
		endif;

	endif;

	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>
		<p><?php esc_html_e( 'Comments are closed.', 'wistiti' ); ?></p>
	<?php endif;

  //Comment form
  //from https://developer.wordpress.org/reference/functions/comment_form/
  if ( null === $post_id ) $post_id = get_the_ID();
  $commenter = wp_get_current_commenter();
  $user = wp_get_current_user();
  $user_identity = $user->exists() ? $user->display_name : '';
  $req      = get_option( 'require_name_email' );
  $aria_req = ( $req ? " aria-required='true'" : '' );

  //Use $comments_args['form'] to set skin
  $comment_form = array(
  'title_reply_before' =>'<h'.$comments_args['form']['attributes']['firstheadinghierarchy'].' class="'.$comments_args['form']['classes']['title_reply_before'].'">',
  'title_reply_after' => '</h'.$comments_args['form']['attributes']['firstheadinghierarchy'].'>',
  'fields' => apply_filters( 'comment_form_default_fields', array(
  			'author' => '<p>' . '<label for="author">' . __( 'Your Name' ) . '</label> ' . ( $req ? '<span>*</span>' : '' ) .
  									'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>',
  			'email'  => '<p>' .'<label for="email">' . __( 'Your Email Please' ) . '</label> ' .
  									( $req ? '<span>*</span>' : '' ) .
  									'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' />'.'</p>',
  			'url'    => '' )
  ),
  'comment_field' => 	'<p>' .
  										'<label class="'.$comments_args['form']['classes']['comment_field'].'" for="comment">' . __( 'Comment' ) . '</label>' .
  										'<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>' .
  										'</p>',

  'must_log_in'   => '<p>' . sprintf(
  							 /* translators: %s: login URL */
  							 __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
  							 wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
  					 ) . '</p>',
  /** This filter is documented in wp-includes/link-template.php */
  'logged_in_as'  => '<p>' . sprintf(
  							 /* translators: 1: edit user link, 2: accessibility text, 3: user name, 4: logout URL */
  							 __( '<a href="%1$s" aria-label="%2$s">Logged in as %3$s</a>. <a class="link" href="%4$s">Log out?</a>' ),
  							 get_edit_user_link(),
  							 /* translators: %s: user name */
  							 esc_attr( sprintf( __( 'Logged in as %s. Edit your profile.' ), $user_identity ) ),
  							 $user_identity,
  							 wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) )
  					 ) . '</p>',
  'comment_notes_before' => '<p><span>' . __( 'Your email address will not be published.' ) . '</span>'. ( $req ? $required_text : '' ) . '</p>',
  'comment_notes_after'  => '',
  'class_form' => '',
  'class_submit' => '',
  'submit_field' => '<p>%1$s %2$s</p>',
  'submit_button' => '<input name="%1$s" type="submit" id="%2$s" class="'.$comments_args['form']['classes']['submit_button'].'" value="%4$s" />'
  );
  comment_form($comment_form);?>
  
</div>
