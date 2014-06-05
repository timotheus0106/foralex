/**
 * mbiHelper
 *
 * @version 0.1.2
 */
define([
	'jquery',
	'modules/mbiconfig',
	'vendor/modernizr',
	'vendor/jquery.ease'
], function(
	$,
	mbiConfig
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
		pd: function(value, name) {

			if(mbiConfig.debug === true) {
				if(name == undefined) {
					name = new Date().getTime();
				}
				console.log(name+': ', value);
				return true;

			} else {
				return false;
			}

		},
		moveTo: function(element, target, method) {

			var swap = $(element).detach();

			if(method == 'prepend') {
				swap.prependTo(target);
			} else if(method == 'append') {
				swap.appendTo(target);
			} else if(method == 'before') {
				$(target).before(swap);
			} else if(method == 'after') {
				$(target).after(swap);
			}
		},
		scrollto: function(element, speed, offset, callback, container) {

			if(typeof element == 'undefined') {
				element = 'body';
			}

			if(typeof speed == 'undefined') {
				speed = 500;
			}

			if(typeof offset == 'undefined') {
				offset = 0;
			}

			if(typeof callback == 'undefined') {
				callback = function() {
					// nothing
				}
			}

			if(typeof container == 'undefined') {
				container = 'html, body';
				var top = $(element).offset().top;
			} else {
				var top = $(element).position().top;
			}

			var value = top + offset;

			$(container).animate({
				scrollTop: value
			}, speed, 'easeOutQuint').promise().done(callback);

		},
		sortNumber: function(a,b) {
			return a - b;
		},
		transitionend: function() {

			var transitionend = (function(transition) {
				var transEndEventNames = {
					 'WebkitTransition': 'webkitTransitionEnd', // Saf 6, Android Browser
					 'MozTransition': 'transitionend', // only for FF < 15
					 'transition': 'transitionend' // IE10, Opera, Chrome, FF 15+, Saf 7+
				};
				return transEndEventNames[transition];
			})(Modernizr.prefixed('transition'));
			return transitionend;
		},
		ios: function() {

			var userAgent = window.navigator.userAgent;
			if(/iP(hone|od|ad)/.test(userAgent)) {
				return true;
			} else {
				return false;
			}
		},
		ie11: function() {

			/*
			var ie10Styles = [
				'msTouchAction',
				'msWrapFlow',
				'msWrapMargin',
				'msWrapThrough',
				'msOverflowStyle',
				'msScrollChaining',
				'msScrollLimit',
				'msScrollLimitXMin',
				'msScrollLimitYMin',
				'msScrollLimitXMax',
				'msScrollLimitYMax',
				'msScrollRails',
				'msScrollSnapPointsX',
				'msScrollSnapPointsY',
				'msScrollSnapType',
				'msScrollSnapX',
				'msScrollSnapY',
				'msScrollTranslation',
				'msFlexbox',
				'msFlex',
				'msFlexOrder'
			];
			*/

			var ie11Styles = [
				'msTextCombineHorizontal'
			];

			var d = document;
			var b = d.body;
			var s = b.style;
			// var ieVersion = null;
			var property;

			for (var i = 0; i < ie11Styles.length; i++) {

				property = ie11Styles[i];

				if(s[property] != undefined) {
					var ieVersion = 'ie11';
				}

			}

			if(ieVersion !== undefined) {
			   $('html').addClass(ieVersion);
			}
		},
		preload: function(arrayOfImages) {
			$(arrayOfImages).each(function(){
				$('<img/>')[0].src = this;
			});
		},
		ajax: function(action, ajaxData, responseFunction) {
			ajaxData.action = action;
			$.ajax({
				type: 'POST',
				data: ajaxData,
				dataType: 'json'
			}).done(function(response) {
				responseFunction(response);
			}).fail(function(xhr, ajaxOptions, thrownError) {
				console.log(thrownError);
			});
    },
		init: function() {
			$(document).on('click', '.js_scrollto', function(e) {
				e.preventDefault();
				var to = $(this).attr('data-to');
				module.scrollto($(to));
			});

			if(module.ios === true) {
				$('html').addClass('ios');
			}
		}
	};

	module.init();

	// ------------------------

	return module;

});

// --------------------------------------------
