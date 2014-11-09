<?php

/**
 * Part
 *
 * @version 0.2.2
 */
Class Part {

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

	// ----------------------------------------

	public static function prepare_class($class, $echo = true) {

		if(is_array($class)) {

			$data = implode(' ', $class);

		}

		if($echo === true) {

			echo $data;

		} else {

			return $data;

		}

	}

}