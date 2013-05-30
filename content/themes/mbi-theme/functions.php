<?php
/**
 * Moodley Brand Identity
 * http://www.moodley.at
 *
 * @package WordPress
 * @subpackage moodley brand identity
*/

/** ====== Moodley Setup ===== **/
add_action('after_setup_theme', 'moodley_setup');

if (!function_exists('moodley_setup')):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since moodley brand identity HTML5 2.0
 */
function moodley_setup() {
    add_theme_support('post-thumbnails'); // Enable Thumbnails
    add_theme_support('menus'); // Enable Menus

    add_action('init', 'mbi_cleanup_head');
    add_action('wp_enqueue_scripts', 'mbi_scripts');
    add_action('template_redirect', 'mbi_beautify_search_redirect');

    add_filter('show_admin_bar', '__return_false');

    add_filter('post_thumbnail_html', 'mbi_remove_thumbnail_dimensions', 10); // Get some fluid images
    add_filter( 'use_default_gallery_style', '__return_false' );

    add_image_size( 'sc-small', 222, 154);
    add_image_size( 'sc-medium', 326, 222);
    add_image_size( 'sc-large', 462, 326);

    register_nav_menus( array( // Register mbi Menus
        'header_nav' => 'Header Menu',
        'footer_nav' => 'Footer Menu'
    ));

/** Optional Settings: **/

    /** Editor Styles **/
    //add_editor_style( 'css/editor-style.css' );
    // Post Format support. You can also use the legacy "gallery" or "asides" (note the plural) categories.
    //add_theme_support( 'post-formats', array( 'aside', 'gallery' ) );

    // Add default posts and comments RSS feed links to head
    //add_theme_support( 'automatic-feed-links' );

    // Make theme available for translation
    // Translations can be filed in the /languages/ directory
    // load_theme_textdomain( 'moodley', TEMPLATEPATH . '/languages' );

    //  $locale = get_locale();
    //  $locale_file = TEMPLATEPATH . "/languages/$locale.php";
    //  if ( is_readable( $locale_file ) )
    //      require_once( $locale_file );
}
endif;

/** Clean up the Header**/
if ( ! function_exists( 'mbi_cleanup_head' ) ) :
    function mbi_cleanup_head(){
        remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
        remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
        remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
        remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
        remove_action('wp_head', 'index_rel_link'); // Index link
        remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
        remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
        remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current
        remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
        remove_action('wp_head', 'start_post_rel_link', 10, 0);
        remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
        remove_action('wp_head', 'rel_canonical');
        remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

        global $wp_widget_factory;
        remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
    }
endif;

if (!function_exists('mbi_scripts')) :
    function mbi_scripts(){
        wp_deregister_script('jquery'); // Deregister WPs jQuery
        wp_enqueue_script('modenizr-js', get_template_directory_uri(). '/js/libs/modernizr.min.js', '', '', false);
        wp_enqueue_script( 'main-js', get_template_directory_uri() . '/js/loadr.js', '', '', true);
    }
endif;

if (!function_exists('mbi_beautify_search_redirect')) :

/**
 * Redirects search results from /?s=query to /search/query/, converts %20 to +
 *
 * @link http://txfx.net/wordpress-plugins/nice-search/
 */
function mbi_beautify_search_redirect() {
    global $wp_rewrite;
    if (!isset($wp_rewrite) || !is_object($wp_rewrite) || !$wp_rewrite->using_permalinks()) {
      return;
    }
    $search_base = $wp_rewrite->search_base;
    if (is_search() && !is_admin() && strpos($_SERVER['REQUEST_URI'], "/{$search_base}/") === false) {
      wp_redirect(home_url("/{$search_base}/" . urlencode(get_query_var('s'))));
      exit();
    }
}
endif;

/** Default Menu Style **/
if (!function_exists('moodley_menu')):
/**
 * Set our wp_nav_menu() fallback, moodley_menu().
 *
 * @since moodley brand identity HTML5 2.0
 */
function moodley_menu() {
    echo '<nav><ul>';
        wp_list_pages('title_li=');
    echo '</ul></nav>';
}
endif;

/**
* Remove image dimension for the thumbnail
*/
if (!function_exists('mbi_remove_thumbnail_dimensions')):
function mbi_remove_thumbnail_dimensions($html){
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}
endif;

/** Muevo Lib **/
//@todo: Deactivation Error
// if (!plugin_is_active('muevo-lib/muevo-lib-custom-pack.php')) { //activate plugin
//     run_activate_plugin('muevo-lib/muevo-lib-custom-pack.php');
// }

// if (plugin_is_active('muevo-lib/muevo-lib-custom-pack.php')) {
//     $info['Information'] = array('text', 'client_info', 'Information');
//     // $info['Telefon'] = array('string', 'client_tel', 'Telefon' );
//     // $info['Email'] = array('string', 'client_email', 'Email' );
//     $x = new muevoSettingsPage(get_bloginfo('name') , array('Info-Box' => $info));
// }

// /* MUEVO LIB FIX!!! - Dont know if still needed!
// * @todo: check it out!
// */
// function muevo_theme_settings_option_page_capability( $capability ) {
//     return 'moderate_comments';
// }
// add_filter( 'option_page_capability_muevo_theme_settings', 'muevo_theme_settings_option_page_capability' );

// /** End Basic Setup **/

// /** Helper functions **/
// function plugin_is_active($plugin_path) {
//     $return_var = in_array( $plugin_path, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );
//     return $return_var;
// }
// function run_activate_plugin( $plugin ) {
//     $current = get_option( 'active_plugins' );
//     $plugin = plugin_basename( trim( $plugin ) );
//     if ( !in_array( $plugin, $current ) ) {
//         $current[] = $plugin;
//         sort( $current );
//         do_action( 'activate_plugin', trim( $plugin ) );
//         update_option( 'active_plugins', $current );
//         do_action( 'activate_' . trim( $plugin ) );
//         do_action( 'activated_plugin', trim( $plugin) );
//     }
//     return null;
// }