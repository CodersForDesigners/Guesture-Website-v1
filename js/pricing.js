
$( function () {

	window.__BFS = window.__BFS || { };

	function getUnitBookingURL ( package ) {
		return window.location.origin + "/booking?q=" + package.toString();
	}
	window.__BFS.getUnitBookingURL = getUnitBookingURL;

	/*
	 * Convert a number to it alphabetical reprentation
	 */
	var convertNumberToLetter = function () {
		var numberLetterMap = {
			"1": "A", "2": "B", "3": "C", "4": "D", "5": "E", "6": "F", "7": "G", "8": "H", "9": "I", "10": "J", "11": "K", "12": "L", "13": "M", "14": "N", "15": "O", "16": "P", "17": "Q", "18": "R", "19": "S", "20": "T", "21": "U", "22": "V", "23": "W", "24": "X", "25": "Y", "26": "Z"
		};
		return function convertNumberToLetter ( number ) {
			if ( number < 27 )
				return numberLetterMap[ number ];

			var quotient = Math.floor( number / 26 );
			var remainder = number % 26;
			if ( remainder === 0 ) {
				quotient -= 1;
				remainder = 26;
			}
			return convertNumberToLetter( quotient ) + numberLetterMap[ remainder ];
		};
	}();

	/*
	 * Returns a (stringified) <option> element
	 */
	function createSelectOption ( value, label ) {
		if ( typeof label != "string" )
			label = value;
		return "<option value=\"" + value + "\">" + label + "</option>";
	}

	// Four types of living setups
	function LivingSituation ( type ) {
		this.type = type;
		this.cost
		this.$el = $( ".js_" + type + "_section" );
		this.numbers
		this.sheetCoordinates
		// this.costCalculator = { Sheets: { numbers: costCalculators[ type ] } };
		var _this = this;
		this.$el.on( "change", ".js_attribute", function ( event ) {
			// Extract the key-value pair whose value changed
			var $attribute = $( event.target );
			var name = $attribute.data( "name" );
			var value = $attribute.val();
			// A change in location has to reflect everywhere on the page, not just on the pricing engine
			if ( name == "location" ) {
				event.preventDefault();
				_this.$el.trigger( "location/change", {
					location: value
				} );
				return;
			}

			_this.setField( name, value );

			// Re-compute the values
			_this.computeDetails();
			// Re-render the newly computed values
			_this.renderComputedDetails();
		} );

		// A dedicated handler for when the location changes
		$( document ).on( "location/change", function ( event, data ) {
			var location = data.location;
			// Set the location value on the location input element
			_this.$el.find( ".js_location" ).val( location );

			_this.setField( "location", location );

			// Re-compute the values
			_this.computeDetails();
			// Re-render the newly computed values
			_this.renderComputedDetails();
		} );
	}

	// Update the given field with the given value
	LivingSituation.prototype.toString = function toString () {
		var data = {
			type: this.type,
			balcony: this.balcony,
			bathroom: this.bathroom,
			duration: this.duration,
			location: this.location
		};
		if ( this.fromDateString )
			data.fromDateString = this.fromDateString;
		if ( this.toDateString )
			data.toDateString = this.toDateString;
		var queryParameterString = btoa( JSON.stringify( data ) );
		return queryParameterString;
	};

	// Update the given field with the given value
	LivingSituation.prototype.setField = function ( name, value ) {
		if ( ! this.sheetCoordinates[ name ] )
			return;
		// If the provided value is not a valid one
		if ( this[ name + "Options" ] )
			if ( ! this[ name + "Options" ].includes( value ) )
				throw new Error;
		// Reflect the new value in memory
		this[ name ] = value;
		// Reflect the new value in the spreadsheet's in-memory representation
		this.numbers.Sheets[ this.type ][ this.sheetCoordinates[ name ] ].v = value;
	};

	LivingSituation.prototype.computeDetails = function ( ) {
		XLSX_CALC( this.numbers );
		var sheet = this.numbers.Sheets[ this.type ];
		// Pull out the values
		this.amountBasedOnConfiguration = sheet[ this.sheetCoordinates.perDay ].v;
		this.monthlyFee = sheet[ this.sheetCoordinates.monthlyFee ].v;
		this.amountPerMonth = sheet[ this.sheetCoordinates.rackRate ].v;	// confusing, I know
		this.monthlyFeeFormatted = sheet[ this.sheetCoordinates.monthlyFeeFormatted ].v;
		this.monthlyFeeStatement = sheet[ this.sheetCoordinates.feeSentence ].v;
		this.photo = sheet[ this.sheetCoordinates.photo ].v;
		this.panorama = sheet[ this.sheetCoordinates.panorama ].v;
		this.virtualTour = sheet[ this.sheetCoordinates.virtualTour ].v;
		this.summary = sheet[ this.sheetCoordinates.summary ].v;
		this.room = sheet[ this.sheetCoordinates.room ].v;
		this.suite = sheet[ this.sheetCoordinates.suite ].v;
		this.services = sheet[ this.sheetCoordinates.services ].v;
		this[ "add-ons" ] = sheet[ this.sheetCoordinates[ "add-ons" ] ].v;
	};
	LivingSituation.prototype.render = function () {
		this.$el.find( ".js_image" ).attr( "media/pricing/rooms/" + this.photo );
		this.$el.find( ".js_panorama" ).attr( "src", this.panorama );
		this.$el.find( ".js_balcony" ).html(
			this.balconyOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_bathroom" ).html(
			this.bathroomOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_duration" ).html(
			this.durationOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_location" ).html(
			this.locationOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_view" ).html(
			this.viewOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_ac" ).html(
			this[ "a/cOptions" ].map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_smoking" ).html(
			this.smokingOptions.map( createSelectOption ).join( "" )
		);
		this.$el.find( ".js_diet" ).html(
			this.dietOptions.map( createSelectOption ).join( "" )
		);
		this.renderComputedDetails();
	};
	LivingSituation.prototype.renderComputedDetails = function () {
		this.$el.find( ".js_daily_expense" ).text( this.amountBasedOnConfiguration );
		this.$el.find( ".js_monthly_expense" ).text( this.monthlyFee );
		this.$el.find( ".js_panorama" ).attr( "src", this.panorama );
		if ( this.amountBasedOnConfiguration === "" || this.monthlyFee === "" )
			this.$el.addClass( "invalid" );
		else
			this.$el.removeClass( "invalid" );
		// this.$el.find( ".js_image" ).attr( "src", "media/pricing/rooms/" + this.photo );
		this.$el.find( ".js_image" ).attr( "src", "/content/media/photo/" + this.photo );
	};

	/*
	 * Fetch and returns the spreadsheet data structure
	 */
	function getNumbers () {

		var url = "/content/data/numbers.json" + "?t=" + ( new Date() ).getTime();

		var ajaxRequest = $.ajax( {
			url: url,
			method: "GET",
			dataType: "json"
		} );

		return new Promise( function ( resolve, reject ) {
			ajaxRequest.done( function ( response ) {
				resolve( response );
			} );
			ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
				var errorResponse = getErrorResponse( jqXHR, textStatus, e );
				reject( errorResponse );
			} );
		} );

	}

	function getData ( sheet ) {
		var rows = sheet._meta.rows;
		var columns = sheet._meta.columns;
		var data = { sheetCoordinates: { } };
		for ( var _r = 1; _r < rows; _r += 1 ) {
			var keyCell = sheet[ "A" + _r ];
			if ( ! keyCell )
				continue;
			// ignore fields beginning with an "_"
			// 	they are for internal use
			if ( keyCell.v.indexOf( "_" ) === 0 )
				continue;
			var keyName = keyCell.v.toLowerCase().split( /\s+/ ).map( function ( part ) {
				return part[ 0 ].toUpperCase() + part.slice( 1 );
			} ).join( "" );
			keyName = keyName[ 0 ].toLowerCase() + keyName.slice( 1 );
			var valueCell = sheet[ "B" + _r ];
			data[ keyName ] = valueCell.v;
			data.sheetCoordinates[ keyName ] = "B" + _r;
			if ( valueCell.pv )
				data[ keyName + "Options" ] = valueCell.pv;
		}
		return data;
	}

	function setupPricingSection ( numbers ) {
		var livingSituationsData = { solo: null, buddy: null, trio: null };
		for ( var type in livingSituationsData ) {
			livingSituationsData[ type ] = getData( numbers[ type ] );
		}

		// Set up the data
		livingSituations = { };
		for ( var type in livingSituationsData ) {
			var livingSituation = new LivingSituation( type );
			for ( var _k in livingSituationsData[ type ] )
				livingSituation[ _k ] = livingSituationsData[ type ][ _k ];

			// REDO: Optimization: Should probably remove this
			livingSituation.numbers = { Sheets: { SETTINGS: numbers.SETTINGS } };
			livingSituation.numbers.Sheets[ type ] = numbers[ type ];
			// Set the default values from the markup and then compute
			livingSituation.render();
			livingSituation.$el.find( ".js_attribute" ).each( function ( _i, el ) {
				var $attribute = $( el );
				var name = $attribute.data( "name" );
				// REDO: This is confusing. Are we pulling the initial value from the markup?
				// var value = $attribute.val();
				// var coordinateOnSheet = livingSituation.sheetCoordinates[ name ];
				// livingSituation[ name ] = value;
				// livingSituation.numbers.Sheets[ type ][ coordinateOnSheet ].v = value;

				var coordinateOnSheet = livingSituation.sheetCoordinates[ name ];
				var value = livingSituation.numbers.Sheets[ type ][ coordinateOnSheet ].v;
				livingSituation[ name ] = value;
				$attribute.val( value );
			} );
			// REDO: Have to relegate this bit to the spreadsheet somehow
			if ( type == "trio" ) {
				livingSituation.$el.find( ".js_location" ).val( "Dwellington - BLR" );
				livingSituation.location = "Dwellington - BLR";
				var location__SheetCoordinate = livingSituation.sheetCoordinates.location;
				livingSituation.numbers.Sheets.trio[ location__SheetCoordinate ].v = "Dwellington - BLR";
			}

			livingSituation.computeDetails();
			// Re-render the newly computed values
			livingSituation.renderComputedDetails();

			livingSituations[ type ] = livingSituation;
		}

		return livingSituations;

	}

	function setupNearbyPlaces ( numbers ) {

		// REDO: This bit needs to be done properly
		var locationOptions = Object.entries( numbers.SETTINGS.locations );

		if ( ! $( ".js_places_near_to" ).length )
			return;

		// Initialize the locations in the Nearby Places section
		$( ".js_places_near_to" ).html( locationOptions.map( function ( location ) {
			return createSelectOption( location[ 1 ], location[ 0 ] );
		} ) );

		$placesNearTo = $( ".js_places_near_to" );
		var locations = [ ].slice.call( $( ".js_workplaces" ) ).map( function ( domLocation ) {
			return domLocation.dataset.name;
		} );

		$placesNearTo.on( "change", function ( event ) {
			// Get the location
			var location = $placesNearTo.val();
			// Broadcast the change of location
			$placesNearTo.trigger( "location/change", { location: location } );
		} );

		/*
		 * When a location is selected, update the carousel of places that nearby
		 * and update the Google Maps link as well
		 */
		$( document ).on( "location/change", function ( event, data ) {

			var selectedLocation = data.location;

			// Set the new value
			$placesNearTo.val( selectedLocation );
			var presentableLocationName = "@" + selectedLocation.replace( /\s+-\s+.+/, "" );
			$placesNearTo
				.closest( ".js_location_selector_container" )
				.find( ".js_place" )
				.text( presentableLocationName );

			// Get the workspaces to show
			var workplaceSection = locations.filter( function ( thisLocation ) {
				return selectedLocation.toLowerCase().indexOf( thisLocation ) !== -1;
			} );

			if ( ! workplaceSection.length )
				return;

			// Show the corresponding Google Map links
			$( ".js_location_selector_container .js_google_maps" ).addClass( "hidden" );
			$( ".js_location_selector_container .js_google_maps[ data-name = '" + workplaceSection[ 0 ] + "' ]" ).removeClass( "hidden" );

			// Show the corresponding workspaces
			$( ".js_workplaces" ).addClass( "hidden" );
			$( ".js_workplaces[ data-name = '" + workplaceSection[ 0 ] + "' ]" ).removeClass( "hidden" );

		} );

	}


	/*
	 *
	 * Populating the modal with information on the package that was clicked
	 *
	 */
	var $whatIsIncludedSection = $( ".js_section_what_is_included" );
	var whatIsIncludedFields = {
		$bookNow: $whatIsIncludedSection.find( ".js_book_from_modal" ),
		$name: $whatIsIncludedSection.find( ".js_name" ),
		$monthlyExpense: $whatIsIncludedSection.find( ".js_monthly_expense" ),
		$monthlyFeeStatement: $whatIsIncludedSection.find( ".js_monthly_fee_statement" ),
		$location: $whatIsIncludedSection.find( ".js_location" ),
		$summary: $whatIsIncludedSection.find( ".js_summary" ),
		$virtualTourContainer: $whatIsIncludedSection.find( ".js_virtual_tour_container" ),
		$virtualTour: $whatIsIncludedSection.find( ".js_virtual_tour" ),
		$room: $whatIsIncludedSection.find( ".js_room" ),
		$suite: $whatIsIncludedSection.find( ".js_suite" ),
		$services: $whatIsIncludedSection.find( ".js_services" ),
		$addOns: $whatIsIncludedSection.find( ".js_addons" ),
		$locationImagesContainer: $whatIsIncludedSection.find( ".js_location_images_container" ),
		$locationImages: $whatIsIncludedSection.find( ".js_location_images" ),
		$locationAddress: $whatIsIncludedSection.find( ".js_location_address" ),
		$locationGoogleMaps: $whatIsIncludedSection.find( ".js_location_google_maps" )
	};
	function setContentOnWhatIsIncludedSection ( packageName ) {
		var package = livingSituations[ packageName ];

		// Prepare the "Book Now" button
		whatIsIncludedFields.$bookNow.data( "product", packageName[ 0 ].toUpperCase() + packageName.slice( 1 ) );
		whatIsIncludedFields.$bookNow.data( "c", "pricing-modal-book-" + packageName );
		whatIsIncludedFields.$bookNow.text( whatIsIncludedFields.$bookNow.data( "initial-text" ) );
		whatIsIncludedFields.$bookNow.prop( "disabled", false );
		// Un-hide the "Book Now" button region
		whatIsIncludedFields.$bookNow.closest( ".js_login_trigger_region" ).show();

		whatIsIncludedFields.$name.text( packageName[ 0 ].toUpperCase() + packageName.slice( 1 ) );
		whatIsIncludedFields.$monthlyExpense.text( package.monthlyFeeFormatted );
		whatIsIncludedFields.$monthlyFeeStatement.html( package.monthlyFeeStatement );
		whatIsIncludedFields.$location.text( package.location );
		whatIsIncludedFields.$summary.text( package.summary );
		whatIsIncludedFields.$virtualTour.attr( "src", package.virtualTour );
		if ( package.virtualTour )
			whatIsIncludedFields.$virtualTourContainer.removeClass( "hidden" );
		else
			whatIsIncludedFields.$virtualTourContainer.addClass( "hidden" );
		whatIsIncludedFields.$room.html( package.room.replace( /\n/g, "<br>" ) );
		whatIsIncludedFields.$suite.html( package.suite.replace( /\n/g, "<br>" ) );
		whatIsIncludedFields.$services.html( package.services.replace( /\n/g, "<br>" ) );
		whatIsIncludedFields.$addOns.html( package[ "add-ons" ].replace( /\n/g, "<br>" ) );
		var locationImagesMarkup = package.locationImages.trim()
			.split( "\n" )
			.filter( function ( image ) {
				return image;
			} )
			.map( function ( image ) {
				var parts = image.split( " ~ " );
				return {
					url: parts[ 1 ] || parts[ 0 ],
					caption: parts[ 1 ] ? parts[ 0 ] : ""
				}
			} )
			.reduce( function ( markup, image ) {
				return markup + `<div class="carousel-list-item js_carousel_item">
					<div class="image" style="background-image: url( '${ image.url }' )"><span class="label caption">${ image.caption }</span></div>
				</div>`
			}, "" )
		whatIsIncludedFields.$locationImages.html( locationImagesMarkup );
		if ( ! locationImagesMarkup )
			whatIsIncludedFields.$locationImagesContainer.addClass( "hidden" );
		else
			whatIsIncludedFields.$locationImagesContainer.removeClass( "hidden" );
		whatIsIncludedFields.$locationAddress.html( package.locationAddress.split( "\n" ).join( "<br>" ) );
		whatIsIncludedFields.$locationGoogleMaps.attr( "href", package.locationGoogleMaps );
	}
	window.__BFS.setContentOnWhatIsIncludedSection = setContentOnWhatIsIncludedSection;


	/*
	 *
	 * Main execution point
	 *
	 */
	// 1. Import custom spreadsheet functions
	XLSX_CALC.import_functions( window.spreadsheetFormulae );

	// Okay, now go fetch them numbers!
	var livingSituations;
	window.__BFS.fetchPricingInformation = getNumbers()
		.then( function ( numbers ) {
			livingSituations = setupPricingSection( numbers );
			window.__BFS.livingSituations = livingSituations;
			setupNearbyPlaces( numbers );
			return numbers;
		} )

} );
