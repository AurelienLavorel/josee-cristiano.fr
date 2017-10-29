<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
?>
            </div> <!-- #cms-main > .row -->
        </main><!-- #cms-main -->
        <footer id="cms-footer" class="<?php zkerika_footer_class(); ?>">
            <?php 
                zkerika_footer_top();
                zkerika_footer_bottom(); 
            ?>
        </footer><!-- #cms-footer -->
    </div> <!-- #cms-page -->
    <?php 
        zkerika_sidebar_menu();
        wp_footer(); 
    ?>
</body>
</html>