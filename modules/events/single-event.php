<div class="section main">
	<div class="section__center">
		<?php while( have_posts() ): the_post() ?>
			<?php the_value( 'event_location' ) ?>

			<div class="rte">
				<?php the_content() ?>
			</div>
		<?php endwhile ?>
	</div>
</div>
