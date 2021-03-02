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

// ** MySQL settings ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'HR/KjcM+H11F4QfBw317S6KufDUKhV7j9Nt+yJKwQJWC8MXRyHvNP4H/6v3fbvoXfLA6M0juqjNKDnyuC3GuUQ==');
define('SECURE_AUTH_KEY',  'g+Qg6ysfOlQgqK9OBqCPHGWVuuljoDaroXeyiPuR4CzeOWyRMn0eikXMoBvGmNbw5K77mNvOJXRhsGpF4pn3zA==');
define('LOGGED_IN_KEY',    'BPQ3Nune6Apad1l4UaCwcVXbZ5oUr2ohPeeoo3Avi4i9Gn42nlu/V+MHu+afD47rxvoWJdOoJLoG4E55yT7Bcg==');
define('NONCE_KEY',        'S7Kavmv1Rvdba9V2/Z/fay54/vcmz5w87/l7AzTYbYs/VBDF+IMJzhCPc2E5XyV9hxOpT80qHNrv+e93532xjQ==');
define('AUTH_SALT',        'ZHjJo88zbc72LK7V8sKpMtw19QHf7JEPTZACp6i9hwN1qD7mTK9BPZjz3njSZgHU6KJFSDcpXjEMsK9NnZ0c6g==');
define('SECURE_AUTH_SALT', 'qZwRUGPGZmxBNlo99xLUyp3WzjZsIvbka0J/V9oK/vhX8w54c/U2/U7a0MEpt0rIldzWtM0g72GCdjwipDN4dg==');
define('LOGGED_IN_SALT',   'JNBLJcKS021Q2q3LOT8H7XxbM2czMCCMcw+0nLhnReZ+oQfhMB884+UC4FFWQvSfghaC4I1n/UzRsA24C4dq3w==');
define('NONCE_SALT',       'o57zP5vCNx5CdsIIkvDxklFB3BKddKAohTrHiZnqFU7txhJ3Qy80krlq8k1iQL6lsc3N6d+vl3KxyQkQx6zCBw==');

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';




/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) )
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
