

/**
* Basic example of an require statement
* @param  domReady  [wait till everything is in place]
* @param  $         [jQuery Library]
* @param  mbiMq     [Handle Media Queries - REQUIRED if Javascript for Breakpoints and Path config is printed (in footer)]
* @param  mbiConfig [Configuration Stuff - REQUIRED if Javascript for Breakpoints and Path config is printed (in footer)]
* @return none
*/
require(['vendor/domready', 'jquery', 'modules/mbimq', 'modules/mbiconfig'], function(domReady, $, mbiMq, mbiConfig) {
	'use strict';


	domReady(function () {
		
		// dom is ready now for action!
		// $ can be used here

	});
});
