<?php
/**
 * Page template
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Design_ICT_Site
 */

global $post;
get_header();
?>

<div class="container shadow rounded  p-4 pt-3 pb-3 mb-5">
	<div class="row">
		<!-- CONTENUTO PAGINA BASE -->
		<div class="col">
			<h2 class="pb-2">Titolo pagina base di primo livello</h2>
			<div class="p-5">
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin nec nisi ac metus ornare ullamcorper vitae
					eget neque. Sed efficitur mauris in urna finibus, a luctus purus consectetur. Morbi lectus enim, porta non
					hendrerit eget, finibus eu odio. Phasellus sit amet hendrerit orci. Etiam eget leo sed lectus vehicula
					consequat. Curabitur tincidunt massa sit amet neque vulputate, quis imperdiet ex euismod. In eget finibus
					nunc. Donec gravida magna laoreet commodo porta. Curabitur vehicula suscipit leo eu imperdiet. Nullam sit amet
					ornare ipsum, id interdum leo. Vivamus non nibh sed urna consectetur placerat.
				</p>
				<h3>Titolo paragrafo h3</h3>
				<p>Nam pretium neque quis odio eleifend pellentesque. Nam fermentum condimentum metus et tristique. Praesent
					odio justo, commodo sit amet eleifend id, scelerisque ac leo. Mauris id justo leo. Vestibulum nec euismod est.
					Proin ex nibh, consequat et rutrum eget, dictum in felis. Sed feugiat euismod libero, id porttitor sapien
					ullamcorper nec.
				</p>
				<h4>Titolo paragrafo H3</h4>
				<p>
					Sed pulvinar congue odio vitae elementum. Pellentesque laoreet lobortis dolor, vitae bibendum ante semper at.
					Nunc accumsan nunc a diam dictum, dapibus varius magna volutpat. Fusce sed nisl at quam pretium auctor. Donec
					aliquam dolor at lobortis finibus. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla hendrerit
					nisi ac aliquet lobortis. Nullam tristique a turpis nec malesuada. Etiam et finibus sem. Sed in odio lorem.
					Phasellus lobortis condimentum erat. Duis interdum eleifend mi, hendrerit facilisis lacus hendrerit a. Ut ut
					lobortis eros, nec ultrices augue. Curabitur ut purus orci.
				</p>
				<p>
					Vivamus sollicitudin augue a odio mattis aliquet. Aliquam mollis elit ac sapien fermentum tempus. Sed mollis,
					metus vitae mollis egestas, lorem tellus bibendum lorem, vel luctus nisi odio eu odio. Praesent felis augue,
					porttitor et sagittis in, bibendum non enim. Sed lacinia, felis ut pulvinar vestibulum, felis felis viverra
					lorem, id consequat neque nunc ac tortor. Duis imperdiet, nisi ac scelerisque tincidunt, urna ipsum venenatis
					ante, eget accumsan justo mi ut lorem. Nulla euismod, turpis eget sagittis placerat, risus justo efficitur
					neque, eu porta purus tortor nec eros. Nam ut lorem nisi. Phasellus ornare dignissim luctus. Quisque ornare
					lacinia neque, quis ullamcorper libero euismod finibus. Sed rhoncus urna orci, ut dictum nulla volutpat in.
					Donec vel fermentum risus.
				</p>
				<p>
					Phasellus mollis mollis lorem vel facilisis. Phasellus ultricies, metus ut finibus lacinia, dolor sem egestas
					ante, a auctor turpis lorem ut lorem. Nulla tellus erat, imperdiet at viverra id, malesuada in enim. Nunc
					cursus diam vel molestie malesuada. Phasellus nec risus molestie purus mollis lobortis. Duis auctor lorem
					congue erat consectetur scelerisque. Morbi posuere tristique augue. Mauris imperdiet rutrum iaculis.
					Suspendisse sagittis ligula id enim vehicula, at condimentum enim elementum. Aliquam erat volutpat. Aliquam eu
					lectus sagittis, lobortis elit a, commodo ex.
				</p>
			</div>
		</div>
		<!-- SIDEBAR ELENCO -->
		<div class="col-12 col-lg-4 col-md-5">
			<div class="sidebar-wrapper it-line-left-side">
				
				<div class="sidebar-linklist-wrapper">
					<div class="link-list-wrapper">
						<ul class="link-list">
							<li>
								<h3>Pagine collegate</h3>
							</li>
							<li><a class="list-item medium" href="paginabase-secondolivello.html"><span>Pagina secondo livello</span></a>
							</li>
						<li><a class="list-item medium" href="paginabase-secondolivello.html"><span>Pagina secondo livello</span></a>
							</li>
						
						</ul>
					</div>
				</div>


			</div>
		</div>
	</div>
</div>
<!-- BLOCCO POST CORRELATI (visibile se sono impostate le relazioni) -->
<section id="blocco-events" class="section pt-5 pb-3">
	<div class="section-content">
		<div class="container">
			<h2 class="pb-4">Contenuti correlati</h2>
			<div class="row">
				<div class="col-12 col-lg-4">
					<!--start it-card-->
	<article class="it-card it-card-image it-card-height-full">
		<!--card first child is the title (link)-->
		<h3 class="it-card-title ">
			<a href="scheda-news.html">Introduzione di un processo semplificato per le richieste di componenti aggiuntivi e plugin M365</a>
		</h3>
		<!--card second child is the image (optional)-->
		<div class="it-card-image-wrapper">
			<div class="ratio ratio-16x9">
				<figure class="figure img-full">
					<img src="https://uit.stanford.edu/sites/default/files/styles/news_feature/public/Plugin%20%281200%20x%20800%20px%29.png?itok=NdPamHCX" alt="Inserire la descrizione caricata in wordpress insieme all'immagine, altrimente lasciare immagine decorativa">
				</figure>
			</div>
		</div>
		<!--card body content-->
		<div class="it-card-body">
			<p class="it-card-text">Questo è un testo breve (che può non esistere) che riassume il contenuto della pagina di destinazione in massimo tre o quattro righe, senza troncamento.</p>
		</div>
		<!--finally the card footer metadata-->
		<footer class="it-card-related it-card-footer">
			<div class="it-card-taxonomy">
				<a href="#" class="it-card-category it-card-link link-secondary"><span class="visually-hidden">Categoria correlata: </span>APPICATIVI</a>
			</div>
			<time class="it-card-date" datetime="2025-04-22">3 luglio 2025</time>
		</footer>
	</article>
	<!--end it-card-->
				</div>
				<div class="col-12 col-lg-4">
					<!--start it-card-->
	<article class="it-card it-card-image it-card-height-full">
		<!--card first child is the title (link)-->
		<h3 class="it-card-title ">
			<a href="scheda-news.html">Aggiornamenti alle impostazioni di sottotitoli e trascrizione in Teams</a>
		</h3>
		<!--card second child is the image (optional)-->
		<div class="it-card-image-wrapper">
			<div class="ratio ratio-16x9">
				<figure class="figure img-full">
					<img src="https://uit.stanford.edu/sites/default/files/styles/news_feature/public/Zoom%20Settings%20%281%29.png?itok=SspZboB7" alt="Inserire la descrizione caricata in wordpress insieme all'immagine, altrimente lasciare immagine decorativa">
				</figure>
			</div>
		</div>
		<!--card body content-->
		<div class="it-card-body">
			<p class="it-card-text">Questo è un testo breve (che può non esistere) che riassume il contenuto della pagina di destinazione in massimo tre o quattro righe, senza troncamento.</p>
		</div>
		<!--finally the card footer metadata-->
		<footer class="it-card-related it-card-footer">
			<div class="it-card-taxonomy">
				<a href="#" class="it-card-category it-card-link link-secondary"><span class="visually-hidden">Categoria correlata: </span>In evidenza</a>
			</div>
			<time class="it-card-date" datetime="2025-04-22">3 luglio 2025</time>
		</footer>
	</article>
	<!--end it-card-->
				</div>
				<div class="col-12 col-lg-4">
					<!--start it-card-->
	<article class="it-card it-card-image it-card-height-full">
		<!--card first child is the title (link)-->
		<h3 class="it-card-title ">
			<a href="scheda-news.html">Avviso di phishing: gli aggressori utilizzano le app di Google Workspace per rubare le credenziali</a>
		</h3>
		<!--card second child is the image (optional)-->
		<div class="it-card-image-wrapper">
			<div class="ratio ratio-16x9">
				<figure class="figure img-full">
					<img src="https://uit.stanford.edu/sites/default/files/styles/news_feature/public/phishing%20scam.png?itok=gF99QNx6" alt="Inserire la descrizione caricata in wordpress insieme all'immagine, altrimente lasciare immagine decorativa">
				</figure>
			</div>
		</div>
		<!--card body content-->
		<div class="it-card-body">
			<p class="it-card-text">Questo è un testo breve (che può non esistere) che riassume il contenuto della pagina di destinazione in massimo tre o quattro righe, senza troncamento.</p>
		</div>
		<!--finally the card footer metadata-->
		<footer class="it-card-related it-card-footer">
			<div class="it-card-taxonomy">
				<a href="#" class="it-card-category it-card-link link-secondary"><span class="visually-hidden">Categoria correlata: </span>Sicurezza informatica</a>
			</div>
			<time class="it-card-date" datetime="2025-04-22">3 luglio 2025</time>
		</footer>
	</article>
	<!--end it-card-->
				</div>

			</div>
			<div class="text-center pt-5 pb-5"> <a href="elenco-news.html" class="btn btn-secondary">Tutte le news</a> </div>
		</div>
	</div>
</section>
<!-- END CONTENT -->

<?php
get_footer();
