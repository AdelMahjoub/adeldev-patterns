<?php
/**
 * Title: Testimonials
 * Slug: adeldev-patterns/testimonials
 * Categories: testimonials
 * Keywords: testimonials, reviews, quotes, clients
 * Description: Section title and three quotes.
 * Viewport Width: 1400
 *
 * @package Adeldev_Patterns
 */

defined( 'ABSPATH' ) || exit;
?>
<!-- wp:group {"tagName":"section","align":"full","style":{"spacing":{"padding":{"top":"var:preset|spacing|60","bottom":"var:preset|spacing|60","left":"var:preset|spacing|50","right":"var:preset|spacing|50"},"blockGap":"var:preset|spacing|50"}},"layout":{"type":"constrained"}} -->
<section class="wp-block-group alignfull" style="padding-top:var(--wp--preset--spacing--60);padding-right:var(--wp--preset--spacing--50);padding-bottom:var(--wp--preset--spacing--60);padding-left:var(--wp--preset--spacing--50)"><!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"flex","orientation":"vertical","justifyContent":"center"}} -->
<div class="wp-block-group"><!-- wp:paragraph {"className":"is-style-text-annotation"} -->
<p class="is-style-text-annotation"><?php esc_html_e( 'Eyebrow', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph -->

<!-- wp:heading {"style":{"typography":{"textAlign":"center"}}} -->
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'What our clients say', 'adeldev-patterns' ); ?></h2>
<!-- /wp:heading --></div>
<!-- /wp:group -->

<!-- wp:group {"align":"wide","style":{"spacing":{"blockGap":"var:preset|spacing|40"}},"layout":{"type":"grid","columnCount":3,"minimumColumnWidth":"16rem"}} -->
<div class="wp-block-group alignwide"><!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'A short testimonial from a client, in their own words.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'First name, city', 'adeldev-patterns' ); ?></cite></blockquote>
<!-- /wp:quote -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'A short testimonial from a client, in their own words.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'First name, city', 'adeldev-patterns' ); ?></cite></blockquote>
<!-- /wp:quote -->

<!-- wp:quote -->
<blockquote class="wp-block-quote"><!-- wp:paragraph -->
<p><?php esc_html_e( 'A short testimonial from a client, in their own words.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --><cite><?php esc_html_e( 'First name, city', 'adeldev-patterns' ); ?></cite></blockquote>
<!-- /wp:quote --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
