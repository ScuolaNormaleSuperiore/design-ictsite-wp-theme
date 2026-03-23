<?php
/**
 * Template Name: ServiceItems
 *
 * @package Design_ICT_Site
 */

get_header();

$dis_services    = DIS_ContentsManager::get_service_list( 'priority', null );
$dis_serv_by_cat = DIS_ContentsManager::group_services_by_cluster( $dis_services );
// Order by category.
ksort( $dis_serv_by_cat );
$dis_user_status = '';
?>
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">

			<h2 class="pb-2">
				<?php echo esc_html__( 'Full list of services', 'design_ict_site' ); ?>
			</h2>

			<!-- SERVICES BY CATEGORY -->
			<?php
			get_template_part(
				'template-parts/common/services-by-category',
				false,
				array(
					'serv_by_cat' => $dis_serv_by_cat,
				)
			);
			?>

		</div>

		<!-- SIDEBAR NAVIGATION -->
		<?php
			get_template_part(
				'template-parts/common/sidebar-navigation',
				false,
				array(
					'user_status' => $dis_user_status,
				)
			);
			?>

	</div>
</div>

<?php
get_footer();
