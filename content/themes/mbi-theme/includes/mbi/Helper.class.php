<?php

/**
 * Helper
 *
 * @version 0.2.2
 */
Class Helper {

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

	// ----------------------------------------

	/**
	 * [banner description]
	 * @param  boolean $force [description]
	 * @return [type]         [description]
	 */
	public static function banner($force = false) {

		if(Settings::get_option('banner') === true || $force === true) {

			ob_start();

		?>
	<!--
	/*
	 * This website was carefully designed and built by
	 *
	 * Moodley Brand Identity
	 * http://www.moodley.at/
	 *
	 */
	-->
		<?php

			echo ob_get_clean();

		}

	}

	/**
	 * [print_console description]
	 * @param  [type] $var   [description]
	 * @param  [type] $title [description]
	 * @return [type]        [description]
	 */
	public static function print_console($var, $title) {

		echo('<script>console.log('.json_encode($var, JSON_HEX_QUOT).', \''.$title.'\');</script>');

	}

	/**
	 * [print_debug description]
	 * @param  [type]  $var [description]
	 * @param  boolean $die [description]
	 * @return [type]       [description]
	 */
	public static function print_debug($var, $title = '$') {

		if(Settings::get_option('debug') === true) {

			if(empty($var)) {
				$parse = '<span style="color: #666;">false/null/empty</span>';
			} else {
				$parse = print_r($var, true);
			}

			$parse = str_replace('Array', '<span style="color: #4692b9;">Array</span>', $parse);
			$parse = str_replace('Object', '<span style="color: #4692b9;">Object</span>', $parse);

			$parse = str_replace('[]', '<span style="color: #666;">empty Array</span>', $parse);
			$parse = str_replace('[', '<span style="color: #fd523f;">', $parse);
			$parse = str_replace(']', '</span>', $parse);
			$parse = str_replace('(', '<span style="color: #444;">(</span>', $parse);
			$parse = str_replace(')', '<span style="color: #444;">)</span>', $parse);
			$parse = str_replace(" => \n", ' => <span style="color: #666;">false/null/empty</span>'."\n", $parse);
			$parse = str_replace(' => ', ' <span style="color: #666;">:</span> ', $parse);

			$title = '<span style="color: #d6ea31;">'.$title.'</span> <span style="color: #666;">:</span> ';

			$echo = '<pre style="font-family: Source Code Pro, Consolas, Courier New, monospaced; font-size: 12px; background: #333; color: #eee; border-bottom: 1px dashed #666; padding: 24px;">'.$title;
			$echo .= $parse;
			$echo .= '</pre>';

			echo($echo);

			return true;

		}

	}

	public static function print_readable($var, $title = '$') {

		if(Settings::get_option('debug') === true) {

			if(empty($var)) {
				$parse = 'false/null/empty';
			} else {
				$parse = print_r($var, true);
			}

			$echo = '<pre>'.$title;
			$echo .= $parse;
			$echo .= '</pre>';

			echo($echo);

		}

		return true;
	}


	/**
	 * Converting given phone number into
	 *
	 * @param string $tel human-readable phone number
	 * @param bool $full anchor or number only
	 * @return string either anchor with machine-readable phone number or with tel: within anchor
	 **/
	public static function tel_to_anchor($tel, $full = false) {

		$newTel = $tel;
		$newTel = str_replace("+", "00", $newTel);
		$newTel = str_replace(array("(", ")", " ", "-", "/"), "", $newTel);

		if($full) {
			return '<a href="tel:'.$newTel.'">'.$tel.'</a>';
		} else {
			return $newTel;
		}

	}

	/**
	 * [get_the_slug description]
	 * @return [type] [description]
	 */
	public static function get_the_slug() {

		global $post;

		// if(is_single() || is_page()) {
			return $post->post_name;
		// }
		// else {
		//  return "";
		// }

	}

	/**
	 * [split_by_more description]
	 * @param  [type] $text [description]
	 * @return [type]       [description]
	 */
	public function split_by_more($text) {

		$parts = explode('<!--more-->', $text);

		return $parts;

	}

	public function split_by_limit($str, $limit = 256) {

		$more = wordwrap($str, $limit, '<!--more-->');

		return static::split_by_more($more);

	}

	/**
	 * [word_limiter description]
	 * @param  [type]  $str      [description]
	 * @param  integer $limit    [description]
	 * @param  string  $end_char [description]
	 * @return [type]            [description]
	 */
	public function word_limiter($str, $limit = 16, $end_char = '&#8230;') {

		if (trim($str) == '')
		{
			return $str;
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

		if (strlen($str) == strlen($matches[0]))
		{
			$end_char = '';
		}

		return rtrim($matches[0]).$end_char;

	}

	/**
	 * [character_limiter description]
	 * @param  [type]  $str      [description]
	 * @param  integer $n        [description]
	 * @param  string  $end_char [description]
	 * @return [type]            [description]
	 */
	public function character_limiter($str, $n = 128, $end_char = '&#8230;') {

		if (strlen($str) < $n) {
			return $str;
		}

		$str = preg_replace("/\s+/", ' ', str_replace(array("\r\n", "\r", "\n"), ' ', $str));

		if (strlen($str) <= $n) {
			return $str;
		}

		$out = '';

		foreach (explode(' ', trim($str)) as $val) {

			$out .= $val.' ';

			if (strlen($out) >= $n) {
				$out = trim($out);
				return (strlen($out) == strlen($str)) ? $out : $out.$end_char;
			}

		}

	}

	public static function country($short, $lang = 'en') {

		if(file_exists(LIB_DIR.'/localization/countries.'.$lang.'.php')) {
			include(LIB_DIR.'/localization/countries.'.$lang.'.php');
		}

		return $countries[$short];

	}

	public static function split_into_abc($array) {

		$groups = array(
			'ABC' => array('a', 'b', 'c'),
			'DEF' => array('d', 'e', 'f'),
			'GHI' => array('g', 'h', 'i'),
			'JKL' => array('j', 'k', 'l'),
			'MNO' => array('m', 'n', 'o'),
			'PQR' => array('p', 'q', 'r'),
			'STU' => array('s', 't', 'u'),
			'VWX' => array('v', 'w', 'x'),
			'YZ' => array('y', 'z')
		);

		$return = array();

		$i = 0;

		foreach($groups as $name => $values) {

			$merge = array();

			foreach($values as $key => $value) {

				if(isset($array['items'][$value])) {

					$merge = array_merge($merge, $array['items'][$value]);

				}

			}

			$return['items'][$name] = $merge;

			if(in_array($array['active'], $values)) {
				$return['active'] = $name;
			}

			$i++;

		}

		$return['count'] = $array['count'];

		return $return;

	}

}

// ------------------------------------------------

function pd($var, $title = '') {

	Helper::print_debug($var, $title);

}

function pc($var, $title = 'print_console') {

	Helper::print_console($var, $title);

}

function pr($var, $title = '') {

	Helper::print_readable($var, $title);

}


// ------------------------------------------------

function part($path) {

	return PART_DIR.$path;

}
function inc($path) {

	return INC_DIR.$path;

}
function lib($path) {

	return LIB_DIR.$path;

}
function ext($path) {

	return EXT_DIR.$path;

}