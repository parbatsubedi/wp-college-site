<?php

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'college_fresh');
define('DB_USER', 'collegeuser');
define('DB_PASSWORD', 'collegepass123');

/** Database hostname */
define('DB_HOST', 'localhost');

/** Database charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

/** The database collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

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
define('AUTH_KEY', '?v5pb/jHw1N9@B^YaCtIwbJ: 0n+%|d{2eI8=BXp^9fzoK&Yh5U/18SwK4<?j+o/');
define('SECURE_AUTH_KEY', 't<0}6-8Q#*O%]aSjKk)>T;D2+1#?o4#BzK+=,-@nhJ/wCXUzD[foeNJs z92V|eu');
define('LOGGED_IN_KEY', '_|zzk9Sr[#CbLmJGtE*l|1?#SAN-o%cW?2>n7b!<V_#jK~haJR3:2L(U5yC&(Hds');
define('NONCE_KEY', 'N99sdG06lpo?BMPLTxKUPzYeYiUL-$23<f*+-H6[a147]N)Nh_cZ>=<|J]>:nK5?');
define('AUTH_SALT', 'H+UJovD $~hdK`c|fQga~ecQkp0M$RIbYV_.9 Wt,{@o1`,ES<Jw+6)x+itYp=@M');
define('SECURE_AUTH_SALT', 'RsDC*v1_nQwAvkK*YW!7Ggr:F=P7Ck7Nrru##@[34+AjV.A-#ty:@p}bly0Q0i{9');
define('LOGGED_IN_SALT', '%YRc$o{`010`-_-LoqKYly?]?(+o*M3@{9gD,-58*1VY]}7q#[5O>:|2o*}3J|*k');
define('NONCE_SALT', '~lUxhze5S-FU?[E4F;M*R||9ljGlfI;_+,MMa/_M[:XNp>Rt3rt$?xwpWNckug&6');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
 */
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', true);

/* Add any custom values between this line and the "stop editing" line. */
define('FS_METHOD', 'direct');

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if (! defined('ABSPATH')) {
    define('ABSPATH', __DIR__.'/');
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH.'wp-settings.php';
