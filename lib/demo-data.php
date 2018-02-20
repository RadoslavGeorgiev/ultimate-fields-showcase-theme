<?php
function showcase_load_initial_data() {
	$page_url = admin_url( 'themes.php?page=theme-options' );
    $content = "
	Welcome to your personal Ultimate Fields demo website!

	This website will only be accessible to you and Ultimate Fields administrators, so feel free to make any changes you'd like to - nobody else will see them.

	Currently the website is running the Ultimate Fields: Showcase theme, which is openly available at <a href='https://github.com/RadoslavGeorgiev/ultimate-fields-showcase-theme' target='_blank'>GitHub</a> and allows you to preview all features of Ultimate Fields (incl. Ultimate Fields Pro) before you decide to install or purchase the plugin.

	If this is your first time here, we suggest going to the <a href='$page_url'>Theme Options</a> page and enabling various modules in order to experience Ultimate Fields. All of the modules are documented in the GitHub repository. If you are already using Ultimate Fields, you can import your existing fields and data here in order to request help.
	";

    wp_update_post(array(
        'ID'           => 1,
        'post_content' => $content
    ));
}

if( 'v1' != get_option( 'showcase_demo_data' ) ) {
    showcase_load_initial_data();
	update_option( 'showcase_demo_data', 'v1' );
}
