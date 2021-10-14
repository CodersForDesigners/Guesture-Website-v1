<?php

/*
 |
 | Register a global settings / options / meta-data page
 |
 */
if ( ! function_exists( 'acf_add_options_page' ) )
	return;

acf_add_options_page( [
	'page_title' => 'Site Meta and Content',
	'menu_title' => 'Site Meta and Content',
	'menu_slug' => 'site_meta_and_content',
	'capability' => 'edit_posts',
	'parent_slug' => '',
	'position' => '5',
	'icon_url' => 'dashicons-info'
] );
