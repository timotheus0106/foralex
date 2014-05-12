<?php

// always prepare data at the top

$data->add('meta', array(

	'title' => 'WP2GO',
	'lang' => 'de'

));

?><!DOCTYPE html>
<!--[if lt IE 9]><html class="no-js ie8" lang="<?php echo $data->get['meta']['lang']; ?>"><![endif]-->
<!--[if IE 9]><html class="no-js ie9" lang="<?php echo $data->get['meta']['lang']; ?>"><![endif]-->
<!--[if IE 10]><html class="no-js ie10" lang="<?php echo $data->get['meta']['lang']; ?>"><![endif]-->
<html lang="<?php echo $data->get['meta']['lang']; ?>" class="no-js">
<head>

	<meta charset="UTF-8">
	<title><?php echo $data->get['meta']['title']; ?></title>

<?php $helper->banner(); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0, user-scalable=no" />

	<link rel="stylesheet" href="<?php echo(get_template_directory_uri()); ?>/style.css">

	<script src="<?php echo(get_template_directory_uri()); ?>/assets/build/js/head.js"></script>

	<?php wp_head(); ?>

</head>
<body>

	<!--[if lt IE 9]>
	<div>This is IE8. Stop using such things. ;)</div>
	<![endif]-->