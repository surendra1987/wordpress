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
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'dxygQ])=CE3_*l ;kp2l$yjAC?;JuIk]s6bnH{IS&OJ/Ohu8>rLd]y_y*0oQ:!sa' );
define( 'SECURE_AUTH_KEY',  'SPJR*$(w0VRrL&+.57s!4#r<Gh^Xq8;Iz>Sy.%bBG#<2e~ 8M^ P#Up,xfGj2E 2' );
define( 'LOGGED_IN_KEY',    'ROa:{D}RP.NGRJ{:fR;7px-n%)_EOKxK~Y!&`;%PxqKQeGIQ/`@LBC>Eebdk%Dk.' );
define( 'NONCE_KEY',        '9^(Btsl^KBC#,v~F[&OYIpzO//kC9drtJLaKbI,Vtru?sXq7Xe2CQ3uTAc)}|#=Q' );
define( 'AUTH_SALT',        '*<:QSRIhxn-oEZK7`ejW,L}3anjcEL90fi&CC5[9E^)9IS(D<,|dHaJE=o:5Nbw7' );
define( 'SECURE_AUTH_SALT', 'nKOF#fp*[g>9E^tG`8z5Iz?~=fZ@ek O>FwUuA7UKDQeB,Zw1w#&0A62CPQ+Am8H' );
define( 'LOGGED_IN_SALT',   'x^Z_C%Q@byOwmF,0>@[|a_t>TRe# 9jA,i441^0XC?HHkbWf~BIb%&ISl]vdX WP' );
define( 'NONCE_SALT',       'TnSjwsQCB$]~GmHG`Ev!Bt$d5IJ.QpGIP0`RE. ai;`Y>0@y:XoH}jlzRxF#.:@]' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mvc_';

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
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
