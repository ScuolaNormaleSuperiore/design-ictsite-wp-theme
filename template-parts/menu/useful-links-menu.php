<?php // phpcs:ignore Squiz.Commenting.FileComment.Missing -- File comment already provided below.
/**
 * Section with the useful links menu of the footer.
 *
 * @package Design_ICT_Site
 */

require_once DIS_THEME_PATH . '/inc/walkers/useful-links-menu-walker.php';

$dis_locations = $args['locations'];
$dis_location  = USEFUL_LINKS_LOCATION_SLUG;

if ( has_nav_menu( $dis_location ) ) {
	$dis_custom_menu = wp_get_nav_menu_object( $dis_locations[ $dis_location ] );
	$dis_menu_items  = wp_get_nav_menu_items( $dis_custom_menu->term_id, array( 'order' => 'DESC' ) );
	$dis_menu_items  = $dis_menu_items ? $dis_menu_items : array();

	if ( count( $dis_menu_items ) > 0 ) {
		?>
		<h4 class="customSpacing"><?php echo esc_html__( 'Useful links menu', 'design_ict_site' ); ?></h4>
		<div class="link-list-wrapper">
			<?php
			wp_nav_menu(
				array(
					'theme_location' => $dis_location,
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
