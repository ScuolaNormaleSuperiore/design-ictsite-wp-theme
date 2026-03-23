<?php
/**
 * Template Name: Search
 *
 * @package Design_ICT_Site
 */

get_header();

$dis_search_string     = '';
$dis_all_content_types = DIS_ContentsManager::get_content_types_with_results();
$dis_default_ct_list   = array_column( $dis_all_content_types, 'slug' );
$dis_num_results       = 0;
$dis_query             = null;

// Check pagination parameters.
$dis_posts_per_page  = strval( DIS_ITEMS_PER_PAGE_EVEN );
$dis_per_page_values = DIS_ITEMS_PER_PAGE_VALUES_EVEN;
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
	$dis_posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );
}
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive pagination parameter.
$dis_current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Set and format the filters for the query.
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive filter parameter.
if ( isset( $_GET['isreset'] ) && 'yes' === sanitize_text_field( wp_unslash( $_GET['isreset'] ) ) ) {
	$dis_selected_contents = $dis_default_ct_list;
	$dis_search_string     = '';
	$dis_searchable_ct     = $dis_default_ct_list;
} else {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Search filters are read-only and final query is nonce-gated below.
	if ( isset( $_GET['selected_contents'] ) ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended,WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Search filters are read-only and sanitized below.
		$dis_raw = wp_unslash( $_GET['selected_contents'] );
		if ( is_array( $dis_raw ) ) {
			$dis_selected_contents = array_map( 'sanitize_text_field', $dis_raw );
		} else {
			$dis_selected_contents = array( sanitize_text_field( $dis_raw ) );
		}
		$dis_searchable_ct = $dis_selected_contents;
	} else {
		$dis_selected_contents = array();
		$dis_searchable_ct     = $dis_default_ct_list;
	}

	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Search input is additionally guarded by nonce verification below.
	if ( isset( $_GET['search_string'] ) ) {
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Search input is additionally guarded by nonce verification below.
		$dis_search_string = sanitize_text_field( wp_unslash( $_GET['search_string'] ) );
	}
}

$dis_results_ct = array();
if (
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Explicit nonce validation follows immediately.
	isset( $_GET['site_search_nonce_field'] ) &&
	wp_verify_nonce(
		// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Nonce is validated by wp_verify_nonce().
		sanitize_text_field( wp_unslash( $_GET['site_search_nonce_field'] ) ),
		'sf_site_search_nonce'
	)
	) {
	if ( '' !== $dis_search_string ) {
		$dis_query       = DIS_ContentsManager::get_site_search_query(
			$dis_searchable_ct,
			$dis_search_string,
			$dis_posts_per_page
		);
		$dis_num_results = $dis_query->found_posts;
	}

	$dis_results_ct = DIS_ContentsManager::get_results_post_types(
		$dis_default_ct_list,
		$dis_search_string
	);
}

$dis_result_message_1 = __( 'You need to enter some text in the search box.', 'design_ict_site' );
$dis_result_message_2 = sprintf(
	/* translators: 1: number of results, 2: search string. */
	__( 'Found %1$s results for "%2$s".', 'design_ict_site' ),
	$dis_num_results,
	$dis_search_string
);
$dis_search_autocomplete = DIS_OptionsManager::dis_get_option( 'site_search_autocomplete_enabled', 'dis_opt_hp_layout' );
?>

<form action="." id="main_search_form" method="get">
	<?php wp_nonce_field( 'sf_site_search_nonce', 'site_search_nonce_field' ); ?>

	<!-- SEARCH BOX -->
	<section class="section pt-5 pb-5">
		<div class="container p-4">
			<div class="row">
				<div class="col-12 col-md-7">
					<h2 class="mb-3">
						<?php echo esc_html__( 'Search', 'design_ict_site' ); ?>
					</h2>
					<?php if ( 'true' === $dis_search_autocomplete ) : ?>
						<div id="home_search_wrapper" style="display: flex; gap: 6px;">
							<div id="home_search_autocomplete" style="flex: 1;"></div>
							<input type="hidden"
								id="search_string"
								name="search_string"
								class="form-control"
								value="<?php echo esc_attr( $dis_search_string ); ?>"
							>
							<button class="btn btn-primary" type="submit" id="submit_form">
								<?php echo esc_html__( 'Search', 'design_ict_site' ); ?>
							</button>
						</div>
					<?php else : ?>
						<div class="form-group">
							<div class="input-group">
								<span class="input-group-text">
									<svg class="icon icon-sm" aria-hidden="true">
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search' ); ?>"></use>
									</svg>
								</span>
								<label for="search_string">
									<?php echo esc_html__( 'Search the site', 'design_ict_site' ); ?>
								</label>
								<input type="text"
									id="search_string"
									name="search_string"
									class="form-control"
									value="<?php echo esc_attr( $dis_search_string ); ?>"
								>
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit" id="submit_form">
										<?php echo esc_html__( 'Search', 'design_ict_site' ); ?>
									</button>
								</div>
							</div>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</section>

	<!-- LIST OF RESULTS -->
	<section class="section section-muted pt-5 pb-5">
		<div class="container p-4 pb-0">
			<div class="col-12">

				<!-- Dynamic filters -->
				<?php if ( $dis_num_results > 0 ) : ?>
					<fieldset>
						<legend class="px-0"><?php echo esc_html__( 'Filter by', 'design_ict_site' ); ?>:</legend>
						<?php foreach ( $dis_results_ct as $dis_content_type ) : ?>
							<?php $dis_checked = ( count( $dis_selected_contents ) > 0 && in_array( $dis_content_type['slug'], $dis_selected_contents, true ) ) ? 'checked' : ''; ?>
							<div class="form-check form-check-inline">
								<input id="<?php echo esc_attr( $dis_content_type['slug'] ); ?>"
									type="checkbox"
									name="selected_contents[]"
									value="<?php echo esc_attr( $dis_content_type['slug'] ); ?>"
									<?php echo $dis_checked ? 'checked' : ''; ?>
								>
								<label for="<?php echo esc_attr( $dis_content_type['slug'] ); ?>">
									<?php echo esc_html( $dis_content_type['name'] ); ?>
								</label>
							</div>
						<?php endforeach; ?>
					</fieldset>
				<?php endif; ?>

				<!-- Result message -->
				<p class="fw-bold mt-5 mb-3" role="status" aria-live="polite">
					<?php if ( $dis_search_string ) : ?>
						<?php echo esc_html( $dis_result_message_2 ); ?>
					<?php else : ?>
						<?php echo esc_html( $dis_result_message_1 ); ?>
					<?php endif; ?>
				</p>

				<!-- SEARCH RESULTS LIST -->
				<?php if ( $dis_num_results > 0 && $dis_query ) : ?>
					<div class="link-list-wrapper multiline">
						<ul class="link-list">
							<?php
							while ( $dis_query->have_posts() ) {
								$dis_query->the_post();
								$dis_post         = get_post();
								$dis_wrapper      = DIS_ContentsManager::wrap_search_result( $dis_post );
								$dis_marked_title = DIS_ContentsManager::add_mark_to_text( $dis_wrapper->title, $dis_search_string );
								$dis_wrapper_text = wp_trim_words( $dis_wrapper->description, DIS_ACF_SHORT_DESC_LENGTH );
								$dis_marked_text  = DIS_ContentsManager::add_mark_to_text( $dis_wrapper_text, $dis_search_string );
								?>
								<li>
									<a class="list-item icon-right" href="<?php echo esc_url( $dis_wrapper->link ); ?>">
										<span class="list-item-title-icon-wrapper">
											<h4 class="list-item-title">
												<?php echo wp_kses_post( $dis_marked_title ); ?>
											</h4>
											<svg class="icon icon-primary">
												<title><?php echo esc_html__( 'Code', 'design_ict_site' ); ?></title>
												<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
											</svg>
										</span>
										<p class="text-muted">
											<?php echo wp_kses_post( $dis_marked_text ); ?>
										</p>
										<p>
											<?php echo esc_html( $dis_wrapper->type ); ?>
										</p>
									</a>
								</li>
								<li>
									<span class="divider" role="separator"></span>
								</li>
								<?php
							}
							wp_reset_postdata();
							?>
						</ul>
					</div>

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
				<?php endif; ?>

			</div>
		</div>
	</section>
</form>

<?php get_template_part( 'template-parts/common/help-desk-call-to-action' ); ?>

<script>
document.addEventListener('DOMContentLoaded', function () {
	const form = document.getElementById('main_search_form');
	if (!form) return;
	const checkboxes = form.querySelectorAll('input[name="selected_contents[]"]');
	checkboxes.forEach((cb) => {
		cb.addEventListener('change', () => {
			form.submit();
		});
	});
});
</script>

<?php
get_footer();
