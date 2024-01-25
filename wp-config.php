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
define( 'DB_NAME', 'help_ukraine' );

/** Database username */
define( 'DB_USER', 'help_ukraine' );

/** Database password */
define( 'DB_PASSWORD', 'pgj4rhKASTdDxbqq' );

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
define( 'AUTH_KEY',         '|pyi>UEH=,vEVjXZruQu0u,fC~QG/7FU8Z4!9NJ9p=:e]`hIHlqux.N].CJE[lP.' );
define( 'SECURE_AUTH_KEY',  'V)D]H0a?0RaVZ$T:Ts*7G6~/& )kaoH_Wso(eN$ML=Rh.&<ntwn[](WjG6rKj9jo' );
define( 'LOGGED_IN_KEY',    'kX{rhji7>Kx:[obn<gCdNoPoZnj8Kw<IB Ll;N.?p.]KTQ@20H_+Y&`+YFxOI%P^' );
define( 'NONCE_KEY',        'N=D|1eP,C]:-g9>WUq%{P3*yRfGAQ@j?ck0L[Tf)GR$JAW,N9t}RmOTb5N_AKZ~,' );
define( 'AUTH_SALT',        '$F@0d_C(MdPa4|B=wW3CXSxU4T-?_O!??/wTKFYYMZzg2gj]L8[Fo0HS F]-:.f5' );
define( 'SECURE_AUTH_SALT', '@qJ?x4F*pGrnz^%R=k?]Zv=X!4q]x@fsq6yRuor4ULeBl;W{q1q!i7G5XJP4+n3S' );
define( 'LOGGED_IN_SALT',   'l{B]6rGxb!]h~i<EDJfdt+eP:N<wOq b;pX);LZs;~*uz[ _#q)uJID}zl`tU<DT' );
define( 'NONCE_SALT',       'N2<hqkOwzF k1`x1DZqYfESg|80+cS5cq*e,uPPo,v$|[9eAra3-m(wI$QlFZlSN' );

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
define( 'WP_DEBUG', true );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
