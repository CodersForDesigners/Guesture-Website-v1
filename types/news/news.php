<?php

namespace BFS\Types;

require_once __ROOT__ . '/lib/providers/wordpress.php';

use BFS\CMS\WordPress;

class News {

	private static $typeSlug = 'news';

	public static function getPreparedData ( $content ) {

		if ( empty( $content ) )
			return $content;

		$now = date_create();
		$content->set( 'permalink', get_permalink( $content->get( 'ID' ) ) );
		$content->set( 'news_date', date_create( $content->get( 'post_date' ) ) );

		return $content;
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

	public static function getAllExcludingUnlisted () {
		WordPress::setupContext();
		return WordPress::findPostsOf(
			self::$typeSlug,
			[
				'orderby' => [
					'date' => 'DESC',
					'menu_order' => 'ASC'
				],
				'exclude' => [ 442, 460 ]
			],
			[ self::class, 'getPreparedData' ]
		);
	}

	public static function getFromURL ( $slug = null ) {
		WordPress::setupContext();
		if ( ! is_string( $slug ) )
			return self::getPreparedData( WordPress::getThisPost() );
		else
			return self::getBySlug( $slug, self::$typeSlug );
	}

	public static function getBySlug ( $slug ) {
		WordPress::setupContext();
		return self::getPreparedData( WordPress::findPostBySlug( $slug, self::$typeSlug ) );
	}



	public static function setupGutenbergBlocks () {
		add_action( 'acf/init', function () {
			if ( ! function_exists( 'acf_register_block_type' ) )
				return;

			acf_register_block_type( [
				'name' => 'bfs-news',
				'title' => __( 'News' ),
				'description' => __( 'News' ),
				'category' => CLIENT_SLUG,
				'icon' => 'clock',
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
				[ 'acf/bfs-news', [ 'lock' => [ 'remove' => true ] ] ],
				[ 'core/paragraph', [ 'placeholder' => 'Add news content here...' ] ]
			];

			return $args;
		}, 20, 2 );
	}

}
