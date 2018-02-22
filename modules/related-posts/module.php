<?php
use Ultimate_Fields\Container;
use Ultimate_Fields\Field;

/**
 * Related Posts Module
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md for more information
 */

add_action( 'uf.init', 'showcase_related_posts_fields' );
function showcase_related_posts_fields() {
    Container::create( 'post-relations' )
        ->add_location( 'post_type', 'post' )
        ->set_description_position( 'label' )
        ->add_fields(array(
            Field::create( 'wp_objects', 'related_posts', __( 'Related Posts', 'showcase' ) )
                ->add( 'posts', 'post_type=post' )
                ->set_description( __( 'Related posts will be shown at the end of the post.', 'showcase' ) )
                ->set_button_text( __( 'Select posts', 'showcase' ) )
        ));
}

/**
 * Appends the related posts at the end of the content.
 *
 * @param string $content The pre-existing content.
 * @return string
 */
add_filter( 'the_content', 'showcase_display_related_posts', 20 );
function showcase_display_related_posts( $content ) {
    if( ! is_singular() || ! get_value( 'related_posts' ) ) {
        return $content;
    }

    // Include a special template
    ob_start();
    include( __DIR__ . '/template.php' );
    $posts = ob_get_clean();

    return $content . $posts;
}
