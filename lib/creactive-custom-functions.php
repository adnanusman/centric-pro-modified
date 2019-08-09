<?php
/**
 * Agency Pro.
 *
 * This file adds Creactive's custom settings to this theme.
 *
 * @package Agency
 * @author  
 * @license 
 * @link    
 */

// Enqueue Font Awesome.
add_action( 'wp_enqueue_scripts', 'creactive_scripts' );

function creactive_scripts() {
    wp_enqueue_script( 'font-awesome', 'https://use.fontawesome.com/releases/v5.0.7/js/all.js', array(), null );
}

add_filter( 'script_loader_tag', 'add_defer_attribute', 10, 2 );
/**
 * Filter the HTML script tag of `font-awesome` script to add `defer` attribute.
 *
 * @param string $tag    The <script> tag for the enqueued script.
 * @param string $handle The script's registered handle.
 *
 * @return   Filtered HTML script tag.
 */
function add_defer_attribute( $tag, $handle ) {
    if ( 'font-awesome' === $handle ) {
        $tag = str_replace( ' src', ' defer src', $tag );
    }    
    return $tag;
}

// add css height dimension of custom logo image
function add_custom_css() {
    $logo_height = get_custom_header()->height;
    $logo_height = $logo_height.'px';
    $logo_width = get_custom_header()->width;
    $logo_width = $logo_width.'px';
    $custom_css = ".header-image .title-area { width: {$logo_width}; } .header-image .site-title a { background-size: contain!important; background-position: center center!important; height: {$logo_height}; }";
    wp_add_inline_style( 'centric-theme', $custom_css );
}

add_action( 'wp_enqueue_scripts', 'add_custom_css' );

// Use featured image as custom-background if one is set
function featured_background_images() {
	// declare $post global if used outside of the loop
    global $post;

    // check to see if the theme supports Featured Images, and one is set
    if (current_theme_supports( 'post-thumbnails' ) && has_post_thumbnail( $post->ID )) {
            
        // specify desired image size in place of 'full'
        $page_bg_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'full' );
        $page_bg_image_url = $page_bg_image[0]; // this returns just the URL of the image

	    // And below, spit out the <style> tag... ?> 
	    <style type="text/css" id="custom-background-css-override">
	        body.custom-background { background-image: url('<?php echo $page_bg_image_url; ?>')!important; }
	    </style> <?php
	}
}

add_action ('wp_head', 'featured_background_images');

// Register before header right widget area.
genesis_register_sidebar( array(
	'id'          => 'before-header-right',
	'name'        => __( 'Before Header Right', 'centric-pro' ),
	'description' => __( 'This is a small header that appears before the main header', 'centric-pro' ),
) );

// Site Wide CTA widget area.
genesis_register_sidebar( array(
	'id'          => 'site-wide-cta',
	'name'        => __( 'Site Wide CTA', 'centric-pro' ),
	'description' => __( 'This is the Site Wide CTA section.', 'centric-pro' ),
));

// Front Page CTA widget area.
genesis_register_sidebar( array(
	'id'          => 'front-page-cta',
	'name'        => __( 'Front Page CTA', 'centric-pro' ),
	'description' => __( 'This is the CTA section on the front page.', 'centric-pro' ),
));

function site_wide_cta_area() {

	if ( ( !is_home() && !is_front_page() && !is_page('contact-us') ) ) {

		genesis_widget_area( 'site-wide-cta', array(
			'before'	=> '<div class="site-wide-cta widget-area"><div class="wrap">',
			'after'		=> '</div></div>',
		));
	}
}

add_action('genesis_before_footer', 'site_wide_cta_area', 2);

function front_page_cta_area() {

	if ( ( is_home() || is_front_page() ) ) {

		genesis_widget_area( 'front-page-cta', array(
			'before'	=> '<div class="front-page-cta widget-area"><div class="wrap">',
			'after'		=> '</div></div>',
		));
	}
}

add_action('genesis_before_footer', 'front_page_cta_area', 9);

// Register our custom widget areas.
genesis_register_sidebar( array(
	'id'          => 'before-footer-1',
	'name'        => __( 'Before Footer 1', 'centric-pro' ),
	'description' => __( 'This is the before footer 1 widget area.', 'centric-pro' ),
) );
// Register before footer widget area.
genesis_register_sidebar( array(
	'id'          => 'before-footer-2',
	'name'        => __( 'Before Footer 2', 'centric-pro' ),
	'description' => __( 'This is the before footer 2 widget area.', 'centric-pro' ),
) );
// Register before footer widget area.
genesis_register_sidebar( array(
	'id'          => 'before-footer-3',
	'name'        => __( 'Before Footer 3', 'centric-pro' ),
	'description' => __( 'This is the before footer 3 widget area.', 'centric-pro' ),
) );
// Register before footer widget area.
genesis_register_sidebar( array(
	'id'          => 'before-footer-4',
	'name'        => __( 'Before Footer 4', 'centric-pro' ),
	'description' => __( 'This is the before footer 4 widget area.', 'centric-pro' ),
) );
// Register before footer widget area.
genesis_register_sidebar( array(
	'id'          => 'before-footer-5',
	'name'        => __( 'Before Footer 5', 'centric-pro' ),
	'description' => __( 'This is the before footer 5 widget area.', 'centric-pro' ),
) );

add_action( 'genesis_before_footer', 'business_before_footer_widget_area', 9 );
/**
 * Display before-footer widget area.
 *
 * @since 1.0.0
 *
 * @return void
 */
function business_before_footer_widget_area() { ?>
	<div class="before-footer"><div class="wrap"> <?php 
	genesis_widget_area( 'before-footer-1', array(
		'before' => '<div class="one-fifth first"><div class="">',
		'after'  => '</div></div>',
	) );
	genesis_widget_area( 'before-footer-2', array(
		'before' => '<div class="one-fifth"><div class="">',
		'after'  => '</div></div>',
	) );
	genesis_widget_area( 'before-footer-3', array(
		'before' => '<div class="one-fifth"><div class="">',
		'after'  => '</div></div>',
	) );
	genesis_widget_area( 'before-footer-4', array(
		'before' => '<div class="one-fifth"><div class="">',
		'after'  => '</div></div>',
	) );
	genesis_widget_area( 'before-footer-5', array(
		'before' => '<div class="one-fifth"><div class="">',
		'after'  => '</div></div>',
	) ); ?>
	</div></div> <?php
}

// creactive centric modified
function creactive_add_header_section() {
	if(is_active_sidebar('before-header-right')) { ?>

		<div class="before-header">
			<div class="before-header-right">
				<?php genesis_widget_area( 'before-header-right', array(
					'before' => '',
					'after' => '',
				)); ?>
			</div>
		</div>

	<?php
	}
}

add_action('before_genesis_header_wrap', 'creactive_add_header_section');