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


// $name = get_field('field_53e760e6c37a2', 4);
// $street = get_field('field_53e75f8ac379f', 4);
// $tel = get_field('field_53e75faec37a0', 4);
// $mail = get_field('field_53e75fddc37a1', 4);



/*					*\
	 render stuff
\*					*/

    ?>

	<div class="startpage__site-wrapper box">

		<div class="infoWrapper">

			<div class="logo is_visible"></div>
			<div class="contactData">
				<div class="contactData-inner">
					<!-- <div class="name"><?php echo $name; ?></div>
                    <div class="street"><?php echo $street; ?></div>
                    <div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211"><?php echo $tel; ?></a></div>
                    <div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></div> -->

                    <div class="name">ALEXANDER PRASSER</div>
					<div class="street">ENGE GASSE 3, 8010 GRAZ</div>
					<div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211">0043 660 / 8300211</a></div>
					<div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:info@alexanderprasser.at">info@alexanderprasser.at</a></div>
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
		<div class="startpage__button--wrapper js_scrollDown">
			<div class="button--black--down--wrapper">
				<!--<div class="buttons button--black--down"></div>-->
				<?php SVG::getFromFile('arrow_down', 'svg__arrow--down') ?>
			</div>
		</div>
<!-- button down END -->

	</div>

<!-- BIOGRAPHY-PAGE: START -->

    <div class="bio__site-wrapper box">

        <!-- INFO-MENU: START -->
        <div class="infoWrapper">

            <div class="logo is_visible"></div>
            <div class="contactData">
                <div class="contactData-inner">
                    <!-- <div class="name"><?php echo $name; ?></div>
                    <div class="street"><?php echo $street; ?></div>
                    <div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211"><?php echo $tel; ?></a></div>
                    <div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></div> -->

                    <div class="name">ALEXANDER PRASSER</div>
                    <div class="street">ENGE GASSE 3, 8010 GRAZ</div>
                    <div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211">0043 660 / 8300211</a></div>
                    <div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:info@alexanderprasser.at">info@alexanderprasser.at</a></div>
                </div>
            </div>
            <div class="openTimes">
                <p> <span class="openTimes__heading">ÖFFNUNGSZEITEN</span><br/>
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

    <!-- TEXT-BIO: START -->
        <div class="textbio">
            <div class="headline">Alexander Prasser<br/><span class="subheading">Style Director</span></div>
            <div class="text">
                <p>Die richtige Mischung aus Zeitgeist und Zeitlosigkeit und dabei gleichzeitig den Wünschen und Vorstellungen seiner Kunden/innen gerecht zu werden, so lautet das Credo des Style Directors Alexander Prasser.</p>

                <p>Seine Karriere als Stylist begann Alexander Prasser bei der britischen Salon-Kette Toni&Guy. In den dazugehörigen Academies in England und Deutschland verfeinerte er sein Know-how und hielt später auch selbst Seminare ab. Nach weiteren Stationen als Mitbegründer des innovativen Geschäftskonzepts „Coins“, bei Dieter Ferschinger und Show-Bookings für Toni&Guy auf internationalen Hair & Style-Messen, hat es Alexander Prasser nun in die Selbstständigkeit gezogen.</p>

                <p>Im Salon in der Engegasse 3, im Herzen von Graz, unter einem Dach mit Bright Hairdressers, bleibt Alexander Prasser seiner Philosophie treu: „Es ist mir wichtig, meinen Kunden/innen dabei zu helfen, ihre eigene Identität zu entfalten. Bei allen Trends, stehen bei mir das Individuelle und die Entwicklung des persönlichen Stils immer im Vordergrund.“</p>
            </div>
        </div>
    <!-- TEXT-BIO: END -->

    <!-- IMG-BIO: START -->
        <div class="imgbio">
            <div class="img-bio--inner">
                <div class="image img01"><img src="content/themes/mbi-theme/assets/gfx/Img/bio_01_s-s.jpg" alt="bio img"></div>
                <div class="image img02"><img src="content/themes/mbi-theme/assets/gfx/Img/bio_02_s-s.jpg" alt="bio img"></div>
                <div class="image img03"><img src="content/themes/mbi-theme/assets/gfx/Img/bio_03_s-s.jpg" alt="bio img"></div>

                <!-- <div class="image img01"><img src="http://placehold.it/170x230" alt="bio img"></div>
                <div class="image img02"><img src="http://placehold.it/230x160" alt="bio img"></div>
                <div class="image img03"><img src="http://placehold.it/370x260" alt="bio img"></div> -->
            </div>
        </div>
    <!-- IMG-BIO: END -->




    <!-- BUTTONS BOTTOM: START -->
        <div class="linksBottom">
            <div class="bottom__contact link js_contactLink">kontakt</div>
            <div class="bottom__openTimes link js_openTimes">öffnungszeiten</div>
            <div class="bottom__discount link js_discount">rabatte</div>
        </div>
    <!-- BUTTONS BOTTOM: END -->
    <!-- button down -->
        <div class="startpage__button--wrapper js_scrollDown">
            <div class="button--black--down--wrapper">
                <!--<div class="buttons button--black--down"></div>-->
                <?php SVG::getFromFile('arrow_down', 'svg__arrow--down') ?>
            </div>
        </div>
<!-- button down END -->
    </div>
<!-- BIOGRAPHY-PAGE: END -->

<!-- SLIDER-PAGE: START -->
    <div class="slider__site-wrapper box">

    <!-- INFO-MENU: START -->
        <div class="infoWrapper">

            <div class="logo is_visible"></div>
            <div class="contactData">
                <div class="contactData-inner">
                    <!-- <div class="name"><?php echo $name; ?></div>
                    <div class="street"><?php echo $street; ?></div>
                    <div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211"><?php echo $tel; ?></a></div>
                    <div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:<?php echo $mail; ?>"><?php echo $mail; ?></a></div> -->

                    <div class="name">ALEXANDER PRASSER</div>
                    <div class="street">ENGE GASSE 3, 8010 GRAZ</div>
                    <div class="tel link">T&nbsp;&nbsp;&nbsp;<a href="tel:00436608300211">0043 660 / 8300211</a></div>
                    <div class="mail link">M&nbsp;&nbsp;&nbsp;<a href="mailto:info@alexanderprasser.at">info@alexanderprasser.at</a></div>
                </div>
            </div>
            <div class="openTimes">
                <p> <span class="openTimes__heading">ÖFFNUNGSZEITEN</span><br/>
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
        <div class="module image--wrapper">
            <div class="swiper-container">
                <div class="swiper-wrapper">
            <!--First Slide-->
                    <div class="swiper-slide">
                        <img class="image img__slide1" src="content/themes/mbi-theme/assets/gfx/Img/slide_01_s-s.jpg" alt="slide img">
                    </div>

            <!--Second Slide-->
                    <div class="swiper-slide">
                        <img class="image img__slide2" src="content/themes/mbi-theme/assets/gfx/Img/slide_02_s-s.jpg" alt="slide img">
                    </div>

            <!--Third Slide-->
                    <!-- <div class="swiper-slide">
                        <img class="image img__slide3" src="content/themes/mbi-theme/assets/gfx/Img/slide_03_s-s.jpg" alt="slide img">
                    </div> -->
            <!--Fourth Slide-->
                    <div class="swiper-slide">
                        <img class="image img__slide4" src="content/themes/mbi-theme/assets/gfx/Img/slide_04_s-s.jpg" alt="slide img">
                    </div>
            <!--Fifth Slide-->
                    <!-- <div class="swiper-slide">
                        <img class="image img__slide5" src="content/themes/mbi-theme/assets/gfx/Img/slide_05_s-s.jpg" alt="slide img">
                    </div> -->
            <!--Sixths Slide-->
                    <!-- <div class="swiper-slide">
                        <img class="image img__slide6" src="content/themes/mbi-theme/assets/gfx/Img/slide_06_s-s.jpg" alt="slide img">
                    </div> -->
            <!--Seventh Slide-->
                    <div class="swiper-slide">
                        <img class="image img__slide7" src="content/themes/mbi-theme/assets/gfx/Img/slide_07_s-s.jpg" alt="slide img">
                    </div>
            <!--Etc..-->
            <!--Etc..-->
                </div>
            </div>
            <div class="swiper__buttons">
                <div class="button--back js_swiperButton"><?php SVG::getFromFile('swipe__button--left', 'swipe__button--left'); ?></div>
                <div class="button--forward js_swiperButton"><?php SVG::getFromFile('swipe__button--right', 'swipe__button--right'); ?></div>
            </div>
        </div>

    <!-- SWIPER: END -->
    <!-- BUTTONS BOTTOM: START -->
        <div class="linksBottom">
            <div class="bottom__contact link js_contactLink">kontakt</div>
            <div class="bottom__openTimes link js_openTimes">öffnungszeiten</div>
            <div class="bottom__discount link js_discount">rabatte</div>
        </div>
    <!-- BUTTONS BOTTOM: END -->




    </div>
<!-- SLIDER-PAGE: END -->



<?php get_footer(); ?>


<!-- <div class="swiper-wrapper">
<!--First Slide-->
        <!-- <div class="swiper-slide">
            <img class="image img__slide1 image--stretch" src="content/themes/mbi-theme/assets/gfx/Img/slide_01_s.jpg" alt="slide img">
        </div> -->

<!--Second Slide-->
        <!-- <div class="swiper-slide">
            <img class="image img__slide2 image--stretch" src="content/themes/mbi-theme/assets/gfx/Img/slide_02_s.jpg" alt="slide img">
        </div> -->

<!--Third Slide-->
        <!-- <div class="swiper-slide">
            <img class="image img__slide3 image--stretch" src="content/themes/mbi-theme/assets/gfx/Img/slide_03_s.jpg" alt="slide img">
        </div> -->
<!--Fourth Slide-->
        <!-- <div class="swiper-slide">
            <img class="image img__slide4 image--stretch" src="content/themes/mbi-theme/assets/gfx/Img/slide_04_s.jpg" alt="slide img">
        </div> -->
<!--Fifth Slide-->
        <!-- <div class="swiper-slide">
            <img class="image img__slide5 image--stretch" src="content/themes/mbi-theme/assets/gfx/Img/slide_05_s.jpg" alt="slide img">
        </div> -->
<!--Sixths Slide-->
        <!-- <div class="swiper-slide">
            <img class="image img__slide6 image--stretch" src="content/themes/mbi-theme/assets/gfx/Img/slide_06_s.jpg" alt="slide img">
        </div> -->
<!--Etc..-->
    <!-- </div> --> -->


    <!-- <div class="swiper-wrapper">
            <!--First Slide-->
                    <!-- <div  class="swiper-slide"> -->
                     -->    <!-- <div class="bgImage img__slide1" ></div>
                    </div> -->

            <!--Second Slide-->
                    <!-- <div class="swiper-slide">
                         --><!-- <div class="bgImage img__slide2" ></div>
                    </div> -->

            <!--Third Slide-->
                    <!-- <div class="swiper-slide">
                         --><!-- <div class="bgImage img__slide3" ></div>
                    </div> -->
            <!--Fourth Slide-->
                    <!-- <div class="swiper-slide">
                         --><!-- <div class="bgImage img__slide4" ></div>
                    </div> -->
            <!--Fifth Slide-->
                    <!-- <div class="swiper-slide">
                         --><!-- <div class="bgImage img__slide5" ></div>
                    </div> -->
            <!--Sixths Slide-->
                    <!-- <div class="swiper-slide">
                         --><!-- <div class="bgImage img__slide6" ></div>
                    </div> -->
            <!--Etc..-->
                <!-- </div> -->