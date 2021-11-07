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
<script type="text/javascript" src="/plugins/base64/base64.js__v3.7.2.min.js<?= $ver ?>"></script>
<script type="text/javascript" src="/plugins/js-cookie/js-cookie__v3.0.1.min.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/utils.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/navigation.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/video_embed.js"></script>
<script type="text/javascript" src="/js/modules/carousel.js"></script>
<script type="text/javascript" src="/js/modules/sliding-gallery.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/modal_box.js"></script>
<script type="text/javascript" src="/js/modules/scroll-reveal.js<?= $ver ?>"></script>

<script type="text/javascript" src="/js/modules/cupid.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/forms.js<?= $ver ?>"></script>
<script type="text/javascript" src="/js/modules/form-utils.js<?= $ver ?>"></script>

<script type="text/javascript" src="/js/modules/spreadsheet-formulae.js<?= $ver ?>"></script>
<script type="text/javascript" src="/plugins/xlsx-calc/xlsx-calc-v0.6.2.min.js"></script>
<script type="text/javascript" src="/js/pricing.js<?= $ver ?>"></script>

<?php if ( Router::$urlSlug === '' ) : ?>
	<script type="text/javascript" src="/js/pages/home/pricing-forms.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/home/contact-us-form.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/home/coworking-form.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/home/womens-block-form.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/home/book-trial-form.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/modules/countdown.js<?= $ver ?>"></script>
	<!-- Countdown Timers (for the Deals section) -->
	<script type="text/javascript">
		$( function () {
			$( ".js_countdown" ).each( function ( _i, el ) {
				countdown( new Date( el.dataset.date ), el );
			} )
		} );
	</script>

<?php elseif ( Router::$urlSlug === 'booking' or Router::$urlSlug === 'booking-confirmation' ) : ?>
	<script type="text/javascript">
		window.__BFS.accomodationSelection = <?= json_encode( $configuration ) ?>;
	</script>
	<script type="text/javascript" src="/plugins/datepicker/datepicker-v5.14.2.min.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/booking/what-is-included.js<?= $ver ?>"></script>
	<script type="text/javascript" src="/js/pages/booking/booking-form.js<?= $ver ?>"></script>
<?php endif; ?>

<?php if ( ! BFS_ENV_PRODUCTION ) : ?>
	<script type="text/javascript" src="/js/modules/disclaimer.js<?= $ver ?>"></script>
<?php endif; ?>


<?php if ( WordPress::$isEnabled and ! WordPress::$onlySetupContext ) wp_footer() ?>

<?= WordPress::get( 'arbitrary_code_before_body_closing' ) ?>

</body>

</html>
