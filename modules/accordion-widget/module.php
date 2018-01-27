<?php
use UF3\Custom_Widget;
use UF3\Container;
use UF3\Field;

class Showcase_Accordion_Widget extends Custom_Widget {
	public function __construct() {
		$widget_ops = array( 
			'classname'   => 'accordion-widget',
			'description' => __( 'A widget with multiple sections'. 'showcase' ),
		);

		$this->add_fields();

		parent::__construct( 'accordion_widget', __( 'Accordion', 'showcase' ), $widget_ops );
	}

	public function add_fields() {
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

	public function widget( $args, $instance ) {
		if( empty( get_value( 'sections', 'widget' ) ) ) {
			return;
		}

		echo $args['before_widget'];
		
		if( get_value( 'title', 'widget' ) ) {
			echo $args['before_title'];
				the_value( 'title', 'widget' );
			echo $args['after_title'];
		}

		while( have_groups( 'sections', 'widget' ) ): the_group(); ?>
			<div class="widget-section">
				<h3 class="widget-section__title"><?php the_sub_value( 'title' ) ?></h3>
				<div class="widget-section__text">
					<?php the_sub_value( 'text' ) ?>
				</div>
			</div>
		<?php endwhile;

		echo $args['after_widget'];
	}
}

add_action( 'widgets_init', 'showcase_register_widgets' );
function showcase_register_widgets() {
	register_widget( 'Showcase_Accordion_Widget' );
}