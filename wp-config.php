<?php
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
define('DB_NAME', 'takethelead');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         'yR/:EVlS7TMfI* _D|qem>%vFZo/0]sl2V&:gbnG#v66M!6*VJ7 X/a~Y9qSqR[ ');
define('SECURE_AUTH_KEY',  '`IFKJfrUzd?<rX8/CB{[9Yz>IX3XI[<Ve/Md[Evar.E!18cqN+P<Cy%e]EOWz5GM');
define('LOGGED_IN_KEY',    'sUa/|H*;_+S<kA.%d.iEO(ZV&T`VXW3AK IOYHXry@CL9c3cJ_qw>=gy>|Jp9V0b');
define('NONCE_KEY',        'NtYAY%47b1TCQ~koo.0qY;t{!l^%V89>U_.7:`}p!<>0wBaA_b4y{XaDIV?4<>(n');
define('AUTH_SALT',        ' Fmc{WMC&D9OCpQh9NlEb#J/7c@[o/*~VvkV^%~m|B{O4 T/^=OFGWgzK_O5_~Q>');
define('SECURE_AUTH_SALT', '@+X@FuAx;r,DCOaha5:%$h?pIXpTW@hlS(.wH;Ju*mr~jGJ:=&qTLaHOcr,|(ol`');
define('LOGGED_IN_SALT',   's&EbB{:=Cp/}m0Gp}+Y]w#_mupDPcE wdp)4-ATIA Sju_>nY]dB2LfTb(<s?)7J');
define('NONCE_SALT',       'y$cpc}<8}.!r_C.^pHs%x~}T|/7d.rYzm v0^(xFf:_}[<tMw*D]qjd~.+Es8`i=');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
