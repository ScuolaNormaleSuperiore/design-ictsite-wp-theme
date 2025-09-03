<?php
/** Template Name: Faq
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
// $items = DIS_ContentsManager::get_generic_post_list( DIS_FAQ_POST_TYPE, 'title', $params );
?>

<!-- FAQ PAGE -->
<section class="section pt-0 pb-5" >
	<div class="container p-4">
		<h2 class="pb-2">FAQ - Frequently Asked Questions</h2>
		<p class="lead">
			In questa pagina sono raccolte le domande più frequenti (FAQ) sui servizi informatici di ateneo.
			Per ogni domanda è possibile visualizzare la risposta cliccando sull'argomento di interesse.
		</p>
	</div> <!-- container -->
</section>

<!-- FAQ SEARCH -->
<section class="section pt-5 pb-5" >
	<div class="container p-4">
		<div class="row">
			<div class="col-12 col-md-7">
				<h3 class="mb-3">Cerca tra le FAQ</h3>
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-text">
							<svg class="icon icon-sm" aria-hidden="true">
								<use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
							</svg>
						</span>
						<label for="input-group-1">Cerca tra le FAQ</label>
						<input type="text" class="form-control" id="input-group-1" name="input-group-1">
						<div class="input-group-append">
							<button class="btn btn-primary" type="button" id="button-1">
								<a href="faq-risultati-ricerca.html" class="text-white">Cerca</a></button>
						</div>
					</div>
				</div>
			</div> <!-- col -->
		</div> <!-- row -->
	</div> <!-- container -->
</section>

<!-- ELENCO ARGOMENTI-->
<section class="section section-muted pt-5 pb-5">
	<div class="container p-4">
		<div class="row">
			<div class="col-12">
				<h3 class="mb-3">Esplora per argomento</h3>
				<p>Le FAQ sono organizzate per argomento. Clicca sull'argomento di interesse per visualizzare le domande e
					le
					risposte.</p>
			</div>
		</div>
		<div class="row h-100" role="region" aria-label="Lista argomenti FAQ">
			<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
				<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
					<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5">
						<a target="_self"
							class="CardGeneric_decoration-1__MhYyy flex-grow-1"
							href="faq-elenco-per-argomento.html" data-focus-mouse="false">Argomento 1</a>
					</h4>
					<div class="it-card-body d-flex flex-column pt-0 pb-0 px-0"></div>
				</article>
			</div>

			<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
				<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
					<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5"><a target="_self"
							class="CardGeneric_decoration-1__MhYyy flex-grow-1"
							href="faq-elenco-per-argomento.html" data-focus-mouse="false">Argomento 2</a></h4>
					<div class="it-card-body d-flex flex-column pt-0 pb-0 px-0"></div>
				</article>
			</div>
			<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
				<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
					<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5"><a target="_self"
							class="CardGeneric_decoration-1__MhYyy flex-grow-1"
							href="faq-elenco-per-argomento.html" data-focus-mouse="false">Argomento 3</a></h4>
					<div class="it-card-body d-flex flex-column pt-0 pb-0 px-0"></div>
				</article>
			</div>
			<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
				<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
					<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5"><a target="_self"
							class="CardGeneric_decoration-1__MhYyy flex-grow-1"
							href="faq-elenco-per-argomento.html" data-focus-mouse="false">Argomento 4</a></h4>
					<div class="it-card-body d-flex flex-column pt-0 pb-0 px-0"></div>
				</article>
			</div>
			<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
				<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
					<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5"><a target="_self"
							class="CardGeneric_decoration-1__MhYyy flex-grow-1"
							href="faq-elenco-per-argomento.html" data-focus-mouse="false">Argomento 5</a></h4>
					<div class="it-card-body d-flex flex-column pt-0 pb-0 px-0"></div>
				</article>
			</div>
			<div class="col-12 col-md-6 pt-4 d-flex flex-column justify-content-stretch">
				<article class="it-card--generic it-card pb-0 flex-grow-1 bg-transparent border-bottom border-neutral-1-bg-a3">
					<h4 class="it-card-title fw-semibold pb-3 lh-sm h3 d-flex justify-content-between px-0 h5"><a target="_self"
							class="CardGeneric_decoration-1__MhYyy flex-grow-1"
							href="faq-elenco-per-argomento.html" data-focus-mouse="false">Argomento 6</a></h4>
					<div class="it-card-body d-flex flex-column pt-0 pb-0 px-0"></div>
				</article>
			</div>
		</div>
	</div> <!-- container -->
</section>

<!-- ELENCO DOMANDE PIù FREQUENTI -->
<section class="section pt-5 pb-5">
	<div class="container p-4 pb-0">
		<div class="col-12">
			<h3 class="mb-5">Domande frequenti più cercate</h3>
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
							<p>Argomento 4</p>
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
							<p>Argomento 3</p>
						</a>
					</li>
					<li>
						<span class="divider"></span> 
					</li>
					<li>
						<a class="list-item icon-right" href="scheda-faq.html">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">Titolo faq 1</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use>
								</svg>
							</span>
							<p>Argomento 2</p>
						</a>
					</li>
					<li>
						<span class="divider" role="separator"></span>
					</li>
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
								<h4 class="list-item-title">Titolo faq 1</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use>
								</svg>
							</span>
							<p>Argomento 4</p>
						</a>
					</li>
					<li>
						<span class="divider" role="separator"></span>
					</li>
				</ul>
			</div>     
		</div>
	</div>
</section>

<!-- CALL TO ACTION CONTATTO SERVIZIO HELPDESK -->
<section class="section pt-5 pb-5">
	<div class="container p-4">
		<div class="row">
			<div class="col-12">
				<article class="it-card it-card-banner rounded shadow-sm border">
						<!--card first child is the title (link)-->
						<h3 class="it-card-title ">
							Non hai trovato le risposte che cercavi?
						</h3>
						<!--card second child is the icon (optional)-->
						<div class="it-card-banner-icon-wrapper">
							<svg class="icon icon-secondary icon-xl" aria-hidden="true"><use href="/bootstrap-italia/svg/sprites.svg#it-help-circle"></use></svg>
						</div>
						<!--card body content-->
						<div class="it-card-body">
							<p class="it-card-subtitle">Contatta l'help desk per assistenza tecnica.</p>
						</div>
						<div class="it-card-footer" aria-label="Link correlati:">
							<a class="btn btn-sm btn-primary ms-3" href="helpdesk.html">Richiedi supporto
											<svg class="icon icon-white ms-2">
												<use href="/bootstrap-italia/svg/sprites.svg#it-arrow-right"></use>
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
