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

$dis_cluster_id = $post->ID;
$dis_services   = DIS_ContentsManager::get_service_list( 'priority', $dis_cluster_id );
$dis_clusters   = DIS_ContentsManager::get_cluster_list();
?>

<div class="container shadow rounded p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<!-- SERVICES OF THE GROUP -->
		<div class="col">
			<h2 class="pb-2 title"><?php echo esc_html( $post->post_title ); ?></h2>
			<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
				<div class="card-body d-flex justify-content-start">
						<div>
							<p>
								<?php the_content(); ?>
							</p>
						</div>
				</div>
			</div>
			<div class="row">
				<div class="card-wrapper card-teaser-wrapper card-tease">
					<?php foreach ( $dis_services as $dis_service ) : ?>
						<?php $dis_short_description = DIS_CustomFieldsManager::get_field( 'short_description', $dis_service->ID ); ?>
						<div class="card card-teaser rounded shadow">
							<div class="card-body">
								<h3 class="card-title h5">
									<a href="<?php echo esc_url( get_permalink( $dis_service ) ); ?>">
										<?php echo esc_html( $dis_service->post_title ); ?>
									</a>
								</h3>
								<div class="card-text font-serif">
									<p>
										<?php echo nl2br( esc_html( $dis_short_description ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</p>
								</div>
							</div>
						</div>
					<?php endforeach; ?>
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
								<h3><?php echo esc_html__( 'Services', 'design_ict_site' ); ?></h3>
							</li>
							<?php foreach ( $dis_clusters as $dis_cluster ) : ?>
								<?php $dis_active = ( (string) $post->ID === (string) $dis_cluster->ID ) ? 'active' : ''; ?>
								<li>
									<a
										class="list-item medium <?php echo esc_attr( $dis_active ); ?>"
										href="<?php echo esc_url( get_permalink( $dis_cluster ) ); ?>"
									>
										<span><?php echo esc_html( $dis_cluster->post_title ); ?></span>
									</a>
								</li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<?php
get_footer();
