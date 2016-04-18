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
define('DB_NAME', 'wp');

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
define('AUTH_KEY',         'gIcagdN-bCj9.wf_EP7.d.+X#n$}NxPobm31IahkyED#WBm`Si)%PF98/ty<^C&j');
define('SECURE_AUTH_KEY',  'c8?s*ZhCscwrvt^/lWe6)-=Gu6d(k#a+fSJL$Sz{f`;n0[@@P6 1/RFl*;8`nX-A');
define('LOGGED_IN_KEY',    'W0*7[:^?KogH7aQt!NS1Hy0QaujnDhQTWWN(B [:?Q.eaq-sK-(Mufk1YBVWW(hJ');
define('NONCE_KEY',        'UuXM-o/VL!F2x(*iJXU)hx).:@d-gKRtd?*2/sO&`L)`@Q){Gfj6|^Iz=wKbJ+!6');
define('AUTH_SALT',        'FWZ&}(X-x0+&}f8!BY)gmEV/j>KLPONI<[PKR}iiYV_(NCVIo.0i^IW2K 6u1zfm');
define('SECURE_AUTH_SALT', '&Q9t#dNZ6d>!$Leab9}>~8~[e57So@`l%yro9v.4A,7+XZ`sV]:lp!7cPlkr<m$F');
define('LOGGED_IN_SALT',   'h:g.?^Yf5He;e6C8Qf3~,$voK*revH8Q?4v2C(iV)X3l!l=2:(sCGL3$<.Qmy+]#');
define('NONCE_SALT',       'x4a7CTqWB`%i+blBRwC9lS4FL>r;-T|aQu*)W+Alhc<t ..X2h8SbH)+DnTFuz;8');

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
