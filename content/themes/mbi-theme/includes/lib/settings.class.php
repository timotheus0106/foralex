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

					'landscape' => array(1440, 16, 9, 'only screen and (max-width: 1024px)'),
					'portrait' => array(1440, 16, 9, 'only screen and (max-width: 1024px)'),
					'landscape_closeup' => array(1440, 16, 9, 'only screen and (max-width: 1024px)'),
					'portrait_closeup' => array(1440, 16, 9, 'only screen and (max-width: 1024px)')

				)

			),

			// only for picture element breakpoints
			'picture' => array(

				'grid' => array(

					'size' => array(400, 1, 1), // width, x ratio, y ratio
					'stages' => array(

						'small' => 'only screen and (max-width: 768px)',
						'medium' => 'only screen and (min-width: 768px) and (max-width: 1200px)',
						'large' => 'only screen and (min-width: 1200px)'

					)

				)

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