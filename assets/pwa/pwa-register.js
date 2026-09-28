/**
 * Registers the public service worker after the page has loaded.
 */
( () => {
	'use strict';

	if ( ! ( 'serviceWorker' in navigator ) || ! window.isSecureContext || ! window.disPwaConfig ) {
		return;
	}

	window.addEventListener( 'load', () => {
		navigator.serviceWorker.register(
			window.disPwaConfig.serviceWorkerUrl,
			{ scope: window.disPwaConfig.scope }
		).catch( () => {} );
	} );
} )();
