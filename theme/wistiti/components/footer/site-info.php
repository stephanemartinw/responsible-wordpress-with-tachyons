<?php
	global $footer_args;
	//get_template_part( 'components/footer/site-info', 'customizer' );
	wistiti_get_theme_customizer('components/footer/site-info');

	if ($footer_args['options']['col']==0) return;

	//To do : use args in this template !
?>

<div class="<?php echo $footer_args['classes']['wrapper'];?>">

		<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
		  <div class="fl w-100 w-<?php echo $footer_args['options']['width'];?>-ns">
				<div class="cf">
						<?php
							if (!empty($footer_args['options']['logo_show'])) :?>
							  <div class="fl w-100 w-<?php echo $footer_args['options']['logo_width'];?>-ns tc pa2">
										<?php echo wistiti_theme_get_custom_logo($footer_args); ?>
								</div>
							<?php endif; ?>

						<?php $footer1_width = 100 - $footer_args['options']['logo_width'];?>
						<div class="fl w-100 w-<?php echo $footer1_width;?>-ns pa2">
							<?php dynamic_sidebar( 'footer-1' ); ?>
						</div>
				</div>

			</div>
		<?php endif;?>

		<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
			<div class="fl w-100 w-<?php echo $footer_args['options']['width']; ?>-ns pa2">
				<?php dynamic_sidebar( 'footer-2' ); ?>
			</div>
		<?php endif;?>

		<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
			<div class="fl w-100 w-<?php echo $footer_args['options']['width']; ?>-ns pa2">
				<?php dynamic_sidebar( 'footer-3' ); ?>
			</div>
		<?php endif;?>

</div>
