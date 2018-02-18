<div class="image-block">
	<?php
	$image = get_sub_value( 'image' );

	if( $image ) {
		echo wp_get_attachment_image( $image, 'block-' . get_group_width() );
	}
	?>
</div>
