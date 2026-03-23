<?php
/**
 * Template Name: Places
 *
 * @package Design_ICT_Site
 */

get_header();

// Check pagination parameters.
$dis_posts_per_page  = strval( DIS_ITEMS_PER_PAGE_ODD );
$dis_per_page_values = DIS_ITEMS_PER_PAGE_VALUES_ODD;
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
	$dis_posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );
}
$dis_current_page = 1;
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive pagination parameter.
if ( isset( $_GET['num_page'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive pagination parameter.
	$dis_current_page = max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) );
}


// Get default values.
$dis_all_types = get_terms(
	array(
		'taxonomy'   => DIS_PLACE_TYPE_TAXONOMY,
		'hide_empty' => true,
	)
);

// Check and sanitize parameters.
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
if ( isset( $_GET['selected_types'] ) && is_array( $_GET['selected_types'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
	$dis_selected_types = array_map( 'sanitize_text_field', wp_unslash( $_GET['selected_types'] ) );
} else {
	$dis_selected_types = array();
}

// Prepare the query.
$dis_params = array(
	'post_type'      => DIS_PLACE_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $dis_posts_per_page,
	'current_page'   => $dis_current_page,
	'orderby'        => 'post_date',
	'order'          => 'DESC',
);

// Add place type filter, if selected.
if ( count( $dis_selected_types ) > 0 ) {
	$dis_params['taxonomy'] = DIS_PLACE_TYPE_TAXONOMY;
	$dis_params['terms']    = $dis_selected_types;
}

// Execute the query.
$dis_query       = DIS_ContentsManager::get_generic_post_query( $dis_params );
$dis_num_results = $dis_query->found_posts;
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<!-- LUOGHI -->
		<div class="col">

			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_html( get_the_title() ); ?>
			</h2>

			<?php if ( $dis_num_results ) : ?>
				<!-- RESULT LIST  -->
				<ul class="it-card-list row" aria-label="Lista delle news">
					<?php
					while ( $dis_query->have_posts() ) {
						$dis_query->the_post();
						$dis_post       = get_post();
						$dis_image_data = DIS_ContentsManager::get_image_metadata( $dis_post, 'full' );
						$dis_short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $dis_post->ID );
						$dis_types      = get_the_terms( $dis_post->ID, DIS_PLACE_TYPE_TAXONOMY );
						$dis_place_type = ( $dis_types && count( $dis_types ) > 0 ) ? $dis_types[0] : null;

						// Manage offices.
						$dis_offices        = DIS_ContentsManager::get_place_offices( $dis_post );
						$dis_offices_string = DIS_ContentsManager::get_string_list_from_posts( $dis_offices, true );
						?>
						<li class="col-12 col-md-12 col-lg-12 mb-3 mb-md-4">
							<article class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border mb-3">
								<div class="it-card-profile-header">
									<div class="it-card-profile">
										<h4 class="it-card-profile-name ">
											<a href="<?php echo esc_url( get_permalink( $dis_post ) ); ?>">
												<?php echo esc_html( $dis_post->post_title ); ?>
											</a>
										</h4>
										<p class="it-card-profile-type">
											<?php echo $dis_place_type ? esc_html( $dis_place_type->name ) : ''; ?>
										</p>
									</div>

								</div>
								<div class="it-card-body">
									<?php if ( $dis_offices_string ) : ?>
										<dl class="it-card-description-list">
											<p>
												<?php echo wp_kses_post( $dis_offices_string ); ?>
											</p>
										</dl>
									<?php endif; ?>
									<?php if ( $dis_short_desc ) : ?>
										<p class="it-card-text">
											<?php echo esc_html( $dis_short_desc ); ?>
										</p>
									<?php endif; ?>
								</div>

							</article>
						</li>
						<?php
					}
					wp_reset_postdata();
					?>
				</ul>
			<?php else : ?>
				<div class="col-12 col-lg-8">
					<div class="row pt-2">
						<em><?php echo esc_html__( 'No results found', 'design_ict_site' ); ?></em>
					</div>
				</div>
			<?php endif; ?>


			<!-- Pagination results-->
			<?php
			get_template_part(
				'template-parts/common/pagination',
				null,
				array(
					'query'           => $dis_query,
					'posts_per_page'  => $dis_posts_per_page,
					'per_page_values' => $dis_per_page_values,
					'num_results'     => $dis_num_results,
					'current_page'    => $dis_current_page,
				)
			);
			?>
		</div> <!-- col -->

		<!-- SIDEBAR FILTERS -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<form action="." id="search_site_form" method="get">
					<!-- Types -->
					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo esc_html__( 'Filter by place type', 'design_ict_site' ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo esc_html__( 'Filter by place type', 'design_ict_site' ); ?>
							</legend>
							<?php foreach ( $dis_all_types as $dis_type ) : ?>
							<!-- Item type -->
							<div class="form-check">
								<input id="<?php echo esc_attr( $dis_type->slug ); ?>"  name="selected_types[]" type="checkbox"
									value="<?php echo esc_attr( $dis_type->slug ); ?>"
									<?php
									if ( count( $dis_selected_types ) > 0 && in_array( $dis_type->slug, $dis_selected_types, true ) ) {
										echo "checked='checked'";
									}
									?>
								>
								<label for="<?php echo esc_attr( $dis_type->slug ); ?>">
									<?php echo esc_html( $dis_type->name ); ?>
								</label>
							</div>
							<?php endforeach; ?>
						</fieldset>
					</div>
					<!-- Apply filter button -->
					<div class="p-4 pt-lg-0">
						<button type="submit" value="submit" class="btn btn-primary">
							<?php echo esc_html__( 'Apply filters', 'design_ict_site' ); ?>
						</button>
					</div>

				</form>
			</div>
		</div>

	</div> <!-- row -->
</div> <!-- container -->

<?php
get_footer();
