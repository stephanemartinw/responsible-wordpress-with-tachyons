<nav id="site-navigation" class="cb db toggler" role="navigation">
		<button class="db dn-l bn bg-transparent ttu f5 pointer" aria-controls="top-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'smew_theme' ); ?></button>
		<?php
			wp_nav_menu(array(
			    'theme_location' => 'menu-1',
					'menu_id' => 'top-menu',
					'container'=> false,
					'items_wrap' => '<ul class="absolute z-1 top-100 left-0 w-100 w-auto-l relative-l dn db-l list ma0 pa0 bg-'.get_theme_mod( 'smew_colors_brand', 'blue' ).' bg-transparent-l cmzr-navigation-menu">%3$s</ul>',
			    'walker'  => new Walker_Quickstart_Menu() //use our custom walker in functions.php
			));
			?>
</nav>
