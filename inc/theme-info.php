<?php
/***
 * Theme Info
 *
 * Adds a simple Theme Info page to the Appearance section of the WordPress Dashboard. 
 *
 */


// Add Theme Info page to admin menu
add_action('admin_menu', 'momentous_add_theme_info_page');
function momentous_add_theme_info_page() {
	
	add_theme_page( 
		__('Welcome to Momentous', 'momentous-lite'), 
		__('Theme Info', 'momentous-lite'), 
		'edit_theme_options', 
		'momentous-lite', 
		'momentous_display_theme_info_page'
	);
	
}


// Display Theme Info page
function momentous_display_theme_info_page() { 
	
	// Get Theme Details from style.css
	$theme_data = wp_get_theme(); 
	
?>
			
	<div class="wrap theme-info-wrap">

		<h1><?php printf( __( 'Welcome to %1s %2s', 'momentous-lite' ), $theme_data->Name, $theme_data->Version ); ?></h1>

		<div class="theme-description"><?php echo $theme_data->Description; ?></div>
		
		<hr>
		<div class="important-links clearfix">
			<p><strong><?php _e('Important Links:', 'momentous-lite'); ?></strong>
				<a href="http://themezee.com/themes/momentous/" target="_blank"><?php _e('Theme Info Page', 'momentous-lite'); ?></a>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('Changelog', 'momentous-lite'); ?></a>
				<a href="http://preview.themezee.com/momentous/" target="_blank"><?php _e('Theme Demo', 'momentous-lite'); ?></a>
				<a href="http://themezee.com/docs/momentous-lite-documentation/" target="_blank"><?php _e('Theme Documentation', 'momentous-lite'); ?></a>
				
				<span class="social-icons">
					<a href="http://themezee.com/newsletter/" target="_blank"><span class="genericon-mail"></span></a>
					<a href="https://www.facebook.com/ThemeZee" target="_blank"><span class="genericon-facebook"></span></a>
					<a href="https://twitter.com/ThemeZee" target="_blank"><span class="genericon-twitter"></a>
				</span>
			</p>
		</div>
		<hr>
				
		<div id="getting-started">

			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">
				
					<h3><?php printf( __( 'Getting Started with %s', 'momentous-lite' ), $theme_data->Name ); ?></h3>
						
					<div class="section">
						<h4><?php _e( 'Theme Documentation', 'momentous-lite' ); ?></h4>
						
						<p class="about"><?php _e( 'Need any help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'momentous-lite' ); ?></p>
						<p>
							<a href="http://themezee.com/docs/momentous-lite-documentation/" target="_blank" class="button button-secondary"><?php _e('Visit Momentous Documentation', 'momentous-lite'); ?></a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Theme Options', 'momentous-lite' ); ?></h4>
						
						<p class="about"><?php _e( 'Momentous supports the awesome Theme Customizer for all theme settings. Click "Customize Theme" to open the Customizer now.', 'momentous-lite' ); ?></p>
						<p>
							<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary">Customize Theme</a>
						</p>
					</div>

				</div>
				
				<div class="column column-half clearfix">
					
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Theme Screenshot" />
					
				</div>
				
			</div>
			
		</div>
		
		<hr>
		
		<div id="theme-author">
			
			<p><?php printf( __( 'Momentous is proudly brought to you by %1s.', 'momentous-lite' ), 
				'<a target="_blank" href="http://themezee.com" title="ThemeZee">ThemeZee</a>'); ?>
			</p>
		
		</div>
	
	</div>

<?php
}


// Add CSS for Theme Info Panel
add_action('admin_enqueue_scripts', 'momentous_theme_info_page_css');
function momentous_theme_info_page_css() { 
	
	// Load styles and scripts only on themezee page
	if ( isset($_GET['page']) and $_GET['page'] == 'momentous-lite' ) :
		
		// Embed theme info css style
		wp_enqueue_style('momentous-lite-theme-info-css', get_template_directory_uri() .'/css/theme-info.css');
		
		// Register Genericons
		wp_enqueue_style('momentous-lite-genericons', get_template_directory_uri() . '/css/genericons.css');
		
	endif;
}


?>