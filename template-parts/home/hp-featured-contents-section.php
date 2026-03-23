<?php
/**
 * The HP featured contents section.
 *
 * Shows dis-service-item posts with "Show in Home Page" enabled.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );

if ( $dis_section_enabled ) {
	$dis_items = DIS_ContentsManager::get_service_item_list_for_hp();
	if ( ! empty( $dis_items ) ) {
		?>

		<section id="blocco-servizi" class="section pt-5 pb-5">
			<div class="section-content">
				<div class="container">
					<?php if ( $dis_show_title ) : ?>
						<h2 class="pb-2"><?php echo esc_html__( 'Featured services', 'design_ict_site' ); ?></h2>
					<?php else : ?>
						<h2 class="visually-hidden"><?php echo esc_html__( 'Featured services', 'design_ict_site' ); ?></h2>
					<?php endif; ?>
					<div class="row">
						<div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
							<?php foreach ( $dis_items as $dis_item ) : ?>
								<?php $dis_short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $dis_item->ID ); ?>
								<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
									<div class="card-body text-center">
										<a href="<?php echo esc_url( get_permalink( $dis_item ) ); ?>">
											<h3 class="card-title h3 text-primary">
												<?php echo esc_html( $dis_item->post_title ); ?>
											</h3>
											<?php if ( $dis_short_desc ) : ?>
												<p class="card-text font-serif">
													<?php echo esc_html( $dis_short_desc ); ?>
												</p>
											<?php endif; ?>
										</a>
									</div>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				</div>
			</div>
		</section>

		<?php
	}
}
