<?php

/**
 * Data
 *
 * @version 0.2.2
 */

Class Data {

	public static function getInstance() {

		static $instance = null;

		if(null === $instance) {
			$instance = new static();
		}

		return $instance;

	}

	protected function __construct() {}
	private function __clone() {}
	private function __wakeup() {}

	// -------------------------------------------------

	public static function add($key, $value) {

		global $data;

		$data[$key] = $value;

	}

	// -------------------------------------------------

	public static function output($key, $return = false) {

		global $data;

		if(isset($data[$key])) {

			if($return === true) {

				return $data[$key];

			} else {

				echo $data[$key];

			}

		} else {

			return false;

		}

	}

	public static function attribute($key, $attr) {

		global $data;


		if(isset($data[$key][$attr])) {



				// echo $data[$key];
				echo ' data-' . $attr . '="' . $data[$key][$attr] . '"';

		} else {

			return false;

		}

	}

}

$data = array();