<?php
use UF3\Container;
use UF3\Field;

/**
 * Register color fields for the customizer, which allow us to change the general site colors,
 * as well as the individual color for every page.
 */
add_action( 'uf.init', 'showcase_colors_fields' );
function showcase_colors_fields() {
	// This container lets us adjust the general colors of the theme
	Container::create( 'theme-colors', __( 'Theme colors', 'showcase' ) )
		->add_location( 'options', $GLOBALS['showcase_options_page'], [
			'show_in_customizer' => true,
			'postmessage_fields' => [ 'main_color' ]
		])
		->add_fields(array(
			Field::create( 'color', 'main_color', __( 'Main color', 'showcase' ) )
				->set_default_value( '#006b67' )
				->set_description( __( 'This color will be used for the header and footer backgrounds, as well as various accents throughout the theme.', 'showcase' ) )
		));
}

/**
 * Output custom CSS in the header.
 */
add_action( 'wp_enqueue_scripts', 'showcase_colors_css' );
function showcase_colors_css() {
	$color = get_value( 'main_color', 'option' );

	$css = "
	body, .main-background {
		background-color: $color;
	}

	.main-border {
		border-color: $color;
	}
	";

	wp_add_inline_style( 'showcase', $css );
}

/**
 * Add scripts to the front-end that will change the color without reloading the page.
 */
add_action( 'customize_preview_init', 'showcase_colors_js' );
function showcase_colors_js() {
	$uri = get_template_directory_uri() . '/modules/colors/customizer.js';

	wp_enqueue_script( 'showcase-colors', $uri, array( 'jquery', 'uf-customize-preview' ), '', true );
}
