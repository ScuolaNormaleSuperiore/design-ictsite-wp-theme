<?php
/**
 * The HP articles list section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );

if ( $dis_section_enabled ) {
	$dis_items          = DIS_ContentsManager::get_hp_item_list( DIS_DEFAULT_POST );
	$dis_all_items_link = DIS_MultiLangManager::get_archive_link( DIS_DEFAULT_POST );

	if ( count( $dis_items ) ) {
		?>

		<section id="articles-block" class="section pt-5 pb-3">
			<div class="section-content">
				<div class="container">
					<h2 class="pb-4">
						<?php
						if ( $dis_show_title ) {
							echo esc_html( dis_ct_data()[ DIS_DEFAULT_POST ]['plural_name'] );
						}
						?>
					</h2>
					<div class="row">
						<?php foreach ( $dis_items as $dis_item ) : ?>
							<?php $dis_image_data = DIS_ContentsManager::get_image_metadata( $dis_item, 'medium' ); ?>
							<div class="col-12 col-lg-3">
								<div class="card-wrapper">
									<div class="card card-img no-after">
										<a
											href="<?php echo esc_url( get_permalink( $dis_item->ID ) ); ?>"
											title="<?php echo esc_attr( $dis_item->post_title ); ?>"
										>
											<div class="img-responsive-wrapper">
												<div class="img-responsive">
													<figure class="img-wrapper">
														<img
															src="<?php echo esc_url( $dis_image_data['image_url'] ); ?>"
															title="<?php echo esc_attr( $dis_image_data['image_title'] ); ?>"
															alt="<?php echo esc_attr( $dis_image_data['image_alt'] ); ?>"
														>
													</figure>
												</div>
											</div>
											<div class="card-body">
												<h3 class="card-title h4">
													<?php echo esc_html( $dis_item->post_title ); ?>
												</h3>
											</div>
										</a>
									</div>
								</div>
							</div>
						<?php endforeach; ?>
					</div>
					<div class="text-center pt-5 pb-5">
						<a href="<?php echo esc_url( $dis_all_items_link ); ?>" class="btn btn-secondary">
							<?php echo esc_html__( 'All articles', 'design_ict_site' ); ?>
						</a>
					</div>
				</div>
			</div>
		</section>

		<?php
	}
}
