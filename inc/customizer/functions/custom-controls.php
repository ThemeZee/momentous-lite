<?php
/**
 * Theme Customizer Functions
 *
 */

/*========================== CUSTOMIZER CONTROLS FUNCTIONS ==========================*/

// Add simple heading option to the theme customizer
if ( class_exists( 'WP_Customize_Control' ) ) :

    class Momentous_Customize_Header_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			</label>
			
<?php
        }
    }
	
	class Momentous_Customize_Description_Control extends WP_Customize_Control {

        public function render_content() {  ?>
			
			<span class="description"><?php echo wp_kses_post( $this->label ); ?></span>
			
<?php
        }
    }
	
	class Momentous_Customize_Font_Control extends WP_Customize_Control {
	
		private $fonts = false;
		
		public function __construct($manager, $id, $args = array(), $options = array()) {
		
			$this->fonts = array(
				'Arial' => 'Arial',
				'Alef' => 'Alef',
				'Average Sans' => 'Average Sans',
				'Bitter' => 'Bitter',
				'Carme' => 'Carme',
				'Droid Sans' => 'Droid Sans',
				'Francois One' => 'Francois One',
				'Fjalla One' => 'Fjalla One',
				'Josefin Slab' => 'Josefin Slab',
				'Lobster' => 'Lobster',
				'Luckiest Guy' => 'Luckiest Guy',
				'Jockey One' => 'Jockey One',
				'Maven Pro' => 'Maven Pro',
				'Modern Antiqua' => 'Modern Antiqua',
				'Nobile' => 'Nobile',
				'Oswald' => 'Oswald',
				'Permanent Marker' => 'Permanent Marker',
				'Roboto' => 'Roboto',
				'Raleway' => 'Raleway',
				'Share' => 'Share',
				'Tahoma' => 'Tahoma',
				'Ubuntu' => 'Ubuntu',
				'Verdana' => 'Verdana');
				
			// Add fonts installed by User
			$theme_options = momentous_theme_options();
			
			if ( isset($theme_options['installed_fonts']) and $theme_options['installed_fonts'] <> '' ) :
				
				// Get Fonts from Option Value
				$fonts = explode(';', $theme_options['installed_fonts']);
				
				// Add fonts to list
				foreach ( $fonts as $value) {
					if($value == '') continue;
					$this->fonts[trim($value)] = esc_attr(trim($value));
				}
				
				// Sort fonts alphabetically
				asort($this->fonts);
				
			endif;
	
	
			parent::__construct( $manager, $id, $args );
			
		}
		
		public function render_content() {
		
			if( !empty($this->fonts) ) :
			
            ?>
                <label>
                    <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
					<div class="customize-font-select-control">
						<select <?php $this->link(); ?>>
							<?php
								foreach ( $this->fonts as $k => $v )
								{
									printf('<option value="%s" %s>%s</option>', $k, selected($this->value(), $k, false), $v);
								}
							?>
						</select>
					</div>
				</label>
                
            <?php
			endif;
		}
		
	}
	
	
	class Momentous_Site_Logo_Control extends WP_Customize_Control {

		public function __construct( $wp_customize, $control_id, $args = array() ) {

			// declare these first so they can be overridden
			$this->l10n = array(
				'upload' =>      __( 'Add logo', 'momentous-lite' ),
				'set' =>         __( 'Set as logo', 'momentous-lite' ),
				'choose' =>      __( 'Choose logo', 'momentous-lite' ),
				'change' =>      __( 'Change logo', 'momentous-lite' ),
				'remove' =>      __( 'Remove logo', 'momentous-lite' ),
				'placeholder' => __( 'No logo set', 'momentous-lite' ),
			);

			parent::__construct( $wp_customize, $control_id, $args );
		}

		// this will be critical for your JS constructor
		public $type = 'site_logo';

		// this allows overriding of global labels by a specific control
		public $l10n = array();

		// the type of files that should be allowed by the media modal
		public $mime_type = 'image';

		public function has_site_logo() {
			$logo = get_option( 'site_logo' );

			if ( empty( $logo['url'] ) ) {
				return false;
			} else {
				return true;
			}
		}
		
		public function enqueue() {
			// enqueues all needed media resources
			wp_enqueue_media();
			// Except for its templates - those are attached to hooks that don't exist
			// in the Customizer. Just add once
			if ( ! has_action( 'customize_controls_print_footer_scripts', 'wp_print_media_templates' ) )
				add_action( 'customize_controls_print_footer_scripts', 'wp_print_media_templates' );

			// Finally, ensure our control script and style are enqueued
			wp_enqueue_script( 'momentous-lite-site-logo-control', get_template_directory_uri() . '/js/site-logo-control.js', array( 'media-views', 'customize-controls', 'underscore' ), '', true );
		}

		public function render_content() {
			
			// We do this to allow the upload control to specify certain labels
			$l10n = json_encode( $this->l10n );

			printf(
				'<span class="customize-control-title" data-l10n="%s" data-mime="%s">%s</span>',
				esc_attr( $l10n ),
				esc_attr( $this->mime_type ),
				esc_html( $this->label )
			);
			?>
			<span class="description"><?php _e('Site Logo Image replaces Site Title.', 'momentous-lite'); ?></span>
			<div class="current"></div>
			<div class="actions"></div>
		<?php }
	}
	
endif;

?>