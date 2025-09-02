
document.addEventListener('DOMContentLoaded', function() {

	// Access the module Algolia Autocomplete.
	const algoliaModule = window['@algolia/autocomplete-js'];

	if (!algoliaModule) {
		console.error('Algolia Autocomplete Module not found');
		return;
	}

	// check that the container element exists.
	const container = document.querySelector('#home_search_autocomplete');
	if (!container) {
		console.error('Element #home_search_autocomplete not present in DOM');
		return;
	}


	// Get parameters from
	const ajaxUrl     = disHpAutocompleteAjax.ajaxUrl;
	const nonce       = disHpAutocompleteAjax.nonce;
	const searchLabel = disHpAutocompleteAjax.searchLabel;

	const minChars = 3;
	// Algolia Autocomplete.
	algoliaModule.autocomplete({
		container:   '#home_search_autocomplete',
		placeholder: searchLabel + '...',
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
							if (!response.ok) throw new Error('Error in AJAX response');
							const items = await response.json();
							return items;
						} catch (error) {
							console.error('Error in AJAX request:', error);
							return []; // in caso di errore ritorna array vuoto
						}
					},
					templates: {
						item({ item, html, state }) {
							// Usa la funzione html fornita da Algolia per il template.
							const query = state.query.trim();
							let highlightedText = item.name;

							if (query.length > 0) {
								// Crea una RegExp case-insensitive per evidenziare la query
								const regex = new RegExp(`(${query.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&')})`, 'gi');
								highlightedText = item.name.replace(regex, '<mark>$1</mark>');
								objectType = `(<small>${item.type}</small>)`;
							}
							return html`<div class="aa-ItemWrapper">
								<div class="aa-ItemContent">
									<div class="aa-ItemTitle">
										<a href="${item.link}" style="text-decoration: underline; color: #3674B3; padding: 8px 12px; display: block;">
											${html([highlightedText])} ${html([objectType])}
										</a>
									</div>
								</div>
							</div>`;
						}
					},
					// Manage the click on each element.
					onSelect({ item, event }) {
						window.location.href = item.link;
					}
				}
			];
		}
	});

});
