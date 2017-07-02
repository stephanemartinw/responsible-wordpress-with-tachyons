<?php
	$wcounter=0;
	$wwidth=100;
	if ( is_active_sidebar( 'footer-1' ) ) $wcounter++;
	if ( is_active_sidebar( 'footer-2' ) ) $wcounter++;
	if ( is_active_sidebar( 'footer-3' ) ) $wcounter++;
	if ($wcounter!=0) $wwidth = floor(100 / $wcounter);
?>

<div class="cf">

		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		  <div class="fl w-100 w-<?php echo $wwidth; ?>-ns">
				<div class="flex">

						<?php
							$logo_src = wistiti_theme_the_custom_logo_src();
							$logo_width = 0;
							if (!empty($logo_src)) : $logo_width=25;?>
							  <div class="w2 w4-ns tc pa2">
										<img class="w-25 w-100-ns h-auto" src="<?php echo $logo_src; ?>" alt="<?php bloginfo( 'name' ); ?>"\>
								</div>
						<?php endif; ?>

						<?php $footer1_width = 100 - $logo_width;?>
						<div class="flex-auto pa2">
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
