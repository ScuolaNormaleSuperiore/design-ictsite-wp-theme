<?php
/**
 * Progressive web app support.
 *
 * @package Design_ICT_Site
 */

/**
 * Registers the minimal, public-facing PWA integration.
 */
class DIS_PwaManager {
	/**
	 * Register PWA hooks.
	 *
	 * @return void
	 */
	public function setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_registration_script' ) );
		add_action( 'template_redirect', array( $this, 'maybe_render_service_worker' ), 0 );
	}

	/**
	 * Enqueue the service-worker registration only on public pages.
	 *
	 * @return void
	 */
	public function enqueue_registration_script() {
		if ( is_admin() || is_user_logged_in() ) {
			return;
		}

		$theme_version = wp_get_theme()->get( 'Version' );
		$site_url      = home_url( '/' );
		$site_path     = wp_parse_url( $site_url, PHP_URL_PATH );

		wp_enqueue_script(
			'dis-pwa-registration',
			DIS_THEME_URL . '/assets/pwa/pwa-register.js',
			array(),
			$theme_version,
			true
		);

		wp_localize_script(
			'dis-pwa-registration',
			'disPwaConfig',
			array(
				'serviceWorkerUrl' => add_query_arg( 'dis_pwa_service_worker', '1', $site_url ),
				'scope'            => ! empty( $site_path ) ? trailingslashit( $site_path ) : '/',
			)
		);
	}

	/**
	 * Render the service worker from the site root, so it can control public pages.
	 *
	 * @return void
	 */
	public function maybe_render_service_worker() {
		$is_service_worker_request = filter_input( INPUT_GET, 'dis_pwa_service_worker', FILTER_VALIDATE_INT );
		if ( 1 !== $is_service_worker_request ) {
			return;
		}

		$theme_version = wp_get_theme()->get( 'Version' );
		$cache_name    = 'dis-pwa-' . sanitize_key( $theme_version );
		$assets        = array(
			get_stylesheet_uri(),
			DIS_THEME_URL . '/assets/css/fonts.css',
			DIS_THEME_URL . '/assets/css/bootstrap-italia-custom.min.css',
			DIS_THEME_URL . '/assets/css/custom-colors.css',
			DIS_THEME_URL . '/assets/css/main.css',
			DIS_THEME_URL . '/assets/bootstrap-icons/bootstrap-icons.css',
			DIS_THEME_URL . '/assets/bootstrap-italia/js/bootstrap-italia.bundle.min.js',
			DIS_THEME_URL . '/assets/favicons/android-chrome-192x192.png',
			DIS_THEME_URL . '/assets/favicons/android-chrome-512x512.png',
			DIS_THEME_URL . '/assets/pwa/offline.html',
		);

		$worker_config = array(
			'cacheName'   => $cache_name,
			'cachePrefix' => 'dis-pwa-',
			'assets'      => $assets,
			'offlineUrl'  => DIS_THEME_URL . '/assets/pwa/offline.html',
		);

		nocache_headers();
		header( 'Content-Type: application/javascript; charset=UTF-8' );
		?>
const disPwaConfig = <?php echo wp_json_encode( $worker_config ); ?>;

self.addEventListener( 'install', ( event ) => {
	event.waitUntil(
		caches.open( disPwaConfig.cacheName ).then( ( cache ) => cache.addAll( disPwaConfig.assets ) )
	);
} );

self.addEventListener( 'activate', ( event ) => {
	event.waitUntil(
		caches.keys().then( ( cacheNames ) => Promise.all(
			cacheNames
				.filter( ( cacheName ) => cacheName.startsWith( disPwaConfig.cachePrefix ) && cacheName !== disPwaConfig.cacheName )
				.map( ( cacheName ) => caches.delete( cacheName ) )
		) ).then( () => self.clients.claim() )
	);
} );

self.addEventListener( 'fetch', ( event ) => {
	const requestUrl = new URL( event.request.url );

	if ( event.request.method !== 'GET' || requestUrl.origin !== self.location.origin ) {
		return;
	}

	if ( event.request.mode === 'navigate' ) {
		event.respondWith(
			fetch( event.request ).catch( () => caches.match( disPwaConfig.offlineUrl ) )
		);
		return;
	}

	if ( ! disPwaConfig.assets.includes( requestUrl.href ) ) {
		return;
	}

	event.respondWith(
		caches.match( event.request ).then( ( cachedResponse ) => cachedResponse || fetch( event.request ) )
	);
} );
		<?php
		exit;
	}
}
