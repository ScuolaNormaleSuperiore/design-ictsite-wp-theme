<?php
/**
 * The HP Articles list section.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$items          = DIS_ContentsManager::get_hp_item_list( DIS_DEFAULT_POST );
	$all_items_link = DIS_MultiLangManager::get_archive_link( DIS_DEFAULT_POST );
	if ( count( $items ) ) {
?>

	<!-- ARTICLES SECTION-->
	<section id="articles-block" class="section pt-5 pb-3">
		<div class="section-content">
			<div class="container">
				<h2 class="pb-4">
				<?php
				if ( $show_title ) {
					echo esc_attr( dis_ct_data()[ DIS_DEFAULT_POST ]['plural_name'] );
				}
				?>
				</h2>
				<div class="row">
					<?php
					foreach ( $items as $item ) {
						$image_data = DIS_ContentsManager::get_image_metadata( $item, 'medium' );
					?>
						<div class="col-12 col-lg-3">
							<div class="card-wrapper">
								<div class="card card-img no-after">
									<a
										href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>"
										title="<?php echo esc_attr( $item->post_title ); ?>"
										alt="<?php echo esc_attr( $item->post_title ); ?>"
									>
										<div class="img-responsive-wrapper">
											<div class="img-responsive">
												<figure class="img-wrapper">
													<img
														src="<?php echo esc_url( $image_data['image_url'] ); ?>"
														title="<?php echo esc_attr( $image_data['image_title'] ); ?>"
														alt="<?php echo esc_attr( $image_data['image_alt'] ); ?>"
													>
												</figure>
											</div>
										</div>
										<div class="card-body">
											<h3 class="card-title h4">
												<?php echo esc_attr( $item->post_title ); ?>
											</h3>
										</div>
									</a>
								</div>
							</div>
						</div>
					<?php
					}
					?>
				</div>
				<div class="text-center pt-5 pb-5">
					<a href="<?php echo esc_url( $all_items_link ); ?>" class="btn btn-secondary">
						<?php echo __( 'All articles', 'design_ict_site' ); ?>
					</a>
				</div>
			</div>
		</div>
	</section>

<?php
	}
}
?>
