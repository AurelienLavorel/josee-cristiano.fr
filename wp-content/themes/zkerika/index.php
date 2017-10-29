<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
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