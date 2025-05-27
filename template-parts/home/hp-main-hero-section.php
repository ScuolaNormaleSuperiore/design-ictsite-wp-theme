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
	$hero_title   = DIS_MultiLangManager::get_dis_translation( 'MainHeroTitle', $label_domain );
	$hero_text    = DIS_MultiLangManager::get_dis_translation( 'MainHeroText', $label_domain );
	$search_label = DIS_MultiLangManager::get_dis_translation( 'MainHeroSearchButtonLabel', $label_domain );
	$left_button  = DIS_MultiLangManager::get_dis_translation( 'MainHeroLeftButtonLabel', $label_domain );
	$right_button = DIS_MultiLangManager::get_dis_translation( 'MainHeroRightButtonLabel', $label_domain );
	$search_link   = DIS_ContentsManager::get_page_link( SITE_SEARCH_PAGE_SLUG );
?>

<!-- HERO Standard  -->
<section class="it-hero-wrapper it-dark it-overlay it-text-centered it-bottom-overlapping-content" id="it-hero-wrapper">
	<div class="img-responsive-wrapper">
		<div class="img-responsive">
			<div class="img-wrapper">
				<img src="<?php echo esc_url( $hero_image ); ?>"
					title="<?php echo __( 'Hero image', 'design_ict_site' ); ?>"
					alt="<?php echo __( 'Hero image', 'design_ict_site' ); ?>">
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

					<!-- SEARCH FORM -->
					<div class="form-group">
						<FORM action="<?php echo esc_url( $search_link ); ?>" METHOD="GET">
							<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>
							<div class="input-group">
								<label class="visually-hidden" for="search_string"><?php echo __( 'Site search', 'design_ict_site' ); ?></label>
								<input type="text" class="form-control" id="search_string" name="search_string">
								<div class="input-group-append">
									<button class="btn btn-primary btn-lg" type="submit" value="submit" id="button-1">
										<?php echo esc_attr( $search_label ); ?>
									</button>
								</div>
							</div>
						</FORM>
					</div>

					<p class="d-none d-lg-block">
						<?php echo esc_attr( $hero_text ); ?>
					</p>
					<?php
						$search_link  = DIS_ContentsManager::get_page_link( SITE_SEARCH_PAGE_SLUG );
						$cluster_link = DIS_ContentsManager::get_page_link( SERVICE_CLUSTER_PAGE_SLUG );
					?>
					<button type="button" class="btn btn-secondary btn-lg btn-me"
						onclick="location.href='<?php echo esc_url( $cluster_link ); ?>'"
					>
						<?php echo esc_attr( $left_button ); ?>
					</button>
					<button type="button" class="btn btn-primary btn-lg"
						onclick="location.href='<?php echo esc_url( $search_link ); ?>'"
					>
						<?php echo esc_attr( $right_button ); ?>
					</button>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
}
?>
