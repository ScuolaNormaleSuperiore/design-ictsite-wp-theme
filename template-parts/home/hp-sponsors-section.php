<?php
/**
 * The HP sponsors section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_section_enabled = ( 'true' === $dis_enabled_par );

if ( $dis_section_enabled ) {
	$dis_items = DIS_ContentsManager::get_hp_sponsor_list();
	?>
	<section id="sponsor" class="section">
		<div class="container my-12">
			<h2 class="visually-hidden"><?php echo esc_html__( 'Sponsor and partnerships', 'design_ict_site' ); ?></h2>
			<div class="it-grid-list-wrapper it-image-label-grid">
				<div class="grid-row">
					<?php
					update_postmeta_cache( wp_list_pluck( $dis_items, 'ID' ) );
					foreach ( $dis_items as $dis_item ) {
						$dis_image_data    = DIS_ContentsManager::get_image_metadata( $dis_item, 'full', '/assets/img/default-background.png' );
						$dis_external_link = DIS_CustomFieldsManager::get_field( 'external_link', $dis_item->ID );
						?>
						<div class="col-6 col-lg-3">
							<div class="it-grid-item-wrapper">
								<?php if ( $dis_external_link ) : ?>
									<a href="<?php echo esc_url( $dis_external_link ); ?>">
								<?php endif; ?>
								<figure class="figure img-full w-100">
									<img
										class="figure-img img-fluid rounded"
										src="<?php echo esc_url( $dis_image_data['image_url'] ); ?>"
										title="<?php echo esc_attr( $dis_image_data['image_title'] ); ?>"
										alt="<?php echo esc_attr( $dis_image_data['image_alt'] ); ?>"
									>
								</figure>
								<?php if ( $dis_external_link ) : ?>
									</a>
								<?php endif; ?>
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
