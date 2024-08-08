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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'onrial_eu' );

/** Database username */
define( 'DB_USER', 'onrial_eu' );

/** Database password */
define( 'DB_PASSWORD', 'u23z^2MK@t' );

/** Database hostname */
define( 'DB_HOST', 'onrial.mysql.tools' );

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
define( 'AUTH_KEY',         'eJvRf:w7z/L2C.L4)!nLOsCpt|F.+W7 uVTIq:m<0d>ohxA@Hx*H)#`&<g(lgzdI' );
define( 'SECURE_AUTH_KEY',  'C;kfB(}(A[(~!GYXzf/QE=MIv,uu&ZWG-WF~~^n!`!JG=nME3W3 s{e[LQFFrYHT' );
define( 'LOGGED_IN_KEY',    'HS$z#?[G3=bWB6G]et`-nG#.W{g](^fJNM7#THq#4Dw(+!:.t$DeD^!eCq%=Cj[`' );
define( 'NONCE_KEY',        '[Cq #MEL68~:352B[7=ufAB +@*;sX9P0}Az9c>ni^&,#B,gVld%bwfjHH<4ltmB' );
define( 'AUTH_SALT',        'v+4GZ59fP;1K!N3Ghg>O*[y#.=wl1~[Efz;)Y(dX[,#r|PWbRo/t1)}0X24~-tt[' );
define( 'SECURE_AUTH_SALT', ')pC(_DwNl~V!^9ga95lc#U=|1ZaC1mMF8O!E4Zi?X>J,R=Nwa[qz|t&V.i2:X|:T' );
define( 'LOGGED_IN_SALT',   '>i@Rv{LRK(e|!Eq$q1CP$RZmf(?>Dw%I26ibTAs&]QTE1Rq+S&<5m`d]j!aqi1/s' );
define( 'NONCE_SALT',       'F0`D%0(Epvj[IdF+<Lg|nl-/U^JPM]gm+o:S*&owyk 9b,!<ynr>B#!Wft`K)-.`' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'onrial_';

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */

// SSL
define( 'FORCE_SSL_ADMIN', true );

// theme
define( 'WP_DEFAULT_THEME', 'onrial' );

// general changes
define('WP_POST_REVISIONS', 0);
define('AUTOSAVE_INTERVAL', 3600);
define('EMPTY_TRASH_DAYS', 3600);

// disabling updates
define('AUTOMATIC_UPDATER_DISABLED', true);
define('DISALLOW_FILE_EDIT', true);
//define('DISALLOW_FILE_MODS', true);

// allow svg
define('ALLOW_UNFILTERED_UPLOADS', true);

// FTP
//define('FS_METHOD', 'direct');
define( 'FTP_USER', 'onrial_eu_ftp');
define( 'FTP_PASS', '68s1CZnZFCB0');
define( 'FTP_HOST', 'onrial.ftp.tools');
define( 'FTP_SSL', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
