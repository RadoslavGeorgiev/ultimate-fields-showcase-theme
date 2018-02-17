<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="utf-8">

	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
	<header class="header">
		<div class="center">
			<div class="logo">
				<?php if( $title = showcase_get_title() ): ?>
					<a href="<?php echo home_url() ?>"><?php bloginfo() ?> / </a>
					<strong><?php echo $title ?></strong>
				<?php else: ?>
					<a href="<?php echo home_url() ?>"><?php bloginfo() ?></a>
				<?php endif ?>
			</div>
		</div>

		<?php
		$menu_args = array(
			'theme_location'  => 'main-menu',
			'container_class' => 'main-menu',
			'fallback_cb'     => 'showcase_fallback_menu',
			'menu_class'      => 'menu center'
		);

		/**
		 * Allows the arguments for the main menu to be changed by modules.
		 *
		 * @param array $menu_args The arguments for the menu.
		 * @return array
		 */
		$menu_args = apply_filters( 'showcase.main_menu_args', $menu_args );
		
		wp_nav_menu( $menu_args );
		?>
	</header>
