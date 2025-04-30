<?php
/**
 * The analytics code of the site.
 *
 * @package Design_ICT_Site
 */

global $post;

if ( DIS_OptionsManager::dis_get_option( 'seo_internal_management_enabled', 'dis_opt_advanced_settings' ) === 'true' ) {
	$og_data = DIS_ContentsManager::get_og_data();
?>

	<!-- SEO optimization -->
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php echo esc_attr( $og_data->shared_title ); ?></title>
	<link rel="canonical" href="<?php echo esc_url( $og_data->url ); ?>" />
	<!-- OG DATA for page sharing (e.g. Facebook) -->
	<meta property="og:locale" content="<?php echo esc_attr( $og_data->locale ); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo esc_attr( $og_data->title ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( $og_data->description ); ?>" />
	<meta property="og:url" content='<?php echo esc_url( $og_data->url ); ?>'/>
	<meta property="og:site_name" content="<?php echo esc_attr( $og_data->site_title ); ?>" />
	<?php
	if ( $og_data->image ) {
	?>
		<meta property="og:image" content="<?php echo esc_url( $og_data->image ); ?>"/>
		<meta property="og:image:width" content="<?php echo esc_attr( $og_data->img_width ); ?>" />
		<meta property="og:image:height" content="<?php echo esc_attr($og_data->img_height ); ?>" />
		<meta property="og:image:type" content="<?php echo esc_attr($og_data->img_type ); ?>" />
	<?php
	}
	?>
	<!-- TWITTER CARD  -->
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="<?php echo esc_url( $og_data->url ); ?>">
	<meta name="twitter:creator" content="ICT Team">
	<meta name="twitter:title" content="<?php echo esc_attr( $og_data->title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $og_data->description ); ?>">
	<meta name="twitter:image" content="<?php echo esc_attr( $og_data->image ); ?>">
	<meta name="twitter:url" content="<?php echo esc_url( $og_data->url ); ?>">

<?php
}
