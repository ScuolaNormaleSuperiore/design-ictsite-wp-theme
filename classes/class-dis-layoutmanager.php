<?php
/**
 * Layout manager bootstrap.
 *
 * @package Design_ICT_Site
 */

/**
 * Definition of the Layout Manager: uploads css and js.
 * In this file we define the layout of the site.
 *
 * @package Design_ICT_Site
 */
class DIS_LayoutManager {
	/**
	 * Constructor of the Manager.
	 */
	public function __construct() {}

	/**
	 * Uploading css, jss and all layout's stuff.
	 *
	 * @return void
	 */
	public function setup() {
		add_action( 'wp_enqueue_scripts', array( $this, 'upload_scripts' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'upload_admin_scripts' ) );
		add_action( 'after_setup_theme', array( $this, 'configure_post_options' ) );
		add_action( 'after_setup_theme', array( $this, 'define_menu_locations' ) );
		add_filter( 'pre_get_document_title', array( $this, 'filter_document_title' ) );
		add_action( 'wp_footer', array( $this, 'load_pagination_script' ) );
	}

	/**
	 * Enqueue frontend styles and scripts.
	 *
	 * @return void
	 */
	public function upload_scripts() {
		/*
		 * Front-end assets are versioned with the theme version, read once, instead of
		 * with filemtime() on each file. filemtime() invalidated the browser cache on
		 * every edit, which is convenient, but it also cost one filesystem read per
		 * asset on every request and published the last deployment time of the theme
		 * in the page source, as ?ver=<unix timestamp>.
		 *
		 * The trade-off: editing an asset without bumping the theme version now leaves
		 * visitors on the cached copy. The release flow already handles this, since
		 * `npm version` propagates the number to style.css through config-sync.js.
		 *
		 * The admin assets in upload_admin_scripts() keep filemtime() on purpose: there
		 * the timestamp is not exposed to anonymous visitors and immediate cache
		 * invalidation is worth more while working on the back office.
		 */
		$dis_version = wp_get_theme()->get( 'Version' );

		// Import CSS files.
		wp_enqueue_style( 'dis-wp-style', get_stylesheet_uri(), array(), $dis_version );
		wp_enqueue_style( 'dis-font', DIS_THEME_URL . '/assets/css/fonts.css', array(), $dis_version );
		wp_enqueue_style( 'dis-boostrap-italia', DIS_THEME_URL . '/assets/css/bootstrap-italia-custom.min.css', array(), $dis_version );
		wp_enqueue_style( 'dis-custom-css', DIS_THEME_URL . '/assets/css/custom-colors.css', array(), $dis_version );
		wp_enqueue_style( 'dis-main', DIS_THEME_URL . '/assets/css/main.css', array(), $dis_version );

		/*
		 * Bootstrap Icons is bundled in assets/bootstrap-icons/ instead of being loaded
		 * from a CDN: WordPress.org forbids non-service assets served by third parties,
		 * the CDN request exposed each visitor IP, and a local file needs no subresource
		 * integrity attribute. The upstream CSS is kept unmodified and its fonts/ subfolder
		 * preserved, so the relative url() paths resolve and the library can be updated by
		 * replacing the files.
		 */
		wp_enqueue_style( 'bootstrap-icons', DIS_THEME_URL . '/assets/bootstrap-icons/bootstrap-icons.css', array(), $dis_version );

		// Import Javascript files.
		wp_enqueue_script(
			'dis-boostrap-italia-js',
			DIS_THEME_URL . '/assets/bootstrap-italia/js/bootstrap-italia.bundle.min.js',
			array(),
			$dis_version,
			true
		);
	}

	/**
	 * Enqueue backend styles for the theme admin UI.
	 *
	 * @return void
	 */
	public function upload_admin_scripts() {
		// Admin styles for the theme configuration screens.
		wp_enqueue_style( 'dis-style-admin-css', DIS_THEME_URL . '/admin/css/style-admin.css', array(), filemtime( DIS_THEME_PATH . 'admin/css/style-admin.css' ) );
		wp_enqueue_style( 'dis-admin-css', DIS_THEME_URL . '/admin/css/admin.css', array(), filemtime( DIS_THEME_PATH . 'admin/css/admin.css' ) );
	}

	/**
	 * Enable standard theme support options.
	 *
	 * @return void
	 */
	public function configure_post_options() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts, pages and every theme custom post type.
		 * Required by DIS_ContentsManager::get_image_metadata() and by the featured image
		 * metabox of the post types that declare the 'thumbnail' support.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * Let WordPress render the <title> tag.
		 * The theme never prints a <title> of its own: when the internal SEO management
		 * is enabled, filter_document_title() replaces the text that WordPress would
		 * otherwise compose, so there is exactly one title in every configuration.
		 * Without this support the pages would have no title at all as soon as the
		 * internal SEO management is switched off.
		 */
		add_theme_support( 'title-tag' );
	}

	/**
	 * Replace the document title with the one built by the theme.
	 *
	 * Applies only while the internal SEO management is enabled: when it is off the
	 * title is left to WordPress, or to the SEO plugin the administrator delegated it
	 * to, and this filter does nothing.
	 *
	 * @param string $title Title computed by WordPress.
	 * @return string The theme title, or the received one when the theme has none.
	 */
	public function filter_document_title( $title ) {
		$seo_enabled = DIS_OptionsManager::dis_get_option( 'seo_internal_management_enabled', 'dis_opt_advanced_settings' );
		if ( 'true' !== $seo_enabled ) {
			return $title;
		}

		$og_data = DIS_ContentsManager::get_og_data();

		return $og_data->shared_title ? $og_data->shared_title : $title;
	}

	/**
	 * Register the menu locations used by the theme.
	 *
	 * @return void
	 */
	public function define_menu_locations() {
		/**
		 * This theme uses wp_nav_menu().
		 * Define the menu locations: wp-admin/nav-menus.php?action=locations.
		 * Look also: config-menu.php -> DIS_MENU_LOCATIONS.
		 */
		register_nav_menus( DIS_MENU_LOCATIONS );
	}

	/**
	 * Print the pagination helper script on singular views and page templates.
	 *
	 * @return void
	 */
	public function load_pagination_script() {
		if ( is_page_template() || is_singular() ) {
			?>
		<script>
			if (document.querySelector('.dropdown-menu.dli-pagination-dropdown')) {

				// Disabilita il comportamento di default del click.
				var dropdownLinks = document.querySelectorAll('.dropdown-menu.dli-pagination-dropdown a');
				dropdownLinks.forEach(function(link) {
					link.addEventListener('click', function(event) {
						event.preventDefault();
						// Rimuovi la classe 'active' da tutti i link.
						dropdownLinks.forEach(function(item) {
							item.classList.remove('active');
						});
						// Aggiungi la classe 'active' al link cliccato.
						link.classList.add('active');
					});
				});

				// Ricarica pagina con il valore posts_per_page selezionato.
				var pagerDropDown = document.getElementById('pagerChanger');
				if( pagerDropDown ){
					pagerDropDown.addEventListener('hidden.bs.dropdown', function (event) {
						var selectedItem = document.querySelector('.dropdown-menu.dli-pagination-dropdown .active');
						if (selectedItem) {
							// Recupera il valore dell'attributo 'data-perpage'.
							var perPageValue = selectedItem.getAttribute('data-perpage');
							// Ottiene l'URL corrente e i parametri GET.
							var currentUrl = new URL(window.location.href);
							var params = currentUrl.searchParams;
							const oldPerPage = params.get('posts_per_page');
							// Per evitare incongruenze,
							// quando si cambia numero di elementi per pagina,
							// si riparte dalla pagina numero 1.
							if (perPageValue != oldPerPage){
								params.set('num_page', 1);
							}
							// Aggiunge o aggiorna il parametro posts_per_page.
							params.set('posts_per_page', perPageValue);
							// Aggiorna l'URL e ricarica la pagina.
							window.location.href = currentUrl.toString();
						}
					});
				}
			}
		</script>
			<?php
		}
	}
}
