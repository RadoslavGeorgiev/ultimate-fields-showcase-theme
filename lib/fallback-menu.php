<?php
/**
 * Displays a generic menu.
 */
function showcase_fallback_menu() {
    $pages = get_pages();

    if( empty( $pages ) ) {
        return;
    }

    $items = array();

    // Add the homepage
    if( ! get_option( 'page_on_front' ) ) {
        $items[] = array(
            'href'   => home_url( '/' ),
            'text'   => __( 'Home', 'showcase' ),
            'active' => is_home() || is_front_page() || is_single()
        );
    }

    foreach( $pages as $page ) {
        $items[] = array(
            'href'   => get_permalink( $page->ID ),
            'text'   => $page->post_title,
            'active' => is_page( $page->ID )
        );
    }

    // Display
    echo '<ul class="main-menu">';
    foreach( $items as $item ) {
        printf(
            '<li class="menu-item %s">
                <a href="%s">
                    %s
                    <span class="menu-triangle"></span>
                </a>
            </li>',
            $item['active'] ? 'current-menu-item' : '',
            esc_attr( $item['href'] ),
            esc_html( $item['text'] )
        );
    }
    echo '</ul>';
}

/**
 * Adds a small element to menu items.
 *
 * @param string   $title The menu item's title.
 * @param WP_Post  $item  The current menu item.
 * @param stdClass $args  An object of wp_nav_menu() arguments.
 * @param int      $depth Depth of menu item. Used for padding.
 * @return string
 */
add_filter( 'nav_menu_item_title', 'showcase_add_menu_triangle', 10, 4 );
function showcase_add_menu_triangle( $title, $item, $args, $depth ) {
	if( $depth > 0 ) {
		return $title;
	}

	$title .= '<span class="menu-triangle"></span>';

    return $title;
}
