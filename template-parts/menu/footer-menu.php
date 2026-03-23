<?php // phpcs:ignore Squiz.Commenting.FileComment.Missing -- File comment already provided below.
/**
 * Section with the footer menu.
 *
 * @package Design_ICT_Site
 */

require_once DIS_THEME_PATH . '/inc/walkers/footer-menu-walker.php';

$dis_locations = $args['locations'];
$dis_location  = BOTTOM_FOOTER_LOCATION_SLUG;

if ( has_nav_menu( $dis_location ) ) {
	$dis_custom_menu = wp_get_nav_menu_object( $dis_locations[ $dis_location ] );
	$dis_menu_items  = wp_get_nav_menu_items( $dis_custom_menu->term_id, array( 'order' => 'DESC' ) );
	$dis_menu_items  = $dis_menu_items ? $dis_menu_items : array();

	if ( count( $dis_menu_items ) > 0 ) {
		?>
		<div class="container">
			<h3 class="visually-hidden"><?php echo esc_html__( 'Footer menu', 'design_ict_site' ); ?></h3>
			<?php
			wp_nav_menu(
				array(
					'theme_location'  => $dis_location,
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
