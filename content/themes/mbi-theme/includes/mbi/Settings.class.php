<?php

/**
 * Settings
 *
 * @version 0.2.2
 */
Class Settings {

	public static function getInstance($args = null) {

		static $instance = null;

		if(null === $instance) {
			$instance = new static($args);
		}

		return $instance;

	}

	public static $settings;

	protected function __construct($args) {

		static::$settings = (object)array(

			'debug' => false, // mbi debug (pd, etc.)

			'comments' => false, // enable comments
			'widgets' => false, // enable widget
			'page_tags' => false, // enable tags for pages
			'banner' => true, // mbi banner
			'remove_image_attributes' => true,
			'beautify_search' => true,
			'dynamic_images' => true, // dynamic image creation, should always be enabled to keep amount of images down

			// which menus to register
			'menus' => array(

				'main_menu' => 'Main Menu',
				'footer_menu' => 'Footer Menu'

			),

			// to register as breakpoints within js
			// for now no overlapping queries are possible
			'breakpoints' => array(

				'small' => 'only screen and (max-width: 768px)', // for now this is mandatory

				'medium' => 'only screen and (min-width: 768px) and (max-width: 1200px)',
				'large' => 'only screen and (min-width: 1200px)'

			),

			// only for artdirected css
			'artdirected_images' => array(

				'fullscreen' => array(

					'landscape' => array(1440, 16, 9, null), // standard ohne eigene media query für fallback
					'portrait' => array(930, 3, 4, 'only screen and (min-width: 768px) and (orientation: portrait)'),
					'landscape_closeup' => array(640, 5, 3, 'only screen and (max-width: 768px) and (orientation: landscape)'), // only with _suffix
					'portrait_closeup' => array(384, 3, 5, 'only screen and (max-width: 768px) and (orientation: portrait)')

				)

			),

			// only for picture element breakpoints
			'single_images' => array(

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

			),

			// acf tiny mce
			'acf_tinymce' => array(

			// 	'ToolbarLayoutName' => array('bold', 'link', 'bullist')

			)

		);

		static::apply($args);

	}
	private function __clone() {}
	private function __wakeup() {}

	// ----------------------------------------

	/**
	 * [init description]
	 * @param  [type] $_settings [description]
	 */
	public function apply($args) {

		foreach($args as $key => $value) {

			switch($key) {

				case 'rewrite_rules':

					$defaults = static::get_option($key);
					$combined = array_merge($defaults, $value);
					static::set_option($key, $combined);

					break;
				case 'requirejs':

					// do not allow requirejs in init()

					break;
				default:

					static::set_option($key, $value);

					break;

			}

		}

		static::set_option('requirejs', Setup::get_require_paths());

	}

	public static function set_option($_key, $_value) {

		static::$settings->{$_key} = $_value;

	}

	public static function get_option($_key) {

		return static::$settings->{$_key};

	}

}