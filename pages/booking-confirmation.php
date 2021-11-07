<?php
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );



require_once __DIR__ . '/../conf.php';

/*
 *
 * If the $_GET[ 'referrer' ] is set, redirect to that page.
 * If the $_POST is not empty, verify transaction status and redirect back to booking page with transaction status message.
 *
 */

/*
 *
 * This route is navigated to via a GET request when the "Go Back" link on PayTM's payment gateway is clicked, AND when the user is explicitly redirected to this route post-payment
 *
 */
if ( strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) === 'GET' ) {
 	// If this route is being navigated to through the "Go Back" link on PayTM's payment gateway, or directly for whatever reason
 	if ( empty( $_GET[ 't' ] ) ) {
		$redirectURL = '/booking?q=' . $_GET[ 'q' ];
		return header( 'Location: ' . $redirectURL, true, 302 );
		exit;
 	}
 	// Else if the route is being navigated to post-transaction
 	else {
		$transaction = json_decode( base64_decode( $_GET[ 't' ] ), true );
		$transactionOccurred = $transaction[ 'occurred' ];
		$transactionErrors = $transaction[ 'errors' ];
		$orderId = $transaction[ 'orderId' ];
		require_once __DIR__ . '/booking.php';
		exit;
 	}
}

/*
 *
 * If this route is being navigated to post-transaction
 *
 */
if ( strtoupper( $_SERVER[ 'REQUEST_METHOD' ] ) === 'POST' and ! empty( $_POST ) ) {

	/*
	 *
	 * Sample callback request from PayTM
	 *
	 */
	// [
	//   'CURRENCY' => 'INR',
	//   'GATEWAYNAME' => 'WALLET',
	//   'RESPMSG' => 'Txn Success',
	//   'BANKNAME' => 'WALLET',
	//   'PAYMENTMODE' => 'PPI',
	//   'MID' => 'IrinaH93005971299457',
	//   'RESPCODE' => '01',
	//   'TXNID' => '20200605111212800110168668201607907',
	//   'TXNAMOUNT' => '500.00',
	//   'ORDERID' => '1003',
	//   'STATUS' => 'TXN_SUCCESS',
	//   'BANKTXNID' => '62574042',
	//   'TXNDATE' => '2020-06-05 15:26:36.0',
	//   'CHECKSUMHASH' => '5+s+z3fpoLkT1SN7FaE1kCQCxbagITrDl3g5YFrbAyvTrxmyQetsCkaCjUPi5VASbY0v3WJW1ptwwzS+6lrrXcUXHV7n5xrl0ikMX2gsvgI='
	// ]


	/**
	 *
	 * Import checksum generation utility (https://developer.paytm.com/docs/checksum/)
	 *
	 */
	require_once __DIR__ . '/../server/paytm-checksum.php';
	require_once __DIR__ . '/../server/api/guesture.php';
	require_once __DIR__ . '/../server/api/cupid.php';



	// TODO: Write out the whole thing
	function getOrder ( $id ) {
		return [
			'status' => 'pending'
		];
	}

	$paytmParams = [ ];
	$paytmChecksum = null;

	foreach ( $_POST as $key => $value ) {
		if ( $key === 'CHECKSUMHASH' )
			$paytmChecksum = $value;
		else
			$paytmParams[ $key ] = $value;
	}



	/*
	 *
	 * Data Validation
	 *
	 */
	$transaction = [
		'occurred' => true,
		'errors' => [ ],
		'orderId' => $_POST[ 'ORDERID' ]
	];

	// Is the request tampered with?
		// i.e. checksum hash does not match
	$verifySignature = PaytmChecksum::verifySignature( $paytmParams, PAYTM_MERCHANT_KEY, $paytmChecksum );
	if ( ! $verifySignature )
		$transaction[ 'errors' ][ 'paymentTampered' ] = true;

	// Is the merchant id correct?
	if ( $paytmParams[ 'MID' ] !== PAYTM_MERCHANT_ID )
		$transaction[ 'errors' ][ 'merchantIncorrect' ] = true;

	// Was the transaction successful?
		// Response code is not `01`
		// Status is not `TXN_SUCCESS`
	if ( $paytmParams[ 'RESPCODE' ] !== '01' or $paytmParams[ 'STATUS' ] !== 'TXN_SUCCESS' )
		$transaction[ 'errors' ][ 'transactionUnsuccessful' ] = true;

	// Get the transaction meta (i.e. booking) information
	$transactionMeta = json_decode( base64_decode( $_GET[ 't' ] ), true );

	if ( empty( $transaction[ 'errors' ] ) ) {
		if ( strpos( $transactionMeta[ 'unit' ][ 'duration' ], 'trial' ) === false ) {
			$bookingDetails = [
				'orderId' => $_POST[ 'ORDERID' ],
				'type' => $transactionMeta[ 'unit' ][ 'type' ],
				'location' => $transactionMeta[ 'unit' ][ 'location' ],
				'hasBalcony' => strtolower( $transactionMeta[ 'unit' ][ 'balcony' ] ) !== 'none',
				'hasBathroom' => strtolower( $transactionMeta[ 'unit' ][ 'bathroom' ] ) !== 'attached',
				'phoneNumber' => substr( $transactionMeta[ 'customerPhoneNumber' ], 1 ),
				'emailAddress' => $transactionMeta[ 'customerEmailAddress' ],
				'name' => $transactionMeta[ 'customerName' ],
				'unitId' => $transactionMeta[ 'unit' ][ 'id' ] ?? '',
				'fromDate' => $transactionMeta[ 'fromDate' ],
				'toDate' => $transactionMeta[ 'toDate' ]
			];
			Guesture::makeBooking( $bookingDetails );
		}

		$purchase = [
			'client' => 'guesture',
			'phoneNumber' => $transactionMeta[ 'customerPhoneNumber' ],
			'description' => $transactionMeta[ 'description' ],
			'amount' => $transactionMeta[ 'amount' ],
			'provider' => 'PayTM',
			'purchaseData' => [
				'unit' => $transactionMeta[ 'unit' ],
				'fromDate' => $transactionMeta[ 'fromDate' ],
				'toDate' => $transactionMeta[ 'toDate' ],
				'transaction' => $_POST
			]
		];
		Cupid::recordPurchase( $purchase );
	}

	$transactionString = base64_encode( json_encode( $transaction ) );
	$redirectURL = '/booking-confirmation' . '?q=' . $_GET[ 'q' ] . '&t=' . $transactionString;
	return header( 'Location: ' . $redirectURL, true, 302 );
	exit;

}
