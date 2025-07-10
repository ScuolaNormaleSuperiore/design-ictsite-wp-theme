<?php
/**
 * The HP DIS-Project list section.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$items          = DIS_ContentsManager::get_hp_item_list( DIS_PROJECT_POST_TYPE );
	$all_items_link = DIS_MultiLangManager::get_archive_link( DIS_PROJECT_POST_TYPE );
	if ( count( $items ) ) {
?>

	<section id="blocco-progetti" class="section section-muted pt-5 pb-3">
		<div class="section-content">
			<div class="container">

				<h2 class="pb-4">
				<?php
				if ( $show_title ) {
					echo esc_attr( __( 'Projects', 'design_ict_site' ) );
				}
				?>
				</h2>
				<div class="row">

					<?php
					foreach ( $items as $item ) {
						$image_data = DIS_ContentsManager::get_image_metadata( $item, 'medium' );
						$short_desc = DIS_CustomFieldsManager::get_field( 'short_description' , $item->ID );
					?>
						<div class="col-12 col-lg-4">
							<article class="it-card it-card-image it-card-height-full">
								<h3 class="it-card-title ">
									<a
										href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>"
										title="<?php echo esc_attr( $item->post_title ); ?>"
										alt="<?php echo esc_attr( $item->post_title ); ?>"
									>
										<?php echo esc_attr( $item->post_title ); ?>
									</a>
								</h3>
								<div class="it-card-image-wrapper">
									<div class="ratio ratio-16x9">
										<figure class="figure img-full">
											<img
													src="<?php echo esc_url( $image_data['image_url'] ); ?>"
													title="<?php echo esc_attr( $image_data['image_title'] ); ?>"
													alt="<?php echo esc_attr( $image_data['image_alt'] ); ?>"
												>
										</figure>
									</div>
								</div>
								<div class="it-card-body">
								<p class="it-card-text">
									<?php echo esc_attr( $short_desc ); ?>
								</p>
								</div>
							</article>
						</div>
					<?php
					}
					?>

				</div>
				<div class="text-center pt-5 pb-5">
					<a href="<?php echo esc_url( $all_items_link ); ?>" class="btn btn-secondary">
						<?php echo esc_attr( __( 'All projects', 'design_ict_site' ) ); ?>
					</a>
				</div>

			</div>
		</div>
	</section>


<?php
	}
}
?>
