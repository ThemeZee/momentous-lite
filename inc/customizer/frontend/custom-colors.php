<?php
/***
 * Custom Color Options
 *
 * Get custom colors from theme options and embed CSS color settings 
 * in the <head> area of the theme. 
 *
 */


// Add Custom Colors
add_action('wp_head', 'momentous_custom_colors');
function momentous_custom_colors() { 
	
	// Get Theme Options from Database
	$theme_options = momentous_theme_options();

	// Set Color CSS Variable
	$color_css = '';
	
	// Set Header and Footer Border Color
	if ( isset($theme_options['header_color']) and $theme_options['header_color'] <> '#282828' ) : 
	
		$color_css .= '
			#header-wrap {
				background-color: '. $theme_options['header_color'] .';
			}';
		
	endif;
	
	// Set Navigation Color
	if ( isset($theme_options['navi_color']) and $theme_options['navi_color'] <> '#22a8d8' ) : 
	
		$color_css .= '
			#mainnav-menu a:hover, #mainnav-menu li.current_page_item a, #mainnav-menu li.current-menu-item a,
			#social-icons-menu li a, #social-icons-menu li a:before {
				color: '. $theme_options['navi_color'] .';
			}
			@media only screen and (min-width: 60em) {
				#mainnav-menu ul {
					background-color: '. $theme_options['navi_color'] .';
				}
			}';
		
	endif;
	
	// Set Post Title Color
	if ( isset($theme_options['title_color']) and $theme_options['title_color'] <> '#282828' ) : 
	
		$color_css .= '
			.page-title, .post-title, .post-title a:link, .post-title a:visited {
				color: '. $theme_options['title_color'] .';
			}';
			
	endif;
	
	// Set Link Color
	if ( isset($theme_options['link_color']) and $theme_options['link_color'] <> '#22a8d8' ) : 
	
		$color_css .= '
			a, a:link, a:visited, .comment a:link, .comment a:visited,
			.postinfo span a:hover, .postinfo span a:active, .postinfo .meta-comments a:hover, .postinfo .meta-comments a:active,
			.postinfo .meta-comments a:hover:before, .post-pagination a:hover, .post-pagination .current {
				color: '. $theme_options['link_color'] .';
			}
			input[type="submit"], .more-link, #commentform #submit {
				background-color: '. $theme_options['link_color'] .';
			}';
			
	endif;
	
	// Set Widget Title Color
	if ( isset($theme_options['widget_title_color']) and $theme_options['widget_title_color'] <> '#282828' ) : 
	
		$color_css .= '
			#sidebar .widgettitle, .archive-title span {
				color: '. $theme_options['widget_title_color'] .';
			}';
			
	endif;
	
	// Set Widget Link Color
	if ( isset($theme_options['widget_link_color']) and $theme_options['widget_link_color'] <> '#22a8d8' ) : 
	
		$color_css .= '
			.widget a:link, .widget a:visited {
				color: '. $theme_options['widget_link_color'].';
			}';
			
	endif;
	
	// Set Footer Color
	if ( isset($theme_options['footer_color']) and $theme_options['footer_color'] <> '#282828' ) : 
	
		$color_css .= '
			#footer-wrap, #footer-bg {
				background-color: '. $theme_options['footer_color'] .';
			}';
			
	endif;
	
	
	// Print Color CSS
	if ( isset($color_css) and $color_css <> '' ) :
	
		echo '<style type="text/css">';
		echo $color_css;
		echo '</style>';
	
	endif;
	
}