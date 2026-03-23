<?php
/**
 * The HP Featured Contents section.
 * Shows dis-service-item posts with "Show in Home Page" enabled.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' );
$section_enabled = ( $enabled_par === 'true' );

if ( $section_enabled ) {
	$items = DIS_ContentsManager::get_service_item_list_for_hp();
	if ( ! empty( $items ) ) {
?>

	<section id="blocco-servizi" class="section pt-5 pb-5">
		<div class="section-content">
			<div class="container">
				<?php if ( $show_title ) : ?>
					<h2 class="pb-2"><?php echo esc_html( __( 'Featured services', 'design_ict_site' ) ); ?></h2>
				<?php else : ?>
					<h2 class="visually-hidden"><?php echo esc_html( __( 'Featured services', 'design_ict_site' ) ); ?></h2>
				<?php endif; ?>
				<div class="row">
					<div class="card-wrapper card-teaser-wrapper card-teaser-block-3">
						<?php foreach ( $items as $item ) :
							$short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $item->ID );
						?>
						<!--start card-->
						<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
							<div class="card-body text-center">
								<a href="<?php echo esc_url( get_permalink( $item ) ); ?>">
									<h3 class="card-title h3 text-primary">
										<?php echo esc_html( $item->post_title ); ?>
									</h3>
									<?php if ( $short_desc ) : ?>
										<p class="card-text font-serif">
											<?php echo esc_html( $short_desc ); ?>
										</p>
									<?php endif; ?>
								</a>
							</div>
						</div>
						<!--end card -->
						<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php
	}
}
?>
