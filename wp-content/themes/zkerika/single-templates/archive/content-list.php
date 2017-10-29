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
$has_thumb = has_post_thumbnail();
if($has_thumb){
	$class = 'col-sm-7';
} else {
	$class = 'col-sm-12';
}
?>

<article <?php post_class('entry-archive entry-list'); ?>>
	<div class="row">
	<?php if($has_thumb){ ?>
	<div class="col-sm-5">
		<?php 
			zkerika_post_media('medium');  
		?>
	</div>
	<?php } ?>
	<div class="<?php echo esc_attr($class); ?>">
		<div class="entry-info">
			<?php zkerika_archive_header(); ?>
			<div class="entry-summary">
				<?php
				the_excerpt();

				wp_link_pages( array(
					'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'zk-erika' ) . '</span>',
					'after'       => '</div>',
					'link_before' => '<span>',
					'link_after'  => '</span>',
				) );
				?>
			</div>
			<?php zkerika_archive_footer(); ?>
		</div>
	</div>
	</div>
</article>
