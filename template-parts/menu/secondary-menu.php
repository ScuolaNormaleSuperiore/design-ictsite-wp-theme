<?php
/**
 * Secondary menu.
 *
 * @package Design_ICT_Site
 */

$dis_locations = $args['locations'];
$dis_location  = SECONDARY_LOCATION_SLUG;

if ( has_nav_menu( $dis_location ) ) {
	$dis_custom_menu = wp_get_nav_menu_object( $dis_locations[ $dis_location ] );
	$dis_menu_items  = wp_get_nav_menu_items( $dis_custom_menu->term_id, array( 'order' => 'DESC' ) );
	$dis_menu_items  = $dis_menu_items ? DIS_ContentsManager::get_menu_tree_by_items( $dis_menu_items ) : array();

	if ( count( $dis_menu_items ) > 0 ) {
		?>
		<ul id="secondary-menu" class="navbar-nav navbar-secondary">
			<?php foreach ( $dis_menu_items as $dis_item ) : ?>
				<?php
				$dis_active_class = '';
				if ( false !== strpos( get_permalink(), $dis_item['element']->url ) ) {
					$dis_active_class = 'active';
				}
				?>
				<?php if ( count( $dis_item['children'] ) > 0 ) : ?>
					<li class="nav-item dropdown">
						<a class="nav-link dropdown-toggle <?php echo esc_attr( $dis_active_class ); ?>"
							href="#" data-bs-toggle="dropdown" aria-expanded="false" id="mainNavDropdown1">
							<span><?php echo esc_html( $dis_item['element']->title ); ?></span>
							<svg class="icon icon-xs" role="img" aria-labelledby="expand-secondary-menu">
								<title id="expand-secondary-menu"><?php echo esc_html__( 'Expand', 'design_ict_site' ); ?></title>
								<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand' ); ?>"></use>
							</svg>
						</a>
						<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown1">
							<div class="link-list-wrapper">
								<ul class="link-list">
									<li>
										<a class="dropdown-item list-item"
											href="<?php echo esc_url( $dis_item['element']->url ); ?>">
											<span><?php echo esc_html( $dis_item['element']->title ); ?></span>
										</a>
									</li>
									<li><span class="divider"></span></li>
									<?php foreach ( $dis_item['children'] as $dis_sub_item ) : ?>
										<li>
											<a class="dropdown-item list-item" href="<?php echo esc_url( $dis_sub_item->url ); ?>">
												<span><?php echo esc_html( $dis_sub_item->title ); ?></span>
											</a>
										</li>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</li>
				<?php else : ?>
					<li class="nav-item">
						<a class="nav-link <?php echo esc_attr( $dis_active_class ); ?>" href="<?php echo esc_url( $dis_item['element']->url ); ?>">
							<span><?php echo esc_html( $dis_item['element']->title ); ?></span>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}
