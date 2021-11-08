
/*
 |
 | Pricing Forms
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm




var pricingBookingForm = new BFSForm( ".js_pricing_booking_form" );

// The event(s) that trigger the form to appear
	// (the form is hidden by default)
$( document ).on( "click", ".js_book_solo, .js_book_buddy, .js_book_trio", function ( event ) {
	if ( Cupid.personIsLoggedIn() ) {
		let roomType = getRoomType( event.target )
		let interest = `${roomType} Room`
		let person = Cupid.getCurrentPerson()
		if ( ! person.hasInterest( interest ) ) {
			person.setInterests( interest )
			Cupid.savePerson( person )
			PersonLogger.registerInterest( person, { sync: true } )
		}
		transformTriggerButtonToPayTMButton( roomType )
		navigateToBookingPage( roomType )
	}
	else {
		hideTriggerButton( event.target )
		showLoginForm( event.target )
	}
} )

	// Phone number
pricingBookingForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
pricingBookingForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1

pricingBookingForm.submit = function submit ( data ) {
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setSourcePoint( `Pricing Section - ${data.roomType} Room` )

	Cupid.logPersonIn( person, { trackSlug: `pricing-book-${data.roomType.toLowerCase()}` } )

	let interest = `${data.roomType} Room`
	if ( ! person.hasInterest( interest ) ) {
		person.setInterests( interest )
		Cupid.savePerson( person )
		PersonLogger.registerInterest( person, { sync: true } )
	}

	return Promise.resolve( person )
}





/*
 * ----- Form submission handler
 */
$( document ).on( "submit", ".js_pricing_booking_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 | Get a reference to the form
	 */
	let $form = $( event.target ).closest( "form" )
	let currentForm = pricingBookingForm.bind( $form )

	/*
	 * ----- Prevent interaction with the form
	 */
	currentForm.disable();

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = currentForm.getData();
		data.roomType = getRoomType( event.target )
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		currentForm.enable()
		currentForm.fields[ error.fieldName ].focus()
		return;
	}

	/*
	 | ----- Submit data
	 */
	currentForm.submit( data )
		.then( function ( response ) {
			transformTriggerButtonToPayTMButton( data.roomType )
			hideLoginForm( event.target )
			waitFor( 0.5 ).then( function () {
				navigateToBookingPage( data.roomType )
			} )
		} )

} )





/*
 |
 | Helper functions
 |
 */
function hideTriggerButton ( domNode ) {
	$( domNode ).closest( "label" ).hide()
}
function showLoginForm ( domNode ) {
	$( domNode ).closest( ".js_room_type" ).find( ".js_pricing_booking_form" ).show()
}
function hideLoginForm ( domNode ) {
	$( domNode ).closest( ".js_room_type" ).find( ".js_pricing_booking_form" ).hide()
	// $( event.target ).closest( ".js_pricing_booking_form" ).hide()
}
function getRoomType ( domNode ) {
	return $( domNode )
		.closest( ".js_room_type" )
		.data( "room" )
}
function transformTriggerButtonToPayTMButton ( roomType ) {
	$( `.js_book_${roomType.toLowerCase()}` )
		.addClass( "fill-paytm-blue no-pointer" )
		.text( "Make Payment" )
		.closest( "label" )
			.show()
}
function navigateToBookingPage ( roomType ) {
	var package = window.__BFS.livingSituations[ roomType.toLowerCase() ];
	var url = window.__BFS.getUnitBookingURL( package );
	window.location.href = url;
}





} )
