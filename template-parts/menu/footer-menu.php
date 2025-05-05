<?php
/**
 * Section with the footer menu.
 *
 * @package Design_ICT_Site
 */

require_once DIS_THEME_PATH . '/inc/walkers/footer-menu-walker.php';

$locations  = $args['locations'];
$location   = BOTTOM_FOOTER_LOCATION_SLUG;
$menu_items = array();
$menus      = wp_get_nav_menus();

if ( has_nav_menu( $location ) ) {
	$custom_menu = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems   = wp_get_nav_menu_items( $custom_menu->term_id, array( 'order' => 'DESC' ) );
	$menuitems   = $menuitems ? $menuitems : array();
	if ( count( $menuitems ) > 0 ) {
?>
		<div class="container">
			<h3 class="visually-hidden">Link footer</h3>
			<?php
				wp_nav_menu(
					array(
						'theme_location'  => $location,
						'depth'           => 1,
						'menu_class'      => 'it-footer-small-prints-list list-inline mb-0 d-flex flex-column flex-md-row',
						'container'       => '',
						'list_item_class' => 'list-inline-item',
						'walker'          => new Footer_Menu_Walker(),
					)
				);
			?>
		</div>
<?php
	}
}
?>
