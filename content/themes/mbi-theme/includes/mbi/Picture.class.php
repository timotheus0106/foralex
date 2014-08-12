<?php

/**
 * Picture extends Images
 *
 * @version 0.1.0
 */
Class Picture extends Images {

	public function __construct() {

		// parent::__construct($_settings);

	}

	/**
	 * [picture description]
	 * @param  [type]  $object [description]
	 * @param  [type]  $size   [description]
	 * @param  boolean $echo   [description]
	 */
	public static function printHTML($object, $size, $echo = true) {

		// $settings = ThemeSettings::getInstance();

		// break if no image object is given
		if(!isset($object) || empty($object)) {
			return false;
		}

		if(!empty($object['custom'])) {

			if(is_array($object) && array_key_exists('landscape', $object['custom'])) {

				$id = $object['post']->ID;
				$data = '<!-- BEGIN .picture -->';
				$data .= '<span data-picture class="picture picture--'.$id.'" data-alt="test">';
				$data .= '<img class="picture__preview" src="'.$object['custom']['landscape']['sizes'][$size.'_landscape'].'" alt="test" />';

				// $registered_picture_sizes = $this->settings->get('artdirected');
				$registered_picture_sizes = ThemeSettings::get('artdirectedImages');

				foreach($registered_picture_sizes[$size] as $key => $media) {

					$use_key = $key;

					if (empty($object['custom'][$key])) {

						$use_key = substr($use_key, 0, strpos($use_key, '_')); // only with _suffix

					}

					$data .= '<span data-src="' . $object['custom'][$use_key]['sizes'][$size . '_' . $use_key] . '" data-media="' . $media[3] . '" alt="test"></span>';

				}

				$data .= '<noscript>';
				$data .= '<img src="' . $object['custom']['landscape']['sizes'][$size . '_landscape'] . '" alt="test" />';
				$data .= '</noscript>';

				$data .= '</span>';
				$data .= '<!-- END .picture -->';

			}

		} else {

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
			// $registered_picture_sizes = $this->settings->get('image');
			$registered_picture_sizes = ThemeSettings::get('singleImages');

			foreach($registered_picture_sizes[$size] as $key => $media) {
				if($key !== 'preview') {
					$data .= '<span data-src="'. $object['sizes'][$size.'_'.$key].'" data-media="'. $media[3] .'"></span>';
				}
			}

			$data .= '<noscript>';
			$data .= '<img src="'.$object['sizes'][$size.'_standard'].'" alt="'.$alt.'" />';
			$data .= '</noscript>';

			$data .= '</span>';
			$data .= '<!-- END .picture -->';

		}

		if($echo) {
			echo $data;
		}else{
			return $data;
		}
		return true;
	}

}

function picture($object, $size, $echo = true) {
	Picture::printHTML($object, $size, $echo);
}
