<?php
/**
 * Primary menu.
 *
 * @package Design_ICT_Site
 */

$dis_locations = $args['locations'];
$dis_location  = PRIMARY_LOCATION_SLUG;

if ( has_nav_menu( $dis_location ) ) {
	$dis_custom_menu = wp_get_nav_menu_object( $dis_locations[ $dis_location ] );
	$dis_menu_items  = wp_get_nav_menu_items( $dis_custom_menu->term_id, array( 'order' => 'DESC' ) );
	$dis_menu_items  = $dis_menu_items ? DIS_ContentsManager::get_menu_tree_by_items( $dis_menu_items ) : array();

	if ( count( $dis_menu_items ) > 0 ) {
		?>
		<ul class="navbar-nav">
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
							href="#" role="button" data-bs-toggle="dropdown"
							aria-expanded="false" id="mainNavDropdown3">
							<span><?php echo esc_html( $dis_item['element']->title ); ?></span>
							<svg class="icon icon-xs" role="img" aria-labelledby="expand-primary-menu">
								<title id="expand-primary-menu"><?php echo esc_html__( 'Expand', 'design_ict_site' ); ?></title>
								<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-expand' ); ?>"></use>
							</svg>
						</a>
						<div class="dropdown-menu" role="region" aria-labelledby="mainNavDropdown3">
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
										<?php if ( 'nav_menu_item' === $dis_sub_item->post_type ) : ?>
											<li>
												<a class="dropdown-item list-item" href="<?php echo esc_url( $dis_sub_item->url ); ?>">
													<span><?php echo esc_html( $dis_sub_item->title ); ?></span>
												</a>
											</li>
										<?php else : ?>
											<?php $dis_how_to_title = DIS_CustomFieldsManager::get_field( 'how_to_title', $dis_sub_item->ID ); ?>
											<li>
												<a class="dropdown-item list-item" href="<?php echo esc_url( get_permalink( $dis_sub_item->ID ) ); ?>">
													<span><?php echo esc_html( $dis_how_to_title ); ?></span>
												</a>
											</li>
										<?php endif; ?>
									<?php endforeach; ?>
								</ul>
							</div>
						</div>
					</li>
				<?php else : ?>
					<li class="nav-item <?php echo esc_attr( $dis_active_class ); ?>">
						<a class="nav-link <?php echo esc_attr( $dis_active_class ); ?>" aria-current="page" href="<?php echo esc_url( $dis_item['element']->url ); ?>">
							<span><?php echo esc_html( $dis_item['element']->title ); ?></span>
						</a>
					</li>
				<?php endif; ?>
			<?php endforeach; ?>
		</ul>
		<?php
	}
}
