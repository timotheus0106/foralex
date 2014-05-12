<?php

Class Settings {

	public $settings;

	public function __construct() {

		// setting defaults (set in theme setup settings call, not within here)

		$this->settings = (object)array(

			'debug' => false,

			'comments' => false,
			'widgets' => false,
			'page_tags' => false,
			'banner' => true,
			'dynamic_images' => true,

			'menus' => array(

				'main_menu' => 'Main Menu',
				'footer_menu' => 'Footer Menu'

			),
			'beautifysearch' => true,

			// to register as breakpoints within js
			'breakpoints' => array(

				'small' => 'only screen and (max-width: 768px)',
				'medium' => 'only screen and (min-width: 768px) and (max-width: 1200px)',
				'large' => 'only screen and (min-width: 1200px)'

			),

			// only for artdirected css
			'artdirected' => array(

				'fullscreen' => array(

					'landscape' => array(1440, 16, 9, null), // standard ohne eigene media query für fallback
					'portrait' => array(1440, 4, 3, 'only screen and (min-width: 768px) and (orientation: portrait)'),
					'landscape_closeup' => array(800, 16, 9, 'only screen and (max-width: 768px) and (orientation: landscape)'), // only with _suffix
					'portrait_closeup' => array(400, 4, 3, 'only screen and (max-width: 768px) and (orientation: portrait)')

				)

			),

			// only for picture element breakpoints
			'picture' => array(

				'grid' => array( // immer gefälligst standard + preview

					'preview' => array(100, 1, 1, null),
					'standard' => array(800, 1, 1, 'only screen and (min-width: 768px) and (max-width: 1200px)'),

					'small' => array(1440, 1, 1, 'only screen and (max-width: 768px)'),
					'large' => array(320, 1, 1, 'only screen and (min-width: 1200px)')

				),
				'swiper' => array( // immer gefälligst standard + preview

					'preview' => array(100, 16, 9, null),
					'standard' => array(800, 16, 9, 'only screen and (min-width: 768px) and (max-width: 1200px)'),

					'small' => array(1440, 5, 3, 'only screen and (max-width: 768px)'),
					'large' => array(320, 1, 1, 'only screen and (min-width: 1200px)')

				),

			)

		);

	}

	public function init($_settings) {

		foreach($_settings as $key => $value) {

			$this->set_option($key, $value);

		}

	}

	public function set_option($_key, $_value) {

		$this->settings->{$_key} = $_value;

	}

	public function get_option($_key) {

		return $this->settings->{$_key};

	}

}

$settings = new Settings();
