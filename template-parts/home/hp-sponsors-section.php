<?php
/**
 * The HP Sponsors section.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$items = DIS_ContentsManager::get_hp_sponsor_list();
?>
	<!-- HP SPONSOR SECTION-->
	<section id="sponsor" class="section">
		<div class="container my-12">
			<h2 class="visually-hidden">Sponsor e partnership</h2>
			<div class="it-grid-list-wrapper it-image-label-grid">
				<div class="grid-row">
					<?php
					foreach ( $items as $item ) {
						$image_data    = DIS_ContentsManager::get_image_metadata( $item, 'full', '/assets/img/default-background.png' );
						$external_link = DIS_CustomFieldsManager::get_field( 'external_link' , $item->ID );
					?>
					<div class="col-6 col-lg-3">
						<div class="it-grid-item-wrapper">
							<?php
							if ( $external_link ) {
							?>
							<a href="<?php esc_url( $external_link ); ?>">
							<?php
							}
							?>
								<figure class="figure img-full w-100">
									<img
										class="figure-img img-fluid rounded"
										src="<?php echo esc_url( $image_data['image_url'] ); ?>"
										title="<?php echo esc_attr( $image_data['image_title'] ); ?>"
										alt="<?php echo esc_attr( $image_data['image_alt'] ); ?>"
									>
								</figure>
							<?php
							if ( $external_link ) {
							?>
							</a>
							<?php
							}
							?>
						</div>
					</div>
					<?php
					}
					?>
				</div>
			</div>
		</div>
	</section>

<?php
}
?>
