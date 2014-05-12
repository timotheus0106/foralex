<?php

/**
 * ArtDirected extends Images
 */

Class ArtDirected extends Images {

	public $css;

	public function __construct(Settings $_settings) {

		parent::__construct($_settings);

		$this->init();

	}

	public function init() {

		foreach($this->settings->get_option('artdirected') as $name => $options) {

			foreach($options as $size => $option) {

				$stage = $name.'_'.$size;

				$add = $this->prepare_size($option[0], $option[1], $option[2], $stage, 'artdirected', $option[3]); // $width, $x, $y, $name, $group, $query

				$this->add_size($add);

			}

		}

	}

	public function add($container, $size) { // add artdirected image group (post object) to style list

		$object = $container['custom'];

		$sizes = $this->settings->get_option('artdirected');

		foreach($sizes[$size] as $size_key => $options) { // iterate through sizes

			$use_key = $size_key; // use without suffix when _closeup does not exist

			$image = $object[$size_key];

			if(empty($image)) {
				$use_key = substr($size_key, 0, strpos($size_key, '_')); // only with _suffix
			}

			$this->register_image($object[$use_key], $container['id'], $size, $size_key);

		}

		return 'artdirected--'.$container['id'];

	}

	private function register_image($img, $id, $name, $key) {

		$size = $name.'_'.$key;

		if(!isset($this->css[$size])) {

			$this->css[$name][$key]['@1x'] = '.artdirected--'.$id.' { background-image: url('.$img['sizes'][$size].'); }';
			$this->css[$name][$key]['@2x'] = '.artdirected--'.$id.' { background-image: url('.$img['sizes'][$size.'@2x'].'); }';

		} else {

			$this->css[$name][$key]['@1x'] .= ' .artdirected--'.$id.' { background-image: url('.$img['sizes'][$size].'); }';
			$this->css[$name][$key]['@2x'] .= ' .artdirected--'.$id.' { background-image: url('.$img['sizes'][$size.'@2x'].'); }';

		}

	}

	public function css() {

		$data = '';

		// if images are registered
		if(!empty($this->css)) {

			$data .= '<style>';

			$mediae = $this->settings->get_option('artdirected');

			// iterate through registered stages
			foreach($this->css as $key => $styles) {

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

	}

}

$artdirected = new ArtDirected($settings);