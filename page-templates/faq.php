<?php
/** Template Name: Faq
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

// Get all the FAQ topics.
$all_topics = get_terms(
	array(
		'taxonomy'   => DIS_FAQ_TOPIC_TAXONOMY,
		'hide_empty' => true,
		'orderby'    => 'name',
		'order'      => 'ASC',
	)
);
// Get the FAQs.
$faq_autocomplete = DIS_OptionsManager::dis_get_option( 'faq_autocomplete_enabled', 'dis_opt_hp_layout' );
$items            = DIS_ContentsManager::get_top_faqs( 6 );
?>

<!-- FAQ PAGE -->
<section class="section pt-0 pb-5" >
	<div class="container p-4">
		<h2 class="pb-2">
			<?php echo esc_attr( get_the_title() ); ?>
		</h2>
		<p class="lead">
			<?php echo esc_html ( get_the_excerpt() ); ?>
		</p>
	</div> <!-- container -->
</section>

<!-- FAQ SEARCH -->
<?php if ( $faq_autocomplete === 'true' ): ?>
	<section class="section pt-0 pb-10" >
		<div class="container p-4">
			<div class="row">
				<div class="col-12 col-md-7">
					<h3 class="mb-3">
						<?php echo esc_attr( __( 'Search the FAQs', 'design_ict_site' ) ); ?>
					</h3>
					<div id="faq_search_autocomplete"></div>
				</div> <!-- col -->
			</div> <!-- row -->
		</div> <!-- container -->
	</section>
<?php endif ?>

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
		<div class="row h-100" role="region" aria-label="Lista argomenti FAQ">
			<?php
			if ( count( $all_topics ) > 0 ) {
				foreach ( $all_topics as $topic ) {
					$topic_url = DIS_ContentsManager::get_topic_url_by_slug( $topic->slug );
					?>
				<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
					<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
						<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5">
							<a class="CardGeneric_decoration-1__MhYyy flex-grow-1"
								data-focus-mouse="false"
								href="<?php echo esc_url( $topic_url ); ?>">
								<?php echo esc_attr( $topic->name ); ?>
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
				<?php if ( count( $items ) > 0 ) : ?>
					<ul class="link-list">
						<?php
						foreach ( $items as $item ) {
							$topics        = wp_get_post_terms( $item->ID, DIS_FAQ_TOPIC_TAXONOMY );
							$topics_string = DIS_ContentsManager::get_topic_string_from_terms( $topics, false );
						?>
							<li>
								<a class="list-item icon-right" href="<?php echo esc_url( get_permalink( $item->ID ) ); ?>">
									<span class="list-item-title-icon-wrapper">
										<h4 class="list-item-title">
											<?php echo esc_attr( $item->post_title ); ?>
										</h4>
										<svg class="icon icon-primary">
											<title>
												<?php echo esc_attr( __( 'Code', 'design_ict_site' ) ); ?>
											</title>
											<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
										</svg>
									</span>
									<p>
										<?php echo wp_kses_post( $topics_string ); ?>
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
