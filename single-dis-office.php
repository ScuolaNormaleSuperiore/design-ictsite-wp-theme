<?php
/**
 * Detail page for the post-type: dis-office.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$image_data  = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
$persons     = DIS_CustomFieldsManager::get_field( 'members', $post->ID );
$email       = DIS_CustomFieldsManager::get_field( 'email', $post->ID );
$phone       = DIS_CustomFieldsManager::get_field( 'telephone', $post->ID );
$places      = DIS_CustomFieldsManager::get_field( 'places', $post->ID );
$full_places = $places ? implode( ', ', wp_list_pluck( $places, 'post_title' ) ) : '';
?>


<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<!-- UFFICIO -->
		<div class="col">
			<h2 class="pb-2">Nome dell'ufficio (sigla)</h2>

			<!-- DESCRIZIONE -->
			<div class="row pb-3">
				<h3 class="it-page-section h4 visually-hidden" id="descrizione">Descrizione</h3>

				<p>Proin placerat ipsum massa, ac commodo velit tempor quis. In ante augue, sodales ac rhoncus in, ultricies a
					neque. Morbi non semper felis, at lacinia nibh. Nam quis elit massa. Interdum et malesuada fames ac ante
					ipsum primis in faucibus. Aliquam laoreet, diam quis blandit porttitor, leo erat semper sem, vel sagittis
					dolor quam eu magna. Nunc feugiat pretium tempor. Nam eget augue quis tellus viverra malesuada vel ut quam.
					Cras vehicula rutrum
					vehicula. Suspendisse efficitur eget purus vitae convallis. Integer euismod pharetra lorem, non ullamcorper
					lorem euismod vel. Orci varius natoque
					penatibus et magnis dis parturient montes, nascetur ridiculus mus.
				</p>
				<p>{Descrizione estesa} Proin placerat ipsum massa, ac commodo velit tempor quis. In ante augue, sodales ac
					rhoncus in, ultricies a neque. Morbi non semper felis, at lacinia nibh. Nam quis elit massa. Interdum et
					malesuada fames ac ante ipsum primis in faucibus. Aliquam laoreet, diam quis blandit porttitor, leo erat
					semper sem, vel sagittis dolor quam eu magna. Nunc feugiat pretium tempor. Nam eget augue quis tellus
					viverra malesuada vel ut quam. Cras vehicula rutrum
					vehicula. Suspendisse efficitur eget purus vitae convallis. Integer euismod pharetra lorem, non ullamcorper
					lorem euismod vel. Orci varius natoque
					penatibus et magnis dis parturient montes, nascetur ridiculus mus.
				</p>
			</div>
			<!-- MEMBRI DEL GRUPPO -->
			<div class="row">
				<h3 class="h4 service-paragraph mt-3">
					<i class="bi bi-person" style="font-size: 1.75rem;"></i> Persone
				</h3>
				<!-- trattandosi di una lista c'è da capire in quale ordine visualizzare, potrebbe anche andare bene in ordine alfabetico per cognome -->
				<ul class="it-card-list row" aria-label="Risultati della ricerca: ">
					<li class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
						<!--start it-card-->
						<article
							class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border">
							<div class="it-card-profile-header">
								<div class="it-card-profile">
									<h4 class="it-card-profile-name ">
										<a href="scheda-persona.html">Nome e cognome</a>
									</h4>
									<p class="it-card-profile-role">Responsabile di area</p>
								</div>
								<div class="avatar size-xl">
									<img src="https://randomuser.me/api/portraits/women/14.jpg" alt="Woman image">
								</div>
							</div>
							<div class="it-card-body">
								<dl class="it-card-description-list">
									<div>
										<dd><a href="scheda-ufficio.html">Area progetti e servizi IT</a></dd>
									</div>
								</dl>
							</div>
						</article>
						<!--end it-card-->
					</li>
					<li class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
						<!--start it-card-->
						<article
							class="it-card it-card-profile it-card-height-full it-card-border-top it-card-border-top-secondary rounded shadow-sm border">
							<div class="it-card-profile-header">
								<div class="it-card-profile">
									<h4 class="it-card-profile-name ">
										Nome (no-link)
									</h4>
									<p class="it-card-profile-role">Staff</p>
								</div>
								<div class="avatar size-xl">
									<img src="https://randomuser.me/api/portraits/women/15.jpg" alt="Woman image">
								</div>
							</div>
							<div class="it-card-body">
								<dl class="it-card-description-list">
									<div>
										<dd><a href="scheda-ufficio.html">Area progetti e servizi IT</a></dd>
									</div>
								</dl>
							</div>
						</article>
						<!--end it-card-->
					</li>

				</ul>
			</div>

			<!-- PROGETTI -->
			<div class="row">
				<h3 class="h4 service-paragraph mt-3">
					<i class="bi bi-clipboard-data" style="font-size: 1.75rem;"></i> Progetti
				</h3>
				<!-- lista dei progetti collegati al servizio -->
				<ul class="it-card-list row" aria-label="Risultati della ricerca: ">
					<li class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
						<!--start it-card-->
						<article class="it-card it-card-height-full rounded shadow-sm border">
							<!--card first child is the title (link)-->
							<h3 class="it-card-title ">
								<a href="scheda-progetto.html">Primo progetto</a>
							</h3>
							<!--card body content-->
							<div class="it-card-body">
								<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
									in massimo tre o quattro righe, senza troncamento.</p>
							</div>

						</article>
						<!--end it-card-->
					</li>
					<li class="col-12 col-md-6 col-lg-6 mb-3 mb-md-4">
						<!--start it-card-->
						<article class="it-card it-card-height-full rounded shadow-sm border">
							<!--card first child is the title (link)-->
							<h3 class="it-card-title ">
								<a href="scheda-progetto.html">Secondo progetto</a>
							</h3>
							<!--card body content-->
							<div class="it-card-body">
								<p class="it-card-text">Questo è un testo breve che riassume il contenuto della pagina di destinazione
									in massimo tre o quattro righe, senza troncamento.</p>
							</div>

						</article>
						<!--end it-card-->
					</li>

				</ul>
			</div>

		</div>
		<!-- SIDEBAR ELENCO -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side ps-4">

				<div class="it-list-wrapper">
					<ul class="it-list">
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text"><a href="scheda-luogo.html">Nome del luogo in relazione con link</a></span>
								<svg class="icon">
									<title>Indirizzo</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-map-marker"></use>
								</svg>
							</div>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">050 509662</span>
								<svg class="icon">
									<title>Telefono</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-telephone"></use>
								</svg>
							</div>
						</li>
						<li class="list-item">
							<div class="it-right-zone">
								<span class="text">mail@sns.it</span>
								<svg class="icon">
									<title>E-mail</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-mail"></use>
								</svg>
							</div>
						</li>

					</ul>
				</div>

			</div>
		</div>
	</div>

</div>

<?php
get_footer();
