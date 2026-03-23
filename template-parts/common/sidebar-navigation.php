<?php
/* Sidebar navigation.
*
* @package Design_ICT_Site
*/

$user_status = $args['user_status'] ?? '';
?>

<!-- SIDEBAR NAVIGATION LISTS -->
<div class="col-12 col-lg-4 col-md-5">
	<div class="sidebar-wrapper it-line-left-side">
		<!-- Profile navigation -->
		<div class="sidebar-linklist-wrapper">
			<div class="link-list-wrapper">
				<ul class="link-list">
					<li>
						<h3>
							<?php echo __( 'Browse by profile', 'design_ict_site' ); ?>
						</h3>
					</li>
					<?php
					$status_list     = get_terms( DIS_USER_STATUS_TAXONOMY );
					$service_profile = DIS_MultiLangManager::get_page_by_label( SERVICE_BY_PROFILE_SLUG );
					if ( $service_profile ) {
						foreach ( $status_list as $sl ) {
							$active = ( $sl->slug === $user_status ) ? 'active' : '';
							?>
							<li>
								<a class="list-item medium <?php echo esc_attr( $active ); ?>"
									href="<?php echo esc_url( add_query_arg( 'user_status', $sl->slug, get_permalink( $service_profile ) ) ); ?>">
									<span><?php echo esc_attr( $sl->name ); ?></span>
								</a>
							</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
		<!-- List navigation -->
		<div class="sidebar-linklist-wrapper linklist-secondary">
			<div class="link-list-wrapper">
				<ul class="link-list">
					<li>
						<?php
						$service_list = DIS_MultiLangManager::get_page_by_label( SERVICE_ITEM_PAGE_SLUG );
						$active       = ( $service_list && get_permalink() === get_permalink( $service_list->ID ) ) ? 'active' : '';
						?>
						<?php if ( $service_list ) : ?>
						<a class="list-item <?php echo esc_attr( $active ); ?>"
							href="<?php echo esc_url( get_permalink( $service_list->ID ) ); ?>">
							<span>
								<?php echo __( 'Full list of services', 'design_ict_site' ); ?>
							</span>
						</a>
						<?php endif; ?>
					</li>
					<li>
						<?php
						$cluster_list = DIS_MultiLangManager::get_page_by_label( SERVICE_CLUSTER_PAGE_SLUG );
						$active       = ( $cluster_list && get_permalink() === get_permalink( $cluster_list->ID ) ) ? 'active' : '';
						?>
						<?php if ( $cluster_list ) : ?>
						<a class="list-item <?php echo esc_attr( $active ); ?>"
							href="<?php echo esc_url( get_permalink( $cluster_list->ID ) ); ?>">
							<span>
								<?php echo __( 'List of services by category', 'design_ict_site' ); ?>
							</span>
						</a>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
