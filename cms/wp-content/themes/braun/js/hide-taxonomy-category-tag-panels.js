
/*
 |
 | Hide the core taxonomies (category and tag) panels, and the custom taxonomy ones as well
 |
 */
wp.domReady( function () {

     // Core
	wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-category" );
	wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-post_tag" );
     // Custom
     wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-travel_program_category" );
     wp.data.dispatch( 'core/edit-post').removeEditorPanel( "taxonomy-panel-virtual_series_category" );

} );
