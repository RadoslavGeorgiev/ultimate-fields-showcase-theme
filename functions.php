<?php
/**
 * Setup the theme and load modules.
 */
add_action( 'after_setup_theme', 'showcase_setup' );
function showcase_setup() {
	// Include generic functions
	require_once __DIR__ . '/lib/plugin-check.php';
	require_once __DIR__ . '/lib/fallback-menu.php';
	require_once __DIR__ . '/lib/theme-init.php';
	require_once __DIR__ . '/lib/template-helpers.php';
	require_once __DIR__ . '/lib/demo-data.php';

	// Include the module loader and initialize it
	require_once __DIR__ . '/modules/class-module-loader.php';
	Module_Loader::get_instance();
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
		'path'  => __DIR__ . '/modules/quote',
		'url'   => get_template_directory_uri() . '/modules/quote',
		'redirect' => admin_url( 'post.php?post=1&action=edit' )
	));

	$loader->add_module( 'events', array(
		'title' => __( 'Events', 'showcase' ),
		'pro'   => true,
		'path'  => __DIR__ . '/modules/events',
		'url'   => get_template_directory_uri() . '/modules/events',
		'redirect' => home_url( '/' ), // @todo: Add a proper URL
	));

	$loader->add_module( 'menu', array(
		'title'    => __( 'Mega Menu', 'showcase' ),
		'pro'      => true,
		'path'     => __DIR__ . '/modules/menu',
		'url'      => get_template_directory_uri() . '/modules/menu',
		'redirect' => 'showcase_create_main_menu'
	));

	$loader->add_module( 'content-blocks', array(
		'title'    => __( 'Content Blocks', 'showcase' ),
		'pro'      => true,
		'path'     => __DIR__ . '/modules/content-blocks',
		'url'      => get_template_directory_uri() . '/modules/content-blocks',
		'redirect' => function() {
			return admin_url( 'post.php?post=2&action=edit' );
		}
	));

	$loader->add_module( 'colors', array(
		'title'    => __( 'Colors', 'showcase' ),
		'pro'      => true,
		'path'     => __DIR__ . '/modules/colors',
		'url'      => get_template_directory_uri() . '/modules/colors',
		'redirect' => home_url( 'wp-admin/customize.php?autofocus[section]=uf_section_theme_colors' ), // @todo: Add a proper URL
	));

	$loader->add_module( 'accordion-widget', array(
		'title'    => __( 'Accordion Widget', 'showcase' ),
		'pro'      => false,
		'path'     => __DIR__ . '/modules/accordion-widget',
		'url'      => get_template_directory_uri() . '/modules/accordion-widget',
		'redirect' => home_url( 'wp-admin/widgets.php' )
	));

	$loader->add_module( 'related-posts', array(
		'title'    => __( 'Related Posts', 'showcase' ),
		'pro'      => true,
		'path'     => __DIR__ . '/modules/related-posts',
		'url'      => get_template_directory_uri() . '/modules/related-posts',
		'redirect' => admin_url( 'post.php?post=1&action=edit' )
	));

	$loader->add_module( 'team', array(
		'title'    => __( 'Team', 'showcase' ),
		'pro'      => true,
		'path'     => __DIR__ . '/modules/team',
		'url'      => get_template_directory_uri() . '/modules/team',
		'redirect' => admin_url( 'post.php?post=2&action=edit' )
	));

	$loader->add_module( 'site-layout', array(
		'title'    => __( 'Site Layout', 'showcase' ),
		'pro'      => false,
		'path'     => __DIR__ . '/modules/site-layout',
		'url'      => get_template_directory_uri() . '/modules/site-layout',
		'redirect' => admin_url( 'themes.php?page=theme-options' )
	));

	$loader->add_module( 'enhanced-categories', array(
		'title'    => __( 'Enhanced categories', 'showcase' ),
		'pro'      => true,
		'path'     => __DIR__ . '/modules/enhanced-categories',
		'url'      => get_template_directory_uri() . '/modules/enhanced-categories',
		'redirect' => admin_url( 'term.php?taxonomy=category&tag_ID=1' )
	));
}
