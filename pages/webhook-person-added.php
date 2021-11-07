<?php

/* ------------------------------- \
 * Script Bootstrapping
 \-------------------------------- */
# * - Error Reporting
ini_set( 'display_errors', 1 );
ini_set( 'error_reporting', E_ALL );
# * - Request Permissions
header( 'Access-Control-Allow-Origin: *' );
# * - Date and Timezone
date_default_timezone_set( 'Asia/Kolkata' );
# * - Prevent Script Cancellation by Client
ignore_user_abort( true );
# * - Script Timeout
set_time_limit( 0 );



/* ------------------------------- \
 * Request Parsing
 \-------------------------------- */
# Get JSON as a string
$json = file_get_contents( 'php://input' );
# Convert the JSON string to an object
$error = null;
try {
	$input = json_decode( $json );
	$input = $input->data;
}
catch ( \Exception $e ) {
	$error = $e->getMessage();
}



/* ------------------------------------- \
 * Pull in the dependencies
 \-------------------------------------- */
require_once __DIR__ . '/../lib/datetime.php';
require_once __DIR__ . '/../lib/deprecated-google-forms.php';



/* ------------------------------------- \
 * Ingest the data onto the Spreadsheet
 \-------------------------------------- */
# Interpret the data
$when = CFD\DateTime::getSpreadsheetDateFromISO8601( $input->when );
$emailAddresses = empty( $input->emailAddresses ) ? '' : implode( ', ', $input->emailAddresses );
$interests = empty( $input->interests ) ? '' : implode( ', ', $input->interests );
# Shape the data
$data = [
	'when' => $when,
	'id' => $input->id,
	'phoneNumber' => $input->phoneNumber,
	'emailAddress' => $emailAddresses,
	'verified' => $input->verified,
	'sourceMedium' => $input->source->medium,
	'sourcePoint' => $input->source->point ?? $input->agent->name ?? $input->agent->phoneNumber ?? '',
	'interests' => $interests,
	'callRecording' => $input->recordingURL ?? ''
];
GoogleForms\submitPersonIngestion( $data );
// $spreadsheet->addRow( $data );



/* ------------------------------- \
 * Response Preparation
 \-------------------------------- */
# Set Headers
header_remove( 'X-Powered-By' );
header( 'Content-Type: application/json' );

# Respond back to client
$output = $error ?: $data ?: [ ];
echo json_encode( $output, JSON_PRETTY_PRINT );
