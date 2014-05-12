<?php

Class Loader {

	public function __construct() {

		$this->loader = 'Hello.';

	}

	public function get_post_data($id = null) {

		if(!empty($id)) {

			$post = get_post($id);
			$custom = get_fields($id);

		} else {

			$post = get_post();
			$custom = get_fields();

		}

		$data = array(

			'post' => $post,
			'custom' => $custom

		);

		return $data;

	}

}