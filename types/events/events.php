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

}
