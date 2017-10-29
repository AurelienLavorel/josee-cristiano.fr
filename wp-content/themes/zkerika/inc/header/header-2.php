<?php
/**
 * Header 2
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
$pull_align = zkerika_pull_align();
$pull_align2 = zkerika_pull_align2();
zkerika_header_top(); 
?>
<header id="cms-header" class="<?php zkerika_header_class(); ?>">
    <div class="container clearfix">
        <?php
	        zkerika_header_navigation_left($pull_align);
	        zkerika_header_logo('text-xl-center');
	        zkerika_header_extra($pull_align2);
	        zkerika_header_navigation_right($pull_align2);
        ?>
        <div id="cms-navigation" class="cms-navigation join-menu"><div class="cms-main-navigation"></div></div>
    </div>
</header>



