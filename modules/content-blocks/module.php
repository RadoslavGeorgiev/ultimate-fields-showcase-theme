<?php
use UF3\Container;
use UF3\Field;

/**
 * Remove the normal editor from the page, as we will be using content blocks for that.
 */
add_action( 'init', 'showcase_blocks_remove_editor' );
function showcase_blocks_remove_editor() {
	remove_post_type_support( 'page', 'editor' );
}

/**
 * Register the layout field.
 */
add_action( 'uf.init', 'showcase_blocks_field' );
function showcase_blocks_field() {
	$blocks_field = Field::create( 'layout', 'page_content', __( 'Content Blocks', 'showcase' ) );

	// Text Blocks
	$blocks_field->add_group( 'text', array(
		'title'     => __( 'Text Block', 'showcase' ),
		'min_width' => 3,
		'icon'      => 'dashicons-format-image',
		'max'       => 2,
		'fields'    => array(
			Field::create( 'icon', 'icon', __( 'Icon', 'showcase' ) )
				->add_set( 'font-awesome' )
				->set_description( __( 'This icon would be shown above the title.', 'showcase' ) )
				->set_field_width( 35 ),
			Field::create( 'text', 'title', __( 'Title', 'showcase' ) )
				->set_field_width( 65 )
				->required(),
			Field::create( 'wysiwyg', 'text', __( 'Text', 'showcase' )  )
				->apply_the_content()
		)
	));

	// Image blocks
	$blocks_field->add_group( 'image', array(
		'title'     => __( 'Image', 'showcase' ),
		'min_width' => 3,
		'icon'      => 'dashicons-editor-paragraph',
		// 'title_background' => 'skyblue',
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
	if( is_page() ) {
		include __DIR__ . '/layout.php';
		return true;
	}

	return $display;
}
