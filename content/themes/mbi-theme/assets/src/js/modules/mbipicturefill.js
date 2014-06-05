/**
 * mbiPicturefill module
 *
 * @version 0.1.2
 */
define([
	'jquery',
	'vendor/picturefill',
	'vendor/matchmedia'
], function(
	$
) {
    'use strict';

	var module = {

		loadingOffset: 0.75,

		checkvisible: function(element) {
			var vpH = $(window).height(),
			st = $(window).scrollTop(),
			y = $(element).offset().top;
			return (y < (vpH*module.loadingOffset + st));
		},
		activateVisiblePicturefills: function() {
			var redraw = false;

			$('.picture').each(function(i, element) {
				var needsToDisplay = module.checkvisible(element) && !$(element).attr('data-picture');
				if(needsToDisplay) {
					$(element).attr('data-picture', '');
					redraw = true;
				}
			});
			window.picturefill();
		},
		init: function(options) {
			if(options !== undefined && options instanceof Object) {
				module.loadingOffset = options.offset;
			}

			$(window).scroll(function() {
				module.activateVisiblePicturefills();
			});

			$(document).ready(function() {
				module.activateVisiblePicturefills();
			});
		}
	};

	module.init({ offset: 0.5});

	return module;
});
