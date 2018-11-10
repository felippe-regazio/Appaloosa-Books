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

/** 
	O cake identifica os enderecos sem / no fim como metodos, entao
	geralmente o endereco dominio.com/magazine soh abre quando usado como dominio.com/magazine/.
	Este hook verifica se a raiz esta sem / e redirecionad para magazine/ com barra no fim
**/
$base_uri = "magazine";
$uri = explode("/", $_SERVER['REQUEST_URI']);
if( $uri[1] != $base_uri ){
	$address  = "http://" . $_SERVER['HTTP_HOST'] . "/magazine/";
	header('Location: ' . $address, false);
	die();
}

/**
	slash on admin addresses
**/
if( $uri[1] != "admin" ){
	$address  = "http://" . $_SERVER['HTTP_HOST'] . "/admin/";
	header('Location: ' . $address, false);
	die();
}

/** Loads the WordPress Environment and Template */
require( dirname( __FILE__ ) . '/wp-blog-header.php' );