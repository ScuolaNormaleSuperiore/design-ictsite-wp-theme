<?php
/**
 * Primary Menu.
 *
 * @package Design_ICT_Site
 */

$locations  = $args['locations'];
$location   = PRIMARY_LOCATION_SLUG;
$menu_items = array();
$menus = wp_get_nav_menus();

if ( has_nav_menu( $location ) ) {
	$custom_menu = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems   = wp_get_nav_menu_items( $custom_menu->term_id, array( 'order' => 'DESC' ) );
	// $menuitems   = $menuitems ? $menuitems : array();
	$menuitems   = $menuitems ? DIS_ContentsManager::get_menu_tree_by_items( $menuitems ) : array();
	if ( count( $menuitems ) > 0 ) {
?>
		<ul class="navbar-nav">
				<?php
				foreach ( $menuitems as $item ) {
					$active_class = '';
					if ( strpos( get_permalink(), $item['element']->url ) !== false ) {
						$active_class = 'active';
					}
					if ( count( $item['children'] ) > 0 ) {
				?>

						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle <?php echo $active_class; ?>"
								href="#" role="button" data-bs-toggle="dropdown"
								aria-expanded="false" id="mainNavDropdown3">
								<span><?php echo esc_attr( $item['element']->title ); ?></span>
								<svg class="icon icon-xs" role="img" aria-labelledby="Expand">
									<title>Expand</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand'; ?>"></use>
								</svg>
							</a>
							<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown3">
								<div class="link-list-wrapper">
									<ul class="link-list">
										<li>
											<a class="dropdown-item list-item" 
												href="<?php echo esc_attr( $item['element']->url ); ?>">
												<span><?php echo esc_attr( $item['element']->title ); ?></span>
											</a>
										</li>
										<li><span class="divider"></span></li>
										<?php
										foreach ( $item['children'] as $subitem ) {
											if ( $subitem->post_type === 'nav_menu_item' ) {
												// Print the standard menu voice.
										?>
											<li>
												<a class="dropdown-item list-item" href="<?php echo esc_attr( $subitem->url ); ?>">
													<span><?php echo esc_attr( $subitem->title ); ?></span>
												</a>
											</li>
										<?php
											} else {
												// Here we manage the case of how-to found in the url.
												$how_to_title = DIS_CustomFieldsManager::get_field( 'how_to_title', $subitem->ID );
										?>
											<li>
												<a class="dropdown-item list-item" href="<?php echo get_permalink( $subitem->ID ); ?>">
													<span><?php echo esc_attr( $how_to_title ); ?></span>
												</a>
											</li>
										<?php
											}
										}
										?>
									</ul>
								</div>
							</div>
						</li>

					<?php
					} else {
					?>

						<li class="nav-item <?php echo $active_class; ?>">
							<a class="nav-link <?php echo $active_class; ?>" aria-current="page" href="<?php echo esc_url( $item['element']->url ); ?>">
							<span><?php echo esc_attr( $item['element']->title ); ?></span>
						</a>
					</li>
					
					<?php
					}
				}
					?>

		</ul>

<?php
	}
}
?>
