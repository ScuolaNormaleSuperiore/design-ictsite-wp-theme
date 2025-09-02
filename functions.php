<?php
/**
 * Design ICT Site Italia functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_ICT_Site
 */

/**
 * Constants.
 */
define( 'DIS_THEME_PATH', plugin_dir_path( __FILE__ ) );
define( 'DIS_THEME_URL', get_template_directory_uri() );


/**
 * Defining the theme parameters and the theme configurations.
 */
require_once DIS_THEME_PATH . '/config-theme.php';

/**
 * Defining the pages of the site.
 */
require_once DIS_THEME_PATH . '/config-pages.php';

/**
 * Defining the menus of the site.
 */
require_once DIS_THEME_PATH . '/config-menu.php';


/**
 * Defining and managing theme dependencies using TGM.
 */
require_once DIS_THEME_PATH . '/inc/theme-dependencies.php';

/**
 * Import CMB2 libraries.
 */
require_once DIS_THEME_PATH . '/inc/cmb2.php';



/**
 * SETUP THE THEME.
 */
if ( ! class_exists( 'DIS_ThemeManager' ) ) {
	require_once get_template_directory() . '/classes/theme-manager.php';
}


if ( class_exists( 'DIS_ThemeManager' ) ) {
	add_action(
		'after_setup_theme',
		function () {
			remove_action( 'after_setup_theme', __FUNCTION__ );
			$theme_manager = DIS_ThemeManager::get_instance();
			$theme_manager->theme_setup();
		},
		2
	);
}





// @TODO: Refactor the following code.

function enqueue_algolia_autocomplete() {
	// Algolia Autocomplete (UMD).
	wp_enqueue_script(
		'algolia-autocomplete',
		'https://cdn.jsdelivr.net/npm/@algolia/autocomplete-js@1.19.2/dist/umd/index.production.js',
		[],
		null,
		true
	);

	// CSS.
	wp_enqueue_style(
		'algolia-autocomplete-css',
		'https://cdn.jsdelivr.net/npm/@algolia/autocomplete-theme-classic@1.19.2/dist/theme.min.css',
		[],
		null
	);

	// Script personalizzato.
	wp_enqueue_script(
		'autocomplete-init',
		get_template_directory_uri() . '/assets/js/autocomplete-init.js',
		[ 'algolia-autocomplete' ],
		null,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'enqueue_algolia_autocomplete' );

// AJAX handler.
add_action( 'wp_ajax_theme_autocomplete', 'theme_autocomplete_callback' );
add_action( 'wp_ajax_nopriv_theme_autocomplete', 'theme_autocomplete_callback' );

function theme_autocomplete_callback() {
	error_log( '*** ECCOMI IN theme_autocomplete_callback ***' );
	// check_ajax_referer( 'sf_site_search_nonce', 'nonce' );

	$q       = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
	$results = array();

	error_log( '*** Testo:' . $q . ' ***' );

	if ( strlen( $q ) >= 1 ) {
		// Esempio: cerca titoli di post che contengono la query (personalizza come vuoi).
		$the_query = new WP_Query(
			array(
				's'              => $q,
				// 'post_type'      => DIS_ContentsManager::get_content_types_with_results(),
				'posts_per_page' => 8,
				'post_status'    => 'publish',
			)
		);

		if ( $the_query->have_posts() ) {
			foreach ( $the_query->posts as $p ) {
				$results[] = array(
					'text' => get_the_title( $p ),
					'link' => get_permalink( $p ),
				);
			}
		}
		wp_reset_postdata();
	}

	// Restituisce un array di oggetti { text: "...", link: "..." }.
	error_log( '*** Invio ' . json_encode( $results ) );

	wp_send_json( $results );
}
