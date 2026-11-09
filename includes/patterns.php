<?php
/**
 * Registers the sections of patterns/*.php.
 *
 * Each file starts with the same header as a theme pattern (Title, Slug, Categories,
 * Keywords, Description, Viewport Width, Block Types, Inserter) followed by block markup.
 * The markup only uses core blocks and the presets every Twenty Twenty-Five child theme
 * defines (see README, "Preset contract"), so a section takes the look of the active theme.
 * Placeholder texts go through gettext; the file is included at registration time.
 *
 * @package Adeldev_Patterns
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'adeldev_patterns_register' );

/**
 * Registers every pattern file.
 */
function adeldev_patterns_register(): void {
	$headers = array(
		'title'         => 'Title',
		'slug'          => 'Slug',
		'description'   => 'Description',
		'categories'    => 'Categories',
		'keywords'      => 'Keywords',
		'viewportWidth' => 'Viewport Width',
		'blockTypes'    => 'Block Types',
		'inserter'      => 'Inserter',
	);

	foreach ( (array) glob( ADELDEV_PATTERNS_DIR . 'patterns/*.php' ) as $file ) {
		$data = get_file_data( $file, $headers );
		if ( '' === $data['slug'] || '' === $data['title'] ) {
			continue;
		}

		ob_start();
		include $file;
		$content = (string) ob_get_clean();

		$pattern = array(
			// phpcs:disable WordPress.WP.I18n.NonSingularStringLiteralText -- extracted from the file headers by make-pot.
			'title'      => translate_with_gettext_context( $data['title'], 'Pattern title', 'adeldev-patterns' ),
			// phpcs:enable
			'content'    => $content,
			'categories' => adeldev_patterns_list( $data['categories'] ),
			'keywords'   => adeldev_patterns_list( $data['keywords'] ),
		);
		if ( '' !== $data['description'] ) {
			// phpcs:ignore WordPress.WP.I18n.NonSingularStringLiteralText -- extracted from the file headers by make-pot.
			$pattern['description'] = translate_with_gettext_context( $data['description'], 'Pattern description', 'adeldev-patterns' );
		}
		if ( '' !== $data['viewportWidth'] ) {
			$pattern['viewportWidth'] = (int) $data['viewportWidth'];
		}
		if ( '' !== $data['blockTypes'] ) {
			$pattern['blockTypes'] = adeldev_patterns_list( $data['blockTypes'] );
		}
		if ( 'no' === strtolower( $data['inserter'] ) ) {
			$pattern['inserter'] = false;
		}

		register_block_pattern( $data['slug'], $pattern );
	}
}

/**
 * Comma-separated header value as a list.
 *
 * @return string[]
 */
function adeldev_patterns_list( string $value ): array {
	return array_values( array_filter( array_map( 'trim', explode( ',', $value ) ) ) );
}

/**
 * Slugs of this library's patterns.
 *
 * @return string[]
 */
function adeldev_patterns_slugs(): array {
	$slugs = array();
	foreach ( WP_Block_Patterns_Registry::get_instance()->get_all_registered() as $pattern ) {
		if ( str_starts_with( $pattern['name'], 'adeldev-patterns/' ) ) {
			$slugs[] = $pattern['name'];
		}
	}
	return $slugs;
}
