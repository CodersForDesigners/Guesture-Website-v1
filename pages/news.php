<?php
/*
 |
 |	News page
 |
 */

require_once __ROOT__ . '/lib/routing.php';
require_once __ROOT__ . '/lib/utils.php';
require_once __ROOT__ . '/types/news/news.php';

use BFS\Router;
use BFS\Types\News;

$thisNews = News::getFromURL();

// If the news post is intended to lead to an external website, then redirect to that URL if the news post is accessed directly through its URL.
	// NOTE: A news post's URL can be discovered through the sitemap.
if ( ! empty( $thisNews->get( 'news_source_link / url' ) ) ) {
	return Router::redirectTo( $thisNews->get( 'news_source_link / url' ) );
	exit;
}

?>

<?php require_once __ROOT__ . '/pages/partials/header.php'; ?>





<style type="text/css">
	ul { list-style: none; }
	figure { margin: 0 auto; }
</style>
<!-- Post Content -->
<section class="document-navigation space-50-top space-25-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-6 medium-3 medium-offset-1 xlarge-2 xlarge-offset-2 space-min">
				<a href="/" class="block"><svg class="block no-pointer" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1190 350"><text style="opacity: 0;">Guesture</text><path fill="#2E343D" d="M104.06 231.68c0 10.6-2.76 19.13-8.29 25.58-6.22 7.83-15.56 11.76-28 11.76-14.06 0-25.82-4.61-35.26-13.84l-28 28.35c16.13 15.68 37.92 23.51 65.33 23.51 23.74 0 42.98-7.03 57.74-21.09 14.06-13.83 21.09-31.69 21.08-53.59V59.15h-43.21V76.1c-11.54-12.67-26.17-19-43.92-19-18.21 0-32.62 5.3-43.21 15.91C6.1 85.21 0 108.95 0 144.21c0 35.5 6.1 59.24 18.32 71.22 10.6 10.61 24.89 15.91 42.86 15.91 4.61 0 8.99-.35 13.13-1.03v-39.07c-11.98-.23-20.28-5.19-24.88-14.86-3.01-6.69-4.49-17.41-4.49-32.16 0-14.74 1.49-25.58 4.49-32.5 4.6-9.44 12.9-14.16 24.88-14.16 11.99 0 20.29 4.72 24.89 14.16 3.23 6.92 4.84 17.76 4.84 32.5l.02 87.46zM449.41 185.68c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.74-3.46-27.66-10.38-6.68-6.45-10.37-15.09-11.05-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.44-18.67 29.73-18.67 14.28 0 24.32 6.22 30.07 18.67 2.31 5.75 3.69 12.1 4.16 19.01h-39.42v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.73-24.19-23.51 0-42.29 7.94-56.36 23.85-14.29 16.36-21.43 38.84-21.43 67.41 0 61.08 27.55 91.62 82.63 91.62 26.5 0 49.2-9.34 68.11-28.01l-27.32-26.63zM636.42 183.61c0 19.13-7.37 33.88-22.13 44.25-13.83 9.68-31.92 14.52-54.28 14.52-33.88 0-59.46-8.65-76.75-25.92l29.39-29.39c11.29 11.29 27.31 16.94 48.06 16.94 21.21 0 31.8-6.23 31.8-18.67 0-9.91-6.33-15.45-19.01-16.59l-28.35-2.77c-35.03-3.46-52.55-20.28-52.55-50.47 0-17.97 7.03-32.27 21.08-42.87 12.91-9.68 29.05-14.53 48.4-14.53 30.89 0 53.81 7.03 68.79 21.08l-27.66 28c-8.98-8.06-22.92-12.1-41.83-12.09-17.05 0-25.58 5.77-25.58 17.29 0 9.21 6.23 14.4 18.67 15.56l28.35 2.76c35.74 3.47 53.6 21.09 53.6 52.9z"/><path fill="#2E343D" d="M702.44 240.3c-17.06 0-30.31-5.42-39.76-16.24-8.3-9.45-12.44-21.2-12.44-35.26V99.6h-19.02V65.37h19.02V12.14h44.93v53.23h31.81V99.6h-31.81v86.43c0 10.84 5.19 16.25 15.56 16.25h16.26v38.03l-24.55-.01zM846.94 240.3v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.3-42.52-15.9-12.22-12.22-18.33-29.27-18.33-51.17V60.19h44.94v108.89c0 11.29 3.23 19.83 9.69 25.59 5.3 4.84 11.99 7.25 20.05 7.25 8.3 0 15.1-2.41 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V60.18h44.94l.01 180.11-43.91.01zM1014.58 109.27c-7.15-7.15-15.09-10.71-23.85-10.71-7.62 0-14.18 2.65-19.71 7.95-6.22 6.22-9.33 14.63-9.33 25.23V240.3h-44.94l-.01-180.11h43.91v17.29c10.84-12.91 25.93-19.37 45.29-19.37 17.05 0 31.22 5.65 42.52 16.94l-33.88 34.22zM1152.17 185.66c-11.07 11.31-24.55 16.95-40.45 16.95-11.52 0-20.75-3.46-27.66-10.38-6.69-6.45-10.37-15.09-11.06-25.93h-.35v-1.73-1.03-31.47c.23-6.91 1.61-13.25 4.15-19.01 5.54-12.45 15.45-18.67 29.73-18.67 14.3 0 24.32 6.22 30.08 18.67 2.31 5.75 3.69 12.1 4.15 19.01h-39.41v30.77h83.32v-20.05c0-25.12-6.8-45.52-20.4-61.18-14.06-16.13-33.3-24.19-57.74-24.19-23.51 0-42.29 7.94-56.34 23.85-14.3 16.36-21.43 38.84-21.43 67.41 0 61.08 27.54 91.62 82.62 91.62 26.5 0 49.21-9.34 68.11-28.01l-27.32-26.63zM270.27 180.11v-16.59c-11.75 12.45-26.73 18.67-44.95 18.67-17.74 0-31.92-5.31-42.52-15.91-12.22-12.22-18.32-29.26-18.32-51.16V0h44.94v108.89c0 11.29 3.22 19.82 9.67 25.59 5.31 4.83 11.99 7.26 20.05 7.26 8.3 0 15.1-2.43 20.4-7.26 6.45-5.77 9.68-14.3 9.68-25.59V0h44.94l.01 180.11h-43.9z"/><path fill="#65BB87" d="M189.13 200.96h105.3c10.9 0 19.74 8.84 19.75 19.74V326c0 10.9-8.84 19.74-19.74 19.75h-105.3c-10.9 0-19.74-8.84-19.75-19.74v-105.3c-.01-10.91 8.83-19.75 19.74-19.75z"/></svg></a>
			</div>
		</div>
	</div>
</section>

<section class="document-header space-25-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1 xlarge-8 xlarge-offset-2 space-min">
				<!-- Title -->
				<div class="title h2"><?= $thisNews->get( 'post_title' ) ?></div>
			</div>

			<div class="columns small-12 medium-10 medium-offset-1 large-6 xlarge-5 xlarge-offset-2 space-min">
				<!-- Thumbnail -->
				<div class="thumbnail" style="background-image: url( '<?= $thisNews->get( 'news_featured_image / sizes / medium' ) ?>' );"></div>
			</div>

			<div class="columns small-12 medium-10 medium-offset-1 large-4 xlarge-3 large-offset-0 space-min">
				<!-- Date -->
				<div class="inline date h5 text-uppercase"><span class="h3 inline" style="line-height: 0.7;"><?= $thisNews->get( 'news_date' )->format( 'd' ) ?></span><br><?= $thisNews->get( 'news_date' )->format( 'M' ) ?></div>
			</div>
		</div>
	</div>
</section>

<section class="post-content _document-section space-50-bottom">
	<div class="container">
		<div class="row">
			<div class="columns small-12 medium-10 medium-offset-1 xlarge-8 xlarge-offset-2 space-min">
				<div class="content"><?= $thisNews->get( 'content' ) ?></div>
			</div>
		</div>
	</div>
</section>
<!-- END: Post Content -->





<?php require_once __ROOT__ . '/pages/partials/footer.php'; ?>
