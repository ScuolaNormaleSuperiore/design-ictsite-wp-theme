<?php
/**
 * Primary Menu.
 *
 * @package Design_ICT_Site
 */

require_once DIS_THEME_PATH . '/inc/walkers/main-menu-walker.php';

$locations  = $args['locations'];
$location   = PRIMARY_LOCATION_SLUG;
$menu_items = array();
$menus = wp_get_nav_menus();

if ( has_nav_menu( $location ) ) {
	$custom_menu = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems   = wp_get_nav_menu_items( $custom_menu->term_id, array( 'order' => 'DESC' ) );
	$menuitems   = $menuitems ? $menuitems : array();
	if ( count( $menuitems ) > 0 ) {
?>
		<nav aria-label="Primary Menu Label">
			<?php
			if ( has_nav_menu( $location ) ) {
				wp_nav_menu(
					array(
						'theme_location'  => $location,
						'depth'           => 1,
						'menu_class'      => 'navbar-nav',
						'items_wrap'      => '<ul class="%2$s" id="%1$s" data-element="main-navigation">%3$s</ul>',
						'container'       => '',
						'list_item_class' => 'nav-item',
						'link_class'      => 'nav-link',
						'walker'          => new Main_Menu_Walker(),
						)
				);
				}
				?>
		</nav>
<?php
	}
}
?>
