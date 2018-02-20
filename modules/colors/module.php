<?php
use UF3\Container;
use UF3\Field;

/**
 * Module name: Colors
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md for details
 */

/**
 * Register color fields for the customizer, which allow us to change the general site colors,
 * as well as the individual color for every page.
 */
add_action( 'uf.init', 'showcase_colors_fields' );
function showcase_colors_fields() {
	$message = __( 'You can change the accent color of the website directly in the <a href="%s">Customizer</a>, which lets you preview the color without saving it!', 'showcase' );
	$message = sprintf( $message, admin_url( 'wp-admin/customize.php?autofocus[section]=uf_section_theme_colors' ) );

	// This container lets us adjust the general colors of the theme
	$container = Container::create( 'theme-colors', __( 'Theme colors', 'showcase' ) )
		->add_location( 'options', $GLOBALS['showcase_options_page'], [
			'show_in_customizer' => true,
			'postmessage_fields' => [ 'color_type', 'main_color', 'predefined_color' ]
		]);

	if( ! is_customize_preview() ) {
		$container->add_field(
			Field::create( 'message', 'customizer_msg', __( 'Use in the Customizer', 'showcase' ) )
			->set_description( $message )
		);
	}

	$url = get_template_directory_uri() . '/modules/colors/colors/';

	// Add the standard fields
	$container->add_fields(array(
		Field::create( 'select', 'color_type', __( 'Color Type', 'showcase' ) )
			->set_input_type( 'radio' )
			->add_options(array(
				'default'    => __( 'Default color', 'showcase' ),
				'predefined' => __( 'Predefined color', 'showcase' ),
				'custom'     => __( 'Color', 'showcase' )
			))
			->set_description( __( 'This color will be used for the header and footer backgrounds, as well as various accents throughout the theme.', 'showcase' ) ),
		Field::create( 'image_select', 'predefined_color', __( 'Color', 'showcase' ) )
			->add_dependency( 'color_type', 'predefined' )
			->add_options(array(
				'#16bc9c' => array(
					'image' => $url . 'color-light-green.png',
					'label' => __( 'Green', 'showcase' )
				),
				'#199abc' => array(
					'image' => $url . 'color-light-blue.png',
					'label' => __( 'Blue', 'showcase' )
				),
				'#0bcdff' => array(
					'image' => $url . 'color-light-sky.png',
					'label' => __( 'Sky', 'showcase' )
				),
				'#bc1a65' => array(
					'image' => $url . 'color-light-purple.png',
					'label' => __( 'Purple', 'showcase' )
				),
				'#db3e2e' => array(
					'image' => $url . 'color-light-red.png',
					'label' => __( 'Red', 'showcase' )
				),
				'#ffc210' => array(
					'image' => $url . 'color-light-yellow.png',
					'label' => __( 'Yellow', 'showcase' )
				)
			)),
		Field::create( 'color', 'main_color', __( 'Main color', 'showcase' ) )
			->add_dependency( 'color_type', 'custom' )
			->set_default_value( '#0074a2' )
	));
}

/**
 * Output custom CSS in the header.
 */
add_action( 'wp_enqueue_scripts', 'showcase_colors_css' );
function showcase_colors_css() {
	$color = null;
	$type  = get_value( 'color_type', 'option' );

	switch( $type ) {
		case 'predefined':
			$color = get_value( 'predefined_color', 'option' );
			break;

		case 'custom':
			$color = get_value( 'main_color', 'option' );
			break;
	}

	$css = "
	body, .main-background {
		background-color: $color;
	}

	.main-border {
		border-color: $color;
	}

	.rte a {
		color: $color;
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

	wp_localize_script( 'showcase-colors', 'showcase_colors', array(
		'color_type'       => get_value( 'color_type', 'option' ),
		'predefined_color' => get_value( 'predefined_color', 'option' ),
		'main_color'       => get_value( 'main_color', 'option' )
	));
}
