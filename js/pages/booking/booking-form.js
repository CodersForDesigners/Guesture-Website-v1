
/**
 |
 | Booking Form
 |
 |
 */
$( function () {	/* START: jQuery DOM ready callback */
window.__BFS.fetchPricingInformation.then( function () {	/* START: promise then callback */



// Imports
let accomodationSelection = window.__BFS.accomodationSelection;
let accomodationType = accomodationSelection.type.toLowerCase();
let livingSituation = window.__BFS.livingSituations[ accomodationType ];
let BFSForm = window.__BFS.exports.BFSForm


/**
 |
 | Payment options
 |
 | Auto-select and set the details on the various payment options
 |
 */
let monthlyExpenseAmount = livingSituation.amountPerMonth;
let securityDepositAmount = monthlyExpenseAmount * 2;
let securityDepositAmountFormatted = formatNumberToIndianRupee( securityDepositAmount, { symbol: true } );
$( ".js_price_options [ data-type = 'deposit' ] .js_amount" ).text( "(" + securityDepositAmountFormatted + ")" )
$( ".js_price_options [ data-type = 'deposit' ] input" ).data( "amount", securityDepositAmount );
// The auto-selection of the option has to be scheduled later because the parent element is currently hidden.
	// Hence, the `change` event handlers won't be triggered
setTimeout( function () {
	if ( __BFS.accomodationSelection.duration.toLowerCase().includes( "trial" ) )
		$( ".js_price_options [ data-type = 'trial' ] input" ).trigger( "change" );
	else
		$( ".js_price_options [ data-type = 'booking' ] input" ).trigger( "change" );
}, 300 )

/*
 | When the payment option changes
 */
$( document ).on( "change", ".js_price_options input", function ( event ) {

	let $option = $( event.target );

	// Check the radio input (happens automatically, but still)
	$option.attr( "checked", true );

	// Reset the date field
	if ( window.__BFS.fromDatePicker )
		window.__BFS.fromDatePicker.setDate();

	// Extract the information represented by this option
	let amount = $option.data( "amount" );
	let description = $option.data( "desc" );
	setPayment( amount, description );

} );


/**
 |
 | Form setup
 |
 */
let bookingForm = new BFSForm( ".js_booking_form" );

	// Name
bookingForm.addField( "name", ".js_form_input_name", function ( values ) {
	let name = values[ 0 ]
	return BFSForm.validators.name( name )
} );

	// Email address
bookingForm.addField( "emailAddress", ".js_form_input_email", function ( values ) {
	let emailAddress = values[ 0 ]
	return BFSForm.validators.emailAddress( emailAddress )
} );

	// From date
		// Validation and value fetching
bookingForm.addField( "fromDate", ".js_form_input_from_date", function ( values ) {
	let fromDate = values[ 0 ]

	// The date should be in the format: YYYY-MM-DD (where Y, M, and D are digits)
	fromDate = fromDate.replace( /[^\d\-]/g, "" )
	let dateParts = fromDate.split( /\D/ )

	if ( dateParts.length !== 3 )
		throw new Error( "Please provide a valid date." );

	let [ year, month, day ] = dateParts
	if (
		year.length !== 4
		|| month.length !== 2
		|| day.length !== 2
	)
		throw new Error( "Please provide a valid date." );

	return fromDate
} );

	// From date
		// Set up the date picker widget
window.__BFS.fromDatePicker = datepicker( ".js_booking_from_date", {
	disableMobile: true,
	formatter: function ( input, date, instance ) {
		let dateComponents = getDateComponents( date );
		let year = dateComponents.year;
		let month = dateComponents.month;
		let day = dateComponents.day;
		let formattedDateString = year + "-" + month + "-" + day;
		input.value = formattedDateString;
	},
	onSelect: function ( instance, date ) {
		if ( ! ( date instanceof Date ) )
			instance.el.value = "";
	},
	// When a date is selected, the date widget disappears
	onHide: function ( instance ) {
		if ( ! ( instance.dateSelected instanceof Date ) )
			return;
		if ( window.__BFS.fromDate__Previous === instance.el.value )
			return;
		checkAvailabilityHandler( livingSituation, instance.dateSelected );
		window.__BFS.fromDate__Previous = instance.el.value;
	}
} )

	// From date
		// On value change handler
window.__BFS.fromDate__Previous = $( bookingForm.fields[ "fromDate" ].selectors[ 0 ] ).val()
$( bookingForm.fields[ "fromDate" ].selectors[ 0 ] ).on( "blur", function ( event ) {
	let dateString
	try {
		dateString = bookingForm.fields[ "fromDate" ].get()
	}
	catch ( e ) {
		return
	}

	if ( window.__BFS.fromDate__Previous === dateString )
		return;

	let dateParts = dateString.split( /\D/ );
	let date = new Date( dateParts[ 0 ], --dateParts[ 1 ], dateParts[ 2 ] );

	// Manually set the date on the date widget and initiate the selection flow
	let fromDatePicker = window.__BFS.fromDatePicker
	fromDatePicker.setDate( date );
	fromDatePicker.hide();
	fromDatePicker.onHide( fromDatePicker );

	window.__BFS.fromDate__Previous = dateString;
} )


	// Phone number
bookingForm.addField( "phoneNumber", [ ".js_phone_country_code", ".js_form_input_phonenumber" ], function ( values ) {
	let [ phoneCountryCode, phoneNumberLocal ] = values
	return BFSForm.validators.phoneNumber( phoneCountryCode, phoneNumberLocal )
} );
// When programmatically focusing on this input field, which of the (two, in this case) input elements to focus on?
bookingForm.fields[ "phoneNumber" ].defaultDOMNodeFocusIndex = 1



bookingForm.submit = function submit ( data ) {

	/*
	 | Prepare user session and log the data
	 */
	let person = Cupid.getCurrentPerson( data.phoneNumber )
	person.setName( data.name )
	person.setEmailAddress( data.emailAddress )
	person.setSourcePoint( "Booking Form" )

	Cupid.logPersonIn( person, { _trackSlug: "booking-form" } )

	let unitDetails = JSON.parse( window.Base64.decode( ( new URLSearchParams( location.search ) ).get( "q" ) ) );
	unitDetails.id = window.__BFS.unitId;
	let booking = {
		description: window.__BFS.bookingDescription,
		unit: unitDetails,
		amount: window.__BFS.bookingAmount,
		fromDate: window.__BFS.bookingFromDate,
		toDate: window.__BFS.bookingToDate
	}

	person.setExtendedAttributes( { booking } )
	Cupid.savePerson( person )
	PersonLogger.submitData( person )

	/*
	 | Initiate the payment flow
	 */
	let transactionData = {
		phoneNumber: person.phoneNumber,
		name: person.name,
		emailAddress: person.emailAddress,
		booking: booking
	}
	getPaymentTransactionParameters( {
		phoneNumber: data.phoneNumber,
		emailAddress: data.emailAddress,
		name: data.name,
		booking
	} )
		.then( makeSynchronousPOSTRequest )

}





/*
 * ----- Form submission handler
 */
$( document ).on( "submit", ".js_booking_form", function ( event ) {

	/*
	 | ----- Prevent default browser behaviour
	 */
	event.preventDefault();


	/*
	 | Re-run/simulate the inputting of all the form fields
	 |
	 | This is so that all the data that is processed and stored in JS memory is ensured to be there.
	 | This will not be case when the page is navigated to via the back/forward buttons.
	 |
	 | For example, this measure protects against a scenario where,
	 |  1. the user is on the PayTM page
	 |  2. clicks the browser back button
	 |  3. then hits the Pay/Submit button again
	 |
	 */
	// $( ".js_price_options input:checked" ).trigger( "change" )
	$( bookingForm.fields[ "fromDate" ].selectors[ 0 ] ).trigger( "blur" )


	/*
	 | ----- Prevent interaction with the form
	 */
	bookingForm.disable( function ( domForm ) {
		// Provide feedback to the user
		$( domForm ).find( "[ type = 'submit' ]" ).attr( "data-state", "processing" );
	} );


	/*
	 | Extract data (and report issues if found)
	 */
	var data;
	try {
		data = bookingForm.getData();
	} catch ( error ) {
		alert( error.message )
		console.error( error.message )
		bookingForm.enable( function ( domForm ) {
			$( domForm ).find( "[ type = 'submit' ]" ).attr( "data-state", "initial" );
		} )
		bookingForm.fields[ error.fieldName ].focus()
		return;
	}

	/*
	 | ----- Submit data
	 */
	bookingForm.submit( data )

} )





/*
 |
 | Helper functions
 |
 */
function getDateComponents ( date ) {
	var year = date.getFullYear()
	var month = ( date.getMonth() + 1 ).toString().padStart( 2, "0" );
	var day = ( date.getDate() ).toString().padStart( 2, "0" );
	return {
		year: year,
		month: month,
		day: day
	}
}

function getDateString ( date ) {
	var dateComponents = getDateComponents( date );
	var dateString = dateComponents.day + "/" + dateComponents.month + "/" + dateComponents.year;
	return dateString;
}

function formatNumberToIndianRupee ( number, options ) {

	options = options || { };
	var formattedNumber;

	var roundedNumber = number.toFixed( 0 );
	var integerAndFractionalParts = ( roundedNumber + "" ).split( "." );
	var integerPart = integerAndFractionalParts[ 0 ];
	var fractionalPart = integerAndFractionalParts[ 1 ];

	var lastThreeDigitsOfIntegerPart = integerPart.slice( -3 );
	var allButLastThreeDigitsOfIntegerPart = integerPart.slice( 0, -3 );

	formattedNumber = allButLastThreeDigitsOfIntegerPart.replace( /\B(?=(\d{2})+(?!\d))/g, "," );

	if ( allButLastThreeDigitsOfIntegerPart ) {
		formattedNumber += ",";
	}
	formattedNumber += lastThreeDigitsOfIntegerPart;

	if ( fractionalPart ) {
		formattedNumber += "." + fractionalPart;
	}

	var symbol = options.symbol === false ? "" : "₹";
	if ( /^-/.test( formattedNumber ) ) {
		formattedNumber = formattedNumber.replace( /^-/, "minus " + symbol );
	}
	else {
		formattedNumber = symbol + formattedNumber;
	}

	return formattedNumber;

}



/*
 *
 * Pretend to check availability for a given unit
 *
 */
function pretendToCheckAvailability () {
	return waitFor( 2.7 );
}



/*
 *
 * Check availability for given unit and time frame
 *
 */
function checkAvailability ( unitDetails, fromDate, duration ) {

	/*
	 | Prepare the payload to the external API
	 */
	var toDate = new Date( fromDate.getTime() + ( duration.inDays * 24 * 60 * 60 * 1000 ) );

	var fromDateString = getDateString( fromDate );
	var toDateString = getDateString( toDate );

	var data = unitDetails;
	data.durationUnit = duration.unit;
	data.durationAmount = duration.amount;
	data.fromDateString = fromDateString;
	data.toDateString = toDateString;

	/*
	 | Some hardcoded dates that guarantee a success or failure response
	 */
	if ( fromDateString === "19/10/2021" )
		return Promise.resolve( { success: true } );
	else if ( fromDateString === "31/10/2021" )
		return Promise.resolve( { success: false } );

	return httpRequest( "/server/api/unit-availability.php", "POST", data )

}

function checkAvailabilityHandler ( livingSituation, date ) {

	var durationInWords = livingSituation.duration.toLowerCase();
	var pricingOption = window.__BFS.bookingDescription.toLowerCase();

	/*
	 * ----- Disable the form
	 */
	// Disable the date picker
	$( ".js_booking_from_date" ).prop( "disabled", true );
	bookingForm.disable( function ( domForm ) {
		// Provide feedback to the user
		$( domForm ).find( "[ type = 'submit' ]" ).attr( "data-state", "checking" );
	} );


	/*
	 * ----- (Pretend to) check for unit availability IF the "3-day trial" option was selected
	 */
	if ( pricingOption.includes( "trial" ) ) {
		return pretendToCheckAvailability()
				.then( function () {
					bookingForm.enable( function ( domForm ) {
						$( domForm ).find( "[ type = 'submit' ]" ).attr( "data-state", "initial" );
					} )
				} )
	}

	var unitDetails = {
		type: livingSituation.type,
		location: livingSituation.location,
		balcony: livingSituation.balcony,
		bathroom: livingSituation.bathroom
	};

	var durationAmount;
	var durationUnit;
	var durationInSeconds;
	if ( livingSituation.duration.toLowerCase === "3 day trial" ) {
		durationAmount = 3;
		durationUnit = "days"
		durationInSeconds = durationAmount * 24 * 60 * 60;
	}
	else {
		durationAmount = parseInt( livingSituation.duration, 10 );;
		durationUnit = "months"
		durationInSeconds = durationAmount * 30 * 24 * 60 * 60;
	}

	// FOR NOW: We're hard-coding the duration amount
	var hardcodedDuration = {
		unit: "months",
		amount: 2,
		inDays: 60
	};

	return checkAvailability( unitDetails, date, hardcodedDuration )
		.then( function ( response ) {
			// Re-enable the form
			bookingForm.enable( function ( domForm ) {
				$( domForm ).find( "[ type = 'submit' ]" ).attr( "data-state", "initial" );
			} )
			// Disable / Enable the "Book Now" button
			if ( response.success ) {
				livingSituation.fromDateString = getDateString( date );
				window.__BFS.bookingFromDate = livingSituation.fromDateString;
				var toDate = new Date( date.getTime() + durationInSeconds * 1000 );
				livingSituation.toDateString = getDateString( toDate );
				window.__BFS.bookingToDate = livingSituation.toDateString;
				window.__BFS.unitId = response.inventoryId;
			}
			else {
				livingSituation.fromDateString = null;
				window.__BFS.bookingFromDate = null;
				livingSituation.toDateString = null;
				window.__BFS.bookingToDate = livingSituation.toDateString;
				alert( "The date " + getDateString( date ) + " is unavailable." );
				window.__BFS.fromDatePicker.setDate();
				window.__BFS.fromDatePicker.onHide( window.__BFS.fromDatePicker );
				window.__BFS.fromDate__Previous = "";
				window.__BFS.unitId = null;
			}
		} )
		.catch( function () {
			// Re-enable the date picker
			$( ".js_booking_from_date" ).prop( "disabled", false );
		} )
}

/*
 | Set payment data (in memory and on the markup)
 */
function setPayment ( amount, description ) {
	window.__BFS.bookingAmount = amount;
	window.__BFS.bookingDescription = description;
	$( ".js_booking_amount" ).text( amount );
}

function getPaymentTransactionParameters ( data ) {
	return httpRequest( "/server/get-paytm-transaction-params.php", "POST", data )
}

function makeSynchronousPOSTRequest ( parameters ) {
	let formMarkup = "<form method=\"POST\" action=\"" + window.__BFS.payTMGatewayURL + "\" name=\"post_form\">";
	for ( let key in parameters )
		formMarkup += "<input type=\"hidden\" name=\"" + key + "\" value=\"" + parameters[ key ] + "\">";
	formMarkup += "</form>";
	let $form = $( formMarkup )
	$( document.body ).append( $form )
	$form.get( 0 ).submit()
}



} )	/* END: promise then callback */
} )	/* END: jQuery DOM ready callback */
