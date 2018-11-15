<?php
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', true);

/** Force trailing slash */
$PROTOCOL = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";
$CURRENT_URI = $PROTOCOL . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
if (substr( $CURRENT_URI, -1 ) !== '/') {
    header('Location: '.$CURRENT_URI."/", true, 301);
    exit;
}

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );