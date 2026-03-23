<?php
/**
 * Template Name: ServiceProfile
 *
 * @package Design_ICT_Site
 */

get_header();
$dis_user_status = '';
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only filter parameter on public archive-style page.
if ( isset( $_GET['user_status'] ) && ! empty( $_GET['user_status'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only filter parameter on public archive-style page.
	$dis_user_status = sanitize_text_field( wp_unslash( $_GET['user_status'] ) );
}
if ( $dis_user_status ) {
	$dis_services    = DIS_ContentsManager::get_service_list_by_user_status( $dis_user_status );
	$dis_serv_by_cat = DIS_ContentsManager::group_services_by_cluster( $dis_services );
	// Order by category.
	ksort( $dis_serv_by_cat );
	$dis_status_taxonomy = get_term_by( 'slug', $dis_user_status, DIS_USER_STATUS_TAXONOMY );
	?>

	<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
		<div class="row">

			<!-- SERVIZI -->
			<div class="col">

				<h2 class="pb-2">
					<?php echo esc_html( __( 'Services for', 'design_ict_site' ) . ' ' . ( ( $dis_status_taxonomy && ! is_wp_error( $dis_status_taxonomy ) ) ? strtolower( $dis_status_taxonomy->name ) : '' ) ); ?>
				</h2>

				<!-- SERVICES BY CATEGORY -->
				<?php
					get_template_part(
						'template-parts/common/services-by-category',
						false,
						array(
							'serv_by_cat' => $dis_serv_by_cat,
						)
					);
				?>

			</div>

			<!-- SIDEBAR NAVIGATION -->
			<?php
				get_template_part(
					'template-parts/common/sidebar-navigation',
					false,
					array(
						'user_status' => $dis_user_status,
					)
				);
			?>

		</div>
	</div>

	<?php
}
get_footer();
