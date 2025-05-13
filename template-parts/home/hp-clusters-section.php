<?php
/**
 * The HP Cluster list section.
 *
 * @package Design_ICT_Site
 */

$enabled_par     = $args['enabled'] ?? '';
$id_par          = $args['id'] ?? '';
$show_title_par  = $args['show_title'] ?? '';
$show_title      = ( $show_title_par === 'true' ) ? true : false;
$section_enabled = ( $enabled_par === 'true' ) ? true : false;

if ( $section_enabled ) {
	$items = DIS_ContentsManager::get_cluster_list( $hp=true );
	// $all_items_link = DIS_ContentsManager::get_page_link( SERVICE_CLUSTER_PAGE_SLUG );
?>
	<!-- CLUSTER SERVICE ITEMS SECTION -->
	<div class="container card shadow rounded home-listing-items p-4 pt-5 pb-3">
		<h2 class="pb-2">
		<?php
		if ( $show_title ) {
			echo __( 'Our services' , 'design_ict_site' );
		}
		?>
		</h2>
		<div class="row">
			<div class="card-wrapper card-teaser-wrapper card-teaser-block-4">

			<?php
			foreach ( $items as $item ) {
				$icon_code = DIS_CustomFieldsManager::get_field( 'icon_code' , $item->ID );
			?>
				<!--start card-->
				<div class="card card-bg rounded card-teaser bg-white"
					style="border-top: 3px solid">
					<div class="card-body text-center">
						<a href="<?php echo esc_url( get_permalink( $item ) ); ?>">
							<i class="bi <?php echo esc_attr( $icon_code ); ?>" style="font-size: 3rem;"></i>
							<h3 class="card-title h5 text-primary">
								<?php echo esc_attr( $item->post_title ); ?>
							</h3>
						</a>
					</div>
				</div>
				<!--end card -->
			<?php
			}
			?>

			</div>
		</div>
	</div>

<?php
}
?>
