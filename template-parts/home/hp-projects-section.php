<?php
/**
 * The HP project list section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );

if ( $dis_section_enabled ) {
	$dis_items          = DIS_ContentsManager::get_hp_item_list( DIS_PROJECT_POST_TYPE );
	$dis_all_items_link = DIS_MultiLangManager::get_archive_link( DIS_PROJECT_POST_TYPE );

	if ( count( $dis_items ) ) {
		?>
		<section id="blocco-progetti" class="section section-muted pt-5 pb-3">
			<div class="section-content">
				<div class="container">
					<h2 class="pb-4">
						<?php
						if ( $dis_show_title ) {
							echo esc_html__( 'Projects', 'design_ict_site' );
						}
						?>
					</h2>
					<div class="row">
						<?php foreach ( $dis_items as $dis_item ) : ?>
							<?php
							$dis_image_data = DIS_ContentsManager::get_image_metadata( $dis_item, 'medium' );
							$dis_short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $dis_item->ID );
							?>
							<div class="col-12 col-lg-4">
								<article class="it-card it-card-image it-card-height-full">
									<h3 class="it-card-title ">
										<a href="<?php echo esc_url( get_permalink( $dis_item->ID ) ); ?>" title="<?php echo esc_attr( $dis_item->post_title ); ?>">
											<?php echo esc_html( $dis_item->post_title ); ?>
										</a>
									</h3>
									<div class="it-card-image-wrapper">
										<div class="ratio ratio-16x9">
											<figure class="figure img-full">
												<img
													src="<?php echo esc_url( $dis_image_data['image_url'] ); ?>"
													title="<?php echo esc_attr( $dis_image_data['image_title'] ); ?>"
													alt="<?php echo esc_attr( $dis_image_data['image_alt'] ); ?>"
												>
											</figure>
										</div>
									</div>
									<div class="it-card-body">
										<p class="it-card-text">
											<?php echo esc_html( $dis_short_desc ); ?>
										</p>
									</div>
								</article>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="text-center pt-5 pb-5">
						<a href="<?php echo esc_url( $dis_all_items_link ); ?>" class="btn btn-secondary">
							<?php echo esc_html__( 'All projects', 'design_ict_site' ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

		<?php
	}
}
