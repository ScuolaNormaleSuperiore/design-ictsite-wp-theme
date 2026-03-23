<?php
/**
 * The HP cluster list section.
 *
 * @package Design_ICT_Site
 */

$dis_enabled_par     = $args['enabled'] ?? '';
$dis_show_title_par  = $args['show_title'] ?? '';
$dis_show_title      = ( 'true' === $dis_show_title_par );
$dis_section_enabled = ( 'true' === $dis_enabled_par );

if ( $dis_section_enabled ) {
	$dis_items = DIS_ContentsManager::get_cluster_list( true, 'priority' );
	?>
	<div class="container card shadow rounded home-listing-items p-4 pt-5 pb-3">
		<h2 class="pb-2">
			<?php
			if ( $dis_show_title ) {
				echo esc_html__( 'Services', 'design_ict_site' );
			}
			?>
		</h2>
		<div class="row">
			<div class="card-wrapper card-teaser-wrapper card-teaser-block-4">
				<?php
				update_postmeta_cache( wp_list_pluck( $dis_items, 'ID' ) );
				foreach ( $dis_items as $dis_item ) {
					$dis_icon_code = DIS_CustomFieldsManager::get_field( 'icon_code', $dis_item->ID );
					?>
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body text-center">
							<a href="<?php echo esc_url( get_permalink( $dis_item ) ); ?>">
								<i class="bi <?php echo esc_attr( $dis_icon_code ); ?>" style="font-size: 3rem;"></i>
								<h3 class="card-title h5 text-primary">
									<?php echo esc_html( $dis_item->post_title ); ?>
								</h3>
							</a>
						</div>
					</div>
					<?php
				}
				?>
			</div>
		</div>
	</div>

	<?php
}
