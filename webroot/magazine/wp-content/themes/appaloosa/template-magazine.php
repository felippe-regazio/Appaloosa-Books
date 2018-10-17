<?php
/**
 * Template Name: Magazine Homepage
 *
 * Displays the Magazine Template of the theme.
 * 
 * @package HitMag
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

        <?php

            get_template_part( 'template-parts/featured-slider' );

            if( is_active_sidebar( 'magazine' ) ) {
                dynamic_sidebar( 'magazine' );
            } else {

                if ( current_user_can( 'edit_theme_options' ) ) : ?>

                    <p>
                        <?php esc_html_e( 'Please go to Appearance &#8594; Widgets and add posts widgets to the "Magazine Homepage" widget area. You can use the Magazine Posts widgets to set up the theme like the demo website.', 'hitmag' ); ?>
                    </p>

			    <?php endif;

            }

        ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();