<?php
/**
 * Plugin Name:       Adeldev Patterns
 * Plugin URI:        https://github.com/AdelMahjoub/adeldev-patterns
 * Description:       A library of ready-to-edit page sections (hero, cards, steps, key figures, testimonials, FAQ, gallery, call to action, contact, latest posts) made of core blocks only and styled by the active theme.
 * Version:           0.1.1
 * Requires at least: 6.9
 * Requires PHP:      8.1
 * Author:            Adel Mahjoub
 * Author URI:        https://adeldev.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       adeldev-patterns
 * Domain Path:       /languages
 * Update URI:        https://github.com/AdelMahjoub/adeldev-patterns
 *
 * @package Adeldev_Patterns
 */

defined( 'ABSPATH' ) || exit;

define( 'ADELDEV_PATTERNS_VERSION', '0.1.1' );
define( 'ADELDEV_PATTERNS_FILE', __FILE__ );
define( 'ADELDEV_PATTERNS_DIR', plugin_dir_path( __FILE__ ) );
define( 'ADELDEV_PATTERNS_REPOSITORY', 'AdelMahjoub/adeldev-patterns' );

add_action(
	'init',
	static function () {
		load_plugin_textdomain( 'adeldev-patterns', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	},
	0
);

require_once ADELDEV_PATTERNS_DIR . 'includes/patterns.php';
require_once ADELDEV_PATTERNS_DIR . 'includes/updater.php';

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	require_once ADELDEV_PATTERNS_DIR . 'includes/cli.php';
}
