<?php

/**
 * Settings
 *
 * @version 0.1.0
 */
Class Settings {

	private static $instance;
	public $settings;

  private function __construct() {
  	$this->initDefaults();
  }

  // getInstance method
  public static function getInstance() {
    if(!self::$instance) {
      self::$instance = new self();
    }
    return self::$instance;
  }


	/**
	 * Generates the default settings object
	 */
	private function initDefaults() {

		$baseUrl = get_template_directory_uri().'/assets/build/js/';

		// setting defaults (set in theme setup settings call, not within here)

		$this->settings = (object)array(

			'debug' => false, // mbi debug (pd, etc.)
			'comments' => false, // enable comments
			'widgets' => false, // enable widget
			'page_tags' => false, // enable tags for pages
			'banner' => true, // mbi banner
			'removeImageAttributes' => true,
			'dynamic_images' => true, // dynamic image creation, should always be enabled to keep amount of images down

			// which menus to register
			'menus' => array(

				'main_menu' => 'Main Menu',
				'footer_menu' => 'Footer Menu'

			),
			'beautifySearch' => true,

			// to register as breakpoints within js
			// for now no overlapping queries are possible
			'breakpoints' => array(

				'small' => 'only screen and (max-width: 768px)', // for now this is mandatory

				'medium' => 'only screen and (min-width: 768px) and (max-width: 1200px)',
				'large' => 'only screen and (min-width: 1200px)'

			),

			// only for artdirected css
			'artdirectedImages' => array(

				'fullscreen' => array(

					'landscape' => array(1440, 16, 9, null), // standard ohne eigene media query für fallback
					'portrait' => array(930, 3, 4, 'only screen and (min-width: 768px) and (orientation: portrait)'),
					'landscape_closeup' => array(640, 5, 3, 'only screen and (max-width: 768px) and (orientation: landscape)'), // only with _suffix
					'portrait_closeup' => array(384, 3, 5, 'only screen and (max-width: 768px) and (orientation: portrait)')

				)

			),

			// only for picture element breakpoints
			'singleImages' => array(

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
	public function apply($_settings) {

		foreach($_settings as $key => $value) {

			switch($key) {

				case 'rewrite_rules':

					$defaults = $this->get_option($key);
					$combined = array_merge($defaults, $value);
					$this->get($key, $combined);

					break;
				case 'requirejs':

					// do not allow requirejs in init()

					break;
				default:

					$this->set($key, $value);

					break;

			}

		}

		// $this->set_option('requirejs', $this->get_require_paths());
		$this->set('requirejs', $this->get_require_paths());

	}

	/**
	 * [get_require_paths description]
	 * @return [type] [description]
	 */
	public static function get_require_paths() {

		$content = file_get_contents(get_template_directory() . '/assets/conf/build.js');

		$json = substr($content, 15, -2);

    	$data = json_decode($json, TRUE);

    	$require = (array)$data['paths'];

    	unset($require['jquery']); // äh... geht das nicht automatisiert bitte? ;)

    	foreach($require as &$path) {

    		$path = get_template_directory_uri(). '/assets/build/js/'.$path;

    	}

		return $require;

	}

	// public function set_option($_key, $_value) {
	// 	$this->settings->{$_key} = $_value;
	// }

	// public function get_option($_key) {
	// 	return $this->settings->{$_key};
	// }

	public static function get( $key ) {
      if ( isset( self::$instance->$key ) ) {
          return self::$instance->$key;
      } else {
          return null;
      }
    }

	public static function set( $key, $value ) {
        self::$instance->$key = $value;
  }

}

// $settings = new Settings();