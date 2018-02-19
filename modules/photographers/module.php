<?php
use UF3\Container;
use UF3\Field;

add_action( 'uf.init', 'showcase_photographer_fields' );
function showcase_photographer_fields() {
	Container::create( 'image-photographer' )
		->add_location( 'attachment' )
		->add_fields(array(
			Field::create( 'object', 'photographer', __( 'Photographer', 'showcase' ) )
				->add( 'users' )
		));

	Container::create( 'photographer-data' )
		->add_location( 'user' )
		->add_fields(array(
			Field::create( 'link', 'copyrights_link' )
		));
}

/**
 * Display on the right place/page
 */
