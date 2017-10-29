<?php
/**
 * The Template for displaying single post Standard
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
/* get sidebar position. */
$sidebar = zkerika_get_sidebar();

get_header(); ?>

<div id="content-area" class="<?php zkerika_main_content_class($sidebar); ?>">
    <?php zkerika_post_share(false); ?>
    <?php
        /* Start the loop.*/
        while ( have_posts() ) : the_post();

            /*Include the single content template.*/
            get_template_part( 'single-templates/single/content', get_post_format() );

            /* Get single post nav. */
            zkerika_post_nav();
            /* About Author */
            zkerika_author_info();
            /* Related Post */
            zkerika_post_related();
            /*If comments are open or we have at least one comment, load up the comment template.*/
            if ( zkerika_single_post_comment_list_form() && ( comments_open() || get_comments_number() )) :
                comments_template();
            endif;

            /*End the loop.*/
        endwhile;
    ?>
</div>
<?php
    get_sidebar();
?>

<?php get_footer(); ?>