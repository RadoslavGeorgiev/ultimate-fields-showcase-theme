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
				<a href="<?php echo home_url() ?>"><?php bloginfo() ?></a>
				<?php if( $title = showcase_get_title() ): ?>
				<strong><?php echo $title ?></strong>
				<?php endif ?>
			</div>
		</div>

		<?php
		$menu_args = array(
			'theme_location'  => 'main-menu',
			'container_class' => 'main-menu',
			'menu_class'      => 'menu center'
		);

		$menu_args = apply_filters( 'showcase.main_menu_args', $menu_args );
		wp_nav_menu( $menu_args );
		?>
	</header>
