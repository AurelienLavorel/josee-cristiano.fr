<?php
/**
 * The template for displaying a "No posts found" message
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
?>
<article id="post-0" class="post no-results not-found">
	<div class="entry-header">
		<h2 class="entry-title"><?php esc_html_e( 'Nothing Found', 'zk-erika' ); ?></h2>
	</div>
	<div class="entry-content">
		<p><?php esc_html_e( 'Apologies, but no results were found. Perhaps searching will help find a related post.', 'zk-erika' ); ?></p>
		<?php get_search_form(); ?>
	</div>
</article>