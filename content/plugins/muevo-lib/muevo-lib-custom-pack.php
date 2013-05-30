<?php
/**
 * Plugin Name: muevo Libraries
 * Description: Collection of Libs and Classes
 * Author: muevo Information Management
 */


/**
 * activation for library module - simply place an activate.php in your lib/LibName
 */
$file_path = __FILE__;
register_activation_hook($file_path, create_function('', '
	foreach( glob(dirname(__FILE__) . "/lib/*") as $folder ) {
		echo $folder;
		$file = $folder . "/activate.php";
		if( file_exists($file) ) {
			include_once($file);
		}
	}
'));

define('muevo_LIB_TEXTDOMAIN','tltxt');


/**
 * library loader / core class
 */
if( !class_exists('muevo') ) :

class muevo {

	const SUCCESS			 	= 0;
	const CLASS_ALREADY_LOADED 	= 1;
	const FILE_NOT_FOUND  		= 2;
	const CLASS_NOT_FOUND      	= 3;
	const INIT_FAILED			= 4;

	public static $loaded = array();

	protected static $defines = array();

	public static function define($key, $value = false) {
		if( !$value and isset(self::$defines[$key]) ) {
			return self::$defines[$key];
		} else {
			self::$defines[$key] = $value;
			return $value;
		}
	}

	public static function unset_define($key) {
		if( isset(self::$defines[$key]) ) {
			unset(self::$defines);
			return true;
		}
		return false;
	}


	public static function load($class, $args=array()) {
		// already loaded - return
		if( isset(self::$loaded[$class]) ) return muevo::CLASS_ALREADY_LOADED;

		// load file
		$class_path = dirname(__FILE__) . "/lib/$class/{$class}.php";


		if( !file_exists($class_path) ) return muevo::FILE_NOT_FOUND;

		include_once($class_path);
		self::$loaded[$class] = $class_path;


		// check if class exists
		if( !class_exists($class) ) {
			return muevo::CLASS_NOT_FOUND;
		} else { // class is here - init the plugin
			$res = call_user_func(create_function('$a', 'return '.$class.'::init($a);'), $args);
			if( !$res ) {
				return muevo::INIT_FAILED;
			} else {
				return muevo::SUCCESS;
			}
		}
	}

	public static function filter_german_umlauts($post_name) {

	}

}


/**
 * base class for all lib files
 */
abstract class muevoLib {
	/**
	 * @return boolean
	 */
	abstract static function init($args);
}

/**
 * tools
 */
class muevoTool {
	public static function element_or_default($array, $key, $default=false) {
		return isset($array[$key]) ? $array[$key] : $default;
	}
}

function muevo_define($key, $value=false) { return muevo::define($key, $value); }

function muevo_undefine($key) { return muevo::unset_define($key); }


/** autoloader for muevo classes **/
// autoloading of muevo classes
spl_autoload_register(create_function('$class', 'return muevo::load($class);'));



endif;