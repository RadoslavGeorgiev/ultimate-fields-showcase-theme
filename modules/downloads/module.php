<?php
use Ultimate_Fields\Container;
use Ultimate_Fields\Field;

/**
 * Module name: Downloads
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md
 */

add_action( 'uf.init', 'showcase_add_downloads' );
function showcase_add_downloads() {
	Container::create( 'post-downloads' )
		->add_location( 'post_type', 'post' )
		->add_fields(array(
			Field::create( 'file', 'downloadable_file', __( 'Downloadable file', 'showcase' ) )
				->set_description( __( 'A link to this file will be displayed after the content.', 'showcase' ) )
		));
}

add_filter( 'the_content', 'showcase_render_downloads' );
function showcase_render_downloads( $content ) {
	if( $file = get_value( 'downloadable_file' ) ) {
		$content .= sprintf(
			'<a href="%s" download><span class="fa fa-download"></span> %s</a>',
			wp_get_attachment_url( $file ),
			esc_html( get_the_title( $file ) )
		);
	}

	return $content;
}
