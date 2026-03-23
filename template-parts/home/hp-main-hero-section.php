<?php
/**
 * The HP main hero section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );
$dis_hp_autocomplete = DIS_OptionsManager::dis_get_option( 'home_search_autocomplete_enabled', 'dis_opt_hp_layout' );

if ( $dis_section_enabled ) {
	$dis_hero_image   = DIS_OptionsManager::dis_get_option( 'main_hero_image', 'dis_opt_main_hero' );
	$dis_hero_title   = _x( 'MainHeroTitle', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$dis_hero_text    = _x( 'MainHeroText', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$dis_left_button  = _x( 'MainHeroLeftButtonLabel', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$dis_right_button = _x( 'MainHeroRightButtonLabel', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$dis_search_link  = DIS_MultiLangManager::get_page_link( SITE_SEARCH_PAGE_SLUG );
	$dis_help_link    = DIS_MultiLangManager::get_page_link( HELP_DESK_PAGE_SLUG );
	$dis_cluster_link = DIS_MultiLangManager::get_archive_link( DIS_SERVICE_CLUSTER_POST_TYPE );
	?>

	<section class="it-hero-wrapper it-dark it-overlay it-text-centered it-bottom-overlapping-content" id="it-hero-wrapper">
		<div class="img-responsive-wrapper">
			<div class="img-responsive">
				<div class="img-wrapper">
					<img src="<?php echo esc_url( $dis_hero_image ); ?>"
						title="<?php echo esc_attr__( 'Hero image', 'design_ict_site' ); ?>"
						alt="<?php echo esc_attr__( 'Hero image', 'design_ict_site' ); ?>">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="it-hero-text-wrapper">
						<h2>
							<?php
							if ( $dis_show_title ) {
								echo esc_html( $dis_hero_title );
							}
							?>
						</h2>

						<form id="main_search_form" action="<?php echo esc_url( $dis_search_link ); ?>" method="get">
							<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>
							<?php if ( 'true' === $dis_hp_autocomplete ) : ?>
								<div id="home_search_autocomplete"></div>
							<?php else : ?>
								<div class="form-group mb-0">
									<label class="visually-hidden" for="search_string">
										<?php echo esc_html__( 'Site search', 'design_ict_site' ); ?>
									</label>
									<input
										type="search"
										class="form-control autocomplete"
										id="search_string"
										name="search_string"
										data-bs-autocomplete='[]'
										placeholder="<?php echo esc_attr__( 'Search...', 'design_ict_site' ); ?>"
									>
									<span class="autocomplete-icon" aria-hidden="true">
										<svg class="icon icon-sm">
											<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search' ); ?>"></use>
										</svg>
									</span>
								</div>
							<?php endif; ?>
						</form>

						<p class="d-none d-lg-block">
							<?php echo esc_html( $dis_hero_text ); ?>
						</p>

						<div class="it-btn-container bg-transparent">
							<a class="btn btn-sm btn-secondary" href="<?php echo esc_url( $dis_cluster_link ); ?>">
								<?php echo esc_html( $dis_left_button ); ?>
								<svg class="icon icon-white ms-2">
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
								</svg>
							</a>
							<a class="btn btn-sm btn-primary ms-3" href="<?php echo esc_url( $dis_help_link ); ?>">
								<?php echo esc_html( $dis_right_button ); ?>
								<svg class="icon icon-white ms-2">
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
								</svg>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php
}
