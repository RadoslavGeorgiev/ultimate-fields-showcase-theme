<div class="layout">
	<?php while( have_layout_rows( 'page_content' ) ): the_layout_row() ?>

		<?php
		/**
		 * This is an example of how a single block can occupy the full width of the page.
		 *
		 * See the readme for more details about this if-else statement.
		 */
		if( 'image' == get_group_type() && 12 == get_group_width() && get_sub_value( 'full_width' ) ): ?>

			<div class="full-width-image">
				<?php the_group() ?>
				<?php the_sub_value( 'image' ) ?>
			</div>

		<?php else: ?>

		<div class="section main layout-row">
			<div class="section__center">
				<?php
				/**
				 * This is the normal while loop for groups within the row.
				 * Here we are using the same API functions as when using repeater field:
				 *
				 * @see have_groups()
				 * @see the_group()
				 *
				 * Also, the following functions are only usable within the layout field:
				 * @see get_group_width()
				 */
				while( have_groups( 'page_content' ) ): the_group() ?>
					<div class="layout-column layout-column-<?php echo get_group_width() ?>">
						<?php include __DIR__ . '/block-' . get_group_type() . '.php' ?>
					</div>
				<?php endwhile ?>
			</div>
		</div>

		<?php endif ?>

	<?php endwhile ?>
</div>
