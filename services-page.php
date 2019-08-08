<?php

/**
Template Name: Services Page
Description: Services page template
*/

// force full-width
add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_full_width_content' );

// create custom meta for the page (so we can add our own services widget)
add_action( 'genesis_meta', 'custom_template_meta' );

// if the Services widget is active, remove the loop and just place the services widget in there
function custom_template_meta() {
	if ( is_active_sidebar( 'home-widgets-2' ) ) {
		remove_action( 'genesis_loop', 'genesis_do_loop' );
		add_action( 'genesis_loop', 'custom_template_meta_content' );
	}
}

function custom_template_meta_content() {
	genesis_widget_area( 'home-widgets-2', array(
		'before' => '<div class="home-widgets home-widgets-2 services wrap">',
		'after'  => '</div>'
	) );
}

genesis();