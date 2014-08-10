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
    define('DB_NAME', 'd01b5ebe');
    define('DB_USER', 'd01b5ebe');
    define('DB_PASSWORD', 'JMGoCNCJ8qbeR6KH');
    define('DB_HOST', 'alexanderprasser.at');
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
define('AUTH_KEY',         'AWJo!>hB6digP$#3:Xg9l[sMJ:dAOx1G y6Hdc4! [{f7uMAs9.+w@X[ujDcpmt;');
define('SECURE_AUTH_KEY',  'x2kb&$i/CV17KUf8zy!BF~1<p+^4#5}S+4!t}<Su#dB~:@U+qtVj[yU?6nJre&eC');
define('LOGGED_IN_KEY',    '=eqW^Le3Sv}uOsx80&OcjS)ADscFSf0x44M8]U8jT0~8TaO,t9jlI,d ?_CQX/Nd');
define('NONCE_KEY',        '#?fMf*~kL0n@k$Nc?Up<c,@lgg6)pangp,-a]p>dP* uv`p|(5I/v3]QT>V_>Bzj');
define('AUTH_SALT',        '|b|_LP) -p4z|^WX<:,XmgvS)sk[zW*+pSbM8Pknh|{_53A@UHvqjKm}YLx0X#K%');
define('SECURE_AUTH_SALT', '$qv25UiCCx.x$C>:I}5(tnBW)w+{6C$5)ouKy9;~K+|uaU>xin[ z8MNYgB.ntWF');
define('LOGGED_IN_SALT',   'Z32JU^?MQM_g_#tC*&Vgr-s+@xO!#SxVFD,X3kK,!2+Qi!>1j~&cVuC3E!0x}*${');
define('NONCE_SALT',       'aXcrP1p.$lHOJpBFHtHreV+ O1krIQD!GO  XbB 1D{Ob)0FF<hU9g=>-9r!;QC;');

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