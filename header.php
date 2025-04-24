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
$header_logo  = DIS_OptionsManager::dis_get_option( 'header_logo_visible', 'dis_opt_options' );
$footer_logo  = DIS_OptionsManager::dis_get_option( 'footer_logo_visible', 'dis_opt_options' );
$current_lang = DIS_MultiLangManager::get_current_language();
$network_url  = DIS_OptionsManager::dis_get_option( 'site_network_url', 'dis_opt_options' );
$network_name = DIS_OptionsManager::dis_get_option( 'site_network_name', 'dis_opt_options' );
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
								<div class="link-list-wrapper collapse" id="menu1a">
									<ul class="link-list">
										<li><a class="list-item" href="eventi.html">Eventi</a></li>
										<li><a class="list-item" href="dovesiamo.html">Dove siamo</a></li>
									</ul>
								</div>
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
									'template-parts/header/logo_title',
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
									<ul class="navbar-nav">
										<li class="nav-item"><a class="nav-link" href="elenco-servizi.html"><span>I nostri
													servizi</span></a></li>
										<li class="nav-item dropdown">
											<a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
												aria-expanded="false" id="mainNavDropdown3">
												<span>Come fare per</span>
												<svg class="icon icon-xs">
													<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand'; ?>"></use>
												</svg>
											</a>
											<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown3">
												<div class="link-list-wrapper">
													<ul class="link-list">
														<li><a class="dropdown-item list-item" href="#"><span>Link lista 1</span></a></li>
														<li><a class="dropdown-item list-item" href="#"><span>Link lista 2</span></a></li>
														<li><a class="dropdown-item list-item" href="#"><span>Link lista 3</span></a></li>
														<li><span class="divider"></span></li>
														<li><a class="dropdown-item list-item" href="#"><span>Link lista 4</span></a></li>
													</ul>
												</div>
											</div>
										</li>
										<li class="nav-item"><a class="nav-link" href="chi-siamo.html"><span>Chi siamo</span></a></li>
										<li class="nav-item"><a class="nav-link" href="helpdesk.html"><span>Helpdesk</span></a></li>
									</ul>
									<!-- MENU SECONDARIO - lato dx creare posizione menù ad utilizzo facoltativo -->
									<ul class="navbar-nav navbar-secondary">
										<li class="nav-item"><a class="nav-link" href="faq.html"><span>FAQ</span></a></li>
										<li class="nav-item"><a class="nav-link" href="progetti.html"><span>Progetti</span></a></li>
										<li class="nav-item"><a class="nav-link"
												href="documentazione.html"><span>Documentazione</span></a></li>
									</ul>
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
