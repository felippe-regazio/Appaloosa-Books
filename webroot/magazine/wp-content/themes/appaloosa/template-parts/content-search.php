<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package HitMag
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'hitmag-post' ); ?>>

	<?php if (has_post_thumbnail()) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
			<div class="archive-thumb">
			<?php 
				$hitmag_thumb_size = hitmag_thumb_size();
				the_post_thumbnail( $hitmag_thumb_size );
			?>
			</div><!-- .archive-thumb -->
		</a>
	<?php endif; ?>

	<div class="archive-content">
		<header class="entry-header">
			<?php 
				hitmag_category_list();
				the_title( sprintf( '<h3 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h3>' ); 

			if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php hitmag_posted_on(); ?>
				</div><!-- .entry-meta -->
			<?php endif; ?>
		</header><!-- .entry-header -->

		<div class="entry-summary">
			<?php
				if ( true == get_theme_mod( 'excerpt_display', true ) ) {
					the_excerpt();
				}

				if ( true == get_theme_mod( 'show_readmore', true ) ) {
					$readmore_text = get_theme_mod( 'readmore_text', 'Read More' ); ?>
					<a href="<?php the_permalink(); ?>" class="th-readmore"><?php echo esc_html( $readmore_text ); ?></a>
			<?php } ?>
		</div><!-- .entry-summary -->
	</div>

</article><!-- #post-## -->
