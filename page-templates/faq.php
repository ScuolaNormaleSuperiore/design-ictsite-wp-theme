<?php
/**
 * Template Name: Faq
 *
 * @package Design_ICT_Site
 */

get_header();

// Get all the FAQ topics.
$dis_all_topics = get_terms(
	array(
		'taxonomy'   => DIS_FAQ_TOPIC_TAXONOMY,
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);
// Get the FAQs.
$dis_faq_autocomplete = DIS_OptionsManager::dis_get_option( 'faq_autocomplete_enabled', 'dis_opt_hp_layout' );
$dis_items            = DIS_ContentsManager::get_top_faqs( 6 );

// Check pagination parameters.
$dis_posts_per_page  = strval( DIS_ITEMS_PER_PAGE_ODD );
$dis_per_page_values = DIS_ITEMS_PER_PAGE_VALUES_ODD;
$dis_posts_per_page  = DIS_ContentsManager::get_validated_per_page( $dis_per_page_values, $dis_posts_per_page );
$dis_current_page    = isset( $_GET['num_page'] ) ? max( 1, intval( sanitize_text_field( wp_unslash( $_GET['num_page'] ) ) ) ) : 1;

// Read the submitted search string, if any.
$dis_search_string = isset( $_GET['search_string'] )
	? sanitize_text_field( wp_unslash( $_GET['search_string'] ) )
	: '';

// Run the search only for a non-empty query submitted through the FAQ search form.
$dis_search_active = (
	'' !== $dis_search_string &&
	isset( $_GET['faq_search_nonce_field'] ) &&
	wp_verify_nonce(
		sanitize_text_field( wp_unslash( $_GET['faq_search_nonce_field'] ) ),
		'sf_faq_search_nonce'
	)
);

$dis_query       = null;
$dis_num_results = 0;
if ( $dis_search_active ) {
	$dis_query       = DIS_ContentsManager::get_generic_post_query(
		array(
			'post_type'      => DIS_FAQ_POST_TYPE,
			'search_string'  => $dis_search_string,
			'posts_per_page' => $dis_posts_per_page,
			'current_page'   => $dis_current_page,
			'orderby'        => 'title',
			'order'          => 'ASC',
		)
	);
	$dis_num_results = $dis_query->found_posts;
}

$dis_no_results_message = __( 'No results found', 'design_ict_site' );
$dis_results_message    = sprintf(
	/* translators: 1: number of results, 2: search string. */
	__( 'Found %1$s results for "%2$s".', 'design_ict_site' ),
	$dis_num_results,
	$dis_search_string
);
?>

<!-- FAQ PAGE -->
<section class="section pt-0 pb-5" >
	<div class="container p-4">
		<h2 class="pb-2">
			<?php echo esc_attr( get_the_title() ); ?>
		</h2>
		<p class="lead">
			<?php echo esc_html( get_the_excerpt() ); ?>
		</p>
	</div> <!-- container -->
</section>

<!-- FAQ SEARCH -->
<?php if ( 'true' === $dis_faq_autocomplete ) : ?>
	<form action="." id="faq_search_form" method="get">
		<?php wp_nonce_field( 'sf_faq_search_nonce', 'faq_search_nonce_field' ); ?>
		<section class="section pt-0 pb-10" >
			<div class="container p-4">
				<div class="row">
					<div class="col-12 col-md-7">
						<h3 class="mb-3">
							<?php echo esc_attr( __( 'Search the FAQs', 'design_ict_site' ) ); ?>
						</h3>
						<div id="faq_search_wrapper" style="display: flex; gap: 6px;">
							<div id="faq_search_autocomplete" style="flex: 1;"></div>
							<input type="hidden"
								id="search_string"
								name="search_string"
								value="<?php echo esc_attr( $dis_search_string ); ?>"
							>
							<button class="btn btn-primary" type="submit" id="submit_form">
								<?php echo esc_html__( 'Search', 'design_ict_site' ); ?>
							</button>
						</div>
					</div> <!-- col -->
				</div> <!-- row -->
			</div> <!-- container -->
		</section>
	</form>
<?php endif ?>

<!-- FAQ SEARCH RESULTS -->
<?php if ( $dis_search_active ) : ?>
	<section class="section section-muted pt-5 pb-5">
		<div class="container p-4 pb-0">

			<!-- Result message -->
			<p class="fw-bold" role="status" aria-live="polite">
				<?php echo esc_html( $dis_num_results > 0 ? $dis_results_message : $dis_no_results_message ); ?>
			</p>

			<!-- SEARCH RESULTS LIST -->
			<?php if ( $dis_num_results > 0 && $dis_query ) : ?>
				<div class="link-list-wrapper multiline">
					<ul class="link-list">
						<?php
						while ( $dis_query->have_posts() ) {
							$dis_query->the_post();
							$dis_faq           = get_post();
							$dis_faq_topics    = wp_get_post_terms( $dis_faq->ID, DIS_FAQ_TOPIC_TAXONOMY );
							$dis_topics_string = DIS_ContentsManager::get_topic_string_from_terms( $dis_faq_topics, false );
							$dis_marked_title  = DIS_ContentsManager::add_mark_to_text( $dis_faq->post_title, $dis_search_string );
							$dis_faq_excerpt   = DIS_ContentsManager::clean_and_truncate_text( $dis_faq->post_content, DIS_ACF_SHORT_TEXT_LENGTH );
							$dis_marked_text   = DIS_ContentsManager::add_mark_to_text( $dis_faq_excerpt, $dis_search_string );
							?>
							<li>
								<a class="list-item icon-right" href="<?php echo esc_url( get_permalink( $dis_faq->ID ) ); ?>">
									<span class="list-item-title-icon-wrapper">
										<h4 class="list-item-title">
											<?php echo wp_kses_post( $dis_marked_title ); ?>
										</h4>
										<svg class="icon icon-primary" aria-hidden="true">
											<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
										</svg>
									</span>
									<p>
										<?php echo wp_kses_post( $dis_marked_text ); ?>
									</p>
									<?php if ( $dis_topics_string ) : ?>
										<p class="mb-0">
											<small><?php echo wp_kses_post( $dis_topics_string ); ?></small>
										</p>
									<?php endif; ?>
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

			<!-- Results PAGINATION -->
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
		</div> <!-- container -->
	</section>
<?php endif; ?>

<!-- LIST FOR TOPICS -->
<section class="section section-muted pt-5 pb-5">
	<div class="container p-4">
		<div class="row">
			<div class="col-12">
				<h3 class="mb-3">
					<?php echo esc_attr( __( 'Explore by topic', 'design_ict_site' ) ); ?>
				</h3>
				<p>
					<?php echo esc_attr( __( 'The FAQs are organized by topic. Click on the topic of interest to view the questions and answers.', 'design_ict_site' ) ); ?>
				</p>
			</div>
		</div>
		<!-- TOPICS -->
		<div class="row h-100" role="region" aria-label="<?php echo esc_attr__( 'FAQ by topic', 'design_ict_site' ); ?>">
			<?php
			if ( count( $dis_all_topics ) > 0 ) {
				foreach ( $dis_all_topics as $dis_topic ) {
					$dis_topic_url = DIS_ContentsManager::get_topic_url_by_slug( $dis_topic->slug );
					?>
				<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
					<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
						<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5">
							<a class="CardGeneric_decoration-1__MhYyy flex-grow-1"
								data-focus-mouse="false"
								href="<?php echo esc_url( $dis_topic_url ); ?>">
								<?php echo esc_attr( $dis_topic->name ); ?>
							</a>
						</h4>
						<div class="it-card-body d-flex flex-column pt-0 pb-0 px-0"></div>
					</article>
				</div>
					<?php
				}
			} else {
				echo '<em>' . esc_attr( __( 'No results found', 'design_ict_site' ) ) . '</em>';
			}
			?>
		</div>
	</div> <!-- container -->
</section>

<!-- LIST OF FREQUENTLY ASKED QUESTIONS -->
<section class="section pt-5 pb-5">
	<div class="container p-4 pb-0">
		<div class="col-12">
			<h3 class="mb-5">
				<?php echo esc_attr( __( 'Most searched frequently asked questions', 'design_ict_site' ) ); ?>
			</h3>
			<div class="link-list-wrapper multiline">
				<?php if ( count( $dis_items ) > 0 ) : ?>
					<ul class="link-list">
						<?php
						foreach ( $dis_items as $dis_item ) {
							$dis_topics        = wp_get_post_terms( $dis_item->ID, DIS_FAQ_TOPIC_TAXONOMY );
							$dis_topics_string = DIS_ContentsManager::get_topic_string_from_terms( $dis_topics, false );
							?>
							<li>
								<a class="list-item icon-right" href="<?php echo esc_url( get_permalink( $dis_item->ID ) ); ?>">
									<span class="list-item-title-icon-wrapper">
										<h4 class="list-item-title">
											<?php echo esc_attr( $dis_item->post_title ); ?>
										</h4>
										<svg class="icon icon-primary">
											<title>
												<?php echo esc_attr( __( 'Code', 'design_ict_site' ) ); ?>
											</title>
											<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
										</svg>
									</span>
									<p>
										<?php echo wp_kses_post( $dis_topics_string ); ?>
									</p>
								</a>
							</li>
							<li>
								<span class="divider" role="separator"></span>
							</li>
							<?php
						}
						?>
					</ul>
				<?php else : ?>
						<em><?php echo esc_attr( __( 'No results found', 'design_ict_site' ) ); ?></em>
				<?php endif ?>
			</div>
		</div>
	</div>
</section>


<!-- CALL TO ACTION CONTACT HELPDESK -->
<?php get_template_part( 'template-parts/common/help-desk-call-to-action' ); ?>


<?php
get_footer();
