/*
 * Customizer.js to reload changes on Theme Customizer Preview asynchronously.
 *
 */

( function( $ ) {

	/* Default WordPress Customizer settings */
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#logo .site-title' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#logo .site-description' ).text( to );
		} );
	} );
	
	/* Theme Colors */	
	wp.customize( 'momentous_theme_options[header_color]', function( value ) {
		value.bind( function( newval ) {
			$('#header-wrap').css('background-color', newval );
		} );
	} );
	
	wp.customize( 'momentous_theme_options[title_color]', function( value ) {
		value.bind( function( newval ) {
			$('.page-title, .post-title, .post-title a:link, .post-title a:visited')
				.css('color', newval );
		} );
	} );
	
	wp.customize( 'momentous_theme_options[widget_title_color]', function( value ) {
		value.bind( function( newval ) {
			$('#sidebar .widgettitle, .archive-title span')
				.css('color', newval );
		} );
	} );
	
	wp.customize( 'momentous_theme_options[widget_link_color]', function( value ) {
		value.bind( function( newval ) {
			$('#sidebar .widget a:link, #sidebar .widget a:visited')
				.css('color', newval );
		} );
	} );
	
	wp.customize( 'momentous_theme_options[footer_color]', function( value ) {
		value.bind( function( newval ) {
			$('#footer-wrap, #footer-bg')
				.css('background', newval );
		} );
	} );
	

} )( jQuery );