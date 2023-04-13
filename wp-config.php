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
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress7' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
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
define( 'AUTH_KEY',         'zbN&CAk1.EnQ;z8b]7io/!Fu>cD[,_&zt!D.3wKcVoh,9+HUx@zf^Wy*KaL4]3+K' );
define( 'SECURE_AUTH_KEY',  'DNTn?33edHD`v{?vTmOB/(<.~DsEgQ%]zHRgwqI>,C1Z=|8o6A+Dpl&qNl:ZdSU1' );
define( 'LOGGED_IN_KEY',    '4C[C|`0>q{y@8fw|/yJ$x|LA&BT|/m1/Z$*uI^VsD*}xR+@~_10W@bez+/f2Ky*p' );
define( 'NONCE_KEY',        'k5Vq@(95)r?v=Rdw@@6y59H=WAAvS<}*DoKm7z|u<k~,|;m)D6[mwh^<3UjLrS:x' );
define( 'AUTH_SALT',        '{?H0$/z:njTN;A?33sb$IGN=1Y)Fti#`p*XSvq$Ezh6:}J_E1{=$PTzB;CyYtO,!' );
define( 'SECURE_AUTH_SALT', 'wZ]EC<T[Tv1tSBzrf|)T0mq:DB|+7@/TPKk4ab87?^2?La&B`WQT8Z8xV?tF7@.-' );
define( 'LOGGED_IN_SALT',   'i?_ )g}lHJA2|ije7 YKW^Pf`>kx,X0kQLf`r!},9m47t23yKg;bzK>r ^8=h+;`' );
define( 'NONCE_SALT',       'cAed&eg:N<&r- r~+l>b`,|(0+/7t aPuh` z`Qqd/HPZ@h*Pk.2D{%)}YYpcZ3`' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
