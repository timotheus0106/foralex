<?php

/**
 * WPML Helper
 *
 * @version 0.2.1
 */
Class WPMLHelper {

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

	/**
	 * [translate description]
	 * @param  string $context [description]
	 * @param  [type] $name    [description]
	 * @param  [type] $value   [description]
	 * @return [type]          [description]
	 */
	public static function translate($context = 'mbi', $name, $value, $echo = false) {

		icl_register_string($context, $name, $value);

		$value = icl_t($context, $name, $value);

		if($echo === true) {

			echo $value;

		} else {

			return $value;

		}

	}

	/**
	 * [permalink description]
	 * @param  [type]  $id       [description]
	 * @param  [type]  $type     [description]
	 * @param  boolean $fallback [description]
	 * @param  [type]  $force    [description]
	 * @return [type]            [description]
	 */
	public static function permalink($id, $type, $fallback = true, $force = null) {

		return get_permalink(icl_object_id($id, $type, $fallback, $force));

	}

	/**
	 * [id description]
	 * @param  [type]  $id       [description]
	 * @param  [type]  $type     [description]
	 * @param  boolean $fallback [description]
	 * @param  [type]  $force    [description]
	 * @return [type]            [description]
	 */
	public static function id($id, $type, $fallback = true, $force = null) {

		return icl_object_id($id, $type, $fallback, $force);

	}

}
