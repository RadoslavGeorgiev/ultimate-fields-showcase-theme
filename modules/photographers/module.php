<?php
use UF3\Container;
use UF3\Field;

add_action( 'uf.init', 'showcase_photographer_fields' );
function showcase_photographer_fields() {
	Container::create( 'image-photographer' )
		->add_location( 'attachment' )
		->add_fields(array(
			Field::create( 'wp_object', 'photographer', __( 'Photographer', 'showcase' ) )
				->add( 'users' )
		));

	Container::create( 'photographer-data' )
		->add_location( 'user' )
		->add_fields(array(
			Field::create( 'link', 'copyrights_link' )
		));
}

/**
 * Display credits after the featured image.
 */
add_action( 'showcase.after_thumbnail', 'showcase_photographer_credits' );
function showcase_photographer_credits() {
	$image_id     = get_post_thumbnail_id();
	$photographer = get_value( 'photographer', $image_id );

	if( ! $photographer ) {
		return;
	}

	$name = esc_html( $photographer->data->display_name );

	// Check for a link
	if( $link = get_value( 'copyrights_link', 'user_' . $photographer->ID ) ) {
		$name = sprintf(
			'<a href="%s">%s</a>',
			esc_url( $link['link'] ),
			$name
		);
	}

	echo "<p class='credits'>Photo credits: $name</p>";
}
