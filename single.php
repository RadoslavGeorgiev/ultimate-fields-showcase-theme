<?php get_header() ?>

<?php if( ! apply_filters( 'showcase.content', false ) ): ?>
<div class="section main page-content">
	<div class="section__center page-content__center">
		<div class="page-content__main">
			<?php while( have_posts() ): the_post() ?>
			<div <?php post_class() ?>>
				<?php if( has_post_thumbnail() ): ?>
				<div class="page-content__image">
					<?php the_post_thumbnail( 'post-thumbnail' ) ?>

					<?php
					/**
					 * Allow modules to output content immediately after the image.
					 */
					do_action( 'showcase.after_thumbnail' );
					?>
				</div>
				<?php endif ?>

				<div class="rte">
					<?php do_action( 'showcase.before_post_content' ) ?>

					<?php the_content() ?>

					<?php do_action( 'showcase.after_post_content' ) ?>
				</div>

				<?php if ( comments_open() || get_comments_number() ) : ?>
					<?php comments_template() ?>
				<?php endif ?>
			</div>
			<?php endwhile ?>
		</div>

		<div class="page-content__sidebar">
			<?php dynamic_sidebar( 'sidebar-1' ) ?>
		</div>
	</div>
</div>
<?php endif ?>

<?php get_footer() ?>
