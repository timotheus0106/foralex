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

	<title>
		<?php global $page, $paged;
    wp_title( '|', true, 'right' );
    bloginfo( 'name' );
    $site_description = get_bloginfo( 'description', 'display' );
    if ( $site_description && ( is_home() || is_front_page() ) ){
    	echo " | $site_description";
    }
    if ( $paged >= 2 || $page >= 2 ){
    	echo ' | ' . sprintf( __( 'Page %s', 'moodley' ), max( $paged, $page ) );
    } ?>
  </title>

	<link rel="stylesheet" href="<?php echo(get_template_directory_uri()); ?>/style.css">

	<?php wp_head(); ?>

	<?php
	/**
	 * Outputs style for background images
	 */
	$backgroundImage->echoAD(); ?>

</head>
<body>

	<!--
	/*
	 * This website was carefully designed and built by
	 *
	 * Moodley Brand Identity
	 * http://www.moodley.at/
	 *
	 */
	-->
	<div class="page">