<?php

/**
 * Picture extends Images
 */
Class Picture extends Images {

	public function __construct(Settings $_settings) {

		parent::__construct($_settings);

		$this->init();

	}

	public function init() {

		foreach($this->settings->get_option('picture') as $name => $options) {

			foreach($options as $size => $option) {

				$stage = $name.'_'.$size;

				$add = $this->prepare_size($option[0], $option[1], $option[2], $stage, 'picture', $option[3]); // $width, $x, $y, $name, $group, $query

				$size == 'preview' ? $retina = false : $retina = true;
				$this->add_size($add, $retina);

			}

		}

	}

	public function picture($object, $size, $echo = true) {

		// break if no image object is given
		if(!isset($object) || empty($object)) {
			return false;
		}

		// id
		$id = $object['id'];

		// alt text
		if(!empty($object['alt'])) {
			$alt = $object['alt'];
		} else {
			$alt = $object['title'];
		}

		$data = '<!-- BEGIN .picture -->';
		$data .= '<span data-picture class="picture picture--'.$id.'" data-alt="'.$alt.'">';
		$data .= '<img class="picture__preview" src="'.$object['sizes'][$size.'_preview'].'" alt="'.$alt.'" />';

		// iterate through registered image sizes for this picture element
		$registered_picture_sizes = $this->settings->get_option('picture');
		foreach($registered_picture_sizes[$size] as $key => $media) {

			if($key !== 'preview') {

				// $object['']

				$data .= '<span data-src="'.$object['sizes'][$size.'_'.$key].'" data-media="'.$media[3].'"></span>';

			}

		}

		$data .= '<noscript>';
		$data .= '<img src="'.$object['sizes'][$size.'_standard'].'" alt="'.$alt.'" />';
		$data .= '</noscript>';

		$data .= '</span>';
		$data .= '<!-- END .picture -->';

		if($echo === true) {

			echo $data;

		} else {

			return $data;

		}

	}

}

$picture = new Picture($settings);

function picture($object, $size, $echo = true) {

	global $picture;
	$picture->picture($object, $size, $echo);

}