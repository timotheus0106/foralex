define([
	'jquery',
	'modules/mbihelper',
	'waypoints'
], function(
	$,
	_
) {
 	'use strict';

 	var module = {

 		setActive: function(that) {

 			var id = $(that).attr('data-step');

			$('.sticky-pagination .item').removeClass('active');
			$('.sticky-pagination .item[data-step="'+id+'"]').addClass('active');

 		},
 		init: function() {

 			if(_.exists('.block--step')) {

				$('.site').prepend('<div class="sticky-pagination"></div>');

				// -----------------------------------------------------------

				var counter = 1;
				$('.block--step').each(function() {

					$(this).attr('data-step', counter);

					$('.sticky-pagination').append('<div class="item" data-step="'+counter+'"></div>');
					counter++;

				});

				// -----------------------------------------------------------

				$('.block--step').waypoint(function(direction) {
					if (direction === 'down') {

						_.pd('down it goes');

						module.setActive(this);

					}
				}, {

					offset: '50%'

				}).waypoint(function(direction) {
					if (direction === 'up') {

						module.setActive(this);

						_.pd('up up up');

					}
				}, {

					offset: '-50%'

				});

				// -----------------------------------------------------------

				$('.sticky-pagination').on('click', '.item', function() {

					var step = $(this).attr('data-step');

					_.scrollto('.block--step[data-step="'+step+'"]');

				});

				// -----------------------------------------------------------

			}

 		}

 	};

 	module.init();

 	return module;

});