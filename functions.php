<?php
use UF3\Container;
use UF3\Field;
use UF3\Options_Page;

/**
 * Holds the root of the theme for includes.
 * @var string
 */
define( 'SHOWCASE_DIR', __DIR__ . '/' );

/**
 * Setup the theme and load modules.
 */
add_action( 'after_setup_theme', 'showcase_setup' );
function showcase_setup() {
	// Include the module loader and initialize it
	require_once SHOWCASE_DIR . 'modules/class-module-loader.php';
	$GLOBALS['showcase_loader'] = new Module_Loader;

	// Register theme supports
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	register_nav_menu( 'main-menu', __( 'Main Menu', 'showcase' ) );
}

/**
 * Loads all built-in modules.
 *
 * @param Module_Loader $loader A loader that includes modules.
 */
add_action( 'showcase.load_modules', 'showcase_builtin_modules' );
function showcase_builtin_modules( $loader ) {
	$loader->add_module( 'quote', array(
		'title' => __( 'Quote Shortcode', 'showcase' ),
		'pro'   => true,
		'path'  => SHOWCASE_DIR . 'modules/quote',
		'url'   => get_template_directory_uri() . '/modules/quote',
		'redirect' => admin_url( 'post.php?post=1&action=edit' )
	));

	$loader->add_module( 'events', array(
		'title' => __( 'Events', 'showcase' ),
		'pro'   => true,
		'path'  => SHOWCASE_DIR . 'modules/events',
		'url'   => get_template_directory_uri() . '/modules/events',
		'redirect' => home_url( '/' ), // @todo: Add a proper URL
	));

	$loader->add_module( 'menu', array(
		'title'    => __( 'Mega Menu', 'showcase' ),
		'pro'      => true,
		'path'     => SHOWCASE_DIR . 'modules/menu',
		'url'      => get_template_directory_uri() . '/modules/menu',
		'redirect' => 'showcase_create_main_menu'
	));

	$loader->add_module( 'content-blocks', array(
		'title'    => __( 'Content Blocks', 'showcase' ),
		'pro'      => true,
		'path'     => SHOWCASE_DIR . 'modules/content-blocks',
		'url'      => get_template_directory_uri() . '/modules/content-blocks',
		'redirect' => function() {
			return admin_url( 'post.php?post=2&action=edit' );
		}
	));

	$loader->add_module( 'colors', array(
		'title'    => __( 'Colors', 'showcase' ),
		'pro'      => true,
		'path'     => SHOWCASE_DIR . 'modules/colors',
		'url'      => get_template_directory_uri() . '/modules/colors',
		'redirect' => home_url( 'wp-admin/customize.php?autofocus[section]=uf_section_theme_colors' ), // @todo: Add a proper URL
	));

	$loader->add_module( 'accordion-widget', array(
		'title'    => __( 'Accordion Widget', 'showcase' ),
		'pro'      => false,
		'path'     => SHOWCASE_DIR . 'modules/accordion-widget',
		'url'      => get_template_directory_uri() . '/modules/accordion-widget',
		'redirect' => home_url( 'wp-admin/widgets.php' )
	));
}

/**
 * Add a page for theme options and module control.
 */
add_action( 'uf.init', 'showcase_options_page' );
function showcase_options_page() {
	$page = Options_Page::create( 'theme-options', __( 'Theme Options', 'showcase' ) )
		->set_type( 'appearance' );

	$GLOBALS['showcase_loader']->register_options_container( $page );
}

/**
 * Initialize sidebars.
 */
add_action( 'widgets_init', 'showcase_sidebars' );
function showcase_sidebars() {
	register_sidebar(array(
		'id'            => 'default-sidebar',
		'name'          => __( 'Default sidebar', 'showcase' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
	));
}

/**
 * Enqueue scripts and styles for enabled modules.
 */
add_action( 'wp_enqueue_scripts', 'showcase_scripts_styles' );
function showcase_scripts_styles() {
	wp_enqueue_style( 'lato-font', 'https://fonts.googleapis.com/css?family=Lato:300,400,700' );
	wp_enqueue_style( 'font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css' );
	wp_enqueue_style( 'showcase', get_stylesheet_uri() );
	wp_enqueue_script( 'jquery' );
}

/**
 * Generates the title of the current page (in the header).
 *
 * @return string
 */
function showcase_get_title() {
	if( is_archive() ) {
		return get_the_archive_title();
	} elseif( is_404() ) {
		return '404';
	} else {
		return get_the_title();
	}
}
