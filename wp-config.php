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
define( 'DB_NAME', 'wordpress' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

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
define( 'AUTH_KEY',         'un~BG2w)f!66i=p0&Up:8%rwda9jwuwr%zzg0=xC2G<84.vBF#S.Xm+QJ>{gBze9' );
define( 'SECURE_AUTH_KEY',  'Z|NEfe+wsTe%NZE#74K2mAD7%)XH$eOQ_MD{UA</`e=xWt$:ag1R=8_2TT4]/b)s' );
define( 'LOGGED_IN_KEY',    'Sy];aQMic`9uyIsLW>T8_OsN}KIbj`mRfZ/?D~(M&zN4@O%:whNr>EKNza6Q6;Z*' );
define( 'NONCE_KEY',        'LfW)LRg;byzz&k.=Cd4P+5IAd*7/XR$l=<F<.95G28bew[||& /V8Vbpx@tOtvJR' );
define( 'AUTH_SALT',        '-~+LO;.n0h0<jc@<V+?*])d{vP}.@kj3:2XskY1f>fCMa-a5*A5p $o*|#{-;Jts' );
define( 'SECURE_AUTH_SALT', 'b)6=BbB_S4jqjTo6AiY`HeqFb.6rv,-4C!r?EVuG8_{sApMh$F)VkYo:4h4z1XV!' );
define( 'LOGGED_IN_SALT',   '0C. {@!Q>_)JuthgLvccGfgN;&%!X72U7lI4D<Y;Cuw$hC,V@T&zHA)XLh):+:c5' );
define( 'NONCE_SALT',       '`qjC(zwAUW65;E}ga%0_Ei;37/TQm_L(1JWHP!Oa`jsl}t,A LVs.Y%K6}x!ET_0' );

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
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
