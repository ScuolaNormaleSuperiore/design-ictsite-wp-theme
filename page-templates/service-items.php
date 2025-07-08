<?php
/* Template Name: ServiceItems
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$services    = DIS_ContentsManager::get_service_list( 'title', null );
$serv_by_cat = array();
// Group by category.
foreach ( $services as $service ) {
	$clusters = DIS_CustomFieldsManager::get_field( 'cluster', $service->ID );
	foreach ( $clusters as $cluster ) {
		if ( array_key_exists( $cluster->post_title, $serv_by_cat ) ) {
			array_push( $serv_by_cat[ $cluster->post_title ]['children'], $service );
		} else {
			$item = array(
				'title'    => $cluster->post_title,
				'item'     => $cluster,
				'children' => array( $service ),
			);
			$serv_by_cat[ $cluster->post_title ] = $item;
		}
	}
}
// Order by category.
ksort( $serv_by_cat );
?>
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		
		<div class="col">
			<h2 class="pb-2">
				<?php echo __( 'Full list of services', 'design_ict_site' ); ?>
			</h2>
			<!-- SERVICES BY CATEGORY -->
			<div class="link-list-wrapper">
				<ul class="link-list">
					<?php
					foreach( $serv_by_cat as $cat ) {
					?>
					<li>
						<a class="list-item large medium icon-right"
							href="<?php echo get_permalink( $cat['item']->ID ); ?>">
							<span class="list-item-title-icon-wrapper">
							<span class="list-item-title">
								<?php echo esc_attr( $cat['title'] ); ?>
							</span>
							<svg class="icon icon-primary">
								<title><?php echo esc_attr( $cat['title'] ); ?></title>
								<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-link'; ?>"></use>
							</svg>
							</span>
						</a>
						<ul class="link-sublist">
							<?php
							foreach ( $cat['children'] as $srv ) {
							?>
							<li>
								<a class="list-item"
									href="<?php echo esc_url( get_permalink( $srv->ID ) ); ?>">
									<span><?php echo esc_attr( $srv->post_title ); ?></span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</li>
					<?php
					}
					?>
				</ul>
			</div>
		</div>

		<!-- SIDEBAR NAVIGATION -->
		<?php
			get_template_part( 'template-parts/common/sidebar-navigation' );
		?>

	</div>
</div>

<?php
get_footer();
