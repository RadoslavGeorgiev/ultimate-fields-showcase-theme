<div class="loop">
<?php while( have_posts() ): the_post() ?>
	<div <?php post_class( 'loop__post' ) ?>>
		<h2 class="loop__title">
			<a class="loop__link" href="<?php the_permalink() ?>"><?php the_title() ?></a>
		</h2>

		<div class="rte loop__text">
			<?php the_content() ?>
		</div>
	</div>
<?php endwhile ?>
</div>
