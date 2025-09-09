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
// Check if autocomplete is enabled.
$doc_autocomplete = DIS_OptionsManager::dis_get_option( 'doc_autocomplete_enabled', 'dis_opt_hp_layout' );
// Result messages.
$result_message_1 = sprintf( __( 'No results found', 'design_ict_site' ), $num_results );
$result_message_2 = sprintf( __( 'Found %1$s results for "%2$s".', 'design_ict_site' ), $num_results, $search_string );
$result_message_3 = sprintf( __( 'Found %s results.', 'design_ict_site' ), $num_results );
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

			<!-- Result message -->
			<p class="fw-bold " role="status" aria-live="polite">
				<?php if ( $num_results ) : ?>
					<?php if ( $search_string ) : ?>
						<?php echo esc_attr( $result_message_2 ); ?>
					<?php else: ?>
						<?php echo esc_attr( $result_message_3 ); ?>
					<?php endif ?>
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
						$attachment_file    = DIS_CustomFieldsManager::get_field( 'file', $post->ID );
						$attachment_link    = DIS_CustomFieldsManager::get_field( 'link', $post->ID );
						$documentation_link = $attachment_file ? $attachment_file['url'] : $attachment_link;
						$document_title     = esc_attr( $post->post_title );
						$marked_title       = DIS_ContentsManager::add_mark_to_text( $document_title, $search_string );
						$description        = DIS_ContentsManager::clean_and_truncate_text( $post->post_content, DIS_ACF_SHORT_TEXT_LENGTH );
						$marked_text        = DIS_ContentsManager::add_mark_to_text( $description , $search_string );
					?>
						<li>
							<a class="list-item active icon-right" href="<?php echo esc_url( $documentation_link ); ?>">
								<span class="list-item-title-icon-wrapper">
									<h4 class="list-item-title">
										<?php echo wp_kses_post( $marked_title ); ?>
									</h4>
									<svg class="icon icon-primary">
										<title>Codice</title>
										<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-file' ); ?>"></use>
									</svg>
								</span>
								<p>
									<?php echo wp_kses_post( $marked_text ); ?>
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
