<?php
function showcase_load_initial_data() {
    $content = 'Welcome to the Ultimate Fields: Showcase theme!';

    wp_update_post(array(
        'ID'           => 1,
        'post_content' => $content
    ));
}

if( false ) {
    showcase_load_initial_data();    
}
