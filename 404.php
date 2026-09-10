<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * The <main> wrapper and the breadcrumb are opened by header.php
 * and closed by footer.php, so this template renders the page body only.
 *
 * @link https://developer.wordpress.org/themes/template-files-section/basic-template-files/#404-template
 *
 * @package Design_ICT_Site
 */

get_header();

$dis_home_url    = DIS_MultiLangManager::get_home_url();
$dis_search_link = DIS_MultiLangManager::get_page_link( SITE_SEARCH_PAGE_SLUG );
// wp_get_referer() returns false when the referer is missing or external,
// so the "go back" link can never become an open redirect.
$dis_back_url = wp_get_referer();
$dis_sprites  = DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg';
?>

<!-- 404 PAGE -->
<div class="container shadow rounded p-4 pt-3 pb-3 mb-5">
	<div class="row justify-content-center">
		<div class="col-12 col-lg-8 text-center">

			<p class="display-1 fw-bold text-primary mb-0" aria-hidden="true">404</p>

			<h2 class="pb-2">
				<?php echo esc_html__( 'Page not found', 'design_ict_site' ); ?>
			</h2>

			<p class="lead">
				<?php echo esc_html__( 'The page you are looking for does not exist, or it has been moved or renamed.', 'design_ict_site' ); ?>
			</p>

			<p>
				<?php echo esc_html__( 'Search the site or use the links below to continue browsing.', 'design_ict_site' ); ?>
			</p>

			<!-- Navigation links -->
			<div class="it-btn-container bg-transparent mt-4">

				<?php if ( $dis_back_url ) : ?>
					<a class="btn btn-sm btn-secondary" href="<?php echo esc_url( $dis_back_url ); ?>">
						<svg class="icon icon-sm icon-white me-2" aria-hidden="true">
							<use href="<?php echo esc_url( $dis_sprites . '#it-arrow-left' ); ?>"></use>
						</svg>
						<?php echo esc_html__( 'Go back', 'design_ict_site' ); ?>
					</a>
				<?php endif; ?>

				<a class="btn btn-sm btn-primary ms-3" href="<?php echo esc_url( $dis_home_url ); ?>">
					<?php echo esc_html__( 'Go to the home page', 'design_ict_site' ); ?>
					<svg class="icon icon-sm icon-white ms-2" aria-hidden="true">
						<use href="<?php echo esc_url( $dis_sprites . '#it-arrow-right' ); ?>"></use>
					</svg>
				</a>

				<?php if ( $dis_search_link ) : ?>
					<a class="btn btn-sm btn-primary ms-3" href="<?php echo esc_url( $dis_search_link ); ?>">
						<?php echo esc_html__( 'Go to the search page', 'design_ict_site' ); ?>
						<svg class="icon icon-sm icon-white ms-2" aria-hidden="true">
							<use href="<?php echo esc_url( $dis_sprites . '#it-search' ); ?>"></use>
						</svg>
					</a>
				<?php endif; ?>

			</div>

		</div> <!-- col -->
	</div> <!-- row -->
</div> <!-- container -->


<?php
get_footer();
