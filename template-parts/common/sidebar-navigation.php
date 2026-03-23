<?php
/**
 * Sidebar navigation.
 *
 * @package Design_ICT_Site
 */

$dis_user_status = $args['user_status'] ?? '';
?>

<div class="col-12 col-lg-4 col-md-5">
	<div class="sidebar-wrapper it-line-left-side">
		<div class="sidebar-linklist-wrapper">
			<div class="link-list-wrapper">
				<ul class="link-list">
					<li>
						<h3>
							<?php echo esc_html__( 'Browse by profile', 'design_ict_site' ); ?>
						</h3>
					</li>
					<?php
					$dis_status_list     = get_terms( DIS_USER_STATUS_TAXONOMY );
					$dis_service_profile = DIS_MultiLangManager::get_page_by_label( SERVICE_BY_PROFILE_SLUG );

					if ( $dis_service_profile ) {
						foreach ( $dis_status_list as $dis_status ) {
							$dis_active = ( $dis_status->slug === $dis_user_status ) ? 'active' : '';
							?>
							<li>
								<a class="list-item medium <?php echo esc_attr( $dis_active ); ?>"
									href="<?php echo esc_url( add_query_arg( 'user_status', $dis_status->slug, get_permalink( $dis_service_profile ) ) ); ?>">
									<span><?php echo esc_html( $dis_status->name ); ?></span>
								</a>
							</li>
							<?php
						}
					}
					?>
				</ul>
			</div>
		</div>
		<div class="sidebar-linklist-wrapper linklist-secondary">
			<div class="link-list-wrapper">
				<ul class="link-list">
					<li>
						<?php
						$dis_service_list   = DIS_MultiLangManager::get_page_by_label( SERVICE_ITEM_PAGE_SLUG );
						$dis_service_active = ( $dis_service_list && get_permalink() === get_permalink( $dis_service_list->ID ) ) ? 'active' : '';
						?>
						<?php if ( $dis_service_list ) : ?>
							<a class="list-item <?php echo esc_attr( $dis_service_active ); ?>"
								href="<?php echo esc_url( get_permalink( $dis_service_list->ID ) ); ?>">
								<span>
									<?php echo esc_html__( 'Full list of services', 'design_ict_site' ); ?>
								</span>
							</a>
						<?php endif; ?>
					</li>
					<li>
						<?php
						$dis_cluster_list   = DIS_MultiLangManager::get_page_by_label( SERVICE_CLUSTER_PAGE_SLUG );
						$dis_cluster_active = ( $dis_cluster_list && get_permalink() === get_permalink( $dis_cluster_list->ID ) ) ? 'active' : '';
						?>
						<?php if ( $dis_cluster_list ) : ?>
							<a class="list-item <?php echo esc_attr( $dis_cluster_active ); ?>"
								href="<?php echo esc_url( get_permalink( $dis_cluster_list->ID ) ); ?>">
								<span>
									<?php echo esc_html__( 'List of services by category', 'design_ict_site' ); ?>
								</span>
							</a>
						<?php endif; ?>
					</li>
				</ul>
			</div>
		</div>
	</div>
</div>
