define([
	'jquery',
	'modules/mbihelper',
	'modules/mbiconfig',
	'modules/mbimq',
	'vendor/jquery.swiper',
	'vendor/jquery.debounce',
	'vendor/viewport'
], function(
	$,
	_,
	mbiConfig,
	mbiMq
) {
	'use strict';

	var module = {

		swiperObjects: new Object(),
		swiperElements: '.swiper-container',

		createSwiper: function(name, options) {

			var element = $('#'+name);

			module.swiperObjects[name] = new Object();
			module.swiperObjects[name].settings = options;

			var args = new Object();

			// iterate through base options

			$.each(options.base, function(key, value) {

				switch(key) {

					case 'initPagination': // @todo: depend on media query to hide/show

						if(!!value) { // if not false/empty/null

							if(value === true) { // if true

								args.pagination = '.swiper-pagination--'+name;
								args.paginationClickable = true;

							} else { // if other than true but not false/empty/null

								args.pagination = value;
								args.paginationClickable = true;

							}

						}

						delete options.base[key];

						break;
					case 'initButtons':

						if(!!value) {

							if(value === true) {
								value = element;
							}

							module.swiperButtons(name, value);

						}

						delete options.base[key];

						break;
					case 'initCenterActive':

						if(value === true) { // if true

							args.onSlideChangeStart = function(swiper, direction) {

								if(element.is(':in-viewport')) {

									_.scrollto(element, 250);

								}

							};

						}

						delete options.base[key];

						break;
					case 'resizeFix':
					case 'heightAuto':
					case 'widthAuto':

						// delete options.base[key];

						break;
					default:

						args[key] = value;

						delete options.base[key];

						break;

				}

			});

			// iterate through states options

			if(!!options.states) { // if states exist

				$.each(mbiMq.mq, function(key, value) { // loop through mq

					if(options.states[key] == undefined) { // if there is no state for mq

						module.swiperObjects[name].settings.states[key] = new Object();

					} else { // pass on state to settings

						module.swiperObjects[name].settings.states[key] = options.states[key];

					}

				});

				$.each(options.states, function(size, state) { // use current state to init with

					if(!!size && size == mbiMq.mqTag) { // if state matches current mq

						$.each(state, function(key, value) {

							args[key] = value;

							delete options.states[key];

						});

					}

				});

			} else { // if no states exist

				module.swiperObjects[name].settings['states'] = new Object();

				$.each(mbiMq.mq, function(key, value) { // create empty state for each mq

					module.swiperObjects[name].settings.states[key] = null;

				});

			}

			module.swiperObjects[name].swiper = element.swiper(args);

		},
		swiperChangeState: function() {

			$.each(module.swiperObjects, function(name, item) {

				if(typeof item.settings.states[mbiMq.mqTag] === Object) {

					$.each(item.settings.states[mbiMq.mqTag], function(key, value) {

						item.swiper.params[key] = value;

					});

				}

				if(item.settings.base.resizeFix === true) {

					item.swiper.resizeFix();

				}

			});

		},
		swiperResize: function() {

			$.each(module.swiperObjects, function(name, item) {

				var $item = $('#'+name);

				if(item.settings.base.heightAuto) {

					$item.find('.swiper-slide').css('height', 'auto');
					$item.find('.swiper-wrapper').css('height', 'auto');

				}

				if(item.settings.base.widthAuto) {

					$item.find('.swiper-slide').css('width', 'auto');
					$item.find('.swiper-wrapper').css('width', 'auto');

				}

				if(typeof item.settings.states[mbiMq.mqTag] === Object) {

					if(item.settings.states[mbiMq.mqPrevious].cssWidthAndHeight !== item.settings.states[mbiMq.mqTag].cssWidthAndHeight) {

						$item.find('.swiper-slide').removeAttr('style');
						$item.find('.swiper-wrapper').removeAttr('style');

					}

				}

			});

		},
		swiperInit: function() {

			$.each(module.swiperObjects, function(name, item) {

				item.swiper.reInit();

			});

		},
		/*
		swiperNumber: function(element) {

			var name = $(element).find(module.swiperElements).attr('id');

			var $pagination = $(element).find('.pagination');

			$total = $pagination.find('.total');
			var slides = module.swiperObjects[name].swiper.slides.length
			$total.html(slides);

			var handler = function() {

				$active = $pagination.find('.active');

				var index = module.swiperObjects[name].swiper.activeIndex;

				$active.html(index+1);

			};

			module.swiperObjects[name].swiper.params.onSlideChangeStart = handler;
			module.swiperObjects[name].swiper.params.onSlideChangeEnd = handler;

		},
		*/
		swiperButtons: function(name, selector) {

			var elementNext = selector.find('.js_next');
			var elementPrev = selector.find('.js_prev');

			elementNext.on('click', function(e) {

				e.preventDefault();
				module.swiperObjects[name].swiper.swipeNext();

			});
			elementPrev.on('click', function(e) {

				e.preventDefault();
				module.swiperObjects[name].swiper.swipePrev();

			});

		},
		slideTo: function(selector, slide) {

			$(selector).each(function() {

				var name = $(this).attr('id');

				module.swiperObjects[name].swiper.swipeTo(slide);

			});


		},
		init: function() {

			module.swiperChangeState();
			module.swiperInit();

			$(document).on('breakpoint', function(event, data) {

				module.swiperChangeState();
				module.swiperResize();

			});

		}

	};

	// -----------------------------------------------------------------

	module.init();

	// -----------------------------------------------------------------

	return module;

});