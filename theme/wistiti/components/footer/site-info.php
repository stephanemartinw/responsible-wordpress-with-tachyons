<?php
	$wcounter=0;
	$wwidth=100;
	if ( is_active_sidebar( 'footer-1' ) ) $wcounter++;
	if ( is_active_sidebar( 'footer-2' ) ) $wcounter++;
	if ( is_active_sidebar( 'footer-3' ) ) $wcounter++;
	if ($wcounter!=0) $wwidth = floor(100 / $wcounter);
?>

<div class="cf pv4">

		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		  <div class="fl w-100 w-<?php echo $wwidth; ?>-ns pa2">
				<div class="cf">

					  <div class="fl w-100 w-25-ns tc pa2">
								<img itemprop="logo" class="w-25 w-100-ns h-auto" src="<?php wistiti_theme_the_custom_logo_src(); ?>" alt="<?php bloginfo( 'name' ); ?>"\>
						</div>

						<div class="fl w-100 w-75-ns pa2">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
				</div>
			</div>
		<?php endif;?>

		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<div class="fl w-100 w-<?php echo $wwidth; ?>-ns pa2">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>
		<?php endif;?>

		<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="fl w-100 w-<?php echo $wwidth; ?>-ns pa2">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>
		<?php endif;?>

</div>
