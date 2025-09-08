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
$num_results       = 0;
$the_query         = null;

// Check pagination parameters.
$posts_per_page  = strval( DIS_ITEMS_PER_PAGE_EVEN );
$per_page_values = DIS_ITEMS_PER_PAGE_VALUES_EVEN;
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	$posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );
}
$current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Set and format the filters for the query.
if ( isset( $_GET['isreset'] ) && ( sanitize_text_field( wp_unslash( $_GET['isreset'] ) ) === 'yes' ) ) {
	$selected_contents = $default_ct_list;
	$search_string     = '';
} else {
	// Retrieve and clean selected_contents.
	if ( isset( $_GET['selected_contents'] ) ) {
		$raw = wp_unslash( $_GET['selected_contents'] );
		if ( is_array( $raw ) ) {
			$selected_contents = array_map( 'sanitize_text_field', $raw );
		} else {
			$selected_contents = [ sanitize_text_field( $raw ) ];
		}
		$searchable_ct = $selected_contents;
	} else {
		$selected_contents = array();
		$searchable_ct     = $default_ct_list;
	}
	if ( ! is_array( $selected_contents ) ) {
		$selected_contents = array();
	}

	// Retrieve and clean search_string.
	if ( isset( $_GET['search_string'] ) ) {
		$search_string = sanitize_text_field( wp_unslash( $_GET['search_string'] ) );
	} else {
		$search_string = '';
	}
}

// The post type of the results.
$results_ct = array();
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

	// Execute another query to retrieve all the post_types including the unselected ones.
	$results_ct = DIS_ContentsManager::get_results_post_types(
		$default_ct_list,
		$search_string,
	);
}
$result_message_1 = sprintf( __( 'Found %s results.', 'design_ict_site' ), $num_results );
$result_message_2 = sprintf( __( 'Found %1$s results for "%2$s".', 'design_ict_site' ), $num_results, $search_string );
// Check if autocompletion is enabled.
$search_autocomplete = DIS_OptionsManager::dis_get_option( 'site_search_autocomplete_enabled', 'dis_opt_hp_layout' );
?>



<FORM action="." id="main_search_form" method="GET">
<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>

	<!-- SEARCH BOX -->
	<section class="section pt-5 pb-5">		
		<div class="container p-4">
			<div class="row">
				<div class="col-12 col-md-7">
					<h2 class="mb-3">
						<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
					</h2>
					<?php if ( $search_autocomplete == 'true' ) : ?>
						<!-- Search with autocomplete -->
						<div id="home_search_wrapper" style="display: flex; gap: 6px;">
							<div id="home_search_autocomplete" style="flex: 1;"></div>
							<input type="hidden"
								id="search_string"
								name="search_string"
								class="form-control"
								value="<?php echo esc_attr( $search_string ?? '' ); ?>"
							>
							<button class="btn btn-primary" type="submit" id="submit_form">
								<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
							</button>
						</div>
					<?php else : ?>
						<!-- Simple search -->
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
					<?php endif ?>
				</div>
			</div>
		</div>
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
					<?php
					foreach ( $results_ct as $ct ) {
						$checked = ( count( $selected_contents ) > 0 && in_array( $ct['slug'], $selected_contents) ) ? 'checked' : '';
					?>
						<div class="form-check form-check-inline">
							<input id="<?php echo esc_attr( $ct['slug'] ); ?>"
								type="checkbox"
								name="selected_contents[]"
								value="<?php echo esc_attr( $ct['slug'] ); ?>"
								<?php if ( $checked ) echo esc_attr( $checked ); ?>
							>
							<label for="<?php echo esc_attr( $ct['slug'] ); ?>">
								<?php echo esc_attr( $ct['name'] ); ?>
							</label>
						</div>
					<?php
					}
					?>
				</fieldset>
				<?php
				}
				?>

				
				<p class="fw-bold mt-5 mb-3" role="status" aria-live="polite">
					<?php if ( $search_string ) : ?>
						<?php echo esc_attr( $result_message_2 ); ?>
					<?php else: ?>
						<?php echo esc_attr( $result_message_1 ); ?>
					<?php endif ?>
				</p>
				

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

</FORM>

<!-- CALL TO ACTION CONTACT HELPDESK -->
<?php get_template_part( 'template-parts/common/help-desk-call-to-action' ); ?>

<!-- Automatic reload of the search -->
<script>
document.addEventListener("DOMContentLoaded", function () {
	const form = document.getElementById("main_search_form");
	if (!form) return;
	const checkboxes = form.querySelectorAll('input[name="selected_contents[]"]');
	checkboxes.forEach(cb => {
		cb.addEventListener("change", () => {
			form.submit();
		});
	});
});
</script>

<?php
get_footer();
