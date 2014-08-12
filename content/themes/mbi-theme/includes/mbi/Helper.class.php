<?php

/**
 * Helper
 *
 * @version 0.2.1
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
	 * [print_debug description]
	 * @param  [type]  $var [description]
	 * @param  boolean $die [description]
	 * @return [type]       [description]
	 */
	public static function print_debug($var, $die = false) {

		// if(WP_DEBUG === true) {

			if(Settings::get_option('debug') === true) {

				if(empty($var)) {
					$parse = 'mbi_print_debug: var empty';
				} else {
					$parse = print_r($var, true);
				}

				$parse = str_replace('Array', '<span style="color: #4692b9;">Array</span>', $parse);
				$parse = str_replace('WP_Post Object', '<span style="color: #d6ea31;">WP_Post Object</span>', $parse);
				$parse = str_replace('stdClass', '<span style="color: #fc7c49;">stdClass</span>', $parse);
				$parse = str_replace('[]', '<span style="color: #d6ea31">{empty}</span>', $parse);
				$parse = str_replace('[', '<span style="color: #fd523f">', $parse);
				$parse = str_replace(']', '</span>', $parse);
				$parse = str_replace('(', '<span style="color: #444;">(</span>', $parse);
				$parse = str_replace(')', '<span style="color: #444;">)</span>', $parse);
				$parse = str_replace(' => ', ' <span style="color: #666;">:</span> ', $parse);

				$echo = '<pre style="font-family: Source Code Pro, Consolas, Courier New, monospaced; font-size: 12px; background: #333; color: #eee;">';
				$echo .= $parse;
				$echo .= '</pre>';

				echo($echo);

				if($die===true) {
					exit();
				}

				return true;

			}

		// } else {

		// 	return false;

		// }

	}

	/**
	 * Converting given phone number into
	 *
	 * @param string $tel human-readable phone number
	 * @param bool $full anchor or number only
	 * @return string either anchor with machine-readable phone number or with tel: within anchor
	 **/
	public function tel_to_anchor($tel, $full = false) {

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
		// 	return "";
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

		if (trim($str) == ''){
			return $str;
		}

		preg_match('/^\s*+(?:\S++\s*+){1,'.(int) $limit.'}/', $str, $matches);

		if (strlen($str) == strlen($matches[0])){
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
	
}

// ------------------------------------------------

function pd($var, $die = false) {

	Helper::print_debug($var);

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
