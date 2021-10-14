<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

use BFS\CMS\WordPress;
use BFS\Router;

?>

	</div> <!-- END : Page Content -->

	<?php require_once __ROOT__ . '/pages/snippets/lazaro-signature.php'; ?>

</div><!-- END : Page Wrapper -->

<?php require_once __ROOT__ . '/pages/snippets/modals.php' ?>
<!--  ☠  MARKUP ENDS HERE  ☠  -->

<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<?php require_once __ROOT__ . '/pages/snippets/lazaro-disclaimer.php'; ?>
<?php endif; ?>

<!-- JS Modules -->
<script type="text/javascript">
	window.__BFS = window.__BFS || { };

	// Check and establish support for features
	window.__BFS.support = window.__BFS.support || { };
	window.__BFS.support.webShare = navigator.share ? true : false;

</script>
<script type="text/javascript" src="/js/modules/utils.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/navigation.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/video_embed.js"></script>
<script type="text/javascript" src="/js/modules/carousel.js"></script>
<script type="text/javascript" src="/js/modules/sliding-gallery.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/modal_box.js"></script>
<script type="text/javascript" src="/plugins/lottie/lottie-lite-v5.5.10.min.js"></script>
<script type="text/javascript" src="/js/modules/scroll-reveal.js<?= $ver ?>"></script>

<script type="text/javascript" src="/js/modules/cupid/utils.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/cupid/user.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/forms.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/login-prompts.js<?= $ver ?>"></script>

<script type="text/javascript" src="/js/modules/spreadsheet-formulae.js<?= $ver ?>"></script>
<script type="text/javascript" src="/plugins/xlsx-calc/xlsx-calc-v0.6.2.min.js"></script>
<script type="text/javascript" src="/js/pricing.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/countdown.js<?= $ver ?>"></script>

<?php if ( Router::$urlSlug === '' ) : ?>
	<script type="text/javascript" src="/js/pages/home/login-prompts.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/home/home.js<?= $ver ?>"></script>
<?php elseif ( Router::$urlSlug === 'booking' or Router::$urlSlug === 'booking-confirmation' ) : ?>
	<script type="text/javascript">
		window.__BFS.accomodationSelection = <?= json_encode( $configuration ) ?>;
	</script>
	<script type="text/javascript" src="/plugins/datepicker/datepicker-v5.14.2.min.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/what-is-included/login-prompts.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/what-is-included/what-is-included.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/booking/booking.js<?= $ver ?>"></script>
<?php elseif ( Router::$urlSlug === 'what-is-included' ) : ?>
	<script type="text/javascript" src="/js/pages/what-is-included/login-prompts.js<?= $ver ?>"></script>
	<script type="text/javascript">
		window.__BFS.accomodationSelection = <?= json_encode( $configuration ) ?>;
	</script>
	<script type="text/javascript" src="/js/pages/what-is-included/what-is-included.js<?= $ver ?>"></script>
<?php endif; ?>

<!-- Countdown Timers -->
<script type="text/javascript">

	$( function () {

		$( ".js_countdown" ).each( function ( _i, el ) {
			countdown( new Date( el.dataset.date ), el );
		} )

	} );

</script>

<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<script type="text/javascript" src="/js/modules/disclaimer.js<?= $ver ?>"></script>
<?php endif; ?>

<!-- spirit web player -->
<script src="https://unpkg.com/spiritjs/dist/spirit.min.js"></script>
<script>
  // spirit.loadAnimation({
  //   autoPlay: true,
  //   path: './spirit-animation.json',
  // })

  // load GSAP Tween and Timeline from CDN
  spirit.setup().then(() => {

    // next, load the animation data
    // exported with Spirit Studio
    spirit.load('./lamp.json').then(groups => {

	 // our animation can have multiple animation groups
	 // lets get the first
	 const group = groups.at(0);

	 // construct it
	 // (this assembles a GSAP Timeline)
	 const timeline = group.construct();

	 // and finally play it
		timeline.play();
    })
  })
</script>



<script type="text/javascript">

	/*
	 |
	 | Tell Cupid that the user dropped by
	 |
	 */
	$( function () {

		var user = __CUPID.utils.getUser();
		if ( user ) {
			setTimeout( function () {
				__CUPID.utils.getAnalyticsId()
					.then( function ( deviceId ) {
						user.hasDeviceId( deviceId );
						user.isOnWebsite();
					} )
			}, 1500 );
		}

	} );

</script>


<?php if ( WordPress::$isEnabled and ! WordPress::$onlySetupContext ) wp_footer() ?>

<?= WordPress::get( 'arbitrary_code_before_body_closing' ) ?>

</body>

</html>
