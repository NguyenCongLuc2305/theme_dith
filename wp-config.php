<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'theme_dith' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ',=C;osT4t8,))I~M=@UK`1Raom-~P[)E6qH1&@zYrdUc3pD5,4?EXnD*aj6 p=Ed' );
define( 'SECURE_AUTH_KEY',  '#WYreXn+Xu5I:K;E]#n|XKKRZZcW5nNMPxe>`9x[6EB}6rQebcw_lC|8sx,%V-_Y' );
define( 'LOGGED_IN_KEY',    'yO7m>km257=~@[?#CnT^,B0(<-;ZVM2T(}-7ndlqIpLIv[n`xpO=i?HHnl4Z?B7J' );
define( 'NONCE_KEY',        'KMAv`Z-/7WLZ:f=:Y,Y4z[8wHk]I[e^/u:.8TH@/ey1W2r`vgZ=SxC 6lszIa3vm' );
define( 'AUTH_SALT',        'fJA)M9[,#sW@%TRsmMqe7lC&5(;F;n[b]t_8(^@HhLaC:s3Y7nWrKj#1<6!%=3.e' );
define( 'SECURE_AUTH_SALT', '+2SX~8Vut7J7PtPP[e|KgARw7#Z:mqDvM{uqJFMMAkMz*+O)@9EReU0RP*;9(~uu' );
define( 'LOGGED_IN_SALT',   '-@)XL-YnOK#iqC)_JjrEr6LneS(9s-5`i_oURQ?g5zJT&xV9Bt0hS|^DsR6w#F_u' );
define( 'NONCE_SALT',       'ZG]D&5F?7F.9OB;n8c8:Q1nB4bQ2n86}bo|+l0zbsGtEM;3>:Svit|(ppP}kR{TE' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */

define( 'DEV_MODE', true); 
define( 'WP_DEBUG', true );
define( 'THEME_DEV_MODE_ELEMENTS', true );
define( 'THEME_DEV_MODE_SCSS', true ); 
define( 'WP_POST_REVISIONS', 3);
define( 'WP_DEBUG_DISPLAY', false );
define( 'WP_DEBUG_LOG', true );

define( 'FS_METHOD', 'direct' );
define('FTP_SSL', false);

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
