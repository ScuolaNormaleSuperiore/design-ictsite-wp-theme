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
	)
);

$faq_autocomplete = DIS_OptionsManager::dis_get_option( 'faq_autocomplete_enabled', 'dis_opt_hp_layout' );
$items            = DIS_ContentsManager::get_top_faqs( 6 );
$help_link        = DIS_MultiLangManager::get_page_link( HELP_DESK_PAGE_SLUG );
?>

<!-- FAQ PAGE -->
<section class="section pt-0 pb-5" >
	<div class="container p-4">
		<h2 class="pb-2">
			<?php echo esc_attr( get_the_title() ); ?>
		</h2>
		<p class="lead">
			<?php echo get_the_excerpt() ?>
		</p>
	</div> <!-- container -->
</section>

<!-- FAQ SEARCH -->
<?php if ( $faq_autocomplete === 'true' ): ?>
	<section class="section pt-5 pb-5" >
		<div class="container p-4">
			<div class="row">
				<div class="col-12 col-md-7">
					<h3 class="mb-3">
						<?php echo esc_attr( __( 'Search the FAQs', 'design_ict_site' ) ); ?>
					</h3>
					<div class="form-group">
						<div class="input-group">
							<span class="input-group-text">
								<svg class="icon icon-sm" aria-hidden="true">
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-search'; ?>"></use>
								</svg>
							</span>
							<label for="input-group-1">
								<?php echo esc_attr( __( 'Search the FAQs', 'design_ict_site' ) ); ?>
							</label>
							<input type="text" class="form-control" id="input-group-1" name="input-group-1">
							<div class="input-group-append">
								<button class="btn btn-primary" type="button" id="button-1">
									<a href="faq-risultati-ricerca.html" class="text-white">
										<?php echo esc_attr( __( 'Search', 'design_ict_site' ) ); ?>
									</a>
								</button>
							</div>
						</div>
					</div>
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
			foreach ( $all_topics as $topic) {
				$topic_url = '#';
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
				<ul class="link-list">
					<?php
						foreach( $items as $item ) {
							$topics        = wp_get_post_terms( $item->ID, DIS_FAQ_TOPIC_TAXONOMY );
							$topics_string = DIS_ContentsManager::get_topic_string_from_terms( $topics, true );
					?>
					<li>
						<a class="list-item icon-right" href="scheda-faq.html">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">
									<?php echo esc_attr( $item->post_title ); ?>
								</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right'; ?>"></use>
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
			</div>
		</div>
	</div>
</section>

<!-- CALL TO ACTION CONTACT HELPDESK -->
<section class="section pt-5 pb-5">
	<div class="container p-4">
		<div class="row">
			<div class="col-12">
				<article class="it-card it-card-banner rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							<?php echo esc_attr( __( "Didn't find the answers you were looking for?", 'design_ict_site' ) ); ?>
						</h3>
						<!--card second child is the icon (optional)-->
						<div class="it-card-banner-icon-wrapper">
							<svg class="icon icon-secondary icon-xl" aria-hidden="true">
								<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-help-circle'; ?>"></use>
							</svg>
						</div>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-subtitle">
								<?php echo esc_attr( __( 'Contact the help desk for technical assistance.', 'design_ict_site' ) ); ?>
							</p>
						</div>
						<div class="it-card-footer" aria-label="<?php echo esc_attr( __( 'Request support', 'design_ict_site' ) ); ?>">
							<a class="btn btn-sm btn-primary ms-3" href="<?php echo esc_url( $help_link ); ?>">
								<?php echo esc_attr( __( 'Request support', 'design_ict_site' ) ); ?>
								<svg class="icon icon-white ms-2">
									<use href="<?php echo DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right'; ?>"></use>
								</svg>
							</a>
						</div>
				</article>
			</div>
		</div>
	</div>
</section>


<?php
get_footer();
