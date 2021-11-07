<?php
/*
 |
 | Home Page
 |
 */

require_once __ROOT__ . '/types/events/events.php';
require_once __ROOT__ . '/types/news/news.php';
require_once __ROOT__ . '/types/deals/deals.php';

use BFS\Types\Events;
use BFS\Types\News;
use BFS\Types\Deals;


$events = Events::getAll();
$news = News::getAllExcludingUnlisted();
$deals = Deals::getAll();

?>



<?php require_once __ROOT__ . '/pages/partials/header.php'; ?>





<!-- Sticky Call Section -->
<section class="sticky-call-section show-for-small js_sticky_call">
	<div class="container">
		<div class="row">
			<div class="columns small-12 text-center space-50-bottom">
				<a href="tel: +91-828-7770011" class="call-button button fill-yellow"><span class="material-icons inline-middle">phone_in_talk</span> <span class="call-number">+91-828-7770011</span></a>
			</div>
		</div>
	</div>
</section>
<!-- END: Sticky Call Section -->


<!-- Enterprise Coliving Strip -->
<section class="enterprise-coliving-strip fill-dark space-min-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12">
				<div class="message text-center">
					<img class="enterprise-icon inline-middle hide-for-small" src="/media/icons/icon-enterprise.svg<?php echo $ver ?>" style="margin-right: 8px;">
					<span class="h5 space-25-right inline-middle" style="line-height: 2;">Enterprise BCP Solutions</span>
					<a class="button fill-green-2 inline-middle" target="_blank" href="/news/enterprise-bcp-solutions">Learn More</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Enterprise Coliving Strip -->


<!-- Intro Section -->
<section class="intro-section fill-green-2 text-dark space-150-top-bottom" data-section="Intro" data-section-id="intro" style="background-image: linear-gradient(-135deg, transparent 60%, var(--yellow) 100%), url('/media/characters/intro-section/char-<?php echo rand( 1, 5 ) ?>.png?v=20181126'), url('/media/characters/intro-section/intro-section-bg-px.png?v=20181126');">
	<div class="container">
		<div class="intro row space-50-bottom">
			<div class="columns small-10 small-offset-1">
				<div class="logo h0 text-shadow text-green-1 space-25-bottom scroll-reveal"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1190 350" style="-webkit-filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25)); filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25));"><text style="opacity: 0;">Guesture</text><g fill="#00A390"><path d="M104.06 231.68c0 10.6-2.76 19.13-8.29 25.58-6.22 7.83-15.56 11.76-28 11.76-14.06 0-25.82-4.61-35.26-13.84l-28 28.35c16.13 15.68 37.92 23.51 65.33 23.51 23.74 0 42.98-7.03 57.74-21.09 14.06-13.83 21.09-31.69 21.08-53.59V59.15h-43.21V76.1c-11.54-12.67-26.17-19-43.92-19-18.21 0-32.62 5.3-43.21 15.91C6.1 85.21 0 108.95 0 144.21c0 35.5 6.1 59.24 18.32 71.22 10.6 10.61 24.89 15.91 42.86 15.91 4.61 0 8.99-.35 13.13-1.03v-39.07c-11.98-.23-20.28-5.19-24.88-14.86-3.01-6.69-4.49-17.41-4.49-32.16 0-14.74 1.49-25.58 4.49-32.5 4.6-9.44 12.9-14.16 24.88-14.16 11.99 0 20.29 4.72 24.89 14.16 3.23 6.92 4.84 17.76 4.84 32.5l.02 87.46zM449.41 185.68c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.74-3.46-27.66-10.38-6.68-6.45-10.37-15.09-11.05-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.44-18.67 29.73-18.67 14.28 0 24.32 6.22 30.07 18.67 2.31 5.75 3.69 12.1 4.16 19.01h-39.42v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.73-24.19-23.51 0-42.29 7.94-56.36 23.85-14.29 16.36-21.43 38.84-21.43 67.41 0 61.08 27.55 91.62 82.63 91.62 26.5 0 49.2-9.34 68.11-28.01l-27.32-26.63zM636.42 183.61c0 19.13-7.37 33.88-22.13 44.25-13.83 9.68-31.92 14.52-54.28 14.52-33.88 0-59.46-8.65-76.75-25.92l29.39-29.39c11.29 11.29 27.31 16.94 48.06 16.94 21.21 0 31.8-6.23 31.8-18.67 0-9.91-6.33-15.45-19.01-16.59l-28.35-2.77c-35.03-3.46-52.55-20.28-52.55-50.47 0-17.97 7.03-32.27 21.08-42.87 12.91-9.68 29.05-14.53 48.4-14.53 30.89 0 53.81 7.03 68.79 21.08l-27.66 28c-8.98-8.06-22.92-12.1-41.83-12.09-17.05 0-25.58 5.77-25.58 17.29 0 9.21 6.23 14.4 18.67 15.56l28.35 2.76c35.74 3.47 53.6 21.09 53.6 52.9z"/><path d="M702.44 240.3c-17.06 0-30.31-5.42-39.76-16.24-8.3-9.45-12.44-21.2-12.44-35.26V99.6h-19.02V65.37h19.02V12.14h44.93v53.23h31.81V99.6h-31.81v86.43c0 10.84 5.19 16.25 15.56 16.25h16.26v38.03l-24.55-.01zM846.94 240.3v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.3-42.52-15.9-12.22-12.22-18.33-29.27-18.33-51.17V60.19h44.94v108.89c0 11.29 3.23 19.83 9.69 25.59 5.3 4.84 11.99 7.25 20.05 7.25 8.3 0 15.1-2.41 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V60.18h44.94l.01 180.11-43.91.01zM1014.58 109.27c-7.15-7.15-15.09-10.71-23.85-10.71-7.62 0-14.18 2.65-19.71 7.95-6.22 6.22-9.33 14.63-9.33 25.23V240.3h-44.94l-.01-180.11h43.91v17.29c10.84-12.91 25.93-19.37 45.29-19.37 17.05 0 31.22 5.65 42.52 16.94l-33.88 34.22zM1152.17 185.66c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.75-3.46-27.66-10.38-6.69-6.45-10.37-15.09-11.06-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.45-18.67 29.73-18.67 14.3 0 24.32 6.22 30.08 18.67 2.31 5.75 3.69 12.1 4.15 19.01h-39.41v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.74-24.19-23.51 0-42.29 7.94-56.34 23.85-14.3 16.36-21.43 38.84-21.43 67.41 0 61.08 27.54 91.62 82.62 91.62 26.5 0 49.21-9.34 68.11-28.01l-27.32-26.63zM270.27 180.11v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.31-42.52-15.91-12.22-12.22-18.32-29.26-18.32-51.16V0h44.94v108.89c0 11.29 3.22 19.82 9.67 25.59 5.31 4.83 11.99 7.26 20.05 7.26 8.3 0 15.1-2.43 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V0h44.94l.01 180.11h-43.9zM189.13 200.96h105.3c10.9 0 19.74 8.84 19.75 19.74V326c0 10.9-8.84 19.74-19.74 19.75h-105.3c-10.9 0-19.74-8.84-19.75-19.74v-105.3c-.01-10.91 8.83-19.75 19.74-19.75z"/></g></svg></div>
				<div class="h2 scroll-reveal">Just bring your bag.</div>
				<div class="h3 scroll-reveal position-relative inline js_no_to_landlords">
					Say no to landlords,<br class="show-for-medium hide-for-large"> brokers and PGs.
				</div>
				<div class="h4 strong scroll-reveal">Coliving flats in Electronic City.</div>
			</div>
		</div>
		<div class="points row">
			<div class="columns small-10 small-offset-1 large-3">
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-clock.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">10 min <br>
					Check-in</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-work.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left"><strong>STAY Packages</strong> for <br>
					1 day to 60 days</div>
				</div>
				<a href="#booking" class="point scroll-reveal pop">
					<div class="icon inline-middle"><img src="/media/icons/icon-house.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left text-light"><strong>LIVE Packages</strong> for <br>
					2 months to 7 years</div>
				</a>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-living.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Fully <br>
					Furnished</div>
				</div>
				<a href="#coworking-seat" class="point scroll-reveal pop">
					<div class="icon inline-middle"><img src="/media/icons/icon-coworking.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left text-light">Work From Home <br>
					Friendly <strong>#WFH</strong></div>
				</a>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-internet.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">High Speed <br>
					Internet</div>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 large-3 xlarge-offset-0">
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-women.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Women's only <br>
					Block</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-night.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">24x7 Lift and <br>
					Power Backup</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-housekeeping.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Hotel Style <br>
					Housekeeping</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-game.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Dedicated Gaming <br>
					and Chilling Areas</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-safe.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Round-the-clock <br>
					Security</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-meal.svg<?php echo $ver ?>"></div>
					<div class="text h6 inline-middle space-25-left">Fully Stocked <br>
					Cafeteria</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Intro Section -->


<!-- Covid Safe Strip -->
<section class="covid-safe-strip fill-yellow space-min-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1 clearfix">
				<img class="covid-safe-badge" src="/media/icons/icon-covid-safe.png<?php echo $ver ?>">
				<div class="message">
					<span class="h5 hide-for-small space-25-right inline-middle">How do we do this?</span>
					<a class="button inline-middle" target="_blank" href="/news/covid-19-precautions">Learn More</a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Covid Safe Strip -->


<!-- Booking Section -->
<section id="booking" class="booking-section space-150-top-bottom" data-section="Pricing Engine" data-section-id="pricing-engine"><?php // NOTE: 29/07/2020: The section descriptors say "Pricing Engine" because there's already a physical "Booking" page now ?>
	<div class="container">
		<div class="row">
			<div class="intro columns small-10 small-offset-1 js_location_selector_container">
				<div class="label text-neutral-3 text-uppercase space-min-bottom scroll-reveal">Location</div>
				<div class="h4 text-green-2 strong scroll-reveal">Coliving with like-minded people</div>
				<div class="h2 text-green-2 scroll-reveal">Guesture <span class="no-wrap js_place" style="text-transform: capitalize;">@Alta Vista</span></div>
				<div class="h4 text-green-2 strong inline hide-for-small scroll-reveal">in</div>
				<select class="inline minimal xl js_places_near_to scroll-reveal"><option>BLR - Electronic City Phase 1</option></select>
				<div class="space-min-top js_google_maps scroll-reveal" data-name="alta vista">
					<a href="https://goo.gl/maps/awWKyDwRoEPzcg8t9" target="_blank" class="h6 text-dark strong inline-middle"><img class="inline-middle" src="/media/glyph/24-maps.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
				</div>
				<div class="space-min-top js_google_maps hidden scroll-reveal" data-name="dwellington">
					<a href="https://goo.gl/maps/bHF68rUPVkUBXcBa8" target="_blank" class="h6 text-dark strong inline-middle"><img class="inline-middle" src="/media/glyph/24-maps.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
				</div>
			</div>
		</div>
	</div>
	<!-- Workplaces -->
	<div class="workplaces carousel block space-50-top-bottom js_workplaces js_carousel_container scroll-reveal" data-name="alta vista">
		<div class="carousel-list js_carousel_content">
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-hcl.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">9min</div>
						<div class="h6 strong text-neutral-2">to HCL Technologies</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-infosys.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">12min</div>
						<div class="h6 strong text-neutral-2">to Infosys Campus</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-velankani.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">10min</div>
						<div class="h6 strong text-neutral-2">to Velankani Campus</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-wipro.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">13min</div>
						<div class="h6 strong text-neutral-2">to WIPRO</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-biocon.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">15min</div>
						<div class="h6 strong text-neutral-2">to BioCon</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-hp.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">9min</div>
						<div class="h6 strong text-neutral-2">to Hewlett Packard</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-siemens.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">15min</div>
						<div class="h6 strong text-neutral-2">to Siemens</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-tata.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">17min</div>
						<div class="h6 strong text-neutral-2">to Tata BP Solar</div>
					</div>
				</div>
			</div>
		</div>
		<div class="scroll-controls">
			<div class="row">
				<div class="container">
					<div class="columns small-6">
						<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="/media/glyph/32-leftarrow.svg?v=20190917"></div>
					</div>
					<div class="columns small-6 text-right">
						<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="/media/glyph/32-rightarrow.svg?v=20190917"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="workplaces carousel block space-50-top-bottom hidden js_workplaces js_carousel_container scroll-reveal" data-name="dwellington">
		<div class="carousel-list js_carousel_content">
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-siemens.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">12min</div>
						<div class="h6 strong text-neutral-2">to Siemens</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-tata.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">6min</div>
						<div class="h6 strong text-neutral-2">to Tata Consultancy Services</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-techmahindra.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">10min</div>
						<div class="h6 strong text-neutral-2">to Tech Mahindra</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-infosys.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">12min</div>
						<div class="h6 strong text-neutral-2">to Infosys Campus</div>
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-biocon.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">10min</div>
						<div class="h6 strong text-neutral-2">to BioCon</div>
					</div>
				</div>
				<div class="workplace">
					<div class="image"><img class="block" src="/media/icons/icon-ge.svg<?php echo $ver ?>"></div>
					<div class="info">
						<div class="h4 strong">15min</div>
						<div class="h6 strong text-neutral-2">to GE Intelligent Platforms</div>
					</div>
				</div>
			</div>
		</div>
		<div class="scroll-controls">
			<div class="row">
				<div class="container">
					<div class="columns small-6">
						<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="/media/glyph/32-leftarrow.svg?v=20190917"></div>
					</div>
					<div class="columns small-6 text-right">
						<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="/media/glyph/32-rightarrow.svg?v=20190917"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End: Workplaces -->
	<!-- Pricing -->
	<div id="pricing" class="pricing js_carousel_container">
		<div class="pricing-list js_carousel_content">
			<div class="price fill-light js_carousel_item js_room_type js_trio_section scroll-reveal" data-room="Trio">
				<div class="character"><img class="block" src="/media/characters/pricing/trio-1.png<?php echo $ver ?>"></div>
				<div class="title block h3 strong text-light text-uppercase text-center">Trio</div>
				<div class="thumbnail">
					<div class="panorama-container">
						<iframe class="panorama js_panorama" src="" frameborder="0" loading="lazy"></iframe>
					</div>
					<img class="js_image">
				</div>
				<div class="intro space-min">
					<div class="heading h5 strong text-green-2 opacity-50 space-min-top">Triple Sharing room in a 2 or 3 Bedroom Flat.</div>
					<div class="description h6 text-green-2">Preferred by Students, Interns and Trainees living alone in Bangalore.</div>
				</div>
				<div class="config space-min">
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Balcony</div>
						<select class="minimal inline js_attribute js_balcony" data-name="balcony">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Bathroom</div>
						<select class="minimal inline js_attribute js_bathroom" data-name="bathroom">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Duration</div>
						<select class="minimal inline js_attribute js_duration" data-name="duration">
							<option>3 Months</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline alt-font">@</div>
						<select class="minimal inline js_attribute js_location" data-name="location">
							<option>Alta Vista - BLR</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">View</div>
						<select class="minimal inline js_attribute js_view" data-name="view">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">A/C</div>
						<select class="minimal inline js_attribute js_ac" data-name="a/c">
							<option>Non A/C Room</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">Smoking</div>
						<select class="minimal inline js_attribute js_smoking" data-name="smoking">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">Diet</div>
						<select class="minimal inline js_attribute js_diet" data-name="diet">
							<option>Not Particular</option>
						</select>
					</div>
				</div>
				<!-- <div class="action text-center space-25-top-bottom js_modal_trigger cursor-pointer" data-mod-id="what-is-included" data-package="trio" tabindex="-1;"> -->
				<div class="action text-center space-25-top-bottom">
					<div class="h4 action-title data strong text-uppercase"><span class="js_daily_expense">₹726 Per Day</span></div>
					<div class="h4 action-title-error strong text-uppercase">Ooops!</div>
					<div class="action-sub-title label strong text-uppercase text-neutral-3 js_monthly_expense">₹21800 Per Month</div>
					<div class="label action-sub-title-error strong text-uppercase text-red">No Rooms Found</div>
					<!-- <div class="included label inline strong text-uppercase" style="border-bottom: 1.5px var(--dark) solid;">What is included <img class="inline-top" width="14px" src="/media/glyph/question-dark.svg<?php echo $ver ?>"></div> -->
				</div>
				<label class="block space-min-bottom js_login_trigger_region">
					<span class="label inline text-neutral-1 text-uppercase invisible">Book</span>
					<button class="button block fill-green-2 js_book_trio">Package Details</button>
				</label>
				<form class="js_pricing_booking_form" style="display: none" onsubmit="event.preventDefault()">
					<div class="columns small-12 space-min-bottom" style="position: relative">
						<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
						<div class="phone-trap minimal phone-number">
							<div class="block prefix-group" style="position: relative">
								<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
									<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
								</select>
								<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
							</div>
							<input class="phone block js_form_input_phonenumber" type="text" name="phone-number">
							<label class="submit block">
								<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
								<button type="submit" class="button block">→</button>
							</label>
						</div>
					</div>
				</form>
			</div>
			<div class="price fill-green-2 js_carousel_item js_room_type js_buddy_section scroll-reveal" data-room="Buddy" style="--td: .25s; background: linear-gradient(45deg, var(--green-2) 60%, var(--yellow) 100%);">
				<div class="character"><img class="block" src="/media/characters/pricing/buddy-1.png<?php echo $ver ?>"></div>
				<div class="title block h3 strong text-light text-uppercase text-center">Buddy</div>
				<div class="thumbnail">
					<div class="panorama-container">
						<iframe class="panorama js_panorama" src="" frameborder="0" loading="lazy" data-hj-allow-iframe=""></iframe>
					</div>
					<img class="js_image">
				</div>
				<div class="intro space-min">
					<div class="heading h5 strong opacity-50 space-min-top">Twin Sharing room in a 2 or 3 Bedroom Flat.</div>
					<div class="description h6">Preferred by corporate professionals living alone in Bangalore.</div>
				</div>
				<div class="config space-min">
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Balcony</div>
						<select class="minimal dark inline js_attribute js_balcony" data-name="balcony">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Bathroom</div>
						<select class="minimal dark inline js_attribute js_bathroom" data-name="bathroom">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline">Duration</div>
						<select class="minimal dark inline js_attribute js_duration" data-name="duration">
							<option>3 Months</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong opacity-50 inline alt-font">@</div>
						<select class="minimal dark inline js_attribute js_location" data-name="location">
							<option>Alta Vista - BLR</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong opacity-50 inline">View</div>
						<select class="minimal dark inline js_attribute js_view" data-name="view">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong opacity-50 inline">A/C</div>
						<select class="minimal dark inline js_attribute js_ac" data-name="a/c">
							<option>Non A/C Room</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong opacity-50 inline">Smoking</div>
						<select class="minimal dark inline js_attribute js_smoking" data-name="smoking">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong opacity-50 inline">Diet</div>
						<select class="minimal dark inline js_attribute js_diet" data-name="diet">
							<option>Not Particular</option>
						</select>
					</div>
				</div>
				<!-- <div class="action text-center space-25-top-bottom js_modal_trigger cursor-pointer" data-mod-id="what-is-included" data-package="buddy" tabindex="-1"> -->
				<div class="action text-center space-25-top-bottom">
					<div class="h4 action-title data sparkle title-2-left title-2-right strong text-uppercase"><span class="js_daily_expense">₹726 Per Day</span><span class="spark-1"><?php include __DIR__ . '/../media/sparkle/title-2-left.svg'; ?></span><span class="spark-2"><?php include __DIR__ . '/../media/sparkle/title-2-right.svg'; ?></span></div>
					<div class="h4 action-title-error strong text-uppercase">Ooops!</div>
					<div class="action-sub-title label strong text-uppercase opacity-50 js_monthly_expense">₹21800 Per Month</div>
					<div class="label action-sub-title-error strong text-uppercase text-yellow">No Rooms Found</div>
					<!-- <div class="included label inline strong text-uppercase" style="border-bottom: 1.5px var(--light) solid;">What is included <img class="inline-top" width="14px" src="/media/glyph/question-light.svg<?php echo $ver ?>"></div> -->
				</div>
				<label class="block space-min-bottom js_login_trigger_region">
					<span class="label inline text-neutral-1 text-uppercase invisible">Book</span>
					<button class="button block js_book_buddy" data-product="Buddy" data-c="pricing-book-buddy">Package Details</button>
				</label>
				<form class="js_pricing_booking_form" style="display: none" onsubmit="event.preventDefault()">
					<div class="columns small-12 _medium-6 space-min-bottom" style="position: relative">
						<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
						<div class="phone-trap minimal phone-number">
							<div class="block prefix-group" style="position: relative">
								<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
									<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
								</select>
								<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
							</div>
							<input class="phone block js_form_input_phonenumber" type="text" name="phone-number">
							<label class="submit block">
								<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
								<button type="submit" class="button block">→</button>
							</label>
						</div>
					</div>
				</form>
			</div>
			<div class="price fill-light js_carousel_item js_room_type js_solo_section scroll-reveal" data-room="Solo" style="--td: .5s">
				<div class="character"><img class="block" src="/media/characters/pricing/solo-1.png<?php echo $ver ?>"></div>
				<div class="title block h3 strong text-light text-uppercase text-center">Solo</div>
				<div class="thumbnail">
					<div class="panorama-container">
						<iframe class="panorama js_panorama" src="" frameborder="0" loading="lazy"></iframe>
					</div>
					<img class="js_image">
				</div>
				<div class="intro space-min">
					<div class="heading h5 strong text-green-2 opacity-50 space-min-top">A Dedicated room in a 2 or 3 Bedroom Flat.</div>
					<div class="description h6 text-green-2">Preferred by Managers living alone in Bangalore, away from their family.</div>
				</div>
				<div class="config space-min">
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Balcony</div>
						<select class="minimal inline js_attribute js_balcony" data-name="balcony">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Bathroom</div>
						<select class="minimal inline js_attribute js_bathroom" data-name="bathroom">
							<option>Attached</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline">Duration</div>
						<select class="minimal inline js_attribute js_duration" data-name="duration">
							<option>3 Months</option>
						</select>
					</div>
					<div class="flex">
						<div class="h4 strong text-green-2 opacity-50 inline alt-font">@</div>
						<select class="minimal inline js_attribute js_location" data-name="location">
							<option>Alta Vista - BLR</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">View</div>
						<select class="minimal inline js_attribute js_view" data-name="view">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">A/C</div>
						<select class="minimal inline js_attribute js_ac" data-name="a/c">
							<option>Non A/C Room</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">Smoking</div>
						<select class="minimal inline js_attribute js_smoking" data-name="smoking">
							<option>Not Particular</option>
						</select>
					</div>
					<div class="flex hidden">
						<div class="h4 strong text-green-2 opacity-50 inline">Diet</div>
						<select class="minimal inline js_attribute js_diet" data-name="diet">
							<option>Not Particular</option>
						</select>
					</div>
				</div>
				<!-- <div class="action text-center space-25-top-bottom js_modal_trigger cursor-pointer" data-mod-id="what-is-included" data-package="solo" tabindex="-1"> -->
				<div class="action text-center space-25-top-bottom">
					<div class="h4 action-title data strong text-dark text-uppercase"><span class="js_daily_expense">₹726 Per Day</span></div>
					<div class="h4 action-title-error strong text-dark text-uppercase">Ooops!</div>
					<div class="action-sub-title label strong text-neutral-3 text-uppercase js_monthly_expense">₹21800 Per Month</div>
					<div class="label action-sub-title-error strong text-red text-uppercase">No Rooms Found</div>
					<!-- <div class="included label inline strong text-uppercase" style="border-bottom: 1.5px var(--dark) solid;">What is included <img class="inline-top" width="14px" src="/media/glyph/question-dark.svg<?php echo $ver ?>"></div> -->
				</div>
				<label class="block space-min-bottom js_login_trigger_region">
					<span class="label inline text-neutral-1 text-uppercase invisible">Book</span>
					<button class="button block fill-green-2 js_book_solo" data-product="Solo" data-c="pricing-book-solo">Package Details</button>
				</label>
				<form class="js_pricing_booking_form" style="display: none" onsubmit="event.preventDefault()">
					<div class="columns small-12 _medium-6 space-min-bottom" style="position: relative">
						<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
						<div class="phone-trap minimal phone-number">
							<div class="block prefix-group" style="position: relative">
								<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
									<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
								</select>
								<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
							</div>
							<input class="phone block js_form_input_phonenumber" type="text" name="phone-number">
							<label class="submit block">
								<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
								<button type="submit" class="button block">→</button>
							</label>
						</div>
					</div>
				</form>
			</div>
		</div>
		<div class="scroll-controls">
			<div class="row">
				<div class="container">
					<div class="columns small-6">
						<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="/media/glyph/32-leftarrow.svg?v=20190917"></div>
					</div>
					<div class="columns small-6 text-right">
						<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="/media/glyph/32-rightarrow.svg?v=20190917"></div>
					</div>
				</div>
			</div>
		</div>
		<div class="icon-lamp" style="opacity: 0;"><?php include __DIR__ . '/../media/icons/icon-lamp.svg'; ?></div>
		<div class="irina-label block small text-center text-neutral-3 text-uppercase scroll-reveal" style="--td: .25s;">
			<!-- Guesture is a brand of Irina Hospitality PVT LTD<br> -->
			<img width="100" src="/media/logo-powered-by-paytm.svg<?php echo $ver ?>" style="width: 100px;">
		</div>
	</div>
	<!-- End: Pricing -->
	<div class="container">
		<div class="row">
			<div class="checkin columns small-10 small-offset-1 space-150-top">
				<div class="label text-neutral-3 text-uppercase space-min-bottom scroll-reveal">Check-in</div>
				<div class="h3 strong text-green-2 space-min-bottom scroll-reveal">10 Minute Check-in</div>
				<div class="h4 text-neutral-3 scroll-reveal">Just carry the <span class="strong text-green-2 sparkle title-3-left title-3-right scroll-reveal pop"> 3 mandatory KYC documents<span class="spark-1"><?php include __DIR__ . '/../media/sparkle/title-3-left.svg'; ?></span><span class="spark-2"><?php include __DIR__ . '/../media/sparkle/title-3-right.svg'; ?></span></span> for a quick check-in.</div>
			</div>
			<div class="checkin columns small-10 small-offset-1 space-25-top">
				<a href="/kyc-policy" target="_blank" class="button strong text-uppercase scroll-reveal">Read the Full KYC Policy ››</a>
			</div>
		</div>
		<div class="row <?php if ( empty( $deals ) ) echo 'hidden' ?>">
			<div class="deal-title columns small-10 small-offset-1 xlarge-9 space-100-top space-min-bottom">
				<div class="h2 text-green-2 scroll-reveal">Deals</div>
			</div>
		</div>
	</div>
	<!-- Deal -->
	<div class="deal-carousel card-carousel js_carousel_container js_deals scroll-reveal <?php if ( empty( $deals ) ) echo 'hidden' ?>">
		<div class="deal-list card-list js_carousel_content">
			<?php foreach ( $deals as $index => $deal ) : ?>
				<div class="deal card <?= $deal->get( 'deal_is_card_dark' ) ? 'dark' : '' ?> fill-light js_carousel_item js_deal qpid_login_site">
					<!-- Thumbnail -->
					<div class="thumbnail" style="background-image: url( '<?= $deal->get( 'deal_image / sizes / medium' ) ?>"></div>
					<div class="info">
						<!-- Title -->
						<div class="title h4"><?= $deal->get( 'post_title' ) ?></div>
						<!-- Timer -->
						<div class="timer label strong js_countdown" data-date="<?= $deal->get( 'expiryDateISOString' ) ?>"><span class="h6 inline-middle">⚡</span>Flash Deal Ends: <?= $deal->get( 'timeRemaining' ) ?></div>
						<!-- Action -->
						<div class="action row">
							<!-- Phone Trap Trigger -->
							<label class="phone-trap-trigger columns small-12 js_login_trigger_region space-min-bottom">
								<span class="invisible label inline text-neutral-1 text-uppercase">Book Now</span>
								<button class="button block js_get_deal" id="deal<?= $index + 1 ?>" data-deal="<?= $deal->get( 'post_title' ) ?>" data-c="deal">Get Deal</button>
							</label>
							<?php require __ROOT__ . '/pages/snippets/login-prompt.php'; ?>
						</div>
					</div>
				</div>
			<?php endforeach; ?>
		</div>
		<div class="scroll-controls">
			<div class="row">
				<div class="container">
					<div class="columns small-6">
						<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="/media/glyph/32-leftarrow.svg?v=20190917"></div>
					</div>
					<div class="columns small-6 text-right">
						<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="/media/glyph/32-rightarrow.svg?v=20190917"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End: Deal -->
	<div class="container">
		<div class="row">
			<div id="contact" class="contact columns small-10 small-offset-1 space-75-top space-25-bottom">
				<div class="label text-neutral-3 text-uppercase space-min-bottom scroll-reveal">Contact-us</div>
				<div class="h2 text-green-2 scroll-reveal">Request a <span class="no-wrap">call-back</span></div>
			</div>
			<div class="contact columns small-10 small-offset-1 large-8">
				<div class="contact-form row space-100-bottom js_contact_form_section scroll-reveal">
					<form class="js_contact_form" onsubmit="event.preventDefault()">
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="label inline text-neutral-3 text-uppercase">Full Name</span>
								<input class="name block js_form_input_name" type="text" name="name">
							</label>
						</div>
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="label inline text-neutral-3 text-uppercase">Email Id</span>
								<input class="email block js_form_input_email" type="text" name="email-address">
							</label>
						</div>
						<div class="form-row columns small-12 medium-6" style="position: relative">
							<label><span class="label inline text-neutral-3 text-uppercase">Mobile Number</span></label>
							<div class="phone-trap phone-number">
								<div class="inline prefix-group" style="position: relative">
									<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
										<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
									</select>
									<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
								</div>
								<input class="phone block js_form_input_phonenumber" type="text" name="phone-number">
							</div>
						</div>
						<div class="form-row columns small-12 medium-6">
							<label>
								<span class="invisible label inline text-neutral-3 text-uppercase">Submit</span>
								<button class="block" type="submit">Contact</button>
							</label>
						</div>
					</form>
				</div>
				<a href="tel:+91-82877-70011" class="h3 strong inline scroll-reveal pop"><span class="sparkle or-light h5 strong text-green-2 text-uppercase">or<span class="spark-1"><?php include __DIR__ . '/../media/sparkle/or-light.svg'; ?></span></span> Call us on <span class="sparkle or-number-light text-green-2 no-wrap">+91-828-7770011<span class="spark-1"><?php include __DIR__ . '/../media/sparkle/or-number-light.svg'; ?></span></span></a>
				<div class="rhai space-100-top">
					<div class="h4 strong text-uppercase space-min-bottom">Member of the</div>
					<a class="inline" href="https://rhai.org" target="_blank"><img src="/media/logo-rhai.png<?php echo $ver ?>"></a>
					<div class="h5 space-min-top">Rental Housing Association of India</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Booking Section -->



<!-- Coworking Section -->
<section class="coworking--trap-section fill-yellow js_coworking_seat_section" id="coworking-seat" data-section="Coworking Seat" data-section-id="coworking-seat">
	<div class="container">
		<div class="character scroll-reveal"><img src="/media/characters/coworking-trap/char-1.png<?php echo $ver ?>"></div>
		<div class="trap row space-150-top-bottom">
			<div class="columns small-10 small-offset-1 large-8 space-50-top-bottom">
				<div class="h3 strong">
					<span class="opacity-75">Work from home </span><span class="sparkle title-2-left title-2-right scroll-reveal pop">Friendly. <span class="spark-1"><?php include __DIR__ . '/../media/sparkle/title-2-left-dark.svg'; ?></span><span class="spark-2"><?php include __DIR__ . '/../media/sparkle/title-2-right-dark.svg'; ?></span></span><br class="show-for-large"><span class="opacity-75">Live and work in the same building.</span>
				</div>
				<div class="points space-25-top">
					<div class="point label inline text-uppercase space-min-bottom scroll-reveal pop">High speed internet connectivity.</div><br>
					<div class="point label inline text-uppercase space-min-bottom scroll-reveal pop">Opt for a dedicated workstation in your 'Solo' room.</div><br>
					<div class="point label inline text-uppercase space-min-bottom scroll-reveal pop">Or stay with a 'Buddy' and book an optional coworking seat for ₹4500*.</div><br>
					<div class="point label inline text-uppercase space-min-bottom scroll-reveal pop">While your office might be in Whitefield, you can #WFH with like-minded people.</div>
				</div>
				<div class="small opacity-50 space-25-bottom scroll-reveal">* monthly rate</div>
				<div class="h0 text-shadow text-red space-min-bottom scroll-reveal">#WFH</div>
				<div class="action row scroll-reveal">
					<!-- Phone Trap Trigger -->
					<label class="phone-trap-trigger columns small-12 medium-6 large-4">
						<span class="invisible label inline text-neutral-1 text-uppercase">Enquire Now</span>
						<button class="button block js_enquire_coworking_seat">Enquire Now</button>
					</label>
					<br>
					<form class="js_coworking_form" style="display: none" onsubmit="event.preventDefault()">
						<div class="columns small-12 medium-6" style="position: relative">
							<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
							<div class="phone-trap minimal phone-number">
								<div class="block prefix-group" style="position: relative">
									<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
										<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
									</select>
									<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
								</div>
								<input class="phone block js_form_input_phonenumber" type="text" name="phone-number">
								<label class="submit block">
									<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
									<button type="submit" class="button block">→</button>
								</label>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Coworking Section -->



<!-- Live Section -->
<section class="live-section space-150-top-bottom" data-section="Environment" data-section-id="environment">
	<div class="container">
		<div class="intro row">
			<div class="columns small-10 small-offset-1 large-6">
				<div class="h2 text-green-2 space-min-bottom scroll-reveal">The Environment at Guesture</div>
				<div class="h3 text-neutral-5 space-min-bottom scroll-reveal">we built cultural spaces into your environment.</div>
			</div>
			<div class="description columns small-10 small-offset-1 medium-8 large-7 xlarge-6 space-50-bottom scroll-reveal">
				<div class="h5 text-green-2 strong space-min-bottom">Urban living often forces people to abandon their passions & interests.</div>
				<div class="h6 text-neutral-4">The environment at Guesture is designed and built to provide interaction spaces, spaces for yoga and meditation, studio and amphitheater spaces for cultural activities, coworking spaces for working, sports areas for pursuing fitness and sports interests, and an overall sustainable system which does not hurt nature or the environment.</div>
			</div>
		</div>
		<div class="amenities points row space-50-bottom">
			<div class="columns small-10 small-offset-1 medium-5 large-3">
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-pool.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Swimming Pool</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-gym.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Gymnasium</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-amphitheater.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Amphitheater</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-tabletennis.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Table Tennis</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-tennis.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Tennis Courts</div>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-5 medium-offset-0 large-3 large-offset-1 xlarge-offset-0">
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-yoga.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Yoga Hall</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-snooker.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Snooker Tables</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-laundry.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Laundry</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-meditation.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Meditation Hall</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-openairscreen.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Open Air Screen</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Sliding Gallery -->
	<div class="sliding-gallery block js_sliding_gallery">
		<div class="container-track">
			<div class="track js_track">
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7261.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7140.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6519.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/av-solo-B.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6875.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7181.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7190.jpg' )">
				</div>
			</div>
		</div>
		<div class="container-track">
			<div class="track js_track">
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6686.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6988.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7057.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6541.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6968.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6595.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6703.jpg' )">
				</div>
			</div>
		</div>
		<div class="container-track">
			<div class="track js_track">
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6838.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6880.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7102.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7009.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A7493.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/dw-buddy-B.jpg' )">
				</div>
				<div class="image bg-image" style="background-image: url( 'media/sliding-gallery/5K8A6581.jpg' )">
				</div>
			</div>
		</div>
	</div>
	<!-- END: Sliding Gallery -->
	<div class="container">
		<div class="amenities points row space-50-top">
			<div class="columns small-10 small-offset-1 medium-5 large-3">
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-basketball.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Basket Ball Court</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-bowling.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Outdoor Bowling Alley</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-football.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Mini Football Courts</div>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 medium-5 medium-offset-0 large-3 large-offset-1 xlarge-offset-0">
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-doctor.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Doctor on-call</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-shuttle.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Shuttle Bus Service</div>
				</div>
				<div class="point scroll-reveal">
					<div class="icon inline-middle"><img src="/media/icons/icon-canteen.svg<?php echo $ver ?>"></div>
					<div class="text h6 text-green-2 inline-middle space-25-left">Cafeteria</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Live Section -->


<!-- Womens Block : Trap Section -->
<section class="womens-block--trap-section fill-yellow js_women_block_section" data-section="Women's Block" data-section-id="womens-block">
	<div class="container">
		<div class="character scroll-reveal"><img src="/media/characters/women-trap/char-1.png<?php echo $ver ?>"></div>
		<div class="trap row space-150-top-bottom">
			<div class="columns small-10 small-offset-1 xlarge-9 space-50-top-bottom">
				<div class="h3 strong"><span class="opacity-75">Peace of mind for you and </span><span class="sparkle title-2-left title-2-right scroll-reveal pop">your parents<span class="spark-1"><?php include __DIR__ . '/../media/sparkle/title-2-left-dark.svg'; ?></span><span class="spark-2"><?php include __DIR__ . '/../media/sparkle/title-2-right-dark.svg'; ?></span></span></div>
				<div class="h0 text-shadow text-yellow space-25-bottom scroll-reveal">women's only block</div>
				<div class="action row scroll-reveal">
					<!-- Phone Trap Trigger -->
					<label class="phone-trap-trigger columns small-12 medium-6 large-4">
						<span class="invisible label inline text-neutral-4 text-uppercase">Book Now</span>
						<button class="button block js_book_womens_block">Book Now</button>
					</label>
					<br>
					<!-- Phone Trap form -->
					<form class="js_womens_block_form" style="display: none" onsubmit="event.preventDefault()">
						<div class="columns small-12 medium-6" style="position: relative">
							<label><span class="label inline text-neutral-4 text-uppercase">Mobile Number</span></label>
							<div class="phone-trap minimal phone-number">
								<div class="block prefix-group" style="position: relative">
									<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
										<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
									</select>
									<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
								</div>
								<input class="phone block js_form_input_phonenumber" type="text" name="phone-number">
								<label class="submit block">
									<span class="hidden label inline text-neutral-4 text-uppercase">Submit</span>
									<button type="submit" class="button block">→</button>
								</label>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Womens Block : Trap Section -->


<!-- Testimonial Section -->
<section class="testimonial-section space-150-top-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1 large-7">
				<div class="h2 text-green-2 scroll-reveal">Coliving with <br>like-minded people</div>
			</div>
			<div class="columns small-10 small-offset-1 large-6 xlarge-5">
				<div class="h3 scroll-reveal">CoLiving is more than just shared living spaces.</div>
			</div>
		</div>
	</div>
	<!-- Testimonials -->
	<div class="testimonials carousel block space-50-top-bottom js_carousel_container scroll-reveal" data-section="Testimonials" data-section-id="testimonials">
		<div class="carousel-list js_carousel_content">
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/vibha.jpg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Dr Vibha</div>
						<div class="designation label text-uppercase">MD Swajal Water</div>
						<div class="quote label text-neutral-4 space-min-top">We had a very nice stay here. The staff is quite courteous and room are quite neat and clean.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/saira.png<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Saira Philipose</div>
						<div class="designation label text-uppercase">Operations Senior Manager, Common Purpose Africa</div>
						<div class="quote label text-neutral-4 space-min-top">I have absolutely no words to express our gratitude and secondly the diligence, sincerity and commitment of the entire team of Ms.Radhika, Ms.Suryam, Aneetha and the warden, they were all fantastic! The room was well stocked, clean and new. Much thanks.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/nitin.jpeg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Nitin Gupta</div>
						<div class="designation label text-uppercase">Founder at Sickle Innovations</div>
						<div class="quote label text-neutral-4 space-min-top">The place is very nice and comfortable. I was given all the information prior with details. Reception table officials were very helpful. Enjoyed every minute here.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/elsbeth.jpeg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Elsbeth Dixon</div>
						<div class="designation label text-uppercase">Chief Executive, Common Purpose Africa</div>
						<div class="quote label text-neutral-4 space-min-top">What a wonderful home away from home. The Common Purpose Africa Venture participants deeply appreciate your flexibility in making accommodation available to us at such late notice and coping with our often midnight arrival. We are so grateful and admiring of your professionalism and helpfulness.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/sachin.jpg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Sachin Dubey</div>
						<div class="designation label text-uppercase">CEO and Cofounder, Module Innovation</div>
						<div class="quote label text-neutral-4 space-min-top">Wonderful Stay. Nice Hospitality. Would love to stay again.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/uttam.png<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Uttam Banerjee</div>
						<div class="designation label text-uppercase">CEO at Ekam Eco Solutions</div>
						<div class="quote label text-neutral-4 space-min-top">Great experience and awesome hospitality. Mr.Sharan and his team were always available for any kind of help. Wish you guys all the best. Thank you :)</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
			</div>
			<div class="carousel-list-item js_carousel_item">
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/ashutosh.png<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Ashutosh Joshi</div>
						<div class="designation label text-uppercase">Founder Member, JSR Innovative</div>
						<div class="quote label text-neutral-4 space-min-top">Good stay in a nice and clean apartment. Thank you.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
				<div class="testimonial">
					<div class="image" style="background-image: url('media/testimonials/rocky.jpeg<?php echo $ver ?>');"></div>
					<div class="info">
						<div class="name h5 text-green-2 strong">Rocky Hatiskar</div>
						<div class="designation label text-uppercase">COO Greensole</div>
						<div class="quote label text-neutral-4 space-min-top">Amazing property. But the USP remains the staff. Very jovial, friendly and at your service always. I would specially like to thanks Mr.Sharan for his lovely hospitality. Cheers.</div>
						<!-- <div class="duration label text-green-2 space-min-top">Guestureite For: 3 Months and Counting</div> -->
					</div>
				</div>
			</div>
		</div>
		<div class="scroll-controls">
			<div class="row">
				<div class="container">
					<div class="columns small-6">
						<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="/media/glyph/32-leftarrow.svg?v=20190917"></div>
					</div>
					<div class="columns small-6 text-right">
						<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="/media/glyph/32-rightarrow.svg?v=20190917"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End: Testimonials -->
	<div class="container">
		<div class="row">
			<div class="description columns small-10 small-offset-1 medium-9 large-7 xlarge-6 scroll-reveal">
				<div class="h5 text-green-2 strong space-min-bottom">It is a combination of privacy, safety and opportunities for interaction and self-discovery.</div>
				<div class="h6">Guesture is a unique approach to solving the problem of the high cost of living in cities, without compromising on comfort and safety. Coliving at Guesture gives you shared living spaces with the same level of amenities as service apartments, but optimized resources, hence lower costs.</div>
			</div>
		</div>
		<div class="row <?php if ( empty( $events ) ) echo 'hidden' ?>">
			<div class="deal-title columns small-10 small-offset-1 xlarge-9 space-100-top space-min-bottom">
				<div class="h2 text-green-2 scroll-reveal">Events</div>
			</div>
		</div>
	</div>
	<!-- Event -->
	<div class="event-carousel card-carousel js_carousel_container scroll-reveal <?php if ( empty( $events ) ) echo 'hidden' ?>" data-section="Events" data-section-id="events">
		<div class="event-list card-list js_carousel_content">
			<?php foreach ( $events as $event ) : ?>
				<a class="event card fill-light <?php if ( $event->get( 'isBeforeToday' ) ) echo 'opacity-50' ?> js_carousel_item" target="_blank" href="<?= $event->get( 'event_external_link' ) ?: $event->get( 'permalink' ) ?>">
					<!-- Thumbnail -->
					<div class="thumbnail" style="background-image: url( '<?= $event->get( 'event_featured_image / sizes / medium' ) ?>' );"></div>
					<div class="info">
						<div class="inline date h5 text-uppercase"><span class="h3 inline" style="line-height: 0.7;"><?= $event->get( 'event_date' )->format( 'd' ) ?></span><br><?= $event->get( 'event_date' )->format( 'M' ) ?></div>
						<!-- Tag -->
						<div class="inline tag label strong text-uppercase text-neutral-3"><?= $event->get( 'event_tag' ) ?></div>
						<!-- Title -->
						<div class="title h4"><?= $event->get( 'post_title' ) ?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="scroll-controls">
			<div class="row">
				<div class="container">
					<div class="columns small-6">
						<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="/media/glyph/32-leftarrow.svg?v=20190917"></div>
					</div>
					<div class="columns small-6 text-right">
						<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="/media/glyph/32-rightarrow.svg?v=20190917"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- End: Event -->
</section>
<!-- END: Testimonial Section -->


<!-- Trial : Trap Section -->
<section id="trial" class="trial--trap-section fill-green-2 js_trial_section qpid_login_site" data-section="Trial" data-section-id="trial">
	<div class="container">
		<div class="character scroll-reveal"><img src="/media/characters/trial-trap/char-1.png<?php echo $ver ?>"></div>
		<div class="trap row space-150-top-bottom">
			<div class="columns small-10 small-offset-1 medium-6 large-10">
				<div class="h3 strong scroll-reveal"><span class="opacity-50">Book a </span><span class="sparkle title-1-left title-1-right scroll-reveal pop">3 Day Trial<span class="spark-1"><?php include __DIR__ . '/../media/sparkle/title-1-left.svg'; ?></span><span class="spark-2"><?php include __DIR__ . '/../media/sparkle/title-1-right.svg'; ?></span></span><span class="opacity-50"> online today</span></div>
				<div class="h4 space-25-bottom scroll-reveal">Come experience <span class="no-wrap">like-minded</span> coliving.</div>
				<div class="points">
					<div class="point label inline text-uppercase space-min-bottom scroll-reveal pop">3 days and 2 nights</div><br>
					<div class="point label inline text-uppercase space-min-bottom scroll-reveal pop">Money back guarantee *</div>
				</div>
				<div class="small opacity-50 scroll-reveal">* If cancelled within 36 hours of check-in</div>
			</div>
			<div class="columns small-10 small-offset-1 scroll-reveal">
				<div class="h0 text-shadow text-green-2 space-25-top">₹1199</div>
			</div>
			<div class="columns small-10 small-offset-1 scroll-reveal">
				<div class="action row">
					<!-- Phone Trap Trigger -->
					<label class="phone-trap-trigger columns small-12 medium-6 large-4 js_login_trigger_region">
						<span class="invisible label inline text-neutral-1 text-uppercase">Book Now</span>
						<button class="button block js_book_trial" data-c="three-day-trial">Book Now</button>
					</label>
					<br>
					<form class="js_the_trial_form" style="display: none" onsubmit="event.preventDefault()">
						<div class="columns small-12 medium-6" style="position: relative">
							<label><span class="label inline text-neutral-1 text-uppercase">Mobile Number</span></label>
							<div class="phone-trap minimal phone-number">
								<div class="block prefix-group" style="position: relative">
									<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
										<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
									</select>
									<input class="prefix js_phone_country_code_label button" value="+91" style="pointer-events: none; width: 100%;">
								</div>
								<input class="phone block js_form_input_phonenumber" type="text" name="phone-number">
								<label class="submit block">
									<span class="hidden label inline text-neutral-1 text-uppercase">Submit</span>
									<button type="submit" class="button block">→</button>
								</label>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Trial : Trap Section -->


<!-- Address Section -->
<section class="address-section fill-green-2 space-100-top-bottom" data-section="Location" data-section-id="location">
	<div class="container">
		<div class="row">
			<div class="columns small-10 small-offset-1">
				<div class="h0 text-shadow text-neutral-5 scroll-reveal">location</div>
				<div class="addresses row">
					<div class="address columns medium-6 large-4 space-50-top space-75-right scroll-reveal" style="--td: .25s">
						<div class="h3 name">Alta Vista</div>
						<div class="label strong text-uppercase opacity-50">BLR - Electronic City Phase 1</div>
						<div class="h6 space-min-top-bottom">Shanders Alta Vista, Veer Sandra, Electronic City, Bengaluru, Karnataka 560100</div>
						<div class="space-min-bottom">
							<a href="https://goo.gl/maps/awWKyDwRoEPzcg8t9" target="_blank" class="h6 text-light strong inline-middle"><img class="inline-middle" src="/media/glyph/24-maps-light.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
						</div>
						<div class="points space-25-bottom opacity-50">
							<div class="point label strong text-uppercase">Solo Live Package</div>
							<div class="point label strong text-uppercase">Buddy Live Package</div>
							<div class="point label strong text-uppercase">Short Stay Package</div>
						</div>
						<a class="inline button fill-green-2" href="#contact">Enquire Now</a>
					</div>
					<div class="address columns medium-6 large-4 space-50-top space-75-right scroll-reveal" style="--td: .5s">
						<div class="h3 name">Dwellington</div>
						<div class="label strong text-uppercase opacity-50">BLR - Electronic City Phase 2</div>
						<div class="h6 space-min-top-bottom">Shanthi Pura, Electronic City Phase 2, Bhovi Palya, Bengaluru, Karnataka 560100</div>
						<div class="space-min-bottom">
							<a href="https://goo.gl/maps/bHF68rUPVkUBXcBa8" target="_blank" class="h6 text-light strong inline-middle"><img class="inline-middle" src="/media/glyph/24-maps-light.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
						</div>
						<div class="points space-25-bottom opacity-50">
							<div class="point label strong text-uppercase">Trio Live Package</div>
							<div class="point label strong text-uppercase">Short Stay Package</div>
						</div>
						<a class="inline button fill-green-2" href="#contact">Enquire Now</a>
					</div>
					<div class="address columns medium-6 large-4 space-50-top space-75-right scroll-reveal" style="--td: .75s">
						<div class="h3 name">Enclave</div>
						<div class="label strong text-uppercase opacity-50">BLR - Electronic City Phase 2</div>
						<div class="h6 space-min-top-bottom">Electronic City Phase 2, Electronic City, Bhovi Palya, Bengaluru, Karnataka 560099</div>
						<div class="points space-25-bottom opacity-50">
						</div>
						<a class="inline button no-pointer fill-neutral-5" href="#contact">Coming Soon</a>
					</div>
				</div>
				<div class="space-100-top">
					<a href="tel:+91-82877-70011" class="h3 strong inline scroll-reveal pop"><span class="sparkle or-dark h5 strong text-yellow text-uppercase">or<span class="spark-1"><?php include __DIR__ . '/../media/sparkle/or-dark.svg'; ?></span></span> Call us on <span class="sparkle or-number-dark text-yellow no-wrap">+91-828-7770011<span class="spark-1"><?php include __DIR__ . '/../media/sparkle/or-number-dark.svg'; ?></span></span></a>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- END: Address Section -->


<!-- News Section -->
<section class="news-section space-150-top-bottom">
	<div class="container <?php if ( empty( $news ) ) echo 'hidden' ?>">
		<div class="row">
			<div class="deal-title columns small-10 small-offset-1 xlarge-9 space-min-bottom">
				<div class="h2 text-green-2 scroll-reveal">News</div>
			</div>
		</div>
	</div>
	<!-- News -->
	<div class="news-carousel card-carousel js_carousel_container scroll-reveal <?php if ( empty( $news ) ) echo 'hidden' ?>" data-section="News" data-section-id="news">
		<div class="news-list card-list js_carousel_content">
			<?php foreach ( $news as $newsPiece ) : ?>
				<a class="news card fill-light js_carousel_item" href="<?= $newsPiece->get( 'news_source_link / url' ) ?: $newsPiece->get( 'permalink' ) ?>" target="_blank">
					<!-- Thumbnail -->
					<div class="thumbnail" style="background-image: url( '<?= $newsPiece->get( 'news_featured_image / sizes / medium' ) ?>"></div>
					<div class="info">
						<!-- Source -->
						<div class="source label strong text-uppercase space-min-bottom"><div class="favicon inline-middle" style="margin-right: 5px;"><img src="<?= $newsPiece->get( 'news_source_favicon / url' ) ?? '/media/favicon/favicon-16x16.png' ?>"></div> <?= $newsPiece->get( 'news_source_name' ) ?></div>
						<!-- Title -->
						<div class="title h5"><?= $newsPiece->get( 'post_title' ) ?></div>
					</div>
				</a>
			<?php endforeach; ?>
		</div>
		<div class="scroll-controls">
			<div class="row">
				<div class="container">
					<div class="columns small-6">
						<div class="scroll-button button fill-green-2 scroll-left unselectable js_pager" data-dir="left" tabindex="-1"><img src="/media/glyph/32-leftarrow.svg?v=20190917"></div>
					</div>
					<div class="columns small-6 text-right">
						<div class="scroll-button button fill-green-2 scroll-right unselectable js_pager" data-dir="right" tabindex="-1"><img src="/media/glyph/32-rightarrow.svg?v=20190917"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End: News Section -->


<!-- About Section -->
<section class="about-section space-150-bottom">
	<div class="container" data-section="About" data-section-id="about">
		<div class="row">
			<div class="columns small-10 small-offset-1">
				<div class="title h0 text-shadow text-light space-50-bottom scroll-reveal">the <svg class="inline-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1190 350" style="-webkit-filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25)); filter: drop-shadow(0px 2px 3px rgba(0,0,0,0.25)) drop-shadow(0px 2px 8px rgba(0,0,0,0.25));"><text style="opacity: 0;">Guesture</text><path fill="#FFF" d="M104.06 231.68c0 10.6-2.76 19.13-8.29 25.58-6.22 7.83-15.56 11.76-28 11.76-14.06 0-25.82-4.61-35.26-13.84l-28 28.35c16.13 15.68 37.92 23.51 65.33 23.51 23.74 0 42.98-7.03 57.74-21.09 14.06-13.83 21.09-31.69 21.08-53.59V59.15h-43.21V76.1c-11.54-12.67-26.17-19-43.92-19-18.21 0-32.62 5.3-43.21 15.91C6.1 85.21 0 108.95 0 144.21c0 35.5 6.1 59.24 18.32 71.22 10.6 10.61 24.89 15.91 42.86 15.91 4.61 0 8.99-.35 13.13-1.03v-39.07c-11.98-.23-20.28-5.19-24.88-14.86-3.01-6.69-4.49-17.41-4.49-32.16 0-14.74 1.49-25.58 4.49-32.5 4.6-9.44 12.9-14.16 24.88-14.16 11.99 0 20.29 4.72 24.89 14.16 3.23 6.92 4.84 17.76 4.84 32.5l.02 87.46zM449.41 185.68c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.74-3.46-27.66-10.38-6.68-6.45-10.37-15.09-11.05-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.44-18.67 29.73-18.67 14.28 0 24.32 6.22 30.07 18.67 2.31 5.75 3.69 12.1 4.16 19.01h-39.42v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.73-24.19-23.51 0-42.29 7.94-56.36 23.85-14.29 16.36-21.43 38.84-21.43 67.41 0 61.08 27.55 91.62 82.63 91.62 26.5 0 49.2-9.34 68.11-28.01l-27.32-26.63zM636.42 183.61c0 19.13-7.37 33.88-22.13 44.25-13.83 9.68-31.92 14.52-54.28 14.52-33.88 0-59.46-8.65-76.75-25.92l29.39-29.39c11.29 11.29 27.31 16.94 48.06 16.94 21.21 0 31.8-6.23 31.8-18.67 0-9.91-6.33-15.45-19.01-16.59l-28.35-2.77c-35.03-3.46-52.55-20.28-52.55-50.47 0-17.97 7.03-32.27 21.08-42.87 12.91-9.68 29.05-14.53 48.4-14.53 30.89 0 53.81 7.03 68.79 21.08l-27.66 28c-8.98-8.06-22.92-12.1-41.83-12.09-17.05 0-25.58 5.77-25.58 17.29 0 9.21 6.23 14.4 18.67 15.56l28.35 2.76c35.74 3.47 53.6 21.09 53.6 52.9z"/><path fill="#FFF" d="M702.44 240.3c-17.06 0-30.31-5.42-39.76-16.24-8.3-9.45-12.44-21.2-12.44-35.26V99.6h-19.02V65.37h19.02V12.14h44.93v53.23h31.81V99.6h-31.81v86.43c0 10.84 5.19 16.25 15.56 16.25h16.26v38.03l-24.55-.01zM846.94 240.3v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.3-42.52-15.9-12.22-12.22-18.33-29.27-18.33-51.17V60.19h44.94v108.89c0 11.29 3.23 19.83 9.69 25.59 5.3 4.84 11.99 7.25 20.05 7.25 8.3 0 15.1-2.41 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V60.18h44.94l.01 180.11-43.91.01zM1014.58 109.27c-7.15-7.15-15.09-10.71-23.85-10.71-7.62 0-14.18 2.65-19.71 7.95-6.22 6.22-9.33 14.63-9.33 25.23V240.3h-44.94l-.01-180.11h43.91v17.29c10.84-12.91 25.93-19.37 45.29-19.37 17.05 0 31.22 5.65 42.52 16.94l-33.88 34.22zM1152.17 185.66c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.75-3.46-27.66-10.38-6.69-6.45-10.37-15.09-11.06-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.45-18.67 29.73-18.67 14.3 0 24.32 6.22 30.08 18.67 2.31 5.75 3.69 12.1 4.15 19.01h-39.41v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.74-24.19-23.51 0-42.29 7.94-56.34 23.85-14.3 16.36-21.43 38.84-21.43 67.41 0 61.08 27.54 91.62 82.62 91.62 26.5 0 49.21-9.34 68.11-28.01l-27.32-26.63zM270.27 180.11v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.31-42.52-15.91-12.22-12.22-18.32-29.26-18.32-51.16V0h44.94v108.89c0 11.29 3.22 19.82 9.67 25.59 5.31 4.83 11.99 7.26 20.05 7.26 8.3 0 15.1-2.43 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V0h44.94l.01 180.11h-43.9z"/><path fill="#65BB87" d="M189.13 200.96h105.3c10.9 0 19.74 8.84 19.75 19.74V326c0 10.9-8.84 19.74-19.74 19.75h-105.3c-10.9 0-19.74-8.84-19.75-19.74v-105.3c-.01-10.91 8.83-19.75 19.74-19.75z"/></svg> story</div>
			</div>
			<div class="columns small-10 small-offset-1 large-7">
				<div class="description p text-neutral-4 space-50-bottom space-50-right scroll-reveal">
					<p>The Shanders Group is nearly a century old with a rich legacy of innovation and experience. The group was established in the year 1918, has interests across manufacturing, real estate development, international trade, agriculture, retail and defence. The real estate division was established in the year 1983. Guesture is the shared economy component within the real estate division.</p>
					<br><br>
					<p>Guesture believes that CoLiving is the answer to modern day challenges of urban living faced by the youth. It is a way of living in thoughtfully designed spaces meant for collaboration, community building, sustainability and a holistic approach to a good life.</p>
					<br><br>
					<p>Guesture provides coliving spaces with top tier amenities like high-speed Wifi, swimming pool, sports arena, coworking spaces, event spaces, laundry and cleaning services, meal services, shuttle services and more. Sign up is hassle free and quick. It is a plug and play approach to living in a city. You don’t need to bring anything other than your suitcase.</p>
				</div>
			</div>
			<div class="columns small-10 small-offset-1 large-3 large-offset-0">
				<div class="h6 text-green-2 text-uppercase strong opacity-50 space-min-bottom scroll-reveal">Corporate Address</div>
				<div class="p text-neutral-4 scroll-reveal">
					Irina Hospitality Pvt Ltd, No.58,
					18th B Main Road, 5th Block, Rajajinagar,<br>
					Bangalore — 560010.
				</div>
				<div class="small text-neutral-5 text-uppercase strong space-min-top scroll-reveal">Guesture is a brand of Irina Hospitality PVT LTD</div>
				<div class="h6 text-green-2 text-uppercase strong opacity-50 space-25-top scroll-reveal">Quick Links :</div>
				<a target="_blank" href="/privacy-policy" class="label text-neutral-4 scroll-reveal" style="border-bottom: solid 1px var(--green-2); margin-top: 5px;">Privacy Policy</a><br>
				<a target="_blank" href="/terms-and-conditions" class="label text-neutral-4 scroll-reveal" style="border-bottom: solid 1px var(--green-2); margin-top: 5px;">Terms and Conditions</a><br>
				<a target="_blank" href="/refund-and-cancellation" class="label text-neutral-4 scroll-reveal" style="border-bottom: solid 1px var(--green-2); margin-top: 5px;">Refund and Cancellation</a><br>
			</div>
		</div>
	</div>
</section>
<!-- END: About Section -->





<?php require_once __ROOT__ . '/pages/partials/footer.php'; ?>
