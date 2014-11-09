<?php

/**
 * Loader
 *
 * @version 0.2.2
 */
Class Loader {

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

	// --------------------------------

	/**
	 * [get_post_data description]
	 * @param  [type] $id [description]
	 */
	public static function get_post_data($id = null) {

		if(!empty($id)) {

			$post = get_post($id);
			$custom = get_fields($id);

		} else {

			$id = get_the_ID();
			$post = get_post();
			$custom = get_fields();

		}

		$data = array(

			'id' => $id,
			'post' => $post,
			'custom' => $custom

		);

		return $data;

	}

	/**
	 * [get_post_type description]
	 * @param  [type] $name [description]
	 * @return [type]       [description]
	 */
	public static function get_post_type($name) {

		$args = array(
			'post_type' => $name
		);

		$query = new WP_query($args);
		$array = array();

		if($query->have_posts()) {
			while($query->have_posts()) {
				$query->the_post();
				$array[] = static::get_post_data(get_the_ID());
			}
		}

		wp_reset_postdata();

		return $array;
	}

}