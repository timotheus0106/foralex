<?php

/**
 * BackgroundImage extends Images
 *
 * @version {{VERSION}}
 */

Class BackgroundImage extends Images {

	/**
	 * [add description]
	 * @param [type] $container [description]
	 * @param [type] $size      [description]
	 */
	public static function add($container, $size) { // add artdirected image group (post object) to style list

		if(!empty($container['custom'])) { // IS ARTDIRECTED
			if(is_array($container) && array_key_exists('landscape', $container['custom'])) {
				$object = $container['custom'];
				$sizes = Settings::get_option('artdirected_images');

				foreach($sizes[$size] as $size_key => $options) { // iterate through sizes
					$use_key = $size_key; // use without suffix when _closeup does not exist
					$image = $object[$size_key];

					if(empty($image)) {
						$use_key = substr($size_key, 0, strpos($size_key, '_')); // only with _suffix
					}
					static::register_image($object[$use_key], $container['post']->ID, $size, $size_key);
				}
				return 'artdirected--'.$container['custom']['landscape']['id'];
			}

		} else { // IMAGE IS SINGLE IMAGE
			$object = $container;
			$sizes = Settings::get_option('single_images');

			foreach($sizes[$size] as $size_key => $options) { // iterate through sizes
				$use_key = $size .'_'.$size_key;
				$image = $object['sizes'][$use_key];

				// @todo remove grid_preview not hard coded
				if ($use_key != 'grid_preview') {
					static::register_image($object, $container['id'], $size, $size_key);
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
	public static function register_image($img, $id, $name, $key) {

		$size = $name.'_'.$key;
		if(!isset(static::$css[$size])) {
			static::$css[$name][$key]['@1x'] = '.artdirected--'.$id.' { background-image: url('.$img['sizes'][$size].'); }';
			static::$css[$name][$key]['@2x'] = '.artdirected--'.$id.' { background-image: url('.$img['sizes'][$size.'@2x'].'); }';
		} else {
			static::$css[$name][$key]['@1x'] .= ' .artdirected--'.$id.' { background-image: url('.$img['sizes'][$size].'); }';
			static::$css[$name][$key]['@2x'] .= ' .artdirected--'.$id.' { background-image: url('.$img['sizes'][$size.'@2x'].'); }';
		}
	}

	/**
	 * [printArtDirectedImageCSS description]
	 * @return [type] [description]
	 */
	public static function printArtDirectedImageCSS() {

		$data = '';

		if(!empty(static::$css)) { // if images are registered

			$data .= '<style>';

			// iterate through registered stages
			foreach(static::$css as $key => $styles) {

				// @todo we would need it NOT hardcoded.. Now only works with ARTDIRECTED FULLSCREEN array!
				if($key == 'fullscreen') {
					$mediae = Settings::get_option('artdirected_images');
				} else {
					$mediae = Settings::get_option('single_images');
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
