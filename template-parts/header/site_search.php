<?php
/**
 * The site search section.
 *
 * @package Design_ICT_Site
 */

 $search_link = DIS_ContentsManager::get_page_link( SITE_SEARCH_PAGE_SLUG );
?>
<div class="it-search-wrapper">
	<span class="d-none d-md-block"><?php echo __( 'Search', 'design_ict_site' ); ?></span>
	<a class="search-link rounded-icon" aria-label="<?php echo __( 'Search in the site', 'design_ict_site' ); ?>" href="<?php echo esc_url( $search_link ); ?>">
		<svg class="icon" role="img" aria-labelledby="Search" aria-label="<?php echo __( 'Search in the site', 'design_ict_site' ); ?>">
			<title><?php echo __( 'Search in the site', 'design_ict_site' ); ?></title>
			<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search'; ?>"></use>
		</svg>
	</a>
</div>
