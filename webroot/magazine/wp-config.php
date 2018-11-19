<?php
/** Enable W3 Total Cache */
define('WP_CACHE', true); // Added by W3 Total Cache


/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'appaloosa_mag');

/** MySQL database username */
define('DB_USER', 'toadminapmag');

/** MySQL database password */
define('DB_PASSWORD', 'Trufasazuis87@');

/** MySQL hostname */
define('DB_HOST', 'appaloosa-mag.mysql.uhserver.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'vM`]QT=`jmPRH*7iJqV&6v4Sms,5qf) >.PSki3^`;qH]V!qqRZoV[urX,~ESsWq');
define('SECURE_AUTH_KEY',  'H9$0h~o&^C8@~3nRVVb&vQ4cA1!3ZdBngG{hP:R3QxN$])P5QtR>6?X>vjQKw;1)');
define('LOGGED_IN_KEY',    'M/!AgshS[U~Z/ )~,E{4Z$XLsxITf!/}>*_fQZ11vZsCkC*VU$G15$|-X%h0BC%G');
define('NONCE_KEY',        'r]TZ* jz.ZpUJqzU9r5.(0|-6uc2?5[VN^A0;9]N(G$OcP2!e;0tq=lLCiZb9I<o');
define('AUTH_SALT',        'rj;+XFrRqf+?T u#?>r]=N,q|,*`J^-.&uUn[*Ys,~#Ps+N[v;Y|TrA79di9rAF:');
define('SECURE_AUTH_SALT', 'I`vUClm^NUIwf_BZee^||v0|%&l@YmM<wJTia81y%?4=z^kn16omV*{=>,jTtPn#');
define('LOGGED_IN_SALT',   '<LgQ6o!#j 9d}NWjV3kv1]Kwwcws5V]WcDdG13D0V?e;Te 6_1j%!;5Mr?C:yRH1');
define('NONCE_SALT',       'XzMNBe,*QR)O@G*G$pH+I%}~-xSA],wYK@eOalgL[!p8Dhr?_s@nFj|5r?G,O+oy');


/**#@+
 * Unbind database domain config
 *
 * This will be set the current uri always as the wp_address
 * so, we are no more dependent of database domain configurations
*/

/**#@+ Dont need to configure domains at database */
$SUBFOLDER	 	= "/magazine/";
$PROTOCOL    	= (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://";
$AP_CURRENT_URI = $PROTOCOL . $_SERVER['HTTP_HOST'] . $SUBFOLDER;

if( $_SERVER['HTTP_HOST'] == 'localhost' ){
	$AP_CURRENT_URI = $PROTOCOL . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$AP_CURRENT_URI = implode("/", array_slice(explode("/", $AP_CURRENT_URI), 0, 4)) . $SUBFOLDER;
}

define('WP_HOME', $AP_CURRENT_URI );
define('WP_SITEURL', $AP_CURRENT_URI );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'apmag_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */

define('WP_DEBUG', false);
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');

