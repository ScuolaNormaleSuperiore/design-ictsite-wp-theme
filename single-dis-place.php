<?php
/**
 * Detail page for the post-type: dis-place.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_ICT_Site
 */
global $post;
get_header();

$short_description = DIS_CustomFieldsManager::get_field( 'short_description', $post->ID );
$image_data        = DIS_ContentsManager::get_image_metadata( $post, 'full', '/assets/img/default-background.png' );
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<!-- LUOGHI -->
		<div class="col">
			<h2 class="pb-2">Nome del luogo</h2>
			<!-- RISULTATI DI UNA RICERCA PER FAQ -->

			<!-- DESCRIZIONE -->	
			<div class="row pb-3">
				<h3 class="it-page-section h4 visually-hidden" id="descrizione">Descrizione</h3>
				<p>{Descrizione estesa} Proin placerat ipsum massa, ac commodo velit tempor quis. In ante augue, sodales ac rhoncus in, ultricies a neque. Morbi non semper felis, at lacinia nibh. Nam quis elit massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam laoreet, diam quis blandit porttitor, leo erat semper sem, vel sagittis dolor quam eu magna. Nunc feugiat pretium tempor. Nam eget augue quis tellus viverra malesuada vel ut quam. Cras vehicula rutrum
				vehicula. Suspendisse efficitur eget purus vitae convallis. Integer euismod pharetra lorem, non ullamcorper lorem euismod vel. Orci varius natoque
				penatibus et magnis dis parturient montes, nascetur ridiculus mus.
				</p>
			</div>

			<!-- COME RAGGIUNGERCI -->	
			<div class="row pb-3">
				<h3 class="it-page-section h4" id="comeraggiungerci">Come raggiungerci</h3>
				<p>{come raggiungerci} Proin placerat ipsum massa, ac commodo velit tempor quis. In ante augue, sodales ac rhoncus in, ultricies a neque. Morbi non semper felis, at lacinia nibh. Nam quis elit massa. Interdum et malesuada fames ac ante ipsum primis in faucibus. Aliquam laoreet, diam quis blandit porttitor, leo erat semper sem, vel sagittis dolor quam eu magna. Nunc feugiat pretium tempor. Nam eget augue quis tellus viverra malesuada vel ut quam. Cras vehicula rutrum
						vehicula. Suspendisse efficitur eget purus vitae convallis. Integer euismod pharetra lorem, non ullamcorper lorem euismod vel. Orci varius natoque
						penatibus et magnis dis parturient montes, nascetur ridiculus mus.
				</p>
			</div> 
		</div>

		<!-- SIDEBAR ELENCO -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side ps-4">
				<div class="it-list-wrapper">
					<ul class="it-list">
						<li class="list-item">
								<div class="it-right-zone">
									<span class="text">Piazza dei Cavalieri 67, 56126, Pisa PI</span>
									<svg class="icon">
										<title>Indirizzo</title>
										<use href="/bootstrap-italia/svg/sprites.svg#it-map-marker"></use>
									</svg>
								</div>
							</li>
							<li class="list-item">
								<div class="it-right-zone">
									<span class="text">dalle 09:00 alle 12:00<br>
																									dalle 14:30 alle 16:30</span>
									<svg class="icon">
										<title>Orario</title>
										<use href="/bootstrap-italia/svg/sprites.svg#it-clock"></use>
									</svg>
								</div>
							</li>  
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
	</div> <!-- row -->

	<!-- MAP  -->
	<div class="row mb-5">
		<h3 id="posizione" class="it-page-section h4 visually-hidden">Posizione</h3>  
		<!--start card-->
		<div class="card-wrapper">
			<div class="card card-img no-after">
				<div class="img-responsive-wrapper">
					<div class="img-responsive">
						<figure class="img-wrapper">
							<img src="bootstrap-italia/assets/map-placeholder-big.png" title="titolo immagine" alt="descrizione immagine"> 
								<!-- capire come gestire mappa  con placeholder -->
						</figure>
					</div>
				</div>
				
			</div>
		</div>
		<!--end card-->
	</div> <!--end row-->

</div>  <!-- container -->



<?php
get_footer();
