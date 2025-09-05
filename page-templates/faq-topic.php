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
$help_link        = DIS_MultiLangManager::get_page_link( HELP_DESK_PAGE_SLUG );

if ( $topic_slug ) {
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


	<!-- ELENCO DOMANDE PIù FREQUENTI CON MENU DI NAVIGAZIONE ARGOMENTI -->
	<section class="section pt-5 pb-5">
		<div class="container pt-0 pb-0">
			<div class="row">

				<!-- navigazione per argomenti -->
				<div class="col-12 col-lg-4">
					<nav class="navbar it-navscroll-wrapper navbar-expand-lg it-bottom-navscroll it-left-side" data-bs-navscroll>
						<button class="custom-navbar-toggler" type="button" aria-controls="navbarNav"
							aria-label="Apri/Chiudi indice" data-bs-toggle="navbarcollapsible" data-bs-target="#navbarNav"><span
								class="it-list"></span>Argomenti FAQ
						</button>
						<div class="navbar-collapsable" id="navbarNav" tabindex="-1">
							<div class="close-div visually-hidden">
								<button class="btn close-menu" type="button">
									<span class="it-close"></span>Chiudi
								</button>
							</div>
							<button type="button" class="it-back-button btn w-100 text-start">
								<svg class="icon icon-sm icon-primary align-top">
									<use href="/bootstrap-italia/svg/sprites.svg#it-chevron-left"
										xlink:href="/bootstrap-italia/svg/sprites.svg#it-chevron-left"></use>
								</svg>
								<span>Indietro</span>
							</button>
							<div class="menu-wrapper" tabindex="-1">
								<div class="link-list-wrapper">
									<h3>Naviga per Argomenti</h3>
									<ul class="link-list">
										<li class="nav-item active">
											<a class="nav-link active" href="faq-elenco-per-argomento.html"><span>Argomento 1</span></a>

											<a class="nav-link" href="faq-elenco-per-argomento.html"><span>Argomento 2</span></a>

										</li>
									</ul>
								</div>
							</div>
						</div>
					</nav>
				</div>

					<!-- elenco faq argomento no paginazione -->
					<div class="col-12 col-lg-8 it-page-sections-container">

					<div class="link-list-wrapper multiline">
						<ul class="link-list">
							<li>
								<a class="list-item icon-right" href="scheda-faq.html">
									<span class="list-item-title-icon-wrapper">
										<h4 class="list-item-title">Titolo faq 1</h4>
										<svg class="icon icon-primary">
											<title>Codice</title>
											<use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use>
										</svg>
									</span>
									<p>Argomento 1</p>
								</a>
							</li>
							<li>
								<span class="divider" role="separator"></span>
							</li>
							<li>
								<a class="list-item icon-right" href="scheda-faq.html">
									<span class="list-item-title-icon-wrapper">
										<h4 class="list-item-title">Titolo faq 2</h4>
										<svg class="icon icon-primary">
											<title>Codice</title>
											<use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use>
										</svg>
									</span>
									<p>Argomento 1</p>
								</a>
							</li>
							<li><span class="divider"></span>
							</li>
							<li>
								<a class="list-item icon-right" href="faq.html" aria-disabled="true">
									<span class="list-item-title-icon-wrapper">
										<h4 class="list-item-title">Titolo FAQ 3</h4>
										<svg class="icon icon-primary">
											<title>Codice</title>
											<use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use>
										</svg>
									</span>
									<p>Argomento 1</p>
								</a>
							</li>
							<li>
								<span class="divider"></span>
							</li>
						</ul>
					</div>
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
}
get_footer();
