<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_ICT_Site
 */

// Site options.
$site_title   = DIS_OptionsManager::dis_get_option( 'site_title', 'dis_opt_options' );
$site_tagline = DIS_OptionsManager::dis_get_option( 'site_tagline', 'dis_opt_options' );
$current_lang = DIS_MultiLangManager::get_current_language();
$locations    = get_nav_menu_locations();
?>

<!-- START FOOTER -->
	<footer class="it-footer" id="it-footer">
		<div class="it-footer-main">
			<div class="container">
				<section>
					<div class="row clearfix">
						<div class="col-sm-12">
							<!-- LOGO & TITLE -->
							<?php
								get_template_part(
									'template-parts/footer/logo_title_footer',
									false,
									array(
										'site_title'   => $site_title,
										'site_tagline' => $site_tagline,
										'current_lang' => $current_lang,
									),
								);
								?>
						</div>
					</div>
				</section>
				<section class="py-4 border-white border-top">
					<div class="row">
						<!-- Help desk section -->
						<div class="col-lg-4 col-md-4 pb-2">
							<h4 class="customSpacing">HELPDESK</h4>
							<p> L'helpdesk telefonico è disponibile dal lunedì al venerdì in orario di ufficio
								(9.00-13.00/14.00-17.00)</p>
							<div class="link-list-wrapper">
								<ul class="footer-list link-list clearfix">
									<li><a class="list-item" href="mailto:helpdesk@sns.it"
											title="Contatta la mail dell'helpdesk">helpdesk@sns.it</a></li>
									<li> +39 050 6133533 </li>
								</ul>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 pb-2">
							<!-- USEFUL LINKS -->
							<?php
								get_template_part( 'template-parts/menu/useful-links-menu', false,array( 'locations' => $locations ) );
							?>
						</div>
						<div class="col-lg-4 col-md-4 pb-2">
							<div class="pb-2">
								<h4 class="customSpacing">Area Progetti e Servizi ICT</h4>
								<div class="link-list-wrapper">
									<ul class="footer-list link-list clearfix">
										<li><a class="list-item" href="paginabase.html" title="Vai alla pagina: policy IT">Servizio
												Infrastrutture</a> </li>
										<li><a class="list-item" href="paginabase.html"
												title="Vai alla pagina: Documenti e link utili">Servizio Sistemi Informativi</a> </li>
									</ul>
								</div>

								<!-- blocco newsletter -->
								<h4>Newsletter </h4>
								<div class="form-group">
									<div class="input-group border">
										<div class="input-group-prepend">
											<div class="input-group-text bg-transparent border-white">
												<svg class="icon icon-sm icon-white" role="img" aria-labelledby="Mail">
													<title>Mail</title>
													<use xlink:href="bootstrap-italia/svg/sprites.svg#it-mail"></use>
												</svg>
											</div>
										</div>
										<label for="input-group-3" class="text-white text-light">Indirizzo e-mail</label>
										<input autocomplete="email" type="text"
											title="Inserisci il tuo indirizzo email per ricevere aggiornamenti"
											class="form-control bg-transparent text-white border-white" id="input-group-3"
											name="input-group-3">
										<div class="input-group-append">
											<button class="btn btn-primary bg-transparent text-white text-light border-white border"
												type="button" id="button-newsletter-iscriviti">Invio</button>
										</div>
									</div>
								</div>
								<!-- fine blocco newsletter -->
							</div>
						</div>
					</div>
				</section>
			</div>
		</div>
		<div class="it-footer-small-prints clearfix">
			<div class="container">
				<h3 class="visually-hidden">Sezione Link Utili</h3>
				<ul class="it-footer-small-prints-list list-inline mb-0 d-flex flex-column flex-md-row">
					<li class="list-inline-item"><a href="paginabase.html" title="Privacy-Cookies">Privacy policy</a></li>
					<li class="list-inline-item"><a href="paginabase.html" title="Accessibilità">Dichiarazione di
							accessibilità</a></li>
				</ul>
			</div>
		</div>
	</footer>
<!-- END FOOTER -->

<?php wp_footer(); ?>
</body>
</html>
