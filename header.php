<!DOCTYPE html><!-- HTML 5 -->
<html <?php language_attributes(); ?>>

<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php // Get Theme Options from Database
	$theme_options = momentous_theme_options();
?>

<div id="wrapper" class="hfeed">

	<div id="header-wrap">
	
		<?php // Display Search Form
		if ( isset($theme_options['header_search']) and $theme_options['header_search'] == true ) : ?>
			
			<div id="header-search-wrap">
			
				<div id="header-search" class="container clearfix">
					<?php get_search_form(true); ?>
				</div>
				
			</div>

		<?php endif; ?>
			
		<header id="header" class="container clearfix" role="banner">

			<div id="logo">
			
				<a href="<?php echo esc_url(home_url('/')); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
				<?php // Display Logo Image or Site Title
				if ( momentous_has_site_logo() ) : ?>
					<img class="site-logo" src="<?php echo momentous_get_site_logo(); ?>" data-size="site-logo" alt="Logo" />
				<?php else: ?>
					<h1 class="site-title"><?php bloginfo('name'); ?></h1>
				<?php endif; ?>
				</a>
				
			<?php // Display Tagline on header if activated
			if ( isset($theme_options['header_tagline']) and $theme_options['header_tagline'] == true ) : ?>			
				<h2 class="site-description"><?php echo bloginfo('description'); ?></h2>
			<?php endif; ?>
			
			</div>
			
			<nav id="topnav" class="clearfix" role="navigation">

				<?php // Display Header Search Icon
				if ( isset($theme_options['header_search']) and $theme_options['header_search'] == true ) : ?>
					<div class="header-search-icon">
						<span class="genericon-search"></span>
					</div>
				<?php endif; ?>
				
				<p id="topnav-icon"></p>
				
				<?php // Display Top Navigation
					wp_nav_menu(array('theme_location' => 'secondary', 'container' => false, 'menu_id' => 'topnav-menu', 'echo' => true, 'fallback_cb' => '', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 1));
				?>
				
			</nav>

		</header>
		
		<div id="navigation-wrap">
			
			<div id="navigation" class="container clearfix">
				<p id="mainnav-icon-tablet" class="mainnav-icon"></p><p id="mainnav-icon-phone" class="mainnav-icon"></p><p id="social-menu-icon"></p>
				
				<?php // Display Social Icons in Navigation
					if ( isset($theme_options['header_icons']) and $theme_options['header_icons'] == true ) : ?>

						<div id="navi-social-icons" class="social-icons-wrap clearfix">
							<?php momentous_display_social_icons(); ?>
						</div>

					<?php endif; ?>
				
				
				<nav id="mainnav" class="clearfix" role="navigation">
					<?php 
						// Get Navigation out of Theme Options
						wp_nav_menu(array('theme_location' => 'primary', 'container' => false, 'menu_id' => 'mainnav-menu', 'echo' => true, 'fallback_cb' => 'momentous_default_menu', 'before' => '', 'after' => '', 'link_before' => '', 'link_after' => '', 'depth' => 0));
					?>
				</nav>
				
			</div>
			
		</div>
	
	</div>

	<?php // Display Custom Header Image
		momentous_display_custom_header(); ?>
		