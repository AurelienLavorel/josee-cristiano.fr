<?php
/**
 * The default template for displaying content
 *
 * Used for single post related
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
?>

<article <?php post_class('related-item'); ?>>
	<?php 
		zkerika_post_media();  
	?>
	<div class="entry-info">
	<?php zkerika_archive_header(); ?>
	<div class="entry-summary">
		<?php
			zkerika_post_excerpt('140', false)
		?>
	</div>
	<?php zkerika_archive_footer(); ?>
	</div>
</article>
