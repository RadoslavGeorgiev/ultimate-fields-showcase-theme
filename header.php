<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
	<meta charset="utf-8">

	<?php wp_head() ?>
</head>
<body <?php body_class() ?>>
	<header class="section section--solid header">
		<div class="section__center header__center">
			<a href="<?php echo home_url() ?>" class="logo"><?php bloginfo() ?></a>

			<?php
			$menu_args = array(
				'theme_location' => 'main-menu',
				'container'      => false,
				'fallback_cb'    => 'showcase_fallback_menu',
				'menu_class'     => 'main-menu'
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
		</div>
	</header>

	<?php if( showcase_get_title() ): ?>
	<header class="section page-header">
		<div class="section__center page-header__center">
			<h1><?php echo esc_html( showcase_get_title() ) ?></h1>

			<?php if ( function_exists('yoast_breadcrumb') ): ?>
				<div class="breadcrumbs">
					<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ) ?>
				</div>
			<?php endif ?>
		</div>
	</header>
	<?php endif ?>
