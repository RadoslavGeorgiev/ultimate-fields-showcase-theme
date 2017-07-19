<?php
use UF3\Container;
use UF3\Field;
use UF3\Options_Page;

define( 'SHOWCASE_DIR', __DIR__ . '/' );
define( 'UF3_DISABLE_UI', true );

/**
 * Setup the theme and load modules.
 */
add_action( 'after_setup_theme', 'showcase_setup' );
function showcase_setup() {
	// Load the modules
	foreach( showcase_enabled_modules() as $module ) {
		require SHOWCASE_DIR . 'modules/' . $module . '/module.php';
	}

	// Register theme supports
	register_nav_menu( 'main-menu', __( 'Main Menu', 'showcase' ) );
}

/**
 * Initialize sidebars.
 */
add_action( 'widgets_init', 'showcase_sidebars' );
function showcase_sidebars() {
	register_sidebar(array(
		'id'   => 'default-sidebar',
		'name' => __( 'Default sidebar', 'showcase' )
	));
}

/**
 * Add a page for theme options and module control.
 */
add_action( 'uf.init', 'showcase_options_page' );
function showcase_options_page() {
	$page = Options_Page::create( 'theme-options', __( 'Theme Options', 'showcase' ) )
		->set_type( 'appearance' );

	$modules = array(
		'menu'            => 'Menu',
		'shortcode-quote' => 'Shortcode (Quote)'
	);

	Container::create( 'Showcase Modules' )
		->add_location( 'options', $page )
		->set_description_position( 'label' )
		->add_fields(array(
			Field::create( 'multiselect', 'showcase_modules', __( 'Modules', 'showcase' ) )
				->set_description( __( 'Select the modules you want to have enabled as a showcase.', 'showcase' ) )
				->set_input_type( 'checkbox' )
				->add_options( $modules )
		));
}

/**
 * Returns all enabled modules.
 *
 * @since 3.0
 *
 * @return string[]
 */
function showcase_enabled_modules() {
	static $modules;

	if( is_null( $modules ) ) {
		$option = get_option( 'showcase_modules' );
		if( $option ) foreach( $option as $module ) {
			if( ! file_exists( SHOWCASE_DIR . 'modules/' . $module ) )  {
				continue;
			}

			$modules[] = $module;
		}
	}

	return $modules;
}

/**
 * Enqueue scripts and styles for enabled modules.
 */
add_action( 'wp_enqueue_scripts', 'showcase_scripts_styles' );
function showcase_scripts_styles() {
	wp_enqueue_style( 'showcase', get_stylesheet_uri() );

	foreach( showcase_enabled_modules() as $module ) {
		$path = SHOWCASE_DIR . 'modules/' . $module . '/';
		$url  = get_template_directory_uri() . '/modules/' . $module . '/';

		if( file_exists( $path . 'module.js' ) ) {
			wp_enqueue_script( 'showcase-' . $module, $url . 'module.js' );
		}

		if( file_exists( $path . 'module.css' ) ) {
			wp_enqueue_style( 'showcase-' . $module, $url . 'module.css' );
		}
	}
}