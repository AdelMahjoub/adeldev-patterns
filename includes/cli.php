<?php
/**
 * WP-CLI: `wp patterns list|sync`.
 *
 * `sync` turns a section of the library into a synced pattern (a `wp_block` post,
 * "My patterns" in the editor): edited once, updated everywhere it is inserted. The
 * pattern it came from is kept in the `_adeldev_pattern` meta, so running the command
 * again does not create a duplicate.
 *
 * @package Adeldev_Patterns
 */

defined( 'ABSPATH' ) || exit;

/**
 * Lists the library and creates synced patterns from it.
 */
class Adeldev_Patterns_Command {

	/**
	 * Lists the library's patterns.
	 *
	 * ## OPTIONS
	 *
	 * [--format=<format>]
	 * : table, csv, json or yaml.
	 * ---
	 * default: table
	 * ---
	 *
	 * @param array $args       Positional arguments.
	 * @param array $assoc_args Options.
	 */
	public function list( array $args, array $assoc_args ): void {
		$registry = WP_Block_Patterns_Registry::get_instance();
		$rows     = array();
		foreach ( adeldev_patterns_slugs() as $slug ) {
			$pattern = $registry->get_registered( $slug );
			$rows[]  = array(
				'slug'       => $slug,
				'title'      => $pattern['title'],
				'categories' => implode( ', ', $pattern['categories'] ?? array() ),
				'synced'     => $this->synced( $slug ) ? '#' . $this->synced( $slug ) : '',
			);
		}
		WP_CLI\Utils\format_items( $assoc_args['format'] ?? 'table', $rows, array( 'slug', 'title', 'categories', 'synced' ) );
	}

	/**
	 * Creates a synced pattern from a section of the library.
	 *
	 * ## OPTIONS
	 *
	 * <slug>
	 * : Pattern slug, with or without the "adeldev-patterns/" prefix (e.g. cta).
	 *
	 * [--title=<title>]
	 * : Name of the synced pattern. Default: the pattern title.
	 *
	 * [--update]
	 * : Replace the content of an existing synced pattern made from this section
	 * (edits made on the site are lost).
	 *
	 * ## EXAMPLES
	 *
	 *     wp patterns sync cta --title="Call to action — booking"
	 *
	 * @param array $args       Positional arguments.
	 * @param array $assoc_args Options.
	 */
	public function sync( array $args, array $assoc_args ): void {
		$slug    = str_contains( $args[0], '/' ) ? $args[0] : 'adeldev-patterns/' . $args[0];
		$pattern = WP_Block_Patterns_Registry::get_instance()->get_registered( $slug );
		if ( ! $pattern ) {
			WP_CLI::error( "Unknown pattern: $slug" );
		}

		$existing = $this->synced( $slug );
		if ( $existing && empty( $assoc_args['update'] ) ) {
			WP_CLI::success( "Synced pattern #$existing already exists (use --update to replace its content)." );
			return;
		}

		$post = array(
			'post_type'    => 'wp_block',
			'post_status'  => 'publish',
			'post_title'   => $assoc_args['title'] ?? $pattern['title'],
			'post_content' => $pattern['content'],
		);
		if ( $existing ) {
			$post['ID'] = $existing;
		}
		$id = wp_insert_post( wp_slash( $post ), true );
		if ( is_wp_error( $id ) ) {
			WP_CLI::error( $id );
		}
		update_post_meta( $id, '_adeldev_pattern', $slug );
		WP_CLI::success( ( $existing ? 'Updated' : 'Created' ) . " synced pattern #$id from $slug." );
	}

	/**
	 * ID of the synced pattern made from a section, or 0.
	 *
	 * @param string $slug Pattern slug.
	 */
	private function synced( string $slug ): int {
		$ids = get_posts(
			array(
				'post_type'      => 'wp_block',
				'post_status'    => 'any',
				'meta_key'       => '_adeldev_pattern', // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_key -- CLI only.
				'meta_value'     => $slug, // phpcs:ignore WordPress.DB.SlowDBQuery.slow_db_query_meta_value -- CLI only.
				'fields'         => 'ids',
				'posts_per_page' => 1,
			)
		);
		return (int) ( $ids[0] ?? 0 );
	}
}

WP_CLI::add_command( 'patterns', 'Adeldev_Patterns_Command' );
