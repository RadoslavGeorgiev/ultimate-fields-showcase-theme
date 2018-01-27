<?php
use UF3\Custom_Widget;
use UF3\Container;
use UF3\Field;

class Showcase_Accordion_Widget extends Custom_Widget {
	public function __construct() {
		parent::__construct( 'accordion_widget', __( 'Accordion', 'showcase' ), array( 
			'classname'   => 'accordion-widget',
			'description' => __( 'A widget with multiple sections'. 'showcase' ),
		));

		Container::create( 'accordion_widget' )
			->add_location( 'widget', 'Showcase_Accordion_Widget' )
			->add_fields(array(
				Field::create( 'text', 'title', __( 'Title', 'showcase' ) ),
				Field::create( 'repeater', 'sections', __( 'Sections', 'showcase' ) )
					->add_fields(array(
						Field::create( 'text', 'title', __( 'Title', 'showcase' ) ),
						Field::create( 'textarea', 'text', __( 'Text', 'showcase' ) ),
					))
					->set_add_text( __( 'Add section', 'showcase' ) )
			));
	}

	public function widget( $args ) {
		if( empty( get_value( 'sections', 'widget' ) ) ) {
			return;
		}

		include __DIR__ . '/template.php';
	}
}