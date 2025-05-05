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
						<!-- Contacts section -->
						<div class="col-lg-4 col-md-4 pb-2">
							<?php
									get_template_part( 'template-parts/footer/contacts-section', false, array( 'locations' => $locations ) );
							?>
						</div>
						<!-- USEFUL LINKS -->
						<div class="col-lg-4 col-md-4 pb-2">
							<?php
								get_template_part( 'template-parts/menu/useful-links-menu', false, array( 'locations' => $locations ) );
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
								<!-- BEGIN NEWSLETTER -->
								<?php
									get_template_part(
										'template-parts/common/newsletter',
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
					</div> <!-- row -->
				</section>
			</div>
		</div>
		<div class="it-footer-small-prints clearfix">
			<!-- FOOTER -MENU -->
			<?php
				get_template_part( 'template-parts/menu/footer-menu', false, array( 'locations' => $locations ) );
			?>
		</div>
	</footer>
<!-- END FOOTER -->

<?php wp_footer(); ?>
</body>
</html>
