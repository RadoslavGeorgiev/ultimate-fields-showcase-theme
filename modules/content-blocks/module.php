<?php
use Ultimate_Fields\Container;
use Ultimate_Fields\Field;

/**
 * Remove the normal editor from the page, as we will be using content blocks for that.
 */
add_action( 'init', 'showcase_blocks_remove_editor' );
function showcase_blocks_remove_editor() {
	remove_post_type_support( 'page', 'editor' );

	for( $i=3; $i<=12; $i++ ) {
		$width = ( ( 1040 / 12 ) * $i ) - 40;
		$width = round( $width );
		add_image_size( 'block-' . $i, $width );
	}
}

/**
 * Register the layout field.
 */
add_action( 'uf.init', 'showcase_blocks_field' );
function showcase_blocks_field() {
	$blocks_field = Field::create( 'layout', 'page_content', __( 'Content Blocks', 'showcase' ) );

	// Create a reusable "Button" set of fields.
	Container::create( 'button' )
		->add_fields(array(
			Field::create( 'text', 'text', __( 'Text', 'showcase' ) ),
			Field::create( 'link', 'link', __( 'Link', 'showcase' ) ),
		));

	// Text Blocks
	$blocks_field->add_group( 'text', array(
		'title'     => __( 'Text Block', 'showcase' ),
		'min_width' => 3,
		'icon'      => 'dashicons-format-image',
		'max'       => 2,
		'layout'    => 'rows',
		'fields'    => array(
			Field::create( 'icon', 'icon', __( 'Icon', 'showcase' ) )
				->add_set( 'font-awesome' )
				->set_description( __( 'This icon would be shown above the title.', 'showcase' ) )
				->set_width( 35 ),
			Field::create( 'text', 'title', __( 'Title', 'showcase' ) )
				->set_width( 65 )
				->required(),
			Field::create( 'wysiwyg', 'text', __( 'Text', 'showcase' )  )
				->apply_the_content(),
			Field::create( 'complex', 'button', __( 'Button', 'showcase' ) )
				->load_from_container( 'button' )
		)
	));

	// Image blocks
	$blocks_field->add_group( 'image', array(
		'title'     => __( 'Image', 'showcase' ),
		'min_width' => 3,
		'icon'      => 'dashicons-editor-paragraph',
		'fields'    => array(
			Field::create( 'image', 'image', __( 'Image', 'showcase' ) ),
			Field::create( 'checkbox', 'full_width', __( 'Full Width', 'showcase' )  )
				->add_dependency( '__width', 12 )
				->fancy()
				->set_text( __( 'Let the image fill the full width of the browser.', 'showcase' ) )
		)
	));

	// Video blocks
	$blocks_field->add_group( 'video', array(
		'title'     => __( 'Video', 'showcase' ),
		'min_width' => 6,
		'icon'      => 'dashicons-format-video',
		'fields'    => array(
			Field::create( 'video', 'video', __( 'Video', 'showcase' ) )
		)
	));

	// Embed blocks
	$blocks_field->add_group( 'embed', array(
		'title'     => __( 'Embed', 'showcase' ),
		'min_width' => 6,
		'icon'      => 'dashicons-editor-code',
		'fields'    => array(
			Field::create( 'embed', 'embed', __( 'Embed', 'showcase' ) )
		)
	));

	// Gallery block
	$blocks_field->add_group( 'gallery', array(
		'title'     => __( 'Gallery', 'showcase' ),
		'icon'      => 'dashicons-format-gallery',
		'fields'    => array(
			Field::create( 'gallery', 'gallery', __( 'Gallery', 'showcase' ) )
		)
	));

	// Audio block
	$blocks_field->add_group( 'audio', array(
		'title'     => __( 'Audio Player', 'showcase' ),
		'icon'      => 'dashicons-format-audio',
		'fields'    => array(
			Field::create( 'audio', 'audio', __( 'Audio Player', 'showcase' ) )
		)
	));

	// Teaser block
	$blocks_field->add_group( 'teaser', array(
		'title'     => __( 'Teaser Link', 'showcase' ),
		'icon'      => 'dashicons-admin-links',
		'fields'    => array(
			Field::create( 'wp_object', 'object', __( 'Object', 'showcase' ) )
				->add( 'posts' )
		)
	));

	Container::create( __( 'Page Content', 'showcase' ) )
		->add_location( 'post_type', 'page' )
		->add_fields(array(
			$blocks_field->hide_label()
		));
}

/**
 * Display the blocks.
 *
 * @param bool $display Whether to ignore the default content from the theme. Return false and display content here.
 * @return bool
 */
add_filter( 'showcase.content', 'showcase_blocks_content' );
function showcase_blocks_content( $display ) {
	if( is_page() && ! $display ) {
		include __DIR__ . '/layout.php';
		return true;
	}

	return $display;
}
