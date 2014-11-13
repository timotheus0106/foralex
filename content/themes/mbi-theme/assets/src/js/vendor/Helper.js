define([
	'jquery'
], function(
	$
) {
	'use strict';

	var module = {

		exists: function(element) {

			if($(element).length > 0) {
				return true;
			} else {
				return false;
			}

		},
		scrollToTarget: function(element, speed, offset, callback, container) {

			var value, top;

			if(typeof callback == 'undefined') {
				callback = function() {
					// nothing
				}
			}
			if(typeof speed == 'undefined') {
				speed = 500;
			}
			if(typeof offset == 'undefined') {
				offset = 0;
			}

			if(typeof element == 'undefined') {
				element = 'body';
			}

			if(typeof container == 'undefined') {
				container = 'html, body';
				top = $(element).offset().top;
			} else {
				top = $(element).position().top;
			}

			value = top + offset;

			$(container).animate({
				scrollTop: value
			}, speed).promise().done(callback);

		}

	}

	return module;

});