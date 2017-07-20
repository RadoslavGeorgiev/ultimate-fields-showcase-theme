<?php
use UF3\Container;
use UF3\Field;

/**
 * Remove the editor from the page.
 */
add_action( 'init', 'showcase_blocks_remove_editor' );
function showcase_blocks_remove_editor() {
	remove_post_type_support( 'page', 'editor' );
}

/**
 * Add the layout field.
 */
add_action( 'uf.init', 'showcase_blocks_field' );
function showcase_blocks_field() {
	$blocks_field = Field::create( 'layout', 'page_content', __( 'Content Blocks', 'showcase' ) );

	// Text Blocks
	$blocks_field->add_group(array(
		'title'     => __( 'Text Block', 'showcase' ),
		'type'      => 'text',
		'min_width' => 3,
		'fields'    => array(
			Field::create( 'icon', 'icon', __( 'Icon', 'showcase' ) )
				->add_set( 'font-awesome' )
				->set_description( __( 'This icon would be shown above the title.', 'showcase' ) )
				->set_field_width( 35 ),
			Field::create( 'text', 'title', __( 'Title', 'showcase' ) )
				->set_field_width( 65 ),
			Field::create( 'wysiwyg', 'text', __( 'Text', 'showcase' )  )
		)
	));

	// Image blocks
	$blocks_field->add_group(array(
		'title'     => __( 'Image', 'showcase' ),
		'type'      => 'image',
		'min_width' => 3,
		'fields'    => array(
			Field::create( 'image', 'image', __( 'Image', 'showcase' ) ),
			Field::create( 'checkbox', 'full_width', __( 'Full Width', 'showcase' )  )
				->add_dependency( '__width', 12 )
				->fancy()
				->set_text( __( 'Let the image fill the full width of the browser.', 'showcase' ) )
		)
	));

	Container::create( __( 'Page Content', 'showcase' ) )
		->add_location( 'post_type', 'page' )
		->add_fields(array(
			$blocks_field
				->hide_label()
		));
}

/**
 * Display the blocks.
 */
add_filter( 'showcase.content', 'showcase_blocks_content' );
function showcase_blocks_content( $display ) {
	if( ! is_page() ) {
		return $display;
	}

	include __DIR__ . '/layout.php';

	return true;
}