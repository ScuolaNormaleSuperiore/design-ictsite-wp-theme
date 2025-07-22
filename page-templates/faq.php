<?php
/** Template Name: Faq
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

// Get default values.
$all_topics       = get_terms(
	array(
		'taxonomy'   => DIS_FAQ_TOPIC_TAXONOMY,
		'hide_empty' => true,
	)
);
$default_topic_list = array_column( $all_topics, 'slug' );

// // Check and sanitize parameters.
// if ( isset( $_GET['selected_topics'] ) && is_array( $_GET['selected_topics'] ) ) {
// 	$selected_topics = array_map( 'sanitize_text_field', wp_unslash( $_GET['selected_topics'] ) );
// } else {
// 	$selected_topics = array();
// }

// $params = array();
// // Add category filter, if selected.
// if ( count( $selected_topics ) > 0 ) {
// 	$params['taxonomy'] = DIS_FAQ_TOPIC_TAXONOMY;
// 	$params['terms']   = $selected_topics;
// } else {
// 	$params['taxonomy'] = '';
// 	$params['terms']   = array();
// }

// Add search string, if present.
if ( isset( $_GET['search_string'] ) ) {
	$params['search_string'] = sanitize_text_field( $_GET['search_string'] );
	$search_string           = $params['search_string'];
	$is_submission = true;
} else {
	$search_string = '';
	$is_submission = false;
}

// $items              = DIS_ContentsManager::get_generic_post_list( DIS_FAQ_POST_TYPE, 'title', $params );
$items              = DIS_ContentsManager::get_generic_post_list( DIS_FAQ_POST_TYPE, 'title' );
$items_per_category = DIS_ContentsManager::items_per_category( $items, DIS_FAQ_TOPIC_TAXONOMY );
$current_url        = get_permalink();
$result_message     = sprintf( __( 'Found %s results.', 'design_ict_site' ), count( $items ) );
?>

<!-- FAQ PAGE -->
<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">

		<div class="col">
			<!-- Title -->
			<h2 class="pb-2">
				<?php echo esc_attr( get_the_title() ); ?>
			</h2>

			<!-- FAQ Accordions -->
			<div class="accordion" id="FaqAccordion">

				<!-- ARGUMENT LIST -->
				<?php
				$tpc_index = 0;
				foreach ( $items_per_category as $category => $faq_list ) {
					$sanitized_cat = sanitize_title( $category );
					// Loading the page open the first accordion.
					$tpc_show      = ( $tpc_index === 0 ) ? 'show' : ' ';
					$tpc_collapsed = ( $tpc_index === 0 ) ? ' ' : 'collapsed';
					$tpc_expanded  = ( $tpc_index === 0 ) ? 'true' : 'false';
					$tpc_term      = get_term_by( 'name', $category, DIS_FAQ_TOPIC_TAXONOMY ) ?? null;
					$tpc_slug      = $tpc_term ? $tpc_term->slug : '';
				?>
				<div class="accordion-item" id="<?php echo esc_attr( $tpc_slug ); ?>">
					<h3 class="accordion-header " id="<?php echo 'heading' . $tpc_index . 'a'; ?>">
						<button
							class="accordion-button <?php echo $tpc_collapsed; ?>"
							type="button"
							data-bs-toggle="collapse"
							data-bs-target="<?php echo '#collapse' . $tpc_index . 'a'; ?>"
							aria-expanded="<?php echo $tpc_expanded; ?>"
							aria-controls="<?php echo 'collapse' . $tpc_index . 'a'; ?>">
							<?php echo esc_attr( $category ); ?>
						</button>
					</h3>

					<!-- FAQ LIST -->
					<div id="<?php echo 'collapse' . $tpc_index . 'a'; ?>"
						class="accordion-collapse collapse <?php echo $tpc_show; ?>"
						data-bs-parent="#accordionExample2"
						role="region"
						aria-labelledby="<?php echo 'heading' . $tpc_index . 'a'; ?>">
						<div class="accordion-body">
							<div class="accordion" id="accordionExample2N">

								<!-- FAQ ITEM -->
								<?php
								$faq_index = 0;
								foreach ( $faq_list as $faq ) {
									$faq_show      = ( $faq_index === 0 ) ? 'show' : ' ';
									$faq_collapsed = ( $faq_index === 0 ) ? ' ' : 'collapsed';
									$faq_expanded  = ( $faq_index === 0 ) ? 'true' : 'false';
								?>
								<div class="accordion-item">
									<h4 class="accordion-header " id="<?php echo 'heading' . $faq_index . 'n'; ?>">
										<button class="accordion-button <?php echo $faq_collapsed; ?>"
											type="button"
											data-bs-toggle="collapse"
											data-bs-target="<?php echo '#collapse' . $faq_index . 'n'; ?>"
											aria-expanded="<?php echo $faq_expanded; ?>"
											aria-controls="<?php echo 'collapse' . $faq_index . 'n'; ?>"
										>
											<?php echo esc_attr( $faq->post_title ) ?>
										</button>
									</h4>
									<div id="<?php echo 'collapse' . $faq_index . 'n' ?>"
										class="accordion-collapse collapse <?php echo $faq_show; ?>"
										data-bs-parent="#accordionExample2N"
										role="region"
										aria-labelledby="<?php echo 'heading' . $faq_index . 'n'; ?>">
										<div class="accordion-body">
											<?php echo wp_kses_post( $faq->post_content ); ?>
										</div>
									</div>
								</div>
								<?php
								$faq_index++;
								}
								?>

							</div>
						</div>
					</div>

				</div>
				<?php
					$tpc_index++;
				}
				?>

			</div>
		</div>

		<!-- SIDEBAR ELENCO -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				
				<div class="form-group">
					<FORM action="." id="search_faq_form" method="GET">
						<div class="input-group">
							<span class="input-group-text"><svg class="icon icon-sm" aria-hidden="true">
									<use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
								</svg></span>
							<label for="search_string">
								<?php echo esc_attr( __( 'Search the FAQ', 'design_ict_site' ) ); ?>
							</label>
							<input type="text"
								id="search_string"
								name="search_string"
								class="form-control"
								value="<?php echo esc_attr( $search_string ?? '' ); ?>"
								placeholder="<?php echo esc_html( __( 'Digit the text to search', 'design_ict_site' ) ); ?>"
							>
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit" value="submit">
									<?php echo esc_attr( __( 'Search', 'design_ict_site' ) ); ?>
								</button>
							</div>
						</div>
					</FORM>
				</div> <!-- form-group -->

				<!-- RESET FORM -->
				<?php if ( $is_submission ) : ?>
					<div class="link-list-wrapper">
						<ul class="link-list">
							<li>
								<h3 class="visually-hidden">
									<?php echo esc_attr( __( 'Back to the full list', 'design_ict_site' ) ); ?>
								</h3>
							</li>
							<li>
								<a class="list-item medium active" href="<?php echo esc_url ( $current_url ); ?>">
									<span>
										<?php echo esc_attr( __( 'Back to the full list', 'design_ict_site' ) ); ?>
									</span>
								</a>
							</li>
						</ul>
					</div>
				<?php endif ?>

				<div class="sidebar-linklist-wrapper">
					<div class="link-list-wrapper">
						<!-- TOPICS -->
						<ul class="link-list">
							<li>
								<h3>
									<?php echo esc_attr( __( 'Browse by topic', 'design_ict_site' ) ); ?>
								</h3>
							</li>
							<?php
							$page_link  = DIS_MultiLangManager::get_page_link( FAQ_PAGE_SLUG );
							foreach ( $all_topics as $tp ) {
								// $active = in_array( $tp->slug, $selected_topics ) ? 'active' : '';
								$active = '';
							?>
							<li>
								<a class="list-item medium <?php echo $active; ?>" href="<?php echo esc_url( $page_link . '#' .  $tp->slug ); ?>">
									<span><?php echo esc_attr( $tp->name ); ?></span>
								</a>
							</li>
							<?php
							}
							?>
						</ul>
					</div>
				</div>

			</div>
		</div>

	</div>
</div>

<?php
get_footer();
