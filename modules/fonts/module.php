<?php
use UF3\Container;
use UF3\Field;

/**
 * Module name: Fonts
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md for details
 */

add_action( 'uf.init', 'showcase_add_fonts_page' );
function showcase_add_fonts_page() {
	$container = Container::create( 'fonts' )
		->add_location( 'options', $GLOBALS['showcase_options_page'] );

	if( get_option( 'uf_google_fonts_api_key' ) ) {
		$field = Field::create( 'font', 'body_font', __( 'Body Font', 'showcase' ) )
			->set_description( __( 'This font will be applied to the whole website.', 'showcase' ) );
	} else {
		$description = __( 'Please go to Ultimate Fields > Settings and enter an API key.', 'showcase' );
		$field = Field::create( 'message', 'font_api', __( 'Missing API Key', 'showcase' ) )
			->set_description( $description );
	}

	$container->add_field( $field );
}

/**
 * Load the font stylesheet in the front-end.
 */
add_action( 'wp_enqueue_scripts', 'showcase_load_font' );
function showcase_load_font() {
	$font = get_value( 'body_font', 'option' );

	if( ! $font ) {
		return;
	}

	// Enqueue the actual font
	$url = Field\Font::get_font_url( $font );
	wp_enqueue_style( $font['family'], $url );

	// Add some styles
	$css = 'body {
		font-family: "' . $font['family'] . '", Sans-Serif;
	}';

	wp_add_inline_style( 'showcase', $css );
}
