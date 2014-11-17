
require(['vendor/domready', 'jquery', 'vendor/idangerous.swiper', 'vendor/ImageSize'], function(domReady, $) {
	'use strict';


	function moveUp(){

		$('body').on('click', '.infoWrapper', function(){


			if ($('.contactData').hasClass('is_visible')) {

				$('.contactData').removeClass('is_visible');
				$('.openTimes').addClass('is_visible');

			} else if($('.logo').hasClass('is_visible')){

				$('.logo').removeClass('is_visible');
				$('.contactData').addClass('is_visible');

			} else if ($('.openTimes').hasClass('is_visible')){ //opentimes is open

				$('.openTimes').removeClass('is_visible');
				$('.furtherInformation').addClass('is_visible');

			} else { //furtherInformation is open

				$('.furtherInformation').removeClass('is_visible');
				$('.logo').addClass('is_visible');

			}

		});

		$('body').on('click', '.js_contactLink', function(){

			if ($('.contactData').hasClass('is_visible')) {

				return;

			} else {

				$('.logo').removeClass('is_visible');
				$('.openTimes').removeClass('is_visible');
				$('.furtherInformation').removeClass('is_visible');
				$('.contactData').addClass('is_visible');

			}


		});

		$('body').on('click', '.js_openTimes', function(){

			if ($('.openTimes').hasClass('is_visible')) {

				return;

			} else {

				$('.logo').removeClass('is_visible');
				$('.contactData').removeClass('is_visible');
				$('.furtherInformation').removeClass('is_visible');
				$('.openTimes').addClass('is_visible');

			}


		});

		$('body').on('click', '.js_discount', function(){

			if ($('.furtherInformation').hasClass('is_visible')) {

				return;

			} else {

				$('.logo').removeClass('is_visible');
				$('.contactData').removeClass('is_visible');
				$('.openTimes').removeClass('is_visible');
				$('.furtherInformation').addClass('is_visible');

			}


		});

	}

function initialSwiper(){

    var mySwiper = $('.swiper-container').swiper({
        mode:'horizontal',
        calculateHeight: true,
        keyboardControl: true,
        loop: true
    });


    $('body').on('click', '.js_swiperButton', function(){

        if ($(this).hasClass('button--back')) {
            mySwiper.swipePrev();
        } else {
            mySwiper.swipeNext();
        }

    });


}

function scrollDown(){
	$('.js_scrollDown').click(function(){

		// $(this).parent.next

		    $('html, body').animate({
		        scrollTop: $(this).parent().next().offset().top
		    }, 1000);

	});
}

function scrollUp(){
	$('.linksBottom').click(function(){

		$('html, body').animate({
	        scrollTop: $(this).parent().offset().top
	    }, 500);

	});
}




	domReady(function () {

		moveUp();
		initialSwiper();
		scrollDown();
		scrollUp();

	});
});
