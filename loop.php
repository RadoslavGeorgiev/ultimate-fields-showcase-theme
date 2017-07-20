<?php while( have_posts() ): the_post() ?>
	<div <?php post_class() ?>>
		<div class="rte">
			<h2><a href="<?php the_permalink() ?>"><?php the_title() ?></a></h2>
			<?php the_content() ?>
		</div>
	</div>
<?php endwhile ?>
