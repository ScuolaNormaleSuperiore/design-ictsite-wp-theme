<?php
/* Template Name: dis-place
*
* @package Design_ICT_Site
*/

global $post;
get_header();

// Get default values.
$all_types   = get_terms(
	array(
		'taxonomy'   => DIS_PLACE_TYPE_TAXONOMY,
		'hide_empty' => true,
	)
);
$default_type_list = array_column( $all_types, 'slug' );

// Check and sanitize parameters.
if ( isset( $_GET['selected_types'] ) && is_array( $_GET['selected_types'] ) ) {
	$selected_types = array_map( 'sanitize_text_field', wp_unslash( $_GET['selected_types'] ) );
} else {
	$selected_types = array();
}

// Prepare the query.
$params = array(
	'post_type'      => DIS_PLACE_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $posts_per_page,
	'paged'          => $paged,
	'orderby'        => 'post_date',
	'order'          => 'DESC',
);

// Add place type filter, if selected.
if ( count( $selected_types ) > 0 ) {
	$params['taxonomy'] = DIS_PLACE_TYPE_TAXONOMY;
	$params['terms']    = $selected_types;
}

// Execute the query.
$the_query   = DIS_ContentsManager::get_generic_post_query( $params );
$num_results = $the_query->found_posts;
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<!-- LUOGHI -->
		<div class="col">

			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<?php if ( $num_results ) : ?>
				<!-- RESULT LIST  -->
				<ul class="it-card-list row" aria-label="Lista delle news">
					<?php
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$image_data = DIS_ContentsManager::get_image_metadata( $post, 'full' );
						$short_desc = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
						$types      = get_the_terms( $post->ID, DIS_PLACE_TYPE_TAXONOMY );
						$place_type = ( $types && ( count( $types ) ) ) > 0 ? $types[0] : null;

						// Manage offices.
						$offices        = DIS_ContentsManager::get_place_offices( $post );
						$offices_string = DIS_ContentsManager::get_string_list_from_posts( $offices, true );
						?>
						<li class="col-12 col-md-12 col-lg-12 mb-3 mb-md-4">
						<article class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border mb-3">
								<div class="it-card-profile-header">
									<div class="it-card-profile">
										<h4 class="it-card-profile-name ">
											<a href="<?php echo esc_url( get_permalink( $post ) ); ?>">
												<?php echo esc_attr( $post->post_title ); ?>
											</a>
										</h4>
										<p class="it-card-profile-type">
											<?php echo esc_attr( $place_type->name ); ?>
										</p>
									</div>

								</div>
								<div class="it-card-body">
									<?php if ( $offices_string ) : ?>
									<dl class="it-card-description-list">
											<p>
												<?php echo wp_kses_post( $offices_string ); ?>
											</p>
									</dl>
									<?php endif ?>
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
						<em><?php echo esc_attr( __( 'No results found', 'design_ict_site' ) ); ?></em>
					</div>
				</div>
			<?php endif ?>


			<!-- @TODO: Results pagination-->
		</div> <!-- col -->

		<!-- SIDEBAR FILTERS -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<FORM action="." id="search_site_form" method="GET">
					<!-- Types -->
					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo esc_attr( __( 'Filter by place type', 'design_ict_site' ) ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo esc_attr( __( 'Filter by place type', 'design_ict_site' ) ); ?>
							</legend>
							<?php foreach ( $all_types as $tp ) : ?>
							<!-- Item type -->
							<div class="form-check">
								<input id="<?php echo esc_attr( $tp->slug ); ?>"  name="selected_types[]" type="checkbox"
									value="<?php echo esc_attr( $tp->slug ); ?>"
									<?php
									if ( count( $selected_types ) > 0 && in_array( $tp->slug, $selected_types ) ) {
										echo "checked='checked'";
									}
									?>
								>
								<label for="<?php echo esc_attr( $tp->slug ); ?>">
									<?php echo esc_attr( $tp->name ); ?>
								</label>
							</div>
							<?php endforeach ?>
						</fieldset>
					</div>
					<!-- Apply filter button -->
					<div class="p-4 pt-lg-0">
						<button type="submit" value="submit" class="btn btn-primary">
							<?php echo esc_attr( __( 'Apply filters', 'design_ict_site' ) ); ?>
						</button>
					</div>

				</FORM>
			</div>
		</div>

	</div> <!-- row -->
</div> <!-- container -->

<?php
get_footer();
