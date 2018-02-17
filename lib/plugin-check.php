<?php
/**
 * Displays a message that Ultimate Fields is needed for the theme.
 */
function showcase_uf_notice() {
	$message = __( 'The Ultimate Fields: Showcase theme is built to showcase Ultimate Fields as a plugin, making the plugin a dependency of the theme. Please install and activate Ultimate Fields or Ultimate Fields Pro.', 'showcase' );
    $message = wpautop( $message );

	printf( '<div class="notice notice-error">%s</div>', $message );
}

if( ! function_exists( 'ultimate_fields' ) ) {
    add_action( 'admin_notices', 'showcase_uf_notice' );
}
