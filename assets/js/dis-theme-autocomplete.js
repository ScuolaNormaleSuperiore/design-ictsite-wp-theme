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


	// converte i risultati server in stringa per data-bs-autocomplete
	function resultsToDataAttr(results) {
		try {
			return JSON.stringify(results || []);
		} catch (e) {
			return '[]';
		}
	}

	function updateInputAutocomplete(dataString) {
		var inputElement = document.getElementById( 'search_string' );
		inputElement.setAttribute( 'data-bs-autocomplete', dataString );
		// const var1 = bootstrap.Input.getOrCreateInstance(inputElement);
		// debugger;
		// const inputSearch = new bootstrap.Input(
		// 	inputElement,
		// 	{
  	// 	autocomplete: dataString
		// 	}
		// );
	}




	document.addEventListener('DOMContentLoaded', function () {
		var input = document.getElementById('search_string');
		if (!input) return;

		var minChars   = 3;    // minimo caratteri prima di chiamare il server.
		var debounceMs = 220;

		var onInput = debounce(function () {
			var q = input.value || '';

			if (q.length < minChars) {
				console.log('*** RESET attribute []');
				// input.setAttribute('data-bs-autocomplete', '[]');
				updateInputAutocomplete('[]');
				return;
			}

			console.log("*** Waiting response:");
			fetchSuggestions(q).then(function (data) {

				// Original content:
				console.log('***updated data-bs-autocomplete:', input.getAttribute('data-bs-autocomplete'));

				// Set the attribute: from array to string.
				// input.setAttribute('data-bs-autocomplete', resultsToDataAttr(data));
				const dataString = resultsToDataAttr(data);
				updateInputAutocomplete(dataString);

		
				// New content:
				console.log('***updated data-bs-autocomplete:', input.getAttribute('data-bs-autocomplete'));
			});
		}, debounceMs);

		input.addEventListener('input', onInput);
	});


})();
