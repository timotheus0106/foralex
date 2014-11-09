<?php
/**
 * Template Name: Start Page
 * Template Description: Start page
 * The Template for displaying the first (start) page.
 * @package triebl
 * @subpackage triebl-web
 * @since triebl-theme 1.0
 */

get_header(); ?>

    <?php
/*					*\
	  load stuff
\*					*/


$name = get_field('field_53e760e6c37a2', 4);
$street = get_field('field_53e75f8ac379f', 4);
$tel = get_field('field_53e75faec37a0', 4);
$mail = get_field('field_53e75fddc37a1', 4);



/*					*\
	 render stuff
\*					*/

    ?>

	<div class="startpage__site-wrapper box">
		
		<div class="infoWrapper">
			
			<div class="logo is_visible"></div>
			<div class="contactData">
				<div class="contactData-inner">
					<div class="name"><?php echo $name; ?></div>
					<div class="street"><?php echo $street; ?></div>
					<div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211"><?php echo $tel; ?></a></div>
					<div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></div>
				</div>
			</div>
			<div class="openTimes">
				<p>	<span class="openTimes__heading">ÖFFNUNGSZEITEN</span><br/>
					DI-MI: 10 BIS 19 UHR<br/>
					DO-FR: 10 BIS 20 UHR<br/>
					SA: 09 BIS 15 UHR
				</p>
			</div>
			<div class="furtherInformation">
				<p>20% Studentenrabatt von Dienstag bis Donnerstag bis 26 Jahre.
					Kinder unter 12 Jahren bekommen in der Zeit von Montag bis Freitag jeweils bis 15 Uhr 50% Rabat
				</p>
			</div>
		</div>
		<div class="linksBottom">
			<div class="bottom__contact link js_contactLink">kontakt</div>
			<div class="bottom__openTimes link js_openTimes">öffnungszeiten</div>
			<div class="bottom__discount link js_discount">rabatte</div>
		</div>

<!-- button down -->
		<div class="startpage__button--wrapper">
			<div class="button--black--down--wrapper">
				<!--<div class="buttons button--black--down"></div>-->
				<?php SVG::getFromFile('arrow_down', 'svg__arrow--down') ?>
			</div>
		</div>
<!-- button down END -->

	</div>
<!-- SLIDER-PAGE: START -->
	<div class="slider__site-wrapper box">

	<!-- INFO-MENU: START -->
		<div class="infoWrapper">
			
			<div class="logo is_visible"></div>
			<div class="contactData">
				<div class="contactData-inner">
					<div class="name"><?php echo $name; ?></div>
					<div class="street"><?php echo $street; ?></div>
					<div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211"><?php echo $tel; ?></a></div>
					<div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></div>
				</div>
			</div>
			<div class="openTimes">
				<p>	<span class="openTimes__heading">ÖFFNUNGSZEITEN</span><br/>
					DI-MI: 10 BIS 19 UHR<br/>
					DO-FR: 10 BIS 20 UHR<br/>
					SA: 09 BIS 15 UHR
				</p>
			</div>
			<div class="furtherInformation">
				<p>20% Studentenrabatt von Dienstag bis Donnerstag bis 26 Jahre.
					Kinder unter 12 Jahren bekommen in der Zeit von Montag bis Freitag jeweils bis 15 Uhr 50% Rabat
				</p>
			</div>
		</div>
	<!-- INFO-MENU: END -->
	<!-- SWIPER: START -->
	<!-- SWIPER: START -->
        <div class="module image--wrapper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
            <!--First Slide-->
                    <div class="swiper-slide">
                        <img class="image img__slide1" src="Images/slide_img_1.jpg" alt="slide img">
                    </div>

            <!--Second Slide-->
                    <div class="swiper-slide">
                        <img class="image img__slide2" src="Images/slide_img_1.jpg" alt="slide img">
                    </div>

            <!--Third Slide-->
                    <div class="swiper-slide">
                        <img class="image img__slide3" src="Images/slide_img_1.jpg" alt="slide img">
                    </div>
            <!--Etc..-->
                </div>
            </div>
            <div class="swiper__buttons">
                <div class="button--back js_swiperButton"><?php SVG::getFromFile('swipe__button--left', 'swipe__button--left'); ?></div>
                <div class="button--forward js_swiperButton"><?php SVG::getFromFile('swipe__button--right', 'swipe__button--right'); ?></div>
            </div>
        </div>

    <!-- SWIPER: END -->
	<!-- SWIPER: END -->


	</div>
<!-- SLIDER-PAGE: END -->



<?php get_footer(); ?>