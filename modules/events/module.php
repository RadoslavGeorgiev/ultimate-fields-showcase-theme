<?php
use UF3\Container;
use UF3\Field;

add_action( 'init', 'showcase_register_events' );
function showcase_register_events() {
	register_post_type( 'event', array(
		'public'	  => true,
		'show_ui'     => true,
		'label'       => 'Event',
		'menu_icon'   => 'dashicons-calendar',
		'has_archive' => true,
		'rewrite'     => array(
			'slug'       => 'events',
			'with_front' => false
		),
		'labels' => array(
			'name'          => __( 'Events', 'showcase' ),
			'singular_name' => __( 'Event', 'showcase' ),
			'menu_name'     => __( 'Events', 'showcase' ),
		)
	));
}

add_filter( 'showcase.content', 'showcase_events_index' );
function showcase_events_index( $show ) {
	if( is_archive( 'event' ) ) {
		include __DIR__ . '/archive.php';
		return true;
	}

	if( is_singular( 'event' ) ) {
		include __DIR__ . '/single-event.php';
		return true;
	}

	return $show;
}

add_action( 'uf.init', function() {
	Container::create( __( 'Event Details', 'showcase' ) )
		->add_location( 'post_type', 'event' )
		->set_layout( 'grid' )
		->add_fields(array(
			Field::create( 'date', 'event_start', __(  'Starting date', 'showcase' ) )
				->set_field_width( 50 )
				->required(),
			Field::create( 'date', 'event_end',   __(  'End date', 'showcase' ) )
				->set_field_width( 50 )
				->required(),
			Field::create( 'map', 'event_location', __( 'Location', 'showcase' ) )
				->required()
				->set_output_width( 1200 )
		));
});