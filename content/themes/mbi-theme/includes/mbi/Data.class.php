<?php

/**
 * Data
 *
 * @version 0.2.1
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

	public static function output($key) {

		global $data;

		if(isset($data[$key])) {

			echo $data[$key];

		} else {

			return false;

		}

	}

}

$data = array();
