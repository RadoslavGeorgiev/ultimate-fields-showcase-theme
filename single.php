<?php get_header() ?>

<div class="main">
	<div class="center">
		<?php if ( function_exists('yoast_breadcrumb') ): ?>
		<div class="breadcrumbs">
			<?php yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' ) ?>
		</div>
		<?php endif ?>

		<div class="content">
			<?php while( have_posts() ): the_post() ?>
				<div <?php post_class() ?>>
					<div class="rte">
						<h1><?php the_title() ?></h1>
						<?php the_content() ?>
					</div>
				</div>
			<?php endwhile ?>
		</div>

		<div class="sidebar">
			<?php dynamic_sidebar( 'default-sidebar' ) ?>
		</div>
	</div>
</div>

<?php get_footer() ?>
