<?php
global $header_args;
//get_template_part( 'components/header/site-header', 'customizer' );
get_customizer('components/header/site-header');

global $branding_args;
//get_template_part( 'components/header/site-branding', 'customizer' );
get_customizer('components/header/site-branding');

//inline
$inline = $header_args['options']['inline'];
if ($inline) {
	$breakpoint_ext = ($header_args['options']['inline_breakpoint']!='s')?'-'.$header_args['options']['inline_breakpoint']:'';

	//modify wrapper for inlineing branding and navigation on sigle row
	$branding_args['classes']['wrapper'] .= 'flex-auto'.$breakpoint_ext.' flex'.$breakpoint_ext;
}

?>

<div class="<?php echo $branding_args['classes']['wrapper']; ?>">
	<?php if (!empty(get_theme_mod( 'smew_siteidentity_minilogo', '' ))) : ?>
		<div class="<?php echo $branding_args['classes']['minilogo_wrapper'];?> cmzr-site-minilogo">
			<img class="<?php echo $branding_args['classes']['minilogo'];?>" src="<?php echo get_theme_mod( 'smew_siteidentity_minilogo', '' );?>" alt="<?php bloginfo( 'name' ); ?>">
		</div>
	<?php endif;?>

	<div>
	<?php if ( is_front_page() /*&& is_home()*/ ) : ?>
		<h1 class="<?php echo $branding_args['classes']['title'];?> cmzr-site-title">
			<a class="<?php echo $branding_args['classes']['title_link'];?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	<?php else : ?>
		<p class="<?php echo $branding_args['classes']['title'];?> cmzr-site-title">
			<a class="<?php echo $branding_args['classes']['title_link'];?>" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
	<?php endif;

	//Add Brandig description below ?
	if ($branding_args['options']['activate']) :
		$description = get_bloginfo( 'description', 'display' );
			if ( $description || is_customize_preview() ) : ?>
				<p class="<?php echo $branding_args['classes']['description'];?> cmzr-site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
			<?php endif; ?>
	<?php endif; ?>

	<?php if ( is_front_page() /*&& is_home()*/ ) : ?>
		</h1>
	<?php else : ?>
		</p>
	<?php endif; ?>

</div>

</div>

<?php unset($header_args); unset($branding_args);?>
