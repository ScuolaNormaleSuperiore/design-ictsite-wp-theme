<?php
/**
 * Detail page for the post-type: dis-service.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$short_description = DIS_CustomFieldsManager::get_field( 'short_description' , $post->ID );
$service_link      = DIS_CustomFieldsManager::get_field( 'service_link' , $post->ID );
$features          = DIS_CustomFieldsManager::get_field( 'features' , $post->ID );
$requirements      = DIS_CustomFieldsManager::get_field( 'requirements' , $post->ID );
$rates             = DIS_CustomFieldsManager::get_field( 'rates' , $post->ID );
$get_started       = DIS_CustomFieldsManager::get_field( 'get_started' , $post->ID );
$related_doc       = DIS_CustomFieldsManager::get_field( 'related_documents' , $post->ID );
$related_services  = DIS_CustomFieldsManager::get_field( 'related_services' , $post->ID );
$offices           = DIS_CustomFieldsManager::get_field( 'office' , $post->ID );
// Incremento il contatore delle visite.
DIS_ContentsManager::increment_visit_counter( $post->ID );
?>



	<div class="container">
		<!-- SLIM HERO -->
		<section class="it-hero-wrapper it-dark it-overlay it-text-centered">
		<div class="img-responsive-wrapper">
			<div class="img-responsive">
				<div class="img-wrapper">
					<img
						src="https://animals.sandiegozoo.org/sites/default/files/2016-08/animals_hero_mountains.jpg"
						title="titolo immagine"
						alt="descrizione immagine">
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="it-hero-text-wrapper bg-dark it-text-centered">
						<h2><?php echo esc_html( $post->post_title ); ?></h2>
						<p class="d-none d-lg-block">
							<?php echo esc_html( $short_description ); ?>
						</p>
						<div class="it-btn-container">
							<a class="btn btn-sm btn-secondary" href="[Service link]">
								Accedi al servizio
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>
		</section>
	</div>

	<!-- SERVICE BODY -->
	<div class="container shadow rounded p-4 mb-5 mt-2">
		<div class="row">
			<!-- Descrizione del servizio -->
			<div class="col-12 col-md-10 offset-md-1 col-lg-7 offset-lg-1 m-auto">

				<!-- DESCRIZIONE -->
				<p class="lead">
					[Description] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget laoreet sem.
					Etiam blandit dui lacus, posuere consectetur ipsum eleifend ac. Vivamus nec justo nunc. Fusce nec tempor
					risus. Morbi volutpat, nisi at molestie maximus, sapien purus pharetra eros, nec condimentum nulla mauris sed
					ipsum. Vivamus ac placerat dolor. Nunc posuere dignissim tortor, nec laoreet felis tempor non. Morbi vitae
					neque dolor.
				</p>

				<!-- FEATURES-->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-check-circle" style="font-size: 1.75rem;"></i>
					Features
				</h3>
				<p class="">
					[Features] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget laoreet sem. Etiam
					blandit dui lacus, posuere consectetur ipsum eleifend ac. Vivamus nec justo nunc. Fusce nec tempor risus.
					Morbi volutpat, nisi at molestie maximus, sapien purus pharetra eros, nec condimentum nulla mauris sed ipsum.
					Vivamus ac placerat dolor. Nunc posuere dignissim tortor, nec laoreet felis tempor non. Morbi vitae neque
					dolor.
				</p>

				<!-- REQUIREMENTS-->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-list-check" style="font-size: 1.75rem;"></i>
					Requirements
				</h3>
				<p class="">[Requirements] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget laoreet sem. Etiam
					blandit dui lacus, posuere consectetur ipsum eleifend ac. Vivamus nec justo nunc. Fusce nec tempor risus.
					Morbi volutpat, nisi at molestie maximus, sapien purus pharetra eros, nec condimentum nulla mauris sed ipsum.
					Vivamus ac placerat dolor. Nunc posuere dignissim tortor, nec laoreet felis tempor non. Morbi vitae neque
					dolor.</p>

					<!-- DESIGNED FOR -->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-people" style="font-size: 1.75rem;"></i>
					A chi è rivolto
				</h3>
				<p class="">[Role Interested] Docenti, PTA, studenti</p>

				<!-- GET STARTED-->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-rocket" style="font-size: 1.75rem;"></i>
					Get started
				</h3>
				<p class="">[Get started] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget laoreet sem. Etiam
					blandit dui lacus, posuere consectetur ipsum eleifend ac. Vivamus nec justo nunc. Fusce nec tempor risus.
					Morbi volutpat, nisi at molestie maximus, sapien purus pharetra eros, nec condimentum nulla mauris sed ipsum.
					Vivamus ac placerat dolor. Nunc posuere dignissim tortor, nec laoreet felis tempor non. Morbi vitae neque
					dolor.</p>

						<!-- RATES -->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-credit-card" style="font-size: 1.75rem;"></i>
					Rates
				</h3>
				<p class="">[Rates] Lorem ipsum dolor sit amet, consectetur adipiscing elit. Cras eget laoreet sem. Etiam
					blandit dui lacus, posuere consectetur ipsum eleifend ac. Vivamus nec justo nunc. Fusce nec tempor risus.
					Morbi volutpat, nisi at molestie maximus, sapien purus pharetra eros, nec condimentum nulla mauris sed ipsum.
					Vivamus ac placerat dolor. Nunc posuere dignissim tortor, nec laoreet felis tempor non. Morbi vitae neque
					dolor.</p>

					<!-- GET HELP -->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-question-circle" style="font-size: 1.75rem;"></i>
					Get help
				</h3>
				<p class="">[Office] Write to or link to [servizio competente]</p>

					<!-- LEARN MORE -->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-info-circle" style="font-size: 1.75rem;"></i>
					Documentazione
				</h3>
				<ul>
					<li><a href="#">Documento 1</a></li>
					<li><a href="#">Documento 1</a></li>
					<li><a href="#">Documento 1</a></li>
					<li><a href="#">Documento 1</a></li>
				</ul>

					<!-- Servizi correlati -->
				<h3 class="h4 service-paragraph">
					<i class="bi bi-arrow-right-circle" style="font-size: 1.75rem;"></i>
					Servizi correlati
				</h3>
				<ul>
					<li><a href="#">Servizio 1</a></li>
					<li><a href="#">Servizio 1</a></li>
					<li><a href="#">Servizio 1</a></li>
					<li><a href="#">Servizio 1</a></li>
				</ul>

				<!-- Data di aggiornamento -->
				<div class="pt-4">
					<p class="it-text-centered">
						Ultimo aggiornamento: [data-modifica]</p>
				</div>

			</div>
		</div>
	</div>


<?php
get_footer();
