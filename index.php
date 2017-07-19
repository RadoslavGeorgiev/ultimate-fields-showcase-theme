<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">

		<?php wp_head() ?>
	</head>
	<body>
		<header class="header">
			<?php
			$menu_args = array(
				'theme_location' => 'main-menu'
			);

			$menu_args = apply_filters( 'showcase.main_menu_args', $menu_args );
			wp_nav_menu( $menu_args );
			?>
		</header>
		
		<?php the_post(); the_content() ?>

		<?php wp_footer() ?>
</body>
</html>