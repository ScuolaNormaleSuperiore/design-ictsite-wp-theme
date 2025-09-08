<?php
/**
 * Definition of the Layout Manager: uploads css and js.
 * In this file we define the layout of the site.
 * 
 * @package Design_ICT_Site
 */


/**
 * The manager that uploads the layout of the theme.
 *
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
		add_action( 'wp_footer', array( $this, 'load_pagination_script' ) );
	}

	public function upload_scripts() {
		// Import CSS files.
		wp_enqueue_style( 'dis-wp-style', get_stylesheet_uri() ); // File style.css vuoto.
		wp_enqueue_style( 'dis-font', DIS_THEME_URL . '/assets/css/fonts.css' );
		wp_enqueue_style( 'dis-boostrap-italia', DIS_THEME_URL . '/assets/css/bootstrap-italia-custom.min.css' );
		wp_enqueue_style( 'dis-custom-css', DIS_THEME_URL . '/assets/css/custom-colors.css' );
		wp_enqueue_style( 'dis-main', DIS_THEME_URL . '/assets/css/main.css' );
		// Enqueue Bootstrap Icons.
		wp_enqueue_style( 'bootstrap-icons-cdn', 'https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css', array(), '1.11.3' );

		// Import Javascript files.
		wp_enqueue_script( 'dis-boostrap-italia-js', DIS_THEME_URL . '/assets/bootstrap-italia/js/bootstrap-italia.bundle.min.js', array(), false, true);
	}

	public function upload_admin_scripts() {
		// ADMIN style: for Configuration Menu (CMB2) - To put the menu on the left instead of at the top.
		wp_enqueue_style( 'dis-style-admin-css', DIS_THEME_URL . '/admin/css/style-admin.css' );
		wp_enqueue_style( 'dis-admin-css', DIS_THEME_URL . '/admin/css/admin.css' );
	}

	public function configure_post_options() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		// add_theme_support( 'post-thumbnails' );
	}

	public function define_menu_locations() {
		/**
		 * This theme uses wp_nav_menu().
		 * Define the menu locations: wp-admin/nav-menus.php?action=locations.
		 * Look also: config-menu.php -> DIS_MENU_LOCATIONS.
		 */
		register_nav_menus( DIS_MENU_LOCATIONS );
	}

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
