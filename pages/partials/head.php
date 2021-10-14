<?php

use BFS\CMS\WordPress;
use BFS\Router;

global $requestPath;
global $post;	// WordPress' global post object

// Get the absolute URL of the page
$pageURL = $siteUrl . '/' . $requestPath;


// Construct the document's title ( for use in the <title></title> tag )
	// ( if an explicit one is set, use that )
if ( WordPress::$isEnabled and /*WordPress::$onlySetupContext and*/ empty( $documentTitle ) ) {
	$siteTitle = $siteTitle ?? get_bloginfo( 'name' );
	$siteTagline = $siteTagline ?? get_bloginfo( 'description' );
	$sectionTitle = $sectionTitle ?? '';
	if ( Router::$urlSlug == '' )	// i.e. home page
		$postTitle = $postTitle ?? '';
	else
		$postTitle = $postTitle ?? get_the_title( $post ) ?? '';

	$documentTitle = implode( ' | ', array_filter( [ $postTitle, $sectionTitle, $siteTitle, $siteTagline ] ) );
}



/*
 * Meta / SEO
 */
$metaDescription = $metaDescription ?? ( WordPress::$isEnabled ? WordPress::get( 'meta_description' ) : '' );
$metaDescription = htmlentities( strip_tags( $metaDescription ) );
$metaImage = $metaImage ?? WordPress::get( 'meta_image' ) ?? [ ];
$metaImage = $metaImage[ 'sizes' ][ 'medium' ] ?? $metaImage[ 'sizes' ][ 'small' ] ?? $metaImage[ 'sizes' ][ 'thumbnail' ] ?? $metaImage[ 'url' ] ?? ( $siteUrl . '/media/social-logo.png' );


$metaCharset = WordPress::$isEnabled ? get_bloginfo( 'charset' ) : 'utf-8';

?>
<meta charset="<?= $metaCharset ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, viewport-fit=cover" />

<?php if ( WordPress::$isEnabled and ! WordPress::$onlySetupContext ) : ?>
<?php wp_head(); ?>
<?php endif; ?>

<?php if ( ! empty( $documentTitle ) ) : ?>
<title><?= $documentTitle ?></title>
<?php endif; ?>

<?php if ( ! empty( $baseURL ) ) : ?>
<base href="<?= $baseURL ?>">
<?php endif; ?>

<!--
*
*	Metadata
*
- -->
<!-- Short description of the document (limit to 150 characters) -->
<!-- This content *may* be used as a part of search engine results. -->
<?php if ( $metaDescription ) : ?>
<meta name="description" content="<?= $metaDescription ?>">
<?php endif; ?>


<!--
*
*	Authors
*
- -->
<!-- Links to information about the author(s) of the document -->
<meta name="author" content="Coders for Designers">
<link rel="author" href="/humans.txt">


<!--
*
*	SEO
*
- -->
<!-- Control the behavior of search engine crawling and indexing -->
<meta name="robots" content="index,follow"><!-- All Search Engines -->
<meta name="googlebot" content="index,follow"><!-- Google Specific -->
<!-- Verify website ownership -->
<?php if ( ! empty( WordPress::get( 'google_site_verification_token' ) ?? GOOGLE_SITE_VERIFICATION_TOKEN ) ) : ?>
<meta name="google-site-verification" content="<?= WordPress::get( 'google_site_verification_token' ) ?? GOOGLE_SITE_VERIFICATION_TOKEN; ?>"><!-- Google Search Console -->
<?php endif; ?>


<!--
*
*	UI / Chrome
*
- -->
<!-- Theme Color for Chrome, Firefox OS and Opera -->
<meta name="theme-color" content="<?= WordPress::get( 'theme_color' ) ?? '#f9f9f9' ?>">

<!-- Favicons -->
<link rel="apple-touch-icon" sizes="57x57" href="/media/favicon/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="/media/favicon/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="/media/favicon/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="/media/favicon/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="/media/favicon/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="/media/favicon/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="/media/favicon/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="/media/favicon/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="/media/favicon/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="/media/favicon/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="/media/favicon/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="/media/favicon/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="/media/favicon/favicon-16x16.png">
<link rel="manifest" href="/media/favicon/manifest.json">
<meta name="msapplication-TileColor" content="#444444">
<meta name="msapplication-TileImage" content="/media/favicon/ms-icon-144x144.png">


<!-- ~ iOS ~ -->
<!-- Disable automatic detection and formatting of possible phone numbers -->
<meta name="format-detection" content="telephone=no">
<!-- Launch Screen Image -->
<!-- <link rel="apple-touch-startup-image" href="/path/to/launch.png"> -->
<!-- Launch Icon Title -->
<meta name="apple-mobile-web-app-title" content="<?= WordPress::get( 'apple / ios_app_title' ) ?>">
<!-- Enable standalone (full-screen) mode -->
<meta name="apple-mobile-web-app-capable" content="yes">
<!-- Status bar appearance (has no effect unless standalone mode is enabled) -->
<meta name="apple-mobile-web-app-status-bar-style" content="<?= WordPress::get( 'apple/ios_status_bar_style' ) ?? 'default' ?>">

<!-- ~ Android ~ -->
<!-- Add to home screen -->
<meta name="mobile-web-app-capable" content="yes">
<!-- More info: https://developer.chrome.com/multidevice/android/installtohomescreen -->


<!--
*
*	Social
*
- -->
<!-- Facebook Open Graph -->
<meta property="og:url" content="<?= $pageURL ?>">
<meta property="og:type" content="website">
<meta property="og:title" content="<?= $documentTitle ?>">
<?php if ( $metaDescription ) : ?>
<meta property="og:description" content="<?= $metaDescription ?>">
<?php endif; ?>
<?php if ( $metaImage ) : ?>
<meta property="og:image" content="<?= $metaImage ?>">
<?php endif; ?>
<meta property="og:site_name" content="<?= $siteTitle ?>">


<!-- Schema.org / Google+ -->
<meta itemprop="name" content="<?= $documentTitle ?>">
<?php if ( $metaDescription ) : ?>
<meta itemprop="description" content="<?= $metaDescription ?>">
<?php endif; ?>
<?php if ( $metaImage ) : ?>
<meta itemprop="image" content="<?= $metaImage ?>">
<?php endif; ?>

<!-- Stylesheet -->
<?php require_once __ROOT__ . '/style.php'; ?>

<!-- jQuery 3 -->
<script type="text/javascript" src="/plugins/jquery/jquery-v3.6.0.min.js<?= $ver ?>"></script>
<!-- Slick Carousel -->
<link rel="stylesheet" type="text/css" href="/plugins/slick/slick.css<?= $ver ?>"/>
<link rel="stylesheet" type="text/css" href="/plugins/slick/slick-theme.css<?= $ver ?>"/>

<?php if ( Router::$urlSlug === 'booking' or Router::$urlSlug === 'booking-confirmation' ) : ?>
	<link rel="stylesheet" type="text/css" href="plugins/datepicker/datepicker-v5.14.2.min.css<?= $ver ?>"/>

	<style type="text/css">

		.what-is-included .date-input-container {
			position: relative;
		}
		.what-is-included .date-input-container select {
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
			pointer-events: none;
			visibility: hidden;
		}
		.what-is-included .date-input-container input {
			-webkit-appearance: none;
			-moz-appearance: none;
			-ms-appearance: none;
			appearance: none;
		}
		.what-is-included .date-input-container input:invalid + select {
			visibility: visible;
		}

		.qs-datepicker-container {
			font-size: 0.9em !important;
		}

	</style>
<?php endif; ?>

<?= WordPress::get( 'fonts_and_icons_embed' ) ?? <<<ARB
<!-- Fonts -->
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,300,400,700" rel="stylesheet">
<!-- Icons -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
ARB
?>

<?= WordPress::get( 'arbitrary_code_before_head_closing' ) ?? '' ?>
