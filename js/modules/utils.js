
/*
 *
 * Wait for the specified number of seconds.
 * This facilitates a Promise or syncrhonous (i.e., using async/await ) style
 * 	of programming
 *
 */
function waitFor ( seconds ) {
	return new Promise( function ( resolve, reject ) {
		setTimeout( function () {
			resolve();
		}, seconds * 1000 );
	} );
}


/*
 |
 | HTTP Request function
 |
 | Relies on jQuery's ajax helper function
 |
 */
function httpRequest ( url, method, data, options ) {
	let ajaxParameters = {
		url,
		method,
		dataType: "json"
	}
	if ( [ "POST", "PUT" ].includes( method ) ) {
		ajaxParameters.data = JSON.stringify( data || { } )
		ajaxParameters.contentType = "application/json"
	}

	options = options || { }
	if ( options.sync )
		ajaxParameters.async = false

	let ajaxRequest = $.ajax( ajaxParameters )

	return new Promise( function ( resolve, reject ) {
		ajaxRequest.done( resolve )
		ajaxRequest.fail( function ( jqXHR, textStatus, e ) {
			var errorResponse = getErrorResponse( jqXHR, textStatus, e )
			reject( errorResponse )
		} )
	} );
}



/*
 |
 | Cookie abstraction
 |
 | Relies on the js-cookie library
 |
 */
window.CookieJar = function () {

	// Re-assign the library's namespace to a locally-scoped variable
	let Cookies = window.Cookies.noConflict()

	function setDefaultOptions ( options ) {
		options = options || { }

		if ( typeof options.expires === "number" && !Number.isNaN( options.expires ) )
			options.expires = 365
		else if ( ! ( options.expires instanceof Date ) )
			options.expires = 365

		options.secure = window.location.protocol.includes( "https" )

		return options
	}

	function get ( key ) {
		var data = Cookies.get( key );
		var parsedValue;
		if ( typeof data == "string" )
			parsedValue = JSON.parse( window.Base64.decode( data ) ).value
		else
			parsedValue = data;
		return parsedValue;
	}

	function set ( key, value, options ) {
		options = setDefaultOptions( options )
		value = window.Base64.encode( JSON.stringify( { value: value } ) )
		return Cookies.set( key, value, options )
	}

	function remove ( key, options ) {
		options = setDefaultOptions( options )
		return Cookies.remove( key, options )
	}

	return {
		get,
		set,
		remove
	}

}()



/*
 |
 | Handle error / exception response helper
 |
 */
function getErrorResponse ( jqXHR, textStatus, e ) {
	var code = -1;
	var message;
	if ( jqXHR.responseJSON ) {
		code = jqXHR.responseJSON.code || jqXHR.responseJSON.statusCode;
		message = jqXHR.responseJSON.message;
	}
	else if ( typeof e == "object" ) {
		message = e.stack;
	}
	else {
		message = jqXHR.responseText;
	}
	var error = new Error( message );
	error.code = code;
	return error;
}



/*
 *
 * Return a debounced version of a given function
 *
 */
function getDebouncedVersion ( fn, debounceBy ) {

	debounceBy = ( debounceBy || 1 ) * 1000;

	var timeoutId;
	var rafId;

	return function () {
		window.clearTimeout( timeoutId );
		timeoutId = window.setTimeout( function () {
			window.cancelAnimationFrame( rafId );
			rafId = window.requestAnimationFrame( fn );
		}, debounceBy );
	};

}


/*
 *
 * Return a throttled version of a given function
 *
 */

function getThrottledVersion ( fn, throttleBy ) {

	throttleBy = ( throttleBy || 1 ) * 1000;

	var timeoutId;

	function preparedFunction () {
		fn();
		timeoutId = null;
	}

	return function () {

		if ( timeoutId )
			return;

		timeoutId = window.setTimeout( function () {
			window.requestAnimationFrame( preparedFunction );
		}, throttleBy );

	};

}




/*
 *
 * Scroll Event Handling Hub
 *
 */
var registeredScrollHandlers = [ ];
function scrollHandler ( event ) {
	var _i, _len = registeredScrollHandlers.length;
	for ( _i = 0; _i < _len; _i += 1 ) {
		try {
			registeredScrollHandlers[ _i ]();
		}
		catch ( e ) {
			console.log( e.message );
			console.log( e.stack );
		}
	}
}
function onScroll ( handler, options ) {
	options = options || { };
	let preparedHandler = handler;
	if ( options.behavior == "debounce" )
		preparedHandler = getDebouncedVersion( handler, options.by );
	else if ( options.behavior == "throttle" )
		preparedHandler = getThrottledVersion( handler, options.by );

	registeredScrollHandlers = registeredScrollHandlers.concat( preparedHandler );
}
window.addEventListener( "scroll", scrollHandler );





/*
 *
 * Recur a given function every given interval
 *
 */
function executeEvery ( interval, fn ) {

	interval = ( interval || 1 ) * 1000;

	var timeoutId;
	var running = false;

	return {
		_schedule: function () {
			var _this = this;
			timeoutId = setTimeout( function () {
				window.requestAnimationFrame( function () {
					fn();
					_this._schedule()
				} );
			}, interval );
		},
		start: function () {
			if ( running )
				return;
			running = true;
			this._schedule();
		},
		stop: function () {
			clearTimeout( timeoutId );
			timeoutId = null;
			running = false;
		}
	}

}


/*
 |
 | This opens a new page in an iframe and closes it once it has loaded
 |
 */
function openPageInIframe ( url, name, options ) {

	options = options || { };
	var closeOnLoad = options.closeOnLoad || false;

	var $iframe = $( "<iframe>" );
	$iframe.attr( {
		width: 0,
		height: 0,
		title: name,
		src: url,
		style: "display:none;",
		class: "js_iframe_trac"
	} );

	$( "body" ).append( $iframe );

	if ( closeOnLoad ) {
		$( window ).one( "message", function ( event ) {
			if ( location.origin != event.originalEvent.origin )
				return;
			var message = event.originalEvent.data;
			if ( message.status == "ready" )
				setTimeout( function () { $iframe.remove() }, 19 * 1000 );
		} );
	}
	else {
		return $iframe.get( 0 );
	}

}


/*
 *
 * "Track" a page visit
 *
 * @params
 * 	name -> the url of the page
 *
 */
function trackPageVisit ( name ) {

	/*
	 *
	 * Open a blank page and add the tracking code to it
	 *
	 */
	// Build the URL
	var baseTrackingURL = ( "/" + __.settings.trackingURL + "/" ).replace( /(\/+)/g, "/" );
	var baseURL = location.origin.replace( /\/$/, "" ) + baseTrackingURL;
	name = name.replace( /^[/]*/, "" );
	var url = baseURL + name;

	// Build the iframe
	openPageInIframe( url, "", {
		closeOnLoad: true
	} );

}


/*
 *
 * Get the unique analytics id dropped by Google Analytics
 *
 */
function callFunctionIfNotCalledIn ( fn, seconds ) {

	var called = false;
	var seconds = seconds || 1;

	function theFunction () {
		if ( called )
			return;
		called = true;
		return fn.apply( this, [ ].slice.call( arguments ) );
	}

	setTimeout( theFunction, seconds * 1000 );

	return theFunction;

}


/*
 |
 | Get the current time and date stamp
 | 	(in Indian Standard Time)
 |
 | reference: https://stackoverflow.com/questions/22134726/get-ist-time-in-javascript
 |
 */
function getDateAndTimeStamp ( options ) {

	let dateObject = new Date

	// Date components
	let year = dateObject.getUTCFullYear();
	let month = ( dateObject.getUTCMonth() + 1 );
		if ( month < 10 ) month = "0" + month;
	let day = dateObject.getUTCDate();
		if ( day < 10 ) day = "0" + day;

	// Time components
	let hours = dateObject.getUTCHours();
		if ( hours < 10 ) hours = "0" + hours;
	let minutes = dateObject.getUTCMinutes();
		if ( minutes < 10 ) minutes = "0" + minutes;
	let seconds = dateObject.getUTCSeconds();
		if ( seconds < 10 ) seconds = "0" + seconds;
	let milliseconds = dateObject.getUTCMilliseconds();
		if ( milliseconds < 10 ) milliseconds = "00" + milliseconds;
		else if ( milliseconds < 100 ) milliseconds = "0" + milliseconds;

	// Assembling all the parts
	let datetimestamp = year
				+ "/" + month
				+ "/" + day

				+ " " + hours
				+ ":" + minutes
				+ ":" + seconds
				+ "." + milliseconds
				+ " UTC"

	return datetimestamp;

}



/*
 *
 * Get the unique analytics id dropped by Google Analytics
 *
 */
function getAnalyticsId ( trackerName ) {

	if ( ! window.ga )
		return Promise.resolve();

	return new Promise( function ( resolve, reject ) {
		var resolvePromise = callFunctionIfNotCalledIn( function ( value ) {
			if ( value )
				return resolve( value );
			else
				return resolve();
		} );
		ga( function ( defaultTracker ) {
			var tracker;
			if ( trackerName )
				tracker = ga.getByName( trackerName );
			if ( defaultTracker )
				tracker = defaultTracker;
			else
				tracker = ga.getAll()[ 0 ];

			return resolvePromise( tracker.get( "clientId" ) );
		} );
	} );

}
