<?php

/**
 * Javascript
 *
 * @version 0.2.0
 */
Class Javascript {

	private static $instance;

  public static function getInstance() {
      if(!self::$instance) {
          self::$instance = new self();
      }
  return self::$instance;
  }

	protected function __construct() {}
	private function __clone() {}
	private function __wakeup() {}

	// ----------------------------------------

	public static function printJS() {

		ob_start();

	// ----------------------------------------------
?>
<script>

	// @todo: put this into class function

	require(['modules/mbimq', 'modules/mbiconfig'], function(mbiMq, mbiConfig) {

		require.config({
			paths: {
<?php


$require = ThemeSettings::get('requirejs');

foreach ($require as $name => $path) {

	echo("\t\t\t\t".$name.': \''.$path.'\','.PHP_EOL);

}

?>
			}
		});

		mbiMq.init({
<?php

$queries = ThemeSettings::get('breakpoints');



foreach ($queries as $key => $query) {

	echo("\t\t\t".$key.': \''.$query.'\','.PHP_EOL);

}

?>
		});

		mbiConfig.path.gfx = '<?php echo(get_template_directory_uri()); ?>/assets/gfx/';

	});

	</script>
<?php
	// ----------------------------------------------

		echo ob_get_clean();

	}

}
