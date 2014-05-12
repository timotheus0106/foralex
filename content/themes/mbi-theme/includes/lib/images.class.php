<?php

/**
 * Images
 */
Class Images {

	public $settings;

	public $sizes; // wordpress image sizes
	public $css;

	public function __construct(Settings $_settings) {

		$this->settings = $_settings;

	}

	public function add_size($size, $retina = true) {

		add_image_size($size['name'], $size['width'], $size['height'], true);

		if($retina === true) {
			add_image_size($size['name'].'@2x', $size['width']*2, $size['height']*2, true);
		}

	}

	public function prepare_size($width, $x, $y, $name, $group, $query) {

		$height = (int)($width/$x*$y);

		return array(

			'name' => $name,
			'width' => $width,
			'height' => $height,
			'ratio' => $x.':'.$y,
			'query' => $query,
			'group' => $group

		);

	}

}