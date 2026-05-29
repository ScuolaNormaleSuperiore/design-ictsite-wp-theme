
/**
 * Escape a string for safe insertion as HTML text content.
 *
 * @param {*} value Raw value coming from the AJAX endpoint.
 * @return {string} HTML-escaped string.
 */
function escapeHtml(value) {
	return String(value ?? '')
		.replace(/&/g, '&amp;')
		.replace(/</g, '&lt;')
		.replace(/>/g, '&gt;')
		.replace(/"/g, '&quot;')
		.replace(/'/g, '&#39;');
}

/**
 * HTML-escape a text, then wrap the (case-insensitive) query matches in <mark>.
 * The text is escaped first, so the only HTML injected afterwards is the <mark> wrapper.
 *
 * @param {*} text  Raw text to display.
 * @param {string} query Trimmed search query.
 * @return {string} Safe HTML string with highlighted matches.
 */
function highlightQuery(text, query) {
	const escapedText = escapeHtml(text);
	if (!query) {
		return escapedText;
	}
	// Escape the query the same way as the text, then escape regex metacharacters,
	// so matching stays consistent with the already-escaped text.
	const escapedQuery = escapeHtml(query).replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&');
	const regex = new RegExp(`(${escapedQuery})`, 'gi');
	return escapedText.replace(regex, '<mark>$1</mark>');
}

/**
 * Allow only http(s) absolute URLs or site-relative URLs; otherwise return '#'.
 * Blocks dangerous schemes such as javascript: or data:.
 *
 * @param {*} url Raw URL coming from the AJAX endpoint.
 * @return {string} A safe URL.
 */
function safeUrl(url) {
	const value = String(url ?? '').trim();
	if (/^\//.test(value) || /^https?:\/\//i.test(value)) {
		return value;
	}
	return '#';
}

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
		const ajaxUrl     = disHpAutocompleteAjax.ajaxUrl;
		const nonce       = disHpAutocompleteAjax.nonce;
		let searchLabel = '';
		const params        = new URLSearchParams(window.location.search);
		if (params.has("search_string")) {
 			searchLabel = params.get("search_string").trim()
		} else {
			searchLabel    = disHpAutocompleteAjax.searchLabel;
		}
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
								// console.log('** home_search_autocomplete - Query:', query);
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
								// console.log('** home_search_autocomplete - Results:', items);
								return items;
							} catch (error) {
								console.error('Error in AJAX request:', error);
								return [];
							}
						},
						templates: {
							item({ item, html, state }) {
								// Use the html function provided by Algolia for the template.
								const query = state.query.trim();
								// Escape the raw values, then highlight the query matches.
								const highlightedName = highlightQuery(item.name, query);
								const highlightedText = highlightQuery(item.text, query);
								const objectType = `<small style="text-transform: uppercase">${escapeHtml(item.type)}</small>`;

								return html`<div class="aa-ItemWrapper">
									<div class="aa-ItemContent">
										<div class="aa-ItemTitle" style="padding: 8px 12px;">
											<a href="${safeUrl(item.link)}" style="text-decoration: underline; color: #3674B3; display: block;"
												dangerouslySetInnerHTML=${{ __html: highlightedName }}></a>
											<small dangerouslySetInnerHTML=${{ __html: highlightedText }}></small><br/>
											<small dangerouslySetInnerHTML=${{ __html: objectType }}></small>
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
							window.location.href = safeUrl(item.link);
						}
					}
				];
			},
			onSubmit({ state }) {
				const query = state.query.trim();
				if (query) {
					const form = document.getElementById('main_search_form');
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
								// console.log('**Query:', query);
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
								return [];
							}
						},
						templates: {
							item({ item, html, state }) {
								// Use the html function provided by Algolia for the template.
								const query = state.query.trim();
								// Escape the raw values, then highlight the query matches.
								const highlightedName = highlightQuery(item.name, query);
								const highlightedText = highlightQuery(item.text, query);

								return html`<div class="aa-ItemWrapper">
									<div class="aa-ItemContent">
										<div class="aa-ItemTitle" style="padding: 8px 12px;">
											<a href="${safeUrl(item.link)}" style="text-decoration: underline; color: #3674B3; display: block;"
												dangerouslySetInnerHTML=${{ __html: highlightedName }}></a>
											<small dangerouslySetInnerHTML=${{ __html: highlightedText }}></small>
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
							window.location.href = safeUrl(item.link);
						}
					}
				];
			}
		});
	}

	// check that the Documentation SEARCH container element exists.
	const doc_container = document.querySelector('#doc_search_autocomplete');
	if (doc_container) {
		// Receiving parameters from PHP.
		const ajaxUrl        = disHpAutocompleteAjax.ajaxUrl;
		const nonce          = disHpAutocompleteAjax.nonce;
		const searchLabel    = disHpAutocompleteAjax.searchLabel;
		const noResultString = disHpAutocompleteAjax.noResultString;
		const minChars = 3;

		// Algolia Autocomplete.
		algoliaModule.autocomplete({
			container:   '#doc_search_autocomplete',
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
								// console.log('**Query:', query);
								const response = await fetch(ajaxUrl, {
									method: 'POST',
									headers: { 'Content-Type': 'application/x-www-form-urlencoded' },
									body: new URLSearchParams({
										action: 'theme_autocomplete',
										nonce: nonce,
										selector: 'doc_search_autocomplete',
										q: query
									}).toString(),
								});
								if (!response.ok) throw new Error('Error in AJAX response');
								const items = await response.json();
								return items;
							} catch (error) {
								console.error('Error in AJAX request:', error);
								return [];
							}
						},
						templates: {
							item({ item, html, state }) {
								// Use the html function provided by Algolia for the template.
								const query = state.query.trim();
								// Escape the raw values, then highlight the query matches.
								const highlightedName = highlightQuery(item.name, query);
								const highlightedText = highlightQuery(item.text, query);

								return html`<div class="aa-ItemWrapper">
									<div class="aa-ItemContent">
										<div class="aa-ItemTitle" style="padding: 8px 12px;">
											<a target="_blank" rel="noopener noreferrer" href="${safeUrl(item.link)}" style="text-decoration: underline; color: #3674B3; display: block;"
												dangerouslySetInnerHTML=${{ __html: highlightedName }}></a>
											<small dangerouslySetInnerHTML=${{ __html: highlightedText }}></small>
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
							window.location.href = safeUrl(item.link);
						}
					}
				];
			},
			onSubmit({ state }) {
				const query = state.query.trim();
				if (query) {
					const form = document.getElementById('doc_search_form');
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

});
