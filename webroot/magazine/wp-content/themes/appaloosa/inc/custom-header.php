<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package HitMag
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses hitmag_header_style()
 */
function hitmag_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'hitmag_custom_header_args', array(
		'default-image'          	=> '',
		'default-text-color'     	=> 'e74c3c',
		'width'						=> 1400,
		'height'					=> 400,
		'flex-width'				=> true,
		'flex-height'				=> true,
		'wp-head-callback'       	=> 'hitmag_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'hitmag_custom_header_setup' );


if ( ! function_exists( 'hitmag_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 */
function hitmag_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden or the logo?
		if ( ! display_header_text() ) :
	?>
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
			
			<?php
			$custom_logo_id = get_theme_mod( 'custom_logo' );
			if ( empty( $custom_logo_id ) ) : ?>

				.site-branding {
					display: none;
				}

			<?php endif; ?>

	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;


/**
 * Displays header image.
 */
function hitmag_header_image() {

	$header_image = get_header_image();

	if ( ! empty ( $header_image ) ) : 
		
		$link_header_image = get_theme_mod( 'link_header_image', false );
		echo '<div class="hm-header-image">';
			if ( $link_header_image == true ) { echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name', 'display' ) ) . '" rel="home">'; }
				echo '<img src="' . esc_url ( $header_image ) . '" height="' . esc_attr( get_custom_header()->height ) . '" width="' . esc_attr( get_custom_header()->width ) . '" alt="" />';
			if ( $link_header_image == true ) { echo '</a>'; }
		echo '</div>';

	endif;

}