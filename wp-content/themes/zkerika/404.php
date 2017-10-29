<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */

get_header(); ?>

<div id="primary" class="container">
	<main id="main" class="site-main" role="main">

		<section class="error-404 not-found">
			<header class="page-header">
				<h1 class="page-title"><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'zk-erika' ); ?></h1>
			</header>

			<div class="page-content">
				<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try a search?', 'zk-erika' ); ?></p>

				<?php get_search_form(); ?>
			</div>
		</section>

	</main>
</div>

<?php get_footer(); ?>
