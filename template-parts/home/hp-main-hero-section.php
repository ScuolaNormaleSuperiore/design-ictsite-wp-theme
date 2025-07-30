<?php
/**
 * The HP Main Hero section.
 *
 * @package Design_ICT_Site
 */

$label_domain    = 'DIS_SiteOptionLabel';
$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$hero_image   = DIS_OptionsManager::dis_get_option( 'main_hero_image', 'dis_opt_main_hero' );
	$hero_title   = _x( 'MainHeroTitle', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$hero_text    = _x( 'MainHeroText', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$search_label = _x( 'MainHeroSearchButtonLabel', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$left_button  = _x( 'MainHeroLeftButtonLabel', 'DIS_SiteOptionLabel', 'design_ict_site' );
	$right_button = _x( 'MainHeroRightButtonLabel', 'DIS_SiteOptionLabel', 'design_ict_site' );
	// $search_link  = DIS_MultiLangManager::get_page_link( SITE_SEARCH_PAGE_SLUG );
	$help_link    = DIS_MultiLangManager::get_page_link( HELP_DESK_PAGE_SLUG );
	$cluster_link = DIS_MultiLangManager::get_archive_link( DIS_SERVICE_CLUSTER_POST_TYPE );
?>

<!-- HERO Standard  -->
<section class="it-hero-wrapper it-dark it-overlay it-text-centered it-bottom-overlapping-content" id="it-hero-wrapper">
	<div class="img-responsive-wrapper">
		<div class="img-responsive">
			<div class="img-wrapper">
				<img src="<?php echo esc_url( $hero_image ); ?>"
					title="<?php echo esc_attr( __( 'Hero image', 'design_ict_site' ) ); ?>"
					alt="<?php echo esc_attr( __( 'Hero image', 'design_ict_site' ) ); ?>">
			</div>
		</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<div class="it-hero-text-wrapper ">
					<h2>
						<?php
						if ( $show_title ) {
							echo esc_attr( $hero_title );
						}
						?>
					</h2>

					<!-- HERO SEARCH FORM -->
					<div class="form-group">
						<FORM id="hero_search_form" action="<?php echo esc_url( $help_link ); ?>" METHOD="GET">
							<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>
							<div class="input-group">
								<label class="visually-hidden" for="search_string">
									<?php echo esc_attr( __( 'Site search', 'design_ict_site' ) ); ?>
								</label>
								<input type="text" class="form-control" id="search_string" name="search_string">
								<div class="input-group-append">
									<button class="btn btn-primary btn-lg" type="submit" id="hero_search_submit_button">
											<?php echo esc_attr( $search_label ); ?>
									</button>
								</div>
							</div>
						</FORM>
					</div>

					<!-- HERO TEXT -->
					<p class="d-none d-lg-block">
						<?php echo esc_attr( $hero_text ); ?>
					</p>

					<!-- HERO BUTTONS -->
					<button type="button" class="btn btn-secondary btn-lg btn-me">
						<a href="<?php echo esc_url( $cluster_link ); ?>"
							style="color:white">
							<?php echo esc_attr( $left_button ); ?>
						</a>
					</button>
					<button type="button" class="btn btn-primary btn-lg">
						<a href="<?php echo esc_url( $help_link ); ?>"
							style="color:white">
							<?php echo esc_attr( $right_button ); ?>
						</a>
					</button>

				</div>
			</div>
		</div>
	</div>
</section>
<?php
}
?>
