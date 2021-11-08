<?php

namespace BFS\Types;

require_once __ROOT__ . '/lib/providers/wordpress.php';
require_once __ROOT__ . '/lib/utils.php';

use BFS\CMS\WordPress;

class Deals {

	private static $typeSlug = 'deal';

	public static function getPreparedData ( $content ) {

		if ( empty( $content ) )
			return $content;

		$now = date_create();
		$content->set( 'permalink', get_permalink( $content->get( 'ID' ) ) );
		$content->set( 'expiryDate', date_create( $content->get( 'deal_expiry_date' ) ) );
		$content->set(
			'expiryDateISOString',
			$content->get( 'expiryDate' )->format( 'Y-m-d' ) . 'T' . $content->get( 'expiryDate' )->format( 'H:i:s.v' ) . 'Z'
		);
		$content->set( 'timeRemaining', getIntervalString( $content->get( 'deal_expiry_date' ) ) );

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
				'name' => 'bfs-deals',
				'title' => __( 'Deals' ),
				'description' => __( 'Deals' ),
				'category' => CLIENT_SLUG,
				'icon' => 'money-alt',
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
				[ 'acf/bfs-deals' ]
			];
			$args[ 'template_lock' ] = 'all';

			return $args;
		}, 20, 2 );
	}

}
