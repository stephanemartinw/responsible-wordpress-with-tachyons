<?php
	global $navigation_args;
	//get_template_part( 'components/navigation/navigation-main', 'customizer' );
	get_customizer('components/navigation/navigation-main');

	//Manage expanding
	if (isset($navigation_args['options']['expand'])) {

		$expand = $navigation_args['options']['expand'];
		if ($expand) {
			if (!isset($navigation_args['options']['expand_breakpoint'])) $navigation_args['options']['expand_breakpoint']='ns';

			$breakpoint_ext = ($navigation_args['options']['expand_breakpoint']!='s')?'-'.$navigation_args['options']['expand_breakpoint']:'';
			$navigation_args['options']['expand_breakpoint_ext'] = $breakpoint_ext; // for walker

			if (empty($breakpoint_ext)) {
				$navigation_args['classes']['items']['level'][0]['list'] .= ' relative w-auto db';
				$navigation_args['classes']['button'] .= ' dn';
			}
			else {
				$navigation_args['classes']['items']['level'][0]['list'] .= ' absolute relative'.$breakpoint_ext.' top-100 left-0 w-100 w-auto'.$breakpoint_ext.' dn db'.$breakpoint_ext;
				$navigation_args['classes']['button'] .= ' db dn'.$breakpoint_ext;
			}
		}
		else  {
			$navigation_args['classes']['items']['level'][0]['list'] .= ' absolute top-100 left-0 w-100 dn';
			$navigation_args['classes']['button'] .= ' db';
		}
	}
?>

<nav id="js-site-navigation" class="<?php echo $navigation_args['classes']['wrapper']; ?>" role="navigation">

		<button class="<?php echo $navigation_args['classes']['button']; ?>" aria-controls="main-menu" aria-expanded="false"><?php esc_html_e( 'Menu', 'wistiti' ); ?></button>
		<?php
			wp_nav_menu(array(
			    'theme_location' => 'menu-1',
					'menu_id' => 'js-main-menu',
					'container'=> false,
					'items_wrap' => '<ul id="js-main-menu" class="'.$navigation_args['classes']['items']['level'][0]['list'].' cmzr-navigation-menu" role="menubar">%3$s</ul>',
			    'walker'  => new Wistiti_Walker_Main_Menu($navigation_args) //use wistiti custom walker in functions.php
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
						'items_wrap' => '<ul id="js-main-menu" class="'.$navigation_args['classes']['items']['level'][0]['list'].' db cmzr-navigation-menu" role="menubar">%3$s</ul>',
				    'walker'  => new Wistiti_Walker_Main_Menu($navigation_args) //use wistiti custom walker in functions.php
				));
				?>
	</nav>
</noscript>


<?php unset($navigation_args);?>
