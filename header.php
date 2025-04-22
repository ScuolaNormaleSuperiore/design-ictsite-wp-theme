<?php
/**
 * The header for the theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_ICT_Site
 */

$site_title   = DIS_OptionsManager::dis_get_option( 'site_title', 'dis_opt_options' );
$site_tagline = DIS_OptionsManager::dis_get_option( 'site_tagline', 'dis_opt_options' );
$header_logo  = DIS_OptionsManager::dis_get_option( 'header_logo_visible', 'dis_opt_options' );
$footer_logo  = DIS_OptionsManager::dis_get_option( 'footer_logo_visible', 'dis_opt_options' );
$current_lang = DIS_MultiLangManager::get_current_language();
?>

<!doctype html>
<html lang="<?php echo esc_attr( $current_lang ); ?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>
	<!-- FAVICONS -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo esc_url( DIS_THEME_URL ) . '/assets/favicons/apple-touch-icon.png'; ?>">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo esc_url( DIS_THEME_URL ) . '/assets/favicons/favicon-32x32.png'; ?>">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo esc_url( DIS_THEME_URL ) . '/assets/favicons/favicon-16x16.png'; ?>">
	<link rel="manifest" href="<?php echo esc_url( DIS_THEME_URL ) . '/assets/favicons/site.webmanifest'; ?>">
	<link rel="icon" href="<?php echo esc_url( DIS_THEME_URL ) . '/assets/favicons/favicon-16x16.png'; ?>">


	<!-- ANALYTICS CODE -->
	<?php get_template_part( 'template-parts/header/analytics' ); ?>

	<!-- META TAGS -->
	<?php
		get_template_part(
			'template-parts/header/meta_tags',
			false,
			array(
				'site_title'   => $site_title,
				'site_tagline' => $site_tagline,
				'current_lang' => $current_lang,
			),
		);
	?>

	<!-- SEO - OG Internal Management -->
	<?php
		get_template_part(
			'template-parts/header/seo_tags',
			false,
			array(
				'site_title'   => $site_title,
				'site_tagline' => $site_tagline,
				'current_lang' => $current_lang,
			),
		);
	?>

</head>
<body <?php body_class(); ?>>

<!-- HEADER -->
<header class="it-header-wrapper" data-bs-target="#header-nav-wrapper" role="navigation">
	<div class="it-header-slim-wrapper">
		<div class="container">
			<div class="row">

				<?php echo 'ICT Site HEADER'; ?>

			</div>
		</div>
	</div>
</header>
<!-- END HEADER -->
