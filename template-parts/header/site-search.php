<?php
/**
 * Site search section.
 *
 * @package Design_ICT_Site
 */

$dis_search_link = DIS_MultiLangManager::get_page_link( SITE_SEARCH_PAGE_SLUG );
$dis_nonce       = wp_create_nonce( 'sf_site_search_nonce' );
$dis_search_url  = add_query_arg(
	array(
		'site_search_nonce_field' => $dis_nonce,
	),
	$dis_search_link
);
?>
<div class="it-search-wrapper">
	<span class="d-none d-md-block"><?php echo esc_html__( 'Search', 'design_ict_site' ); ?></span>
	<a class="search-link rounded-icon"
		aria-label="<?php echo esc_attr__( 'Search in the site', 'design_ict_site' ); ?>"
		href="<?php echo esc_url( $dis_search_url ); ?>">
		<svg class="icon" role="img" aria-labelledby="site-search-label"
			aria-label="<?php echo esc_attr__( 'Search in the site', 'design_ict_site' ); ?>">
			<title id="site-search-label"><?php echo esc_html__( 'Search in the site', 'design_ict_site' ); ?></title>
			<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search' ); ?>"></use>
		</svg>
	</a>
</div>
