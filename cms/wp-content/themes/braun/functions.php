<?php
/**
 * Brownie Fudge Sundae functions and definitions
 *
 * @package Brownie Fudge Sundae
 * @since 1.0.0
 */

define( 'THEME_SETTINGS_PATH', get_template_directory() . '/settings' );



require get_template_directory() . '/lib/utils.php';
require get_template_directory() . '/lib/hooks.php';



require_once THEME_SETTINGS_PATH . '/routing.php';
require_once THEME_SETTINGS_PATH . '/authentication.php';
require_once THEME_SETTINGS_PATH . '/url-auto-correction.php';

add_action( 'after_setup_theme', function () {

	// Theme supports
	require_once THEME_SETTINGS_PATH . '/theme-supports.php';
	// Document Title
	require_once THEME_SETTINGS_PATH . '/document-title.php';
	// Media settings
	require_once THEME_SETTINGS_PATH . '/media.php';
	// Custom Gutenberg Blocks
	require_once THEME_SETTINGS_PATH . '/custom-gutenberg-blocks.php';
	// Gutenberg Block editor settings
	require_once THEME_SETTINGS_PATH . '/gutenberg-block-editor.php';
	// Admin dashboard settings
	require_once THEME_SETTINGS_PATH . '/admin-dashboard.php';

} );



/*
 |
 | Data / Entity Types
 |
 */
require_once __ROOT__ . '/types/events/events.php';
require_once __ROOT__ . '/types/news/news.php';
require_once __ROOT__ . '/types/deals/deals.php';

use \BFS\Types;

/* ~ Events ~ */
Types\Events::setupGutenbergBlocks();
Types\Events::setupContentInputForm();
Types\Events::onSavingInstance();
Types\Events::onRenderingBlock();

/* ~ News ~ */
Types\News::setupGutenbergBlocks();
Types\News::setupContentInputForm();
Types\News::onSavingInstance();
Types\News::onRenderingBlock();

/* ~ Deals ~ */
Types\Deals::setupGutenbergBlocks();
Types\Deals::setupContentInputForm();
Types\Deals::onSavingInstance();
Types\Deals::onRenderingBlock();
