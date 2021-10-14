<?php

$pagePath = $_SERVER[ 'DOCUMENT_ROOT' ] . '/' . $_GET[ 'path' ];
$augmentSnippets = $_GET[ 'with' ];
if ( ! is_array( $augmentSnippets ) )
	$augmentSnippets = [ $augmentSnippets ];

$augmentCode = '';
foreach ( $augmentSnippets as $snippetName ) {
	$snippetFilePath = __DIR__ . '/snippets/' . $snippetName . '.php';
	$augmentCode .= file_get_contents( $snippetFilePath );
}

$pageCode = file_get_contents( $pagePath );
// Inject the snippet right before the closing body tag
echo preg_replace( '/<\/body>\s*<\/html>\s*$/', $augmentCode, $pageCode ) . '</body></html>';
