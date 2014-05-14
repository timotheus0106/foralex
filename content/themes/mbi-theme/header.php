<?php

// ----------------------------------------------------------------------------------
// load all data here and put into $data global container
// ----------------------------------------------------------------------------------

$data->add('meta', array(

	'title' => 'KnappCom',
	'lang' => 'DE'

));

// ----------------------------------------------------------------------------------
// load parts afterwards (header also uses $data etc.)
// ----------------------------------------------------------------------------------

?><!DOCTYPE html>
<!--[if lt IE 9]><html class="no-js ie8" lang="<?php echo $data->get['meta']['lang']; ?>"><![endif]-->
<!--[if IE 9]><html class="no-js ie9" lang="<?php echo $data->get['meta']['lang']; ?>"><![endif]-->
<!--[if IE 10]><html class="no-js ie10" lang="<?php echo $data->get['meta']['lang']; ?>"><![endif]-->
<!--[if !IE]> --><html class="no-js" lang="<?php echo $data->get['meta']['lang']; ?>"><!-- <![endif]-->
<head>

	<meta charset="UTF-8">
	<title><?php echo $data->get['meta']['title']; ?></title>

<?php $helper->banner(); ?>

	<meta name="viewport" content="width=device-width, initial-scale=1.0" />

	<link rel="stylesheet" href="<?php echo(get_template_directory_uri()); ?>/style.css">

	<!--<script src="<?php echo(get_template_directory_uri()); ?>/assets/build/js/head.js"></script>-->

	<?php wp_head(); ?>

	<?php
	/**
	 * Outputs style for background images
	 */
	$backgroundImage->echoAD(); ?>

</head>
<body>

	<!--[if lt IE 9]>
	<div>This is IE8. Stop using such things. ;)</div>
	<![endif]-->

	<div class="site">
		<div class="container">