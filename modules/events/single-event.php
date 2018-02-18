<div class="section main">
	<div class="section__center">
		<?php while( have_posts() ): the_post() ?>
			<?php if( get_value( 'event_is_phyisical' ) ): ?>
				<?php the_value( 'event_location' ) ?>
			<?php endif ?>

			<div class="rte">
				<?php the_content() ?>
			</div>
		<?php endwhile ?>
	</div>
</div>
