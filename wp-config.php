<?php /** Configuration File **/
/* Provide a wp-local-config.php file for local development.
 * do not upload this file to production environment
 */
if(file_exists(dirname(__FILE__) . '/wp-local-config.php' )){ // load local configuration
    /** if your WP installation is in htdocs root folder change /wp/ to / **/
    define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/' . basename(__DIR__) . '/wp');
    define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME'] . '/' . basename(__DIR__));
    define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/' . basename(__DIR__).  '/content');
    define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/' . basename(__DIR__) . '/content');
    include(dirname(__FILE__). '/wp-local-config.php');
    define('WP_LOCAL_DEV', true);
    define('WP_DEBUG', true);
    define( 'FS_METHOD', 'direct' ); //local updates
    define( 'FS_CHMOD_DIR', 0777 );
    define( 'FS_CHMOD_FILE', 0777 );

}else{ // load production configuration
    define('WP_SITEURL', 'http://' . $_SERVER['SERVER_NAME'] . '/wp');
    define('WP_HOME',    'http://' . $_SERVER['SERVER_NAME']);
    define('WP_CONTENT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/content');
    define('WP_CONTENT_URL', 'http://' . $_SERVER['SERVER_NAME'] . '/content');

    define('WP_LOCAL_DEV', false);
    define('DB_NAME', 'database_name_here');
    define('DB_USER', 'username_here');
    define('DB_PASSWORD', 'password_here');
    define('DB_HOST', 'localhost');
    define('WP_DEBUG', false);
}
define( 'DB_CHARSET', 'utf8' );
define( 'DB_COLLATE', '' );

/* set default theme */
define('WP_DEFAULT_THEME', 'mbi-theme');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
define('LOGGED_IN_KEY',    'put your unique phrase here');
define('NONCE_KEY',        'put your unique phrase here');
define('AUTH_SALT',        'put your unique phrase here');
define('SECURE_AUTH_SALT', 'put your unique phrase here');
define('LOGGED_IN_SALT',   'put your unique phrase here');
define('NONCE_SALT',       'put your unique phrase here');

// define('WPMU_PLUGIN_DIR', $_SERVER['DOCUMENT_ROOT'] . '/' . basename(__DIR__) .  '/content/mu-plugins');
// define('WPMU_PLUGIN_URL', $_SERVER['DOCUMENT_ROOT'] . '/' . basename(__DIR__) .  '/content/mu-plugins');



/**#@-*/
/** database table prefix **/
$table_prefix  = 'mbi_';

/** wordpress language - default english **/
define('WPLANG', 'de_AT');

/**increase memory limit**/
define( 'WP_MEMORY_LIMIT', '128M' );

/** turn of post revisions and auto-save **/
define( 'WP_POST_REVISIONS', false );


/* That's all, stop editing! Happy blogging. */
/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
    define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');