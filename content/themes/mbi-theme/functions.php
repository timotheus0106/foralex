<?php
/**
 * Moodley Brand Identity
 * http://www.moodley.at
 *
 * @package moodley
 * @subpackage moodley-web
 * @since mbi-theme 1.0
*/

/** ====== Moodley Setup ===== **/

// ----------------------------------------------------------------------------------
// Constants
// ----------------------------------------------------------------------------------
// e.g.:
// define('WP_PAGE_ID_OUR_WORK', 7);
// define('WP_PAGE_ID_PEOPLE', 9);



// ----------------------------------------------------------------------------------
// Theme Setup/Settings (base)
// ----------------------------------------------------------------------------------
// require_once('includes/lib/Settings.class.php');
// require_once('includes/lib/ThemeSetup.class.php');



// ----------------------------------------------------------------------------------
// Theme Setup/Settings (optional)
// TODO: autoloader for the win!
// ----------------------------------------------------------------------------------
//require_once('includes/lib/Images.class.php');
require_once('includes/lib/Javascript.class.php');
// require_once('includes/lib/Picture.class.php');
// require_once('includes/lib/BackgroundImage.class.php');
//require_once('includes/lib/Helper.class.php');
//require_once('includes/lib/Data.class.php');
// require_once('includes/lib/Loader.class.php');



// ----------------------------------------------------------------------------------
// Theme Setup/Settings (custom)
// - load project specific classes here
// ----------------------------------------------------------------------------------



// ----------------------------------------------------------------------------------
// Theme-Settings
// ----------------------------------------------------------------------------------
$settings = Settings::getInstance();
$settings->apply(array( // see settings for defaults
  'debug' => true,
  'menus' => array(
      'primary_nav' => 'Primary Menu',
      'secondary_nav' => 'Secondary Menu'
  ),
  'comments' => false,
  'beautifysearch' => true,
  'breakpoints' => array(
    'mobile' => 'only screen and (max-width: 871px)', // for now this is mandatory
    'palm' => 'only screen and (min-width: 872px) and (max-width: 1079px)',
    'lap' => 'only screen and (min-width: 1080px) and (max-width: 1287px)',
    'desk' => 'only screen and (min-width: 1288px) and (max-width: 1495px)',
    'deskWide' => 'only screen and (min-width: 1496px) and (max-width: 1703px)',
    'deskGiga' => 'only screen and (min-width: 1704px) and (max-width: 1911px)',
    'cinema' => 'only screen and (min-width: 1912px)'
  ),
  'artdirectedImages' => array(

    // 'fullscreen' => array(

    //  'landscape' => array(1440, 16, 9, null), // standard ohne eigene media query für fallback
    //  'portrait' => array(930, 3, 4, 'only screen and (min-width: 768px) and (orientation: portrait)'),
    //  'landscape_closeup' => array(640, 5, 3, 'only screen and (max-width: 768px) and (orientation: landscape)'), // only with _suffix
    //  'portrait_closeup' => array(384, 3, 5, 'only screen and (max-width: 768px) and (orientation: portrait)')

    // )
  ),
  'singleImages' => array(
    'grid' => array( // preview, standard are required
      'preview' => array(320, 1, 0, null),
      'mobile' => array(376, 1, 0, 'only screen and (max-width: 480px)'), // mobile
      'small' => array(584, 1, 0, 'only screen and (min-width: 481px) and (max-width: 871px)'), // mobile
      'standard' => array(1000, 1, 0, 'only screen and (min-width: 872px) and (max-width: 1287px)'), // palm, lap
      'large' => array(1624, 1, 0, 'only screen and (min-width: 1288px)') // desk, desk-wide, desk-giga, cinema
    )
  )
));

$theme_setup = new ThemeSetup($settings);


// ----------------------------------------------------------------------------------
// project specific theme setup
// ----------------------------------------------------------------------------------
if (!function_exists('init_mbi_theme')){
  function init_mbi_theme(){

    //init shortcodes here
    //$shortcodes = new Shortcodes();
    //...
  }
}
add_action('after_setup_theme', 'init_mbi_theme');
