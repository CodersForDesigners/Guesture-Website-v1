
wp.domReady( function () {

	/*
	 * ----- Ensure that the Gutenberg editor cannot be switched to the _code_ mode
	 */
	// Data store action dispatchers
	let setEditorMode = wp.data.dispatch( 'core/edit-post').switchEditorMode;	// "text" or "visual"

} );
