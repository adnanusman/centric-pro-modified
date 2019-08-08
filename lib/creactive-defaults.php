<?php
/**
 * Centric Pro.
 *
 * This file adds Creactive's default theme settings to this theme.
 *
 * @package Centric
 * @author  
 * @license 
 * @link    
 */

/** Add custom image sizes */
function add_custom_sizes() {
    add_image_size( 'service-image', 1200, 450, true );
    add_image_size( 'featured-service-image', 400, 400, true );
    add_image_size( 'blurb-image', 500, 334, true );
    add_image_size( 'portrait', 500, 766, true );
}

add_action('after_setup_theme','add_custom_sizes',11);

// make custom sizes selectable from WordPress admin
add_filter( 'image_size_names_choose', 'custom_img_sizes');

function custom_img_sizes( $sizes ) {
    return array_merge( $sizes, array(
            'service-image' => __('Service Image'),
            'large' => __('Large'),
            'blurb-image' => __('Blurb Image'),
            'portrait' => __('Portrait'),
            'medium_large' => __('Medium Large'),
            'featured-page' => __('Featured Page'),
            'featured-post' => __('Featured Post'),
            'featured-service-image' => __('Featured Service Image'),
    ) );
}

// remove post info on posts
remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

// remove post meta on posts
remove_action( 'genesis_entry_footer', 'genesis_post_meta' );

// add menu shortcodes (allows you to do something like this: [menu name="services" container_class="foo"]  )
function print_menu_shortcode($atts, $content = null) {
    extract(shortcode_atts(array( 'name' => null, 'container_class' => null ), $atts));
    return wp_nav_menu( array( 'menu' => $name, 'container_class' => $container_class, 'echo' => false ) );
}

add_shortcode('menu', 'print_menu_shortcode');

// add widget column class needed depending on number of genesis-footer-widgets declared in functions.php
add_filter( 'genesis_attr_footer-widget-area', 'creactive_add_css_attr_footer_widget_area' );

function creactive_add_css_attr_footer_widget_area( $attributes ) {
 
	// add original plus extra CSS classes
	$attributes['class'] .= ' one-fourth';

	// return the attributes
	return $attributes;
 
}

/** Add custom Favicon */
add_filter( 'genesis_pre_load_favicon', 'custom_favicon' );
function custom_favicon( $favicon_url ) {
	$custom_favicon_url = get_stylesheet_directory_uri() . '/images/favicon.ico';
	return $custom_favicon_url;
}

//* Change the footer credits
add_filter('genesis_footer_creds_text', 'creactive_footer_creds_filter');

function creactive_footer_creds_filter( $creds ) {
	$creds = '[footer_copyright] &middot; <a href="https://www.creactiveinc.com/" target="_blank" rel="nofollow noopener noreferrer">Creactive Inc.</a> - All Rights Are Reserved &middot; Powered by Small Businesses';

	return $creds;
}
