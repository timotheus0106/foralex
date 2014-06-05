<?php

/**
 * Loader
 *
 * @version 0.1.0
 */
Class Loader {

	public function __construct() {

	}

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

}