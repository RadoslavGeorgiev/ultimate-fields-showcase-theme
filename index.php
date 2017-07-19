<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<?php wp_head() ?>
	</head>
	<body>
		<header class="header">
			<div class="center">
				<a href="<?php echo home_url() ?>" class="logo"><?php bloginfo() ?></a>
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

		<?php if( ! apply_filters( 'showcase.content', false ) ): ?>
			<?php the_post(); the_content() ?>
		<?php endif ?>

		<?php wp_footer() ?>
</body>
</html>