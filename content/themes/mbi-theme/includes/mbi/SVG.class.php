<?php

/**
 * SVG
 *
 * @version 0.2.2
 */
Class SVG {

	/**
	 * [get_post_data description]
	 * @param  [type] $id [description]
	 */
	public static function getFromMap($iconName, $classes = '') {

		echo sprintf('<svg class="%s"><use xlink:href="icon-#%s"></use></svg>',
			$classes,
			$iconName
		);

	}

	public static function getFromFile($iconName, $classes = '', $echo = true) {

		$file = get_template_directory_uri().'/assets/gfx/svg/'.$iconName.'.svg';
		$svg = file_get_contents($file);

		$return = str_replace('<svg', '<svg class="'.$classes.'"', $svg);

		if($echo === true) {
			echo $return;
		} else {
			return $return;
		}


	}

	public static function getMap() {

		$file = get_template_directory_uri().'/assets/build/gfx/icons.svg';
		$svg = file_get_contents($file);

		$return = str_replace('<svg', '<svg id="svg-map"', $svg);

		echo $return;

	}

}