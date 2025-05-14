<?php
/**
 * Detail page for the post-type: dis-service-cluster.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$services = DIS_ContentsManager::get_service_list( 'title', $cluster_id=$post->ID );
$clusters = DIS_ContentsManager::get_cluster_list();
?>


	<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
		<div class="row">
			<!-- SERVICES OF THE GROUP -->
			<div class="col">
				<!-- BEGIN CLUSTER DESCRIPTION -->
				<h2 class="pb-2 title">Accesso alla rete</h2> 
					<!--start card-->
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body d-flex justify-content-start">
							<div>
								<p>
									Questa è la descrizione estesa del Service Cluster. Studenti, docenti, personale e visitatori accedono ogni giorno alle risorse della Scuola Normale
									tramite la sua rete. Segui le istruzioni di questa pagina e configura la connessione in base al tuo
									profilo.
								</p>
							</div>
						</div>
					</div>
					<!--end card -->
				<!-- END CLUSTER DESCRIPTION -->
					
				<!-- ELENCO ITEM -->
				<div class="row">
						<div class="card-wrapper card-teaser-wrapper card-teaser-block-2">
								<!--start card-->
								<div class="card card-teaser rounded shadow">
								<div class="card-body">
									<h3 class="card-title h5 ">
										<a href="scheda-singolo-servizio.html">WiFi SNS</a>
									</h3>
									<div class="card-text font-serif">
										<p>I membri della Scuola, attraverso le credenziali di ateneo, hanno libero accesso alla rete della Scuola
										</p>
									</div>
								</div>
							</div>
							<!--end card-->
								<!--start card-->
								<div class="card card-teaser rounded shadow">
								<div class="card-body">
									<h3 class="card-title h5 ">
										<a href="scheda-singolo-servizio.html">WiFi eduroam</a>
									</h3>
									<div class="card-text font-serif">
										<p>Istruzioni per utenti SNS in visita presso altre istituzioni aderenti e per utenti di istituzioni aderenti a EduRoam in visita alla Scuola
										</p>
									</div>
								</div>
							</div>
							<!--end card-->
							<!--start card-->
							<div class="card card-teaser rounded shadow">
								<div class="card-body">
									<h3 class="card-title h5 ">
										<a href="scheda-singolo-servizio.html">WiFi Ospiti (GuestSNS)</a>
									</h3>
									<div class="card-text font-serif">
										<p>Rete dedicata ai partecipanti a convegni, seminari o incontri, utenti occasionali. E' possibile utilizzare la rete della Scuola registrandosi tramite l'apposito form</p>
									</div>
								</div>
							</div>
							<!--end card-->
							</div>
						</div> <!-- chiude ROW-->
						<!-- FINE ELENCO ITEM -->
			</div> <!-- chiude COL-->

			<!-- SIDEBAR LIST -->
			<div class="col-12 col-lg-4 col-md-5">
				<div class="sidebar-wrapper it-line-left-side">

					<div class="sidebar-linklist-wrapper">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li>
									<h3><?php echo __( 'Our services' , 'design_ict_site' ); ?></h3>
								</li>
								<li>
									<a class="list-item medium active" href="#">
										<span>Accesso alla rete </span>
									</a>
								</li>
								<li>
									<a class="list-item medium" href="#"><span>Account e password</span></a>
								</li>
								<li>
									<a class="list-item medium" href="#"><span>Applicativi e piattafome</span>
								</a>
								</li>
								<li>
									<a class="list-item medium" href="#"><span>Backup e storage</span>
								</a>
								</li>
							</ul>
						</div>
					</div>
					
				</div>
			</div>

		</div>
	</div>

<?php
get_footer();
