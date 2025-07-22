<?php
/** Template Name: Documentation.
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();

?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<!-- SERVIZI -->
		<div class="col">
			<h2 class="pb-2">Documentazione</h2>
			<!-- ELENCO DELLA DOCUMENTAZIONE  -->

			<div class="link-list-wrapper multiline">
				<ul class="link-list">
					<li>
						<a class="list-item active icon-right" href="#">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">Manuale di istruzioni (PDF)</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-file"></use>
								</svg>
							</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit… Lorem ipsum dolor sit amet, consectetur
								adipiscing elit… Lorem ipsum dolor sit amet, consectetur adipiscing elit…</p>
						</a>
					</li>
					<li>
						<span class="divider" role="separator"></span>
					</li>
					<li>
						<a class="list-item icon-right" href="#">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">Collegamento a risorsa esterna</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-link"></use>
								</svg>
							</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit…</p>
						</a>
					</li>
					<li><span class="divider"></span>
					</li>
					<li>
						<a class="list-item active icon-right" href="#">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">Manuale di istruzioni (PDF)</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-file"></use>
								</svg>
							</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit… Lorem ipsum dolor sit amet, consectetur
								adipiscing elit… Lorem ipsum dolor sit amet, consectetur adipiscing elit…</p>
						</a>
					</li>
					<li>
						<span class="divider" role="separator"></span>
					</li>
					<li>
						<a class="list-item icon-right" href="#">
							<span class="list-item-title-icon-wrapper">
								<h4 class="list-item-title">Collegamento a risorsa esterna</h4>
								<svg class="icon icon-primary">
									<title>Codice</title>
									<use href="/bootstrap-italia/svg/sprites.svg#it-link"></use>
								</svg>
							</span>
							<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit…</p>
						</a>
					</li>
					<li><span class="divider"></span>
					</li>
				</ul>
				<nav class="pagination-wrapper  justify-content-center" aria-label="Esempio di navigazione con page changer">
					<ul class="pagination">
						<li class="page-item">
							<a class="page-link" href="#">
								<svg class="icon icon-primary">
									<use href="/bootstrap-italia/svg/sprites.svg#it-chevron-left"></use>
								</svg>
								<span class="visually-hidden">Pagina precedente</span>
							</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">1</a></li>

						<li class="page-item active">
							<a class="page-link" href="#" aria-current="page">
								<span class="d-inline-block d-sm-none">Pagina </span>26
							</a>
						</li>
						<li class="page-item"><a class="page-link" href="#">27</a></li>
						<li class="page-item"><a class="page-link" href="#">28</a></li>
						<li class="page-item"><span class="page-link">...</span></li>
						<li class="page-item"><a class="page-link" href="#">50</a></li>
						<li class="page-item">
							<a class="page-link" href="#">
								<span class="visually-hidden">Pagina successiva</span>
								<svg class="icon icon-primary">
									<use href="/bootstrap-italia/svg/sprites.svg#it-chevron-right"></use>
								</svg>
							</a>
						</li>
					</ul>
					<div class="dropdown">
						<button class="btn btn-dropdown dropdown-toggle" type="button" id="pagerChanger" data-bs-toggle="dropdown"
							aria-haspopup="true" aria-expanded="false" aria-label="Salta alla pagina">
							10/pagina
							<svg class="icon icon-primary icon-sm">
								<use href="/bootstrap-italia/svg/sprites.svg#it-expand"></use>
							</svg>
						</button>
						<div class="dropdown-menu" aria-labelledby="pagerChanger">
							<div class="link-list-wrapper">
								<ul class="link-list">
									<li><a class="list-item active" href="#" aria-current="page"><span>20/pagina</span></a></li>
									<li><a class="dropdown-item list-item" href="#"><span>50/pagina</span></a></li>
									<li><a class="dropdown-item list-item" href="#"><span>100/pagina</span></a></li>
								</ul>
							</div>
						</div>
					</div>
				</nav>

			</div>

		</div>
		<!-- SIDEBAR ELENCO -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				<div class="form-group">
					<div class="input-group">
						<span class="input-group-text"><svg class="icon icon-sm" aria-hidden="true">
								<use href="/bootstrap-italia/svg/sprites.svg#it-search"></use>
							</svg></span>
						<label for="input-group-3">Cerca nella documentazione</label>
						<input type="text" class="form-control" id="input-group-3" name="input-group-3">
						<div class="input-group-append">
							<button class="btn btn-primary" type="button" id="button-3"><a href="documentazione-risultati-ricerca.html" class="text-white">Cerca</a></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
  </div>

<?php
get_footer();
