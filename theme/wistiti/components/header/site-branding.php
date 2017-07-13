<?php
global $branding_args;
get_template_part( 'components/header/site-branding', 'customizer' );

//To do : use args in this template !
?>


<div class="flex-auto">
	<div class="flex items-center ">

	<?php if (!empty(get_theme_mod( 'smew_siteidentity_minilogo', '' ))) : ?>
		<div class="cmzr-site-minilogo">
			<img class="w2 w3-l mr2" src="<?php echo get_theme_mod( 'smew_siteidentity_minilogo', '' );?>" alt="<?php bloginfo( 'name' ); ?>">
		</div>
	<?php endif;?>

		<div>
			<?php if ( is_front_page() /*&& is_home()*/ ) : ?>
				<h1 class="f7 f6-m f5-ns ma0 cmzr-site-title">
					<a class="link black" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php else : ?>
				<p class="f7 f6-m f5-ns fw7 ma0 cmzr-site-title">
					<a class="link black" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
			<?php endif;

			//Add Brandig description below ?
			if ($branding_args['options']['activate']) :
				$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) : ?>
						<p class="f7 f6-m f5-ns fw1 ma0 cmzr-site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
			<?php endif; ?>

			<?php if ( is_front_page() /*&& is_home()*/ ) : ?>
				</h1>
			<?php else : ?>
				</p>
			<?php endif; ?>

		</div>

  </div>
</div>
