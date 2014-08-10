<?php

// ----------------------------------------------------------------------------------
// load all data here and put into $data global container
// ----------------------------------------------------------------------------------

// $data->add('meta', array(

// 	'title' => 'KnappCom',
// 	'lang' => 'DE'

// ));

// ----------------------------------------------------------------------------------
// load parts afterwards (header also uses $data etc.)
// ----------------------------------------------------------------------------------

?><!DOCTYPE html>
<!--[if lt IE 9]><html class="no-js ie8" lang="<?php language_attributes(); ?>"><![endif]-->
<!--[if IE 9]><html class="no-js ie9" lang="<?php language_attributes(); ?>"><![endif]-->
<!--[if IE 10]><html class="no-js ie10" lang="<?php language_attributes(); ?>"><![endif]-->
<!--[if !IE]> --><html class="no-js" lang="<?php language_attributes(); ?>"><!-- <![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width" />

	<title>Alexander Prasser - Style Director</title>
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,600,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="<?php echo(get_template_directory_uri()); ?>/style.css">

	<?php wp_head(); ?>

	<?php
		
	?>

</head>
<body>
	<div class="page">
