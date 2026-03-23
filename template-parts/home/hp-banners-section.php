<?php
/**
 * The HP banners section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );

if ( $dis_section_enabled ) {
	$dis_items = DIS_ContentsManager::get_hp_banner_list();
	foreach ( $dis_items as $dis_item ) {
		$dis_image_data   = DIS_ContentsManager::get_image_metadata( $dis_item, 'full', '/assets/img/default-background.png' );
		$dis_section      = DIS_CustomFieldsManager::get_field( 'section', $dis_item->ID );
		$dis_button_label = DIS_CustomFieldsManager::get_field( 'button_label', $dis_item->ID );
		$dis_button_link  = DIS_CustomFieldsManager::get_field( 'button_link', $dis_item->ID );
		$dis_new_window   = DIS_CustomFieldsManager::get_field( 'new_window', $dis_item->ID );
		?>

		<div class="container-banner-home">
			<?php if ( $dis_show_title ) : ?>
				<h2 class="pb-4"><?php echo esc_html__( 'Banner', 'design_ict_site' ); ?></h2>
			<?php else : ?>
				<h2 class="visually-hidden"><?php echo esc_html__( 'Activity banner', 'design_ict_site' ); ?></h2>
			<?php endif; ?>

			<section class="it-hero-wrapper it-hero-small-size it-primary it-overlay ">
				<div class="img-responsive-wrapper">
					<div class="img-responsive">
						<div class="img-wrapper">
							<img
								src="<?php echo esc_url( $dis_image_data['image_url'] ); ?>"
								title="<?php echo esc_attr( $dis_image_data['image_title'] ); ?>"
								alt="<?php echo esc_attr( $dis_image_data['image_alt'] ); ?>"
							>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row">
						<div class="col-12">
							<div class="it-hero-text-wrapper">
								<span class="it-Categoria"><?php echo esc_html( $dis_section ); ?></span>
								<h2><?php echo esc_html( $dis_item->post_title ); ?></h2>
								<p class="d-none d-lg-block">
									<?php echo wp_kses_post( apply_filters( 'the_content', $dis_item->post_content ) ); // phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedHooknameFound -- Core WordPress content filter. ?>
								</p>
								<div class="it-btn-container">
									<a
										<?php
										if ( $dis_new_window ) {
											echo 'target="_blank"';
										}
										?>
										class="btn btn-sm btn-secondary"
										href="<?php echo esc_url( $dis_button_link ); ?>"
									>
										<?php echo esc_html( $dis_button_label ); ?>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</div>

		<?php
	}
}
