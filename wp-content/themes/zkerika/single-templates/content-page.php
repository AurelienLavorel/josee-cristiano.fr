<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php 
		zkerika_post_media();
		zkerika_single_header();
	?>

	<div class="entry-content">
		<?php
		the_content();

		wp_link_pages( array(
			'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'zk-erika' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
		) );
		?>
	</div><!-- .entry-content -->
	<?php zkerika_single_footer(); ?>
</article><!-- #post-## -->
