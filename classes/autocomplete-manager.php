<?php
/**
 * Definition of the Autocomplete Manager: manages the site autocomplete features.
 * 
 * @package Design_ICT_Site
 */


/**
 * The manager that uploads the layout of the theme.
 *
 */
class DIS_AutocompleteManager {
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
		add_action( 'wp_ajax_theme_autocomplete', array( $this, 'theme_autocomplete_callback' ) );
		add_action( 'wp_ajax_nopriv_theme_autocomplete', array( $this, 'theme_autocomplete_callback' ) );
	}

	public function upload_scripts() {
		// Import algolia library for autocompletion.
		$hp_autocomplete = DIS_OptionsManager::dis_get_option( 'home_search_autocomplete_enabled', 'dis_opt_hp_layout' );
		if ( $hp_autocomplete === 'true' ) {
			// Algolia library.
			wp_enqueue_script(
				'dis-algolia-autocomplete',
				'https://cdn.jsdelivr.net/npm/@algolia/autocomplete-js@1.19.2/dist/umd/index.production.js',
				array(),
				null,
				true
			);
			// Custom Algolia.
			wp_enqueue_script(
				'dis-autocomplete-init',
				get_template_directory_uri() . '/assets/js/dis-autocomplete-init.js',
				array( 'dis-algolia-autocomplete' ),
				null,
				true
			);
			// Algolia CSS.
			wp_enqueue_style(
				'dis-algolia-autocomplete-css',
				'https://cdn.jsdelivr.net/npm/@algolia/autocomplete-theme-classic@1.19.2/dist/theme.min.css',
				array(),
				null
			);

			// Passing variables from PHP to JS.
			wp_localize_script(
				'dis-autocomplete-init',
				'disHpAutocompleteAjax',
				array(
					'ajaxUrl'     => admin_url( 'admin-ajax.php' ),
					'nonce'       => wp_create_nonce( 'sf_site_search_nonce' ),
					'searchLabel' => __( 'Search...', 'design_ict_site' ),
				)
			);

		}
	}

	/**
	 * AJAX endpoint for Home Page autocomplete.
	 *
	 * @return object
	 */
	public function theme_autocomplete_callback() {
		error_log( '*** ECCOMI IN theme_autocomplete_callback ***' );
		// check_ajax_referer( 'sf_site_search_nonce', 'nonce' );

		$q       = isset( $_POST['q'] ) ? sanitize_text_field( wp_unslash( $_POST['q'] ) ) : '';
		$results = array();

		// error_log( '*** TEXT:' . $q . ' ***' );

		if ( strlen( $q ) >= 1 ) {
			// Retrieve the posts.
			$types      = DIS_ContentsManager::searchable_post_types();
			$type_slugs = array_column( $types, 'slug' );
			$the_query  = new WP_Query(
				array(
					's'              => $q,
					'post_type'      => $type_slugs,
					'posts_per_page' => 8,
					'post_status'    => 'publish',
				)
			);

			if ( $the_query->have_posts() ) {
				foreach ( $the_query->posts as $p ) {
					$type = dis_ct_data()[ $p->post_type ]['singular_name'];
					$results[] = array(
						'name' => get_the_title( $p ),
						'text' => '',
						'icon' => '',
						'type' => $type,
						'link' => get_permalink( $p ),
					);
				}
			}
			wp_reset_postdata();
		}
		// Restituisce un array di oggetti { text: "...", link: "..." }.
		// error_log( '*** SENDING ' . json_encode( $results ) );
		wp_send_json( $results );
	}
}
