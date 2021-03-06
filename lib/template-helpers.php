<?php
/**
 * Generates the title of the current page (in the header).
 *
 * @return string
 */
function showcase_get_title() {
	if( is_home() ) {
		return get_bloginfo( 'description' );
	} elseif( is_archive() ) {
		return get_the_archive_title();
	} elseif( is_404() ) {
		return '404';
	} else {
		return get_the_title();
	}
}
