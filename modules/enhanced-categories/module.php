<?php
use UF3\Field;
use UF3\Container;

/**
 * Adds colors to the posts of a category.
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md for details about the module
 */

/**
 * Adds taxonomy fields to category.
 */
add_action( 'uf.init', 'showcase_add_category_fields' );
function showcase_add_category_fields() {
    Container::create( 'enchanced-categories' )
        ->add_location( 'taxonomy', 'category' )
        ->add_fields(array(
            Field::create( 'text', 'test' )
        ));
}
