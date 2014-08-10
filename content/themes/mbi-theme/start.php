<?php
/**
 * Template Name: Start Page
 * Template Description: Start page
 * The Template for displaying the first (start) page.
 * @package moodley
 * @subpackage moodley-web
 * @since mbi-theme 1.0
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

		</div>
		<div class="furtherInformation">
			<p>20% Studentenrabatt von Dienstag bis Donnerstag bis 26 Jahre.<br/>
				Kinder unter 12 Jahren bekommen in der Zeit von Montag bis Freitag jeweils bis 15 Uhr 50% Rabat
			</p>

		</div>
		<div class="linksBottom">
			<div class="bottom__contact link js_contactLink">kontakt</div>
			<div class="bottom__openTimes link js_openTimes">öffnungszeiten</div>
		</div>

<!-- button down -->
		<!--<div class="startpage__button--wrapper">
			<div class="button--black--down--wrapper">
				<div class="buttons button--black--down"></div>
			</div>
		</div>-->
<!-- button down END -->

	</div>



<?php get_footer(); ?>