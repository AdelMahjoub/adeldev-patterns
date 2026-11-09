<?php
/**
 * Title: FAQ
 * Slug: adeldev-patterns/faq
 * Categories: text
 * Keywords: faq, questions, answers, accordion
 * Description: Section header and four questions that open on click.
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
<h2 class="wp-block-heading has-text-align-center"><?php esc_html_e( 'Frequently asked questions', 'adeldev-patterns' ); ?></h2>
<!-- /wp:heading -->

<!-- wp:paragraph {"style":{"typography":{"textAlign":"center"}}} -->
<p class="has-text-align-center"><?php esc_html_e( 'A short introduction to this section, in one or two sentences.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --></div>
<!-- /wp:group -->

<!-- wp:group {"style":{"spacing":{"blockGap":"var:preset|spacing|30"}},"layout":{"type":"constrained"}} -->
<div class="wp-block-group"><!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'A question your clients often ask?', 'adeldev-patterns' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'The answer, in a few clear sentences.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'A question your clients often ask?', 'adeldev-patterns' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'The answer, in a few clear sentences.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'A question your clients often ask?', 'adeldev-patterns' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'The answer, in a few clear sentences.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details -->

<!-- wp:details -->
<details class="wp-block-details"><summary><?php esc_html_e( 'A question your clients often ask?', 'adeldev-patterns' ); ?></summary><!-- wp:paragraph -->
<p><?php esc_html_e( 'The answer, in a few clear sentences.', 'adeldev-patterns' ); ?></p>
<!-- /wp:paragraph --></details>
<!-- /wp:details --></div>
<!-- /wp:group --></section>
<!-- /wp:group -->
