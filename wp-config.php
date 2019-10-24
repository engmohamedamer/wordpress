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
define( 'DB_NAME', 'governance' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

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
define( 'AUTH_KEY',         'lD+khv:w_Z;O=Il^4SRy>TFInG?))-z{cspvOF <_u-Va3{zTYdz,p$p`X.rr$jb' );
define( 'SECURE_AUTH_KEY',  'L_Dp=IbvNxC;J&igq%!3v|Z7u[l.gx!52gfLO+k44o6f@T1PHv$^g@TP, ThG*{&' );
define( 'LOGGED_IN_KEY',    'I ?:/mzk)!luWEzi3GmPLH83oa1Oj(g@HjAF%@Qvki%fB*Skm`V?<F&w*4HV$eag' );
define( 'NONCE_KEY',        '2RFy>w_^T_:&qB~Y+GYF$}=ume6d37jJJhWNv>Qvc$IC&qR]^m=*U.vbE;U24jN0' );
define( 'AUTH_SALT',        '<mf  ^GD|LU(_aUdHR&@Xph<@-a2uch.lzaF<UAp{pH`./gs6W.$m% 3-K#Cp3}+' );
define( 'SECURE_AUTH_SALT', 'V+m[jNCX8!b,=HN^RRd1yS0:Jv>]n6X]>5e@x>Z>,}pPfjBgZ4kIw,yklD)|b*M9' );
define( 'LOGGED_IN_SALT',   'Q61RYn[EFgNl02M/5d75-d5u%V,Axk%}w`~tCw!p]R>XEkl~SH`k UL{6Qa*XEwl' );
define( 'NONCE_SALT',       '3K]E%X~zGs?Jzb60`6`tp+Aq1KAz^Sx5-#l^[.|W)_5]yulyBP<)HNn&#C5vDm>^' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
