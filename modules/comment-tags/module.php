<?php
use UF3\Container;
use UF3\Field;

/**
 * Module name: Comment Tags
 *
 * @package Ultimate Fields: Showcase Theme
 * @see readme.md for details
 */

add_action( 'uf.init', 'showcase_comment_fields' );
function showcase_comment_fields() {
	Container::create( 'comment-tags' )
		->add_location( 'comment' )
		->add_fields(array(
			Field::create( 'multiselect', 'tags', __( 'Tags', 'showcase' ) )
				->add_options( showcase_get_comment_tags() )
				->set_description( __( 'Those tags will be displayed next to comments in the front-end.' ) )
		));
}

/**
 * Returns all available comment tags.
 *
 * @return array
 */
function showcase_get_comment_tags() {
	return array(
		'bug'        => __( 'Bug', 'showcase' ),
		'feature'    => __( 'Feature', 'showcase' ),
		'feedback'   => __( 'Feedback', 'showcase' ),
		'suggestion' => __( 'Suggestion', 'showcase' )
	);
}

/**
 * Appends tags to the comment text.
 *
 * @param string     $text    The text for the comment.
 * @param WP_Comment $comment The actual comment.
 * @return string
 */
add_filter( 'comment_text', 'showcase_display_comment_tags', 10, 2 );
function showcase_display_comment_tags( $text, $comment ) {
	if( $tags = get_value( 'tags', 'comment_' . $comment->comment_ID ) ) {
		$labels = array();
		foreach( showcase_get_comment_tags() as $key => $label ) {
			if( in_array( $key, $tags ) ) {
				$labels[] = $label;
			}
		}

		if( ! empty( $labels ) ) {
			$tags = sprintf(
				wpautop( __( 'Comment tags: %s', 'showcase' ) ),
				implode( $labels, ', ' )
			);

			$text .= $tags;
		}
	}

	return $text;
}
