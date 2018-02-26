<?php
use UF3\Container;
use UF3\Field;

/**
 * Module name: Events
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md for details
 */


/**
 * Registers a new post type for events.
 */
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

	// Ensure that rewrite rules work
	if( ! get_option( 'event_permalinks_updated' ) ) {
		flush_rewrite_rules();
		update_option( 'event_permalinks_updated', true );
	}
}

/**
 * Register the needed fields for events.
 */
add_action( 'uf.init', 'showcase_add_event_fields' );
function showcase_add_event_fields() {
	Container::create( __( 'Event Details', 'showcase' ) )
		->add_location( 'post_type', 'event' )
		->set_layout( 'grid' )
		->add_fields(array(
			Field::create( 'section', 'duration', __( 'Duration', 'showcase' ) )
				->set_icon( 'dashicons-calendar' )
				->set_color( 'blue' ),
			Field::create( 'date', 'event_start', __(  'Starting date', 'showcase' ) )
				->set_field_width( 50 )
				->required(),
			Field::create( 'date', 'event_end',   __(  'End date', 'showcase' ) )
				->set_field_width( 50 )
				->required(),
			Field::create( 'section', 'location', __( 'Location', 'showcase' ) )
				->set_icon( 'dashicons-location-alt' )
				->set_color( 'blue' ),
			Field::create( 'checkbox', 'event_is_phyisical', __( 'Physical Event', 'showcase' ) )
				->set_text( __( 'This is a physical event.', 'showcase' ) )
				->fancy(),
			Field::create( 'map', 'event_location', __( 'Location', 'showcase' ) )
				->required()
				->set_output_width( 1200 )
				->add_dependency( 'event_is_phyisical' )
		));
}

/**
 * Displays the dates of events on the archive page.
 */
add_action( 'showcase.before_loop_content', 'showcase_display_event_dates' );
function showcase_display_event_dates() {
	if( 'event' != get_post_type() ) {
		return;
	}

	?>
	<p>
		From <?php the_value( 'event_start' ) ?> until <?php the_value( 'event_end' ) ?>
	</p>
	<?php
}

/**
 * Shows the map of the event.
 */
add_action( 'showcase.before_post_content', 'showcase_display_event_location' );
function showcase_display_event_location() {
	if( 'event' != get_post_type() ) {
		return;
	}

	if( get_value( 'event_is_phyisical' ) ) {
		the_value( 'event_location' );
	}

	showcase_display_event_dates();
}
