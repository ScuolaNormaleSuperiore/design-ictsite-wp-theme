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

$def_topic      = count( $all_topics ) > 0 ? $all_topics[0] : null;
$def_topic_slug = $def_topic ? $def_topic->slug : '';
$def_topic_name = $def_topic ? $def_topic->name : '';
$topic_slug     = isset( $_GET['topic'] ) ? sanitize_text_field( wp_unslash( $_GET['topic'] ) ) : $def_topic_slug;
if ( isset( $_GET['topic'] ) ) {
	$topic_term = get_term_by( 'slug', $topic_slug, DIS_FAQ_TOPIC_TAXONOMY );
	$topic_name = $topic_term->name;
} else {
	$topic_name = $def_topic_name;
}

if ( $topic_slug ) {
	$faqs = DIS_ContentsManager::get_faq_by_topic( $topic_slug );
?>

	<!-- FAQ PAGE -->
	<section class="section pt-0 pb-5" >
		<div class="container p-4">
			<h2 class="pb-2">
				FAQ - <?php echo esc_attr( $topic_name ); ?>
			</h2>
			<p class="lead">
				<?php echo esc_html( get_the_excerpt() ); ?>
			</p>
		</div> <!-- container -->
	</section>

	<!-- FAQs by TOPIC -->
	<section class="section pt-5 pb-5">
		<div class="container pt-0 pb-0">
			<div class="row">

				<!-- TOPIC LIST -->
				<div class="col-12 col-lg-4">
					<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side" data-bs-navscroll>
						<button class="custom-navbar-toggler" type="button" aria-controls="navbarNav"
							aria-label="Apri/Chiudi indice" data-bs-toggle="navbarcollapsible" data-bs-target="#navbarNav">
							<span class="it-list"></span>
							<?php esc_attr( __( 'FAQ by topic', 'design_ict_site' ) ); ?>
						</button>
						<div class="navbar-collapsable" id="navbarNav" tabindex="-1">
							<div class="close-div visually-hidden">
								<button class="btn close-menu" type="button">
									<span class="it-close"></span>
									<?php esc_attr( __( 'Close', 'design_ict_site' ) ); ?>
								</button>
							</div>
							<button type="button" class="it-back-button btn w-100 text-start">
								<svg class="icon icon-sm icon-primary align-top">
									<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-chevron-left' ); ?>"
										xlink:href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-chevron-left' ); ?>"></use>
								</svg>
								<span>
									<?php esc_attr( __( 'Back', 'design_ict_site' ) ); ?>
								</span>
							</button>
							<div class="menu-wrapper" tabindex="-1">
								<div class="link-list-wrapper">
									<h3>	
										<?php esc_attr( __( 'Browse by topic', 'design_ict_site' ) ); ?>
									</h3>
									<ul class="link-list">
										<?php
										foreach ( $all_topics as $topic_item ) {
											$active    = $topic_item->slug === $topic_slug ? 'active' : '';
											$topic_url = DIS_ContentsManager::get_topic_url_by_slug( $topic_item->slug );
										?>
											<li class="nav-item">
													<a class="nav-link <?php echo esc_attr( $active ); ?>" href="<?php echo esc_url( $topic_url ); ?>">
														<span><?php echo esc_attr( $topic_item->name ); ?></span>
													</a>
											</li>
										<?php
										}
										?>
									</ul>
								</div>
							</div>
						</div>
					</nav>
				</div>

				<!-- FAQ LIST -->
				<div class="col-12 col-lg-8 it-page-sections-container">
					<div class="link-list-wrapper multiline">
						<ul class="link-list">
							<?php
								foreach( $faqs as $faq ) {
									$topics        = wp_get_post_terms( $faq->ID, DIS_FAQ_TOPIC_TAXONOMY );
									$topics_string = DIS_ContentsManager::get_topic_string_from_terms( $topics, false );
							?>
								<li>
									<a class="list-item icon-right" href="<?php echo esc_url( get_permalink( $faq->ID ) ); ?>">
										<span class="list-item-title-icon-wrapper">
											<h4 class="list-item-title">
												<?php echo esc_attr( $faq->post_title ); ?>
											</h4>
											<svg class="icon icon-primary">
												<title>
													<?php echo esc_attr( __( 'Code', 'design_ict_site' ) ); ?>
												</title>
												<use href="<?php echo esc_url( DIS_THEME_URL . '/assets/bootstrap-italia/svg/sprites.svg#it-arrow-right' ); ?>"></use>
											</svg>
										</span>
										<p><?php echo wp_kses_post( $topics_string ); ?></p>
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

			</div> <!-- row -->
		</div> <!-- container -->
	</section>

	<!-- CALL TO ACTION CONTACT HELPDESK -->
	<?php get_template_part( 'template-parts/common/help-desk-call-to-action' ); ?>


<?php
}
get_footer();
