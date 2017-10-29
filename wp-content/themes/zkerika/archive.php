<?php
/**
 * The template for displaying Archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, SP ChariyPlus already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
/* get side-bar position. */
$sidebar = zkerika_get_sidebar();

get_header(); ?>

<div id="content-area" class="<?php zkerika_main_content_class($sidebar); ?>">
    <?php
        if ( have_posts() ) :
            while ( have_posts() ) : the_post();

                get_template_part( 'single-templates/archive/content', zkerika_archive_layout() );

            endwhile; // end of the loop.

            /* blog nav. */
            zkerika_paging_nav();

        else :
            /* content none. */
            get_template_part( 'single-templates/content', 'none' );

        endif; 
    ?>
</div>
<?php
    get_sidebar();
?>

<?php get_footer(); ?>