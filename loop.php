<?php while( have_posts() ): the_post() ?>
	<div <?php post_class() ?>>
		<div class="rte">
			<?php the_content() ?>
		</div>
	</div>
<?php endwhile ?>
