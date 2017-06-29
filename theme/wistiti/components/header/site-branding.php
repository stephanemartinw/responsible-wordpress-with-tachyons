<div class="flex-auto">
	<?php
	if ( is_front_page() /*&& is_home()*/ ) : ?>
		<h1 class="f7 f6-m f5-ns ma0 cmzr-site-title"><a class="link black" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
	<?php else : ?>
		<p class="f7 f6-m f5-ns fw7 ma0 cmzr-site-title"><a class="link black" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
	<?php
	endif;

	if (get_theme_mod( 'smew_branding_description', true )) :
	$description = get_bloginfo( 'description', 'display' );
		if ( $description || is_customize_preview() ) : ?>
			<p class="f7 f6-m f5-ns ma0 cmzr-site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
		<?php endif; ?>
	<?php endif; ?>
</div>
