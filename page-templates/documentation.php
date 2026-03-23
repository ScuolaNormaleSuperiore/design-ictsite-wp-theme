<?php
/**
 * Template Name: Documentation
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
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Read-only archive pagination parameter.
$dis_current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Prepare the query.
$dis_params = array(
	'post_type'      => DIS_ATTACHMENT_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $dis_posts_per_page,
	'current_page'   => $dis_current_page,
	'orderby'        => 'title',
	'order'          => 'DESC',
);

// Add search string, if present.
// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Search input is additionally guarded by nonce verification below.
if ( isset( $_GET['search_string'] ) ) {
	// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Search input is additionally guarded by nonce verification below.
	$dis_params['search_string'] = sanitize_text_field( wp_unslash( $_GET['search_string'] ) );
	$dis_search_string           = $dis_params['search_string'];
} else {
	$dis_search_string = '';
}

// Execute the query if the nonce is valid.
if (
	'' === $dis_search_string ||
	(
		// phpcs:ignore WordPress.Security.NonceVerification.Recommended -- Explicit nonce validation follows immediately.
		isset( $_GET['doc_search_nonce_field'] ) &&
		wp_verify_nonce(
			// phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized -- Nonce is validated by wp_verify_nonce().
			sanitize_text_field( wp_unslash( $_GET['doc_search_nonce_field'] ) ),
			'sf_doc_search_nonce'
		)
	)
) {
	$dis_query       = DIS_ContentsManager::get_generic_post_query( $dis_params );
	$dis_num_results = $dis_query->found_posts;
} else {
	$dis_query       = null;
	$dis_num_results = 0;
}

$dis_doc_autocomplete = DIS_OptionsManager::dis_get_option( 'doc_autocomplete_enabled', 'dis_opt_hp_layout' );
$dis_result_message_1 = __( 'No results found', 'design_ict_site' );
$dis_result_message_2 = sprintf(
	/* translators: 1: number of results, 2: search string. */
	__( 'Found %1$s results for "%2$s".', 'design_ict_site' ),
	$dis_num_results,
	$dis_search_string
);
$dis_result_message_3 = sprintf(
	/* translators: %s: number of results. */
	__( 'Found %s results.', 'design_ict_site' ),
	$dis_num_results
);
?>

<!-- DOCUMENTATION SEARCH -->
<form action="." id="doc_search_form" method="get">
	<?php wp_nonce_field( 'sf_doc_search_nonce', 'doc_search_nonce_field' ); ?>

	<!-- SEARCH BOX -->
	<section class="section pt-0 pb-10">
		<div class="container p-4">
			<div class="row">
				<div class="col-12 col-md-7">
					<h2 class="mb-3">
						<?php echo esc_html__( 'Documentation', 'design_ict_site' ); ?>
					</h2>
					<?php if ( 'true' === $dis_doc_autocomplete ) : ?>
						<div id="doc_search_wrapper" style="display: flex; gap: 6px;">
							<div id="doc_search_autocomplete" style="flex: 1;"></div>
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
									<?php echo esc_html__( 'Search the documentation', 'design_ict_site' ); ?>
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
</form>

<!-- LIST OF RESULTS -->
<section class="section section-muted pt-5 pb-5">
	<div class="container p-4 pb-0">

		<!-- Result message -->
		<p class="fw-bold" role="status" aria-live="polite">
			<?php if ( $dis_num_results ) : ?>
				<?php if ( $dis_search_string ) : ?>
					<?php echo esc_html( $dis_result_message_2 ); ?>
				<?php else : ?>
					<?php echo esc_html( $dis_result_message_3 ); ?>
				<?php endif; ?>
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
						$dis_post               = get_post();
						$dis_attachment_file    = DIS_CustomFieldsManager::get_field( 'file', $dis_post->ID );
						$dis_attachment_link    = DIS_CustomFieldsManager::get_field( 'link', $dis_post->ID );
						$dis_documentation_link = $dis_attachment_file ? $dis_attachment_file['url'] : $dis_attachment_link;
						$dis_marked_title       = DIS_ContentsManager::add_mark_to_text( $dis_post->post_title, $dis_search_string );
						$dis_description        = DIS_ContentsManager::clean_and_truncate_text( $dis_post->post_content, DIS_ACF_SHORT_TEXT_LENGTH );
						$dis_marked_text        = DIS_ContentsManager::add_mark_to_text( $dis_description, $dis_search_string );
						?>
						<li>
							<a class="list-item active icon-right" href="<?php echo esc_url( $dis_documentation_link ); ?>">
								<span class="list-item-title-icon-wrapper">
									<h4 class="list-item-title">
										<?php echo wp_kses_post( $dis_marked_title ); ?>
									</h4>
									<svg class="icon icon-primary">
										<title><?php echo esc_html__( 'Document', 'design_ict_site' ); ?></title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-file' ); ?>"></use>
									</svg>
								</span>
								<p>
									<?php echo wp_kses_post( $dis_marked_text ); ?>
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
		<?php endif; ?>

		<!-- Results PAGINATION-->
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
	</div>
</section>

<?php get_template_part( 'template-parts/common/help-desk-call-to-action' ); ?>

<?php
get_footer();
