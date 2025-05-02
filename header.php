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

// Site options.
$site_title   = DIS_OptionsManager::dis_get_option( 'site_title', 'dis_opt_options' );
$site_tagline = DIS_OptionsManager::dis_get_option( 'site_tagline', 'dis_opt_options' );
$current_lang = DIS_MultiLangManager::get_current_language();
$network_url  = DIS_OptionsManager::dis_get_option( 'site_network_url', 'dis_opt_options' );
$network_name = DIS_OptionsManager::dis_get_option( 'site_network_name', 'dis_opt_options' );
// Menu options.
$locations = get_nav_menu_locations();
require_once DIS_THEME_PATH . '/inc/walkers/main-menu-walker.php';
require_once DIS_THEME_PATH . '/inc/walkers/menu-right-walker.php';

// Check presence mandatory plugins.
// check_mandatory_plugins();
?>

<!doctype html>
<html lang="<?php echo esc_attr( $current_lang ); ?>">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<?php wp_head(); ?>

	<!-- FAVICONS -->
	<?php get_template_part( 'template-parts/header/favicons' ); ?>

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
<header class="it-header-wrapper" >
	<!-- TOP BAR -->
	<div class="skiplinks">
		<a class="visually-hidden-focusable" href="#it-hero-wrapper"><?php echo __( 'Go to the main content', 'design_ict_site' ); ?></a>
		<a class="visually-hidden-focusable" href="#it-footer"><?php echo __( 'Go to the footer', 'design_ict_site' ); ?></a>
	</div>
	<div class="it-header-slim-wrapper">
		<div class="container-xxl">
			<div class="row">
				<div class="col-12">
					<div class="it-header-slim-wrapper-content">
						<!-- Left-->
						<a class="d-none d-lg-block navbar-brand" href="<?php echo esc_url( $network_url ); ?>"><?php echo esc_attr( $network_name ); ?></a>
						<!--Right -->
						<div class="nav-mobile">
							<nav aria-label="<?php echo __( 'Accessory navigation', 'design_ict_site' ); ?>">
								<a class="it-opener d-lg-none" data-bs-toggle="collapse" href="<?php echo esc_url( $network_url ); ?>" role="button"
									aria-expanded="false" aria-controls="menu4" aria-label="<?php echo esc_attr( $network_name ); ?>">
									<span><?php echo esc_attr( $network_name ); ?></span>
									<svg class="icon" aria-hidden="true">
										<use href=<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand'; ?>"></use>
									</svg>
								</a>
								<!-- TOP BAR MENU -->
								<?php
								echo get_template_part( 'template-parts/menu/top-header-menu', false, array( 'locations' => $locations ) );
								?>
							</nav>
						</div>
						<div class="it-header-slim-right-zone">
							<!-- Language selection -->
							<?php get_template_part( 'template-parts/header/language_selector' ); ?>

							<!-- Login -->
							<?php get_template_part( 'template-parts/header/login_button' ); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MAIN BAR -->
	<div class="it-nav-wrapper">
		<!-- MAIN BAR - FIRST ROW -->
		<div class="it-header-center-wrapper theme-light">
			<div class="container-xxl">
				<div class="row">
					<div class="col-12">
						<div class="it-header-center-content-wrapper">
							<!-- LOGO & TITLE -->
							<?php
								get_template_part(
									'template-parts/header/logo_title_header',
									false,
									array(
										'site_title'   => $site_title,
										'site_tagline' => $site_tagline,
										'current_lang' => $current_lang,
									),
								);
							?>
							<!-- SOCIAL AND SITE SEARCH -->
							<div class="it-right-zone">
								<!-- SOCIAL-->
								<?php get_template_part( 'template-parts/header/social_list' ); ?>
								<!-- SITE SEARCH -->
								<?php get_template_part( 'template-parts/header/site_search' ); ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- MAIN BAR - SECOND ROW -->
		<div class="it-header-navbar-wrapper theme-light-desk">
			<div class="container-xxl">
				<div class="row">
					<div class="col-12">
						<!--start nav-->
						<nav class="navbar navbar-expand-lg has-megamenu" aria-label="Navigazione principale">
							<button class="custom-navbar-toggler" type="button" aria-controls="nav1" aria-expanded="false"
								aria-label="Mostra/Nascondi la navigazione" data-bs-toggle="navbarcollapsible" data-bs-target="#nav1">
								<svg class="icon">
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-burger'; ?>"></use>
								</svg>
							</button>
							<div class="navbar-collapsable" id="nav1" style="display: none;">
								<div class="overlay" style="display: none;"></div>
								<div class="close-div">
									<button class="btn close-menu" type="button">
										<span class="visually-hidden">Nascondi la navigazione</span>
										<svg class="icon">
											<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-close-big'; ?>"></use>
										</svg>
									</button>
								</div>
								<div class="menu-wrapper">
									<!-- PRIMARY MENU -->
									<?php
									echo get_template_part( 'template-parts/menu/primary-menu', false, array( 'locations' => $locations ) );
									?>
									<!-- SECONDARY MENU-->
									<?php
									echo get_template_part( 'template-parts/menu/secondary-menu', false, array( 'locations' => $locations ) );
									?>
								</div>
							</div>
						</nav>
					</div>
				</div>
			</div>
		</div>

	</div>

</header>
<!-- END HEADER -->
