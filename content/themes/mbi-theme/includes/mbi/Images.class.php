<?php

/**
 * Images
 *
 * @version 0.1.0
 */
Class Images {

	public function __construct() { }

	public static function addSize($size, $retina = true) {
		add_image_size($size['name'], $size['width'], $size['height'], false);

		if($retina === true) {
			add_image_size($size['name'].'@2x', $size['width']*2, ($size['height'] != 9999) ? $size['height']*2 : $size['height'], false);
		}
	}

	public static function prepareSize($width, $x, $y, $name, $group, $query) {
		$height = ($y != 0) ? (int)($width/$x*$y) : 9999;

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
