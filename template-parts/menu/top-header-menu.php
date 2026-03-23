<?php
/**
 * Top header menu.
 *
 * @package Design_ICT_Site
 */

$dis_locations = $args['locations'];
$dis_location  = TOP_HEADER_LOCATION_SLUG;

if ( has_nav_menu( $dis_location ) ) {
	$dis_custom_menu = wp_get_nav_menu_object( $dis_locations[ $dis_location ] );
	$dis_menu_items  = wp_get_nav_menu_items( $dis_custom_menu->term_id, array( 'order' => 'DESC' ) );
	$dis_menu_items  = $dis_menu_items ? $dis_menu_items : array();
	?>

	<div class="link-list-wrapper collapse" id="menu1a">
		<ul class="link-list">
			<?php foreach ( $dis_menu_items as $dis_item ) : ?>
				<?php $dis_active_class = ( get_permalink() === $dis_item->url ) ? 'active' : ''; ?>
				<li>
					<a class="list-item <?php echo esc_attr( $dis_active_class ); ?>" href="<?php echo esc_url( $dis_item->url ); ?>" aria-current="page">
						<?php echo esc_html( $dis_item->title ); ?>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>

	<?php
}
