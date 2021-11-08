
/*
 |
 | Book Trial Form
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm




var trialForm = new BFSForm( ".js_the_trial_form" );

// The event(s) that trigger the form to appear
	// (the form is hidden by default)
// trialForm.addTrigger( function () {} );
$( ".js_book_trial" ).on( "click", function ( event ) {
	if ( Cupid.personIsLoggedIn() ) {
		let person = Cupid.getCurrentPerson()
		let interest = "3-day Trial"
		if ( ! person.hasInterest( interest ) ) {
			person.setInterests( interest )
			Cupid.savePerson( person )
			PersonLogger.registerInterest( person, { sync: true } )
		}
		updateTriggerButtonText( "Click here to book." )
		navigateToBookingPage()
	}
	else {
		hideTriggerButton()
		showLoginForm()
	}
} );

	// Phone number
trialForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
trialForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1

trialForm.submit = function submit ( data ) {
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setSourcePoint( "Book 3-day Trial" )

	Cupid.logPersonIn( person, { trackSlug: "three-day-trial" } )

	let interest = "3-day Trial"
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
$( document ).on( "submit", ".js_the_trial_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	trialForm.disable();

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = trialForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		trialForm.enable()
		trialForm.fields[ error.fieldName ].focus()
		trialForm.setSubmitButtonLabel()
		return;
	}

	/*
	 | ----- Submit data
	 */
	trialForm.submit( data )
		.then( function ( response ) {
			hideLoginForm()
			showTriggerButton()
			updateTriggerButtonText( "Click here to book." )
			navigateToBookingPage()
		} )

} )





/*
 |
 | Helper functions
 |
 */
function showLoginForm () {
	$( ".js_the_trial_form" ).show()
}
function hideLoginForm () {
	$( ".js_the_trial_form" ).hide()
}
function showTriggerButton () {
	$( ".js_book_trial" ).closest( "label" ).show()
}
function hideTriggerButton () {
	$( ".js_book_trial" ).closest( "label" ).hide()
}
function updateTriggerButtonText ( text ) {
	$( ".js_book_trial" ).text( text )
}
function navigateToBookingPage () {
	var package = window.__BFS.livingSituations[ "solo" ];
	var url = window.__BFS.getUnitBookingURL( package );
	window.location.href = url;
}





} )
