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
            'active' => is_home() || is_front_page()
        );
    }

    foreach( $pages as $page ) {
        $items[] = array(
            'href'   => get_permalink( $page->ID ),
            'text'   => $page->post_title,
            'active' => is_page( $page->ID )
        );
    }

    echo '<div class="main-menu">';
        echo '<ul class="menu center">';
        foreach( $items as $item ) {
            printf(
                '<li class="menu-item %s">
                    <a href="%s">%s</a>
                </li>',
                $item['active'] ? 'current-menu-item' : '',
                esc_attr( $item['href'] ),
                esc_html( $item['text'] )
            );
        }
        echo '</ul>';
    echo '</div>';
}
