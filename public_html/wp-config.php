<?php
define( 'WP_CACHE', true );



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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u135727435_RejfK' );

/** Database username */
define( 'DB_USER', 'u135727435_HUuRK' );

/** Database password */
define( 'DB_PASSWORD', 'b3AMLNXu2p' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          ',0kcOLcq8>OR*;N|TDOd1f[(18;GN4/Ha-v9&0XX[G&PacyiX{_CP!(57}Ade}8q' );
define( 'SECURE_AUTH_KEY',   'oB]#wMQ 1kcWeT5:XIRwFXzzFKe9XCYqx%?!B2@0$nPhj%]LDqDE0: HUmG 04Vh' );
define( 'LOGGED_IN_KEY',     'y}Z%Htp7+w,Id3Ra0c0/Dj|0F9m-ioB-.sc911$l>gFp,D}bRi#Nz*!4A[%gQ*wi' );
define( 'NONCE_KEY',         'TvVlmMp:G.KZ7/BJK. Cp=VxTGnbv>:lHKbv:P@K<,} ^O1rQQkYne+>l~}KmY]T' );
define( 'AUTH_SALT',         'ieZjVyM^#D}A^R)^ObLl9MtRnOy15+{Q!a(|%T8tz/wx;,/xMPt6kwC:T06Dgc9i' );
define( 'SECURE_AUTH_SALT',  'AcLX=r-On2]109HSBsg0?s5*dpi|^2-5t?G*2AnzS8>o,*ToeMe+kEI3U7n#Z=Q:' );
define( 'LOGGED_IN_SALT',    'FT9,qHZnb0EcHth}3,tZFh]}UX(QcPW1S+Z#dao:X2&Cv!KCaa<E@lQ%]e $?=%Z' );
define( 'NONCE_SALT',        '!{3V(rLh.lG:l|=>^zRt&$Qb`s6*xS|u1T-4zsu5MQUA7bG[]22c)~3PO+-,z|DU' );
define( 'WP_CACHE_KEY_SALT', 'pvI5LPvmY.#Xd=Z$Q4lwcgQSJww7f5.Um{+xtndP;iINAUvlK(:}U~O<_>v~1K1}' );


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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );


/* Add any custom values between this line and the "stop editing" line. */



define( 'FS_METHOD', 'direct' );
define( 'WP_AUTO_UPDATE_CORE', 'minor' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
