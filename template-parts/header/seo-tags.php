<?php
/**
 * SEO tags.
 *
 * @package Design_ICT_Site
 */

if ( 'true' === DIS_OptionsManager::dis_get_option( 'seo_internal_management_enabled', 'dis_opt_advanced_settings' ) ) {
	$dis_og_data = DIS_ContentsManager::get_og_data();
	?>

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<title><?php echo esc_html( $dis_og_data->shared_title ); ?></title>
	<link rel="canonical" href="<?php echo esc_url( $dis_og_data->url ); ?>" />
	<meta property="og:locale" content="<?php echo esc_attr( $dis_og_data->locale ); ?>" />
	<meta property="og:type" content="website" />
	<meta property="og:title" content="<?php echo esc_attr( $dis_og_data->title ); ?>" />
	<meta property="og:description" content="<?php echo esc_attr( $dis_og_data->description ); ?>" />
	<meta property="og:url" content="<?php echo esc_url( $dis_og_data->url ); ?>"/>
	<meta property="og:site_name" content="<?php echo esc_attr( $dis_og_data->site_title ); ?>" />
	<?php if ( $dis_og_data->image ) : ?>
		<meta property="og:image" content="<?php echo esc_url( $dis_og_data->image ); ?>"/>
		<meta property="og:image:width" content="<?php echo esc_attr( $dis_og_data->img_width ); ?>" />
		<meta property="og:image:height" content="<?php echo esc_attr( $dis_og_data->img_height ); ?>" />
		<meta property="og:image:type" content="<?php echo esc_attr( $dis_og_data->img_type ); ?>" />
	<?php endif; ?>
	<meta name="twitter:card" content="summary_large_image" />
	<meta name="twitter:site" content="<?php echo esc_url( $dis_og_data->url ); ?>">
	<meta name="twitter:creator" content="ICT Team">
	<meta name="twitter:title" content="<?php echo esc_attr( $dis_og_data->title ); ?>">
	<meta name="twitter:description" content="<?php echo esc_attr( $dis_og_data->description ); ?>">
	<meta name="twitter:image" content="<?php echo esc_attr( $dis_og_data->image ); ?>">
	<meta name="twitter:url" content="<?php echo esc_url( $dis_og_data->url ); ?>">

	<?php
}
