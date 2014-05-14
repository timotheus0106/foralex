/**
 * mbiAccordion module
 *
 * @version 0.1.2
 */
define([
	'jquery',
	'modules/mbihelper',
	'modules/mbimq'
], function(
	$,
	_,
	mbiMq
) {
	'use strict';

	var module = {

		container: '.accordion',
		item: '.accordion__item',
		head: '.accordion__head',
		content: '.accordion__content',
		wrapper: '.content__wrapper',

		containerHeight: function(reset) {

	        var $container = $(module.container);
	        var $current = $(module.item+'.active');
	        // var $wrapper = $(module.wrapper);

			if(reset === true) {

				var height;

		       	// if(_.exists($current.find('.googlemaps__container'))) {

		       	// 	_.pd($current.find(module.head).text());

		       	// 	height = $('.googlemaps__container').height();

		       	// } else {

		       		height = '';

		       	// }

				$container.css('height', height);

			} else {

				// Calculate max-height
				/*

		        var heights = new Array();

		        $wrapper.each(function() {
		            heights.push($(this).innerHeight());
		        });

		        heights = heights.sort(_.sortNumber).reverse();

		        var highest = heights[0];

		        var head = $(module.head).innerHeight();

		        $container.css('height', highest+head);

		        */

		       	// use height of current content + gmaps

		       	var height;

		       	if(_.exists($current.find('.googlemaps'))) {

		       		height = $('.googlemaps__map').innerHeight();

		       	} else {

		       		height = module.getHeight($current);

		       	}

		       	var buttonHeight = $(module.head).innerHeight();

		       	if(mbiMq.mqTag == 'small' || $(module.container).hasClass('accordion--vertical-only')) {

		       		buttonHeight *= $(module.item).length;

		       	}

		       	// _.pd(height+buttonHeight);

		       	$container.css('height', height+buttonHeight);

		    }

		},
		init: function() {

			$(module.item).first().addClass('active');

			module.checkState(mbiMq.mqTag);
			module.checkItems();

			$('body').on('click', module.head, function() {

				$(this).parents(module.item).siblings().addBack().removeClass('active');
				$(document).trigger('accordionClose');

				$(this).parents(module.item).addClass('active');
				$(document).trigger('accordionOpen', $(this).parents(module.item));

				// if($(this).parents(module.container).hasClass('accordion--vertical')) {

				// 	module.setHeight($(this).parent());

				// }

				module.checkState(mbiMq.mqTag);

			});

			$(document).on(_.transitionend(), module.item, function(e) {

				e.stopPropagation();

				if($(e.currentTarget).hasClass('active') && e.originalEvent.propertyName == 'max-height') {

					$(document).trigger('accordionDone', $(this));

				}

			});

			$(document).on('breakpoint', function(event, data) {

				var state = data.to;
				module.checkState(state);

			});

			$(window).resize(function() {

				var state = mbiMq.mqTag;
				module.checkState(state);

			});

		},
		checkItems: function() {

			var count = $(module.item).length;
			$(module.container).addClass('accordion--'+count+'-items');

		},
		checkState: function(state) {

			if(!$(module.container).hasClass('accordion--vertical-only')) {

				if(state !== 'small') {

					$(module.container).removeClass('accordion--vertical').addClass('accordion--horizontal');

					$(module.content).css('max-height', 'auto');

				} else {

					$(module.container).removeClass('accordion--horizontal').addClass('accordion--vertical');

				}

			} else {

				$(module.container).addClass('accordion--vertical').removeClass('accordion--horizontal');

				$(module.content).css('max-height', 'auto');

			}

			module.containerHeight();

		},
		getHeight: function(that) {

			var $wrapper = $(that).find(module.wrapper);
			var max = $wrapper.innerHeight();

			return max;

		},
		setHeight: function(that) {

			$(module.content).css('max-height', 'auto');

			var max = module.getHeight(that);

			$(that).find(module.content).css('max-height', max);

		}

	};

	// -----------------------------------------------------------------

	module.init();

	// -----------------------------------------------------------------

	return module;

});