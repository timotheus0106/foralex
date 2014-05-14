<?php

/**
 * Settings
 *
 * @version 0.1.0
 */
Class Settings {

	public $settings;

	/**
	 * [__construct description]
	 */
	public function __construct() {

		$baseUrl = get_template_directory_uri().'/assets/build/js/';

		// setting defaults (set in theme setup settings call, not within here)

		$this->settings = (object)array(

			'debug' => false, // mbi debug (pd, etc.)

			'comments' => false, // enable comments
			'widgets' => false, // enable widget
			'page_tags' => false, // enable tags for pages
			'banner' => true, // mbi banner
			'dynamic_images' => true, // dynamic image creation, should always be enabled to keep amount of images down

			// which menus to register
			'menus' => array(

				'main_menu' => 'Main Menu',
				'footer_menu' => 'Footer Menu'

			),
			'beautifysearch' => true,

			// to register as breakpoints within js
			// for now no overlapping queries are possible
			'breakpoints' => array(

				'small' => 'only screen and (max-width: 768px)', // for now this is mandatory

				'medium' => 'only screen and (min-width: 768px) and (max-width: 1200px)',
				'large' => 'only screen and (min-width: 1200px)'

			),

			// only for artdirected css
			'artdirected' => array(

				'fullscreen' => array(

					'landscape' => array(1440, 16, 9, null), // standard ohne eigene media query für fallback
					'portrait' => array(930, 3, 4, 'only screen and (min-width: 768px) and (orientation: portrait)'),
					'landscape_closeup' => array(640, 5, 3, 'only screen and (max-width: 768px) and (orientation: landscape)'), // only with _suffix
					'portrait_closeup' => array(384, 3, 5, 'only screen and (max-width: 768px) and (orientation: portrait)')

				)

			),

			// only for picture element breakpoints
			'image' => array(

				'grid' => array( // immer gefälligst standard + preview

					'preview' => array(100, 1, 1, null),
					'standard' => array(960, 1, 1, 'only screen and (min-width: 768px) and (max-width: 1200px)'),

					'small' => array(420, 1, 1, 'only screen and (max-width: 768px)'),
					'large' => array(1440, 1, 1, 'only screen and (min-width: 1200px)')

				)

			),

			// require js (gets populated by init())
			'requirejs' => array(),

			// rewrite rules
			'rewrite_rules' => array(

				array('admin/?$', 'wp-admin', 'top'),
		        array('login/?$', 'wp-login.php', 'top')

			)

		);

	}

	/**
	 * [init description]
	 * @param  [type] $_settings [description]
	 */
	public function init($_settings) {

		foreach($_settings as $key => $value) {

			switch($key) {

				case 'rewrite_rules':

					$defaults = $this->get_option($key);
					$combined = array_merge($defaults, $value);
					$this->set_option($key, $combined);

					break;
				case 'requirejs':

					// do not allow requirejs in init()

					break;
				default:

					$this->set_option($key, $value);

					break;

			}

		}

		$this->set_option('requirejs', Init::get_require_paths());

	}

	public function set_option($_key, $_value) {

		$this->settings->{$_key} = $_value;

	}

	public function get_option($_key) {

		return $this->settings->{$_key};

	}

}

$settings = new Settings();