
/*
 |
 | Book Trial Form
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm




var coworkingForm = new BFSForm( ".js_coworking_form" )

// The event(s) that trigger the form to appear
	// (the form is hidden by default)
$( ".js_enquire_coworking_seat" ).on( "click", function ( event ) {
	if ( Cupid.personIsLoggedIn() ) {
		let person = Cupid.getCurrentPerson()
		let interest = "Coworking Seat"
		if ( ! person.hasInterest( interest ) ) {
			person.setInterests( interest )
			Cupid.savePerson( person )
			PersonLogger.registerInterest( person, { sync: true } )
		}
		updateTriggerButtonText( "We'll call you shortly." )
	}
	else {
		hideTriggerButton()
		showLoginForm()
	}
} );

	// Phone number
coworkingForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
coworkingForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1

coworkingForm.submit = function submit ( data ) {
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setSourcePoint( "Coworking Seat" )

	Cupid.logPersonIn( person, { _trackSlug: "coworking-seat" } )

	let interest = "Coworking Seat"
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
$( document ).on( "submit", ".js_coworking_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	coworkingForm.disable();

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = coworkingForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		coworkingForm.enable()
		coworkingForm.fields[ error.fieldName ].focus()
		coworkingForm.setSubmitButtonLabel()
		return;
	}

	/*
	 | ----- Submit data
	 */
	coworkingForm.submit( data )
		.then( function ( response ) {
			hideLoginForm()
			showTriggerButton()
			updateTriggerButtonText( "We'll call you shortly." )
		} )

} )





/*
 |
 | Helper functions
 |
 */
function showLoginForm () {
	$( ".js_coworking_form" ).show()
}
function hideLoginForm () {
	$( ".js_coworking_form" ).hide()
}
function showTriggerButton () {
	$( ".js_enquire_coworking_seat" ).closest( "label" ).show()
}
function hideTriggerButton () {
	$( ".js_enquire_coworking_seat" ).closest( "label" ).hide()
}
function updateTriggerButtonText ( text ) {
	$( ".js_enquire_coworking_seat" ).text( text )
}





} )
