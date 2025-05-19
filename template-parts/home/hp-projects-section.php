<?php
/**
 * The HP Project list section.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$items          = DIS_ContentsManager::get_hp_project_list();
	$all_items_link = DIS_ContentsManager::get_page_link( PROJECTS_PAGE_SLUG );
	if ( count( $items ) ) {
?>

	<section id="blocco-progetti" class="section section-muted pt-5 pb-3">
		<div class="section-content">
			<div class="container">

				<h2 class="pb-4">
				<?php
				if ( $show_title ) {
					echo __( 'Projects' , 'design_ict_site' );
				}
				?>
				</h2>
				<div class="row">

					<?php
					foreach ( $items as $item ){
						$image_data = DIS_ContentsManager::get_image_metadata( $item, 'medium' );
						// $short_desc = DIS_CustomFieldsManager::get_field( 'short_description' , $item->ID );
					?>
					<div class="col-12 col-lg-4">
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
						<?php echo __( 'All projects', 'design_ict_site' ); ?>
					</a>
				</div>

			</div>
		</div>
	</section>


<?php
	}
}
?>