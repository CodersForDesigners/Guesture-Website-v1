
/*
 |
 | Women's Block Form
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm




var womensBlockForm = new BFSForm( ".js_womens_block_form" )

// The event(s) that trigger the form to appear
	// (the form is hidden by default)
$( ".js_book_womens_block" ).on( "click", function ( event ) {
	if ( Cupid.personIsLoggedIn() ) {
		let person = Cupid.getCurrentPerson()
		let interest = "Women's-only Block"
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
womensBlockForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
womensBlockForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1

womensBlockForm.submit = function submit ( data ) {
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setSourcePoint( "Women's Block" )

	Cupid.logPersonIn( person, { _trackSlug: "block-women-room" } )

	let interest = "Women's-only Block"
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
$( document ).on( "submit", ".js_womens_block_form", function ( event ) {

	/*
	 * ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 * ----- Prevent interaction with the form
	 */
	womensBlockForm.disable();

	/*
	 * ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = womensBlockForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		womensBlockForm.enable()
		womensBlockForm.fields[ error.fieldName ].focus()
		womensBlockForm.setSubmitButtonLabel()
		return;
	}

	/*
	 | ----- Submit data
	 */
	womensBlockForm.submit( data )
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
	$( ".js_womens_block_form" ).show()
}
function hideLoginForm () {
	$( ".js_womens_block_form" ).hide()
}
function showTriggerButton () {
	$( ".js_book_womens_block" ).closest( "label" ).show()
}
function hideTriggerButton () {
	$( ".js_book_womens_block" ).closest( "label" ).hide()
}
function updateTriggerButtonText ( text ) {
	$( ".js_book_womens_block" ).text( text )
}





} )
