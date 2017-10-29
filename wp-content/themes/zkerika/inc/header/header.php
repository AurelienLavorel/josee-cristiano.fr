<?php
/**
 * Header Default
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
$pull_align = zkerika_pull_align();
$pull_align2 = zkerika_pull_align2();
zkerika_header_top(); 
?>

<div id="cms-header" class="<?php zkerika_header_class(); ?>">
    <div class="container clearfix">
        <?php 
            zkerika_header_logo($pull_align);
            zkerika_header_extra($pull_align2);
            zkerika_header_navigation('pull-center');   
        ?>
    </div>
</div>