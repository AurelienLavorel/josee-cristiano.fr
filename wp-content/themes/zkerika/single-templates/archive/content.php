<?php
/**
 * The default template for displaying content
 *
 * Used for index/archive/author/search.
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
$format = get_post_format();
?>

<article <?php post_class('entry-archive entry-standard'); ?>>
	<?php 
		zkerika_post_media();  
	?>
	<div class="entry-info">
		<?php zkerika_archive_header(); ?>
		<div class="entry-summary">
			<?php
				the_excerpt();
			?>
		</div>
		<?php zkerika_archive_footer(); ?>
	</div>
</article>
