<?php
/**
 * Detail page for the post-type: dis-service-cluster.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$services = DIS_ContentsManager::get_service_list( 'title', $cluster_id=$post->ID );
$clusters = DIS_ContentsManager::get_cluster_list();
?>


	<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
		<div class="row">

			<!-- SERVICES OF THE GROUP -->
			<div class="col">
				<h2 class="pb-2 title"><?php echo( esc_attr( $post->post_title ) ); ?></h2> 
				<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
					<div class="card-body d-flex justify-content-start">
						<div>
							<p>
								<?php echo get_the_content(); ?>
							</p>
						</div>
					</div>
				</div>
				<div class="row">
						<div class="card-wrapper card-teaser-wrapper card-tease">
							<?php
							foreach ( $services as $service ) {
								$short_description = DIS_CustomFieldsManager::get_field( 'short_description', $service->ID );
							?>
							<!--start card-->
							<div class="card card-teaser rounded shadow">
								<div class="card-body">
									<h3 class="card-title h5 ">
										<a href="<?php echo get_permalink( $service ); ?>">
											<?php echo esc_attr( $service->post_title ); ?>
										</a>
									</h3>
									<div class="card-text font-serif">
										<p>
											<?php echo esc_html( $short_description ); ?>
										</p>
									</div>
								</div>
							</div>
							<!--end card-->
							<?php
							}
							?>
						</div>
				</div>
			</div>

			<!-- SIDEBAR LIST -->
			<div class="col-12 col-lg-4 col-md-5">
				<div class="sidebar-wrapper it-line-left-side">
					<div class="sidebar-linklist-wrapper">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li>
									<h3><?php echo __( 'Our services', 'design_ict_site' ); ?></h3>
								</li>
								<?php
								foreach ( $clusters as $cluster ) {
									$active = strval( $post->ID ) == strval( $cluster->ID ) ? 'active' : '';
								?>
								<li>
									<a
										class="list-item medium <?php echo esc_attr( $active ) ?>"
										href="<?php echo esc_url( get_permalink( $cluster ) ); ?>"
									>
										<span><?php echo esc_attr( $cluster->post_title ); ?></span>
									</a>
								</li>
								<?php
								}
								?>
							</ul>
						</div>
					</div>
				</div>
			</div>

		</div>
	</div>

<?php
get_footer();
