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

// Check pagination parameters.
$posts_per_page  = strval( DIS_ITEMS_PER_PAGE_EVEN );
$per_page_values = DIS_ITEMS_PER_PAGE_VALUES_EVEN;
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	$posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );
}
$current_page      = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

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
$result_message = sprintf( __( 'Found %s results for %s.', 'design_ict_site' ), $num_results, $search_string);
?>s


<!-- SEARCH BOX -->
<section class="section pt-5 pb-5">
	<FORM action="." id="search_site_form" method="GET">
		<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>
		<div class="container p-4">
			<div class="row">
				<div class="col-12 col-md-7">
					<h2 class="mb-3">
						<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
					</h2>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-text">
								<svg class="icon icon-sm" aria-hidden="true">
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search' ); ?>"></use>
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
								<button class="btn btn-primary" type="submit" id="submit_form">
									<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
								</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</FORM>
</section>


<!-- ELENCO RISULTATI -->
<section class="section section-muted pt-5 pb-5">
	<div class="container p-4 pb-0">
		<div class="col-12">

			<!-- Dynamic filters -->
			<?php
			if ( ( $num_results > 0 ) ) {
			?>
			<fieldset>
				<legend class="px-0"><?php echo esc_html( __( 'Filter by', 'design_ict_site' ) ); ?>:</legend>
				<form class="px-0" style="margin-left: -4px;">
					<div class="form-check form-check-inline"><input class="" id="faq" type="checkbox"><label for="faq"
							class="form-check-label">Tipo di contenuto 1</label></div>
					<div class="form-check form-check-inline"><input class="" id="resource" type="checkbox"><label
							for="resource" class="form-check-label">Tipo di contenuto 2</label></div>
				</form>
			</fieldset>
			<?php
			}
			?>

			<?php if ( $search_string ) : ?>
			<p class="fw-bold mt-5 mb-3" role="status" aria-live="polite">
				<?php echo esc_attr( $result_message ); ?>
			</p>
			<?php endif ?>

			<!-- SEARCH RESULTS LIST -->
			<?php
			if ( ( $num_results > 0 ) ) {
			?>
			<div class="link-list-wrapper multiline">
				<ul class="link-list">
					<?php
					// The main loop of the page.
					$post_index = 0;
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						$wrapper       = DIS_ContentsManager::wrap_search_result( $post );
						$wrapper_title = esc_attr( $wrapper->title );
						$marked_title  = DIS_ContentsManager::add_mark_to_text( $wrapper_title, $search_string );
						$wrapper_text  = wp_trim_words( $wrapper->description, DIS_ACF_SHORT_DESC_LENGTH );
						$marked_text   = DIS_ContentsManager::add_mark_to_text( $wrapper_text, $search_string );
					?>
					<li>
						<a class="list-item icon-right" href="<?php echo esc_url( $wrapper->link ); ?>">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">
									<?php echo wp_kses_post( $marked_title ); ?>
								</h4>
								<svg class="icon icon-primary">
									<title><?php echo esc_html( __( 'Code', 'design_ict_site' ) ); ?></title>
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
								</svg>
							</span>
							<p class="text-muted">
								<?php echo wp_kses_post( $marked_text ); ?>
							</p>
							<p>
								<?php echo esc_attr( $wrapper->type ); ?>
							</p>
						</a>
					</li>
						<li>
							<span class="divider" role="separator"></span>
						</li>
					<?php
						$post_index++;
					}
					wp_reset_postdata();
					?>
				</ul>
			</div> <!-- result list -->

			<!-- Results PAGINATION-->
			<?php
				get_template_part(
					'template-parts/common/pagination',
					null,
					array(
						'query'           => $the_query,
						'posts_per_page'  => $posts_per_page,
						'per_page_values' => $per_page_values,
						'num_results'     => $num_results,
						'current_page'    => $current_page,
					)
				);
			?>

			<?php
			}
			?>

		</div>
	</div>
	</div>
</section>

<!-- CALL TO ACTION CONTACT HELPDESK -->
<?php get_template_part( 'template-parts/common/help-desk-call-to-action' ); ?>

<?php
get_footer();
