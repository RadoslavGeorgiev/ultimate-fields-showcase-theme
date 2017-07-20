<div class="main">
	<div class="center">
		<?php while( have_posts() ): the_post() ?>
			<h1><?php the_title() ?></h1>

			<?php the_value( 'event_location' ) ?>

			<div class="rte">
				<?php the_content() ?>
			</div>
		<?php endwhile ?>
	</div>
</div>