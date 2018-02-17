<?php echo $args['before_widget'] ?>

	<?php if( get_value( 'title', 'widget' ) ): ?>
		<?php echo $args['before_title'] ?>
			<?php the_value( 'title', 'widget' ) ?>
		<?php echo $args['after_title'] ?>
	<?php endif ?>

	<?php while( have_groups( 'sections', 'widget' ) ): the_group() ?>
		<div class="widget-section">
			<h3 class="widget-section__title"><?php the_sub_value( 'title' ) ?></h3>
			<div class="widget-section__text">
				<?php the_sub_value( 'text' ) ?>
			</div>
		</div>
	<?php endwhile ?>

<?php echo $args['after_widget'] ?>