<?php

/**
 * BackgroundImage extends Images
 *
 * @version 0.1.0
 */

Class BackgroundImage extends Images {

	public $css;

	public function __construct(Settings $_settings) {

		parent::__construct($_settings);

	}

	/**
	 * [add description]
	 * @param [type] $container [description]
	 * @param [type] $size      [description]
	 */
	public function add($container, $size) { // add artdirected image group (post object) to style list

		if(!empty($container['custom'])) { // IS ARTDIRECTED

			if(is_array($container) && array_key_exists('landscape', $container['custom'])) {

				$object = $container['custom'];

				$sizes = $this->settings->get_option('artdirected');

				foreach($sizes[$size] as $size_key => $options) { // iterate through sizes

					$use_key = $size_key; // use without suffix when _closeup does not exist

					$image = $object[$size_key];

					if(empty($image)) {
						$use_key = substr($size_key, 0, strpos($size_key, '_')); // only with _suffix
					}

					$this->register_image($object[$use_key], $container['post']->ID, $size, $size_key);

				}

				return 'artdirected--'.$container['custom']['landscape']['id'];
			}

		} else { // IMAGE IS SINGLE IMAGE

			$object = $container;
			$sizes = $this->settings->get_option('image');

			foreach($sizes[$size] as $size_key => $options) { // iterate through sizes

				$use_key = $size .'_'.$size_key;

				$image = $object['sizes'][$use_key];

				// @todo remove grid_preview not hard coded
				if ($use_key != 'grid_preview') {

					$this->register_image($object, $container['id'], $size, $size_key);

				}

			}

			return 'artdirected--'.$container['id'];
		}

	}

	/**
	 * [register_image description]
	 * @param  [type] $img  [description]
	 * @param  [type] $id   [description]
	 * @param  [type] $name [description]
	 * @param  [type] $key  [description]
	 * @return [type]       [description]
	 */
	public function register_image($img, $id, $name, $key) {

		$size = $name.'_'.$key;
		if(!isset($this->css[$size])) {
			$this->css[$name][$key]['@1x'] = '.artdirected--'.$id.' { background-image: url('.$img['sizes'][$size].'); }';
			$this->css[$name][$key]['@2x'] = '.artdirected--'.$id.' { background-image: url('.$img['sizes'][$size.'@2x'].'); }';


		} else {

			$this->css[$name][$key]['@1x'] .= ' .artdirected--'.$id.' { background-image: url('.$img['sizes'][$size].'); }';
			$this->css[$name][$key]['@2x'] .= ' .artdirected--'.$id.' { background-image: url('.$img['sizes'][$size.'@2x'].'); }';

		}

	}

	/**
	 * [echoAD description]
	 * @return [type] [description]
	 */
	public function echoAD() {

		$data = '';

		if(!empty($this->css)) { // if images are registered

			$data .= '<style>';

			// iterate through registered stages
			foreach($this->css as $key => $styles) {

				// @todo we would need it NOT hardcoded.. Now only works with ARTDIRECTED FULLSCREEN array!
				if($key == 'fullscreen') {

					$mediae = $this->settings->get_option('artdirected');

				} else {

					$mediae = $this->settings->get_option('image');

				}

				$size = substr($key, strpos($key, '_')+1);

				foreach ($styles as $style_key => $style) {

					$mq = $mediae[$key][$style_key][3];

					if($style_key == 'landscape') {
						$data .= $mq; // begin mq
					} else {
						$data .= ' @media '.$mq.' { '; // begin mq
					}

					// add registered classes for this stage
					$data .= trim($style['@1x']).PHP_EOL;

					if($style_key !== 'landscape') {
						$data .= ' } '.PHP_EOL; // end mq
					}

					// add retina mq
					$data .= '@media '.$mq.' and (-webkit-min-device-pixel-ratio: 2), '.$mq.' and (min--moz-device-pixel-ratio: 2), '.$mq.' and (-o-min-device-pixel-ratio: 2/1), '.$mq.' and (min-device-pixel-ratio: 2), '.$mq.' and (min-resolution: 192dpi), '.$mq.' and (min-resolution: 2dppx) { '.PHP_EOL;
					$data .= trim($style['@2x']).PHP_EOL; // add retina styles
					$data .= ' } '.PHP_EOL; // end retina mq

				}


			}

			$data .= '</style>';

		}

		echo $data;

		return true;

	}

}

$backgroundImage = new BackgroundImage($settings);