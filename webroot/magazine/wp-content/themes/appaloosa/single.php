<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package HitMag
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		while ( have_posts() ) : the_post();

			get_template_part( 'template-parts/content', 'single' );

			if ( true == get_theme_mod( 'authorbox_sw', true) ) :
				get_template_part( 'template-parts/authorbox' );
			endif;			

			if ( true == get_theme_mod( 'relatedposts_sw', true ) ) :
				get_template_part( 'template-parts/related-posts' );
			endif;

			// uncomment to show posts navigation bar
			// if ( true == get_theme_mod( 'postsnav_sw', true ) ) :
			// 	the_post_navigation( array(
			// 		'next_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Next Article', 'hitmag' ) . '</span> ' .
			// 			'<span class="post-title">%title</span>',
			// 		'prev_text' => '<span class="meta-nav" aria-hidden="true">' . esc_html__( 'Previous Article', 'hitmag' ) . '</span> ' .
			// 			'<span class="post-title">%title</span>',
			// 	) );
			// endif;

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();