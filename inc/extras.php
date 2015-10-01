<?php
/**
 * Custom functions that are not template related
 *
 * @package Momentous Lite
 */


// Add Default Menu Fallback Function
function momentous_default_menu() {
	echo '<ul id="mainnav-menu" class="menu">'. wp_list_pages('title_li=&echo=0') .'</ul>';
}


// Get Featured Posts
function momentous_get_featured_content() {
	return apply_filters( 'momentous_get_featured_content', false );
}


// Check if featured posts exists
function momentous_has_featured_content() {
	return ! is_paged() && (bool) momentous_get_featured_content();
}


// Change Excerpt Length
add_filter('excerpt_length', 'momentous_excerpt_length');
function momentous_excerpt_length($length) {
    return 25;
}

// Slideshow Excerpt Length
function  momentous_featured_content_excerpt_length($length) {
    return 40;
}


// Change Excerpt More
add_filter('excerpt_more', 'momentous_excerpt_more');
function momentous_excerpt_more($more) {
    
	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Return Excerpt Text
	if ( isset($theme_options['excerpt_text']) and $theme_options['excerpt_text'] == true ) :
		return ' [...]';
	else :
		return '';
	endif;
}