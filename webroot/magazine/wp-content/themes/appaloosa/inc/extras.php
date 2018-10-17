<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package HitMag
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hitmag_body_classes( $classes ) {
	global $post;

	if ( false == get_theme_mod( 'hitmag_boxed_layout', true ) ) {
		$classes[] = 'hitmag-full-width';
	}

	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( is_home() || is_archive() || is_search() ) {
		$archive_sidebar_align = get_option( 'archive_sidebar_align', 'th-right-sidebar' );
		$classes[] = esc_attr( $archive_sidebar_align );
	}

	if ( is_single() ) {
		$post_specific_layout = get_post_meta( $post->ID, '_hitmag_layout_meta', true );
		if ( empty( $post_specific_layout ) || $post_specific_layout == 'th-default-layout' ) {
			$classes[] = esc_attr( get_option( 'post_sidebar_align', 'th-right-sidebar' ) );
		} else {
			$classes[] = esc_attr( $post_specific_layout );
		}
	}

	if( is_page_template( 'template-magazine.php' ) ) {
		$classes[] = 'th-right-sidebar';
	} elseif ( is_page() ) {
		$page_specific_layout = get_post_meta( $post->ID, '_hitmag_layout_meta', true );
		if ( empty( $page_specific_layout ) || $page_specific_layout == 'th-default-layout' ) {
			$classes[] = esc_attr( get_option( 'page_sidebar_align', 'th-right-sidebar' ) );
		} else {
			$classes[] = esc_attr( $page_specific_layout );
		}		
	}

	return $classes;
}
add_filter( 'body_class', 'hitmag_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function hitmag_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'hitmag_pingback_header' );

/**
 * Add a custom excerpt length.
 */
function hitmag_excerpt_length( $length ) {
	if( is_admin() ) {
		return $length;
	}
	$custom_length = get_theme_mod( 'excerpt_length', 30 );
	return absint( $custom_length );
}
add_filter( 'excerpt_length', 'hitmag_excerpt_length', 999 );

/**
 * Changes the excerpt more text.
 */
function hitmag_excerpt_more( $more ) {

	if ( is_admin() ) {
		return $more;
	}

	return ' &hellip; ';
}
add_filter( 'excerpt_more', 'hitmag_excerpt_more' );



if ( ! function_exists( 'hitmag_get_layout' ) ) :
/**
 * Returns the selected sidebar alignment for the page.
 *
 * @return string
 */
function hitmag_get_layout() {

	global $post;

	$layout = 'th-right-sidebar';

	if ( is_home() || is_archive() || is_search() ) {
		$archive_sidebar_align = get_option( 'archive_sidebar_align', 'th-right-sidebar' );
		$layout = $archive_sidebar_align;
	}

	if ( is_single() ) {
		$post_specific_layout = get_post_meta( $post->ID, '_hitmag_layout_meta', true );
		if ( empty( $post_specific_layout ) || $post_specific_layout == 'th-default-layout' ) {
			$layout = get_option( 'post_sidebar_align', 'th-right-sidebar' );
		} else {
			$layout = $post_specific_layout;
		}
	}
	if( is_page_template( 'template-magazine.php' ) ) {
		$classes[] = 'th-right-sidebar';
	} elseif ( is_page() ) {
		$page_specific_layout = get_post_meta( $post->ID, '_hitmag_layout_meta', true );
		if ( empty( $page_specific_layout ) || $page_specific_layout == 'th-default-layout' ) {
			$layout = get_option( 'page_sidebar_align', 'th-right-sidebar' );
		} else {
			$layout = $page_specific_layout;
		}	
	}

	return $layout;

}

endif;


/**
 * Changes tag font size.
 */
function hitmag_tag_cloud_sizes($args) {
	$args['smallest']	= 10;
	$args['largest'] 	= 10;
	return $args; 
}
add_filter('widget_tag_cloud_args','hitmag_tag_cloud_sizes');


/**
 * View all link for posts widgets 
 */
function hitmag_viewall_link( $category_id, $viewall_text ) {

	if ( ! empty( $viewall_text ) ) :

		if ( ! empty( $category_id ) ) {
			$viewall_link = get_category_link( $category_id );
		} else {
			$posts_page_id = get_option( 'page_for_posts' );

			if ( $posts_page_id ) {
				$viewall_link = get_page_link( $posts_page_id );
			} else {
				$viewall_link = "";
			}
		}

		if ( $viewall_link ) { ?>
			<a class="hm-viewall" href="<?php echo esc_url( $viewall_link ); ?>"><span><?php echo esc_html( $viewall_text ); ?></span></a>
		<?php }

	endif;  

}