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
// Check presence mandatory plugins.
// @TODO: check_mandatory_plugins().
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

<!-- BODY -->
<body <?php body_class(); ?>>

<!-- HEADER -->
<header class="it-header-wrapper" >
	<!-- TOP BAR -->
	<div class="skiplinks">
		<a class="visually-hidden-focusable" href="#main-menu">
			<?php echo __( 'Go to the menu', 'design_ict_site' ); ?>
		</a>
		<a class="visually-hidden-focusable" href="#main-content">
			<?php echo __( 'Go to the content', 'design_ict_site' ); ?>
		</a>
		<a class="visually-hidden-focusable" href="#it-footer">
			<?php echo __( 'Go to the footer', 'design_ict_site' ); ?>
		</a>
		<?php
		$accessibility_page = DIS_MultiLangManager::get_page_link( ACCESSIBILITY_PAGE_SLUG );
		?>
		<a class="visually-hidden-focusable" href="<?php echo esc_url( $accessibility_page ); ?>">
			<?php echo __( 'Go to the accessibility statement', 'design_ict_site' ); ?>
		</a>
	</div>
	<div class="it-header-slim-wrapper">
		<div class="container-xxl">
			<div class="row">
				<div class="col-12">
					<div class="it-header-slim-wrapper-content">
						<!-- Left-->
						<a class="d-none d-lg-block navbar-brand" href="<?php echo esc_url( $network_url ); ?>">
							<?php echo esc_attr( $network_name ); ?>
						</a>
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
							<!-- Language selection section -->
							<?php get_template_part( 'template-parts/header/language_selector' ); ?>

							<!-- Login section -->
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
							<!-- Logo & title section -->
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
							<!--Social and site search section -->
							<div class="it-right-zone">
								<!-- social section-->
								<?php get_template_part( 'template-parts/header/social-list' ); ?>
								<!-- Site search section -->
								<?php get_template_part( 'template-parts/header/site-search' ); ?>
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
						<nav class="navbar navbar-expand-lg has-megamenu" aria-label="<?php echo __( 'Main navigation', 'design_ict_site' ); ?>">
							<button class="custom-navbar-toggler" type="button" aria-controls="nav1" aria-expanded="false"
								aria-label="<?php echo __( 'Show/Hide navigation', 'design_ict_site' ); ?>" data-bs-toggle="navbarcollapsible" data-bs-target="#nav1">
								<svg class="icon">
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-burger'; ?>"></use>
								</svg>
							</button>
							<div class="navbar-collapsable" id="nav1" style="display: none;">
								<div class="overlay" style="display: none;"></div>
								<div class="close-div">
									<button class="btn close-menu" type="button">
										<span class="visually-hidden"><?php echo __( 'Hide navigation', 'design_ict_site' ); ?></span>
										<svg class="icon">
											<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-close-big'; ?>"></use>
										</svg>
									</button>
								</div>
								<div class="menu-wrapper" id="main-menu">
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

<main id="main-content"> <!-- closed in footer.php -->
	<?php
	$messages = DIS_OptionsManager::dis_get_option( 'messages', 'dis_opt_site_alerts' );
	if ( ( $messages && ! empty( $messages ) && array_key_exists( 'message_text', $messages[0] ) ) || ! is_home() ) {
	?>
		<section class="container my-12 p-4 pb-0">

			<!-- ALERT section -->
			<?php	get_template_part( 'template-parts/header/alert' ); ?>

			<!-- BREADCRUMB-->
			<?php	get_template_part( 'template-parts/header/breadcrumb' ); ?>

		</section>
	<?php
	}
	?>
