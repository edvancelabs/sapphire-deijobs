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
define( 'DB_NAME', 'wp_blog' );

/** Database username */
define( 'DB_USER', 'webuser' );

/** Database password */
define( 'DB_PASSWORD', 'WebUser@1818' );

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
define( 'AUTH_KEY',         'pK^vLhv--^$EtAWk)6@nL/@h+iE57L)Q^MYUp-Xy|_HVFi|V #(cz_by8%/ie_6%' );
define( 'SECURE_AUTH_KEY',  '{(E[}q$M%[R- ZH,&zJmvb/U oOAt?b<(:u?4b`8$#cbGXF0geh7+.mTp<>%P9PX' );
define( 'LOGGED_IN_KEY',    'F6qUoJj*(!<pO0aQ?vRiO9>HnCI0)aEsSn.j3jl|0aI0OIx)gJPN8BR.tL__x<iy' );
define( 'NONCE_KEY',        '^G,zK6IIP~A.[0(2SgW+kFTyMsV3UvkL`W]K!e;t>1PFf@)wCm%jz%QG/r8~y-uQ' );
define( 'AUTH_SALT',        'ILz_:5WQ(9)nYH-qvJ9GY_w,Gsl_0~I~[s<[YM#29*(@Taw06I4(8ehXjr3mNS#g' );
define( 'SECURE_AUTH_SALT', 'Gs&?XN&^(GQ_2M!>KrfJfeUL|:!Ik,;Q}%Het5IjT10I@Vx@,![FaIJ[|sRIxgmc' );
define( 'LOGGED_IN_SALT',   'ulC3dC1`k*p7 J)b1:$|F;/0JPhem5U<mzI1DPi^;UOF8SOr!Hy&-!XdI)|fO-o3' );
define( 'NONCE_SALT',       '@j;HMeP4Lh0zScXE ?G8#89gc<:BrlP$Ny)<X j^0Nj4<P/?J s/*Hj?:O-y+&Qg' );

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
if (isset($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https')
    $_SERVER['HTTPS'] = 'on';

require_once ABSPATH . 'wp-settings.php';

