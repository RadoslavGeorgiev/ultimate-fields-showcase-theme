<?php
add_action( 'uf.init', 'showcase_include_widgets' );
function showcase_include_widgets() {
	require_once __DIR__ . '/Showcase_Accordion_Widget.php';	
	add_action( 'widgets_init', 'showcase_register_widgets' );
}

function showcase_register_widgets() {
	register_widget( 'Showcase_Accordion_Widget' );
}