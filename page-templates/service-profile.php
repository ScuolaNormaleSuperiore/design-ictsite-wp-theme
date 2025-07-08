<?php
/* Template Name: ServiceItems
*
* @package Design_ICT_Site
*/

global $post;
get_header();
$user_status = '';
if ( isset( $_GET['user_status'] ) && ! empty( $_GET['user_status'] ) ) {
	$user_status = sanitize_text_field( $_GET['user_status'] );
}
if ( $user_status ) {
	$services    = DIS_ContentsManager::get_service_list_by_user_status( $user_status );
	$serv_by_cat = DIS_ContentsManager::group_services_by_cluster( $services );
	// Order by category.
	ksort( $serv_by_cat );
	$user_status_obj = 
?>

	<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
		<div class="row">

			<!-- SERVIZI -->
			<div class="col">
				<h2 class="pb-2">
					<?php echo __( 'Services for', 'design_ict_site' ) . ' ' . $user_status ; ?> 
				</h2>
				<!-- SERVICES BY CATEGORY -->
				<div class="link-list-wrapper">
					<ul class="link-list">
						<?php
						foreach( $serv_by_cat as $cat ) {
						?>
						<li>
							<a class="list-item large medium icon-right"
								href="<?php echo get_permalink( $cat['item']->ID ); ?>">
								<span class="list-item-title-icon-wrapper">
								<span class="list-item-title">
									<?php echo esc_attr( $cat['title'] ); ?>
								</span>
								<svg class="icon icon-primary">
									<title><?php echo esc_attr( $cat['title'] ); ?></title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-link'; ?>"></use>
								</svg>
								</span>
							</a>
							<ul class="link-sublist">
								<?php
								foreach ( $cat['children'] as $srv ) {
								?>
								<li>
									<a class="list-item"
										href="<?php echo esc_url( get_permalink( $srv->ID ) ); ?>">
										<span><?php echo esc_attr( $srv->post_title ); ?></span>
									</a>
								</li>
								<?php
								}
								?>
							</ul>
						</li>
						<?php
						}
						?>
					</ul>
				</div>
			</div>

			<!-- SIDEBAR NAVIGATION -->
			<?php
				get_template_part(
					'template-parts/common/sidebar-navigation',
					false,
					array( 'user_status' => $user_status
					)
				);
			?>

		</div>
	</div>

<?php
}
get_footer();
