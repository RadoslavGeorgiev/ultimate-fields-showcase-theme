<?php
use Ultimate_Fields\Container;
use Ultimate_Fields\Field;

add_action( 'uf.init', 'showcase_shortcode_fields' );
function showcase_shortcode_fields() {
	$template = file_get_contents( __DIR__ . '/preview.html' );

	Container::create( 'Quote' )
		->add_location( 'shortcode', array(
			'template' => $template
		))
		->add_fields(array(
			Field::create( 'section', 'quote_content', __( 'Content', 'showcase' ) )
				->set_icon( 'dashicons-admin-comments' ),
			Field::create( 'textarea', 'text', __( 'Text', 'showcase' ) )
				->required(),
			Field::create( 'text', 'author', __( 'Author', 'showcase' ) )
				->required(),
			Field::create( 'section', 'quote_appearance', __( 'Appearance', 'showcase' ) )
				->set_icon( 'dashicons-admin-appearance' ),
			Field::create( 'color', 'text_color', __( 'Text Color', 'showcase' ) )
				->required()
				->set_default_value( '#333333' ),
			Field::create( 'color', 'background_color', __( 'Background Color', 'showcase' ) )
				->required()
				->set_default_value( '#eeeeee' ),
		));
}

add_shortcode( 'quote', 'showcase_quote' );
function showcase_quote( $atts ) {
	ob_start();
	include __DIR__ . '/template.php';
	return ob_get_clean();
}
