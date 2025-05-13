<?php
/* Template Name: ServiceClusters
*
* @package Design_ICT_Site
*/

global $post;
get_header();

?>

	<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
		<h2 class="pb-2">I nostri servizi</h2>
		<div class="row">
			<!-- SERVIZI -->
			<div class="col">
				<div class="card-wrapper card-teaser-wrapper card-teaser-block-2">

					<!--start card-->
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body d-flex justify-content-start">
							<i class="bi bi-wifi me-3" style="font-size: 2em;"></i>
							<div>
								<h3 class="h5"><a href="accesso-alla-rete.html">Accesso alla rete</a></h3>
								<p>Studenti, docenti, personale e visitatori accedono ogni giorno alle risorse della Scuola Normale
									tramite la sua rete. Segui le istruzioni di questa pagina e configura la connessione in base al tuo
									profilo.</p>
							</div>
						</div>
					</div>
					<!--end card -->

					<!--start card-->
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body d-flex justify-content-start">
							<i class="bi bi-key me-3" style="font-size: 2em;"></i>
							<div>
								<h3 class="h5"><a href="accesso-alla-rete.html">Account e password</a></h3>
								<p>L’Area Strategie Digitali gestisce il ciclo di vita utente per l’accesso autenticato a sistemi e
									servizi SNS: weblogin, credenziali LDAP e sistemi di autenticazione e controllo accessi.</p>
							</div>
						</div>
					</div>
					<!--end card -->


					<!--start card-->
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body d-flex justify-content-start">
							<i class="bi bi-bar-chart me-3" style="font-size: 2em;"></i>
							<div>
								<h3 class="h5"><a href="accesso-alla-rete.html">Applicativi e piattaforme</a></h3>
								<p>
									L'Area Strategie Digitali analizza le esigenze dell’Amministrazione, definisce le specifiche e le
									personalizzazioni degli applicativi e si occupa inoltre dell'assistenza nell'utilizzo degli
									applicativi stessi e della risoluzione di bug o segnalazioni.</p>
							</div>
						</div>
					</div>
					<!--end card -->

					<!--start card-->
					<div class="card card-bg rounded card-teaser bg-white" style="border-top: 3px solid">
						<div class="card-body d-flex justify-content-start">
							<i class="bi bi-cloud me-3" style="font-size: 2em;"></i>
							<div>
								<h3 class="h5"><a href="accesso-alla-rete.html">Backup e storage</a></h3>
								<p>
									Soluzioni di archiviazione affidabili dei dati sono a disposizione di professori, ricercatori e
									allievi.</p>
							</div>
						</div>
					</div>
					<!--end card -->

				</div>
			</div>
			<!-- SIDEBAR ELENCO -->
			<div class="col-12 col-lg-4 col-md-5">
				<div class="sidebar-wrapper it-line-left-side">
					<div class="sidebar-linklist-wrapper">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li>
									<h3>Dalla a alla z</h3>
								</li>
								<li><a class="list-item medium " href="#"><span>Link lista 1 </span></a>
								</li>
								<li><a class="list-item medium" href="#"><span>Link lista 2 </span></a>
								</li>
								<li><a class="list-item medium" href="#"><span>Link lista 3</span></a>
								</li>
								<li><a class="list-item medium" href="#"><span>Link lista 4</span></a>
								</li>
							</ul>
						</div>
					</div>
					<div class="sidebar-linklist-wrapper linklist-secondary">
						<div class="link-list-wrapper">
							<ul class="link-list">
								<li><a class="list-item" href="#"><span>Link secondario 1</span></a>
								</li>
								<li><a class="list-item " href="#"><span>Link secondario 2 (attivo)</span></a>
								</li>
								<li><a class="list-item disabled" href="#"><span>Link secondario 3 (disabilitato)</span></a>
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
