
require(['vendor/domready', 'jquery'], function(domReady, $) {
	'use strict';


	function moveUp(){

		$('body').on('click', '.infoWrapper', function(){


			if ($('.contactData').hasClass('is_visible')) {

				$('.contactData').removeClass('is_visible');
				$('.openTimes').addClass('is_visible');

			} else if($('.logo').hasClass('is_visible')){

				$('.logo').removeClass('is_visible');
				$('.contactData').addClass('is_visible');

			} else { //opentimes is open

				$('.openTimes').removeClass('is_visible');				
				$('.logo').addClass('is_visible');

			}

		});

		$('body').on('click', '.js_contactLink', function(){

			if ($('.contactData').hasClass('is_visible')) {

				return;

			} else {

				$('.logo').removeClass('is_visible');
				$('.openTimes').removeClass('is_visible');
				$('.contactData').addClass('is_visible');

			}


		});	

		$('body').on('click', '.js_openTimes', function(){

			if ($('.openTimes').hasClass('is_visible')) {

				return;

			} else {

				$('.logo').removeClass('is_visible');
				$('.contactData').removeClass('is_visible');
				$('.openTimes').addClass('is_visible');

			}


		});
	}



	domReady(function () {
		
		moveUp();

	});
});
