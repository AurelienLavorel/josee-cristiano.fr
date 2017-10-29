<?php 
/**
 * The search form
 *
 * Display search form
 *
 * Customized search form layout
 * Customized search query
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */

	$post_type = get_post_type();
	switch ($post_type) {
		case 'zkportfolio':
			$search_query = '<input type="hidden" name="post_type" value="zkportfolio" />';
			break;
		case 'product':
			$search_query = '<input type="hidden" name="post_type" value="product" />';
			break;
		default:
			$search_query = '';
			break;
	}
?>
<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="cms-searchform" method="get">
	<input type="text" class="s" name="s" value="" placeholder="<?php esc_html_e('Type here','zk-erika');?>" aria-required="true" required="required">
	<?php echo wp_kses_post($search_query); ?>
	<button type="submit" value="<?php esc_html_e('Search','zk-erika');?>" class="searchsubmit"><i class="fa fa-search"></i></button>
</form>