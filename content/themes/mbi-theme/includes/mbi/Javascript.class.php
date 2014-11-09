<?php

/**
 * Javascript
 *
 * @version 1.0.0
 */
Class Javascript {

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

	public static function header() {

		ob_start();

	// ----------------------------------------------
?>
<script>

var mbiMediaQueries = <?php echo file_get_contents(ASSETS_DIR.'/conf/mq.json'); ?>; // this is so very good

require.config({
	paths: {
<?php


$require = Settings::get_option('requirejs');

foreach ($require as $name => $path) {

	echo("\t".$name.': \''.$path.'\','.PHP_EOL);

}

?>
	}
});

</script>
<?php
	// ----------------------------------------------

		echo ob_get_clean();

	}

}

Javascript::getInstance();