<?php

/**
 * Settings
 *
 * @version 0.2.1
 */
Class ThemeSettings {

		private static $settings;

	public static function getInstance() {

		static $instance = null;

		if(null === $instance) {
			$instance = new static();
		}
		return $instance;
	}


	private function __clone() {}
	private function __wakeup() {}

	protected function __construct() {

		static::$settings = (object)array(
			// $this->settings = (object)array(
			'debug' => false, // mbi debug (pd, etc.)
			'comments' => false, // enable comments
			'widgets' => false, // enable widget
			'pageTags' => false, // enable tags for pages
			'banner' => true, // mbi banner
			'removeImageAttributes' => true,
			'beautifySearch' => true,
			'dynamicImages' => true, // dynamic image creation, should always be enabled to keep amount of images down
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
					'preview' => array(100, 1, 1, null), // "preview" tag required
					'standard' => array(960, 1, 1, 'only screen and (min-width: 768px) and (max-width: 1200px)'), // "standard" tag required
					'small' => array(420, 1, 1, 'only screen and (max-width: 768px)'),
					'large' => array(1440, 1, 1, 'only screen and (min-width: 1200px)')
				)
			),
			// require js (gets populated by init())
			'requirejs' => array(),
			// rewrite rules
			'rewriteRules' => array(
				array('admin/?$', 'wp-admin', 'top'),
		        array('login/?$', 'wp-login.php', 'top')
			),
			// acf tiny mce
			'acfTinymce' => array(
			// 	'ToolbarLayoutName' => array('bold', 'link', 'bullist')
			)
		);

		//pd($args);
		//static::apply($args);

	}


	// ----------------------------------------

	/**
	 * [init description]
	 * @param  [type] $_settings [description]
	 */
	public static function apply($args) {
		foreach($args as $key => $value) {
			switch($key) {
				case 'rewriteRules':
					$defaults = static::get($key);
					$combined = array_merge($defaults, $value);
					static::set($key, $combined);
					break;
				case 'requirejs':
					// do not allow requirejs in init()

					break;
				default:
					static::set($key, $value);
					break;
			}
		}
		static::set('requirejs', static::getRequirePaths());

	}

	public static function getRequirePaths() {

		$content = file_get_contents(get_template_directory() . '/assets/conf/build.js');



		$json = substr($content, 15, -2);
    $data = json_decode($json, TRUE);
    $require = (array)$data['paths'];
    unset($require['jquery']); // äh... geht das nicht automatisiert bitte? ;)

  	foreach($require as &$path) {
  		$path = get_template_directory_uri() . '/assets/build/js/'. $path;
  	}
		return $require;
	}

	public static function set($_key, $_value) {
		static::$settings->{$_key} = $_value;
	}

	public static function get($_key) {
		return static::$settings->{$_key};
	}
}
