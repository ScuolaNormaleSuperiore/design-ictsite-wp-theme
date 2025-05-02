<?php
/**
 * Section with the Logo and the title of the site.
 *
 * @package Design_ICT_Site
 */

require_once DIS_THEME_PATH . '/inc/walkers/useful-links-walker.php';

$locations  = $args['locations'];
$location   = USEFUL_LINKS_LOCATION_SLUG;
$menu_items = array();
$menus      = wp_get_nav_menus();

if ( has_nav_menu( $location ) ) {
	$custom_menu = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems   = wp_get_nav_menu_items( $custom_menu->term_id, array( 'order' => 'DESC' ) );
	$menuitems   = $menuitems ? $menuitems : array();
	if ( count( $menuitems ) > 0 ) {
?>
		<h4 class="customSpacing">Link utili</h4>
		<div class="link-list-wrapper">
		<?php
			wp_nav_menu(
				array(
					'theme_location' => $location,
					'depth'          => 0,
					'menu_class'     => 'footer-list',
					'walker'         => new Useful_Links_Walker(),
				)
			);
		?>
		</div>
<?php
	}
}
?>
