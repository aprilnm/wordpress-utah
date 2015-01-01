<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link http://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress-utah');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY',         'b, ka$$AZ?a|$&-jG|u_FhjO+E;c^,8O4H?|Bjk&.;@r-8eD/gni!%++lI:Ye,XG');
define('SECURE_AUTH_KEY',  'H4NBD0>}LP-tnqN<Ax &Es/u}w![NvP|WM*z~pA#L6|Vc5~s`SF<lx6aEzzKcfAe');
define('LOGGED_IN_KEY',    '*O9-T!!%@amq)[+](r)|9sa=$W|V1CUvHOB>qDJWc*c:t*BEx0_A4<>Z|q?1JwPP');
define('NONCE_KEY',        'RDkc-9^JjD^P|b#em8rn*vPrH{BD->XA&:D-Q=tGJVDm;?ULSZQrR{:Fxt75/-Y:');
define('AUTH_SALT',        '_FwC*{5ZI.W+6m/M1U B5I~ojdW6!Y|+`Kb3Fj~E7pr|WVD(^%`s&L9yy[NsZ.<!');
define('SECURE_AUTH_SALT', 'WU~x#Zn}D4zyu }7DhmOe9.y_NF96rdjN&We(2%,{xUCRIuff!X^BbL-$uOMfgG ');
define('LOGGED_IN_SALT',   '6|@.3 7NV-m@,m_ll43UT*p<=*e/+`(eEN](oKfC4tl)@C)bvQ-.U=glol^(CE[?');
define('NONCE_SALT',       'Sww+A Hmk_j.TvBC*4+.zGOZTn*+:wIudhhO0BnZ>^dVk +18UEW?:/:AQ(R}|_d');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
