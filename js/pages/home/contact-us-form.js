
/*
 |
 | Contact Us Form
 |
 |
 */
$( function () {

// Imports
let BFSForm = window.__BFS.exports.BFSForm




var contactUsForm = new BFSForm( ".js_contact_form" );

	// Name
contactUsForm.addField( "name", ".js_form_input_name", function ( values ) {
	let name = values[ 0 ]
	return BFSForm.validators.name( name )
} );

	// Email address
contactUsForm.addField( "emailAddress", ".js_form_input_email", function ( values ) {
	let emailAddress = values[ 0 ]
	return BFSForm.validators.emailAddress( emailAddress )
} );

	// Phone number
contactUsForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
contactUsForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1

contactUsForm.submit = function submit ( data ) {
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setName( data.name )
	person.setEmailAddress( data.emailAddress )
	person.setSourcePoint( "Contact Us Form" )

	Cupid.logPersonIn( person, { trackSlug: "general-enquiry-form" } )

	person.setExtendedAttributes( { requestToBeContactedMadeOn: getDateAndTimeStamp() } )
	Cupid.savePerson( person )
	PersonLogger.submitData( person )

	return Promise.resolve( person )
}





/*
 * ----- Form submission handler
 */
$( document ).on( "submit", ".js_contact_form", function ( event ) {

	/*
	 | ----- Prevent default browser behaviour
	 */
	event.preventDefault();

	/*
	 | ----- Prevent interaction with the form
	 */
	contactUsForm.disable();

	/*
	 | Provide feedback to the user
	 */
	contactUsForm.giveFeedback( "Sending..." )

	/*
	 | ----- Extract data (and report issues if found)
	 */
	var data;
	try {
		data = contactUsForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		contactUsForm.enable()
		contactUsForm.fields[ error.fieldName ].focus()
		contactUsForm.setSubmitButtonLabel()
		return;
	}

	/*
	 | ----- Submit data
	 */
	contactUsForm.submit( data )
		.then( function ( response ) {
			contactUsForm.giveFeedback( "We'll contact you shortly." )
		} )

} )





} )
