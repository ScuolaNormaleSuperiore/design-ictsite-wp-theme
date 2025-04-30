<?php
/**
 * Top Header Menu.
 *
 * @package Design_ICT_Site
 */

$locations  = $args['locations'];
$location   = TOP_HEADER_LOCATION_SLUG;
$menu_items = array();

$menus = wp_get_nav_menus();


if ( has_nav_menu( $location ) ) {
	$custom_menu = wp_get_nav_menu_object( $locations[ $location ] );
	$menuitems   = wp_get_nav_menu_items( $custom_menu->term_id, array( 'order' => 'DESC' ) );
	$menuitems   = $menuitems ? $menuitems : array();
?>

	<div class="link-list-wrapper collapse" id="menu1a">
		<ul class="link-list">
			<?php
			foreach ( $menuitems as $item ) {
				$active_class = '';
				if ( get_permalink() === $item->url ) {
					$active_class = 'active';
				}
			?>
			<li>
				<a class="list-item <?php echo esc_attr( $active_class ); ?>" href="<?php echo esc_url( $item->url ); ?>" aria-current="page">
					<?php echo esc_attr( $item->title ); ?>
				</a>
			</li>
			<?php
			}
			?>
			</ul>
		</ul>
	</div>

<?php
}
?>
