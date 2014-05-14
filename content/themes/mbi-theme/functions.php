<?php

// ----------------------------------------------------------------------------------
// Before Settings Setup
// ----------------------------------------------------------------------------------

require_once('includes/lib/Settings.class.php');
require_once('includes/lib/Themesetup.class.php');

require_once('includes/lib/Images.class.php');

require_once('includes/lib/Init.class.php');

$settings->init(array(

	'debug' => true,

	'menus' => array(

		'main_menu' => 'Top Menu'

	),
	'comments' => false

));

require_once('includes/lib/Helper.class.php');
require_once('includes/lib/Data.class.php');
require_once('includes/lib/Loader.class.php');

// ----------------------------------------------------------------------------------
// After Settings Setup ($settings Dependency)
// ----------------------------------------------------------------------------------

require_once('includes/lib/Javascript.class.php');

require_once('includes/lib/Picture.class.php');
require_once('includes/lib/BackgroundImage.class.php');

// ----------------------------------------------------------------------------------
// Project Functions
// ----------------------------------------------------------------------------------

// require_once('includes/KnappLoader.class.php');
// require_once('includes/KnappPrepare.class.php');