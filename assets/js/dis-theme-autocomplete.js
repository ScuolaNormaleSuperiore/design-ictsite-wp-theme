// js/theme-autocomplete.js
(function () {
	'use strict';

	// debounce helper
	function debounce(fn, wait) {
		var t;
		return function () {
			var args = arguments;
			clearTimeout(t);
			t = setTimeout(function () { fn.apply(null, args); }, wait);
		};
	}

	// funzione che chiede i suggerimenti al server
	function fetchSuggestions(q) {
		var url = themeAutocomplete.ajax_url +
			'?action=' + encodeURIComponent(themeAutocomplete.action) +
			'&nonce=' + encodeURIComponent(themeAutocomplete.nonce) +
			'&q=' + encodeURIComponent(q);

		return fetch(url, { method: 'GET', credentials: 'same-origin' })
			.then(function (resp) {
				if (!resp.ok) throw new Error('Network response was not ok');
				return resp.json();
			})
			.catch(function (err) {
				console.error('Autocomplete fetch error:', err);
				return [];
			});
	}


	function reinitBootstrapItalia(inputEl) {
		console.log("*** reinitBootstrapItalia ***");

		// recupera la classe corretta
		const AutocompleteClass = window.bootstrap?.InputSearchAutocomplete || window.bootstrap?.SelectAutocomplete;

		if (!AutocompleteClass) return;

		try {
				// cerca istanza esistente
				let inst = AutocompleteClass.getInstance ? AutocompleteClass.getInstance(inputEl) : null;

				if ( inst && typeof inst.dispose === "function" ) {
						console.log("*** Distruggi istanza", inst);
						inst.dispose(); // distrugge l'istanza precedente
				}

				// ricrea nuova istanza
				// if (typeof AutocompleteClass.getOrCreateInstance === "function") {
				// 	console.log("*** Crea istanza 1");
				// 	AutocompleteClass.getOrCreateInstance(inputEl);
				// } else {
				// 		console.log("*** Crea istanza");
				// 		new AutocompleteClass(inputEl);
				// }

				console.log("Reinit OK su:", inputEl);
		} catch (e) {
				console.warn("Reinit Autocomplete failed:", e);
		}
}


	// converte i risultati server in stringa per data-bs-autocomplete
	function resultsToDataAttr(results) {
		// Bootstrap-Italia si aspetta tipicamente array di oggetti { text: "...", link: "..." }
		try {
			return JSON.stringify(results || []);
		} catch (e) {
			return '[]';
		}
	}

	document.addEventListener('DOMContentLoaded', function () {
		var input = document.getElementById('search_string');
		if (!input) return;

		var minChars   = 3;    // minimo caratteri prima di chiamare il server.
		var debounceMs = 220;

		var onInput = debounce(function () {
			var q = input.value || '';

			if (q.length < minChars) {
				input.setAttribute('data-bs-autocomplete', '[]');
				reinitBootstrapItalia(input);
				return;
			}

			console.log("***CIAO1");
			fetchSuggestions(q).then(function (data) {
				console.log("***CIAO2");
				// data è array di oggetti [{text,link}, ...]
				input.setAttribute('data-bs-autocomplete', resultsToDataAttr(data));

				// se vuoi vedere cosa viene scritto:
				console.log('***updated data-bs-autocomplete:', input.getAttribute('data-bs-autocomplete'));

				// prova a reinizializzare il componente in modo che legga il nuovo attributo
				reinitBootstrapItalia(input);
			});
		}, debounceMs);

		input.addEventListener('input', onInput);
	});
})();
