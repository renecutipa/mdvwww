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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'mdv001' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '1234' );

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
define( 'AUTH_KEY',         'w1g)g&iYoeS],Z?}f3jDd;J.Coq;kLFel39lL&e#<jb*<3YHv$yN)|PWag}fhnwQ' );
define( 'SECURE_AUTH_KEY',  '|v<W|S8f{V8`>#lxva5{v$uGz1$|r$SlNqQWZu/kG7{V EnUQ7/={h`7>}Emm-_$' );
define( 'LOGGED_IN_KEY',    '^X?BTB_]h*?Vtj`ig=|v)L`xI5(y;JdQcE:wAgV~%lFqFbmdUF[W_2KYa0?*@tJ0' );
define( 'NONCE_KEY',        ' r:ncqd~(iYh^7&<[3n#jr~<q9`@_10Pq.Q|#or8X=yIXuE)`Y)-8:@`>Lh3@cl%' );
define( 'AUTH_SALT',        'Gs,.M#(hb|lwX9$:=CZUN/`qPzi`.p951}q!.36pe~!j ?pjFSw?A+Le.KOm%SQK' );
define( 'SECURE_AUTH_SALT', '+&jD`l,Ty>be@#)35m$V IN0ARoSVTx-}L(x}jX4WoYHxw[VVfmtKQ6q.,aA|4F(' );
define( 'LOGGED_IN_SALT',   '_BZnc9Z7kR6vx8{j{guFD!_VdSFl-x>`,:zwu#L^TrS{=42.JMKuJ,,(yCHx8/H~' );
define( 'NONCE_SALT',       'v4E:*|2 HIyi,_55Ba.d|::5#QVuQ,6*7#D}ak9g6rDJn:#Ro5Hnbp%cK|<Yw^6g' );

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'mdv_';

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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
