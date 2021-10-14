<?php

namespace BFS\Types;

require_once __ROOT__ . '/lib/providers/wordpress.php';

use BFS\CMS\WordPress;

class Events {

	private static $typeSlug = 'event';

	public static function getPreparedData ( $content ) {

		if ( empty( $content ) )
			return $content;

		$now = date_create();
		$content->set( 'permalink', get_permalink( $content->get( 'ID' ) ) );
		$content->set( 'event_date', date_create( $content->get( 'event_date' ) ) );

		$difference = $now->diff( $content->get( 'event_date' ) );
		$contentIsBeforeNow = $difference->invert ? true : false;
		// $differenceInDays = (int) $difference->format( '%R%a' );
		$differenceInDays = ( $contentIsBeforeNow ? -1 : 1 ) * $difference->d;
		if ( $differenceInDays < 0 )
			$content->set( 'isBeforeToday', true );
		else if ( $differenceInDays === 0 ) {
			if (
				(int) $now->format( 'd' ) !== (int) $content->get( 'event_date' )->format( 'd' )
					and
				$contentIsBeforeNow
			)
				$content->set( 'isBeforeToday', true );
		}
		else
			$content->set( 'isBeforeToday', false );

		return $content;
	}

	public static function get ( $options = [ ] ) {
		WordPress::setupContext();
		return WordPress::findPostsOf(
			self::$typeSlug,
			$options,
			[ self::class, 'getPreparedData' ]
		);
	}

	public static function getBySlug ( $slug ) {
		WordPress::setupContext();
		return self::getPreparedData( WordPress::findPostBySlug( $slug, self::$typeSlug ) );
	}

	public static function getFromURL ( $slug = null ) {
		WordPress::setupContext();
		if ( ! is_string( $slug ) )
			return self::getPreparedData( WordPress::getThisPost() );
		else
			return self::getBySlug( $slug, self::$typeSlug );
	}

	public static function getFeatured () {
		WordPress::setupContext();
		return self::getPreparedData( WordPress::findPostsOf(
			self::$typeSlug,
			[
				'meta_key' => '_is_ns_featured_post',
				'meta_value' => 'yes'
			]
		)[ 0 ] ?? null );
	}

	public static function getAll () {
		WordPress::setupContext();
		return WordPress::findPostsOf(
			self::$typeSlug,
			[
				'orderby' => [
					'date' => 'DESC',
					'menu_order' => 'ASC'
				]
			],
			[ self::class, 'getPreparedData' ]
		);
	}



	public static function setupGutenbergBlocks () {
		add_action( 'acf/init', function () {
			if ( ! function_exists( 'acf_register_block_type' ) )
				return;

			acf_register_block_type( [
				'name' => 'bfs-events',
				'title' => __( 'Events' ),
				'description' => __( 'Events' ),
				'category' => CLIENT_SLUG,
				'icon' => 'groups',
				'align' => 'wide',
				'mode' => 'edit',
				'supports' => [
					'multiple' => false,
					'align' => [ 'wide' ]
				],
				'render_callback' => [ WordPress::class, 'acfRenderCallback' ]
			] );
		} );
	}

	public static function setupContentInputForm () {
		add_filter( 'register_post_type_args', function ( $args, $postType ) {
			if ( $postType !== self::$typeSlug )
				return $args;

			$args[ 'template' ] = [
				[ 'acf/bfs-events', [ 'lock' => [ 'remove' => true ] ] ],
				[ 'core/paragraph', [ 'placeholder' => 'Add event content here...' ] ]
			];

			return $args;
		}, 20, 2 );
	}





	private static function _onEditingInstance () {
		add_action( 'bfs/backend/on-editing-posts', function ( $postType ) {
			if ( $postType !== self::$typeSlug )
				return;

			WordPress::enqueueScript( 'something', '/js/hide-taxonomy-category-tag-panels.js' );
		} );
	}

	public static function onRenderingBlock () {
		add_action( 'bfs/init/frontend', function () {
			add_filter( 'pre_render_block', function ( $null, $block ) {
				if ( $block[ 'blockName' ] === 'acf/bfs-events' )
					return '';
				else
					return null;
			}, 10, 2 );
		} );
	}

	// Register a `save_post` action hook
	public static function onSavingInstance () {
		add_action( 'bfs/init/backend', function () {
		// add_action( 'bfs/backend/on-editing-posts', function ( $postType ) {
			// if ( $postType !== self::$typeSlug )
				// return;

			self::registerHook__OnSavingPost();
		} );
	}

	public static function registerHook__OnSavingPost () {
		add_action( 'save_post_' . self::$typeSlug, [ __CLASS__, 'hook__SavePost' ], 100, 3 );
	}

	public static function unregisterHook__OnSavingPost () {
		remove_action( 'save_post_' . self::$typeSlug, [ __CLASS__, 'hook__SavePost' ], 100, 3 );
	}

	public static function hook__SavePost ( $postId, $post, $postWasUpdated ) {

		// this hook is invoked _even_ when a revision is created, i.e. post type of "revision"
		if ( WordPress::getPostType( $postId ) !== self::$typeSlug )
			return;

		// Unregister the save_post action hook to prevent an infinite recursive loop
		self::unregisterHook__OnSavingPost();

		// Extract the custom data
		if ( function_exists( 'get_fields' ) )
			WordPress::$currentQueriedPostACF = get_fields( $postId ) ?: [ ];

		$content = get_post( $postId )->post_content ?? '';
		$content = apply_filters( 'the_content', $content );

		// Store custom data in the native `post_content_filtered` field
		wp_update_post( [ 'ID' => $postId, 'post_content_filtered' => serialize( WordPress::$currentQueriedPostACF ) ] );
		WordPress::$currentQueriedPostACF = [ ];

		// Re-register the action hook
		self::registerHook__OnSavingPost();

	}




	private static function _setupInstanceHooks () {
		// Register a `save_post` action hook
		add_action( 'save_post_' . self::$typeSlug, [ __CLASS__, '_savePostHook' ], 100, 3 );
	}

	private static function _backend () {
		self::setupGutenbergBlocks();
		self::onEditingInstance();
		self::setupContentInputForm();
		self::setupInstanceHooks();
	}

}
