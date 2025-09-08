<?php
/** Template Name: Documentation
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

// Check pagination parameters.
$posts_per_page  = strval( DIS_ITEMS_PER_PAGE_ODD );
$per_page_values = DIS_ITEMS_PER_PAGE_VALUES_ODD;
if ( isset( $_GET['posts_per_page'] ) && is_numeric( $_GET['posts_per_page'] ) ) {
	$posts_per_page = sanitize_text_field( wp_unslash( $_GET['posts_per_page'] ) );
}
$current_page = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Prepare the query.
$params = array(
	'post_type'      => DIS_ATTACHMENT_POST_TYPE,
	'search_string'  => '',
	'posts_per_page' => $posts_per_page,
	'current_page'   => $current_page,
	'orderby'        => 'title',
	'order'          => 'DESC',
);

// Add search string, if present.
if ( isset( $_GET['search_string'] ) ) {
	$params['search_string'] = sanitize_text_field( wp_unslash( $_GET['search_string'] ) );
	$search_string           = $params['search_string'];
	$is_submission = true;
} else {
	$search_string = '';
	$is_submission = false;
}

// Execute the query.
$the_query      = DIS_ContentsManager::get_generic_post_query( $params );
$num_results    = $the_query->found_posts;
$current_url    = get_permalink();
$result_message = sprintf( __( 'Found %s results.', 'design_ict_site' ), $num_results );
// Check if autocomplete is enabled.
$doc_autocomplete = DIS_OptionsManager::dis_get_option( 'doc_autocomplete_enabled', 'dis_opt_hp_layout' );
?>


<!-- DOCUMENTATION SEARCH -->
<FORM action="." id="main_search_form" method="GET">
	<?php wp_nonce_field( 'sf_doc_search_nonce', 'doc_search_nonce_field' ); ?>

	<section class="section pt-0 pb-10" >
		<div class="container p-4">
			<div class="row">
				<div class="col-12 col-md-7">
					<h2 class="mb-3">
						<?php echo esc_attr( __( 'Documentation', 'design_ict_site' ) ); ?>
					</h2>
					<?php if ( $doc_autocomplete === 'true' ) : ?>
						<!-- Search with autocomplete -->
						<div id="doc_search_wrapper" style="display: flex; gap: 6px;">
							<div id="doc_search_autocomplete" style="flex: 1;"></div>
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
									<?php echo esc_html( __( 'Search the documentation', 'design_ict_site' ) ); ?>
								</label>
								<input type="text"
									id="search_string"
									name="search_string"
									class="form-control"
									value="<?php echo esc_attr( $search_string ?? '' ); ?>"
								>
								<div class="input-group-append">
									<button class="btn btn-primary" type="submit" id="submit_form">
										<?php echo esc_html( __( 'Search', 'design_ict_site' ) ); ?>
									</button>
								</div>
							</div>
						</div>
					<?php endif ?>

				</div> <!-- col -->
			</div> <!-- row -->
		</div> <!-- container -->
	</section>
</FORM>

	<!-- LIST OF RESULTS -->
	<section class="section section-muted pt-5 pb-5">

		<div class="container p-4 pb-0">

		<!-- ELENCO DELLA DOCUMENTAZIONE RISULTATI  -->
		<p class="fw-bold " role="status" aria-live="polite">3 Risultati per "stringa cercata"</p>

			<div class="link-list-wrapper multiline">
				<ul class="link-list">
					<li>
						<a class="list-item active icon-right" href="#">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">Manuale di istruzioni (PDF)</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-file"></use>
								</svg>
							</span>
							<p>
								Lorem ipsum dolor sit amet, consectetur adipiscing elit… Lorem ipsum dolor sit amet, consectetur
								adipiscing elit… Lorem ipsum dolor sit amet, consectetur adipiscing elit…
							</p>
						</a>
					</li>
					<li>
						<span class="divider" role="separator"></span>
					</li>
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
	
		</div> <!-- container -->
	</section>


<!-- CALL TO ACTION CONTACT HELPDESK -->
<?php get_template_part( 'template-parts/common/help-desk-call-to-action' ); ?>


<?php
get_footer();
