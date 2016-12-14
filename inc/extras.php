<?php
/**
 * Custom functions that are not template related
 *
 * @package Momentous Lite
 */


// Add Default Menu Fallback Function
function momentous_default_menu() {
	echo '<ul id="mainnav-menu" class="main-navigation-menu menu">' . wp_list_pages( 'title_li=&echo=0' ) . '</ul>';
}


/**
 * Hide Elements with CSS.
 *
 * @return void
 */
function momentous_hide_elements() {

	// Get theme options from database.
	$theme_options = momentous_theme_options();

	$elements = array();

	// Hide Site Title?
	if ( false === $theme_options['site_title'] ) {
		$elements[] = '.site-title';
	}

	// Hide Site Description?
	if ( false === $theme_options['header_tagline'] ) {
		$elements[] = '.site-description';
	}

	// Return early if no elements are hidden.
	if ( empty( $elements ) ) {
		return;
	}

	// Create CSS.
	$classes = implode( ', ', $elements );
	$custom_css = $classes . ' {
	position: absolute;
	clip: rect(1px, 1px, 1px, 1px);
}';

	// Add Custom CSS.
	wp_add_inline_style( 'momentous-lite-stylesheet', $custom_css );
}
add_filter( 'wp_enqueue_scripts', 'momentous_hide_elements', 11 );


// Get Featured Posts
function momentous_get_featured_content() {
	return apply_filters( 'momentous_get_featured_content', false );
}


// Check if featured posts exists
function momentous_has_featured_content() {
	return ! is_paged() && (bool) momentous_get_featured_content();
}


// Change Excerpt Length
add_filter( 'excerpt_length', 'momentous_excerpt_length' );
function momentous_excerpt_length( $length ) {
	return 25;
}

// Slideshow Excerpt Length
function momentous_featured_content_excerpt_length( $length ) {
	return 40;
}


// Change Excerpt More
add_filter( 'excerpt_more', 'momentous_excerpt_more' );
function momentous_excerpt_more( $more ) {

	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Return Excerpt Text
	if ( isset( $theme_options['excerpt_text'] ) and $theme_options['excerpt_text'] == true ) :
		return ' [...]';
	else :
		return '';
	endif;
}
