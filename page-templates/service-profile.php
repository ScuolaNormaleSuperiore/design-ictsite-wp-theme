<?php
/**
 * Template Name: ServiceProfile
 *
 * @package Design_ICT_Site
 */

get_header();

$dis_user_status = '';
if ( isset( $_GET['user_status'] ) && ! empty( $_GET['user_status'] ) ) {
	$dis_user_status = sanitize_text_field( wp_unslash( $_GET['user_status'] ) );
}

$dis_status_taxonomy = $dis_user_status ? get_term_by( 'slug', $dis_user_status, DIS_USER_STATUS_TAXONOMY ) : false;
$dis_has_user_status = $dis_status_taxonomy && ! is_wp_error( $dis_status_taxonomy );

if ( $dis_has_user_status ) {
	$dis_services    = DIS_ContentsManager::get_service_list_by_user_status( $dis_user_status );
	$dis_serv_by_cat = DIS_ContentsManager::group_services_by_cluster( $dis_services );
	ksort( $dis_serv_by_cat );
}

?>

<div class="container shadow rounded p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<!-- SERVICES -->
		<div class="col">
			<h2 class="pb-2">
				<?php
				if ( $dis_has_user_status ) {
					echo esc_html( __( 'Services for', 'design_ict_site' ) . ' ' . strtolower( $dis_status_taxonomy->name ) );
				} else {
					echo esc_html( get_the_title() );
				}
				?>
			</h2>

			<?php if ( $dis_has_user_status ) : ?>
				<?php
				get_template_part(
					'template-parts/common/services-by-category',
					false,
					array(
						'serv_by_cat' => $dis_serv_by_cat,
					)
				);
				?>
			<?php elseif ( $dis_user_status ) : ?>
				<p><?php echo esc_html__( 'The requested profile is not available.', 'design_ict_site' ); ?></p>
			<?php else : ?>
				<p><?php echo esc_html__( 'Select a profile to view the available services.', 'design_ict_site' ); ?></p>
			<?php endif; ?>
		</div>

		<!-- SIDEBAR NAVIGATION -->
		<?php
		get_template_part(
			'template-parts/common/sidebar-navigation',
			false,
			array(
				'user_status' => $dis_has_user_status ? $dis_user_status : '',
			)
		);
		?>
	</div>
</div>

<?php
get_footer();
