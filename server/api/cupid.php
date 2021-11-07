<?php

require_once __DIR__ . '/../../conf.php';




class Cupid {

	public static $apiUrl = CUPID_API_ENDPOINT;



	public static function httpRequest ( $endpoint, $method = 'GET', $data = [ ] ) {

		$request = curl_init();
		curl_setopt( $request, CURLOPT_URL, $endpoint );
		curl_setopt( $request, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $request, CURLOPT_USERAGENT, 'Guestur' );
		$headers = [
			'Authorization: Bearer ' . GUESTURE_OAUTH_BEARER_TOKEN,
			'Cache-Control: no-cache, no-store, must-revalidate'
		];
		if ( ! empty( $data ) and is_array( $data ) ) {
			$headers[ ] = 'Content-Type: application/json';
			$requestBody = json_encode( $data );
			curl_setopt( $request, CURLOPT_POSTFIELDS, $requestBody );
		}
		curl_setopt( $request, CURLOPT_HTTPHEADER, $headers );
		curl_setopt( $request, CURLOPT_CUSTOMREQUEST, $method );
		$response = curl_exec( $request );
		curl_close( $request );

		$body = json_decode( $response, true );

		if ( empty( $body ) )
			return [ ];

		return $body;

	}



	/*
	 *
	 * ----- Record Purchase
	 *
	 */
	public static function recordPurchase ( $data ) {

		$endpoint = self::$apiUrl . '/v2/hooks/person-made-purchase';

		$requestBody = [
			'client' => $data[ 'client' ],
			'phoneNumber' => $data[ 'phoneNumber' ],
			'description' => $data[ 'description' ],
			'amount' => $data[ 'amount' ],
			'provider' => $data[ 'provider' ],
			'data' => $data[ 'purchaseData' ],
		];

		$responseBody = self::httpRequest( $endpoint, 'POST', $requestBody );

		if ( empty( $responseBody ) )
			return [ 'code' => 500 ];

		return [
			'code' => $responseBody[ 'code' ],
			'message' => $responseBody[ 'message' ]
		];

	}

}
