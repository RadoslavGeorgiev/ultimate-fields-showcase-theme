<?php
use Ultimate_Fields\Options_Page;

// Register theme supports
add_theme_support( 'title-tag' );
add_theme_support( 'post-thumbnails' );
add_image_size( 'post-thumbnail', 680 );
register_nav_menu( 'main-menu', __( 'Main Menu', 'showcase' ) );

/**
 * Add a page for theme options and module control.
 */
add_action( 'uf.init', 'showcase_options_page' );
function showcase_options_page() {
	$page = Options_Page::create( 'theme-options', __( 'Theme Options', 'showcase' ) )
		->set_type( 'appearance' );

	// Expose to other modules
	$GLOBALS['showcase_options_page'] = $page;

	Module_Loader::get_instance()->register_options_container( $page );
}

/**
 * Returns the generic arguments for sidebar creation.
 *
 * @return array
 */
function showcase_get_default_sidebar_args() {
	return array(
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'before_title'  => '<h2 class="widget__title main-border">',
		'after_title'   => '</h2>',
		'after_widget'  => '</div>',
	);
}

/**
 * Initialize sidebars.
 */
add_action( 'widgets_init', 'showcase_sidebars' );
function showcase_sidebars() {
	$args = wp_parse_args( array(
		'id'   => 'sidebar-1',
		'name' => __( 'Default sidebar', 'showcase' )
	), showcase_get_default_sidebar_args() );

	register_sidebar( $args );
}

/**
 * Enqueue scripts and styles for enabled modules.
 */
add_action( 'wp_enqueue_scripts', 'showcase_scripts_styles' );
function showcase_scripts_styles() {
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'open-sans-font', 'https://fonts.googleapis.com/css?family=Open+Sans:400,700' );
	wp_enqueue_style( 'showcase', get_stylesheet_uri() );
}
