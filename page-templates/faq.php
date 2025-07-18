<?php
/* Template Name: Faq
*
* @package Design_ICT_Site
*/

global $post;
get_header();

$items = DIS_ContentsManager::get_generic_post_list( DIS_FAQ_POST_TYPE );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<!-- SERVIZI -->
		<div class="col">
			<h2 class="pb-2">FAQ - Frequently Asked Questions</h2>
			<!-- ELENCO DELLE FAQ ORGANIZZATE PER ARGOMENTO (corrisponde alla categoria Argomento negli oggetti di tipo FAQ) visualizzati con una struttura di accordion annidati 
ref https://italia.github.io/bootstrap-italia/docs/componenti/accordion/#accordion-annidati -->
			<div class="accordion" id="Argomento1">
				<div class="accordion-item">
					<h3 class="accordion-header " id="heading1a">
						<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse1a"
							aria-expanded="true" aria-controls="collapse1a">
							Argomento 1
						</button>
					</h3>
					<div id="collapse1a" class="accordion-collapse collapse show" data-bs-parent="#accordionExample2"
						role="region" aria-labelledby="heading1a">
						<div class="accordion-body">
							<div class="accordion" id="accordionExample2N">
								<div class="accordion-item">
									<h4 class="accordion-header " id="heading1n">
										<button class="accordion-button" type="button" data-bs-toggle="collapse"
											data-bs-target="#collapse1n" aria-expanded="true" aria-controls="collapse1n">
											Elemento Accordion annidato #1
										</button>
									</h4>
									<div id="collapse1n" class="accordion-collapse collapse show" data-bs-parent="#accordionExample2N"
										role="region" aria-labelledby="heading1n">
										<div class="accordion-body">
											Vestibulum hendrerit ultrices nibh, sed pharetra lacus ultrices eget. Morbi et ipsum et sapien
											dapibus facilisis. Integer eget semper nibh. Proin enim nulla, egestas ac rutrum eget,
											ullamcorper nec turpis.
										</div>
									</div>
								</div>
								<div class="accordion-item">
									<h4 class="accordion-header " id="heading2n">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
											data-bs-target="#collapse2n" aria-expanded="false" aria-controls="collapse2n">
											Elemento Accordion annidato #2
										</button>
									</h4>
									<div id="collapse2n" class="accordion-collapse collapse" data-bs-parent="#accordionExample2N"
										role="region" aria-labelledby="heading2n">
										<div class="accordion-body">
											Vestibulum hendrerit ultrices nibh, sed pharetra lacus ultrices eget. Morbi et ipsum et sapien
											dapibus facilisis. Integer eget semper nibh. Proin enim nulla, egestas ac rutrum eget,
											ullamcorper nec turpis.
										</div>
									</div>
								</div>
								<div class="accordion-item">
									<h4 class="accordion-header " id="heading3n">
										<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
											data-bs-target="#collapse3n" aria-expanded="false" aria-controls="collapse3n">
											Elemento Accordion annidato #3
										</button>
									</h4>
									<div id="collapse3n" class="accordion-collapse collapse" data-bs-parent="#accordionExample2N"
										role="region" aria-labelledby="heading3n">
										<div class="accordion-body">
											Vestibulum hendrerit ultrices nibh, sed pharetra lacus ultrices eget. Morbi et ipsum et sapien
											dapibus facilisis. Integer eget semper nibh. Proin enim nulla, egestas ac rutrum eget,
											ullamcorper nec turpis.
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h3 class="accordion-header " id="Argomento2">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse2a" aria-expanded="false" aria-controls="collapse2a">
							Argomento 2
						</button>
					</h3>
					<div id="collapse2a" class="accordion-collapse collapse" data-bs-parent="#accordionExample2" role="region"
						aria-labelledby="heading2a">
						<div class="accordion-body">
							Vestibulum hendrerit ultrices nibh, sed pharetra lacus ultrices eget. Morbi et ipsum et sapien dapibus
							facilisis. Integer eget semper nibh. Proin enim nulla, egestas ac rutrum eget, ullamcorper nec turpis.
						</div>
					</div>
				</div>
				<div class="accordion-item">
					<h3 class="accordion-header " id="Argomento3">
						<button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
							data-bs-target="#collapse3a" aria-expanded="false" aria-controls="collapse3a">
							Argomento 3
						</button>
					</h3>
					<div id="collapse3a" class="accordion-collapse collapse" data-bs-parent="#accordionExample2" role="region"
						aria-labelledby="heading3a">
						<div class="accordion-body">
							Vestibulum hendrerit ultrices nibh, sed pharetra lacus ultrices eget. Morbi et ipsum et sapien dapibus
							facilisis. Integer eget semper nibh. Proin enim nulla, egestas ac rutrum eget, ullamcorper nec turpis.
						</div>
					</div>
				</div>
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
						<label for="input-group-3">Cerca nelle FAQ</label>
						<input type="text" class="form-control" id="input-group-3" name="input-group-3">
						<div class="input-group-append">
							<button class="btn btn-primary" type="button" id="button-3"><a href="faq-risultati-ricerca.html" class="text-white">Cerca</a></button>
						</div>
					</div>
				</div>
				<div class="sidebar-linklist-wrapper">
					<div class="link-list-wrapper">
						<ul class="link-list">
							<li>
								<h3>Naviga per argomento</h3>
							</li>
							<li><a class="list-item medium active" href="#Argomento1"><span>Argomento 1</span></a>
							</li>
							<li><a class="list-item medium" href="#Argomento2"><span>Argomento 2</span></a>
							</li>
							<li><a class="list-item medium" href="#Argomento3"><span>Argomento 3</span></a>
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
