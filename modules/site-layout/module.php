<?php
use UF3\Container;
use UF3\Field;

/**
 * Module name: Site Layout
 *
 * @package Ultimate Fields: Showcase
 * @see readme.md for more information.
 */

/**
 * Add the fields for the layout.
 */
add_action( 'uf.init', 'showcase_site_layout_fields' );
function showcase_site_layout_fields() {
    Container::create( 'site-layout' )
        ->add_location( 'customizer', [
            'postmessage_fields' => [ 'site_layout', 'site_background' ]
        ])
        ->add_fields(array(
            Field::create( 'tab', 'layout', __( 'Layout', 'showcase' ) )
                ->set_icon( 'dashicons-editor-table' ),
            Field::create( 'select', 'site_layout', __( 'Site Layout', 'showcase' ) )
                ->set_input_type( 'radio' )
                ->add_options(array(
                    'wide'  => __( 'Wide', 'showcase' ),
                    'boxed' => __( 'Boxed', 'showcase' )
                )),
            Field::create( 'tab', 'background', __( 'Background', 'showcase' ) )
                ->set_icon( 'dashicons-admin-appearance' )
                ->add_dependency( 'site_layout', 'boxed' ),
            Field::create( 'image', 'site_background', __( 'Background', 'showcase' ) )
        ));
}

/**
 * Changes the body class based on the background.
 */
add_filter( 'body_class', 'showcase_layout_class' );
function showcase_layout_class( $classes ) {
    if( 'boxed' == get_value( 'site_layout', 'option' ) ) {
        $classes[] = 'boxed';
    }

    return $classes;
}

/**
 * Add the styles for the front-end.
 */
add_action( 'wp_enqueue_scripts', 'showcase_layout_css', 20 );
function showcase_layout_css() {
    if( 'boxed' == get_value( 'site_layout', 'option' ) ) {
        $image = get_value( 'site_background', 'option' );

        if( $image ) {
            $url = wp_get_attachment_url( $image );

            $css = " body.boxed {
                background-image: url($url);
            } ";

            wp_add_inline_style( 'site-layout', $css );
        }
    }
}

/**
 * Add scripts to the front-end that will change the layout without reloading the page.
 */
add_action( 'customize_preview_init', 'showcase_layout_js' );
function showcase_layout_js() {
	$uri = get_template_directory_uri() . '/modules/site-layout/customizer.js';

	wp_enqueue_script( 'showcase-layout', $uri, array( 'jquery', 'uf-customize-preview' ), '', true );
}
