<?php

require_once __DIR__ . '/guesture.php';

// Parse input from the request, reject if empty
require_once __DIR__ . '/../../lib/api-script-mandatory-input-parsing.php';

$type = $input[ 'type' ];
$location = $input[ 'location' ] ?? '';
$hasBalcony = strtolower( $input[ 'balcony' ] ) === 'attached' ? 1 : 0;
$hasBathroom = strtolower( $input[ 'bathroom' ] ) === 'attached' ? 1 : 0;
$fromDateString = $input[ 'fromDateString' ];
$toDateString = $input[ 'toDateString' ];
$durationUnit = $input[ 'durationUnit' ];
$durationAmount = $input[ 'durationAmount' ];

if ( strtolower( $location ) === 'dwellington - blr' )
	$location = 'dw';
else if ( strtolower( $location ) === 'alta vista - blr' )
	$location = 'av';


$stayPackage = $location . '-' . $type;
if ( $type !== 'trio' ) {
	$stayPackage .= '-';
	$stayPackage .= $hasBalcony === 1 ? 'yesbal' : 'nobal';
	$stayPackage .= '-';
	$stayPackage .= $hasBathroom === 1 ? 'yesbath' : 'nobath';
}

$response = Guesture::getUnitAvailability( [
	'stayPackage' => $stayPackage,
	'location' => $location,
	'hasBalcony' => $hasBalcony,
	'hasBathroom' => $hasBathroom,
	'fromDate' => $fromDateString,
	'toDate' => $toDateString,
	'durationUnit' => $durationUnit,
	'durationAmount' => $durationAmount
] );


/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );

# Respond back to client
echo json_encode( $response );
exit;
