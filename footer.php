	
	<?php // Get Theme Options from Database
		$theme_options = momentous_theme_options();
	?>
	
	<div id="footer-bg">
	
		<?php get_sidebar('footer'); ?>
		
		<div id="footer-wrap">
		
			<footer id="footer" class="container clearfix" role="contentinfo">
				
			<?php // Display Footer Text
				
				// Get Theme Options from Database
				$theme_options = momentous_theme_options();

				if ( isset( $theme_options['footer_text'] ) and $theme_options['footer_text'] <> '' ) :
					
					echo do_shortcode(wp_kses_post($theme_options['footer_text']));
						
				endif; 
				
			?>
				<div id="credit-link"><?php momentous_credit_link(); ?></div>
			
			</footer>
		
		</div>

	</div>
	
</div><!-- end #wrapper -->

<?php wp_footer(); ?>
</body>
</html>