<?php
	global $navigation_args;
	get_template_part( 'components/navigation/navigation-main', 'customizer' );
?>

<nav id="js-site-navigation" class="<?php echo $navigation_args['classes']['navigation']; ?>" role="navigation">
		<button class="<?php echo $navigation_args['classes']['button']; ?>" aria-controls="main-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'wistiti' ); ?></button>
		<?php
			wp_nav_menu(array(
			    'theme_location' => 'menu-1',
					'menu_id' => 'js-main-menu',
					'container'=> false,
					'items_wrap' => '<ul id="js-main-menu" class="'.$navigation_args['classes']['wrapper'].' cmzr-navigation-menu" role="menubar">%3$s</ul>',
			    'walker'  => new Wistiti_Walker_Main_Menu($navigation_args['classes']['items']) //use wistiti custom walker in functions.php
			));
			?>
</nav>
<noscript>
	<!-- Force visibility of menu & submenu -->
	<nav id="js-site-navigation" class="<?php echo $navigation_args['classes']['navigation']; ?> db" role="navigation">
			<button class="<?php echo $navigation_args['classes']['button']; ?>" aria-controls="main-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'wistiti' ); ?></button>
			<?php
				wp_nav_menu(array(
				    'theme_location' => 'menu-1',
						'menu_id' => 'js-main-menu',
						'container'=> false,
						'items_wrap' => '<ul id="js-main-menu" class="'.$navigation_args['classes']['wrapper'].' db cmzr-navigation-menu" role="menubar">%3$s</ul>',
				    'walker'  => new Wistiti_Walker_Main_Menu($navigation_args['classes']['items']) //use wistiti custom walker in functions.php
				));
				?>
	</nav>
</noscript>


<?php unset($navigation_args);?>
