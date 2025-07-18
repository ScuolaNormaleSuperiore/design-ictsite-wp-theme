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
			<h2 class="pb-2">Helpdesk</h2>
			<div class="p-5">
				<p>
					Prima di contattare direttamente il supporto tecnico, ti invitiamo gentilmente a seguire questi passaggi:
				</p>

				<ol>
					<li><strong>Consulta le FAQ</strong><br>
						Le risposte ai problemi più comuni sono disponibili nella sezione delle
						<a href="#">FAQ</a> e possono aiutarti a risolvere autonomamente molte situazioni.
					</li>
					<li><strong>Verifica la documentazione</strong><br>
						La documentazione tecnica e le guide operative sono costantemente aggiornate e contengono informazioni
						dettagliate su procedure, configurazioni e strumenti disponibili.
					</li>
				</ol>

				<p>
					Se, dopo aver consultato le risorse sopra indicate, <strong>non hai trovato una risposta al tuo
						problema</strong>, puoi contattare il nostro team di supporto tramite uno dei seguenti canali:
				</p>

				<ul>
					<li><strong>Telefono</strong>: <a href="tel:NUMERO_SUPPORTO">+39 050 6133533</a><br>
						</li>
					<li> <strong>Email</strong>: <a href="mailto:helpdesk@sns.it">helpdesk@sns.it</a></li>
				</ul>
<p>L'helpdesk è disponibile <strong>dal lunedì al venerdì in orario di ufficio</strong>:</p>
						<ul style="list-style-type: none; padding-left: 1em;">
							<li><strong>Mattina</strong>: 9:00 – 13:00</li>
							<li><strong>Pomeriggio</strong>: 14:00 – 17:00</li>
						</ul>
					
				<p>
					Ti chiediamo cortesemente, nel caso di contatto via email, di includere <strong>tutte le informazioni utili
						per l’identificazione del problema</strong>, come ad esempio:
				</p>

				<ul>
					<li>Il tuo nome e cognome</li>
					<li>Il tipo di dispositivo o servizio coinvolto</li>
					<li>Una descrizione sintetica ma chiara del problema</li>
					<li>Eventuali messaggi di errore visualizzati</li>
					<li>Da quando si verifica il problema</li>
				</ul>

				<p>
					Queste informazioni ci aiuteranno a fornirti un’assistenza più rapida ed efficace.<br>
					Grazie per la collaborazione.
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
							<li><a class="list-item medium" href="faq.html"><span>FAQ</span></a>
							</li>
							<li><a class="list-item medium" href="documentazione.html"><span>Documentazione</span></a>
							</li>

						</ul>
					</div>
				</div>


			</div>
		</div>
	</div>
</div>


</div>


<?php
get_footer();
