<?php if( $object = get_sub_value( 'object' ) ): ?>
<a href="<?php echo get_permalink( $object->ID ) ?>" class="teaser">
	<?php if( has_post_thumbnail( $object->ID ) ): ?>
	<div class="teaser__image">
		<?php echo get_the_post_thumbnail( $object->ID, 'block-' . get_group_width() ) ?>
	</div>
	<?php endif ?>

	<h4 class="teaser__title"><?php echo esc_html( $object->post_title ) ?></h4>
</a>
<?php endif ?>
