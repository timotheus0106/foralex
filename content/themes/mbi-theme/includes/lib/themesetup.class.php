<?php

Class ThemeSetup {

	public $settings;

	public function __construct(Settings $_settings) {

		// Dependency Injection of Settings
		$this->settings = $_settings;

		// init setup on init of wordpress theme
		add_action('after_setup_theme', array($this, 'init'));

	}

	// --------------------------------------------------

	public function init() {

		// Enable Thumbnails
		// add_theme_support('post-thumbnails');

		// Enable Menus
		add_theme_support('menus');

		// Cleanup Head
		add_action('init', array($this, 'cleanup_head'));

		// Register Assets
		add_action('wp_enqueue_scripts', array($this, 'assets'));

		// Hide Admin Bar by default
		add_filter('show_admin_bar', '__return_false');

		// Gallery Style (what?)
		add_filter('use_default_gallery_style', '__return_false');

		// Remove width/height from images
		add_filter('post_thumbnail_html', array($this, 'remove_thumbnail_dimensions'), 10);

		// Register Menus
		register_nav_menus($this->settings->get_option('menus'));

		// create images only on demand
		if($this->settings->get_option('dynamic_images') === true) {
			$this->images_on_demand();
		}

		// Remove Comments
		if($this->settings->get_option('comments') === false) {

			$this->remove_comments();

		}

		// Add Tags to Page
		if($this->settings->get_option('page_tags') === true) {

			add_action('init', array($this, 'tags_support_all'));
			add_action('pre_get_posts', array($this, 'tags_support_query'));

		}

		// remove widgets
		if($this->settings->get_option('widgets') === false) {

			add_action('widgets_init', array($this, 'cleanup_widgets'), 1);

		}

		// remove widgets
		if($this->settings->get_option('beautifysearch') === true) {

			add_action('init', array($this, 'beautify_search_redirect'), 1);

		}

		// @todo make this work!!!
		add_filter('intermediate_image_sizes_advanced', array($this, 'remove_image_sizes'));

	}

	// --------------------------------------------------

	public function assets() {

		// Deregister WPs jQuery
		wp_deregister_script('jquery'); // Deregister WPs jQuery, because it is handled by requirejs

		//head-js: scripts that need to be in head (e.g. modernizr, requirejs)
		wp_enqueue_script('head-js', get_template_directory_uri(). '/assets/build/js/head.js', '', '', false);

		//main-js: all the other scripts are packaged here
		wp_enqueue_script('main-js', get_template_directory_uri(). '/assets/build/js/main.js', '', '', true);
		wp_localize_script( 'main-js', 'baseUrl', array(
			'path' => get_stylesheet_directory_uri() . '/assets/build/js'
		));

	}

	// --------------------------------------------------

	public function cleanup_widgets() {

		unregister_widget('WP_Widget_Pages');
		unregister_widget('WP_Widget_Calendar');
		unregister_widget('WP_Widget_Archives');
		unregister_widget('WP_Widget_Links');
		unregister_widget('WP_Widget_Meta');
		unregister_widget('WP_Widget_Search');
		unregister_widget('WP_Widget_Text');
		unregister_widget('WP_Widget_Categories');
		unregister_widget('WP_Widget_Recent_Posts');
		unregister_widget('WP_Widget_Recent_Comments');
		unregister_widget('WP_Widget_RSS');
		unregister_widget('WP_Widget_Tag_Cloud');

	}

	// --------------------------------------------------

	public function cleanup_head() {

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

		// global $wp_widget_factory;
		// remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));

	}

	// --------------------------------------------------

	public function remove_comments() {

		// Removes from admin menu
		function my_remove_admin_menus() {
			remove_menu_page('edit-comments.php');
		}
		add_action('admin_menu', 'my_remove_admin_menus');

		// Removes from post and pages
		function remove_comment_support() {
			remove_post_type_support( 'post', 'comments' );
			remove_post_type_support( 'page', 'comments' );
		}
		add_action('init', 'remove_comment_support', 100);

		// Removes from admin bar
		add_action( 'wp_before_admin_bar_render', 'mytheme_admin_bar_render' );
		function mytheme_admin_bar_render() {
			global $wp_admin_bar;
			$wp_admin_bar->remove_menu('comments');
		}

	}

	// --------------------------------------------------

	public function beautify_search_redirect() {

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

	// --------------------------------------------------

	public function remove_image_sizes($sizes) {

		unset($sizes['thumbnail']);
		unset($sizes['medium']);
		unset($sizes['large']);

		return $sizes;
	}

	// --------------------------------------------------

	public function remove_thumbnail_dimensions($html) {

		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );

		return $html;

	}

	// --------------------------------------------------

	public function tags_support_all() {

		register_taxonomy_for_object_type('post_tag', 'page');

	}

	public function tags_support_query($wp_query) {

		if($wp_query->get('tag')) {
			$wp_query->set('post_type', 'any');
		}

	}

	// --------------------------------------------------

	public function images_on_demand() {

		add_filter('sanitize_file_name', array($this, 'sanitize_new_filename'), 10, 2);

		add_action('template_redirect', array($this, 'dynimg_404_handler'));

		// prevent WP from generating resized images on upload
		add_filter('intermediate_image_sizes_advanced', array($this, 'dynimg_image_sizes_advanced'));

		// trick WP into thinking images were generated anyway
		add_filter('wp_generate_attachment_metadata', array($this, 'dynimg_generate_metadata'));

	}

	public function sanitize_new_filename($filename, $filename_raw) {

	    // $file = sanitize_file_name($filename);
		// $new = iconv('UTF-8', 'ASCII//TRANSLIT', $filename);

		$new = str_ireplace(array('ä', 'ü', 'ö', 'ß'), array('ae', 'ue', 'oe', 'ss'), $filename);

	    return $new;

	}

	public function dynimg_404_handler() {

		if ( !is_404() ) return;

		if (preg_match('/(.*)-([0-9]+)x([0-9]+)(c)?\.(jpg|png|gif)/i',$_SERVER['REQUEST_URI'],$matches)) {
			$filename = $matches[1].'.'.$matches[5];
			$width = $matches[2];
			$height = $matches[3];
			$crop = !empty($matches[4]);

			$uploads_dir = wp_upload_dir();
			$temp = parse_url($uploads_dir['baseurl']);
			$upload_path = $temp['path'];
			$findfile = str_replace($upload_path, '', $filename);

			$basefile = $uploads_dir['basedir'].$findfile;

			$suffix = $width.'x'.$height;
			if ($crop) $suffix .='c';

			if ( file_exists($basefile) ) {
				// we have the file, so call the wp function to actually resize the image
				$resized = image_resize($basefile, $width, $height, $crop, $suffix);

				// find the mime type
				foreach ( get_allowed_mime_types( ) as $exts => $mime ) {
					if ( preg_match( '!^(' . $exts . ')$!i', $matches[5] ) ) {
						$type = $mime;
						break;
					}
				}

				// serve the image this one time (next time the webserver will do it for us)
				header( 'Content-Type: '.$type );
				header( 'Content-Length: ' . filesize($resized) );
				readfile($resized);
				exit;
			}
		}
	}

	public function dynimg_image_sizes_advanced($sizes) {
		global $dynimg_image_sizes;

		// save the sizes to a global, because the next function needs them to lie to WP about what sizes were generated
		$dynimg_image_sizes = $sizes;

		// force WP to not make sizes by telling it there's no sizes to make
		return array();
	}

	public function dynimg_generate_metadata($meta) {

		global $dynimg_image_sizes;

		foreach ($dynimg_image_sizes as $sizename => $size) {
			// figure out what size WP would make this:
			$newsize = image_resize_dimensions($meta['width'], $meta['height'], $size['width'], $size['height'], $size['crop']);

			if ($newsize) {
				$info = pathinfo($meta['file']);
				$ext = $info['extension'];
				$name = wp_basename($meta['file'], ".$ext");

				$suffix = "{$newsize[4]}x{$newsize[5]}";
				if ($size['crop']) $suffix .='c';

				// build the fake meta entry for the size in question
				$resized = array(
					'file' => "{$name}-{$suffix}.{$ext}",
					'width' => $newsize[4],
					'height' => $newsize[5],
				);

				$meta['sizes'][$sizename] = $resized;
			}
		}

		return $meta;
	}


	// --------------------------------------------------

}

$theme_setup = new ThemeSetup($settings);