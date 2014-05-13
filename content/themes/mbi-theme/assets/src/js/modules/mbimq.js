define([
	'jquery',
	'modules/mbihelper',
	'vendor/matchmedia'
], function(
	$,
	_
) {
	'use strict';

	var module = {

		mq: new Object(),
		mqBreakpoint: true,
		mqPrevious: 'none',
		mqTag: 'all',
		mqQuery: null,

		mqStates: new Object(),

		/**
		 * Overwrite Defaults
		 * @param {Object} queries Media Queries to be used within mbi system
		 */
		setMediaQueries: function(data) {

			module.mq = data;

			return true;

		},

		/**
		 * Checks for Media Query changes
		 *
		 * @returns {null}
		 */
		checkMediaQuery: function() {

			$.each(module.mq, function(key, query) {

				if(matchMedia('all and '+query).matches) {
					module.mqTag = key;
					module.mqQuery = query;
				}

			})

			if(module.mqTag == module.mqPrevious) {

				module.mqBreakpoint = false;

			} else {

				module.mqBreakpoint = true;

				var args = {
					from: module.mqPrevious,
					to: module.mqTag,
					query: module.mqQuery
				}

				$(document).trigger('breakpoint', args);

			}

			module.mqPrevious = module.mqTag;

		},
		init: function(mq) {

			module.setMediaQueries(mq);

			module.checkMediaQuery();

			$(window).resize(function() {

				module.checkMediaQuery();

			});

			$(document).on('breakpoint', function(event, data) {

				_.pd(data.from+' -> '+data.to+' ('+data.query+')', 'breakpoint');

			});

		}

	}

	// do not init here to enable php to set mq

	return module;

});