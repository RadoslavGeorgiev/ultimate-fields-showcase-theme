<div class="main">
	<div class="center">
		<?php while( have_posts() ): the_post() ?>
		<div <?php post_class() ?>>
			<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
		</div>
		<?php endwhile ?>
	</div>
</div>