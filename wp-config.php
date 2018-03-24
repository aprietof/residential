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
define('DB_NAME', 'prietowe_wrdp1');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

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
define('AUTH_KEY',         'ms8{dW#|Dh2pKTiTH<NBU)(M;&fWOT}giGHb~9*YE>x^pCA4$O1E,p+w1M5Vl2g]');
define('SECURE_AUTH_KEY',  'b]:>E;h)o-^qh!bhXg%JONa)qTV@n|YR+7C)E9=9cS>3C-w&]6SgPe]8Hl$=x_)H');
define('LOGGED_IN_KEY',    '_?}m0W*u`za{9-*spr8Gs/<cW;a!-1wC9weM;eSoFLnXIY}5cmRdM1:7eOa6o9{:');
define('NONCE_KEY',        'kJu;&;{94:UgL:~0)12P?Ko^WB0Q,IA S={UYx/+L=Jr;x%+@=r E#nh/A|5#Y[`');
define('AUTH_SALT',        '.M! 8]&q9;?{y.n%oreGsBg92#ibPV@x+KA{5sp0sGv!bn)Oo:3*dLKOva Ru[+D');
define('SECURE_AUTH_SALT', 'Q;HMH65l(ne p<!6C .s: rI@m@_]O`m/M?2@#NovIqI=mqzicP0Yks+D//i 7Pg');
define('LOGGED_IN_SALT',   '[( G>xHS2{pe;}hTBuDr/Hn#T]:$2]Lp]*|YIdIjR1s.vN0o$o}?sqFp5)hSB@4W');
define('NONCE_SALT',       '}V/X=TUlK(Z=W~krM@@fd1,i=Jt|Ma4/Z(m#!=]@>D(AL#G{}hJo4:z>c~`f.j,}');

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


