
document.addEventListener('DOMContentLoaded', function() {

	// Accedi al modulo Algolia Autocomplete.
	const algoliaModule = window['@algolia/autocomplete-js'];

	if (!algoliaModule) {
		console.error('Modulo Algolia Autocomplete non trovato');
		return;
	}

	// Verifica che esista l'elemento container.
	const container = document.querySelector('#home_search_autocomplete');
	if (!container) {
		console.error('Elemento #autocomplete non trovato nel DOM');
		return;
	}

	// const links = [
	// 	{ text: 'Sito SNS', link: 'https://www.sns.it' },
	// 	{ text: 'Sito Corriere', link: 'https://www.corriere.it' },
	// 	{ text: 'Sito Gazzetta', link: 'https://www.gazzetta.it' },
	// 	{ text: 'Sito Tuttosport', link: 'https://www.tuttosport.com' }
	// ];


	const ajaxUrl  = 'http://sitoict.local/wp-admin/admin-ajax.php';
	const nonce    = '123';
	const minChars = 3;
	// Algolia Autocomplete.
	algoliaModule.autocomplete({
		container:   '#home_search_autocomplete',
		placeholder: 'Cerca un sito...',
		openOnFocus: true,
		debounce:    300,
		getSources() {
			return [
				{
					sourceId: 'links',
          getItems: async ({ query }) => {
						if (query.length < minChars) return [];
            try {
							console.log('**Query:', query);
              const response = await fetch(ajaxUrl, {
                method: 'POST',
                headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
                body: new URLSearchParams({
                  action: 'theme_autocomplete',
                  nonce: nonce,
                  q: query
                }).toString(),
              });
              if (!response.ok) throw new Error('Errore nella risposta AJAX');
              const items = await response.json();
              return items; // array di { text, link }
            } catch (error) {
              console.error('Errore durante la richiesta AJAX:', error);
              return []; // in caso di errore ritorna array vuoto
            }
          },
					templates: {
						item({ item, html }) {
							// Usa la funzione html fornita da Algolia per il template
							return html`<div class="aa-ItemWrapper">
								<div class="aa-ItemContent">
									<div class="aa-ItemTitle">
										<a href="${item.link}" style="text-decoration: underline; color: #0073aa; padding: 8px 12px; display: block;">
											${item.text}
										</a>
									</div>
								</div>
							</div>`;
						}
					},
					// Gestisci il click sugli elementi
					onSelect({ item, event }) {
						// Il link si aprirà automaticamente nella stessa pagina
						// Non serve fare nulla qui se usi il tag <a> normale
						window.location.href = item.link;
					}
				}
			];
		}
	});

});
