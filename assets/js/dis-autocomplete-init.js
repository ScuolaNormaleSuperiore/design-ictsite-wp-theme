
document.addEventListener('DOMContentLoaded', function() {

	// Access the module Algolia Autocomplete.
	const algoliaModule = window['@algolia/autocomplete-js'];

	if (!algoliaModule) {
		console.error('Algolia Autocomplete Module not found');
		return;
	}

	// check that the HOME SEARCH container element exists.
	const home_container = document.querySelector('#home_search_autocomplete');
	if (home_container) {
		// Receiving parameters from PHP.
		const ajaxUrl        = disHpAutocompleteAjax.ajaxUrl;
		const nonce          = disHpAutocompleteAjax.nonce;
		const searchLabel    = disHpAutocompleteAjax.searchLabel;
		const noResultString = disHpAutocompleteAjax.noResultString;
		const minChars = 3;

		// Algolia Autocomplete.
		algoliaModule.autocomplete({
			container:   '#home_search_autocomplete',
			placeholder: searchLabel,
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
										selector: 'home_search_autocomplete',
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
							},
							noResults({ state, html }) {
								return html`<div class="aa-ItemWrapper">
									<div class="aa-ItemContent">
										<div class="aa-ItemTitle" style="padding: 8px 12px; color: #888;">
											${noResultString} "<strong>${state.query}</strong>"
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
			},
			onSubmit({ state }) {
				const query = state.query.trim();
				if (query) {
					const form = document.getElementById('hero_search_form');
					if (form) {
						// opzionale: assicurati che ci sia un input con name="q"
						let input = form.querySelector('input[name="search_string"]');
						if (!input) {
							input = document.createElement('input');
							input.type = 'hidden';
							input.name = 'search_string';
							form.appendChild(input);
						}
						input.value = query;
						form.submit();
					}
				}
			}
		});
	}

	// check that the FAQ SEARCH container element exists.
	const faq_container = document.querySelector('#faq_search_autocomplete');
	if (faq_container) {
		// Receiving parameters from PHP.
		const ajaxUrl        = disHpAutocompleteAjax.ajaxUrl;
		const nonce          = disHpAutocompleteAjax.nonce;
		const searchLabel    = disHpAutocompleteAjax.searchLabel;
		const noResultString = disHpAutocompleteAjax.noResultString;
		const minChars = 3;

		// Algolia Autocomplete.
		algoliaModule.autocomplete({
			container:   '#faq_search_autocomplete',
			placeholder: searchLabel,
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
										selector: 'faq_search_autocomplete',
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
							},
							noResults({ state, html }) {
								return html`<div class="aa-ItemWrapper">
									<div class="aa-ItemContent">
										<div class="aa-ItemTitle" style="padding: 8px 12px; color: #888;">
											${noResultString} "<strong>${state.query}</strong>"
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
	}

});
