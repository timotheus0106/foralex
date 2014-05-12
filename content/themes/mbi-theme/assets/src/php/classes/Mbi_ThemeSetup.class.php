<?php
class Mbi_ThemeSetup {
  function __construct() {

  	// disable admin bar on front-end
  	add_filter('show_admin_bar', '__return_false');

  	// add featured images to posts
		add_theme_support('post-thumbnails', array('post')); // Enable Thumbnails

		// register scripts
		$this->addScripts();
  }

  function addScripts(){
  	wp_deregister_script('jquery'); // Deregister WPs jQuery, because it is handled by requirejs

  	//head-js: scripts that need to be in head (e.g. modernizr, requirejs)
    wp_enqueue_script('head-js', get_template_directory_uri(). '/assets/build/js/head.js', '', '', false);

    //main-js: all the other scripts are packaged here
    wp_enqueue_script('main-js', get_template_directory_uri(). '/assets/build/js/main.js', '', '', true);
    wp_localize_script( 'main-js', 'baseUrl', array(
    	'path' => get_stylesheet_directory_uri() . '/assets/build/js'
    ));
  }


	/**
	* Redirects search results from /?s=query to /search/query/, converts %20 to +
	*
	* @link http://txfx.net/wordpress-plugins/nice-search/
	*/
	function beautifySearchResultUrl() {
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

	/**
	* Removes the width and height parameter of thumbnail images
	*/
	function removeDimensionsFromImages(){
		add_filter('post_thumbnail_html', array($this,'removeDimensionsFromImagesFunc'), 10);
		add_filter('image_send_to_editor', array($this,'removeDimensionsFromImagesFunc'), 10);


		// add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
// add_filter( 'image_send_to_editor', 'remove_width_attribute', 10 );
	}

	function removeDimensionsFromImagesFunc($html){
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}
}

$MbiThemeSetup = new Mbi_ThemeSetup(); ?>
