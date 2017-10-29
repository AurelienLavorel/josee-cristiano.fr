<?php
/**
 * The Header template for our theme
 *
 * Displays all of the <head> section and everything up till <div id="cms-page">
 *
 * @package ZookaStudio
 * @subpackage ZK Erika
 * @since 1.0.0
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php if ( ! function_exists( 'has_site_icon' ) || ! has_site_icon() ): ?>
<link rel="shortcut icon" type="image/x-icon" href="<?php echo esc_url(get_template_directory_uri() . '/assets/images/favicon.png'); ?>" />
<?php endif; ?>
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php zkerika_page_loading();?>
	<div id="cms-page" class="<?php zkerika_page_class(); ?>">
		<?php 	
			zkerika_header_rev_slider();
			zkerika_header_layout();
			zkerika_page_title();
		?>
		<main id="cms-main" class="<?php zkerika_main_class(); ?>">
			<div class="row">