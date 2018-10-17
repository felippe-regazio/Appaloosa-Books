<?php

/**
 * Hooks custom css into the head.
 */
function hitmag_custom_styles() {
	
	$hitmag_custom_styles = "";

	$primary_color = get_theme_mod( 'hitmag_primary_color', '#E74C3C' );

	$primary_color = esc_attr( $primary_color );

	if ( $primary_color != '#E74C3C' ) {

		$hitmag_custom_styles .= '
			button,
			input[type="button"],
			input[type="reset"],
			input[type="submit"] {
				background: '. $primary_color .';
			}

            .th-readmore {
                background: '. $primary_color .';
            }           

            a:hover {
                color: '. $primary_color .';
            } 

            .main-navigation a:hover {
                background-color: '. $primary_color .';
            }

            .main-navigation .current_page_item > a,
            .main-navigation .current-menu-item > a,
            .main-navigation .current_page_ancestor > a,
            .main-navigation .current-menu-ancestor > a {
                background-color: '. $primary_color .';
            }

            #main-nav-button:hover {
                background-color: '. $primary_color .';
            }

            .post-navigation .post-title:hover {
                color: '. $primary_color .';
            }

            .top-navigation a:hover {
                color: '. $primary_color .';
            }

            .top-navigation ul ul a:hover {
                background: '. $primary_color .';
            }

            #top-nav-button:hover {
                color: '. $primary_color .';
            }

            .responsive-mainnav li a:hover,
            .responsive-topnav li a:hover {
                background: '. $primary_color .';
            }

            #hm-search-form .search-form .search-submit {
                background-color: '. $primary_color .';
            }

            .nav-links .current {
                background: '. $primary_color .';
            }

            .widget-title {
                border-bottom: 2px solid '. $primary_color .';
            }

            .footer-widget-title {
                border-bottom: 2px solid '. $primary_color .';
            }

            .widget-area a:hover {
                color: '. $primary_color .';
            }

            .footer-widget-area a:hover {
                color: '. $primary_color .';
            }

            .site-info a:hover {
                color: '. $primary_color .';
            }

            .search-form .search-submit {
                background: '. $primary_color .';
            }

            .hmb-entry-title a:hover {
                color: '. $primary_color .';
            }

            .hmb-entry-meta a:hover,
            .hms-meta a:hover {
                color: '. $primary_color .';
            }

            .hms-title a:hover {
                color: '. $primary_color .';
            }

            .hmw-grid-post .post-title a:hover {
                color: '. $primary_color .';
            }

            .footer-widget-area .hmw-grid-post .post-title a:hover,
            .footer-widget-area .hmb-entry-title a:hover,
            .footer-widget-area .hms-title a:hover {
                color: '. $primary_color .';
            }

            .hm-tabs-wdt .ui-state-active {
                border-bottom: 2px solid '. $primary_color .';
            }

            a.hm-viewall {
                background: '. $primary_color .';
            }

            #hitmag-tags a,
            .widget_tag_cloud .tagcloud a {
                background: '. $primary_color .';
            }

            .site-title a {
                color: '. $primary_color .';
            }

            .hitmag-post .entry-title a:hover {
                color: '. $primary_color .';
            }

            .hitmag-post .entry-meta a:hover {
                color: '. $primary_color .';
            }

            .cat-links a {
                color: '. $primary_color .';
            }

            .hitmag-single .entry-meta a:hover {
                color: '. $primary_color .';
            }

            .hitmag-single .author a:hover {
                color: '. $primary_color .';
            }

            .hm-author-content .author-posts-link {
                color: '. $primary_color .';
            }

            .hm-tags-links a:hover {
                background: '. $primary_color .';
            }

            .hm-tagged {
                background: '. $primary_color .';
            }

            .hm-edit-link a.post-edit-link {
                background: '. $primary_color .';
            }

            .arc-page-title {
                border-bottom: 2px solid '. $primary_color .';
            }

            .srch-page-title {
                border-bottom: 2px solid '. $primary_color .';
            }

            .hm-slider-details .cat-links {
                background: '. $primary_color .';
            }

            .hm-rel-post .post-title a:hover {
                color: '. $primary_color .';
            }

            .comment-author a {
                color: '. $primary_color .';
            }

            .comment-metadata a:hover,
            .comment-metadata a:focus,
            .pingback .comment-edit-link:hover,
            .pingback .comment-edit-link:focus {
                color: '. $primary_color .';
            }

            .comment-reply-link:hover,
            .comment-reply-link:focus {
                background: '. $primary_color .';
            }

            .required {
                color: '. $primary_color .';
            }

            blockquote {
                border-left: 3px solid '. $primary_color .';
            }

            .comment-reply-title small a:before {
                color: '. $primary_color .';
            }
            
            .woocommerce ul.products li.product h3:hover,
            .woocommerce-widget-area ul li a:hover,
            .woocommerce-loop-product__title:hover {
                color: '. $primary_color .';
            }

            .woocommerce-product-search input[type="submit"],
            .woocommerce #respond input#submit, 
            .woocommerce a.button, 
            .woocommerce button.button, 
            .woocommerce input.button,
            .woocommerce nav.woocommerce-pagination ul li a:focus,
            .woocommerce nav.woocommerce-pagination ul li a:hover,
            .woocommerce nav.woocommerce-pagination ul li span.current,
            .woocommerce span.onsale,
            .woocommerce-widget-area .widget-title,
            .woocommerce #respond input#submit.alt,
            .woocommerce a.button.alt,
            .woocommerce button.button.alt,
            .woocommerce input.button.alt {
                background: '. $primary_color .';
            }';

	}

	if ( ! empty( $hitmag_custom_styles ) ) { ?>
		<style type="text/css">
			<?php echo $hitmag_custom_styles; ?>
		</style>
	<?php }

}
add_action( 'wp_head', 'hitmag_custom_styles' );