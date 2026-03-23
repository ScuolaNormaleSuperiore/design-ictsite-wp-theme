<?php
/**
 * Template Name: ServiceClusters
 *
 * @package Design_ICT_Site
 */

get_header();

$dis_clusters    = DIS_ContentsManager::get_cluster_list( false, 'priority' );
$dis_services    = DIS_ContentsManager::get_service_list( 'priority' );
$dis_user_status = '';
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">

	<h2 class="pb-2">
		<?php echo esc_html__( 'Services', 'design_ict_site' ); ?>
	</h2>

	<div class="row">
		<!-- SERVICES CLUSTER -->
		<div class="col">
			<div class="card-wrapper card-teaser-wrapper card-teaser-block-2">

				<?php
				foreach ( $dis_clusters as $dis_cluster ) {
					$dis_icon_code         = DIS_CustomFieldsManager::get_field( 'icon_code', $dis_cluster->ID );
					$dis_short_description = DIS_CustomFieldsManager::get_field( 'short_description', $dis_cluster->ID );
					?>
					<!--start card-->
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body d-flex justify-content-start">
							<i class="bi <?php echo esc_attr( $dis_icon_code ); ?> me-3" style="font-size: 2em;"></i>
							<div>
								<h3 class="h5">
									<a href="<?php echo esc_url( get_permalink( $dis_cluster ) ); ?>">
										<?php echo esc_attr( $dis_cluster->post_title ); ?>
									</a>
								</h3>
								<p>
									<?php echo nl2br( esc_html( $dis_short_description ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								</p>
							</div>
						</div>
					</div>
					<!--end card -->
					<?php
				}
				?>

			</div>
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
get_footer();
