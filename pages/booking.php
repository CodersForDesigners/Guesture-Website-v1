<?php
/*
 *
 * The Booking page
 *
 */
require_once __DIR__ . '/../conf.php';


if ( ! isset( $transactionOccurred ) )
	$transactionOccurred = false;

/*
 *
 * Decode the URL and extract the accomodation selection
 *
 */
$configurationEncoded = $_GET[ 'q' ] ?? null;
if ( ! $configurationEncoded ) {
	header( 'Location: /', true, 302 );
	exit;
}
try {
	$configurationJSON = base64_decode( $configurationEncoded );
	$configuration = json_decode( $configurationJSON, true );
}
catch ( \Exception $e ) {
	header( 'Location: /', true, 302 );
	exit;
}

$cupidUser = null;
try {
	$cupidUser = json_decode( base64_decode( $_COOKIE[ CUPID_AUTH_COOKIE_NAME ] ?? '{}' ), true );
}
catch ( \Exception $e ) {}

// $timestamp = $_GET[ 'timestamp' ];
// $stayFromDate = $_GET[ 'fromDate' ] ?? '';


$pageTitle = "Booking";
require_once __ROOT__ . '/pages/partials/header.php';


?>


<section class="js_section_what_is_included js_section_what_is_included_and_booking">
	<div class="container">
		<div class="row header space-50-top" style="position: relative; z-index: 2;">
			<div class="columns small-6 medium-3 medium-offset-1">
				<a class="block" href="/" target="_blank">
					<svg class="inline-middle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1190 350"><text style="opacity: 0;">Guesture</text><path fill="#2E343D" d="M104.06 231.68c0 10.6-2.76 19.13-8.29 25.58-6.22 7.83-15.56 11.76-28 11.76-14.06 0-25.82-4.61-35.26-13.84l-28 28.35c16.13 15.68 37.92 23.51 65.33 23.51 23.74 0 42.98-7.03 57.74-21.09 14.06-13.83 21.09-31.69 21.08-53.59V59.15h-43.21V76.1c-11.54-12.67-26.17-19-43.92-19-18.21 0-32.62 5.3-43.21 15.91C6.1 85.21 0 108.95 0 144.21c0 35.5 6.1 59.24 18.32 71.22 10.6 10.61 24.89 15.91 42.86 15.91 4.61 0 8.99-.35 13.13-1.03v-39.07c-11.98-.23-20.28-5.19-24.88-14.86-3.01-6.69-4.49-17.41-4.49-32.16 0-14.74 1.49-25.58 4.49-32.5 4.6-9.44 12.9-14.16 24.88-14.16 11.99 0 20.29 4.72 24.89 14.16 3.23 6.92 4.84 17.76 4.84 32.5l.02 87.46zM449.41 185.68c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.74-3.46-27.66-10.38-6.68-6.45-10.37-15.09-11.05-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.44-18.67 29.73-18.67 14.28 0 24.32 6.22 30.07 18.67 2.31 5.75 3.69 12.1 4.16 19.01h-39.42v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.73-24.19-23.51 0-42.29 7.94-56.36 23.85-14.29 16.36-21.43 38.84-21.43 67.41 0 61.08 27.55 91.62 82.63 91.62 26.5 0 49.2-9.34 68.11-28.01l-27.32-26.63zM636.42 183.61c0 19.13-7.37 33.88-22.13 44.25-13.83 9.68-31.92 14.52-54.28 14.52-33.88 0-59.46-8.65-76.75-25.92l29.39-29.39c11.29 11.29 27.31 16.94 48.06 16.94 21.21 0 31.8-6.23 31.8-18.67 0-9.91-6.33-15.45-19.01-16.59l-28.35-2.77c-35.03-3.46-52.55-20.28-52.55-50.47 0-17.97 7.03-32.27 21.08-42.87 12.91-9.68 29.05-14.53 48.4-14.53 30.89 0 53.81 7.03 68.79 21.08l-27.66 28c-8.98-8.06-22.92-12.1-41.83-12.09-17.05 0-25.58 5.77-25.58 17.29 0 9.21 6.23 14.4 18.67 15.56l28.35 2.76c35.74 3.47 53.6 21.09 53.6 52.9z"/><path fill="#2E343D" d="M702.44 240.3c-17.06 0-30.31-5.42-39.76-16.24-8.3-9.45-12.44-21.2-12.44-35.26V99.6h-19.02V65.37h19.02V12.14h44.93v53.23h31.81V99.6h-31.81v86.43c0 10.84 5.19 16.25 15.56 16.25h16.26v38.03l-24.55-.01zM846.94 240.3v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.3-42.52-15.9-12.22-12.22-18.33-29.27-18.33-51.17V60.19h44.94v108.89c0 11.29 3.23 19.83 9.69 25.59 5.3 4.84 11.99 7.25 20.05 7.25 8.3 0 15.1-2.41 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V60.18h44.94l.01 180.11-43.91.01zM1014.58 109.27c-7.15-7.15-15.09-10.71-23.85-10.71-7.62 0-14.18 2.65-19.71 7.95-6.22 6.22-9.33 14.63-9.33 25.23V240.3h-44.94l-.01-180.11h43.91v17.29c10.84-12.91 25.93-19.37 45.29-19.37 17.05 0 31.22 5.65 42.52 16.94l-33.88 34.22zM1152.17 185.66c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.75-3.46-27.66-10.38-6.69-6.45-10.37-15.09-11.06-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.45-18.67 29.73-18.67 14.3 0 24.32 6.22 30.08 18.67 2.31 5.75 3.69 12.1 4.15 19.01h-39.41v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.74-24.19-23.51 0-42.29 7.94-56.34 23.85-14.3 16.36-21.43 38.84-21.43 67.41 0 61.08 27.54 91.62 82.62 91.62 26.5 0 49.21-9.34 68.11-28.01l-27.32-26.63zM270.27 180.11v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.31-42.52-15.91-12.22-12.22-18.32-29.26-18.32-51.16V0h44.94v108.89c0 11.29 3.22 19.82 9.67 25.59 5.31 4.83 11.99 7.26 20.05 7.26 8.3 0 15.1-2.43 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V0h44.94l.01 180.11h-43.9z"/><path fill="#65BB87" d="M189.13 200.96h105.3c10.9 0 19.74 8.84 19.75 19.74V326c0 10.9-8.84 19.74-19.74 19.75h-105.3c-10.9 0-19.74-8.84-19.75-19.74v-105.3c-.01-10.91 8.83-19.75 19.74-19.75z"/></svg>
				</a>
			</div>
			<div class="columns small-6 medium-7 text-right">
				<a href="/" target="_blank" class="button fill-green-2">Visit Website <img class="hide-for-small" src="/media/glyph/icon-exit.svg<?php echo $ver ?>"></a>
			</div>
		</div>
		<div class="row loading js_loading_indicator" style="position: fixed; z-index: 1; top: 0; left: 0; right: 0; bottom: 0; width: 100%; /*background-color: rgba(0,0,255,0.3);*/">
			<div class="container" style="height: 95vh; display: flex; align-items: center;">
				<div class="columns small-12 text-center">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" style="width: 64px;"><g class="nc-icon-wrapper" stroke-linecap="round" stroke-linejoin="round" stroke-width="3" fill="#1FA28F" stroke="#1FA28F"><g class="nc-loop_bars-32"> <line data-color="color-2" fill="none" stroke-miterlimit="10" x1="16" y1="7" x2="16" y2="24" transform="translate(0 0.7091520000100136) scale(1 0.9556779999993742)" style="opacity:0.9556779999993742;"/> <line fill="none" stroke="#1FA28F" stroke-miterlimit="10" x1="3" y1="7" x2="3" y2="24" transform="translate(0 8.890847999989987) scale(1 0.4443220000006259)" style="opacity:0.4443220000006259;"/> <line fill="none" stroke="#1FA28F" stroke-miterlimit="10" x1="29" y1="7" x2="29" y2="24" transform="translate(0 8.890847999989987) scale(1 0.4443220000006259)" style="opacity:0.4443220000006259;"/> </g> <script>!function(){function t(t,i){for(var n in i)t.setAttribute(n,i[n])}function i(t){this.element=t,this.rect=[this.element.querySelectorAll("*")[0],this.element.querySelectorAll("*")[1],this.element.querySelectorAll("*")[2]],this.animationId,this.loop=0,this.start=null,this.init()}if(!window.requestAnimationFrame){var n=null;window.requestAnimationFrame=function(t,i){var e=(new Date).getTime();n||(n=e);var o=Math.max(0,16-(e-n)),r=window.setTimeout(function(){t(e+o)},o);return n=e+o,r}}i.prototype.init=function(){var t=this;this.loop=0,this.animationId=window.requestAnimationFrame(t.triggerAnimation.bind(t))},i.prototype.reset=function(){var t=this;window.cancelAnimationFrame(t.animationId)},i.prototype.triggerAnimation=function(i){var n=this;this.start||(this.start=i);var e=i-this.start,o=[],r=[],a=1-2*e/1e3,s=2*e*16/1e3,l=.4+2*e/1e3,m=16*(.6-2*e/1e3);this.loop%2==0?(o[0]=a,r[0]=s,o[1]=o[2]=l,r[1]=r[2]=m):(o[0]=l,r[0]=m,o[1]=o[2]=a,r[1]=r[2]=s),300>e||(this.start=this.start+300,this.loop=this.loop+1);for(var c=0;3>c;c++)t(this.rect[c],{transform:"translate(0 "+r[c]+") scale(1 "+o[c]+")",style:"opacity:"+o[c]+";"});if(document.documentElement.contains(this.element))window.requestAnimationFrame(n.triggerAnimation.bind(n))};var e=document.getElementsByClassName("nc-loop_bars-32"),o=[];if(e)for(var r=0;e.length>r;r++)!function(t){o.push(new i(e[t]))}(r);document.addEventListener("visibilitychange",function(){"hidden"==document.visibilityState?o.forEach(function(t){t.reset()}):o.forEach(function(t){t.init()})})}();</script></g></svg>
					<span class="block label text-uppercase text-green-2">Fetching Details</span>
				</div>
			</div>
		</div>
		<div class="row what-is-included space-50-top space-100-bottom js_main_content" style="position: relative; z-index: 2; display: none;">
			<div class="columns small-12 fill-light" style="border-radius: 10px; overflow: hidden; box-shadow: 0px 0px 3px rgba(0,0,0,0.15), 0px 3px 8px rgba(0,0,0,0.15)">
				<div class="row space-50-top space-25-bottom">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7 qpid_login_site">
						<div class="h3 strong">The <span class="text-green-2 js_name">Buddy</span> Package</div>
						<div class="h2 strong space-min-bottom text-green-2" style="margin-left: calc(var(--space-25) * -1); line-height: 1;">@<span class="js_location">Alta Vista BLR</span></div>
						<div class="h4 strong js_monthly_fee_statement"></div>
						<?php if ( ! $transactionOccurred and empty( $cupidUser ) ) : ?>
							<div class="js_pre_booking_form" style="display: none">
								<label class="js_login_trigger_region inline-bottom space-min-right">
									<span class="label block invisible">Book Now</span>
									<button class="button fill-green js_book_a_unit" data-initial-text="Book Now" data-product="" data-c="">Book Now</button>
								</label>
								<label class="inline-bottom">
									<span class="label block invisible">Recalculate Price</span>
									<a href="/#pricing" target="_blank" class="button fill-green">Recalculate Price</a>
								</label>

								<div class="row">
									<div class="columns small-12 medium-6 large-4 xlarge-3"><?php require __ROOT__ . '/pages/snippets/login-prompt.php'; ?></div>
								</div>
							</div>
						<?php endif; ?>

						<!-- Booking Form -->
						<?php if ( ! $transactionOccurred ) : ?>
							<form class="booking-form js_booking_form">
								<div class="price-options row space-50-top js_price_options">
									<div class="form-row columns small-12">
										<label class="price-option cursor-pointer block space-min-bottom" data-type="booking">
											<input class="visuallyhidden" type="radio" name="payment" value="booking-fee" data-amount="4999" data-desc="Booking Fee">
											<span class="radio"></span>
											<span class="h5 strong text-green-2">Pay ₹4999 Booking Fee</span>
											<div class="fine-print">
												<div class="label print">The Booking Fee ensures your reservation is made.</div>
												<div class="label print">At the time of check-in you will need to pay a 2 month security deposit.</div>
												<div class="label print">The ₹4999 Booking Fee is fully adjustable against this security deposit payment.</div>
											</div>
										</label>
										<label class="price-option cursor-pointer block space-min-bottom" data-type="deposit">
											<input class="visuallyhidden" type="radio" name="payment" value="security-deposit" data-amount="" data-desc="Security Deposit">
											<span class="radio"></span>
											<span class="h5 strong text-green-2">Pay 2 Months Security Deposit <span class="js_amount"></span></span>
											<div class="fine-print">
												<div class="label print">Before you check-in, we collect a 2 months security deposit.</div>
												<div class="label print">The Security Deposit is fully refundable when you check-out.</div>
											</div>
										</label>
										<label class="price-option cursor-pointer block space-min-bottom" data-type="trial">
											<input class="visuallyhidden" type="radio" name="payment" value="3-day-trial" data-amount="1199" data-desc="Trial">
											<span class="radio"></span>
											<span class="h5 strong text-green-2">Or Pay ₹1199 for a 3 Day Trial</span>
											<div class="fine-print">
												<div class="label print">Just bring your bag, stay with us for 3 days and 2 nights.</div>
												<div class="label print">100% money back guarantee*</div>
												<div class="label print">If you are not satisfied *within 36 hours of check-in we will refund your money.</div>
											</div>
										</label>
									</div>
								</div>
								<div class="row space-50-top space-50-bottom">
									<div class="form-row columns small-12 medium-6">
										<label>
											<span class="label inline text-neutral-3 text-uppercase">Full Name</span>
											<input class="name block js_form_input_name" type="text" name="name" required>
										</label>
									</div>
									<div class="form-row columns small-12 medium-6">
										<label>
											<span class="label inline text-neutral-3 text-uppercase">Email Id</span>
											<input class="email block js_form_input_email" type="text" name="email-address" required>
										</label>
									</div>
									<div class="form-row columns small-12 medium-6">
										<label>
											<span class="label inline text-neutral-3 text-uppercase">Starting From</span>
											<div class="date-input-container">
												<input class="date block js_form_input_from_date js_booking_from_date" type="date" pattern="[0-9\-\/]+" value="" required>
											</div>
										</label>
									</div>
									<div class="form-row columns small-12 medium-6">
										<style type="text/css">
											.phone-number-field {
												display: flex;
												margin-top: 3px;
												flex-wrap: wrap;
											}
											.phone-number-field .phone-prefix {
												position: relative;
												/*width: 15%;*/
												min-width: 45px;
												max-width: 60px;
											}
											.phone-number-field .phone-prefix input {
												width: 100%;
												padding: 0;
												background-color: transparent;
												color: var(--black);
												border-right: none;
												border-top-right-radius: 0;
												border-bottom-right-radius: 0;
												box-shadow: none;
												pointer-events: none;
											}
											.phone-number-field .phone {
												flex-grow: 1;
												border-top-left-radius: 0;
												border-bottom-left-radius: 0;
											}
										</style>
										<label class="phone-number-field">
											<span class="label inline text-neutral-3 text-uppercase" style="flex-basis: 100%">Phone Number</span>
											<div class="phone-prefix _prefix-group">
												<select class="js_phone_country_code" style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; opacity: 0">
													<?php include __ROOT__ . '/pages/snippets/phone-country-codes.php' ?>
												</select>
												<input class="_prefix js_phone_country_code_label button" value="+91" type="text" readonly>
											</div>
											<input class="phone js_form_input_phonenumber" type="text" name="phone-number" required>
										</label>
									</div>
									<div class="form-row columns small-12 medium-6">
										<label>
											<span class="label inline text-neutral-3 text-uppercase invisible">Make Payment with PayTM</span>
											<button class="button block fill-paytm-blue" type="submit" data-state="initial">
												<span class="initial">Pay ₹<span class="js_booking_amount"></span> <img class="paytm-logo" src="/media/logo-paytm-light.svg<?php echo $ver ?>"></span>
												<span class="checking">Checking Availability...</span>
												<span class="processing">Processing Payment...</span>
											</button>
											<div class="small text-neutral-3 text-uppercase text-center" style="font-size: 8px; margin-top: 5px;">'Paid Towards Guesture - Irina Hospitality PVT LTD'</div>
										</label>
									</div>
									<div class="form-row columns small-12 medium-6 medium-offset-6 space-25-left">
										<a href="/#pricing" target="_blank" class="label strong underline text-uppercase" style="border-bottom: 1.5px var(--dark) solid;">Or, Recalculate Price</a>
									</div>
								</div>
							</form>
						<?php endif; ?>


						<!-- Post Transaction messaging -->
						<?php
						 /*
						  | Post Transaction messaging
						  | Show an appropriate message depending on whether the payment was successful or not
						  */
						?>
						<?php if ( $transactionOccurred ) : ?>
							<?php if ( empty( $transactionErrors ) ) : ?>
								<div class="h3 text-green-2 strong space-50-top">Payment Successful!</div>
								<div class="h5 text-green-2 strong">For any further assistance call us on <a href="tel:+91-828-7770011" style="border-bottom: 2px var(--green-2) solid;">+91-828-7770011</a>, with your order ID: <span class="h5 text-dark strong"><?= $orderId ?></span></div>
							<?php else : ?>
								<div class="h3 text-red space-50-top strong">Payment Failed!</div>
								<div class="h5 text-red strong">Something went wrong with the payment. Please call us on <a href="tel:+91-828-7770011" style="border-bottom: 2px var(--red) solid;">+91-828-7770011</a>.</div>
							<?php endif; ?>
						<?php endif; ?>


						<div class="h4 strong space-25-top js_summary space-25-bottom">This option gives you access to a Twin Sharing room in a furnished 3 Bedroom Flat. Your room has an attached bathroom and an attached Balcony.</div>
						<div class="virtual-tour-container fill-dark js_virtual_tour_container">
							<iframe class="virtual-tour js_virtual_tour" data-default-src="/media/favicon/favicon.ico" src="/media/favicon/favicon.ico" frameborder="0" loading="lazy" data-hj-allow-iframe=""></iframe>
						</div>
					</div>
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-top-bottom text-green-2">What is in your room?</div>
					</div>
					<div class="p columns small-10 small-offset-1 large-8 xlarge-7 column-wrap js_room">
						<span class="p block space-min-bottom js_room">
							<!-- Text inserted by JavaScript -->
						</span>
					</div>
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-top-bottom text-green-2">What is in your flat?</div>
					</div>
					<div class="p columns small-10 small-offset-1 large-8 xlarge-7 column-wrap js_suite">
						<span class="p block space-min-bottom js_suite">
							<!-- Text inserted by JavaScript -->
						</span>
					</div>
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-top-bottom text-green-2">Services that are included?</div>
						<span class="p block space-min-bottom js_services">
							<!-- Text inserted by JavaScript -->
						</span>
					</div>
				</div>
				<div class="row fill-dark space-25-top-bottom" style="background: linear-gradient(15deg, var(--dark) 20%, var(--neutral-4) 100%);">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong space-25-bottom">Optional Add-on Services</div>
						<span class="h5 block js_addons">
							<!-- Text inserted by JavaScript -->
						</span>
					</div>
				</div>
				<div class="row space-25-top space-min-bottom">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h4 strong text-green-2">The <span class="text-dark no-wrap">@</span><span class="text-dark no-wrap js_location">Alta Vista - BLR</span> Campus.</div>
					</div>
				</div>
				<div class="row js_location_images_container">
					<div class="carousel modal-carousel js_carousel_container">
						<div class="carousel-list js_location_images js_carousel_content">
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( '/media/sliding-gallery/5K8A6686.jpg' )"><span class="label caption">Balcony</span></div>
							</div>
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( '/media/sliding-gallery/5K8A6988.jpg' )"><span class="label caption">Entrance</span></div>
							</div>
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( '/media/sliding-gallery/5K8A6647.jpg' )"><span class="label caption">Bedroom</span></div>
							</div>
							<div class="carousel-list-item js_carousel_item">
								<div class="image" style="background-image: url( '/media/sliding-gallery/5K8A6541.jpg' )"><span class="label caption">Living Room</span></div>
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
				</div>
				<div class="row space-min-top space-50-bottom">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="p block space-min-bottom">
							<!-- Inset Formated Text -->
							<b>Address :</b>
							<span class="js_location_address">
								<br>
								Shanders Alta Vista, Veer Sandra, Electronic City,
								<br>
								Bengaluru, Karnataka 560100.
							</span>
						</div>
						<div class="space-25-top space-min-bottom">
							<a href="https://goo.gl/maps/awWKyDwRoEPzcg8t9" target="_blank" class="h6 strong inline-middle js_location_google_maps"><img class="inline-middle" src="/media/glyph/24-maps.svg<?php echo $ver ?>" style="margin-right: 5px;"> Open in Google Maps</a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<?php
		 /*
		  | In the scenario where the configuration query parameter (i.e. `q`) has an old or invalid value,
		  |  then the following error message is shown.
		  */
		?>
		<div class="row invalid-data space-50-top space-100-bottom js_error_content" style="position: relative; z-index: 2; display: none;">
			<div class="columns small-12 fill-light" style="border-radius: 10px; overflow: hidden; box-shadow: 0px 0px 3px rgba(0,0,0,0.15), 0px 3px 8px rgba(0,0,0,0.15)">
				<div class="row space-50-top space-50-bottom">
					<div class="columns small-10 small-offset-1 large-8 xlarge-7">
						<div class="h2 strong">Sorry!</div>
						<div class="h4 space-25-top space-50-bottom">The information you are looking for is invalid or out of date.</div>
						<a href="/#pricing" class="button">Get Latest Price</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>





<script type="text/javascript">

	window.__BFS = window.__BFS || { }
	window.__BFS.payTMGatewayURL = "<?= PAYTM_URL ?>";

</script>

<?php require_once __ROOT__ . '/pages/partials/footer.php'; ?>
