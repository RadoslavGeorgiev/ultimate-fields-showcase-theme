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
            Field::create( 'color', 'category_color', __( 'Category Color', 'showcase' ) )
				->set_default_value( '#333333' ),
			Field::create( 'number', 'posts_per_page', __( 'Posts per page', 'showcase' ) )
				->set_default_value( get_option( 'posts_per_page' ) )
				->set_description( __( 'Controls how many posts will be displayed on the archive page of the category.', 'showcase' ) )
				->enable_slider( 1, 20 )
        ));
}

/**
 * Adds additional CSS for the category color.
 */
add_action( 'wp_enqueue_scripts', 'showcase_category_color' );
function showcase_category_color() {
	$css = '';

	foreach( get_categories() as $category ) {
		$color = get_value( 'category_color', 'category_' . $category->term_id );

		if( ! $color ) {
			continue;
		}

		$css .= "
		.category-$category->slug .loop__link {
			color: $color;
		}

		.category-$category->term_id .page-header {
			background: $color;
		}
		";
	}

	if( strlen( $css ) > 0 ) {
		wp_add_inline_style( 'showcase', $css );
	}
}

/**
 * Adjust the amount of posts, displayed on a category page.
 *
 * @param WP_Query $query The query that controls the page.
 */
add_action( 'pre_get_posts', 'showcase_category_ppp' );
function showcase_category_ppp( $query ) {
	if( is_admin() || ! $query->is_main_query() || ! $query->is_category() ) {
		return;
	}

	$cat = get_queried_object();
	$count = get_value( 'posts_per_page', 'category_' . $cat->term_id );
	$query->set( 'posts_per_page', $count );
}
