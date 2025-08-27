<?php
/* Template Name: Search
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$search_string     = '';
$all_content_types = DIS_ContentsManager::get_content_types_with_results();
$default_ct_list   = array_column( $all_content_types, 'slug' );
$all_clusters      = DIS_ContentsManager::get_cluster_list();
$default_cl_list   = array_map( function( $cluster ) { return $cluster->post_name; }, $all_clusters );
$num_results       = 0;
$the_query         = null;
$posts_per_page    = isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ? sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) ) : DIS_ITEMS_PER_PAGE_EVEN;
$per_page_values   = DIS_ITEMS_PER_PAGE_VALUES_EVEN;

// Set and format the filters for the query.
if ( isset( $_GET['isreset'] ) && ( sanitize_text_field( wp_unslash( $_GET['isreset'] ) ) === 'yes' ) ) {
	$selected_contents = $default_ct_list;
	$selected_clusters = $default_cl_list;
	$search_string     = '';
} else {
	if ( isset( $_GET['selected_contents'] ) ) {
		$selected_contents = $_GET['selected_contents'];
		$searchable_ct     = $selected_contents;
	} else {
		$selected_contents = array();
		$searchable_ct     = $default_ct_list;
	}
	if ( isset( $_GET['selected_clusters'] ) ) {
		$selected_clusters = $_GET['selected_clusters'];
	} else {
		$selected_clusters = array();
	}
	if ( ! is_array( $selected_contents ) ) {
		$selected_contents = array();
	}
	if ( isset( $_GET['search_string'] ) ) {
		$search_string = sanitize_text_field( $_GET['search_string'] );
	} else {
		$search_string = '';
	}
}

// Execute the query if the NONCE is valid.
if (
	isset( $_GET['site_search_nonce_field'] ) &&
	wp_verify_nonce( sanitize_text_field( $_GET['site_search_nonce_field'] ), 'sf_site_search_nonce' )
) {
	// EXECUTE THE QUERY .
	$the_query = DIS_ContentsManager::get_site_search_query(
		$searchable_ct,
		$search_string,
		$posts_per_page
	);
	$num_results = $the_query->found_posts;
}
$result_message = sprintf( __( 'Found %s results.', 'design_ict_site' ), $num_results );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<!-- RESULTS -->
		<div class="col">

			<h2 class="pb-2">
				<?php echo __( 'Search results', 'design_ict_site' ); ?>
			</h2>

			<!-- SEARCH RESULTS NUMBER -->
			<p>
				<small><?php echo esc_attr( $result_message ); ?></small>
			</p>

			<!-- SEARCH RESULTS LIST -->
			<?php
			if ( ( $num_results > 0 ) ) {
			?>
			<ul class="it-card-list row"
				aria-label="<?php echo __( 'Search results', 'design_ict_site' ); ?>">
				<?php
				// The main loop of the page.
				$post_index = 0;
				while ( $the_query->have_posts() ) {
					$the_query->the_post();
					$wrapper = DIS_ContentsManager::wrap_search_result( $post );
				?>
				<li class="col-12 col-md-6 col-lg-4 mb-3 mb-md-4">
					<!--start it-card-->
					<article class="it-card it-card-height-full rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<a href="<?php echo esc_url( $wrapper->link ); ?>">
								<?php echo esc_attr( $wrapper->title ); ?>
							</a>
						</h3>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-text">
								<?php echo esc_attr( wp_trim_words( $wrapper->description, DIS_ACF_SHORT_DESC_LENGTH ) ); ?>
							</p>
						</div>
						<!--finally the card footer metadata-->
						<footer class="it-card-related it-card-footer">
							<div class="it-card-taxonomy">
								<a href="<?php echo esc_url( $wrapper->type_link ); ?>"
									class="it-card-category it-card-link link-secondary">
									<span class="visually-hidden">
										<?php echo __( 'Related category', 'design_ict_site' ); ?>
									</span>
									<?php echo esc_attr( $wrapper->type ); ?>
								</a>
							</div>
						</footer>
					</article>
					<!--end it-card-->
				</li>
				<?php
					$post_index++;
				}
				wp_reset_postdata();
				?>
			</ul>
			<?php
			}
			?>

			<!-- Results PAGINATION-->
			<?php
				get_template_part(
					'template-parts/common/pagination',
					null,
					array(
						'query'           => $the_query,
						'posts_per_page'        => $posts_per_page,
						'per_page_values' => $per_page_values,
						'num_results'     => $num_results,
					)
				);
			?>

		</div>


		<!-- SEARCH SIDEBAR -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<FORM action="." id="search_site_form" method="GET">
					<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>

					<!-- Filter by TEXT -->
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-text">
								<svg class="icon icon-sm" aria-hidden="true">
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search'; ?>"></use>
								</svg>
							</span>
							<label for="search_string">
								<?php echo esc_html( __( 'Search the site', 'design_ict_site' ) ); ?>
							</label>
							<input type="text"
								id="search_string"
								name="search_string"
								class="form-control"
								value="<?php echo esc_attr( $search_string ?? '' ); ?>"
								placeholder="<?php echo esc_html( __( 'Digit the text to search', 'design_ict_site' ) ); ?>"
							>
							<div class="input-group-append">
								<button type="submit" value="submit" class="btn btn-primary">
									<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
								</button>
							</div>
						</div>
					</div>

					<!-- Filter by CLUSTER -->
					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo __( 'Service clusters', 'design_ict_site' ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo __( 'Filters for selecting search results', 'design_ict_site' ); ?>
							</legend>
							<?php
							foreach( $all_clusters as $cl ) {
							?>
							<div class="form-check">
								<input type="checkbox" name="selected_clusters[]" id="<?php echo esc_attr( $cl->post_name ); ?>" 
									value="<?php echo esc_attr( $cl->post_name ); ?>"
									<?php
										if ( count( $selected_clusters ) > 0 && in_array( $cl->post_name, $selected_clusters ) ) {
											echo "checked='checked'";
										}
									?>
								>
								<label for="<?php echo esc_attr( $cl->post_name ) ; ?>">
									<?php echo esc_attr( $cl->post_title ); ?>
								</label>
							</div>
							<?php
							}
							?>
						</fieldset>
					</div>

					<!-- Filter by POST TYPE -->
					<div class="p-4 pt-lg-0">
						<h3 class="p-0">
							<?php echo __( 'Content types', 'design_ict_site' ); ?>
						</h3>
						<fieldset>
							<legend class="visually-hidden">
								<?php echo __( 'Filters for selecting search results', 'design_ict_site' ); ?>
							</legend>
							<?php
							foreach( $all_content_types as $ct ) {
							?>
							<div class="form-check">
								<input type="checkbox" name="selected_contents[]" id="<?php echo esc_attr( $ct['slug'] ); ?>" 
									value="<?php echo esc_attr( $ct['slug'] ); ?>"
									<?php
										if ( count( $selected_contents ) > 0 && in_array( $ct['slug'], $selected_contents ) ) {
										echo "checked='checked'";
									} ?>
								>
								<label for="<?php echo esc_attr( $ct['slug'] ) ; ?>">
									<?php echo esc_attr( $ct['name'] ); ?>
								</label>
							</div>
							<?php
							}
							?>
						</fieldset>
					</div>

					<!-- Submit the form -->
					<div class="p-4 pt-lg-0">
						<!-- <button type="button" class="btn btn-primary">Applica filtri</button>-->
						<button type="submit" value="submit" class="btn btn-primary">
							<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
						</button>
					</div>

				</FORM>
			</div>
		</div>
		<!-- END SEARCH SIDEBAR -->
		
	</div>
</div>


<?php
get_footer();
