<?php
/**
 * Primary Menu.
 *
 * @package Design_ICT_Site
 */

$locations  = $args['locations'];
$location   = SECONDARY_LOCATION_SLUG;
$menu_items = array();
$menus      = wp_get_nav_menus();
if ( has_nav_menu( $location ) ) {
	$custom_menu = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems   = wp_get_nav_menu_items( $custom_menu->term_id, array( 'order' => 'DESC' ) );
	$menuitems   = $menuitems ? DIS_ContentsManager::get_menu_tree_by_items( $menuitems ) : array();
	if ( count( $menuitems ) > 0 ) {
?>

		<nav aria-label="Secondary Menu Label">
			<?php
			if ( has_nav_menu( $location ) && count( $menuitems  ) ) {
			?>
				<ul id="secondary-menu" class="navbar-nav navbar-secondary">
					<?php
					foreach ( $menuitems as $item ) {
						$active_class = '';
						// if ( get_permalink() == $item['element']->url ) {
						if ( strpos( get_permalink(), $item['element']->url ) !== false ) {
							$active_class = 'active';
						}
						if ( count( $item['children'] ) > 0 ) {
					?>
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle <?php echo $active_class;?>" href="#" data-bs-toggle="dropdown" aria-expanded="false" id="mainNavDropdown1">
								<span><?php echo esc_attr( $item['element']->title); ?></span>
								<svg class="icon icon-xs" role="img" aria-labelledby="Expand">
									<title>Expand</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand'; ?>"></use>
								</svg>
							</a>
							<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown1">
								<div class="link-list-wrapper">
									<ul class="link-list">
										<li><a class="dropdown-item list-item" href="<?php echo esc_attr( $item['element']->url ); ?>"><span><?php echo esc_attr( $item['element']->title ); ?></span></a></li>
										<li><span class="divider"></span></li>
										<?php
										foreach ( $item['children'] as $subitem ) {
										?>
										<li>
											<a class="dropdown-item list-item" href="<?php echo esc_attr( $subitem->url ); ?>">
											<span><?php echo esc_attr( $subitem->title ); ?></span>
										</a></li>
										<?php
										} // foreach
										?>
									</ul>
								</div>
							</div>
						</li>
					<?php
							} else {
					?>
						<li class="nav-item">
							<a class="nav-link <?php echo $active_class;?>" href="<?php echo esc_url( $item['element']->url ); ?>"><span><?php echo esc_attr( $item['element']->title ); ?></span></a>
						</li>
					<?php
							} // else
						} // foreach
					?>
				</ul> <!-- secondary-menu -->
				<?php
				} // has_nav_menu
			?>
		</nav>

<?php
	}
}
?>
