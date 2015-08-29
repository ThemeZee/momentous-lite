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
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
	add_theme_page( 
		sprintf( __( 'Welcome to %1$s %2$s', 'momentous-lite' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ), 
		__('Theme Info', 'momentous-lite'), 
		'edit_theme_options', 
		'momentous', 
		'momentous_display_theme_info_page'
	);
	
}


// Display Theme Info page
function momentous_display_theme_info_page() { 
	
	// Get Theme Details from style.css
	$theme = wp_get_theme(); 
	
?>
			
	<div class="wrap theme-info-wrap">

		<h1><?php printf( __( 'Welcome to %1$s %2$s', 'momentous-lite' ), $theme->get( 'Name' ), $theme->get( 'Version' ) ); ?></h1>

		<div class="theme-description"><?php echo $theme->get( 'Description' ); ?></div>
		
		<hr>
		<div class="important-links clearfix">
			<p><strong><?php _e('Important Links:', 'momentous-lite'); ?></strong>
				<a href="http://themezee.com/themes/momentous/" target="_blank"><?php _e('Theme Page', 'momentous-lite'); ?></a>
				<a href="<?php echo get_template_directory_uri(); ?>/changelog.txt" target="_blank"><?php _e('Changelog', 'momentous-lite'); ?></a>
				<a href="http://preview.themezee.com/momentous/" target="_blank"><?php _e('Theme Demo', 'momentous-lite'); ?></a>
				<a href="http://themezee.com/docs/momentous-documentation/" target="_blank"><?php _e('Theme Documentation', 'momentous-lite'); ?></a>
				<a href="http://wordpress.org/support/view/theme-reviews/momentous-lite?filter=5" target="_blank"><?php _e('Rate this theme', 'momentous-lite'); ?></a>
			</p>
		</div>
		<hr>
				
		<div id="getting-started">
		
			<h3><?php printf( __( 'Getting Started with %s', 'momentous-lite' ), $theme->get( 'Name' ) ); ?></h3>
			
			<div class="columns-wrapper clearfix">

				<div class="column column-half clearfix">
						
					<div class="section">
						<h4><?php _e( 'Theme Documentation', 'momentous-lite' ); ?></h4>
						
						<p class="about">
							<?php _e( 'You need help to setup and configure this theme? We got you covered with an extensive theme documentation on our website.', 'momentous-lite' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/docs/momentous-documentation/" target="_blank" class="button button-secondary">
								<?php printf( __( 'View %s Documentation', 'momentous-lite' ), 'Momentous' ); ?>
							</a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Theme Options', 'momentous-lite' ); ?></h4>
						
						<p class="about">
							<?php printf( __( '%s makes use of the Customizer for all theme settings. Click on "Customize Theme" to open the Customizer now.', 'momentous-lite' ), $theme->get( 'Name' ) ); ?>
						</p>
						<p>
							<a href="<?php echo admin_url( 'customize.php' ); ?>" class="button button-primary"><?php _e('Customize Theme', 'momentous-lite'); ?></a>
						</p>
					</div>
					
					<div class="section">
						<h4><?php _e( 'Pro Version', 'momentous-lite' ); ?></h4>
						
						<p class="about">
							<?php _e( 'You need more features? Purchase the Pro Version to get additional features and advanced customization options.', 'momentous-lite' ); ?>
						</p>
						<p>
							<a href="http://themezee.com/themes/momentous/#PROVersion-1" target="_blank" class="button button-secondary">
								<?php printf( __( 'Learn more about %s Pro', 'momentous-lite' ), 'Momentous'); ?>
							</a>
						</p>
					</div>

				</div>
				
				<div class="column column-half clearfix">
					
					<img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" />
					
				</div>
				
			</div>
			
		</div>
		
		<hr>
		
		<div id="theme-author">
			
			<p><?php printf( __( '%1$s is proudly brought to you by %2$s. If you like this theme, %3$s :)', 'momentous-lite' ), 
				$theme->get( 'Name' ),
				'<a target="_blank" href="http://themezee.com" title="ThemeZee">ThemeZee</a>',
				'<a target="_blank" href="http://wordpress.org/support/view/theme-reviews/momentous-lite?filter=5" title="Momentous Lite Review">' . __( 'rate it', 'momentous-lite' ) . '</a>'); ?>
			</p>
		
		</div>
	
	</div>

<?php
}


// Add CSS for Theme Info Panel
add_action('admin_enqueue_scripts', 'momentous_theme_info_page_css');
function momentous_theme_info_page_css($hook) { 

	// Load styles and scripts only on theme info page
	if ( 'appearance_page_momentous' != $hook ) {
		return;
	}
	
	// Embed theme info css style
	wp_enqueue_style('momentous-lite-theme-info-css', get_template_directory_uri() .'/css/theme-info.css');

}

?>