<?php

/**
 * Javascript
 *
 * @version 0.1.0
 */
Class Javascript {

	public function __construct(Settings $_settings) {

		$this->settings = $_settings;

	}

	public function footer() {

		ob_start();

	// ----------------------------------------------
?>
<script>

	// @todo: put this into class function

	require(['modules/mbimq', 'modules/mbiconfig'], function(mbiMq, mbiConfig) {

		require.config({
			paths: {
<?php


$require = $this->settings->get_option('requirejs');

foreach ($require as $name => $path) {

	echo("\t\t\t\t".$name.': \''.$path.'\','.PHP_EOL);

}

?>
			}
		});

		mbiMq.init({
<?php

$queries = $this->settings->get_option('breakpoints');

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

$javascript = new Javascript($settings);