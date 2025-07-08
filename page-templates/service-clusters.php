<?php
/* Template Name: ServiceClusters
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$clusters = DIS_ContentsManager::get_cluster_list();
$services = DIS_ContentsManager::get_service_list();
?>

	<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">

		<h2 class="pb-2">
			<?php echo __( 'Our services', 'design_ict_site' ); ?>
		</h2>

		<div class="row">
			<!-- SERVICES CLUSTER -->
			<div class="col">
				<div class="card-wrapper card-teaser-wrapper card-teaser-block-2">

				<?php
				foreach ( $clusters as $cluster ) {
					$icon_code         = DIS_CustomFieldsManager::get_field( 'icon_code' , $cluster->ID );
					$short_description = DIS_CustomFieldsManager::get_field( 'short_description' , $cluster->ID );
				?>
					<!--start card-->
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body d-flex justify-content-start">
							<i class="bi <?php echo esc_attr( $icon_code ); ?> me-3" style="font-size: 2em;"></i>
							<div>
								<h3 class="h5">
									<a href="<?php echo esc_url( get_permalink( $cluster ) ); ?>">
										<?php echo esc_attr( $cluster->post_title ); ?>
									</a>
								</h3>
								<p>
									<?php echo esc_html( $short_description ); ?>
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
				get_template_part( 'template-parts/common/sidebar-navigation' );
			?>

		</div>

	</div>

<?php
get_footer();
