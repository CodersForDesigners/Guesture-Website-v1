<?php
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );



require_once __DIR__ . '/../conf.php';

// Parse input from the request, reject if empty
require_once __DIR__ . '/../lib/api-script-mandatory-input-parsing.php';

/**
 *
 * Import checksum generation utility (https://developer.paytm.com/docs/checksum/)
 *
 */
require_once __DIR__ . '/paytm-checksum.php';





/*
 *
 * Extract data from input
 *
 */
$customerName = $input[ 'name' ];
$customerPhoneNumber = $input[ 'phoneNumber' ];
$customerEmailAddress = $input[ 'emailAddress' ];
$booking = $input[ 'booking' ];



/*
 *
 * Derive computed data
 *
 */
function microtimeString () {
	list ( $sec, $usec ) = explode( '.', strval( microtime( true ) ) );
    return $sec . $usec;
}

$orderId = microtimeString();
$customerId = substr(
	preg_replace(
		'/[^a-zA-Z0-9]/',
		'',
		PaytmChecksum::generateSignature( [ 'phoneNumber' => $customerPhoneNumber ], PAYTM_MERCHANT_KEY )
	),
	0,
	41
);

$hostName = $_SERVER[ 'HTTP_HOST' ] ?: $_SERVER[ 'SERVER_NAME' ];
if ( HTTPS_SUPPORT )
	$httpProtocol = 'https';
else
	$httpProtocol = 'http';

$transactionAmount = $booking[ 'amount' ];

$unitInfoString = base64_encode( json_encode( $booking[ 'unit' ] ) );
$transactionMetaString = base64_encode( json_encode(
	array_merge( $booking, [
		'customerName' => $customerName,
		'customerPhoneNumber' => $customerPhoneNumber,
		'customerEmailAddress' => $customerEmailAddress
	] )
) );
$callbackURL = $httpProtocol . '://' . $hostName . '/booking-confirmation' . '?q=' . $unitInfoString . '&t=' . $transactionMetaString;



/*
 *
 * Collate all the information
 *
 */
$paytmParams = [

	/* Find your MID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	'MID' => PAYTM_MERCHANT_ID,

	/* Find your WEBSITE in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	'WEBSITE' => PAYTM_ENVIRONMENT,

	/* Find your INDUSTRY_TYPE_ID in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys */
	'INDUSTRY_TYPE_ID' => 'Retail',

	/* WEB for website and WAP for Mobile-websites or App */
	'CHANNEL_ID' => 'WEB',

	/* Enter your unique order id */
	'ORDER_ID' => $orderId,

	/* unique id that belongs to your customer */
	'CUST_ID' => $customerId,

	/* customer's mobile number */
	'MOBILE_NO' => $customerPhoneNumber,

	/* customer's email */
	'EMAIL' => $customerEmailAddress,

	/**
	 * Amount in INR that is payble by customer
	 * this should be numeric with optionally having two decimal points
	 */
	'TXN_AMOUNT' => $transactionAmount,

	/* on completion of transaction, we will send you the response on this URL */
	'CALLBACK_URL' => $callbackURL

];



/*
 *
 * Generate checksum for parameters
 *
 */
$checksum = PaytmChecksum::generateSignature( $paytmParams, PAYTM_MERCHANT_KEY );




$allParameters = $paytmParams;
$allParameters[ 'CHECKSUMHASH' ] = $checksum;



/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );

echo json_encode( $allParameters );
