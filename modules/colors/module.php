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
		->add_location( 'options', false, [
			'show_in_customizer' => true,
			'postmessage_fields' => [ 'header_color' ]
		])
		->add_fields(array(
			Field::create( 'color', 'header_color', __( 'Header color', 'showcase' ) )
		));
}

/**
 * Output custom CSS in the header.
 */
add_action( 'wp_head', 'showcase_colors_css' );
function showcase_colors_css() {
	$color = get_value( 'header_color', 'option' );

	?>
	<style media="screen">
	.header {
		background-color: <?php echo $color ?>;
	}
	</style>
	<?php
}

/**
 * Add scripts to the front-end that will change the color without reloading the page.
 */
add_action( 'customize_preview_init', 'showcase_colors_js' );
function showcase_colors_js() {
	$uri = get_template_directory_uri() . '/modules/colors/customizer.js';

	wp_enqueue_script( 'showcase-colors', $uri, array( 'jquery', 'uf-customize-preview' ), '', true );
}
